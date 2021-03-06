<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

/* Check parameter. */
if (!isset($_GET['art_id']) || !is_numeric($_GET['art_id'])) {
	exit("wrong_art");
}

$article = Model::factory('Article')
	->where('art_id', $_GET['art_id'])
	->find_one();

if (!$article) {
	exit("wrong_art");
}

$author = $article->author()->find_one();

/* Create the output JSON. */
$result = array('id' => $article->art_id,
		'title' => $article->art_title,
		'content' => $article->art_content,
		'views' => $article->art_views,
		'author' => $author->usr_username,
		'publish_date' => $article->art_publish_date,
		'update_date' => $article->art_update_date);

echo json_encode($result);

/* Update number of views. */
$article->art_views++;
$article->save();

?>