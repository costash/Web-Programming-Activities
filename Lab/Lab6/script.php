<?php
	$values[0]='red';
	$values[1]='blue';
	$values[2]='green';
?>
 <form action="script.php" method="POST">
	<select name="color">
		<?php
			foreach($values as $value)
				echo "<option value=\"".$value."\">".$value."</option>";
		?>
	</select>
	<input type="submit" />
</form>