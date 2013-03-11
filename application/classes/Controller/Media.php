<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Media extends Controller_Template {
	public $template = 'template';
	
		//Authenticate
	  public function before()
      {
        parent::before();

        $this->config = new KalturaConfiguration(PARTNER_ID);
		$this->config->serviceUrl = SERVER_URL;
		$this->client = new KalturaClient($this->config);

		// Check if logged in only if we are not viewing media
		if (Request::initial()->action() != "view")
		{
		    if (!Kalturaauth::isLoggedIn())
		    {
		    	$this->redirect('user/login');
		    } else {
		    	$this->client->setKs(Kalturaauth::getSessionID());
		    }
		}
      }
	
	public function action_list()
	{
		// If this is an ajax request from datatables
		if (DataTables::is_request())
    	{  
			// Do not render our template since we want to return json
    		$this->auto_render = FALSE;

			// Auto-datatable integration using the datatables module
	        $datatables = DataTables::factory()
	        	->columns(array(null, "name", null, null, "createdAt", null, null))
	        	->client($this->client)
	        	->execute();


	        // For all of our computers we found lets add theme to our datatable
	        // ** Note: We add more columns than are displayed for searching and info viewing
	        foreach ($datatables->result()->objects as $mediaEntry)
	        {
	        	// Generate status text and text color for each status number
	        	$statusColor = "";
				switch ($mediaEntry->status) 
				{
					case "6":
						$status = "Blocked";
						$statusColor = "#CC0000";
						break;
					case "3":
						$status = "Deleted";
						$statusColor = "#CC0000";
						break;
					case "-1":
						$status = "Conversion Error";
						$statusColor = "#CC0000";
						break;
					case "-2":
						$status = "Importing Error";
						$statusColor = "#CC0000";
						break;
					case "0":
						$status = "Importing";
						$statusColor = "#FF6600";
						break;
					case "virusScan.Infected":
						$status = "Virus Infected";
						$statusColor = "#CC0000";
						break;
					case "5":
						$status = "Awaiting Moderation";
						$statusColor = "#FF6600";
						break;
					case "7":
						$status = "No Content";
						$statusColor = "#CC0000";
						break;
					case "4":
						$status = "Pending";
						$statusColor = "#FF6600";
						break;
					case "1":
						$status = "Converting";
						$statusColor = "#FF6600";
						break;
					case "2":
						$status = "Ready";
						$statusColor = "#006600";
						break;
					case "virusScan.ScanFailure":
						$status = "Virus Scan Failed";
						$statusColor = "#FF3300";
						break;
				}

				// Wohoo we are breaking MVC by putting view code in our controller. Shhhh it is much easier this way so we can just forget about it right?
				$thumbCode = "";
				if($mediaEntry->status == 2)
				{
					$thumbCode = '<img width="40" src="' . $mediaEntry->thumbnailUrl . '" />';
				} 

				$actionCode = 	"<div class=\"btn-group\">
					<button class=\"btn btn-mini\" data-loading-text=\"Deleting...\" onclick=\"return confirmDelete('" . Kohana::$config->load('kalturaconf')->get('apiURL') ."','service=multirequest&action=null&ignoreNull=1&action=delete&clientTag=kmc&service=baseentry&entryId=" . $mediaEntry->id . "&ks=" . Kalturaauth::getSessionID() . "', this);\">Delete</button> 
					<button class=\"btn btn-mini\" onclick=\"showEditBox('" . $mediaEntry->id ."', this);\">Edit</button>";

				if($mediaEntry->mediaType == 2)
				{
				$actionCode = $actionCode . "
					<button class=\"btn btn-mini\" onclick=\"showEmbedCode('" . $mediaEntry->thumbnailUrl . "', '" . $mediaEntry->id . "', '" . PARTNER_ID . "', '" . Kohana::$config->load('kalturaconf')->get('videoWidth') . "', '" . Kohana::$config->load('kalturaconf')->get('videoHeight') . "', 'photo', '" . SERVER_URL . "', '" . URL::base() . "', '" . Kohana::$config->load('kalturaconf')->get('videoUIConfID') . "');\">Embed</button>
					<a target=\"_blank\" class=\"btn btn-mini\" href=\"media/view/" . $mediaEntry->id . "?type=photo\">View</a>";
				} else {
				$actionCode = $actionCode . "
				   <button class=\"btn btn-mini\" onclick=\"showEmbedCode('" . $mediaEntry->thumbnailUrl . "', '" . $mediaEntry->id . "', '" . PARTNER_ID . "', '" . Kohana::$config->load('kalturaconf')->get('videoWidth') . "', '" . Kohana::$config->load('kalturaconf')->get('videoHeight') . "', 'video', '" . SERVER_URL . "', '" . URL::base() . "', '" . Kohana::$config->load('kalturaconf')->get('videoUIConfID') . "');\">Embed</button>
					<a target=\"_blank\" class=\"btn btn-mini\" href=\"media/view/" . $mediaEntry->id . "\">View</a>";
				}

				$actionCode = $actionCode . "</div>";

	            $datatables->add_row(array
	            (
	            	'<center>' . $thumbCode . '</center>',
	            	$mediaEntry->name,
	            	$mediaEntry->description,
	            	$mediaEntry->categories,
	            	date("m-d-Y g:i a", $mediaEntry->createdAt),
	            	'<span style="color:' . $statusColor . '">'. $status . '</span>',
	            	$actionCode,
	            ));
	        }           

	        // Return our table data as json using the datatables module
	        $datatables->render($this->response);

	    // We are not being called through ajax so lets show our view
		} else {
			// TODO: Implement error messaging
			$errorMessage = "";

			$categories = $this->client->category->listAction();

	        $view = new View('media/list');
	        $view->set("errorMessage", $errorMessage);
	       // $view->set("response", $response);
	       // $view->set("categories", $categories);
	        //$view->set("rootCategories", $rootCategories);
	      //  $view->set("sessionID", Kalturaauth::getSessionID());
	      //  $view->set("apiURL", Kohana::$config->load('kalturaconf')->get('apiURL'));
	       // $view->set("videoWidth", Kohana::$config->load('kalturaconf')->get('videoWidth'));
	       // $view->set("videoHeight", Kohana::$config->load('kalturaconf')->get('videoHeight'));
	       // $view->set("videoUIConfID", Kohana::$config->load('kalturaconf')->get('videoUIConfID'));
			$view->set("title", "Media List");
	 
			$this->template->set('content', $view);
		}
	}

	public function action_upload()
	{
		include Kohana::find_file('vendor/fileUpload', 'UploadHandler');
		$this->auto_render = FALSE;
		$upload_handler = new UploadHandler();
	}

	public function action_add()
	{
		$errorMessage = "";

		$movie = "/opt/kaltura/web/tmp/Hui.flv";

		try
		{
			$token = $this->client->media->upload($movie);
			$entry = new KalturaMediaEntry();
			$entry->name = "Fun Piano";
			$entry->mediaType = KalturaMediaType::VIDEO;
			$result = $this->client->media->addFromUploadedFile($entry, $token);
			print_r($result);
			unlink($movie);
		}

		catch (Exception $ex)
		{
			$errorMessage = $ex->getMessage();
		}

        $view = new View('media/add');
        $view->set("errorMessage", $errorMessage);
		$view->set("title", "Add Media");
 
		$this->template->set('content', $view);
	}

	public function action_update()
	{
		$this->auto_render = FALSE;
		$entryId = $_POST['entryId'];
		$mediaEntry = new KalturaMediaEntry();
		$mediaEntry->name = $_POST['name'];
		$mediaEntry->description = $_POST['description'];
		$mediaEntry->categories = $_POST['category'];
    	$this->client->media->update($entryId, $mediaEntry);
	}

	public function action_view()
	{
		$ks = $this->client->session->start(SECRET, "USERID", KalturaSessionType::USER);

		$flashVars = array();
		$flashVars["partnerId"] 	= PARTNER_ID;
		$flashVars["subpId"] = PARTNER_ID * 100;
		$flashVars["uid"] = "USERID";
		$flashVars["sessionId"] 	= $ks;
		$flashVars["kshowId"] 		= -1;
		$flashVars["terms_of_use"]	= kConf::get('terms_of_use_uri');
		$flashVars["afterAddEntry"] = "onContributionWizardAfterAddEntry";
		$flashVars["close"] 		= "onContributionWizardClose";
		$flashVars["showCloseButton"] = false; // because we don't show the contribution wizard in a modal window

		$entryID =  $this->request->param('id');
		$sp = PARTNER_ID * 100;
		if( isset($_GET['type']) && $_GET['type'] == "photo")
		{
			$cssFile = "";
			$contentType = "photo";
		} else {
			$cssFile = HTML::style("public/css/layoutVideo.css");
			$contentType = "video";
		}
		$this->template = View::factory('mediaview_template');
        $view = new View('media/view');
        $this->template->set("cssFile", $cssFile);
        $view->set("contentType", $contentType);
        $view->set("flashVars", $flashVars);
        $view->set("sp", $sp);
        $view->set("entryID", $entryID);
        $view->set("bethanyLogo", Kohana::$config->load('kalturaconf')->get('bethanyLogo'));
        $view->set("videoUIConfID", Kohana::$config->load('kalturaconf')->get('videoUIConfID'));
        $view->set("videoWidth", Kohana::$config->load('kalturaconf')->get('videoWidth'));
       	$view->set("videoHeight", Kohana::$config->load('kalturaconf')->get('videoHeight'));
 
		$this->template->set('content', $view);
	}
} 
