<pre>
	<?php

	session_start();
	function print_logout() {
		if (isset($_SESSION['username'])) {
			echo "User curent: " . $_SESSION['username']."\t";
			echo "<a href=ex6.php>Logout</a>\n";
		} else {
			echo "Nici un user logat\n";
		}
		
		//var_dump($_SESSION['meh']);
		echo "Pagini vizitate: ";
		foreach ($_SESSION['meh'] as $value) {
			echo "<a href='ex1.php?id={$value->id}'>{$value->title}</a>\t";
		}
		echo "\n";
	}
	
	if (!isset($_SESSION['meh'])) {
		$_SESSION['meh'] = array();
	}
	
	?>
</pre>