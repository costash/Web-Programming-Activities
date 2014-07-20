<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<pre><?php
		require_once 'idiorm.php';
		ORM::configure('sqlite:db.sqlite');

		require_once 'user_and_logout.php';
		print_logout();

		if (isset($_POST['username']) && isset($_POST['password'])) {
			$user = ORM::for_table('users') -> where_equal('username', $_POST['username']) -> find_one();
			if ($user === false) {
				echo "Auth FAIL: User doesn't exist";
			} else {
				echo $user -> username;
				if ($user -> password === md5($_POST['password'])) {
					$_SESSION['auth'] = true;
					$_SESSION['username'] = $user -> username;
					$_SESSION['rights'] = $user -> rights;
				} else {
					echo "Auth FAIL: Wrong passwd";
				}
			}
		}
		
		if (isset($_SESSION['auth'])) {
			echo "sesiunea curentă: " . $_COOKIE['PHPSESSID'];
		}
		
		?></pre>						
		
		



		<form action="ex4.php" method="POST">
			<input type="text" name="username" placeholder="username" />
			<input type="password" name="password" />

			<input type="submit" value="Log in" />
		</form>

	</body>
</html>