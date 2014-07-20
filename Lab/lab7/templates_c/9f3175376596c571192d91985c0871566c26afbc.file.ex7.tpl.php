<?php /* Smarty version Smarty-3.1.17, created on 2014-04-04 12:34:10
         compiled from "ex7.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9270533e8700d43ee4-12117032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f3175376596c571192d91985c0871566c26afbc' => 
    array (
      0 => 'ex7.tpl',
      1 => 1396607648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9270533e8700d43ee4-12117032',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_533e8700e97cb9_50987094',
  'variables' => 
  array (
    'expenses' => 0,
    'expense' => 0,
    'pages' => 0,
    'i' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533e8700e97cb9_50987094')) {function content_533e8700e97cb9_50987094($_smarty_tpl) {?><table>
	<?php echo $_smarty_tpl->getSubTemplate ('header7.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php  $_smarty_tpl->tpl_vars['expense'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['expense']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['expenses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['expense']->key => $_smarty_tpl->tpl_vars['expense']->value) {
$_smarty_tpl->tpl_vars['expense']->_loop = true;
?>
	<?php echo $_smarty_tpl->getSubTemplate ('entry7.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('expense'=>$_smarty_tpl->tpl_vars['expense']->value), 0);?>

<?php } ?>
<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['pages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
    <a href="ex7.php?page=<?php echo $_smarty_tpl->tpl_vars['i']->value-1;?>
"><?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['page']->value+1) {?><b><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</b><?php } else { ?><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
<?php }?> </a>
<?php }} ?>
<table><?php }} ?>
