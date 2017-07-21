<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

?>

<form name="manuals" class="manuals" action="<?php bloginfo('template_url'); ?>/manufacturer/functions/manu_upload_manuals.php" method="post" enctype="multipart/form-data" target="<?php echo $_POST['prod_type']; ?>ManualUploadframe">

	<input type="hidden" name="post_id" value="<?php echo $_POST['post_id']; ?>" />
	
	<?php $args = array(
		'post_type' => 'attachment',
		'numberposts' => null,
		'post_status' => null,
		'post_parent' => $_POST['post_id'],
		'post_mime_type' => array('application/pdf'),
		'order' => 'ASC'
	);
	
	$attachments = get_posts($args);
	$i=1;
	
	foreach($attachments as $attachment) { ?>
		<div class="pdf_panel fl" attachment_id="<?php echo $attachment->ID; ?>" post_id="<?php echo $_POST['post_id']; ?>" prod_type="<?php echo $_POST['prod_type']; ?>">
			<a href="<?php echo $attachment->guid; ?>" target="_blank">
			<img src="<?php bloginfo('template_url'); ?>/img/pdf-icon.png" /><br />
			<?php echo $attachment->post_title; ?></a>
			<div class="delete hovershow purplegrad"><img src="<?php bloginfo('template_url'); ?>/img/image-delete.png" unselectable="on" style="margin-left: 0px;"/></div>
		</div>
		<?php $i++;
	}
	
	while($i < 4) { ?>
	
		<div class="pdf_panel fl">
			<p><label>Title</label><input type="text" name="title<?php echo $i; ?>" /></p>
			<p><input type="file" name="pdf<?php echo $i; ?>" /></p>
		</div>
		
	<?php $i++; } ?>
	
	<input type="submit" class="greybutton" value="Upload" disabled />

		
	<iframe class="formtarget" id="<?php echo $_POST['prod_type']; ?>ManualUploadframe" name="<?php echo $_POST['prod_type']; ?>ManualUploadframe"></iframe>
				
</form>

<div class="clear"></div>