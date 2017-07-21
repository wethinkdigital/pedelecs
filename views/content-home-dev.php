<div class="wrapper">
	<div class="stage" style="padding: 20px 0;">
		<h1>Welcome to the UK's largest electric bike community</h1>
		<div class="fl" style="width: 610px;">
		<?php the_content(); ?>
		</div>
		<div class="socnet fr" style="z-index: 9999;">
			<h4 class="purple">Connect with Pedelecs</h4>
			<a href="https://twitter.com/pedelecs" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/socnet-twitter.png" /></a>
			<a href="https://www.facebook.com/pages/Pedelecs-Electric-Bike-Community/127417367335134" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/socnet-facebook.png" /></a>
			<a href="https://plus.google.com/+PedelecsUk" target="_blank"><img src="<?php bloginfo('template_url'); ?>/img/socnet-gplus.png" /></a>
		</div>

	</div>
</div>

<!-- News sections -->

<div class="wrapper" id="homenews" style="margin-top: -20px;">
	<div class="stage">
		<?php //news('10'); ?>
		<div class="news fl">
				
		<?php $count = get_post_meta(get_the_id(), '_latest_news', true == '' ? 9 : get_post_meta(get_the_id(), '_latest_news', true)); front_home_news_dev(4); ?>
		
		
		</div>
		<div style="padding-top: 56px;">
		<?php front_home_reviews_sidebar(1); ?>
		<?php front_home_events_sidebar(1); ?>
		<?php front_home_releases_sidebar(1); ?>
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

<!-- section boxes -->
<div class="wrapper">
	<div class="stage">
			<?php include(TEMPLATEPATH."/views/block-front-section-boxes.php"); ?>
	</div>
</div>

<!-- Video Section -->

<div class="wrapper" style="margin-bottom: 0px;">

	<?php if(get_post_meta(get_the_id(), '_showvideo', true) == 'yes'){ ?>
		<div class="stage green" style="width: 960px; margin-top: 10px; margin-bottom: 10px; padding: 10px;">
			<?php front_home_featured_video(); ?>
		</div>
	<?php } ?>

</div>

<div class="wrapper">
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
				<h5>Conversion Kits</h5>
			</div>
			</a>
			<a href="/guides/s-pedelec/">
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
			<h3 class="purple">Forum Discussions</h3>
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

<!-- Strip panels -->

