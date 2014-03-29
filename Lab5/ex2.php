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

		function create_article($title, $contents) {
			$article = ORM::for_table('articles') -> create();
			$article -> title = $title;
			$article -> text = $contents;
			$article -> save();
			return $article;
		}

		if (isset($_POST['titlu']) && isset($_POST['contents'])) {
			$article = create_article($_POST['titlu'], $_POST['contents']);
			move_uploaded_file($_FILES["file"]["tmp_name"], "img/" . $article -> id . ".jpg");
			echo "Stored in: " . "img/" . $article -> id . ".jpg";
		}

		$articles = ORM::for_table('articles') -> find_many();
		foreach ($articles as $article) {
			echo "<a href=ex1.php?id=" . $article -> id . ">" . $article -> title . "</a>\n";
		}
		?>
		</pre>
		

		<form action="ex2.php" method="POST" enctype="multipart/form-data">
			<input type="text" name="titlu" placeholder="completeaza titlu" />
			<input type="text" name="contents" placeholder="completeaza continut" />

			<input type="file" name="file" />

			<input type="submit" value="Trimite" />
		</form>

	</body>
</html>