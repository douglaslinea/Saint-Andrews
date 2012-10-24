<?
class FaleconoscoValidacao
{
	public function ValidarFormulario($PostData)
  	{
  		$Validation = LibFactory::getInstance('validation',null,'validation/Validation.class.php');
  		
  		//Instanciando a tabela de TextosLayout
		$TabelaTextosLayou = TableFactory::getInstance('TextosLayout');
			
		//faz o select para buscar o conteúdo
		$erro = $TabelaTextosLayou->getLayoutTexts();

  		$Validation	->set($PostData['txt_nome'],$erro[4],'txt_nome', 'msg_txt_nome')->obrigatorio()
  					->set($PostData['txt_email'],$erro[13],'txt_email','msg_txt_email')->email()
  					->set($PostData['txt_email'],$erro[5],'txt_email','msg_txt_email')->obrigatorio()
					->set($PostData['txt_telefone'],$erro[11],'txt_telefone','msg_txt_telefone')->obrigatorio()
  					->set($PostData['txt_assunto'],$erro[6],'txt_assunto', 'msg_txt_assunto')->obrigatorio()
  					->set($PostData['txt_mensagem'],$erro[7],'txt_mensagem', 'msg_txt_mensagem')->obrigatorio()
  					->set($PostData['captcha'],$erro[8],'captcha','msg_captcha')->obrigatorio()
					->set($PostData['captcha'],$erro[14],'captcha','msg_captcha')->captcha($_SESSION['captcha']);
	   	
		//Retorna o array de erros
	   	return $Validation->getErrors();
	} 
}
?>