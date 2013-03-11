<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php if ($errorMessage) { ?>
	<div class="alert alert-error">
	<a class="close" data-dismiss="alert" href="#">x</a>
	<h4 class="alert-heading">Error!</h4>
	<?=$errorMessage?>
	</div>
<? } ?>

<h1><?php echo $title; ?></h1>


