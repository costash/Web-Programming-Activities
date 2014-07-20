{assign var='nume' value='$nume'}
{assign var='varsta' value='$varsta'}

<form method="POST" action="ex6.php">
	<p>
        <label for="nume">Nume: </label>
        <input type="text" name="nume" value="{if isset($smarty.post.nume)}{$smarty.post.nume}{/if}" /> </br>
        
        <label for="varsta">Varsta: </label>
        <input type="text" name="varsta" value="{if isset($smarty.post.varsta)}{$smarty.post.varsta}{/if}" /> </br>
    <input type="submit" value="Send">
    </p>
</form>