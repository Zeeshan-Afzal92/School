<?php

function sendRequest($order, $type, $data)
{
	Include("config.php");

	$idd = array('order' => $order, 'type' => $type, 'data' => $data );
	$dd = json_encode($idd);
	$final = array('posted' => $dd);

	$url = $_server;
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($client, CURLOPT_POST, 1);
	curl_setopt($client, CURLOPT_POSTFIELDS, $final);
	if(isset($_COOKIE['server']))
	{
		curl_setopt($client,CURLOPT_COOKIE,$_COOKIE['server']);
//		echo "Cookie To server ".$_COOKIE['server'];
	}
	
	 curl_setopt($client,CURLOPT_HEADER,1); //
	
	 
	 
	 curl_setopt($client, CURLOPT_VERBOSE, true);
	 
	 $verbose =$fp = fopen('error.txt', 'w'); 
	 curl_setopt($client, CURLOPT_STDERR, $verbose);
	 
	 
	 
	$response1 = curl_exec($client);       //$responce with header
	
	preg_match_all('|Set-Cookie: (.*);|U',$response1,$results); // 
	$cookies = implode(';',$results [1]); //
	                                      // var_dump($cookies); //
	 if($cookies != "")
	 {                                   
		setcookie( "server", $cookies, 0, "/", "", false, true );// 
	 }
	
	$response2=explode("\n\n", $response1,2);// splited
	$response = $response2[1]; // selected second one
	
	$result = json_decode($response,1);  

	// if(isset($result['data']['alertBox']) )
	// {
	// 	echo ' <script> alert("'.$result['data']['alertBox'].'"); </script>';
	// }
	//var_dump($result);
	if ($result["data"] == -1 || $result["data"] == 0) {
		return $result["status_message"];
	}else{
	 	return $result["data"];
	}
}
?>









