<?php
include("meta.php");
require 'vendor/autoload.php'; 

use Aws\S3\S3Client; 

$minUserLevel = 2;
//include("fc/fungsi_memo.php");

list($sel,$sar,$pasar,$kelar,$list,$kod,$pen1,$pen2,$pen3,$pen4,$pen5,$pen6,$pen7,$pen8,$pen9,$pen10,$pen11,$pen12,$pen13,$pen14,$pen15,$pen16,$pen17,$pen18,$pen19,$pen20,$pen91,$pen92,$pen93,$pen94,$pen95,$pen96,$pen97,$pen98,$pen99,$pas1,$pas2,$pas3,$pas4,$pas5,$pas6,$pas7,$pas8,$pas9,$pas10,$pas11,$pas12,$pas13,$pas14,$pas15,$pas16,$pas17,$pas18,$pas19,$pas20,$pas91,$pas92,$pas93,$pas94,$pas95,$pas96,$pas97,$pas98,$pas99) = setpasar();
$memostatus = $_POST["memostatus"];
$id = decodedvc($_POST["memoid"]);
$action = $_POST["action"];
$menu = $_POST["menu"];
$hal = $_POST["hal"];

$dir = substr($login,0,1);
//$myAvatar = mysqli_result1(mysqli_query($mysqli1,"select avatar from tgusers2 where user='".$login."'"),0);
$target_dir = $avatarlink.$linkimages."/avatar/".ucwords($dir)."/";
$dt = date("Y m d H i s");
$repdt = str_replace(" ","",$dt);
if ($action=="Read Memo") {
	$toread = mysqli_fetch_array(mysqli_query($mysqli1,"select `from`,`to` from memo where id='$id' and (`from`='$login' or `to`='$login') and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')"));
	$data = @mysqli_fetch_array(mysqli_query($mysqli1,"SELECT * from `memo` where `id`='$id' and `from`='".$toread["from"]."' and `to`='".$toread["to"]."' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')"));
	if($menu!="sent") {
		if ($memostatus=="true") {
			mysqli_query($mysqli1,"UPDATE `memo` set `read`=1 where `id`='$id'");
			if(mysqli_affected_rows($mysqli1)) {
				echo "read##";
				$a = 1;
			}else {
				echo "error##error";
				$a = 0;
			}
		}else {
			echo "read##";
			$a = 1;
		}
		
	}else {
		echo "read##";
		$a = 1;
	}

	if($a==1) { ?>
		<div class="message-header clearfix">
			<div class="pull-left">
				<span class="blue bigger-125" id="subjectMessage"> <?php echo $data["subject"]; ?> </span>

				<div class="space-4"></div>

				<i class="ace-icon fa fa-star <?php echo $memostatus=='true' ? 'orange2' : 'light-grey'; ?>"></i>
				<?php if ($data["read"] >1) {
					echo "<a class=\"sender\" href=\"#\">Sent to: ".$data["from"]."</a>";
				}else { ?>
					<a class="sender" href="#">
						<?php if($pas12 and $data["from"]==$login) { ?>	
							<img width="32" src="<?php echo $target_dir.$login;?>.jpg?<?php echo $repdt; ?>" alt="<?php echo $login; ?>'s Avatar" class="middle">
							&nbsp;
						<?php } ?>
						<?php echo $data["from"]; ?>
					</a>
				<?php } ?>
				&nbsp;
				<i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
				<span class="time grey"><?php echo $data["date"]; ?></span>
			</div>

			<div class="pull-right action-buttons">
			<?php if($menu!="sent") { ?>
				<a data-target="writeReply" href="#writeReply" data-toggle="tab" id="replyAction" title="Reply" >
					<i class="ace-icon fa fa-reply green icon-only bigger-130"></i> Reply
				</a>
			<?php } ?>
				<a href="#" title="Delete" id="single">
					<i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i> Delete
				</a>
			</div>
		</div>

		<div class="hr hr-double"></div>

		<div class="message-body">
			<?php
			include("smile.php");
			$abc=render_smileys($data["body"]);
			$abc=str_replace('\r\n',"<br>",$abc);
			echo $abc;
			?>
		</div>
		<?php if($data["img"]!="-" and $data["img"]!="0" and $data["img"]!="") { ?>
			<div class="hr hr-double"></div>

			<div class="message-attachment clearfix">
				<!--<div class="attachment-title">
					<span class="blue bolder bigger-110">Attachments</span>
					&nbsp;
					<span class="grey">(2 files, 4.5 MB)</span>

					<div class="inline position-relative">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							&nbsp;
							<i class="ace-icon fa fa-caret-down bigger-125 middle"></i>
						</a>

						<ul class="dropdown-menu dropdown-lighter">
							<li>
								<a href="#">Download all as zip</a>
							</li>

							<li>
								<a href="#">Display in slideshow</a>
							</li>
						</ul>
					</div>
				</div>

				&nbsp;
				<ul class="attachment-list pull-left list-unstyled">
					<li>
						<a class="attached-file" href="#">
							<i class="ace-icon fa fa-file-o bigger-110"></i>
							<span class="attached-name">Document1.pdf</span>
						</a>

						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-download bigger-125 blue"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-trash-o bigger-125 red"></i>
							</a>
						</span>
					</li>

					<li>
						<a class="attached-file" href="#">
							<i class="ace-icon fa fa-film bigger-110"></i>
							<span class="attached-name">Sample.mp4</span>
						</a>

						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-download bigger-125 blue"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-trash-o bigger-125 red"></i>
							</a>
						</span>
					</li>
				</ul> -->

				<div class="attachment-images pull-left">
					<div class="vspace-4-sm"></div>
					<div id="links">
						<?php 
						$imgexp = explode(",", $data["img"]);
						foreach($imgexp as $finalimages => $value) {
							$finalimages++;
							echo '<a  style="float: left; margin: 0;" class="thumbnail" data-gallery="" href="'.$s3MemoUrl.$value.'" title="Images-'.$finalimages.'"><img src="'.$s3MemoUrl.$value.'" alt="Images -'.$finalimages.'" class="img-responsive"></a>';
						}
						?>
					</div>
					<div id="blueimp-gallery" class="blueimp-gallery">
					    <!-- The container for the modal slides -->
					    <div class="slides"></div>
					    <!-- Controls for the borderless lightbox -->
					    <h3 class="title"></h3>
					    <a class="prev">‹</a>
					    <a class="next">›</a>
					    <a class="close">×</a>
					    <a class="play-pause"></a>
					    <ol class="indicator"></ol>
					    <!-- The modal dialog, which will be used to wrap the lightbox content -->
					    <div class="modal fade">
					        <div class="modal-dialog modal-lg">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <button type="button" class="close" aria-hidden="true">&times;</button>
					                    <h4 class="modal-title"></h4>
					                </div>
					                <div class="modal-body next"></div>
					                <div class="modal-footer">
					                    <button type="button" class="btn btn-default pull-left prev">
					                        <i class="glyphicon glyphicon-chevron-left"></i>
					                        Previous
					                    </button>
					                    <button type="button" class="btn btn-primary next">
					                        Next
					                        <i class="glyphicon glyphicon-chevron-right"></i>
					                    </button>
					                </div>
					            </div>
					        </div>
					    </div>
					</div>
				</div>
			</div>
		<?php
		}
	}
}else if($action=="inbox list"){
	$mem=@mysqli_result1(mysqli_query($mysqli1,"select count(`id`) from `memo` where `read`=0 and `to`='$login' and `status`='-' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')"),0);
	?>
	<div class="message-container">
		<div class="message-navbar clearfix" id="id-message-list-navbar">
			<div class="message-bar">
				<div id="id-message-infobar" class="message-infobar">
					<span class="blue bigger-150">Inbox</span>
					<span class="grey bigger-110">(<?php echo $mem; ?> unread messages)</span>
				</div>

				<div class="message-toolbar hide">
					<div class="inline position-relative align-left" id="markasread">
						<button class="btn-white btn-primary btn btn-xs dropdown-toggle" type="button">
							<span class="bigger-110"><i class="ace-icon fa fa-eye blue"></i>&nbsp; Mark as read</span>
						</button>
					</div>

					<button class="btn btn-xs btn-white btn-primary" id="multiple" type="button">
						<i class="ace-icon fa fa-trash-o bigger-125 orange"></i>
						<span class="bigger-110">Delete</span>
					</button>
				</div>
			</div>

			<div>
				<div class="messagebar-item-left">
					<label class="inline middle">
						<input type="checkbox" class="ace" id="id-toggle-all">
						<span class="lbl"></span>
					</label>

					&nbsp;
					<div class="inline position-relative">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="ace-icon fa fa-caret-down bigger-125 middle"></i>
						</a>

						<ul class="dropdown-menu dropdown-lighter dropdown-100">
							<li>
								<a href="#" id="id-select-message-all">All</a>
							</li>

							<li>
								<a href="#" id="id-select-message-none">None</a>
							</li>

							<li class="divider"></li>
							<li>
								<a id="id-select-message-unread" href="#">Unread</a>
							</li>
							<li>
								<a href="#" id="id-select-message-read">Read</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="hide message-navbar clearfix" id="id-message-item-navbar">
			<div class="message-bar">
			</div>

			<div>
				<div class="messagebar-item-left">
					<a class="btn-back-message-list" href="#">
						<i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
						<b class="bigger-110 middle">Back</b>
					</a>
				</div>
			</div>
		</div>

		<div class="message-list-container">
			<div id="message-list" class="message-list">
				<?php
				if(!$hal) $hal=1;
				$length = 15;
				$batas = ($hal -1) * $length;
				$sql = mysqli_query($mysqli1,"SELECT * FROM `memo` where `to`='$login' and `read` < 2 and `status`='-' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')  ORDER BY `date` DESC LIMIT $batas,$length");
				$sql2 = mysqli_query($mysqli1,"SELECT * FROM `memo` where `to`='$login' and `read` < 2 and `status`='-' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')  ORDER BY `date` DESC ");
				$ada=@mysqli_num_rows($sql);
				$rowtmp = @mysqli_num_rows($sql2);

				$jml = $rowtmp;
				$kel = $jml/$length;

				if ($kel == floor($jml/$length * -1)) {$page=$kel;}
				else {$page = floor($jml/$length * -1);}
				$page = $page * -1;
				$pct = 100/($page+4);
				for ($i=0;$i<@mysqli_num_rows($sql);$i++) { 
					$data = @mysqli_fetch_array($sql);
					$unread = "";
					if ($data["read"] == 0) {
						$unread = " message-unread";
						$star = "orange2";
					}else {
						$star = "light-grey";
					}
					$checkImg = $data["img"];
					?>
					<div class="message-item<?php echo $unread; ?>" data-id='<?php echo codedvc($data["id"]); ?>' style="cursor: pointer;">
						<label class="inline">
							<input type="checkbox" class="ace">
							<span class="lbl"></span>
						</label>
						<i class="message-star ace-icon fa fa-star <?php echo $star; ?>"></i>
						<span title="<?php echo $data["from"]; ?>" class="sender"><?php echo $data["from"]; ?> </span>
						<span class="time"><?php echo $data["date"]; ?></span>
						<?php if($checkImg!="-" and $checkImg!="" and $checkImg!="0") { ?>
							<span class="attachment">
								<i class="ace-icon fa fa-paperclip"></i>
							</span>
						<?php } ?>

						<span class="summary">
							<span class="text">
								<?php if($data["subject"]=="") { echo "No Subject"; } else { echo $data["subject"]; } ?>
							</span>
						</span>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="message-footer clearfix">
			<div class="pull-left"> <?php echo $ada; ?> messages total </div>
			<?php
			if($page==0){
			}
			else{
				$a=$hal+9;
				$lebar = $pct*2;
				$prev = $hal-1;
				$next = $hal+1;
				$first= 1;
				$last= $page;
				?>
				<div class="pull-right">
					<div class="inline middle"> page <?php echo $hal; ?> of <?php echo $page; ?> </div>
					&nbsp; &nbsp;
					<ul class="pagination middle">
					<?php
					if ($hal != 1) {
						$linkfirst = "<a href='#inbox' data-target='#inbox' data-id='$first'><span><i class=\"ace-icon fa fa-step-backward middle\"></i></span></a>";
						$linkprev = "<a href='#inbox' data-target='#inbox' data-id='$prev'><span><i class=\"ace-icon fa fa-caret-left bigger-140 middle\"></i></span></a>";
					}else {
						$linkfirst = "<span><i class=\"ace-icon fa fa-step-backward middle\"></i></span>";
						$linkprev = "<span><i class=\"ace-icon fa fa-caret-left bigger-140 middle\"></i></span>";		
					}

					if ($hal != $page) {
						$linknext = "<a href='#inbox' data-target='#inbox' data-id='$next'><span><i class=\"ace-icon fa fa-caret-right bigger-140 middle\"></i></span></a>";
						$linklast = "<a href='#inbox' data-target='#inbox' data-id='$last'><span><i class=\"ace-icon fa fa-step-forward middle\"></i></span></a>";
					}else {
						$linknext = "<span><i class=\"ace-icon fa fa-caret-right bigger-140 middle\"></i></span>";
						$linklast = "<span><i class=\"ace-icon fa fa-step-forward middle\"></i></span>";
					}
					?>
						<li>
							<?php echo $linkfirst; ?>
						</li>

						<li>
							<?php echo $linkprev; ?>
						</li>

						<li>
							<?php echo $linknext; ?>
						</li>

						<li>
							<?php echo $linklast; ?>
						</li>
					</ul>
				</div>
			<?php } ?>
		</div>

		<div class="hide message-footer message-footer-style2 clearfix">
			<div class="pull-left"> Inbox </div>

			<div class="pull-right">
				<div class="inline middle"> message <span id="message-number">-</span> of <?php echo $rowtmp; ?> </div>

				<!-- &nbsp; &nbsp;
				<ul class="pagination middle">
					<li class="disabled">
						<span>
							<i class="ace-icon fa fa-angle-left bigger-150"></i>
						</span>
					</li>

					<li>
						<a href="#">
							<i class="ace-icon fa fa-angle-right bigger-150"></i>
						</a>
					</li>
				</ul> -->
			</div>
		</div>
	</div>
	<?php
}else if($action=="sent list") { ?>
	<div class="message-container">
		<div class="message-navbar clearfix" id="id-message-list-navbar">
			<div class="message-bar">
				<div id="id-message-infobar" class="message-infobar">
					<span class="blue bigger-150">Sent List</span>
				</div>

				<div class="message-toolbar hide">
					<button class="btn btn-xs btn-white btn-primary" id="multiple" type="button">
						<i class="ace-icon fa fa-trash-o bigger-125 orange"></i>
						<span class="bigger-110">Delete</span>
					</button>
				</div>
			</div>

			<div>
				<div class="messagebar-item-left">
					<label class="inline middle">
						<input type="checkbox" class="ace" id="id-toggle-all">
						<span class="lbl"></span>
					</label>

					&nbsp;
					<div class="inline position-relative">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="ace-icon fa fa-caret-down bigger-125 middle"></i>
						</a>

						<ul class="dropdown-menu dropdown-lighter dropdown-100">
							<li>
								<a href="#" id="id-select-message-all">All</a>
							</li>

							<li>
								<a href="#" id="id-select-message-none">None</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="hide message-navbar clearfix" id="id-message-item-navbar">
			<div class="message-bar">
			</div>

			<div>
				<div class="messagebar-item-left">
					<a class="btn-back-message-list" href="#">
						<i class="ace-icon fa fa-arrow-left blue bigger-110 middle"></i>
						<b class="bigger-110 middle">Back</b>
					</a>
				</div>
			</div>
		</div>

		<div class="message-list-container">
			<div id="message-list" class="message-list">
				<?php
				if(!$hal) $hal=1;
				$length = 15;
				$batas = ($hal -1) * $length;
				$sql = mysqli_query($mysqli1,"SELECT * FROM `memo` where `from`='$login' and `status`!='1' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%') ORDER BY `date` DESC LIMIT $batas,$length");
				$sql2 = mysqli_query($mysqli1,"SELECT * FROM `memo` where `from`='$login' and `status`!='1' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%') ORDER BY `date` DESC ");
				$ada=@mysqli_num_rows($sql);
				$rowtmp = @mysqli_num_rows($sql2);

				$jml = $rowtmp;
				$kel = $jml/$length;

				if ($kel == floor($jml/$length * -1)) {$page=$kel;}
				else {$page = floor($jml/$length * -1);}
				$page = $page * -1;
				$pct = 100/($page+4);
				for ($i=0;$i<@mysqli_num_rows($sql);$i++) { 
					$data = @mysqli_fetch_array($sql);
					$unread = "";
					$star = "light-grey";
					$checkImg = $data["img"];
					?>
					<div class="message-item<?php echo $unread; ?>" data-id='<?php echo codedvc($data["id"]); ?>' style="cursor: pointer;">
						<label class="inline">
							<input type="checkbox" class="ace">
							<span class="lbl"></span>
						</label>
						<i class="message-star ace-icon fa fa-star <?php echo $star; ?>"></i>
						<span title="<?php echo $data["from"]; ?>" class="sender"><?php echo $data["from"]; ?> </span>
						<span class="time"><?php echo $data["date"]; ?></span>

						<?php if($checkImg!="-" and $checkImg!="0" and $checkImg!="") { ?>
							<span class="attachment">
								<i class="ace-icon fa fa-paperclip"></i>
							</span>
						<?php } ?>

						<span class="summary">
							<span class="text">
								<?php if($data["subject"]=="") { echo "No Subject"; } else { echo $data["subject"]; } ?>
							</span>
						</span>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="message-footer clearfix">
			<div class="pull-left"> <?php echo $ada; ?> messages total </div>
			<?php
			if($page==0){
			}
			else{
				$a=$hal+9;
				$lebar = $pct*2;
				$prev = $hal-1;
				$next = $hal+1;
				$first= 1;
				$last= $page;
				?>
				<div class="pull-right">
					<div class="inline middle"> page <?php echo $hal; ?> of <?php echo $page; ?> </div>
					&nbsp; &nbsp;
					<ul class="pagination middle">
					<?php
					if ($hal != 1) {
						$linkfirst = "<a href='#sent' data-target='#sent' data-id='$first'><span><i class=\"ace-icon fa fa-step-backward middle\"></i></span></a>";
						$linkprev = "<a href='#sent' data-target='#sent' data-id='$prev'><span><i class=\"ace-icon fa fa-caret-left bigger-140 middle\"></i></span></a>";
					}else {
						$linkfirst = "<span><i class=\"ace-icon fa fa-step-backward middle\"></i></span>";
						$linkprev = "<span><i class=\"ace-icon fa fa-caret-left bigger-140 middle\"></i></span>";		
					}

					if ($hal != $page) {
						$linknext = "<a href='#sent' data-target='#sent' data-id='$next'><span><i class=\"ace-icon fa fa-caret-right bigger-140 middle\"></i></span></a>";
						$linklast = "<a href='#sent' data-target='#sent' data-id='$last'><span><i class=\"ace-icon fa fa-step-forward middle\"></i></span></a>";
					}else {
						$linknext = "<span><i class=\"ace-icon fa fa-caret-right bigger-140 middle\"></i></span>";
						$linklast = "<span><i class=\"ace-icon fa fa-step-forward middle\"></i></span>";
					}
					?>
						<li>
							<?php echo $linkfirst; ?>
						</li>

						<li>
							<?php echo $linkprev; ?>
						</li>

						<li>
							<?php echo $linknext; ?>
						</li>

						<li>
							<?php echo $linklast; ?>
						</li>
					</ul>
				</div>
			<?php } ?>
		</div>

		<div class="hide message-footer message-footer-style2 clearfix">
			<div class="pull-left"> Sent Box </div>

			<div class="pull-right">
				<div class="inline middle"> message <span id="message-number">-</span> of <?php echo $rowtmp; ?> </div>

				<!-- &nbsp; &nbsp;
				<ul class="pagination middle">
					<li class="disabled">
						<span>
							<i class="ace-icon fa fa-angle-left bigger-150"></i>
						</span>
					</li>

					<li>
						<a href="#">
							<i class="ace-icon fa fa-angle-right bigger-150"></i>
						</a>
					</li>
				</ul> -->
			</div>
		</div>
	</div>
	<?php	
}else if($action=="write memo") { ?>
	<form class="hide form-horizontal message-form col-xs-12" id="fileupload" enctype="multipart/form-data" method="POST">
		<div>
			<?php if($menu!="reply") { ?>
				<div class="form-group no-margin-bottom">
					<label for="form-field-subject" class="col-sm-3 control-label no-padding-right">Subject</label>
					<div class="col-sm-6 col-xs-12">
						<div class="input-icon block col-xs-12 no-padding">
							<i class="ace-icon fa fa-comment-o"></i>
							<input type="text" placeholder='Title' id="form-field-subject" name="subject" class="col-xs-12" maxlength="100" autocomplete="off">

							<?php
							if (userlevel($login)==2) {
							echo "<select name=subjsel id=\"subjectSelect\" class=\"form-control\">
									<option value=1>Masalah Umum</option>
									<option value=2>Masalah Teknis</option>
									<option value=3>Masalah keuangan</option>
									<option value=4>Others...</option>
								</select>";
							}
							?>
							
						</div>
					</div>
				</div>

				<!-- <div class="hr hr-18 dotted"></div> -->


				<div class="form-group no-margin-bottom">
					<label for="form-field-recipient" class="col-sm-3 control-label no-padding-right">To</label>

					<div class="col-sm-9">
						<span class="input-icon">
							<?php echo $login;
							if ($data["from"]) echo "<input type=hidden name=to value=".$data["from"].">".$data["from"];
							else echo "<input type=hidden name=to value=admin> Support"; ?>
						</span>
					</div>
				</div>
			<?php } ?>

			<!-- <div class="hr hr-18 dotted"></div> -->

			<div class="form-group no-margin-bottom">
				<label class="col-sm-3 control-label no-padding-right">
					<span class="inline space-24 hidden-480"></span>
					Message:
				</label>
				<div class="col-sm-9">
					<div class="smiley" style="z-index: 999; position:absolute; left: -39px;">
						 <div class="btn-group">  
						 	<div class="dropdown dropdown-colorpicker open dropup">		
						 		<a title="" data-toggle="dropdown" class="btn btn-sm btn-default dropdown-toggle" data-original-title="smiley">
						 			<i class=" ace-icon fa fa-smile-o"></i>
						 			<i class=" ace-icon fa fa-angle-down icon-on-right"></i>
						 		</a>
						 		<ul class="dropdown-menu dropdown-caret dropdown-menu-right"> 
							 		<?php
									$abc=mysqli_query($mysqli1,"select * from `smile`");
									while($zz=mysqli_fetch_array($abc)){
										echo "<li><a href=\"javascript:emoticon('$zz[kode]')\" style='padding: 0 2px;'><IMG SRC='smiles/$zz[url]' WIDTH='15' HEIGHT='15' BORDER=0 ALT='$zz[name]'></a></li>";
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="wysiwyg-editor"></div>
				</div>
			</div>

			<!-- <div class="hr hr-18 dotted"></div> -->

			<div class="form-group no-margin-bottom">
				<label class="col-sm-3 control-label no-padding-right">Attachments:</label>

				<div class="col-sm-9">
					<div id="form-attachments">
						<input type="file" name="attachment[]" accept="image/*">
					</div>
				</div>
			</div>

			<div class="align-right">
				<button class="btn btn-sm btn-danger" type="button" id="id-add-attachment">
					<i class="ace-icon fa fa-paperclip bigger-140"></i>
					Add Attachment
				</button>
			</div>
			<?php
			/*$avatarlink = "http://www.tgmandiri.inn/";
			$url = $avatarlink."memo/upload2.php?login=$login";
		    //$postfields = array("login" => $login, "action" => "defaultAvatar");
		    $ch = curl_init();
		    $options = array(
		        CURLOPT_URL => $url,
		        //CURLOPT_POST => 1,
		        //CURLOPT_POSTFIELDS => $postfields,
		        CURLOPT_RETURNTRANSFER => true
		    ); // cURL options
		    curl_setopt_array($ch, $options);
		    curl_exec($ch);
		    $output = curl_exec($ch);
		    curl_close($ch);
		    echo $output;*/
			?>
			<div class="space"></div>
		</div>
		<div class="hide message-navbar clearfix" id="id-message-new-navbar">
			<div class="message-bar"></div>

			<div>
				<div class="messagebar-item-right">
					<span class="inline btn-send-message">
						<button class="btn btn-sm btn-primary no-border btn-white btn-round" type="button" id="send">
							<span class="bigger-110">Kirim Memo</span>

							<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
	</form>
<?php }else if($action=="delete") {
	if($_POST["status"]=="inRead"){
		$idmemo = decodedvc($_POST["idmemo"]);
		mysqli_query($mysqli1,"update memo set `delete_status`=CONCAT(replace(delete_status,'-',''),'$login',',') where id='".$idmemo."' and (`from`='$login' or `to`='$login') and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')");
		if(mysqli_affected_rows($mysqli1) < 1){
			echo "Gagal Delete Memo.";
		}else {
			echo " Sukses Delete Memo.";
		}
	}else {
		$arrayRes = array();
		$idmemo = array_unique($_POST["idmemo"]);
		for($a=0;$a<count($idmemo);$a++){
			$realid = decodedvc($idmemo[$a]);
			if ($_POST["menu"]=="inbox") { $addRead = ",`read`='1'"; } else { $addRead = ""; }
			mysqli_query($mysqli1,"update memo set `delete_status`=CONCAT(replace(delete_status,'-',''),'$login',',')".$addRead." where id='".$realid."' and (`from`='$login' or `to`='$login') and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')");
			$arrayRes[] = mysqli_affected_rows($mysqli1);
		}

		$counts = array_count_values($arrayRes);
		if($counts["0"] > 0) echo $counts["0"]." memo gagal didelete. coba lagi.<br>";
		if($counts["1"] > 0) echo $counts["1"]." memo berhasil didelete.<br>";
	}

}else if($action=="allRead") {
	$idmemo = array_unique($_POST["idmemo"]);
	for($a=0;$a<count($idmemo);$a++){
		$realid = decodedvc($idmemo[$a]);
		mysqli_query($mysqli1,"update memo set `read`='1' where id='".$realid."' and `to`='$login' and `status`='-'");
	}

}else if($action=="send memo"){
	function randThis($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        $slice = array_slice($numbers, 0, $quantity);
        $result = "";
        foreach ($slice as $slices) {
            $result .= $slices;
        }
        return $result;
    }
    function replace_extension($filename, $new_extension) {
		$info = pathinfo($filename);
		return $info['filename'] . '.' . $new_extension;
	}

	$subject = $_POST["subject"];
	$subjsel = $_POST["subjsel"];
	$body = $_POST["messagetext"];
	$to = $_POST["to"];
	$oldmessage = $_POST["oldmessage"];
	$myIdMemo = decodedvc($_POST["myIdMemo"]);

	$data = @mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `body` from `memo` where `id`='$myIdMemo' and `from`='".$to."' and `to`='".$login."' and (delete_status not like '$login,%' and delete_status not like '%,$login' and delete_status not like '%,$login,%')"));
	if(!$body) {
		echo "Silahkan isi Pesan yang ingin anda kirim";
	}else {
		$dataImg = array();

		$s3 = new S3Client([ 
            'version' => $version, 
            'region'  => $region, 
            'credentials' => [ 
                'key'    => $access_key_id, 
                'secret' => $secret_access_key, 
            ] 
        ]);

		for ($zc = 0; $zc < count($_FILES['photo']["name"]); $zc++) {
			$target_file = basename($_FILES["photo"]["name"][$zc]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			$errmsg = "";
			if(!basename($_FILES["photo"]["name"][$zc])) {
				$errmsg .= "Choose Your Images##";
				$uploadOk = 0;
			}else {
				$check = @getimagesize($_FILES["photo"]["tmp_name"][$zc]);
				if($check !== false) {
					//$errmsg = "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errmsg .= "File is not an image.##";
					$uploadOk = 0;
				}
				// Check if file already exists
				//if (file_exists($target_file)) {
					//$errmsg = "Sorry, file already exists.";
					//$uploadOk = 0;
				//}
				// Check file size
				$maxfilesize = 1024*2000;
				if ($_FILES["photo"]["size"][$zc] > $maxfilesize) {
					$errmsg .= "Sorry, your file is too large.##";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if (!in_array(strtolower($imageFileType), ["jpg", "jpeg", "png", "gif"])) {
					$errmsg .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.##";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					$errmsg .= "Sorry, your file was not uploaded. Silahkan Coba lagi.##";
				// if everything is ok, try to upload file
				} else {
					$temp = explode(".", $_FILES["photo"]["name"][$zc]);
					$newfilename = replace_extension($login.'-'.randThis(0,9,6). '.' . end($temp),"jpg");
					$realImg = $_FILES["photo"]["tmp_name"][$zc];
					$filesize = $_FILES['photo']['size'][$zc];
					$file_upload_path = $s3path.'/images/memo/'.$newfilename;

					try { 
	                    $result = $s3->putObject([ 
	                        'Bucket' => $bucket, 
	                        'Key'    => $file_upload_path, 
	                        'ACL'    => 'public-read', 
	                        'SourceFile' => $realImg,
	                        'ContentType' => "image/jpg"
	                    ]); 
	                    $result_arr = $result->toArray();

	                    if(!empty($result_arr['ObjectURL'])) { 
	                        $s3_file_link = $result_arr['ObjectURL']; 
	                        $dataImg[] = $newfilename;
	                    } else { 
	                        $api_error = 'Upload Failed! S3 Object URL not found.'; 
	                    } 
	                } catch (Aws\S3\Exception\S3Exception $e) { 
	                    $api_error = $e->getMessage(); 
	                }
				}
			}
		}
		if ($api_error) {
			echo "Error Upload Images";
			// echo $api_error;
		} elseif($errmsg!="" and count($_FILES['photo']["name"]) > 0){
			echo $errmsg;
		}else {
			$insertDataImg = implode(",", $dataImg);
			if ($subjsel) {
				if (($subjsel == 4) or ($subjsel == "4")) {
					$player =  mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `memo_other` FROM `configuration` "));
					$jum = explode(",",$player["memo_other"]);
					$asli = $player["memo_other"];
					$subject = "[Masalah Lainnya] - ".$subject;
				}
				if (($subjsel == 1) or ($subjsel == "1")) {
					$player =  mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `memo_umum` FROM `configuration` "));
					$jum = explode(",",$player["memo_umum"]);
					$asli = $player["memo_umum"];
					$subject = "[Masalah Umum] - ".$subject;
				}
				if (($subjsel == 2) or ($subjsel == "2")) {
					$player =  mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `memo_teknis` FROM `configuration` "));
					$jum = explode(",",$player["memo_teknis"]);
					$asli = $player["memo_teknis"];
					$subject = "[Masalah Teknis] - ".$subject;
				}
				if (($subjsel == 3) or ($subjsel == "3")) {
					$player = mysqli_fetch_array(mysqli_query($mysqli1,"SELECT `memo_uang` FROM `configuration` "));
					$jum = explode(",",$player["memo_uang"]);
					$asli = $player["memo_uang"];
					$subject = "[Masalah Keuangan] - ".$subject;
				}
				/*for ($i = 0; $i < count($jum); $i++){
					$tosql =  mysqli_query($mysqli1,"SELECT * FROM `tgusers` where `user`=$jum and `userlevel` > '2'");
				
					if ($i==0) $tostring = $todata["user"];
					else $tostring .= ", ".$todata["user"];
				}*/
				//for ($i = 0; $i < count($jum); $i++){
				$bodyFinal = str_replace('\"','"',$body);
				memo(",".$asli.",",$login,$subject,$bodyFinal,$insertDataImg);
					//$to++;
				//}
			}else {
				$bodyFinal = str_replace('\"','"',$body)."<br>======================================================================<br>".$to." wrote : ".$data["body"];
				$bodyFinal = str_replace('\r\n','<br>',$bodyFinal);
				$status2 = mysqli_result1(mysqli_query($mysqli1,"select status2 from memo where id='".$myIdMemo."'"),0);
				if(stristr($status2,"Lainnya")) {
					$field = "other";
				}else if(stristr($status2,"Umum")){
					$field = "umum";
				}else if(stristr($status2,"Teknis")){
					$field = "teknis";
				}else if(stristr($status2,"Keuangan")) {
					$field = "uang";
				}else {
					$field = "umum";
				}

				$to = mysqli_result1(mysqli_query($mysqli1,"select `memo_".$field."` from `configuration`"),0);
				memo(",".$to.",",$login,$subject,$bodyFinal,$insertDataImg);
			}	
			echo "Your memo has been sent";
		}
	}
	
}
?>
