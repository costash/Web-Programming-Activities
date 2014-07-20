<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<pre><?php
		require_once 'idiorm.php';
		ORM::configure('sqlite:./db.sqlite');

		$one_person = ORM::for_table('person') -> where_gt('age', 18) -> find_one();
		echo $one_person -> name . ' are vârsta de ' . $one_person -> age . ' ani';
		echo "\nEverybody:\n";

		$people = ORM::for_table('person') -> find_many();
		foreach ($people as $person) {
			echo $person -> name . ',' . $person -> age . "\n";
		}

		//Afișați o listă cu nume de persoane care se termină în lia, și o listă cu nume care se termină în an, folosind filtre în query.
		$lia = ORM::for_table('person') -> where_like('name', '%lia') -> find_many();
		echo "\nNume care se termină în lia:\n";
		foreach ($lia as $person) {
			echo $person -> name . ',' . $person -> age . "\n";
		}
		$an = ORM::for_table('person') -> where_like('name', '%an') -> find_many();
		echo "\nNume care se termină în an:\n";
		foreach ($an as $person) {
			echo $person -> name . ',' . $person -> age . "\n";
		}

		/* $mesaje = ORM::for_table('message') -> find_many();
		 echo "\nMesaje:\n";
		 foreach ($mesaje as $msg) {
		 echo $msg -> id_person .','. $msg -> text;
		 }
		 */

		//$contor = ORM::for_table('person')->select_expr('COUNT(message.id)', 'count')->join('message', 'person.id = message.id_person')->find_many();
		//var_dump($contor);
		$people = ORM::for_table('person')->select('person.name')->select_expr('COUNT(*)', 'count')->group_by('person.id')->join('message', 'person.id = message.id_person')->find_many();
		echo "\nEverybody count:\n";
		for ($i = 0; $i < count($people); $i++) {
			echo $people[$i]->name.','.$people[$i]->count."\n";
		}
		
		$people = ORM::for_table('person')->select('person.name')->select('message.text')->join('message', 'person.id = message.id_person')->find_many();
		echo "\nEverybody mesaje:\n";
		for ($i = 0; $i < count($people); $i++) {
			echo $people[$i]->name.', '.$people[$i]->text;
		}
		
		//  Afișați o listă cu mesaje ale persoanelor care au maxim 40 de ani. Folosiți un singur query pe tabela de mesaje.
		$people = ORM::for_table('person')->select('person.name')->select('person.age')->select('message.text')->join('message', 'person.id = message.id_person')->where_lt('person.age', 40)->find_many();
		echo "\nEverybody mesaje:\n";
		for ($i = 0; $i < count($people); $i++) {
			echo $people[$i]->name.', '.$people[$i]->age.', '.$people[$i]->text;
		}
		
	?></pre>
	</body>
</html>