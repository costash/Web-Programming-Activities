<?php /* Smarty version Smarty-3.1.17, created on 2014-04-04 09:57:02
         compiled from "entry.tpl" */ ?>
<?php /*%%SmartyHeaderCode:991533e654e845d87-33426024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05b674ff8b2748969b1492a1eed99861f9bdb2d0' => 
    array (
      0 => 'entry.tpl',
      1 => 1396598219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '991533e654e845d87-33426024',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_533e654e98dfd3_81899931',
  'variables' => 
  array (
    'person' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533e654e98dfd3_81899931')) {function content_533e654e98dfd3_81899931($_smarty_tpl) {?><tr>
	<td><?php echo $_smarty_tpl->tpl_vars['person']->value['name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['person']->value['age'];?>
</td>
</tr><?php }} ?>
