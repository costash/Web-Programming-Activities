<?php
	$values[0]='red';
	$values[1]='blue';
?>
 <form action="ex2.php" method="POST">
	<input name="color" type-"text"/>
		<?php			
			if (array_search($_POST['color'] , $values) === FALSE) {
				echo "MWHAHAHAHAHAHA</br>";
			}
		?>
	
	<input type="submit" />
</form>