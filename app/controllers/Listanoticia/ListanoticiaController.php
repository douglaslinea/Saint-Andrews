<?php
class ListanoticiaController extends ControllerBase
{
	/* Método Construtor do Controller(Obrigatório Conter em Todos os Controllers)
	 * Params String Action -> Ação a ser Executada Pelo Controller
	 * Atenção Demais Métodos do Controller Devem ser Privados
	 */
	public function ListanoticiaController($controller,$action,$urlparams)
	{
		//Inicializa os parâmetros da SuperClasse
		parent::ControllerBase($controller, $action,$urlparams);
		//Envia o Controller para a action solicitada
		$this->$action();
	}

	private function index_action()
	{
		//Solicita os dados
		$resultado = $this->Delegator('ConcreteListanoticia', 'SelectNoticias');
		
		//Coloca o Helper na View
	   	$this->View()->assign('Helper',HelperFactory::getInstance());
			
		//Leva os dados para a view
		$this->View()->assign('dados_noticias',$resultado);

		//Exibe a view
		$this->View()->display('index.php');
	}
	
	private function detalhes()
	{		
		//pega o id do permalink
		$id = HelperFactory::getInstance()->getPermalink();

		//Valida o id verificando se ele é numérico e se tem algo no id
		if($id !== false && is_numeric($id))
		{
			//pega o permalink por inteiro
			$permalink = HelperFactory::getInstance()->getPermalink(true);
			
			//Seleciona os dados do id
			$resultado = $this->Delegator('ConcreteListanoticia', 'SelectNoticiasId', array('permalink' => $permalink));
			
			//Verifica se tem dados
			if($resultado !== false)
			{
				//Coloca os dados na view
				$this->View()->assign('dados_noticias',$resultado);
				
				//Seleciona mais cinco dados tirando o já selecionado
				$resultado_mais_dados = $this->Delegator('ConcreteListanoticia', 'SelectMaisNoticias', array('permalink' => $permalink));
				
				//Coloca o Helper na View
	   			$this->View()->assign('Helper',HelperFactory::getInstance());
	   	
				//Coloca os dados na view
				$this->View()->assign('dados_noticias_mais_dados',$resultado_mais_dados);
			}
			else
			{
				//Envia uma flag para a view indicando que os dados não foram encontrados
				$this->View()->assign('conteudo_nao_encontrado',true);
			}
		}
		else
		{
			//Envia uma flag para a view indicando que os dados não foram encontrados
			$this->View()->assign('conteudo_nao_encontrado',true);
		}
		//Exibe a view
		$this->View()->display('detalhes.php');
	}
}