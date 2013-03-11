<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php if ($errorMessage) { ?>
	<div class="alert alert-error">
	<a class="close" data-dismiss="alert" href="#">x</a>
	<h4 class="alert-heading">Error!</h4>
	<?=$errorMessage?>
	</div>
<? } ?>

<h1><?php echo $title; ?></h1>


<div class="container-fluid">
	<div class="row-fluid">
 		<div class="span3">
   			<div class="well sidebar-nav">
   				<span class="nav-header">Categories</span>
   				<div id="treeBox" setImagePath="<?=URL::base()?>public/img/dhtmlxTree/csh_dhx_skyblue/"><!-- Populated with Javascript --></div>
	  		</div><!--/.well -->
		</div><!--/span-->
		<div class="span9">
			<div id="mediaTable">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="medialist" >
				<thead>
				<tr>
					<th>Thumbnail</th><th>Media Title</th><th>Description</th><th>Category</th><th>Upload Date</th><th>Status</th><th>Actions</th>
				</thead>
				<tbody>
					<!-- Populated with Javascript -->
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal hide" id="embedCodeBox">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Media Embed Code</h3>
  </div>
  <div class="modal-body">
    <div id="d_clip_container" style="position:relative;margin-bottom:5px;">
		<div id="d_clip_button" class="btn"><div style="float:left;"><?php echo HTML::image("public/img/page_white_copy.png" , array('alt' => 'copy to clipboard', 'Title' => 'Copy to Clipboard')); ?></div><div style="float:left;margin-left:5px;"> Copy to Clipboard</div></div>
	</div>
	<div id="embedCode" contenteditable="true"></div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>

<div class="modal hide" id="editBox">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Edit Media Settings</h3>
  </div>
  <div class="modal-body">
	<form class="form-horizontal" id="form" name="form" action="">
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="name">Title</label>
      <div class="controls">
        <input type="text" class="input-xlarge" name="name" id="name">
      </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="description">Description</label>
      <div class="controls">
		<textarea class="input-xlarge" name="description" id="description" rows="3"></textarea>
      </div>
	</div>
	  <div class="control-group">
	  <label class="control-label" for="category">Category</label>
      <div class="controls">
		 <select class="input-xlarge" id="category">
		 <option></option>
		 <?php /*
		 <?php foreach($categories->objects as $category): ?>
                <option value="<?=$category->name?>"><?=$category->name?></option>
		 <?php endforeach; ?>
		 */ ?>
         </select>
		 <a class="btn btn-success" data-toggle="collapse" data-target="#manageCategories">Edit Categories</a>
		 <input type="hidden" name="entryID" id="entryID" value="" />
		 <input type="hidden" name="roNum" id="rowNum" value="" />
      </div>
    </div>
  </fieldset>
</form>
<form class="form-horizontal" id="form-categories" name="form-categories" action="">
<fieldset>
<div id="manageCategories" class="accordion-body collapse">
<div class="control-group">
      <div class="controls">
        <input type="text" class="input-xlarge" name="add-category-name" id="add-category-name">
		<a id="add-category" class="btn">Add Category</a>
      </div>
</div>
<div class="control-group">
      <div class="controls">
		 <select class="input-xlarge" id="deleteCategoryList">
		 	<?php /*
		 <?php foreach($categories->objects as $category): ?>

                <option value="<?=$category->id?>"><?=$category->name?></option>
		<?php endforeach; ?>
		*/ ?>
         </select>
		 <a id="delete-category" class="btn">Delete Category</a>
      </div>
    </div>
</div>
  </fieldset>
</form>
</div>
  <div class="modal-footer">
	<button name="submit" class="btn btn-primary" id="save" data-loading-text="Saving...">Save Changes</button>
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
