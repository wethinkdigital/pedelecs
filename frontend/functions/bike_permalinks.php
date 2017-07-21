<?php

add_action('init', 'rb_add_rewrite_rules');
add_filter('post_type_link', 'rb_create_permalinks', 10, 3);

function rb_add_rewrite_rules() {
    global $wp_rewrite;
    $wp_rewrite->add_rewrite_tag('%bike%', '([^/]+)', 'bike=');
    $wp_rewrite->add_rewrite_tag('%brand%', '([^/]+)', 'brand=');

    $wp_rewrite->add_permastruct('bike', '/bikes/%brand%/%bike%', false);
}

function rb_create_permalinks($permalink, $post, $leavename) {
    $no_data = 'no-data';
    $post_id = $post->ID;

    if($post->post_type != 'bike' || empty($permalink) || in_array($post->post_status, array('draft', 'pending', 'auto-draft')))
    return $permalink;

    $event_id = get_post_meta($post_id, 'brand', true);
    $var1 = basename(get_permalink($event_id));
    $var1 = sanitize_title($var1);

    if(!$var1)
        $var1 = $no_data;

    $permalink = str_replace('%brand%', $var1, $permalink);

    return $permalink;
}
