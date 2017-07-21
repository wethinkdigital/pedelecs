<!DOCTYPE html>
<head profile="http://gmpg.org/xfn/11">
	<meta charset="UTF-8">
	
	<?php if ( is_tag() ) {
    echo "<meta name=\"robots\" content=\"noindex,follow\">";
    } elseif ( is_archive() ) {
    echo "<meta name=\"robots\" content=\"noindex,follow\">";
    } elseif ( is_search() ) {
    echo "<meta name=\"robots\" content=\"noindex,follow\">";
    } elseif ( is_paged() ) {
    echo "<meta name=\"robots\" content=\"noindex,follow\">";
    } else {
    echo "<meta name=\"robots\" content=\"index,follow\">";
    }
	?>
	
	<?php
	$brand = get_post_meta(get_the_id(), 'brand', TRUE);
	$model = get_post_meta(get_the_id(), 'model', TRUE);
	$description = get_post_meta(get_the_id(), 'description', TRUE); ?>
	
	<title><?php if($brand) echo $brand.' | '; if($model) echo $model; ?></title>
	
	<meta name="description" content="<?php if($description) echo $description; ?>"
	
	<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.ico" />
	
	<style>
	.cufon-loading {
		 visibility: hidden !important;
	}
	</style>

	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/colours.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/textstyles.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/jquery-ui-1.10.3.custom.css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>
		
	<script src="<?php bloginfo('template_url') ?>/js/jquery-1.9.1.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.hoverIntent.minified.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.uniform.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.number.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/pedelecs-slider.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.isotope.min.js"></script>

	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_create_prodspec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_read_prodspec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_update_prodspec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_delete_prodspec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_upload_image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_delete_image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_read_image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_link_video.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_delete_video.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_delete_manual.js"></script>
	<script src="<?php bloginfo('template_url') ?>/manufacturer/scripts/manu_upload_manual.js"></script>

	<script src="<?php bloginfo('template_url') ?>/frontend/scripts/front_whichbike_search_bikes.js"></script>
	<script src="<?php bloginfo('template_url') ?>/frontend/scripts/front_whichckit_search_ckits.js"></script>
	<script src="<?php bloginfo('template_url') ?>/frontend/scripts/prods_shortlist.js"></script>
    <script src="<?php bloginfo('template_url') ?>/frontend/scripts/front_whichbike_dealer_distance_search.js"></script>



	<script src="<?php bloginfo('template_url') ?>/frontend/scripts/front_dealersearch_dealer_distance_search.js"></script>

	<script src="<?php bloginfo('template_url') ?>/dealer/scripts/dealer_update.js"></script>
	<script src="<?php bloginfo('template_url') ?>/dealer/scripts/dealer_upload_image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/dealer/scripts/dealer_delete_image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/dealer/scripts/dealer_upload_logo.js"></script>

	<script type='text/javascript'><!--// <![CDATA[
	var OA_zones = {
	'boxad_0' : 17,
	'boxad_1' : 17,
	'boxad_2' : 17,
	'boxad_3' : 17,
	'boxad_4' : 17,
	'boxad_5' : 17
	}
	// ]]> --></script>
	<script type='text/javascript' src='http://www.pedelecs.co.uk/revive-adserver/www/delivery/spcjs.php?id=2&amp;block=1'></script>


	<script>
	 	$(function() {
	 		if($('#uniform').val()) {
		 		$( 'select' ).uniform({resetSelector: 'input[type="reset"]'});
		 		$( ':checkbox' ).uniform();
	 		}
			
			
			$('#menu-item-377, #menu-item-731').hoverIntent(
				function(){
				$(this).closest('#dropdown').filter(':not(:animated)').animate({ height: '240px'}, 160);
				}
			);

			$('#menu-item-402').hoverIntent(
				function(){
				$(this).closest('#dropdown').filter(':not(:animated)').animate({ height: '330px'}, 160);
				}
			);
			
			$('#menu-item-376, #menu-item-383, #menu-item-384').hoverIntent(
				function(){
				$(this).closest('#dropdown').filter(':not(:animated)').animate({ height: '35px'}, 160);
				}
			);
			$('nav#main').mouseleave(
				function(){
				$(this).closest('#dropdown').filter(':not(:animated)').animate({ height: '35px'}, 160);
				}
			);
	


			$('ul.sub-menu').hide()
		
			$('ul.menu li').mouseenter(
				function(){
					$(this).siblings('li').find('ul.sub-menu').fadeOut(120)
					$(this).find('ul.sub-menu').addClass('subshow').fadeIn(120);
				}
			);

			
		    $('#slider-range').slider({
		      range: true,
		      min: 0,
		      max: 10000,
			  step: 200,
			  values: [ 0, 10000 ],
		      slide: function( event, ui ) {
		        $( "#rrp" ).html( '£' + ui.values[ 0 ] + ' - £' + ui.values[ 1 ] );
		        $( "[name=rrp-min]" ).val(ui.values[ 0 ]);
		        $( "[name=rrp-max]" ).val(ui.values[ 1 ]);
		      }
		    });
		    
		    //$('#rrp').html( '£' + $( '#slider-range' ).slider( 'values', 0 ) + ' - £' + $( '#slider-range' ).slider( 'values', 1 ) );
		    $('[name=rrp-min]').val($( '#slider-range' ).slider( 'values', 0 ));
		    $('[name=rrp-max]').val($( '#slider-range' ).slider( 'values', 1 ));
		    
		    //$('#adpanel .stage').load('/wp-content/themes/pedelecs/frontend/includes/box_ads.php?' + Math.random()*99999);

			$('img').each(function() {
				var title = $(this).attr('title');
				if (typeof title == 'undefined' || title == '') {
					$(this).attr('title',$(this).attr('alt'));
				}
			});
				
		});

	</script>
	
 	<?php wp_head(); ?>
 	





</head>

<body>

<div id="sitewrapper" <?php if($_GET['debug']) { echo 'style="border: 1px solid blue;"'; } ?>>
<div id="sitewrapper-inner" <?php if($_GET['debug']) { echo 'style="border: 1px solid red;"'; } ?>>

<div class="wrapper" id="header">

	<div class="shadow shadowgrad-up"></div>

	<div class="stage">
		<div id="logo">
			<a href="/index.php"><img src="<?php bloginfo('template_url') ?>/img/logo.png"></a>
		</div>
		<div class="advert banner">
			<?php include(TEMPLATEPATH.'/frontend/includes/leaderboard.php'); ?>		
		</div>
		<div id="smallnav">
			<?php
					$menu_args = array(
						'theme_location' => 'smallnav',
					);
					wp_nav_menu($menu_args);
				?>
		</div>
	</div>
	
</div>

<div class="wrapper purplegrad">
	
	<div id="topnav-underlay">
		
	</div>
	

	<div class="stage" id="dropdown">
		<nav id="main">
		<?php
			$menu_args = array(
				'theme_location' => 'main',
				'walker' => new dropdown_walker()
			);
			wp_nav_menu($menu_args); ?>
		</nav>
	</div>
		
</div>

<div class="clear"></div>