<?php defined('SYSPATH') or die('No direct script access.');

// **********************************************************************************************
// NOTE: Beyond editing this file you should also edit ../bootstrap.php for more configurations *
// **********************************************************************************************

return array(

    // ** Interface **
    'systemName' => "Kaltura Media System", // Title of the System
    'videoWidth' => 640, // Default video player width
    'videoHeight' => 390, // Default video player height
    'bethanyLogo' => "https://portal.bethany.org/webinar/mediaplayer/bethany_logo.gif", // Location of the bethany logo image

    // ** Kaltura **
    'partnerID' => 103, // The partner ID for this system to use
    'apiURL' => "https://video.bethany.org/api_v3/index.php", // URL to the kaltura API. You must include the api index.php
    'videoUIConfID' => 6709463, // The uiconf_id of the video player we want to use.

    // ** Cookies **
    'cookieName' => "MyCookieName", // The name of the cookie that will be stored in the users browser. We need a unique name since we have multiple systems on the same server
);