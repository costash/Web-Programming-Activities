<?php
	$url = parse_url('http://localhost/PW/Lab6/session.php');
	$host = $url['host'];
	$path = $url['path'];
	
	$cookie = $_COOKIE['PHPSESSID'];
	echo $cookie;
	
	$fp = fsockopen($host, 80);
	// send the request headers:
	fputs($fp, "GET $path HTTP/1.1\r\n");
	fputs($fp, "Host: $host\r\n");
	fputs($fp, "Cookie: PHPSESSID=$cookie\r\n");
	fputs($fp, "Connection: close\r\n\r\n");
	
	$result = ''; 
	while(!feof($fp)) {
		// receive the results of the request
		$result .= fgets($fp, 128);
	}
	// close the socket connection:
	fclose($fp);
 
	// split the result header from the content
	$result = explode("\r\n\r\n", $result, 2);
 
	$header = isset($result[0]) ? $result[0] : '';
	$content = isset($result[1]) ? $result[1] : '';

	echo $header;
	echo $content;
?>