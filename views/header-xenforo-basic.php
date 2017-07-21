<!DOCTYPE html>
<head profile="http://gmpg.org/xfn/11">
	<meta charset="UTF-8">
	
	<?php
    //require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );
	//include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	//include_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/admin.php' );
    ?>
	
	
	
	<title></title>
	
	<meta name="description" content="" />
	
	<link rel="shortcut icon" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/favicon.ico" />
	

	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/css/layout.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/css/colours.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/css/textstyles.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/css/jquery-ui-1.10.3.custom.css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>
		
	<script src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/js/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/js/jquery.hoverIntent.minified.js"></script>



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

			
	
		});

	</script>
	
 	

</head>

<body>

<div class="wrapper" id="header">

	<div class="shadow shadowgrad-up"></div>

	<div class="stage">
		<div id="logo">
			<a href="/index.php"><img src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/wp-content/themes/pedelecs/img/logo.png"></a>
		</div>
		<div class="advert banner">
			<?php //include($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/pedelecs/frontend/includes/leaderboard.php'); ?>		
		</div>
	</div>
	
</div>

<div class="wrapper purplegrad">
	
	<div id="topnav-underlay">
		
	</div>
	

	<div class="stage" id="dropdown">
		<nav id="main">
		<?php
			/*
$menu_args = array(
				'theme_location' => 'bob',
				'walker' => new dropdown_walker()
			);
			wp_nav_menu($menu_args);
*/ ?>
		</nav>
	</div>
		
</div>

<div class="clear"></div>