<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * May 2014
 */
require_once 'idiorm.php';
require_once 'paris.php';
ORM::configure('sqlite:db/db.sqlite');

class Comment extends Model {
}

?>