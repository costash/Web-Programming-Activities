<?php
	require_once 'idiorm.php';
	require_once '../libs/smarty/Smarty.class.php';
	ORM::configure('sqlite:./db.sqlite');	

	$smarty = new Smarty();
	
	$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
	$page_size = 10;
	
	$expenses = ORM::for_table('expenses')->limit($page_size)->offset($page * $page_size)->find_array();
	$pages = ceil(ORM::for_table('expenses')->count() / floatval($page_size));
	$smarty->assign('page', $page);
	$smarty->assign('pages', $pages);

	$smarty->assign('expenses', $expenses);
	$smarty->display('ex7.tpl');

?>