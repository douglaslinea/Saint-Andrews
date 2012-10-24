{view}include file="{view}$HEAD{/view}"{/view}	


<body>

<div id="wrapper-conteudo">

<div class="header">
Teste de troca de idioma: <a href="{view}$LANGUAGE_LINKS{/view}idioma/pt-br">pt</a> - <a href="{view}$LANGUAGE_LINKS{/view}idioma/en-us">en</a>  - <a href="{view}$LANGUAGE_LINKS{/view}idioma/es">es</a>

<nav>
    <ul>
    	<li><a href="{view}$URL_DEFAULT{/view}">Index</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}cadastro">(Modelo) Cadastro</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}fale-conosco">(Modelo) Fale Conosco</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}lista-comum">(Modelo) Lista comum</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}noticia">(Nova) Noticias</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}login">(Modelo) Login</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}texto">(Modelo) Texto</a></li>
    </ul>
</nav>

</div


Teste de t&iacute;tulo/texto from table "textos"<br />
<h1>{view}$textos_site[1]['txt_titulo']{/view}</h1>
{view}$textos_site[1]['texto']{/view}<br />

<br /><br />
Teste de texto from table "textosLayout"<br />
<h2>{view}$textos_layout[1]{/view}</h2>
	
{view}include file="{view}$FOOTER{/view}"{/view}