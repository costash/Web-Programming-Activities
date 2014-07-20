<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'model.php';

/* Check parameters */
if (!isset($_GET['table'])) {
	echo 'wrong_table';
} else if (!isset($db_tables[$_GET['table']])) {
	echo 'wrong_table';
} else {

	/*
	 * Get data from table. db_tables is an association between the table name
	 * and the model.
	 */
	$values = Model::factory($db_tables[$_GET['table']])->find_array();

	echo json_encode($values);
}
?>