<?php

function front_dealer_list($search_loc = NULL){

    global $wpdb;
    
    $counties = $wpdb->get_col( " SELECT DISTINCT meta_value FROM {$wpdb->usermeta} WHERE meta_key LIKE 'county' " );
    sort($counties);

    $towns = $wpdb->get_col( " SELECT DISTINCT meta_value FROM {$wpdb->usermeta} WHERE meta_key LIKE 'town' " );
    sort($towns);

    $locations = array();
    
	if(!$search_loc) {
		echo '<h2>Dealer list</h2>';
		$locations = $counties;
	}
	else {
	
        $search_loc = preg_replace('/-/',' ',$search_loc);
        $search_loc = preg_replace_callback("/[a-zA-Z]+/",'ucfirst_some',$search_loc);

        
		echo '<h2>Electric bike dealers in '.$search_loc.'</h2>';
		if(in_array($search_loc, $counties)) { $loctype = 'county'; }
		if(in_array($search_loc, $towns)) { $loctype = 'town'; }
		$locations = array($search_loc);
	}
	
	
	foreach($locations as $location) {
	
		if(count($locations) > 1) echo '<h4 style="margin-top: 20px;">'.$location.'</h4>';
		echo '<ul class="premium">';

		$args = array(
        'role' => 'dealer_premium',
		'orderby' => 'display_name',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key'     => $loctype,
				'value'   => $location,
				'compare' => '='
				),
			)
		);

		$premium_results = new WP_User_Query( $args );
		$premium_dealers = $premium_results->get_results();
				
		foreach($premium_dealers as $premium_dealer){
			echo '<li>';
			echo '<h4 style="margin-bottom: 0px;"><a class="purple" href="/dealer/'.$premium_dealer->user_nicename.'">'.$premium_dealer->display_name.'</a></h4>';
			echo '<p>'.get_user_meta($premium_dealer->ID,'address_1', true).', '.get_user_meta($premium_dealer->ID,'address_2', true).', '.get_user_meta($premium_dealer->ID,'town', true).'</p>';
			echo '</li>';			
		}
		
		echo '</ul>';
		
		if(count($premium_dealers > 0)) echo '<hr>';

		echo '<ul>';

		$args = array(
        'role' => 'dealer',
		'orderby' => 'display_name',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key'     => $loctype,
				'value'   => $location,
				'compare' => '='
				),
			)
		);

		$results = new WP_User_Query( $args );
		$dealers = $results->get_results();
				
		foreach($dealers as $dealer){
			echo '<li>';
			echo '<a href="/dealer/'.$dealer->user_nicename.'">'.$dealer->display_name.'</a>';
			echo '<p>';
			if(get_user_meta($dealer->ID,'address_1', true) != '') echo trim(get_user_meta($dealer->ID,'address_1', true),' ').', ';
			if(get_user_meta($dealer->ID,'address_2', true) != '') echo trim(get_user_meta($dealer->ID,'address_2', true),' ').', ';
			if(get_user_meta($dealer->ID,'town', true) != '') echo trim(get_user_meta($dealer->ID,'town', true),' ');
			echo '</p>';
			echo '</li>';			
		}
		
		echo '</ul>';


	}	
	
	
}


function ucfirst_some($match)
{
    $exclude = array('on','of', 'in', 'upon');
    if ( in_array(strtolower($match[0]),$exclude) ) return $match[0];
    return ucfirst($match[0]);
} ?>