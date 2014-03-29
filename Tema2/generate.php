<?php
/*
 * Author: Constantin Șerban-Rădoi 342C5
 * March 2014
 */
require_once 'idiorm.php';
require_once 'model.php';

ORM::configure('sqlite:db/db.sqlite');

/* 
 * Create tables and make sure they are clean
 */
ORM::get_db()->exec('DROP TABLE IF EXISTS pw_user;');
ORM::get_db()->exec('CREATE TABLE pw_user ('
		. 'usr_id INTEGER PRIMARY KEY AUTOINCREMENT, '
		. 'usr_username VARCHAR(256), '
		. 'usr_password CHAR(40), '
		. 'usr_salt CHAR(32), '
		. 'usr_register_date DATETIME, '
		. 'usr_last_login DATETIME)'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_category;');
ORM::get_db()->exec('CREATE TABLE pw_category ('
		. 'cat_id INTEGER PRIMARY KEY AUTOINCREMENT, '
		. 'cat_title VARCHAR(254))'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_article;');
ORM::get_db()->exec('CREATE TABLE pw_article ('
		. 'art_id INTEGER PRIMARY KEY AUTOINCREMENT, '
		. 'art_title TEXT, '
		. 'art_content TEXT, '
		. 'art_views INTEGER, '
		. 'art_publish_date DATETIME, '
		. 'art_update_date DATETIME, '
		. 'art_author INTEGER, '
		. 'FOREIGN KEY(art_author) REFERENCES pw_user(usr_id))'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS pw_article_category;');
ORM::get_db()->exec('CREATE TABLE pw_article_category ('
		. 'artc_art_id INTEGER, '
		. 'artc_cat_id INTEGER, '
		. 'FOREIGN KEY(artc_art_id) REFERENCES pw_article(art_id), '
		. 'FOREIGN KEY(artc_cat_id) REFERENCES pw_category(cat_id))'
);

/*
 * Gets contents from a CSV file. It pushes every entry array inside an array.
 */
function explode_csv($csv_name) {
	$row = 1;
	$contents = array();
	if (($handle = fopen($csv_name, "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			for ($c=0; $c < $num; $c++) {
				echo $data[$c] . "<br />\n";
			}

			array_push($contents, $data);
		}
		fclose($handle);
	}
	return $contents;
}

/*
 * Construct path for CSV file for a table given its name.
 */
function get_path($table_name) {
	return "db\\$table_name.csv";
}

/*
 * Reads the CSV files and inserts them into corresponding tables.
 */
function add_contents($db_tables) {
	$all_tables = array();
	foreach ($db_tables as $table => $model) {
		$csv_path = get_path($table);
		$contents = explode_csv($csv_path);
		array_push($all_tables, $contents);

		$num_lines = count($contents);
		$model = Model::factory($model);
		$header = $contents[0];
		for ($i = 1; $i < $num_lines; $i++) {
			$db_entry = array();
			$num_cols = count($contents[$i]);

			for ($j = 0; $j < $num_cols; $j++) {
				$db_entry[$header[$j]] = $contents[$i][$j];
			}

			$model->create($db_entry);
			$model->save();
		}
	}
	return $all_tables;
}

$all_tables = add_contents($db_tables);
var_dump($all_tables);

?>