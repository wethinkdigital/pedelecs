<div class="wrapper" style="padding-top: 30px;">
	<div class="stage">
	
			<h2 class="purple"><?php the_title(); ?></h2>
			
			
			<div class="auto-columns-2" style="margin: 30px 0;">
				<?php the_content(); ?>	
			</div>
						
			<div id="supporting_media" class="imghalf">
				<?php ob_start(); 
				the_secondary_content('Supporting media');
				$media = ob_get_clean();
				if($media != ''){
					echo $media;
					//echo preg_replace( '/(width|height)=\"\d*\"\s/', "", $media );
				} 
				?>
			</div>
			
			<div class="clear"></div>
	</div>
</div>
			
			<!-- Box ads -->

<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper">
	<div class="stage">
			
			<?php include(TEMPLATEPATH."/views/block-front-section-boxes.php"); ?>
			
			<?php include(TEMPLATEPATH."/views/block-front-jargon.php"); ?>
		
		
		
	</div>
	
	
	<?php if(get_post_meta(get_the_id(), '_showvideo', true) == 'yes' || 1==2){ ?>
		<div class="stage purplegrad" style="width: 960px; margin-top: 10px; margin-bottom: 10px; padding: 10px;">
			<?php front_home_featured_video(); ?>
		</div>
	<?php } ?>

	<div class="stage" style="margin-top: 10px;">
		<div class="palegrey fl" style="width: 610px; height: 380px; padding: 10px;">
			<h3 class="purple">Top Guides</h3>
			
			<a href="/electric-bike-guides/uk-electric-bike-law/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electricbikelaw_small.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Electric Bike Law</h5>
			</div>
			</a>

			<a href="/electric-bike-guides/cycle-work-scheme/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/cycletowork_small.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Cycle to Work Scheme</h5>
			</div>
			</a>

			<a href="/electric-bike-guides/conversion-kits/">
			<div class="fl" style="width: 180px; margin-right: 0px;">
				<img src="<?php bloginfo('template_url'); ?>/img/conversion-kits-2.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Conversion kits</h5>
			</div>
			</a>
			<a href="/electric-bike-guides/s-pedelecs/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/s-pedelecs.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>S-Pedelecs</h5>
			</div>
			</a>
			<a href="/electric-bike-guides/first-timers-guides/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/first-timers.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>First Timers</h5>
			</div>
			</a>
			<a href="/electric-bike-guides">
			<div class="fl" style="width: 180px; margin-right: 0px;">
				<img src="<?php bloginfo('template_url'); ?>/img/all-guides.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>All Buyers' Guides</h5>
			</div>
			</a>

			
		</div>
		<div class="palegrey fr" style="width: 300px;  padding: 10px;">
			<h3 class="purple">Forum discussions</h3>
			<?php dynamic_sidebar('xenforo'); ?>
			<!--
<div id="vb_feed">
				<h4>Loading forum...</h4>
			</div>
-->

			<h4 class="purple">Go to forums</h4>
			<p><a href="/forum/forums/electric-bicycles.2/">Electric Bicycles</a></p>
			<p><a href="/forum/forums/which-electric-bike-should-i-buy.40/">Which electric bike should I buy?</a></p>
			<p><a href="/forum/forums/electric-bike-conversion-kits.42/">Electric Bike Conversion Kits</a></p>
			<p><a href="/forum/forums/electric-bike-classifieds.3/">Electric Classifieds</a></p>
		</div>
		<div class="clear"></div>
	</div>


</div>