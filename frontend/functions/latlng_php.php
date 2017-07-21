<?php function latlng($postcode){

$pc = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($postcode).'&sensor=false';
$data = curl_file_get_contents($pc);
$geo = json_decode($data);

$file = $_SERVER['DOCUMENT_ROOT'].'/development_log.txt';
$current .= date('d M Y, H:i:s').' postcode:'.$postcode.' latlng result: '.serialize($geo).PHP_EOL;
file_put_contents($file, $current);


$result['postcode'] = urldecode($postcode);
$result['lat'] = $geo->results[0]->geometry->location->lat;
$result['lng'] = $geo->results[0]->geometry->location->lng;

return $result;

}

function curl_file_get_contents($URL){
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
        else return FALSE;
}
?>