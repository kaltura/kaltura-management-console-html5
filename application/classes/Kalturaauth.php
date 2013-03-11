<?php defined('SYSPATH') OR die('No direct access allowed.');

class Kalturaauth {

	public static function isLoggedIn()
	{
		$session = Session::instance();
		$config = new KalturaConfiguration(PARTNER_ID);
		$config->serviceUrl = SERVER_URL;
		$client = new KalturaClient($config);
		
  		$session = Session::instance();
		// get the sessionID
        $sessionID = $session->get(Kohana::$config->load('kalturaconf')->get('cookieName'));


        // if we have no session ID then the user is is not logged in. Redirect to login page
        if (!$sessionID)
        {
            return FALSE;

        // We do have a sessionID so lets check to see if it is valid. If not then redirect to login page
        } else {
        	try 
			{
				$client->setKs($sessionID);
			}
			catch (Exception $ex)
			{
				return FALSE;
			}
        	
        	return TRUE;
        }
	}

	public static function getSessionID()
	{
		$session = Session::instance();
		// get the sessionID
        $sessionID = $session->get(Kohana::$config->load('kalturaconf')->get('cookieName'));
		
		return $sessionID;
	}
}
