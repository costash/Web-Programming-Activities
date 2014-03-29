<?php
require_once 'model.php';

if (!isset($_GET['s']) || empty($_GET['s'])) {
	exit("s");
}

ORM::get_db()->exec('PRAGMA case_sensitive_like = true;');

$like = '%'.$_GET['s'].'%';
$articles = Model::factory('Article')
		->where_raw('(`art_title` LIKE ? OR `art_content` LIKE ?)', array($like, $like))
		->order_by_desc('art_publish_date')
		->find_many();

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