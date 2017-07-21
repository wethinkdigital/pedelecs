<?php

function news($count) { 

$args = array( 'post_type' => 'news',
				'posts_per_page' => $count

);
		
$news = new WP_Query($args);

echo '<div class="news"><h1>Latest Electric Bike News</h1><div id="newstiles">';

while( $news->have_posts() ) : $news->the_post();

?>
<div class="newsitem">
	<?php the_post_thumbnail(); ?>
	<div class="text">
		<h4><?php the_title(); ?></h4>
		<?php the_excerpt(); ?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>

<? endwhile; echo '</div></div>'; wp_reset_postdata(); } ?>