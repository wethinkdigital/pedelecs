<?php 

$bits = explode("/",$_SERVER['REQUEST_URI']);
$user = get_user_by( 'slug', $bits[2] );
$metadata = get_user_meta($user->ID);
global $roles;
$roles = unserialize($metadata['wp_capabilities'][0]);
if(!array_key_exists('dealer_premium', $roles) && !array_key_exists('dealer', $roles)) { header('Location:http://www.pedelecs.co.uk'); }


if($_GET['tmpl']) echo __FILE__;


include ("loop/loop-default.php");

include ("views/header-default.php");

include ("views/content-dealer.php");

include ("views/footer-default.php");

?>