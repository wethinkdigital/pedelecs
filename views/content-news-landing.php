<div class="wrapper dropshad" style="margin-bottom: 20px; height: 190px;">
	<div class="stage" style="padding: 20px 0;">
		<?php include(TEMPLATEPATH.'/frontend/includes/box_ads.php'); ?>
	</div>
	<div class="clear"></div>
</div>

<div class="wrapper">
	<div class="stage">
		<?php front_news_landing_feature(); ?>
		<?php //news_intros(); ?>
	</div>
</div>

<div class="wrapper">
	<div class="stage">

		<div style="width: 970px;" class="masonry">
		
			<div class="news_headlines palegrey fl tile">
				<h2>Electric Bike News</h2>
				<?php front_news_landing_headlines('electric-bike-news'); ?>
			</div>
			
			<div class="news_headlines palegrey fl tile">
				<h2>New releases</h2>
				<?php front_news_landing_headlines('new-releases'); ?>
			</div>
			
			<div class="news_headlines palegrey fl tile">
				<h2>Features</h2>
				<?php front_news_landing_headlines('features'); ?>
			</div>
			
			<div class="news_headlines palegrey fl tile">
				<h2>Exhibitions & Events</h2>
				<?php front_news_landing_headlines('exhibitions-events'); ?>
			</div>
		
			<div class="clear"></div>
		</div>
		
	</div>
</div>

<div class="clear"></div>
