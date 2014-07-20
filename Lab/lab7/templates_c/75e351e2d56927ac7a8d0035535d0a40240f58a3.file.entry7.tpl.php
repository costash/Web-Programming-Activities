<?php /* Smarty version Smarty-3.1.17, created on 2014-04-04 12:19:19
         compiled from "entry7.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27812533e8700f01443-31485088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75e351e2d56927ac7a8d0035535d0a40240f58a3' => 
    array (
      0 => 'entry7.tpl',
      1 => 1396606756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27812533e8700f01443-31485088',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_533e8701047be6_05990457',
  'variables' => 
  array (
    'expense' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533e8701047be6_05990457')) {function content_533e8701047be6_05990457($_smarty_tpl) {?><tr>
	<td><?php echo $_smarty_tpl->tpl_vars['expense']->value['amount'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['expense']->value['details'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['expense']->value['data'];?>
</td>
</tr><?php }} ?>
