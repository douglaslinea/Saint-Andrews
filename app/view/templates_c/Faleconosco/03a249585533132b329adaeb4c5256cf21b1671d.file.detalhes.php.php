<?php /* Smarty version Smarty-3.1.1, created on 2012-10-24 11:48:20
         compiled from "app/view/templates/Faleconosco/detalhes.php" */ ?>
<?php /*%%SmartyHeaderCode:17123839865087f1a44a3bf1-29374831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03a249585533132b329adaeb4c5256cf21b1671d' => 
    array (
      0 => 'app/view/templates/Faleconosco/detalhes.php',
      1 => 1349986063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17123839865087f1a44a3bf1-29374831',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HEAD' => 0,
    'DADOS_ENDERECO' => 0,
    'params' => 0,
    'URL_DEFAULT' => 0,
    'textos_layout' => 0,
    'dados_contatos' => 0,
    'FOOTER' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_5087f1a473b3e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5087f1a473b3e')) {function content_5087f1a473b3e($_smarty_tpl) {?><!-- <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['HEAD']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
 -->

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function()
		{
				    var latlng = new google.maps.LatLng(<?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['cod_latitude'];?>
,<?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['cod_longitude'];?>
);

				    var myOptions = {
				    	    zoom: 16,
				    	    center: latlng,
				    	    mapTypeId: google.maps.MapTypeId.ROADMAP
				    };
				
				    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				
				    var marker = new google.maps.Marker({
				        position: latlng, 
				        map: map
				    });
		});
</script>



 <?php if (isset($_smarty_tpl->tpl_vars['params']->value['mensagem_confirmacao'])){?>
<div class="notification success">
	<a href="" class="close-notification"
		title="Fechar notifica&ccedil;&atilde;o" rel="tooltip">x</a>
	<p><?php echo $_smarty_tpl->tpl_vars['params']->value['mensagem_confirmacao'];?>
</p>
</div>
<?php }?>



<form name="frm_contatos" id="frm_contatos"
	action="javascript:acao('<?php echo $_smarty_tpl->tpl_vars['URL_DEFAULT']->value;?>
faleconosco/enviar', 'frm_contatos', '<?php echo $_smarty_tpl->tpl_vars['URL_DEFAULT']->value;?>
faleconosco', new Array('<?php echo $_smarty_tpl->tpl_vars['textos_layout']->value[3];?>
', '<?php echo $_smarty_tpl->tpl_vars['textos_layout']->value[2];?>
'), 'btn_enviar')"
	method="post">
	<fieldset>
		<legend>Dados do registro</legend>
		<dl>
			<dt>
				<label>Nome</label>
			</dt>
			<dd>
				<input type="text" name="txt_nome" id="txt_nome" maxlength="255" />
				<span id="msg_txt_nome"></span>
			</dd>

			<dt>
				<label>E-mail:</label>
			</dt>
			<dd>
				<input type="text" name="txt_email" id="txt_email" maxlength="255" />
				<span id="msg_txt_email"></span>
			</dd>

			<dt>
				<label>Telefone:</label>
			</dt>
			<dd>
				<input type="text" name="txt_telefone" id="txt_telefone"
					maxlength="14" onkeyup="mascara($(this),soTelefone);" /> <span
					id="msg_txt_telefone"></span>
			</dd>

			<dt>
				<label>Assunto:</label>
			</dt>
			<dd>
				<input type="text" name="txt_assunto" id="txt_assunto"
					maxlength="255" /> <span id="msg_txt_assunto"></span>
			</dd>

			<dt>
				<label>Mensagem:</label>
			</dt>
			<dd>
				<textarea name="txt_mensagem" id="txt_mensagem"></textarea>
				<span id="msg_txt_mensagem"></span>
			</dd>

			<dt>
				<label>Captcha:</label>
			</dt>
			<dd>
				<img src="<?php echo $_smarty_tpl->tpl_vars['URL_DEFAULT']->value;?>
faleconosco/gerarCaptcha"
					alt="captcha" width="150" /> <input type="text" name="captcha"
					id="captcha" maxlength="6" /> <span id="msg_captcha"></span>
			</dd>
		</dl>
	</fieldset>

	<button type="submit" id="btn_enviar" />
	Enviar
	</button>
</form>


<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['razao_social'])){?>
<strong>Raz&atilde;o Social</strong>
<br />
<h3><?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['razao_social'];?>
</h3>
<?php }?> <?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['cnpj'])){?>
<strong>CNPJ</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['cnpj'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['endereco'])){?>
<strong>Endere&ccedil;o</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['endereco'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['numero'])){?>
<strong>N&uacute;mero</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['numero'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['complemento'])){?>
<strong>Complemento</strong>
<br />
/ <?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['complemento'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['cep'])){?>
<strong>CEP</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['cep'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['bairro'])){?>
<strong>Bairro</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['bairro'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['CepCidades']['txt_cidade'])){?>
<strong>Cidade</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['CepCidades']['txt_cidade'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['CepUf']['txt_uf'])){?>
<strong>UF</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['CepUf']['txt_uf'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['pais'])){?>
<strong>Pa&iacute;s</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['pais'];?>
 <?php }?>
<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['telefone'])){?>
<strong>Telefone</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['telefone'];?>
 <?php }?>
<br />
<br />

<strong>Localiza&ccedil;&atilde;o no Google Maps</strong>
<br />

<div id="map_canvas" style="width:40%; height:40%"></div>

<br />
<br />

<?php if (($_smarty_tpl->tpl_vars['dados_contatos']->value['txt_email'])){?>
<strong>E-mail</strong>
<br />
<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['txt_email'];?>
 <?php }?>

<br />
<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['txt_email'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['dados_contatos']->value['txt_email'];?>
</a>
 
 <h1><?php echo $_smarty_tpl->tpl_vars['textos_layout']->value[21];?>
</h1>
    <p><?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['endereco'];?>
, <?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['numero'];?>
, <?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['CepCidades']['txt_cidade'];?>
 / <?php echo $_smarty_tpl->tpl_vars['DADOS_ENDERECO']->value['CepUf']['cha_sigla'];?>
</p>
    
 
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['FOOTER']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>