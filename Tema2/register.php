<?php
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

if (!isset($_POST['confirm']) || $_POST['confirm'] != $_POST['password']) {
	exit("confirm");
}

$errors[] = "";
if (!checkPassword($_POST['password'], $errors)) {
	exit("password_strength");
}

$user = Model::factory('User')
	->where('usr_username', $_POST['username'])
	->find_one();

if ($user) {
	exit("user_exists");
}

/* Store the user information in database */
$usr_salt = generateRandomString();
$usr_password = sha1($_POST['password'].$usr_salt);
$usr_last_login = date("d-m-y H:i:s", 0);

$user = Model::factory('User')->create();
$user->usr_username = $_POST['username'];
$user->usr_password = $usr_password;
$user->usr_salt = $usr_salt;
$user->usr_register_date = date("d-m-y H:i:s");
$user->usr_last_login = $usr_last_login;
$user->save();

echo 'ok';

?>