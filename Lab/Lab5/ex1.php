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

		$id = $_GET["id"];
		//echo 'id:' . $id . "\n";
		function goto_article() {
			global $id;
			$article= ORM::for_table('articles') -> where_equal('id', $id) -> find_one();
			array_push($_SESSION['meh'], $article);
			if (count($_SESSION['meh']) > 5) {
				array_shift($_SESSION['meh']);
			}
			echo $article->text;
			echo "<img src='img/".$id.".jpg' />";
		}

		if (isset($_SESSION['rights'])) {
			$rights = $_SESSION['rights'];
			if ($rights !== '*') {
				$arr = explode(",", $rights);
				if (!array_search($id, $arr)) {
					echo "Not enough permissions\n";
				} else {
					goto_article();
				}
			} else {
				goto_article();
			}
			
		}
		
		?></pre>
	</body>
</html>