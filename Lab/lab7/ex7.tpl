<table>
	{include file='header7.tpl'}
{foreach item=expense from=$expenses}
	{include file='entry7.tpl' expense=$expense}
{/foreach}
{for $i=1 to $pages}
    <a href="ex7.php?page={$i-1}">{if $i == $page+1}<b>{$i}</b>{else}{$i}{/if} </a>
{/for}
<table>