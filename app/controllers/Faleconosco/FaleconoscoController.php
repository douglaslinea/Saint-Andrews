<?php
class FaleconoscoController extends ControllerBase
{
	/* Mйtodo Construtor do Controller(Obrigatуrio Conter em Todos os Controllers)
	 * Params String Action -> Aзгo a ser Executada Pelo Controller
	 * Atenзгo Demais Mйtodos do Controller Devem ser Privados
	*/
	public function FaleconoscoController($controller,$action,$urlparams)
	{
		//Inicializa os parвmetros da SuperClasse
		parent::ControllerBase($controller, $action,$urlparams);
		//Envia o Controller para a action solicitada
		$this->$action();
	}
	
	private function index_action($params=null)
	{
		//Solicita os dados da Vaga
		$resultados = $this->Delegator('ConcreteFaleconosco', 'SelectContatos');

		//joga o $dados na view
		$this->View()->assign('dados_contatos',$resultados);
		
		//verifica se foi post
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$this->enviar();
		}
		
		//Verifica se hб dados extras a serem adicionados na view(via parametro)
		if(!is_null($params))
		{
			//Adiciona os dados extras na view
			$this->View()->assign('params',$params);
		}
		//Verifica se hб dados extras a serem adicionados na view(via SESSГO)
		else if(isset($_SESSION['view_data']))
		{
			//Adiciona os dados extras na view
			$this->View()->assign('params',$_SESSION['view_data']);
			//Elimina a sessгo
			unset($_SESSION['view_data']);
		}
		
		//mostra a view
		$this->View()->display('detalhes.php');
	}
	
	private function enviar()
	{
		//verifica se foi post
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			//envia os dados
			$resultado_validacao = $this->Delegator("ConcreteFaleconosco","InsertFaleconosco", $this->getPost());
		}
	}
	
	private function gerarCaptcha()
	{
		//envia os dados para o ConcreteFaleconosco
		return $this->Delegator("ConcreteFaleconosco","Captcha");
	}
}
?>