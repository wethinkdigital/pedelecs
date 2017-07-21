<?php if($_GET['tmpl']) echo __FILE__; ?>


<?php

//can_see_this('administrator','dealer','dealer_premium');


/*
Template Name: Dealer List
*/

only_admin();


include ("loop/loop-default.php");

include ("views/header-default.php");

include ("views/content-dealer-list.php");

include ("views/footer-default.php");

?>