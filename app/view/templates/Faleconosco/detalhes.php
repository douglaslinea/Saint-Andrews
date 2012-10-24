<!-- {view}include file="{view}$HEAD{/view}"{/view} -->

<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function()
		{
				    var latlng = new google.maps.LatLng({view}$DADOS_ENDERECO.cod_latitude{/view},{view}$DADOS_ENDERECO.cod_longitude{/view});

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



 {view}if isset($params.mensagem_confirmacao){/view}
<div class="notification success">
	<a href="" class="close-notification"
		title="Fechar notifica&ccedil;&atilde;o" rel="tooltip">x</a>
	<p>{view}$params.mensagem_confirmacao{/view}</p>
</div>
{view}/if{/view}



<form name="frm_contatos" id="frm_contatos"
	action="javascript:acao('{view}$URL_DEFAULT{/view}faleconosco/enviar', 'frm_contatos', '{view}$URL_DEFAULT{/view}faleconosco', new Array('{view}$textos_layout[3]{/view}', '{view}$textos_layout[2]{/view}'), 'btn_enviar')"
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
				<img src="{view}$URL_DEFAULT{/view}faleconosco/gerarCaptcha"
					alt="captcha" width="150" /> <input type="text" name="captcha"
					id="captcha" maxlength="6" /> <span id="msg_captcha"></span>
			</dd>
		</dl>
	</fieldset>

	<button type="submit" id="btn_enviar" />
	Enviar
	</button>
</form>


{view}if ($dados_contatos.razao_social){/view}
<strong>Raz&atilde;o Social</strong>
<br />
<h3>{view}$dados_contatos.razao_social{/view}</h3>
{view}/if{/view} {view}if ($dados_contatos.cnpj){/view}
<strong>CNPJ</strong>
<br />
{view}$dados_contatos.cnpj{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.endereco){/view}
<strong>Endere&ccedil;o</strong>
<br />
{view}$dados_contatos.endereco{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.numero){/view}
<strong>N&uacute;mero</strong>
<br />
{view}$dados_contatos.numero{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.complemento){/view}
<strong>Complemento</strong>
<br />
/ {view}$dados_contatos.complemento{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.cep){/view}
<strong>CEP</strong>
<br />
{view}$dados_contatos.cep{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.bairro){/view}
<strong>Bairro</strong>
<br />
{view}$dados_contatos.bairro{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.CepCidades.txt_cidade){/view}
<strong>Cidade</strong>
<br />
{view}$dados_contatos.CepCidades.txt_cidade{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.CepUf.txt_uf){/view}
<strong>UF</strong>
<br />
{view}$dados_contatos.CepUf.txt_uf{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.pais){/view}
<strong>Pa&iacute;s</strong>
<br />
{view}$dados_contatos.pais{/view} {view}/if{/view}
<br />
<br />

{view}if ($dados_contatos.telefone){/view}
<strong>Telefone</strong>
<br />
{view}$dados_contatos.telefone{/view} {view}/if{/view}
<br />
<br />

<strong>Localiza&ccedil;&atilde;o no Google Maps</strong>
<br />

<div id="map_canvas" style="width:40%; height:40%"></div>

<br />
<br />

{view}if ($dados_contatos.txt_email){/view}
<strong>E-mail</strong>
<br />
{view}$dados_contatos.txt_email{/view} {view}/if{/view}

<br />
<a href="mailto:{view}$dados_contatos.txt_email{/view}" target="_blank">{view}$dados_contatos.txt_email{/view}</a>
 
 <h1>{view}$textos_layout[21]{/view}</h1>
    <p>{view}$DADOS_ENDERECO.endereco{/view}, {view}$DADOS_ENDERECO.numero{/view}, {view}$DADOS_ENDERECO.CepCidades.txt_cidade{/view} / {view}$DADOS_ENDERECO.CepUf.cha_sigla{/view}</p>
    
 
{view}include file="{view}$FOOTER{/view}"{/view}
