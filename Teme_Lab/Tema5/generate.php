<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * May 2014
 */
require_once 'model.php';

ORM::configure('sqlite:db/db.sqlite');

/* 
 * Create tables and make sure they are clean
 */
ORM::get_db()->exec('DROP TABLE IF EXISTS comment;');
ORM::get_db()->exec('CREATE TABLE comment ('
		. 'id INTEGER PRIMARY KEY AUTOINCREMENT, '
		. 'name VARCHAR(64), '
		. 'email VARCHAR(64), '
		. 'comment VARCHAR(100))'
);
?>