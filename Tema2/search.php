<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

/* Check parameter */
if (!isset($_GET['s']) || empty($_GET['s'])) {
	exit("s");
}

/* Make sure LIKE is case sensitive */
ORM::get_db()->exec('PRAGMA case_sensitive_like = true;');

/* Search the term through titles and through contents. The raw where is needed
 * because idiorm does not support OR for WHERE clauses.
 */
$like = '%'.$_GET['s'].'%';
$articles = Model::factory('Article')
		->where_raw('(`art_title` LIKE ? OR `art_content` LIKE ?)', array($like, $like))
		->order_by_desc('art_publish_date')
		->find_many();

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