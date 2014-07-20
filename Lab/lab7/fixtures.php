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
 
ORM::get_db()->exec('DROP TABLE IF EXISTS messages;');
ORM::get_db()->exec(
	'CREATE TABLE messages ('.
	 	'id INTEGER PRIMARY KEY AUTOINCREMENT, '.
	 	'person_fk INTEGER, '.
	 	'message TEXT, '.
	 	'FOREIGN KEY(person_fk) REFERENCES person(id))'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS friends;');
ORM::get_db()->exec(
	'CREATE TABLE friends ('.
	 	'person_A INTEGER, '.
	 	'person_B INTEGER, '.
	 	'FOREIGN KEY(person_A) REFERENCES person(id), '.
	 	'FOREIGN KEY(person_B) REFERENCES person(id))'
);

ORM::get_db()->exec('DROP TABLE IF EXISTS expenses;');
ORM::get_db()->exec(
	'CREATE TABLE expenses ('.
	 	'id INTEGER PRIMARY KEY AUTOINCREMENT, '.
	 	'amount INTEGER, '.
	 	'details TEXT, '.
	 	'data TEXT)'
);

function create_expense($amount, $details, $data) {
	$expense = ORM::for_table('expenses')->create();
	$expense->amount = $amount;
	$expense->details = $details;
	$expense->data = $data;
	$expense->save();
	return $expense;
}

for ($i = 0; $i < 20; $i++) {
	create_expense('20', "mancare$i", "2012-07-08 11:14:15.638276");
	create_expense('100', "cazare$i", "2012-07-09 12:14:15.638276");
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

$messages = file("proverbe.txt");
function create_message() {
	global $messages; 
    $message = ORM::for_table('messages')->create();
	$rand = rand(0, 300);
    $message->message = $messages[$rand];
	$person = rand(0, 25);
	$message->person_fk = $person;
    $message->save();
    return $person;
}

for ($i=0; $i<25; $i++) {
	create_message();
}

function createFriends() {
	for ($i=0; $i<100; $i++) {
		$rndA = rand(0, 20);
		$rndB = rand(0, 20);
		if ($rndA == $rndB)
			continue;
	    $friends = ORM::for_table('friends')->create();
		$friends->person_A = $rndA;
		$friends->person_B = $rndB;
		$friends->save();
	    $friends = ORM::for_table('friends')->create();
		$friends->person_A = $rndB;
		$friends->person_B = $rndA;
		$friends->save();
	}
};

createFriends();
 
echo('ok<br>');
echo('person ' . ORM::for_table('person')->count() . '<br>');

