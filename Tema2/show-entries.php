<?php
	require_once 'model.php';
	
	if (!isset($_GET['table'])) {
		echo 'wrong_table';
	} else if (!isset($db_tables[$_GET['table']])) {
		echo 'wrong_table';
	} else {

		$values = Model::factory($db_tables[$_GET['table']])
			->find_array();
		
		echo json_encode($values);
	}
?>