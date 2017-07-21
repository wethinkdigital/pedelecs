<?php
session_start();
foreach($_POST as $k=>$v){
	$_SESSION[$k] = $v;
}

$result['session'] = serialize($_POST);
echo json_encode($result);
?>