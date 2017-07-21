<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );

get_currentuserinfo();

$args = array( 'post_type' => $_POST['prod_type'],
				'author' => $current_user->ID,
				'posts_per_page' => -1

);
		
echo '<ul class="'.$_POST['prod_type'].'">';		
	
$prods = new WP_Query($args);

while( $prods->have_posts() ) : $prods->the_post(); ?>

    <li style="color: white; list-style: none;">
        <form action="" method="post" class="prodload">
            <input type="hidden" name="brand" id="brand" value="<?php echo $current_user->user_login; ?>" />
            <input type="hidden" name="post_id" id="post_id" value="<?php the_ID(); ?>" />
            <input type="hidden" name="prod_type" id="prod_type" value="<?php echo $_POST['prod_type']; ?>" />
            <input type="hidden" name="model" id="model" value="<?php echo get_post_meta(get_the_id(), 'model', TRUE); ?>" />
            <input type="submit" class="textbutton" value="<?php echo get_post_meta(get_the_id(), 'model', TRUE); ?>" />
            <?php get_currentuserinfo(); if( current_user_can('level_10')) { ?>
                <input type="button" class="greenbutton fr hovershow" name="delete" value="Delete" id="<?php the_ID(); ?>"/>
            <?php } ?>
        </form>
    </li>

<?php endwhile; echo '</ul>'; wp_reset_postdata(); ?>