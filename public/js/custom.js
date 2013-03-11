$(document).ready(function() {
	var tree = new dhtmlXTreeFromHTML('treeBox');
	tree.setXMLAutoLoading("./categories/list")
	tree.loadXML("./categories/list?id=0");
	//tree.setImagePath("./public/img/dhtmlxTree/");
	//tree.setSkin('dhx_skyblue');
	
	var oTable = $('#medialist').dataTable( {
		"aoColumnDefs": [ 
      { "bSortable": false, "aTargets": [ 0, 2, 3, 5, 6 ] }
		],
	"bAutoWidth": true,
	"bProcessing": true,
	"bServerSide": true,
	"sAjaxSource": document.URL
	} );
	oTable.fnSetFilteringDelay(750);
	oTable.fnSetColumnVis( 2, false );
	
	
} );


$(function() {
		$("#save").click(function() {
			$('#save').button('loading');
			var name = $("input#name").val();  
			var description = $("textarea#description").val();
			var category = $("select#category").val();
			var entryId = $("input#entryID").val();
			var rowNum = parseInt($("input#rowNum").val());
			var dataString = 'name='+ name + '&description=' + description + '&category=' + category + '&entryId=' + entryId; 
			$.ajax({
				type: "POST",
				url: "./media/update",
				data: dataString,
				success: function() {  
				var oTable = $('#medialist').dataTable();
				oTable.fnUpdate( name, rowNum, 1, false );
				oTable.fnUpdate( description, rowNum, 2, false );
				oTable.fnUpdate( category, rowNum, 3, false );
				$().toastmessage('showSuccessToast', "Media settings <br /> saved successfully!");
				$('#editBox').modal('hide');
				$('#save').button('reset');
				},
				error: function() {  
				$().toastmessage('showErrorToast', "Media settings <br /> save failed.");
				$('#save').button('reset');
				}
			});
			return false;
		});
		
		$("#mediaUploadClose").click(function() {
			window.location.href  = "index.php";
		});
	});
  
	
	 function initZeroClip()
	 {
	 
		// Dont use zeroclip for IE 7 and 8 due to bug
		if ($.browser.msie && $.browser.version <= 8) {
			$("#d_clip_button").click(function() {
				window.clipboardData.setData('Text',$("#embedCode").text());
			 });

		// Use zeroclip for everything else
		} else {
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );		
			clip.addEventListener('mousedown', function (client) {
				// update the text on mouse down
				clip.setText( $("#embedCode").text() );
			});
					
			var width = 159;
			var height = 33;
			var flash_movie = '<div>'+clip.getHTML(width, height)+'</div>';
			flash_movie = $(flash_movie).css({
				position: 'relative',
				marginBottom: -height,
				width: width,
				height: height,
				zIndex: 101
				});
			$('#d_clip_button').before(flash_movie);
			}	
		}
		
		function confirmDelete(apiURL, dataString, initElem){
				$(initElem).button('loading');
				// Get row number of the item being edited
				var oTable = $('#medialist').dataTable();
				var rowNum = oTable.fnGetPosition( $(initElem).closest('tr').get(0) );

				var doAction = confirm("Are you sure you want to delete this media entry?\nThis will remove the media entry and all associated information.");
				if (doAction == false)
				{
				    $(initElem).button('reset');
					return false;
				}
				else
				{
					
				$.ajax({
					type: "GET",
					url: apiURL,
					data: dataString,
					success: function() {  
						oTable.fnDeleteRow(rowNum);
						$().toastmessage('showSuccessToast', "Media deleted successfully!");
					}
				});
				
				return true;
					
				}		
		}
		
		function showEmbedCode(thumbnail, entryId, partnerID, vidWidth, vidHeight, type, serverURL, subDir, videoUIConfID) {
			// Set default type to video
			type = typeof type !== 'undefined' ? type : 'video';
			
			$('#embedCodeBox').modal('show');
			
			if(type == 'photo')
			{
				$("#embedCode").text('<a target="_blank" href="' + serverURL + subDir + 'media/view/' + entryId + '?type=photo"><img src="' + thumbnail + '" border="0" /></a>');
			} else {
			$("#embedCode").text('\
				<script type="text/javascript" src="' + serverURL + '/p/' + partnerID +  '/sp/' + partnerID + '00/embedIframeJs/uiconf_id/' + videoUIConfID + '/partner_id/' + partnerID + '\"></script><object id="kaltura_player_' + entryId + '" name="kaltura_player_' + entryId + '" type="application/x-shockwave-flash" allowFullScreen="true" allowNetworking="all" allowScriptAccess="always" height="' + vidHeight + '" width="' + vidWidth + '" bgcolor="#000000" xmlns:dc="http://purl.org/dc/terms/" xmlns:media="http://search.yahoo.com/searchmonkey/media/" rel="media:video" resource="' + serverURL + '/index.php/kwidget/wid/_' + partnerID + '/uiconf_id/' + videoUIConfID + '/entry_id/' + entryId + '" data="' + serverURL + '/index.php/kwidget/wid/_' + partnerID + '/uiconf_id/' + videoUIConfID + '/entry_id/' + entryId + '">\
					<param name="allowFullScreen" value="true" /><param name="allowNetworking" value="all" />\
					<param name="allowScriptAccess" value="always" /><param name="bgcolor" value="#000000" />\
					<param name="flashVars" value="&" /><param name="movie" value="' + serverURL + '/index.php/kwidget/wid/_' + partnerID + '/uiconf_id/' + videoUIConfID + '/entry_id/' + entryId + '" />\
				<a rel="media:thumbnail" href="' + serverURL + '/p/' + partnerID + '/sp/' + partnerID + '/thumbnail/entry_id/' + entryId + '/width/120/height/90/bgcolor/000000/type/2"></a> <span property="dc:description" content=""></span><span property="media:width" content="' + vidWidth + '"></span><span property="media:height" content="' + vidHeight + '"></span> <span property="media:type" content="application/x-shockwave-flash"></span></object>\'');
			
			}
			
			initZeroClip();
			
		}
		
		function showEditBox(entryId, fromElement) {
		 // Get row number of the item being edited
		 var oTable = $('#medialist').dataTable();
		 var rowNum = oTable.fnGetPosition( $(fromElement).closest('tr').get(0) );
		 var name = oTable.fnGetData(rowNum, 1);
		 var description = oTable.fnGetData(rowNum, 2);
		 var category = oTable.fnGetData(rowNum, 3);

			$('#editBox').modal('show');
			
		    $("input#entryID").val(entryId);
			$("input#rowNum").val(rowNum);
			$("input#name").val(name);
			$("textarea#description").val(description);
			
			var text1 = 'Two';
			$("#category option").filter(function() {
				//may want to use $.trim in here
				return $(this).text() == text1; 
			}).attr('selected', true);
			$("#category").val(category);
			
			
		}
		
		function onContributionWizardAfterAddEntry(entries) {
			/*
			$("#completedBox").modal('show');
		
			// Close modal window
			$("#closeWindow").click(function() 
			{
				window.location.href  = "media_list.php";
			});
			*/
		}
		
		function publicAfterAddEntry(entries) {
			$('#mediaUpload').modal('show');
		}

		function onContributionWizardClose() {
			window.location.href  = "media_list.php";
		}