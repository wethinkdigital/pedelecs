<?php

include ("loop/loop-default.php");

include ("views/header-default.php"); ?>

<form action="http://pedelecs.ideasbyeden.co.uk/testdistance/" method="POST">
	<input type="text" name="postcode1" value="<?php if($_POST) echo $_POST['postcode1']; ?>" />
	<input type="text" name="postcode2" value="<?php if($_POST) echo $_POST['postcode2']; ?>" />	
	<input type="submit" id="test" value="go"/>
</form>

<div id="result">
Distance: 
<?php if($_POST) {
	echo calc_distance($_POST['postcode1'],$_POST['postcode2']);
} ?>	
</div>

<?php include ("views/footer-default.php");

?>

