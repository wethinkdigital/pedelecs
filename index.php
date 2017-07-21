<?php if($_GET['tmpl']) echo __FILE__; ?>

<?php

only_admin();

include ("loop/loop-default.php");


if(is_front_page()) {
	include ("views/header-home-dev.php");
	include ("views/content-home-dev.php");		
	include ("views/footer-home-dev.php");
} else {
	include ("views/header-default.php");
	include ("views/content-default.php");
	include ("views/footer-default.php");
}


?>