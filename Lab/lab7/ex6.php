<pre><?php
	require_once 'idiorm.php';
	require_once '../libs/smarty/Smarty.class.php';
	ORM::configure('sqlite:./db.sqlite');	

	$smarty = new Smarty();

	if (isset($_POST['nume'])) {
		echo $_POST['nume']."\n";
	}else {
		echo "Campul nume nu este setat\n";
	}
	if (isset($_POST['varsta'])) {
		echo $_POST['varsta'];
	}else {
		echo "Campul varsta nu este setat\n";
	}
	
	$smarty->display('ex6.tpl');

?></pre>