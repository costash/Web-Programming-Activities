<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tema 5</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<script src="script/jquery-1.11.1.min.js"></script>
		<script src="script/jquery-ui.min.js"></script>
		<script src="script/script.js"></script>
	</head>
	<body>
		<article>
			<header>
				<h2>Un articol</h2>
				<p>
					Data publicarii:
					<time pubdate>
						2014-02-28 20:01
					</time>
				</p>
			</header>
			<section>
				<header>
					<h3>Comentarii</h1>
				</header>
				<div id="comments"></div>
				<form id="postcomm" method="post" action="comments.php">
					<label for="name">Name:</label>
					<input name="name" id="name" />
					<label for="email">Email:</label>
					<input name="email" id="email" />
					<label for="comment">Comment:</label>
					<textarea name="comment" id="comment" rows="4" cols="40"></textarea>
					<input type="submit" />
				</form>
			</section>
		</article>
	</body>
</html>