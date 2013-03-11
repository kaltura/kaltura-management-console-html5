<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php if ($contentType == "photo") 
{
?>
	<img src="<?=SERVER_URL?>/p/<?=PARTNER_ID?>/sp/<?=$sp?>/raw/entry_id/<?=$entryID?>/version/100000" />
<?php } else { ?>
	<div id="container"><img src="<?=$bethanyLogo?>"><br /><br /><script type="text/javascript" src="<?=SERVER_URL?>/p/<?=PARTNER_ID?>/sp/<?=$sp?>/embedIframeJs/uiconf_id/<?=$videoUIConfID?>/partner_id/<?=PARTNER_ID?>"></script><object id="kaltura_player_<?=$entryID?>" name="kaltura_player_<?=$entryID?>" type="application/x-shockwave-flash" allowFullScreen="true" allowNetworking="all" allowScriptAccess="always" height="<?=$videoHeight?>" width="<?=$videoWidth?>" bgcolor="#000000" xmlns:dc="http://purl.org/dc/terms/" xmlns:media="http://search.yahoo.com/searchmonkey/media/" rel="media:video" resource="<?=SERVER_URL?>/index.php/kwidget/wid/_<?=PARTNER_ID?>/uiconf_id/<?=$videoUIConfID?>/entry_id/<?=$entryID?>" data="<?=SERVER_URL?>/index.php/kwidget/wid/_<?=PARTNER_ID?>/uiconf_id/<?=$videoUIConfID?>/entry_id/<?=$entryID?>">
						<param name="allowFullScreen" value="true" /><param name="allowNetworking" value="all" />
						<param name="allowScriptAccess" value="always" /><param name="bgcolor" value="#000000" />
						<param name="flashVars" value="&" /><param name="movie" value="<?=SERVER_URL?>/index.php/kwidget/wid/_<?=PARTNER_ID?>/uiconf_id/<?=$videoUIConfID?>/entry_id/<?=$entryID?>" />
					<a rel="media:thumbnail" href="<?=SERVER_URL?>/p/<?=PARTNER_ID?>/sp/<?=$sp?>/thumbnail/entry_id/<?=$entryID?>/width/120/height/90/bgcolor/000000/type/2"></a> <span property="dc:description" content=""></span><span property="media:width" content="<?=$videoWidth?>"></span><span property="media:height" content="<?=$videoHeight?>"></span> <span property="media:type" content="application/x-shockwave-flash"></span></object></div>";
<?php }?>
