<div id="footer">
	Endereço: {view}$DADOS_ENDERECO.endereco{/view}, {view}$DADOS_ENDERECO.numero{/view}
	{view}if $DADOS_ENDERECO.complemento{/view} / {view}$DADOS_ENDERECO.complemento{/view} {view}/if{/view}
	{view}if $DADOS_ENDERECO.bairro{/view} - {view}$DADOS_ENDERECO.bairro{/view} {view}/if{/view}<br />
	CEP: {view}$DADOS_ENDERECO.cep{/view}<br />
	{view}$DADOS_ENDERECO.CepCidades.txt_cidade{/view} / {view}$DADOS_ENDERECO.CepUf.txt_uf{/view} / {view}$DADOS_ENDERECO.CepUf.cha_sigla{/view}<br /><br />
	Telefone: {view}$DADOS_ENDERECO.telefone{/view}<br />
</div>

<!-- close wrapper -->
</div>

<script src="{view}$JS{/view}mascaras.js" type="text/javascript"></script>
<script src="{view}$JS{/view}functions.util.js" type="text/javascript"></script>
<script src="{view}$JS{/view}json_functions.js" type="text/javascript"></script>
<script src="{view}$JS{/view}maskedinput.js" type="text/javascript"></script>
<script src="{view}$AJAX{/view}" type="text/javascript"></script>

{view}$TXT_GANALYTICS{/view}
</body>
</html>