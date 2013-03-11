<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo Kohana::$config->load('kalturaconf')->get('systemName');?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php echo HTML::style("public/css/bootstrap.css"); ?>
	<?php echo HTML::style("public/css/layout.css"); ?>
  <?php echo HTML::style("public/css/jquery.toastmessage.css"); ?>
  <?php echo HTML::style("public/css/dhtmlxtree.css"); ?>
	<?php echo HTML::script("public/js/jquery-1.8.2.min.js"); ?>
  <?php echo HTML::script("public/js/swfobject.js"); ?>
  <?php echo HTML::script("public/js/ZeroClipboard.js"); ?>
	<?php echo HTML::script("public/js/bootstrap.min.js"); ?>
	<?php echo HTML::script("public/js/datatables.js"); ?>
  <?php echo HTML::script("public/js/dataTables_filterdelay.js"); ?>
	<?php echo HTML::script("public/js/DT_bootstrap.js"); ?>
  <?php echo HTML::script("public/js/jquery.toastmessage.js"); ?>
  <?php echo HTML::script("public/js/dhtmlxTree/dhtmlxcommon.js"); ?>
  <?php echo HTML::script("public/js/dhtmlxTree/dhtmlxtree.js"); ?>
  <?php echo HTML::script("public/js/dhtmlxTree/ext/dhtmlxtree_start.js"); ?>
  <?php echo HTML::script("public/js/custom.js"); ?>

    <!-- Le styles -->
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php echo HTML::anchor("", Kohana::$config->load('kalturaconf')->get('systemName'), array('class' => 'brand')); ?>
          <div class="nav-collapse">
            <ul class="nav">
              <li><?php echo HTML::anchor("", "Media List"); ?></li>
              <li><?php echo HTML::anchor("media/add", "Add Media"); ?></li>
              <li><?php echo HTML::anchor("pages/manage", "Manage Pages"); ?></li>
              <li><?php echo HTML::anchor("user/logout", "Logout"); ?></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <?php echo $content; ?>
	  
    </div> <!-- /container -->

  </body>
</html>
