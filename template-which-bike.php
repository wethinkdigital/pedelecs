<?php

/*
Template Name: Which bike
*/

only_admin();

include ("loop/loop-default.php");

include ("views/header-default.php");

if($_GET['dev']){
    include ("views/content-which-bikeDEV.php");
} else {
    include ("views/content-which-bikeDEV.php");
}
include ("views/footer-default.php");

?>