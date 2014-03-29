<?php
require_once 'model.php';

if (!isset($_GET['cat_id']) || !is_numeric($_GET['cat_id'])) {
	exit("wrong_cat");
}

$category = Model::factory('Category')
	->where('cat_id', $_GET['cat_id'])
	->find_one();

if (!$category) {
	exit("wrong_cat");
}

$articles = $category->articles()->find_many();

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