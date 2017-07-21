<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<?php $content = get_the_content(); $content = explode('&lt;newsfeed&gt;', $content); ?>

<div class="wrapper" id="newscat">

	<div class="stage">
	
		<?php echo $content[0]; ?>
		<div class="fl leftcol">
			<?php front_newscat_leftcol(999,get_the_id()); ?>
		</div>
		
		<div class="rightcol fr">
			<div class="purplegrad" style="position: absolute; left: 0px; top: 0px; width: 270px; padding: 10px 10px 1px 10px; margin-bottom: 10px;">
				<?php echo $content[1]; ?>
			</div>
			<?php front_newscat_rightcol(3,get_the_id()); ?>
		</div>
		
	</div>
	
</div>

<div class="wrapper" style="padding-top: 20px;">
	<div class="stage">
		<?php echo $content[2]; ?>
	</div>
</div>

<div class="clear"></div>
