<?php
session_start();
$_SESSION['ceva'] = "CEVA";
if (isset($_GET['logmein']))
	$_SESSION['loggedin'] = true;

if (issest($_SESSION['loggedin']))
	echo "m-am logat";
else
	echo "hehe, nu-s logat!";
?>