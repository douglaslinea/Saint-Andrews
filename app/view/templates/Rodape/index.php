<div id="footer">
    Endere&ccedil;o: {view}$DADOS_ENDERECO.txt_endereco{/view}, 
	{view}if $DADOS_ENDERECO.txt_bairro{/view} - {view}$DADOS_ENDERECO.txt_bairro{/view} {view}/if{/view}<br />
	CEP: {view}$DADOS_ENDERECO.txt_cep{/view}<br />
	{view}$DADOS_ENDERECO.txt_cidade{/view} / {view}$DADOS_ENDERECO.txt_uf{/view} / {view}$DADOS_ENDERECO.cha_sigla{/view}<br /><br />
	Telefone: {view}$DADOS_ENDERECO.txt_telefone{/view}<br />
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