<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- favicon -->
<link rel="icon" href="{view}$img_icon{/view}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{view}$img_icon_iphone{/view}" />

<!-- seo tags -->
<title>{view}$TXT_TITLE{/view}</title>
<meta name="DC.title" content="{view}$TXT_TITLE{/view}" />

<meta name="description" content="{view}$TXT_DESCRIPTION{/view}" />
<meta name="DC.subject" lang="pt" content="{view}$TXT_DESCRIPTION{/view}" />
<meta name="DC.description" lang="pt" content="{view}$TXT_DESCRIPTION{/view}" />
<meta name="Abstract" content="{view}$TXT_DESCRIPTION{/view}" />
<meta name="keywords" content="{view}$TXT_KEYWORDS{/view}" />
<meta name="DC.identifier" scheme="DCTERMS.URI" content="{view}$URL_DEFAULT{/view}" />

<!-- geoURL -->
<!-- <meta name="ICBM" content="XXX.XXXXX, XXX.XXXXX"> -->

<!-- document -->
<meta name="resource-type" content="document" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="distribution" content="global" />
<meta name="rating" content="general" />
<meta name="robots" content="ALL" />
<meta name="mssmarttagspreventparsing" content="true" />

<meta name="language" content="{view}$TXT_META{/view}" />

<link rel="canonical" href="{view}$URL_DEFAULT{/view}" />

<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
<link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />

<!-- css -->
<link href="{view}$URL_CSS_SCREEN{/view}" rel="stylesheet" type="text/css" />
<link href="{view}$CSS{/view}normalize.css" rel="stylesheet" type="text/css" />
<!--<link href="{view}$CSS{/view}print.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>

<script src="{view}$JS{/view}jquery.js" type="text/javascript"></script>

<script type="text/javascript">
function add_bookmark() {
var browsName = navigator.appName;
if (browsName == "Microsoft Internet Explorer") {
window.external.AddFavorite('{view}$URL_DEFAULT{/view}','{view}$TXT_TITLE{/view}' );
} else if (browsName == "Netscape") {
alert ("{view}$textos_layout[1]{/view}");
}
}

var $buoop = {} 
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "http://browser-update.org/update.js"); 
 document.body.appendChild(e); 
} 

</script>

<body>

<div id="wrapper-conteudo">

<div class="header">
Teste de troca de idioma: <a href="{view}$LANGUAGE_LINKS{/view}idioma/pt-br">pt</a> - <a href="{view}$LANGUAGE_LINKS{/view}idioma/en-us">en</a> - <a href="{view}$LANGUAGE_LINKS{/view}idioma/es">es</a>
<nav>
    <ul>
    	<li><a href="{view}$URL_DEFAULT{/view}">Index</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}cadastro">(Modelo) Cadastro</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}faleconosco">(Modelo) Fale Conosco</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}lista-comum">(Modelo) Lista comum</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}noticia">(Nova) Noticias</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}login">(Modelo) Login</a></li>
    	<li><a href="{view}$URL_DEFAULT{/view}texto">(Modelo) Texto</a></li>
    </ul>
</nav>
</div>


</head>
