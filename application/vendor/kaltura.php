<?php
require_once("..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."api_v3/bootstrap.php");
require_once("./application/vendor/kalturalib/KalturaClient.php");

DbManager::setConfig(kConf::getDB());
DbManager::initialize();

$partner = PartnerPeer::retrieveByPK(Kohana::$config->load('kalturaconf')->get('partnerID'));

if (!$partner)
	die("Default partner with ID \"1\" was not found!");
	
define("SAMPLE_ABSOUTE_PATH", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("PARTNER_ID", $partner->getId());
define("SECRET", $partner->getSecret());
define("ADMIN_SECRET", $partner->getAdminSecret());
if (strpos(kConf::get('www_host'), "https://") === 0)
	define("SERVER_URL", kConf::get('www_host'));
else
	define("SERVER_URL", "https://".kConf::get('www_host'));

define("BASE_URL", SERVER_URL . URL::base());


?>