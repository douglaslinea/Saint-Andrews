<?php /* Smarty version Smarty-3.1.1, created on 2012-10-11 17:50:45
         compiled from "app/view/templates/Index/index.php" */ ?>
<?php /*%%SmartyHeaderCode:16079264175077312502aaf7-25869925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd036f6045cc7828d3f249adef41505c2566cc504' => 
    array (
      0 => 'app/view/templates/Index/index.php',
      1 => 1349986063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16079264175077312502aaf7-25869925',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HEAD' => 0,
    'textos_site' => 0,
    'textos_layout' => 0,
    'FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_507731250ac48',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_507731250ac48')) {function content_507731250ac48($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['HEAD']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
	

Teste de t&iacute;tulo/texto from table "textos"<br />
<h1><?php echo $_smarty_tpl->tpl_vars['textos_site']->value[1]['txt_titulo'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['textos_site']->value[1]['texto'];?>
<br />

<br /><br />
Teste de texto from table "textosLayout"<br />
<h2><?php echo $_smarty_tpl->tpl_vars['textos_layout']->value[1];?>
</h2>
	
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['FOOTER']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>