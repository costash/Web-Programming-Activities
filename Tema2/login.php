<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

function checkPassword($pwd, &$errors) {
	$errors_init = $errors;

	if (strlen($pwd) < 6) {
		$errors[] = "Password too short!";
	}

	if (!preg_match("#[0-9]+#", $pwd)) {
		$errors[] = "Password must include at least one number!";
	}

	if (!preg_match("#[a-zA-Z]+#", $pwd)) {
		$errors[] = "Password must include at least one letter!";
	}

	return ($errors == $errors_init);
}

function generateRandomString($length = 32) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

if (!isset($_POST['username']) || strlen($_POST['username']) < 6) {
	exit("username");
}

if (!isset($_POST['password']) || strlen($_POST['password']) < 6) {
	exit("password");
}

$user = Model::factory('User')
	->where('usr_username', $_POST['username'])
	->find_one();

if (!$user) {
	exit("user_doesnt_exist");
}

$typed_password = sha1($_POST['password'].$user->usr_salt);
if ($user->usr_password !== $typed_password) {
	exit("wrong_password");
}

$usr_last_login = date("Y-m-d H:i:s");
$user->usr_last_login = $usr_last_login;
$user->save();

echo 'ok';

?>