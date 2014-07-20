<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<pre><?php
		require_once 'idiorm.php';
		ORM::configure('sqlite:db.sqlite');

		session_start();
		session_destroy();
		header("Location: ex4.php");

		?></pre>				

	</body>
</html>