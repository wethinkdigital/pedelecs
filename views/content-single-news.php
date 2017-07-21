<div class="wrapper" style="padding-top: 30px;">
	<div class="stage">
	
		<div class="fl" style="width: 760px">
			<h2 class="purple"><?php the_title(); ?></h2>
			
			<?php $cats = '';
				foreach(get_the_category(get_the_id()) as $cat) {
				$cats .= $cat->name.', ';
				$cats = substr($cats,0,-2);
			} ?>
			
			<p class="date"><?php the_time('jS F, Y'); ?> in <?php echo $cats; ?></p>
			
			
			
			<?php //$atts = array('class' => ' single-large'); the_post_thumbnail('full',$atts); ?>
			
			<?php $caption = get_post_meta(get_the_id(), 'image_caption', TRUE); if($caption) echo '<div class="image_caption_anchor"><div class="image_caption">'.$caption.'</div></div>'; ?>

			<div class="auto-columns-2" style="margin: 30px 0;">
				<?php the_content(); ?>	
			</div>
			
			<hr style="margin-bottom: 20px;">
			
			<div id="supporting_media">
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
			
			<div class="halfcol">
			<?php $cats_arr =  get_the_category(get_the_id());
			front_related_articles($cats_arr[0]->term_id,get_the_id()); ?>
			</div>
			
			<div class="halfcol colright">
				<?php ob_start(); 
				the_secondary_content('Related Links');
				$second_content = ob_get_clean();
				if($second_content != ''){
					echo '<h4 class="purple">Useful links</h4>';
					echo $second_content;
				} 
				?>
			</div>
		
		</div> <!-- end fl -->
		
		
		<div class="fr"><?php include(TEMPLATEPATH.'/frontend/includes/skyscraper.php'); ?></div>
	</div>
</div>