<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * May 2014
 */
require_once 'model.php';

function checkEmail($email) {

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	/* Sanity checks */
	if (!isset($_POST['name']) || $_POST['name'] === '' || strlen($_POST['name']) > 64) {
		die('name');
	}
	if (!isset($_POST['email']) || strlen($_POST['email']) > 64 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		die('email');
	}
	if (!isset($_POST['comment']) || $_POST['comment'] === '' || strlen($_POST['comment']) > 100) {
		die('comment');
	}
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];

	$comm = Model::factory('Comment') -> create();
	$comm -> name = $name;
	$comm -> email = $email;
	$comm -> comment = $comment;
	$comm -> save();

	echo 'ok';
} else {
	$comments = Model::factory('Comment') -> find_many();

	foreach ($comments as $comment) {
		echo "<article><header><p>Nume: <strong>" . $comment -> name . "</strong></p>" . "<p>Email: " . $comment -> email . "</p>" . "</header>" . "<p>" . $comment -> comment . "</p>" . "</article>";
	}
}
?>