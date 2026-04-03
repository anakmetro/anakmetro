<style>
	.message-item .summary {
		max-width: calc(100% - 500px);
	}

	.dropdown-menu.dropdown-menu-right.dropdown-caret::before, .dropdown-menu.dropdown-caret-right.dropdown-caret::before {
	    left: auto;
	    right: 9px;
	}

	.dropdown-menu.dropdown-caret::before {
	    -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
	    border-bottom: 7px solid rgba(0, 0, 0, 0.2);
	    border-left: 7px solid transparent;
	    border-right: 7px solid transparent;
	    content: "";
	    display: inline-block;
	    left: 9px;
	    position: absolute;
	    top: -7px;
	}
	.dropdown-menu.dropdown-caret::before {
	    -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
	    border-bottom: 7px solid rgba(0, 0, 0, 0.2);
	    border-left: 7px solid transparent;
	    border-right: 7px solid transparent;
	    content: "";
	    display: inline-block;
	    left: 9px;
	    position: absolute;
	    top: -7px;
	}
	.dropdown-menu.dropdown-menu-right.dropdown-caret::after, .dropdown-menu.dropdown-caret-right.dropdown-caret::after {
	    left: auto;
	    right: 10px;
	}

	.dropdown-menu.dropdown-caret::after {
	    -moz-border-bottom-colors: #fff;
	    border-bottom: 6px solid #fff;
	    border-left: 6px solid transparent;
	    border-right: 6px solid transparent;
	    content: "";
	    display: inline-block;
	    left: 10px;
	    position: absolute;
	    top: -6px;
	}

	.dropdown-colorpicker > .dropdown-menu > li {
	    display: block;
	    float: left;
	    height: 20px;
	    margin: 2px;
	    width: 20px;
	}

	.dropdown-colorpicker > .dropdown-menu > li > .colorpick-btn {
	    border-radius: 0;
	    display: block;
	    height: 20px;
	    margin: 0;
	    padding: 0;
	    position: relative;
	    transition: all 0.1s ease 0s;
	    width: 20px;
	}
</style>
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="function/assets/Bootstrap-Image-Gallery-3.4.2/css/bootstrap-image-gallery.css">
<!-- <link rel="stylesheet" href="function/assets/Bootstrap-Image-Gallery-3.4.2/css/demo.css"> -->
<!-- blueimp Gallery styles -->
<!-- <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css"> -->
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<!-- <link rel="stylesheet" href="memo/css/jquery.fileupload.css"> -->
<!-- <link rel="stylesheet" href="memo/css/jquery.fileupload-ui.css"> -->
<!-- CSS adjustments for browsers with JavaScript disabled -->
<!-- <noscript><link rel="stylesheet" href="memo/css/jquery.fileupload-noscript.css"></noscript> -->
<!-- <noscript><link rel="stylesheet" href="memo/css/jquery.fileupload-ui-noscript.css"></noscript> -->
<?php
$mem = @mysqli_result1(mysqli_query($mysqli1, "select count(`id`) from `memo` where `read`=0 and `to`='$login' and `status`='-'"), 0);

$urlremoveImage = $avatarlink."removeImages.php";
//$postfields = array("login" => $login, "action" => "defaultAvatar");
$ch = curl_init();
$options = array(
    CURLOPT_URL => $urlremoveImage,
    //CURLOPT_POST => 1,
    //CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_RETURNTRANSFER => true
); // cURL options
curl_setopt_array($ch, $options);
curl_exec($ch);
$output = curl_exec($ch);
curl_close($ch);
?>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1" id="inbox-tabs">
							<li class="li-new-mail pull-right">
								<a class="btn-new-mail" data-target="write" href="#write" data-toggle="tab">
									<span class="btn btn-purple no-border">
										<i class="ace-icon fa fa-envelope bigger-130"></i>
										<span class="bigger-110">Write Memo</span>
									</span>
								</a>
							</li><!-- /.li-new-mail -->

							<li class="active">
								<a data-target="inbox" href="#inbox" data-toggle="tab">
									<i class="blue ace-icon fa fa-inbox bigger-130"></i>
									<span class="bigger-110">Inbox</span>
								</a>
							</li>

							<li>
								<a data-target="sent" href="#sent" data-toggle="tab">
									<i class="orange ace-icon fa fa-location-arrow bigger-130"></i>
									<span class="bigger-110">Sent</span>
								</a>
							</li>
						</ul>

						<div class="tab-content no-border no-padding">
							<div class="tab-pane active" id="inbox">
							</div>
						</div><!-- /.tab-content -->
					</div><!-- /.tabbable -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			<div id="write-message-show"></div>
			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div> <!-- page content -->
<!-- basic scripts -->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='function/assets/js/memo/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<!-- page specific plugin scripts -->
<script src="<?php echo $linkbootstrapjs; ?>/bootstrap-tag.min.js"></script>
<script src="<?php echo $linkjs; ?>/memo/markdown.min.js"></script>
<script src="<?php echo $linkbootstrapjs; ?>/bootstrap-markdown.min.js"></script>
<script src="<?php echo $linkjs; ?>/memo/jquery.hotkeys.min.js"></script>
<script src="<?php echo $linkbootstrapjs; ?>/bootstrap-wysiwyg.min.js"></script>

<!-- ace scripts -->
<script src="<?php echo $linkjs; ?>/ace/ace-elements.min.js"></script>
<script src="<?php echo $linkjs; ?>/ace/ace.min.js"></script>

<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="function/assets/Bootstrap-Image-Gallery-3.4.2/js/bootstrap-image-gallery.js"></script>
<script src="function/assets/Bootstrap-Image-Gallery-3.4.2/js/demo.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($){
		//handling tabs and loading/displaying relevant messages and forms
		//not needed if using the alternative view, as described in docs
		var thisTab = "#inbox",
		hal = 1,
		selectedMsg = [],
		dataSend = "",
		replyStatus = 0,
		myIdMemo = "";

		function deleteMemo(myMenu) {
			$("#"+ myMenu + " #multiple").on('click', function(e) {
				e.preventDefault();
				$('.inline .ace').each(function(idx) {
					if(this.checked){
						selectedMsg.push($(".message-item:eq('"+(idx-1)+"')").attr("data-id"));
					}
				});

				$.ajax({
					url: "memoAction.php",
					type: 'post',
					async: false,
					beforeSend: function() {
						//show the loading icon
						$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
					},
					data: {
						action : "delete",
						menu : myMenu,
						idmemo : selectedMsg
					},
					success: function (output) {
						if(output!="error") {
							setTimeout(function() {
								$('.message-container').find('.message-loading-overlay').remove();
								alert(output);
								if(myMenu=="inbox"){
									Inbox.show_list();
								}else {
									Inbox.show_listSent();
								}
								selectedMsg = [];
							}, 500 + parseInt(Math.random() * 500));
						}else {
							alert("Error! Reload this page");
							location.reload();
						}
					},
					error: function () {
						console.log("Try Again");
					}
				});
			});
		}

		function markAsRead() {
			$("#markasread").on('click', function(e) {
				e.preventDefault();
				$('.inline .ace').each(function(idx) {
					if(this.checked){
						selectedMsg.push($(".message-item:eq('"+(idx-1)+"')").attr("data-id"));
					}
				});

				$.ajax({
					url: "memoAction.php",
					type: 'post',
					async: false,
					beforeSend: function() {
						//show the loading icon
						$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
					},
					data: {
						action : "allRead",
						idmemo : selectedMsg
					},
					success: function (output) {
						if(output!="error") {
							setTimeout(function() {
								$('.message-container').find('.message-loading-overlay').remove();
								if(output!=""){
									alert(output);
								}
								Inbox.show_list();
								selectedMsg = [];
							}, 500 + parseInt(Math.random() * 500));
						}else {
							alert("Error! Reload this page");
							location.reload();
						}
					},
					error: function () {
						console.log("Try Again");
					}
				});
			});
		}


		function pagination(myMenu) {
			$("#" + myMenu + " .pagination li a").on('click', function(e) {
				e.preventDefault();
				hal = $(this).attr("data-id");
				console.log(myMenu + " hal = " + hal + " what is this?");
				if(myMenu=="sent"){
					Inbox.show_listSent();
				}else {
					Inbox.show_list();
				}
			});
		}

		function loadMessage() {
			//basic initializations
			form_initialized = false;
			if($('#id-message-content').length==0) {
				$('<div id="id-message-content" class="message-content hide">').insertAfter(".row:eq('3')");
			}
			$('.message-list .message-item input[type=checkbox]').removeAttr('checked');
			$('.message-list').on('click', '.message-item input[type=checkbox]' , function() {
				$(this).closest('.message-item').toggleClass('selected');
				if(this.checked) Inbox.display_bar(1);//display action toolbar when a message is selected
				else {
					Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
					//determine number of selected messages and display/hide action toolbar accordingly
				}
			});


			//check/uncheck all messages
			$('#id-toggle-all').removeAttr('checked').on('click', function(){
				if(this.checked) {
					Inbox.select_all();
				} else Inbox.select_none();
			});

			//select all
			$('#id-select-message-all').on('click', function(e) {
				e.preventDefault();
				Inbox.select_all();
			});

			//select none
			$('#id-select-message-none').on('click', function(e) {
				e.preventDefault();
				Inbox.select_none();
			});

			//select read
			$('#id-select-message-read').on('click', function(e) {
				e.preventDefault();
				Inbox.select_read();
			});

			//select unread
			$('#id-select-message-unread').on('click', function(e) {
				e.preventDefault();
				Inbox.select_unread();
			});

			/////////

			//display first message in a new area
			$('.message-list .message-item .summary').on('click', function() {
				var index = $(this).parent().index(".message-item");
				var memostatus = $(".message-item:eq("+index+")").hasClass("message-unread");
				var message_list = $(this).closest('.message-list');
				var menu = $(".tab-pane").attr("id");
				myIdMemo = $(".message-item:eq("+index+")").attr("data-id");
				$.ajax({
					url: "memoAction.php",
					type: 'post',
					data: {
						memostatus : $(".message-item:eq("+index+")").hasClass("message-unread"),
						memoid : $(".message-item:eq("+index+")").attr("data-id"),
						action : "Read Memo",
						menu : $(".tab-pane").attr("id")
					},
					beforeSend: function() {
						//show the loading icon
						$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
					},
					success: function (output) {
						var res = output.split("##");
						if(res[0]=="read") {
							document.getElementById("id-message-content").innerHTML = res[1];
							$('.message-inline-open').removeClass('message-inline-open').find('.message-content').remove();

							$('#inbox-tabs a[href="#'+menu+'"]').parent().removeClass('active');
							//some waiting
							setTimeout(function() {
								//hide everything that is after .message-list (which is either .message-content or .message-form)
								message_list.next().addClass('hide');
								$('.message-container').find('.message-loading-overlay').remove();

								//close and remove the inline opened message if any!

								//hide all navbars
								$('.message-navbar').addClass('hide');
								//now show the navbar for single message item
								$('#id-message-item-navbar').removeClass('hide');

								//hide all footers
								$('.message-footer').addClass('hide');
								//now show the alternative footer
								$('.message-footer-style2').removeClass('hide');
								document.getElementById("message-number").innerHTML = index + 1;


								//move .message-content next to .message-list and hide .message-list
								$('.message-content').removeClass('hide').insertAfter(message_list.addClass('hide'));

								//add scrollbars to .message-body
								$('.message-content .message-body').ace_scroll({
									size: 150,
									mouseWheelLock: true,
									styleClass: 'scroll-visible'
								});
								if(memostatus==true && $(".tab-pane").attr("id")!="sent"){
									$('.message-star:eq('+index+')').addClass('light-grey');
									$('.message-item:eq('+index+')').removeClass('message-unread');
								}
								//back to message list
								$('.btn-back-message-list').on('click', function(e) {
									e.preventDefault();
									$('#inbox-tabs a[href="#'+menu+'"]').tab('show');
								});


								$("#single").on('click', function() {
									$.ajax({
										url: "memoAction.php",
										type: 'post',
										async: false,
										beforeSend: function() {
											//show the loading icon
											$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
										},
										data: {
											action : "delete",
											menu : $(".tab-pane").attr("id"),
											status : "inRead",
											idmemo : $(".message-item:eq("+index+")").attr("data-id")
										},
										success: function (output) {
											if(output!="error") {
												setTimeout(function() {
													$('.message-container').find('.message-loading-overlay').remove();
													alert(output);
													if(menu=="inbox"){
														Inbox.show_list();
													}else {
														Inbox.show_listSent();
													}
												}, 500 + parseInt(Math.random() * 500));
											}else {
												alert("Error! Reload this page");
												location.reload();
											}
										},
										error: function () {
											console.log("Try Again");
										}
									});
								});

								$("#replyAction").on('click', function(e) {
									e.preventDefault();
									replyStatus = 1;
									Inbox.show_formReply();
								});
							}, 500 + parseInt(Math.random() * 500));

						}else {
							setTimeout(function() {
								alert("Try Again");
								$('.message-container').find('.message-loading-overlay').remove();
							}, 500 + parseInt(Math.random() * 500));
						}
					},
					error: function () {
						console.log("Try Again");
					}
				});
			});

			// $.ajax({
			// 	url: "memoAction.php",
			// 	type: 'post',
			// 	async: false,
			// 	data: {
			// 		action : "write memo",
			// 		menu : "write"
			// 	},
			// 	success: function (output) {
			// 		if(output!="error") {
			// 			$("#write-message-show").html(output);
			// 		}else {
			// 			alert("Error! Reload this page");
			// 			location.reload();
			// 		}
			// 	},
			// 	error: function () {
			// 		console.log("Try Again");
			// 	}
			// });
		} // end loadMessage

		// load inbox at first time
		$.ajax({
			url: "memoAction.php",
			type: 'post',
			async: false,
			data: {
				action : "inbox list",
				menu : "inbox",
				hal : hal
			},
			success: function (output) {
				if(output!="error") {
					$("#inbox").html(output);
					loadMessage();
					pagination("inbox");
					deleteMemo("inbox");
					markAsRead();
				}else {
					alert("Error! Reload this page");
					location.reload();
				}
			},
			error: function () {
				console.log("Try Again");
			}
		});

		//currentTab
		$('#inbox-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
			var currentTab = $(e.target).data('target');
			console.log(currentTab + " = curent tab");
			if(currentTab == 'write') {
				hal = 1;
				Inbox.show_form();
			}
			else if(currentTab == 'inbox') {
				hal = 1;
				Inbox.show_list();
			}
			else if(currentTab == 'sent') {
				hal = 1;
				Inbox.show_listSent();
			}
		});




		var Inbox = {
			//displays a toolbar according to the number of selected messages
			display_bar : function (count) {
				if(count == 0) {
					$('#id-toggle-all').removeAttr('checked');
					$('#id-message-list-navbar .message-toolbar').addClass('hide');
					$('#id-message-list-navbar .message-infobar').removeClass('hide');
				}
				else {
					$('#id-message-list-navbar .message-infobar').addClass('hide');
					$('#id-message-list-navbar .message-toolbar').removeClass('hide');
				}
			}
			,
			select_all : function() {
				var count = 0;
				$('.message-item input[type=checkbox]').each(function(){
					this.checked = true;
					$(this).closest('.message-item').addClass('selected');
					count++;
				});

				$('#id-toggle-all').get(0).checked = true;

				Inbox.display_bar(count);
			}
			,
			select_none : function() {
				$('.message-item input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
				$('#id-toggle-all').get(0).checked = false;

				Inbox.display_bar(0);
			}
			,
			select_read : function() {
				$('.message-unread input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

				var count = 0;
				$('.message-item:not(.message-unread) input[type=checkbox]').each(function(){
					this.checked = true;
					$(this).closest('.message-item').addClass('selected');
					count++;
				});
				Inbox.display_bar(count);
			}
			,
			select_unread : function() {
				$('.message-item:not(.message-unread) input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');

				var count = 0;
				$('.message-unread input[type=checkbox]').each(function(){
					this.checked = true;
					$(this).closest('.message-item').addClass('selected');
					count++;
				});

				Inbox.display_bar(count);
			}
		}

		//show message list (back from writing mail or reading a message)
		Inbox.show_list = function() {
			$.ajax({
				url: "memoAction.php",
				type: 'post',
				async: false,
				data: {
					action : "inbox list",
					menu : "inbox",
					hal : hal
				},
				beforeSend : function() {
					$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
				},
				success: function (output) {
					if(output!="error") {
						$(".tab-pane").attr("id","inbox");
						$("#inbox").html(output);
						// if ($('#id-message-content').length < 1){
						// 	console.log("masuk");
						// 	$('.message-content').addClass('hide').insertAfter(". message-list");
						// }
						$('.message-container').find('.message-loading-overlay').remove();
						$('.message-navbar').addClass('hide');
						$('#id-message-list-navbar').removeClass('hide');
						$('.message-footer').addClass('hide');
						$('.message-footer:not(.message-footer-style2)').removeClass('hide');

						$('.message-list').removeClass('hide').next().addClass('hide');
						//hide the message item / new message window and go back to list

						loadMessage();
					}else {
						alert("Error! Reload this page");
						location.reload();
					}
				},
				error: function () {
					console.log("Try Again");
				}
			});
			pagination("inbox");
			deleteMemo("inbox");
			markAsRead();
		}

		Inbox.show_listSent = function() {
			$.ajax({
				url: "memoAction.php",
				type: 'post',
				async: false,
				data: {
					action : "sent list",
					menu : "sent",
					hal : hal
				},
				beforeSend : function() {
					$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
				},
				success: function (output) {
					if(output!="error") {
						$(".tab-pane").attr("id","sent");
						$("#sent").html(output);
						// if ($('.message-content').length < 1){
						// 	$('.message-content').addClass('hide').insertAfter(". message-list");
						// }
						$('.message-container').find('.message-loading-overlay').remove();
						$('.message-navbar').addClass('hide');
						$('#id-message-list-navbar').removeClass('hide');
						$('.message-footer').addClass('hide');
						$('.message-footer:not(.message-footer-style2)').removeClass('hide');

						$('.message-list').removeClass('hide').next().addClass('hide');
						//hide the message item / new message window and go back to list

						loadMessage();
					}else {
						alert("Error! Reload this page");
						location.reload();
					}
				},
				error: function () {
					console.log("Try Again");
				}
			});

			pagination("sent");
			deleteMemo("sent");
		}

		//show write mail form
		Inbox.show_form = function() {
			if(replyStatus==1) {
				$('.message-form').remove();
				form_initialized = false;
				replyStatus = 0;
			}
			$.ajax({
				url: "memoAction.php",
				type: 'post',
				async: false,
				data: {
					action : "write memo",
					menu : "write"
				},
				success: function (output) {
					if(output!="error") {
						$("#write-message-show").html(output);
					}else {
						alert("Error! Reload this page");
						location.reload();
					}
				},
				error: function () {
					console.log("Try Again");
				}
			});
			if($('.message-form').is(':visible')) return;
			if(!form_initialized) {
				initialize_form();
			}


			var message = $('.message-list');
			$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

			setTimeout(function() {
				message.next().addClass('hide');
				$('.message-container').find('.message-loading-overlay').remove();

				$('.message-list').addClass('hide');
				$('.message-footer').addClass('hide');
				$('.message-form').removeClass('hide').insertAfter('.message-list');

				$('.message-navbar').addClass('hide');
				$('#id-message-new-navbar').removeClass('hide');
				//reset form??
				$('.message-form .wysiwyg-editor').empty();

				$('.message-form .ace-file-input').closest('.file-input-container:not(:first-child)').remove();
				//$('.message-form input[type=file]').ace_file_input('reset_input');

				$('.message-form').get(0).reset();
			}, 300 + parseInt(Math.random() * 300));

			$('#send').on('click', function(e){
				e.preventDefault();
				var fd = new FormData();
				$.each($("input[type=file]"), function(i, obj) {
			        $.each(obj.files,function(j,file){
			            fd.append('photo[]', file);
			        })
				});

			    var other_data = $('form').serializeArray();
			    $.each(other_data,function(key,input){
			        fd.append(input.name,input.value);
			    });
			    var anchor = $(".wysiwyg-editor a").attr("href");
				console.log(anchor);
				if(anchor){
					if(anchor.indexOf("http")!=-1){
						 $(".wysiwyg-editor a").attr("target","_blank");
					}else {
						$(".wysiwyg-editor a").attr({"href" : "http://"+anchor, "target" :"_blank" });
					}
				}
			    fd.append("action","send memo");
			    fd.append("menu","sent");
			    fd.append("messagetext",$(".wysiwyg-editor").html());
				$.ajax({
					url: "memoAction.php",
					type: 'post',
					async: false,
					data: fd,
					contentType: false,
        			processData: false,
        			beforeSend: function() {
        				$('#fileupload').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
        			},
					success: function (output) {
						setTimeout(function() {
							$('#fileupload').find('.message-loading-overlay').remove();
							alert(output);
							if(output=="Your memo has been sent") {
								location.reload();
							}
						}, 500 + parseInt(Math.random() * 500));

					},
					error: function () {
						console.log("Try Again");
					}
				});
			});
		}


		Inbox.show_formReply = function() {
			replyStatus = 1;
			$.ajax({
				url: "memoAction.php",
				type: 'post',
				async: false,
				data: {
					action : "write memo",
					menu : "reply"
				},
				success: function (output) {
					console.log(output.indexOf("gagal"));
					if(output!="error") {
						$('<div id="reply-message-show">').insertAfter('.message-content');
						$("#reply-message-show").html(output);
					}else {
						alert("Error! Reload this page");
						location.reload();
					}
				},
				error: function () {
					console.log("Try Again");
				}
			});
			if($('.message-form').is(':visible')) return;
			if(!form_initialized) {
				initialize_form();
			}


			var message = $('.message-list');
			$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');

			setTimeout(function() {
				//message.next().addClass('hide');
				$('.message-container').find('.message-loading-overlay').remove();
				$('.message-list').addClass('hide')
				$('.message-form').removeClass('hide');
				$('.message-navbar').addClass('hide');
				$('#id-message-new-navbar').removeClass('hide');
				$("button .bigger-110").html("Reply");
				/*$('.message-list').addClass('hide');
				$('.message-footer').addClass('hide');
				$('.message-form').removeClass('hide').insertAfter('.message-list');

				$('.message-navbar').addClass('hide');
				$('#id-message-new-navbar').removeClass('hide');*/
				//reset form??
				$('.message-form .wysiwyg-editor').empty();

				$('.message-form .ace-file-input').closest('.file-input-container:not(:first-child)').remove();
				//$('.message-form input[type=file]').ace_file_input('reset_input');

				$('.message-form').get(0).reset();
			}, 300 + parseInt(Math.random() * 300));

			$('#send').on('click', function(e){
				e.preventDefault();
				var fd = new FormData();
				$.each($("input[type=file]"), function(i, obj) {
			        $.each(obj.files,function(j,file){
			            fd.append('photo[]', file);
			        })
				});
				fd.append("subject",$("#inbox #subjectMessage").html());
				fd.append("to",$("#inbox .sender").html().replace(" ",""));
			    fd.append("myIdMemo",myIdMemo);
			    fd.append("action","send memo");
			    fd.append("menu","sent");
			    fd.append("oldmessage",$(".message-body .scroll-content").html());
			    fd.append("messagetext",$(".wysiwyg-editor").html());
				$.ajax({
					url: "memoAction.php",
					type: 'post',
					async: false,
					data: fd,
					contentType: false,
        			processData: false,
        			beforeSend: function() {
        				$('#fileupload').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
        			},
					success: function (output) {
						setTimeout(function() {
							$('#fileupload').find('.message-loading-overlay').remove();
							alert(output);
							if(output=="Your memo has been sent") {
								location.reload();
							}
						}, 500 + parseInt(Math.random() * 500));

					},
					error: function () {
						console.log("Try Again");
					}
				});
			});
		}

		var form_initialized = false;
		function initialize_form() {
			if(form_initialized) return;
			form_initialized = true;

			//intialize wysiwyg editor
			$('.message-form .wysiwyg-editor').ace_wysiwyg({
				toolbar:
				[
					'font',
					null,
					'fontSize',
					null,
					{name:'bold', className:'btn-info'},
					{name:'italic', className:'btn-info'},
					{name:'strikethrough', className:'btn-info'},
					{name:'underline', className:'btn-info'},
					null,
					{name:'justifyleft', className:'btn-primary'},
					{name:'justifycenter', className:'btn-primary'},
					{name:'justifyright', className:'btn-primary'},
					null,
					{name:'createLink', className:'btn-pink'},
					{name:'unlink', className:'btn-pink'},
					null,
					'foreColor',
					null,
					{name:'undo', className:'btn-grey'},
					{name:'redo', className:'btn-grey'}
				],
			}).prev().addClass('wysiwyg-style2');



			//file input
			$('.message-form input[type=file]').ace_file_input()
			.closest('.ace-file-input')
			.addClass('width-90 inline')
			.wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>');

			//Add Attachment
			//the button to add a new file input
			$('#id-add-attachment')
			.on('click', function(){
				var total=$("#form-attachments").find('input[name="attachment[]"]').length;
				if(total > 2){
					$("#id-add-attachment").attr("disabled","disabled");
					alert("Maximal hanya 3 attachment");
					return false;
				}
				var file = $('<input type="file" name="attachment[]" accept="image/*" />').appendTo('#form-attachments');
				file.ace_file_input();

				file.closest('.ace-file-input')
				.addClass('width-90 inline')
				.wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>')
				.parent().append('<div class="action-buttons pull-right col-xs-1">\
					<a href="#" data-action="delete" class="middle">\
						<i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>\
					</a>\
				</div>')
				.find('a[data-action=delete]').on('click', function(e){
					//the button that removes the newly inserted file input
					e.preventDefault();
					if(total < 3) {
						$("#id-add-attachment").removeAttr("disabled");
					}
					$(this).closest('.file-input-container').hide(300, function(){ $(this).remove() });
				});
			});
		} //initialize_form

		//turn the recipient field into a tag input field!
		/**
		var tag_input = $('#form-field-recipient');
		try {
			tag_input.tag({placeholder:tag_input.attr('placeholder')});
		} catch(e) {}


		//and add form reset functionality
		$('#fileupload').on('reset', function(){
			$('.message-form .message-body').empty();

			$('.message-form .ace-file-input:not(:first-child)').remove();
			$('.message-form input[type=file]').ace_file_input('reset_input_ui');

			var val = tag_input.data('value');
			tag_input.parent().find('.tag').remove();
			$(val.split(',')).each(function(k,v){
				tag_input.before('<span class="tag">'+v+'<button class="close" type="button">&times;</button></span>');
			});
		});
		*/


		/*display second message right inside the message list
		$('.message-list .message-item:eq(1) .text').on('click', function(){
			var message = $(this).closest('.message-item');

			//if message is open, then close it
			if(message.hasClass('message-inline-open')) {
				message.removeClass('message-inline-open').find('.message-content').remove();
				return;
			}

			$('.message-container').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
			setTimeout(function() {
				$('.message-container').find('.message-loading-overlay').remove();
				message
					.addClass('message-inline-open')
					.append('<div class="message-content" />')
				var content = message.find('.message-content:last').html( $('#id-message-content').html() );

				//remove scrollbar elements
				content.find('.scroll-track').remove();
				content.find('.scroll-content').children().unwrap();

				content.find('.message-body').ace_scroll({
					size: 150,
					mouseWheelLock: true,
					styleClass: 'scroll-visible'
				});

			}, 500 + parseInt(Math.random() * 500));

		});*/



		//hide message list and display new message form
		// $('.btn-new-mail').on('click', function(e){
		// 	e.preventDefault();
		// 	Inbox.show_form();
		// });


	});

	$(".wysiwyg-editor").attr("id","wysiwyg-editor");
	function emoticon(html) {
	    var sel, range;
	    $(".wysiwyg-editor").focus();
	    if (window.getSelection) {
	        // IE9 and non-IE
	        sel = window.getSelection();
	        if (sel.getRangeAt && sel.rangeCount) {
	            range = sel.getRangeAt(0);
	            //range.deleteContents();

	            // Range.createContextualFragment() would be useful here but is
	            // non-standard and not supported in all browsers (IE9, for one)
	            var el = document.createElement("div");
	            el.innerHTML = " " + html + " ";
	            var frag = document.createDocumentFragment(), node, lastNode;
	            while ( (node = el.firstChild) ) {
	                lastNode = frag.appendChild(node);
	            }
	            range.insertNode(frag);
	            
	            // Preserve the selection
	            if (lastNode) {
	                range = range.cloneRange();
	                range.setStartAfter(lastNode);
	                range.collapse(true);
	                sel.removeAllRanges();
	                sel.addRange(range);
	            }
	        }
	    } else if (document.selection && document.selection.type != "Control") {
	        // IE < 9
	        document.selection.createRange().pasteHTML(html);
	    }
	}

	function storeCaret(textEl) {
		if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
	}
</script>
