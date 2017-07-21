<link rel="stylesheet" type="text/css" media="screen" href="http://www.edensearch.co.uk/wp-content/themes/eden2.0/css/layout.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.edensearch.co.uk/wp-content/themes/eden2.0/css/textstyles.css" />

<?php

mail('david@dlrobins.co.uk', 'WPmail test', 'no messssssssage');

echo '<div class="success">'.$_POST['email'].', thank you for subscribing to our mailing list.</div>';

require($_SERVER['DOCUMENT_ROOT'].'/wp-blog-header.php' );



$data['email'] = $_POST['email'];
$data['name'] = $_POST['name'];
$data['surname'] = $_POST['surname'];
$data['page'] = $_POST['page'];
$data['formname'] = $_POST['form_name'];

$subscribe_db = new form_to_db($_POST['form_name']);
$subscribe_db->insert_app($data);

$subscribe_email = new form_to_email();
$subscribe_email->send_email($data);

//echo '<pre>'; print_r($_REQUEST); echo '</pre>';

?>
