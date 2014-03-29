<?php
require_once 'idiorm.php';
ORM::configure('sqlite:./db.sqlite');
 
ORM::get_db()->exec('DROP TABLE IF EXISTS person;');
ORM::get_db()->exec(
    'CREATE TABLE person (' .
        'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'name TEXT, ' .
        'age INTEGER)'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS message;');
ORM::get_db()->exec(
	'CREATE TABLE message ('.
		'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
		'id_person INTEGER, ' .
		'text TEXT, ' .
		'FOREIGN KEY(id_person) REFERENCES person(id))'
);

function create_message($id_person, $text) {
	$message = ORM::for_table('message')->create();
	$message->text = $text;
	$message->id_person = $id_person;
	$message->save();
	return $message;
}
 
function create_person($name, $age) {
    $person = ORM::for_table('person')->create();
    $person->name = $name;
    $person->age = $age;
    $person->save();
    return $person;
}
 
$person_list = array(
    create_person('Corina', 41),
    create_person('Delia', 43),
    create_person('Tudor', 56),
    create_person('Adina', 32),
    create_person('Ada', 50),
    create_person('Camelia', 40),
    create_person('Vlad', 72),
    create_person('Emil', 27),
    create_person('Ștefan', 46),
    create_person('Dan', 63),
    create_person('Roxana', 67),
    create_person('Octavian', 34),
    create_person('Radu', 78),
    create_person('Marina', 63),
    create_person('Cezar', 19),
    create_person('Laura', 36),
    create_person('Andreea', 61),
    create_person('George', 28),
    create_person('Liviu', 44),
    create_person('Eliza', 19),
);

// Adăugați un tabel nou în fixtures.php cu relații de prietenie între persoane (many-to-many).
// Adăugați date in acest tabel. E recomandat ca o relație de prietenie să fie reprezentată simetric, ca două rânduri, pentru a ușura query-urile.
/*ORM::get_db()->exec('DROP TABLE IF EXISTS message;');
ORM::get_db()->exec(
	'CREATE TABLE message ('.
		'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
		'id_person INTEGER, ' .
		'text TEXT, ' .
		'FOREIGN KEY(id_person) REFERENCES person(id))'
);*/


$texte = file("proverbe.txt");
$message_list = array();
for ($i = 0; $i < count($texte); $i++) {
	array_push($message_list, create_message($i % 20, $texte[$i]));
}

 
echo('ok<br>');
echo('person ' . ORM::for_table('person')->count() . '<br>');
echo('message ') . ORM::for_table('message')->count() . '<br>)';
