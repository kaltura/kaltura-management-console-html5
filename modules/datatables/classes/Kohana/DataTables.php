<?php defined('SYSPATH') or die('No direct script access.');
/**
 * DataTables
 * 
 * @package		DataTables
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @author	    Modified by David Ouwinga <douwinga@bethany.org>
 * @copyright	(c) 2011-2012 Micheal Morgan
 * @license		MIT
 */
class Kohana_DataTables
{
	/**
	 * Factory pattern
	 * 
	 * @access	public
	 * @param	mixed
	 * @return	DataTables
	 */
	public static function factory()
	{
		return new DataTables();
	}
	
	/**
	 * Whether or not current request is via DataTables
	 * 
	 * @static
	 * @access	public
	 * @param	mixed	NULL|Request
	 * @return	bool
	 */
	public static function is_request(Request $request = NULL)
	{
		$request = ($request) ? $request : Request::current();
		
		return (bool) $request->query('sEcho');
	}


	protected $_columns = array();
	protected $_client;	
	protected $_result;	
	protected $_rows = array();
	protected $_view;
	protected $_request;
	protected $_render;
	public function __construct()
	{
		//$this->paginate($paginate);
	}
	
	/**
	 * Set or get View file path
	 * 
	 * @access	public
	 * @param	mixed	NULL|string
	 * @return	mixed	$this|string
	 */
	public function view($path = NULL)
	{
		if ($path === NULL)
			return $this->_view;
		
		$this->_view = $path;
		
		return $this;
	}
	
	/**
	 * Set or get Request
	 * 
	 * @access	public
	 * @param	mixed	NULL|Request
	 * @return	mixed	$this|Request|NULL
	 */
	public function request(Request $request = NULL)
	{
		if ($request === NULL)
		{
			if ($this->_request instanceof Request)
				return $this->_request;
		
			return Request::current();
		}
		
		$this->_request = $request;
		
		return $this;
	}
	
	/**
	 * Add row to output
	 * 
	 * @access	public
	 * @param	array
	 * @return	$this
	 */
	public function add_row(array $row)
	{
		$this->_rows[] = $row;
		
		return $this;
	}

	/**
	 * Set or get columns
	 * 
	 * @access	public
	 * @param	mixed	NULL|string
	 * @return	mixed	$this|string
	 */
	public function columns(array $columns = NULL)
	{
		if ($columns === NULL)
			return $this->_columns;

		$this->_columns = $columns;

		return $this;
	}

	public function client($client = NULL)
	{
		if ($client === NULL)
			return $this->_client;

		$this->_client = $client;

		return $this;
	}
	
	/**
	 * Get result
	 * 
	 * @access	public
	 * @return	mixed
	 */
	public function result()
	{
		return $this->_result;
	}
	
	/**
	 * Execute
	 * 
	 * @access	public
	 * @param	mixed	NULL|Request
	 * @return	$this
	 */
	public function execute()
	{
		$request = $this->request();

		if ( ! $request instanceof Request)
			throw new Kohana_Exception('DataTables expecting valid Request. If within a 
				sub-request, have controller pass `$this->request`.');
		
		$columns = $this->_columns;
		
		$sort = "-createdAt";
		if ($request->query('iSortCol_0') !== NULL)
		{
			for ($i = 0; $i < intval($request->query('iSortingCols')); $i++)
			{
				$column = $columns[intval($request->query('iSortCol_' . $i))];

				if ($column != "")
				{
					if ($request->query('sSortDir_' . $i) == "asc")
					{
						$sort = "+" . $column;
					} else {
						$sort = "-" . $column;
					}
				}
			}
		}

		$pageNum = 0;
		$start = 0;
		$length= 0;
		if ($request->query('iDisplayStart') !== NULL && $request->query('iDisplayLength') != '-1')
		{
			$start = $request->query('iDisplayStart');
			$length = $request->query('iDisplayLength');

			$pageNum = ($start + $length) / $length;
		}

		$filter = new KalturaMediaEntryFilter();
		$filter->orderBy = $sort;
		$filter->statusNotEqual = KalturaEntryStatus::DELETED;

		$pager = new KalturaFilterPager();
		$pager->pageIndex = $pageNum;
		$pager->pageSize = $length;

		if ($request->query('sSearch'))
		{
			$filter->freeText = $request->query('sSearch');
		}

		$this->_count_total = $this->_client->media->count($filter);
		$this->_result = $this->_client->media->listAction($filter, $pager);

		return $this;
	}
	
	/**
	 * Render
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		return $this->render();
	}
	
	/**
	 * Render
	 *
	 * @access	public
     * @param	Response
	 * @return	string
	 */
	public function render(Response $response = NULL)
	{
		if ($this->_render === NULL)
		{
			if ($this->_view)
			{
				View::factory($this->_view, array('datatables' => $this))->render();
			}

			$this->_render = json_encode(array
			(
				'sEcho' 				=> intval($this->request()->query('sEcho')),
				'iTotalRecords' 		=> $this->_count_total,
				'iTotalDisplayRecords' 	=> $this->_count_total,
				'aaData' 				=> $this->_rows
			));
		}

        if ($response instanceof Response)
        {
            $response->headers('content-type', 'application/json');
            $response->body($this->_render);
        }
		
		return $this->_render;
	}
}
