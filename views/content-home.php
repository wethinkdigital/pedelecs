<div class="wrapper">
	<div class="stage" style="padding: 20px 0;">
		<h1>Welcome to the UK's largest electric bike community</h1>
		<?php the_content(); ?>
	</div>
</div>

<div class="wrapper" id="homenews">
	<div class="stage">
		<?php //news('10'); ?>
		<div class="news fl">
				
		<?php $count = get_post_meta(get_the_id(), '_latest_news', true == '' ? 9 : get_post_meta(get_the_id(), '_latest_news', true)); front_home_news(6); ?>
		
		<?php front_home_reviews(8); ?>
		
		</div>
		<?php $count = (get_post_meta(get_the_id(), '_latest_events', true) == '' ? 2 : get_post_meta(get_the_id(), '_latest_events', true)); front_home_events($count); ?>
		<?php $count = (get_post_meta(get_the_id(), '_latest_releases', true) == '' ? 2 : get_post_meta(get_the_id(), '_latest_releases', true)); front_home_releases($count); ?>
		<div class="clear"></div>
	</div>
</div>

<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>


<?php //include(TEMPLATEPATH.'/views/include-purplebar.php'); ?>

<div class="wrapper" style="margin-bottom: 0px;">

	<div class="stage purplegrad" style="width: 960px; margin-top: 10px; margin-bottom: 10px; padding: 10px;">
		<?php front_home_featured_video(); ?>
	</div>

	<div class="stage" style="margin-top: 10px;">
		<div class="palegrey fl" style="width: 610px; height: 380px; padding: 10px;">
			<h3 class="purple">Highlights</h3>
			
			<a href="http://www.pedelecs.co.uk/forum/electric-bike-reviews/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bike-reviews.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Reviews</h5>
			</div>
			</a>

			<a href="/electric-bike-guides/buyers-guides/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bikes-buyers-guides.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Buyer's Guides</h5>
			</div>
			</a>

			<a href="/buy/electric-bike-kit-directory/">
			<div class="fl" style="width: 180px; margin-right: 0px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bike-kits.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Kit Directory</h5>
			</div>
			</a>
			<a href="/buy/electric-bike-accessories/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bike-accessories.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Accessories</h5>
			</div>
			</a>
			<a href="http://www.pedelecs.co.uk/forum/classifieds/">
			<div class="fl" style="width: 180px; margin-right: 30px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bike-classified-ads.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>Classifieds</h5>
			</div>
			</a>
			<a href="/hire-and-holidays">
			<div class="fl" style="width: 180px; margin-right: 0px;">
				<img src="<?php bloginfo('template_url'); ?>/img/electric-bike-holidays.jpg" style="width: 180px; height: 120px; background-color: white;" />
				<h5>E-bike Rental & Holidays</h5>
			</div>
			</a>

			
		</div>
		<div class="palegrey fr" style="width: 300px; height: 380px; padding: 10px;">
			<h3 class="purple">Forum discussions</h3>
			<?php dynamic_sidebar('xenforo'); ?>
			<!--
<div id="vb_feed">
				<h4>Loading forum...</h4>
			</div>
-->
		</div>
		<div class="clear"></div>
	</div>

</div>

