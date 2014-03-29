<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

/* Check parameters */
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
	exit("id");
}

function check_valid($param) {
	if (!isset($_POST["$param"]) || empty($_POST[$param])) {
		exit("$param");
	}
}

check_valid('title');
check_valid('content');
check_valid('author');
check_valid('cat_id');

$new_cats = $_POST['cat_id'];

/* Find categories in database and check if the new ones are valid.
 * Could not use in_array function here.
 */
$categories = Model::factory('Category')->find_many();
foreach ($new_cats as $entered_category) {
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

/* Get the corresponding article and modify its contents. */
$article = Model::factory('Article')
		->where('art_id', $_POST['id'])
		->find_one();

$article->art_title = $_POST['title'];
$article->art_content = $_POST['content'];
$article->art_author = $_POST['author'];
$article->art_update_date = date("Y-m-d H:i:s");
$article->save();

/* Remove the old assigned categories */
Model::factory('ArticleCategory')
		->where('artc_art_id', $article->art_id)
		->delete_many();

/* Set the new categories */
$art_cat = Model::factory('ArticleCategory');
foreach ($new_cats as $cat_id) {
	$art_cat->create();
	$art_cat->artc_art_id = $article->art_id;
	$art_cat->artc_cat_id = $cat_id;
	$art_cat->save();
}


echo 'ok';

?>