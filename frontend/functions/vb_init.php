<?php

// Api Key - generated from: admincp/api.php 
    $Apikey = "fae1CgPV"; 

    // Insert the parameters to build the API on: http://www.vbulletin.com/forum/content.php?366-REST-Server-Specific-Methods 
    $Api_InitParams = array("clientname" => 'pedelecs', "clientversion" => '1', "platformname" => 'PHP', "platformversion" => '5', "uniqueid" => $Apikey); 
    ksort($Api_InitParams); 
    $Api_InitParams = http_build_query($Api_InitParams, '', '&'); 

    $Api_Url = "http://www.pedelecs.co.uk/forum/api.php?api_m=api_init&{$Api_InitParams}"; 
    $vBInfo = json_decode(file_get_contents($Api_Url), true);
    
    echo '<pre>';
	print_r($vBInfo);
	echo '</pre>';
    // Build Common Array 
    $ApiParamsArray = array("api_c" => $vBInfo['apiclientid'], "api_s" => $vBInfo['apiaccesstoken'], "api_v" => $vBInfo['apiversion']); 
    ksort($ApiParamsArray); 
    $ApiParams = http_build_query($ApiParamsArray, '', '&');