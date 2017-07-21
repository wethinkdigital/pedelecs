<?php
class Vbb_Client {

private $_instance;

// Setting
protected $_endpoint = '';
protected $_apikey = '';
protected $_clientname = '';
protected $_clientversion = '';
protected $_platformname = '';
protected $_platformversion = '';
protected $_uniqueid = '';

// Params for every session
private $_apiclientid = '';
private $_apiaccesstoken = '';
private $_secret;

private $_curl;

private $_userinfo = array(
	'userid' => null,
	'sessionhash' => null,
);

function __construct($endpoint, $apikey, $clientname, $clientversion, $platformname, $platformversion, $uniqueid) {
	$this->_endpoint = $endpoint;
	$this->_apikey = $apikey;
	$this->_clientname = $clientname;
	$this->_clientversion = $clientversion;
	$this->_platformname = $platformname;
	$this->_platformversion = $platformversion;
	$this->_uniqueid = $uniqueid;

	$this->_curl = curl_init();
}

private function init() {
	$requestparams = array(
	'api_m' => 'api_init',
	'clientname' => $this->_clientname,
	'clientversion' => $this->_clientversion,
	'platformname' => $this->_platformname,
	'platformversion' => $this->_platformversion,
	'uniqueid' => $this->_uniqueid
	);
	ksort( $requestparams );

	$result = $this->runRequest( $requestparams );

	$this->_apiclientid = $result->apiclientid;
	$this->_apiaccesstoken = $result->apiaccesstoken;
	$this->_secret = $result->secret;

	return $result;
}

public function login($username, $password) {
	$r = $this->call( 'login_login', array( 'vb_login_username' => $username, 'vb_login_password' => $password ), true );

	if ( $r->response->errormessage[0] == 'redirect_login' ) {
		$this->_userinfo['userid'] = $r->session->userid;
		$this->_userinfo['sessionhash'] = $r->session->dbsessionhash;
		return true;
	}
	return false;
}

public function call($method_name, $params = array(), $isPost = false) {

	// there is no session establish, then make api_init first
	if ( $this->_apiclientid == '' || $this->_apiaccesstoken == '' || $this->_secret == '' ) {
	$this->init();
	}

	$params['api_m'] = $method_name;
	if ($isPost === true) {
	$signature = $this->buildSignature( array('api_m' => $method_name) );
	} else {
	$signature = $this->buildSignature( $params );
	}

	$params['api_c'] = $this->_apiclientid;
	$params['api_s'] = $this->_apiaccesstoken;
	$params['api_sig'] = $signature;
	$result = $this->runRequest( $params, $isPost);
	return $result;
}

private function runRequest($method_call_params, $isPost = false) {
	curl_setopt($this->_curl, CURLOPT_URL, ($isPost === true)
	? $this->getMethodUrl(array('api_m' => $method_call_params['api_m']))
	: $this->getMethodUrl( $method_call_params ) );
	curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
	if ( $isPost === true ) {
		echo 	$this->getMethodUrl(array('api_m' => $method_call_params['api_m']));
		print_r($method_call_params);
	curl_setopt($this->_curl, CURLOPT_POST, 1);
	curl_setopt($this->_curl, CURLOPT_HTTPGET, 0);
	curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $method_call_params);
	} else {
	curl_setopt($this->_curl, CURLOPT_POST, 0);
	curl_setopt($this->_curl, CURLOPT_HTTPGET, 1);
	}
	return $this->verifyResult(curl_exec($this->_curl));
}

private function verifyResult($result) {
	/* error check */
	$result = json_decode($result);
	if ( isset( $result->response->errormessage ) && !empty( $result->response->errormessage ) ) {
	if ( $result->response->errormessage[0] != 'redirect_login' ) {
	echo '<pre>';
	print_r($result);
	echo '</pre>';
	throw new Exception($result->response->errormessage[1]);
	}
	}
	return $result;
}

private function buildSignature( $method_params ) {
		ksort($method_params);
		return md5( http_build_query( $method_params , '', '&' ) . $this->_apiaccesstoken . $this->_apiclientid . $this->_secret . $this->_apikey );
	}

	private function getMethodUrl($requestparams = array() ) {
		return 'http://' . $this->_endpoint . '/api.php?' . http_build_query( $requestparams, '', '&' );
	}

}

	
function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va->$key;
    }
    arsort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

$client = new Vbb_Client( 'pedelecs.co.uk/forum',
	'fae1CgPV',
	'pedelecs',
	'1.0',
	'web',
	'4.0.2',
	'fae1CgPV' );
	
	$agg_threads = array();
	
	$not_ids = array('18', '21', '25', '26', '27', '34');
	
	$i=1;
	
	while($i <= 40) {
		if(!in_array($i, $not_ids)) {
			//echo '<p>Forum '.$i.'</p>';
				$forum_feed = $client->call( 'forumdisplay', array( 'forumid' => $i) );
			
			//echo '<pre>'; print_r($forum_feed); echo '</pre>';
			$threadbits = $forum_feed->response->threadbits;
			foreach($threadbits as $bit) { $agg_threads[] = $bit->thread; } 
			
		} $i++;
	}


	aasort($agg_threads,"lastposttime");
 
	//echo '<pre>'; print_r($agg_threads); echo '</pre>';
	
	$display = array_slice($agg_threads,0,3);
	
	foreach($display as $post){	
	
		$excerpt = implode(' ', array_slice(explode(' ', $post->preview), 0, 20));
		
		echo '<h5><a href="http://www.pedelecs.co.uk/forum/showthread.php?t='.$post->threadid.'">'.$post->threadtitle.'</a></h5>';
		echo '<p style="margin: 0 0 6px 0;">'.$excerpt.'</p>';
		echo '<p>'.$post->replycount.' comments. Last commented '.date("G:i d M, Y",$post->lastposttime).'</p>';
		
		
		
	 }
	
	//http://www.pedelecs.co.uk/forum/showthread.php?t=XXXXXXX

?>