<?php
require_once 'model.php';

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
	exit("id");
}

if (!isset($_POST['title']) || empty($_POST['title'])) {
	exit("title");
}

if (!isset($_POST['content']) || empty($_POST['content'])) {
	exit("content");
}

if (!isset($_POST['author']) || empty($_POST['author'])) {
	exit("author");
}

if (!isset($_POST['cat_id']) || empty($_POST['cat_id'])) {
	exit("cat_id");
}

/* Find categories in database. Could not use in_array here. */
$categories = Model::factory('Category')->find_many();
foreach ($_POST['cat_id'] as $entered_category) {
	$found = false;
	foreach ($categories as $category) {
		if ($entered_category === $category->cat_id) {
			$found = true;
			break;
		}
	}
	if (!$found) {
		exit("cat_id");
	}
}

$article = Model::factory('Article')
		->where('art_id', $_POST['id'])
		->find_one();

Model::factory('ArticleCategory')
		->where('artc_art_id', $article->art_id)
		->delete_many();

$art_cat = Model::factory('ArticleCategory');
foreach ($_POST['cat_id'] as $cat_id) {
	$art_cat->create();
	$art_cat->artc_art_id = $article->art_id;
	$art_cat->artc_cat_id = $cat_id;
	$art_cat->save();
}

$article->art_title = $_POST['title'];
$article->art_content = $_POST['content'];
$article->art_author = $_POST['author'];
$article->art_update_date = date("Y-m-d H:i:s");
$article->save();

echo 'ok';

?>