<?php 

session_start();
if($_POST['user_postcode']) {$_SESSION['user_postcode'] = $_POST['user_postcode']; }
if($_POST['user_distance']) {$_SESSION['user_distance'] = $_POST['user_distance']; }

if($_SESSION['user_distance'] <  9999) {
    $postcode = urlencode($_SESSION['user_postcode']);
} else {
    $postcode = '';
}

$pc = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$postcode.'&sensor=false';
$data = map_file_get_contents($pc);
$geo = json_decode($data);

$result['postcode'] = $postcode;
$result['distance'] = $_SESSION['user_distance'];
$result['lat'] = $geo->results[0]->geometry->location->lat;
$result['lng'] = $geo->results[0]->geometry->location->lng;

echo json_encode($result);

function map_file_get_contents($URL){
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
        else return FALSE;
}
?>
