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
	

	<title></title>
	
	<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.ico" />

	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/layout.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/colours.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/textstyles.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url') ?>/css/uniform.default.css" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400' rel='stylesheet' type='text/css'>
	
	<script src="<?php bloginfo('template_url') ?>/js/jquery-1.9.1.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="<?php bloginfo('template_url') ?>/js/jquery.uniform.min.js"></script>

	<script src="<?php bloginfo('template_url') ?>/js/pedelecs-slider.js"></script>

	<script src="<?php bloginfo('template_url') ?>/form_scripts/create-bikespec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/read-bikespec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/update-bikespec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/delete-bikespec.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/upload-image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/delete-image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/read-image.js"></script>
	<script src="<?php bloginfo('template_url') ?>/form_scripts/sortable.js"></script>
		
	<?php wp_head(); ?>
	
	<script>
		$(function(){
        	$("select").uniform();
		});
	</script>
	
	
	<script>
		$(function(){
			$('#features').PedelecsSlider();
		});
	</script>
	
</head>

<body>

<div class="wrapper" id="header">

	<div class="shadow shadowgrad-up"></div>

	<div class="stage">
		<div id="logo"><a href="/index.php"><img src="<?php bloginfo('template_url') ?>/img/logo.png"></a></div>
		<nav id="main">
			<?php wp_nav_menu('theme_location=main'); ?>
		</nav>
		<div class="advert banner">
		</div>
	</div>
</div>

<div class="clear"></div>

