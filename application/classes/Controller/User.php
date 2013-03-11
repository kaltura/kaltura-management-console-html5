<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_User extends Controller_Template {
	
	public function before()
	{
		parent::before();
		$this->session = Session::instance();
		$this->config = new KalturaConfiguration(PARTNER_ID);
		$this->config->serviceUrl = SERVER_URL;
		$this->client = new KalturaClient($this->config);

		// Check to see if we are already logged in... If we are then go to the page we came from
	}

    public function action_login() 
    {
		$message = "Please identify yourself:";
		$this->template = View::factory('auth_template');
        $this->template->content = View::factory('user/login')
        		->set('systemName', Kohana::$config->load('kalturaconf')->get('systemName'))
				->bind('message', $message);
		$sessionID = null;
             
        if (HTTP_Request::POST == $this->request->method()) 
        {
			$username = $this->request->post('username');
			$password = $this->request->post('password');
			
			try 
			{
				$sessionID = $this->client->user->login(PARTNER_ID, $username, $password);
			}
            // Could not login using Kaltura Authentication so lets try LDAP
			catch (Exception $ex)
			{
				$message = $ex;
			}

			if($sessionID)
			{
				$this->session->set(Kohana::$config->load('kalturaconf')->get('cookieName'), $sessionID);
				$this->redirect('');
			}
        }
    }

    public function action_logout() 
    { 
    	$this->session->delete(Kohana::$config->load('kalturaconf')->get('cookieName'));
    	$this->redirect('https://portal.bethany.org');
    }
}