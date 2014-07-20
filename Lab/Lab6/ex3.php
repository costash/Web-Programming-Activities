<?php
	$http_response = '';
	
	$fp = fsockopen('localhost', 80);
	
	fputs($fp, "POST /PW/Lab6/script1.php HTTP/1.1\r\n");
	fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
	
	$params = "?key1=value1&key2=value2";
	fputs($fp, "Content-length: ".strlen($params)."\r\n");
	fputs($fp, "Host: localhost\r\n\r\n".$params);
	
	while (!feof($fp))
	{
		$http_response .= fgets($fp, 128);
	}
	fclose($fp);
	
	echo nl2br(htmlentities($http_response));
?>