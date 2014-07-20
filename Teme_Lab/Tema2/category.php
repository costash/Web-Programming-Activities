<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

/* Check parameter. */
if (!isset($_GET['cat_id']) || !is_numeric($_GET['cat_id'])) {
	exit("wrong_cat");
}

$category = Model::factory('Category')
	->where('cat_id', $_GET['cat_id'])
	->find_one();

if (!$category) {
	exit("wrong_cat");
}

$articles = $category->articles()->order_by_desc('art_publish_date')->find_many();

/* Create the output JSON. */
$result = array();
foreach ($articles as $article) {

	$author = $article->author()->find_one();

	$item = array('id' => $article->art_id,
		'title' => $article->art_title,
		'content' => $article->art_content,
		'views' => $article->art_views,
		'author' => $author->usr_username,
		'publish_date' => $article->art_publish_date,
		'update_date' => $article->art_update_date);
	array_push($result, $item);
}

echo json_encode($result);

?>