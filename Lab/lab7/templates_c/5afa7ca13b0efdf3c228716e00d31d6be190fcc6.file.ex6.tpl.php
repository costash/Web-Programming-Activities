<?php /* Smarty version Smarty-3.1.17, created on 2014-04-04 11:58:23
         compiled from "ex6.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12536533e797fa6e620-12925831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5afa7ca13b0efdf3c228716e00d31d6be190fcc6' => 
    array (
      0 => 'ex6.tpl',
      1 => 1396605360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12536533e797fa6e620-12925831',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_533e797fb0e8c3_28034544',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533e797fb0e8c3_28034544')) {function content_533e797fb0e8c3_28034544($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['nume'] = new Smarty_variable('$nume', null, 0);?>
<?php $_smarty_tpl->tpl_vars['varsta'] = new Smarty_variable('$varsta', null, 0);?>

<form method="POST" action="ex6.php">
	<p>
        <label for="nume">Nume: </label>
        <input type="text" name="nume" value="<?php if (isset($_POST['nume'])) {?><?php echo $_POST['nume'];?>
<?php }?>" /> </br>
        
        <label for="varsta">Varsta: </label>
        <input type="text" name="varsta" value="<?php if (isset($_POST['varsta'])) {?><?php echo $_POST['varsta'];?>
<?php }?>" /> </br>
    <input type="submit" value="Send">
    </p>
</form><?php }} ?>
