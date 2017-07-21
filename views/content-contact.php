<input type="hidden" id="uniform" value="true" />

<div class="wrapper dropshad" style="height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>


<div class="wrapper" id="contact_page" style="height: 700px; overflow: hidden; margin-bottom: -30px;">
		
		<div class="bg"><img src="<?php bloginfo('template_url'); ?>/img/contact-page-bg.jpg" /></div>
		<div class="wrapper dropshad" style="position: absolute; top: -100px; left: 0px; z-index: 100; height: 100px; background-color: white;"></div>
		<div class="stage purplegrad" style="margin-top: 60px; overflow: hidden;">
			<div id="leftcol" class="fl">
				<?php the_content(); ?>
			</div>
			<div id="rightcol" class="palegrey fr">
				<h3>Let us contact you</h3>
				<?php echo do_shortcode('[contact-form-7 id="1339" title="contact page"]'); ?>
			</div>
			<div class="clear"></div>
		</div>	
		
</div>