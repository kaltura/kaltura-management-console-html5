<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Categories extends Controller {
	public $template = 'template';
	
		//Authenticate
	  public function before()
      {
        parent::before();

        $this->config = new KalturaConfiguration(PARTNER_ID);
		$this->config->serviceUrl = SERVER_URL;
		$this->client = new KalturaClient($this->config);

         if (!Kalturaauth::isLoggedIn())
         {
         	$this->redirect('user/login');
         } else {
         	$this->client->setKs(Kalturaauth::getSessionID());
         }
		
      }
	
	public function action_list()
	{
		if (isset($_GET["id"]))
		{
			$categoryID = $_GET['id'];
		} else {
			$categoryID = 0;
		}

		print("<tree id='".$categoryID."'>");

		$categories = $this->client->category->listAction();

		//TODO: Make categories acually work with a tree layout. We need Kaltura Falcon to save us!!
		foreach ($categories->objects as $category)
		{
			if ($category->parentId == $categoryID)
			{
				print("<item child='". $category->directSubCategoriesCount . "' id='" . $category->id . "' text='" . $category->name . "'><userdata name='ud_block'>ud_data</userdata></item>");
			}
		}

		print("</tree>");
		/*
		print("<tree id='".$url_var."'>");
         for ($inta=0; $inta<4; $inta++)
			 print("<item child='1' id='".$url_var."_".$inta."' text='Item ".$url_var."-".$inta."'><userdata name='ud_block'>ud_data</userdata></item>");
print("</tree>");
*/
		//$category = new KalturaCategory();
		//$category->name = $categoryName;
		//$id = $this->client->category->add($category)->id;
		//echo $id;
	}
} 
