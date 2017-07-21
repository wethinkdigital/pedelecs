<?php ob_start();
     
	include_once($_SERVER['DOCUMENT_ROOT'].'/forum/library/Pedelecs/Header/XFWP_Menu.php');
	
   
    define('PEDELECS', 'http://pedelecs.co.uk/wp-content/themes/pedelecs');
    ?>
	
	<title></title>
	
	<meta name="description" content="" />
	
	<link rel="shortcut icon" href="<?php echo PEDELECS ?>/favicon.ico" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/css/colours.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/css/textstyles.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo PEDELECS ?>/css/jquery-ui-1.10.3.custom.css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>
		
<!--
	<script src="<?php echo PEDELECS ?>/js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo PEDELECS ?>/js/jquery-ui-1.10.1.custom.min.js"></script>
-->
	<script src="<?php echo PEDELECS ?>/js/jquery.hoverIntent.minified.js"></script>


	<script>
	 	$(function() {
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
	 	

<div class="wrapper" id="header">

	<div class="shadow shadowgrad-up"></div>

	<div class="stage">
		<div id="logo">
			<a href="/index.php"><img src="<?php echo PEDELECS ?>/img/logo.png"></a>
		</div>
		<div class="advert banner">
            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/pedelecs/frontend/includes/leaderboard.php'); ?>
		</div>
		<div id="smallnav">
			 <?php XFWP_Menu(76); ?>
		</div>
	</div>
	
</div>

<div class="wrapper purplegrad">
	
	<div id="topnav-underlay">
		
	</div>
	

	<div class="stage" id="dropdown">
		<nav id="main" class="classtest2">
            <?php XFWP_Menu(2); ?>
		</nav>
	</div>
		
</div>

<div class="clear"></div>

<?php $wpHeader = ob_get_contents(); ob_end_clean(); echo $wpHeader; ?>