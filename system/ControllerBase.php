<?php
Abstract class ControllerBase {

	//Atributos da Classe
	private $controller = null;
	private $view = null;
	private $action = null;
	private $_params = null;

	/**
	 * Construtor da Classe
	 */
	public function ControllerBase($controller,$action,$params)
	{
		//********* Inicializa os atributos da classe ***********
		$this->controller = $controller;
		$this->action = $action;
		$this->_params = $params;
		//*******************************************************

		//******* Setando o Template Engine *********
		$this->view = new Smarty($this->controller);
		//Setando o delimitador esquerdo
		$this->view->left_delimiter = '{view}';
		//Setando o delimitador direito
		$this->view->right_delimiter = '{/view}';
		//desativa a checagem de compilação
		$this->view->compile_check = false; 
		//Modo Debug desligado
		$this->view->debugging = false;
		//Ativando Caching
		//$this->view->caching = true;
		//Força a compilação(desativando cache)
		$this->view->force_compile = true;
		//Tempo de vida do Cache
		$this->view->cache_lifetime = 0;		
		//*******************************************
		
		//******* Setando os parâmetros default do framework *********
		
		//Instancia a Classe para SEO
		$Pageinfo = new Pageinfo();
		
		//Busca os dados do website
		$recordset_site_info = $Pageinfo->getWebSiteInfo();
		
		//Define as constantes do framework
		$this->setFrameworkConstants($recordset_site_info);
		
		//Define as constantes do Template Engine
		$this->setTemplateConstants($Pageinfo, $recordset_site_info);
		
		//seta o idioma do website
		$this->setLanguage($recordset_site_info);
		
		//seta os textos do website
		$this->setLayoutTexts();
		
		//Registra o visitante
		$this->setNewVisitor();
		
		//Define as configurações de SEO(Search Engine Optimization)
		$this->defineSEOConfiguration($Pageinfo);
		
		//Define as constantes do Rodapé
		$this->defineFooterConstants();		
		//*******************************************
	}

	/**
	 * Retorna o Controller( Nome do Controller )
	 */
	protected function Controller()
	{
		return $this->controller;
	}

	/**
	 * Retorna a Instancia da View
	 */
	protected function View()
	{
		return $this->view;
	}

	/**
	 * Retorna a Action
	 */
	protected function Action()
	{
		return $this->action;
	}

	/**
	 * Cria e retorna um novo Objeto do tipo Standard Class
	 * @return stdClass
	 */
	protected function CreateObject()
	{
		return new stdClass();
	}

	/**
	 * Delega uma função para um determinado Model e retorna o resultado da tarefa
	 * @param String $DelegateClass - Classe que cuidará da tarefa
	 * @param String $action - Método que esta Classe deverá executar
	 * @param Array/stdClass $parameters - Parâmetros que esta Classe deverá Receber
	 * @return Ambiguous - Tipo de Retorno Depende da Classe
	 */
	protected function Delegator($DelegateClass,$action,$parameters=null)
	{
		//Verifica se os parâmetros são um Array ou Objeto
		if( (!is_array($parameters) && !is_object($parameters)) && !is_null($parameters) ) die("Delegator -> Parâmetro inválido");

		//Requisita o Arquivo do Model Delegator
		include_once("system/delegators/ModelDelegator.php");
		//Delegamos a tarefa para a classe responsabilizada
		$resultado_tarefa = ModelDelegator::delegate($DelegateClass,array($this->controller,$action,$parameters));
			
		//Retornamos o resultado da tarefa
		return $resultado_tarefa;
	}

	/**
	 * Retorna um parâmetro da URL(VIA GET)
	 * @param String $name
	 * @return boolean|multitype:
	 */
	protected function getParam($name = null)
	{
		if($name != null)
		{
			if(array_key_exists($name,$this->_params))
			{
				return $this->_params[$name];
			}else{
				return false;
			}
		}else{
			return $this->_params;
		}
	}

	/**
	 * Modifica ou cria uma chave no Array da Requisição POST atual
	 * @param String $key
	 * @param String $value
	 */
	protected function setPost($key,$value){
		$_POST[$key] = $value;
	}

	/**
	 * Retorna o valor de uma determinada chave do Array POST, se nenhuma chave for informada então todo Array POST será Retornado
	 * @param String $name
	 * @return Ambiguous
	 */
	protected function getPost($name=null)
	{
		if($name != null)
		{
			if(array_key_exists($name,$_POST))
			{
				return $_POST[$name];
			}else{
				return false;
			}
		}else{
			return $_POST;
		}
	}

	/**
	 * Recebe um parâmetro de GET ou POST
	 * @param String $name -> nome do parâmetro a ser recebido
	 * @return
	 */
	protected function getRequestParam($name=null){
		//Verifica se existe em GET
		if($this->getParam($name) != FALSE){
			//Retorna via GET
			return $this->getParam($name);
		}
		//Verifica se existe em POST
		else if($this->getPost($name) != FALSE){
			//Retorna via POST
			return $this->getPost($name);
		}
		//Retorn falso pois o parâmetro não foi encontrado em GET/POST
		else{
			return false;
		}
	}

	/**
	 * Seta os textos padrão do layout
	 */
	private function setLayoutTexts()
	{	
		//Busca os textos de layout conforme idioma
		$TextosLayout = TableFactory::getInstance('TextosLayout')->getLayoutTexts();
		
		//Instancia a tabela de textos
		$Textos_site = TableFactory::getInstance('Textos')->getTexto();
		
		//Envia os textos do idioma selecionado para a view
		$this->View()->assign('textos_layout',$TextosLayout);
		//Envia os textos do site para a view
		$this->View()->assign('textos_site',$Textos_site);
	}

	/**
	 * Conta um novo visitante
	 */
	private function setNewVisitor(){

		/* Verifica se a requisição é via ajax, se for ajax não é contado como visita, somente se a url se alterar no browser
		   [OU]
		   se o sistema estiver executando a action gerarCaptcha a contagem não é executada pois o processamento é interno
		   não fazendo parte das views
		 */
		if( !(HelperFactory::getInstance()->isAjax()) && !(strtolower($this->action) == "gerarcaptcha") ){
					
			//Instanciamos a tabela WebsiteStats
			TableFactory::getInstance('WebsiteStats')->ExecuteContagem();
		}
	}

	/**
	 * Seta o idioma do website
	 */
	private function setLanguage($recordset_site_info)
	{
		//******************* Verifica o idioma a ser apresentado ********************

		//Verifica se o usuário solicitou a mudança de idioma
		if($this->getParam('idioma') != false)
		{		
			//Instancia a tabela de Idiomas
			$TabelaIdiomas = TableFactory::getInstance('WebsiteIdiomas');

			//Verifica se o idioma solicitado existe
			if($TabelaIdiomas->VerificarIdioma($this->getParam('idioma')))
			{
				//Troca o idioma
				define('LANGUAGE',$_SESSION['language']);
				//Sigla do Idioma
				define('LANGUAGE_TXT_META',$_SESSION['language_txt_meta']);
				
			}else{ //Cai aqui se o idioma não existir, neste caso ele pega o idioma default

				//Idioma padrão
				define('LANGUAGE',$recordset_site_info['cod_idioma_default']);
				//Sigla do Idioma
				define('LANGUAGE_TXT_META',$TabelaIdiomas->getMeta($recordset_site_info['cod_idioma_default']));
			}
		}

		//Cai neste else se o usuário não solicitou mudança de idioma
		else
		{
			if(isset($_SESSION['language']))
			{
				//idioma escolhido pelo usuario
				define('LANGUAGE',$_SESSION['language']);
				//Sigla do Idioma
				define('LANGUAGE_TXT_META',$_SESSION['language_txt_meta']);
			}
			else
			{
				//Instancia a tabela de Idiomas
				$TabelaIdiomas = TableFactory::getInstance('WebsiteIdiomas');
				//Idioma padrão
				define('LANGUAGE',$recordset_site_info['cod_idioma_default']);
				//Sigla do Idioma
				define('LANGUAGE_TXT_META',$TabelaIdiomas->getMeta($recordset_site_info['cod_idioma_default']));
			}
		}
			
		//Referencia o Idioma DEFAULT na View
		$this->View()->assign('IDIOMA_DEFAULT',LANGUAGE);
		//Referencia a Sigla do Idioma DEFAULT na View
		$this->View()->assign('TXT_META',LANGUAGE_TXT_META);
		//Seta os links dos idiomas disponiveis
		$this->defineLanguageLinks();
	}
	
	/**
	 * Define os links da troca de idiomas 
	 */
	private function defineLanguageLinks(){
		
		############DEFININDO TODOS OS LINKS DOS IDIOMAS DISPONIVEIS ############
		$parametros = $this->getParam();
		$concatenar = "";
		
		foreach($parametros as $key => $para)
		{
			if($key != "idioma"){
		
				$concatenar .= $key."/".$para."/";
			}
		}
		$this->view->assign("LANGUAGE_LINKS",DEFAULT_URL.$this->controller."/".($this->action == 'index_action' ? 'index' : $this->action)."/".$concatenar);
		############ FIM VERIFICAÇÃO IDIOMAS DISPONIVEIS  ############		
	}
		
	/**
	 * Configura as constantes do Rodapé 
	 */
	private function defineFooterConstants(){
		
		//Informações a respeito do endereço da empresa
		$dados_endereco = TableFactory::getInstance('Contatos')->Buscaendereco();
			
		//Envia os dados ao Smarty
		$this->view->assign("DADOS_ENDERECO",$dados_endereco);		
	}
	
	/**
	 * Configura as constantes do cabecalho 
	 
	private function defineHeaderConstants(){
		
		
	}
	*/
	
	/*
	 * Define as configurações de SEO(Search Engine Optimization)
	 */
	private function defineSEOConfiguration($Pageinfo){
		
		//Busca as informações da página atual
		$recordset_pagina_atual = $Pageinfo->getPageInfo();
			
		//Titulo da Página
		$this->view->assign("TXT_TITLE",$recordset_pagina_atual['txt_title']);
		//Keywords da Página
		$this->view->assign("TXT_KEYWORDS",$recordset_pagina_atual['txt_keywords']);
		//Descrição da Página
		$this->view->assign("TXT_DESCRIPTION",$recordset_pagina_atual['txt_description']);
	}
	
	/**
	 * Configura os parâmetros do framework(Constantes)
	 */
	private function setFrameworkConstants($recordset_site_info)
	{
		//****************** Constantes para o FRAMEWORK  *************************************************
			
		//URL DEFAULT
		define('DEFAULT_URL', $recordset_site_info['url_default']);
		//Define uma constante informando o Controller acessado atualmente no framework
		define('CONTROLLER_ATUAL', $this->controller);
		//Define uma constante informando a Action acessado atualmente no framework
		define('ACTION_ATUAL', $this->action);
			
		//*******************************************************************************************
	}

	/**
	 * Configura os parâmetros do Template Engine(Constantes)
	 */
	private function setTemplateConstants($Pageinfo,$recordset_site_info)
	{				
		//*************************** Constantes do Smarty ******************************************
		
		//CONTROLLER_ATUAL
		$this->view->assign("CONTROLLER_ATUAL",$this->controller);
		//ACTION_ATUAL
		$this->view->assign("ACTION_ATUAL",$this->action);
		//URL DEFAULT
		$this->view->assign("URL_DEFAULT",DEFAULT_URL);
		//CSS SCREEN
		$this->view->assign("URL_CSS_SCREEN",DEFAULT_URL.$recordset_site_info['url_css_screen']);
		//Caminho das Imagens ARQ-DIN
		$this->view->assign("ARQ_DIN",DEFAULT_URL."web_files/arq_din/");
		//Caminho das Imagens IMG
		$this->view->assign("IMG",DEFAULT_URL."web_files/img/");
		//Caminho dos Arquivos CSS
		$this->view->assign("CSS",DEFAULT_URL.'web_files/css/');
		//Caminho dos Arquivos JS
		$this->view->assign("JS",DEFAULT_URL.'web_files/js/');
		//Caminho do Ajax
		$this->view->assign("AJAX",DEFAULT_URL.'web_files/ajax/http_request.js');
		//Caminho do Cabeçalho
		$this->view->assign("HEAD",'app/view/templates/Cabecalho/index.php');
		//Caminho do Rodape
		$this->view->assign("FOOTER",'app/view/templates/Rodape/index.php');
		//GOOGLE ANALYTICS
		$this->view->assign("TXT_GANALYTICS",$recordset_site_info['txt_ganalytics']);
		//*******************************************************************************************
	}
}
?>