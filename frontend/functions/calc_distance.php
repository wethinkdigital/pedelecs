<?php function calc_distance($postcode1,$postcode2) {

$postcode1 = preg_replace('/\s+/', '', $postcode1);
$postcode2 = preg_replace('/\s+/', '', $postcode2);


// Geocode Postcodes & Get Co-ordinates 1st Postcode
$pc1 = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$postcode1.',+UK&sensor=false';
$data1 = @file_get_contents($pc1);
$result1 = json_decode($data1);

$custlat1 = $result1->results[0]->geometry->location->lat;
$custlong1 = $result1->results[0]->geometry->location->lng;

// Geocode Postcodes & Get Co-ordinates 2nd Postcode
$pc2 = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$postcode2.',+UK&sensor=false';
$data2 = @file_get_contents($pc2);
$result2 = json_decode($data2);

$custlat2 = $result2->results[0]->geometry->location->lat;
$custlong2 = $result2->results[0]->geometry->location->lng;

// Work out the distance!
$pi80 = M_PI / 180;
$custlat1 *= $pi80;
$custlong1 *= $pi80;
$custlat2 *= $pi80;
$custlong2 *= $pi80;

$r = 6372.797; // mean radius of Earth in km
$dlat = $custlat2 - $custlat1;
$dlng = $custlong2 - $custlong1;
$a = sin($dlat / 2) * sin($dlat / 2) + cos($custlat1) * cos($custlat2) * sin($dlng / 2) * sin($dlng / 2);
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
