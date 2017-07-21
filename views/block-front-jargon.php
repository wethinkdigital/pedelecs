<h2 class="purple" style="margin-top: 30px">Jargon Glossary</h2>
<div id="jargon">
<?php
	
	$args = array('post_type' => 'jargon');
	$jargon = new WP_Query($args);
	while($jargon->have_posts()) {
		$jargon->the_post(); ?>
		<div class="jargon-item">
			<h5 class="purple"><?php the_title(); ?></h5>
			<p><?php the_content(); ?></p>
			<div class="clear"></div>
		</div>
<?php } wp_reset_postdata(); ?>
</div>
<div id="jargonfade"></div>