<?php function calc_distance_ll($data) {


$pi80 = M_PI / 180;
$data['lat1'] *= $pi80;
$data['long1'] *= $pi80;
$data['lat2'] *= $pi80;
$data['long2'] *= $pi80;

$r = 6372.797; // mean radius of Earth in km
$dlat = $data['lat2'] - $data['lat1'];
$dlng = $data['long2'] - $data['long1'];
$a = sin($dlat / 2) * sin($dlat / 2) + cos($data['lat1']) * cos($data['lat2']) * sin($dlng / 2) * sin($dlng / 2);
$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

// Distance in KM
$km = round($r * $c, 2);

// Distance in Miles
$miles = round($km * 0.621371192, 2);

$distance = array();
$distance['miles'] = $miles;
$distance['km'] = $km;


return $distance['miles'];

}
?>
