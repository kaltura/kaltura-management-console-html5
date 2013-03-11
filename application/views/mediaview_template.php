<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo Kohana::$config->load('kalturaconf')->get('systemName');?></title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="js/swfobject.js"></script>
  <?=$cssFile?>
</head>
<body>
  <?=$content?>
</body>
</html>