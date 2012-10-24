<?php
class ConcreteFaleconosco
{
	private function ConfiguraEmail(mailHelper $MailHelper)
	{
		//Dados do SMTP
		$MailHelper->IsSMTP();
		$MailHelper->Port = 587;
		$MailHelper->Mailer = 'smtp';
		$MailHelper->setHost(EMAIL_HOST);
		$MailHelper->setSMTPAuth(true);
		$MailHelper->setUserName(USERNAME_HOST);
		$MailHelper->setPassword(PASSWORD_HOST);
		$MailHelper->setFromName("LINEA");
		$MailHelper->setFrom('teste@lineacom.com.br');
		$MailHelper->setSubject('Confirmação de envio de formulário via website (Fale Conosco) - LINEA');
		$MailHelper->setIdioma('br','phpMailer/language/');
		$MailHelper->setWrap(50);
		$MailHelper->setIsHtml(true);
		
		//Retorna o objeto Mail
        return $MailHelper;
	}
		
	public function SelectContatos()
	{
		return TableFactory::getInstance('Contatos')->SelectContatos();
	}
	
	//envia email para o usuário
	public function MandaEmailUsuario($parametros)
	{
		//Instancia o Helper Mail           
        $MailHelper = HelperFactory::getInstance('mail');

        //Configura o Helper Mail
		$MailHelper = $this->ConfiguraEmail($MailHelper);
            
        //Corpo do e-mail para o remetente do formulário
        $mail_body = "<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#1A1A1A'>Confirmamos o recebimento de seu contato pelo website. Em breve estaremos enviando a resposta.<br /><br />";

		$mail_body .= "<b>Nome:</b> ".$parametros['txt_nome']."<br />";
		$mail_body .= "<b>E-mail:</b> ".$parametros['txt_email']."<br />";
		$mail_body .= "<b>Telefone:</b> ".$parametros['txt_telefone']."<br />";
		$mail_body .= "<b>Assunto:</b> ".$parametros['txt_assunto']."<br />";
		$mail_body .= "<b>Mensagem:</b> ".$parametros['txt_mensagem']."<br /><br />";

		$mail_body .= "<b>Att.,</b><br />";
		$mail_body .= "<b>LINEA</b><br />";
		$mail_body .= "<a href='http://www.lineacom.com.br'>www.lineacom.com.br</a></font>";
		
        //Seta o corpo do E-mail
        $MailHelper->setBody($mail_body);
            
        //Seta o Email
        $MailHelper->setAddress($parametros['txt_email']);
                                
        //Envia o E-mail            
        return $MailHelper->sendEmail();
	}
	
	//Envia o email para o admin
	public function MandaEmailAdmin($parametros)
	{
		//Instancia o Helper Mail           
        $MailHelper = HelperFactory::getInstance('mail');

        //Configura o Helper Mail
		$MailHelper = $this->ConfiguraEmail($MailHelper);
			
        //Corpo do e-mail para o cliente
        $mail_body = "<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#1A1A1A'>Novo formulário de contato recebido pelo website:<br /><br />";
		$mail_body .= "<b>Nome:</b> ".$parametros['txt_nome']."<br />";
		$mail_body .= "<b>E-mail:</b> ".$parametros['txt_email']."<br />";
		$mail_body .= "<b>Telefone:</b> ".$parametros['txt_telefone']."<br />";
		$mail_body .= "<b>Assunto:</b> ".$parametros['txt_assunto']."<br />";
		$mail_body .= "<b>Mensagem:</b> ".$parametros['txt_mensagem']."<br /><br />";
		
		//Seta o corpo do E-mail
        $MailHelper->setBody($mail_body);
        
        //Dados da tabela contatos
		//$dados_tabela_EmailsFormularios = $TabelaEmailsFormularios->BuscaDados('2');

		//Seta o Email
		$MailHelper->setAddress('desenvolvimento@lineacom.com.br');                            
           
        return $MailHelper->sendEmail();
	}
	
	public function InsertFaleconosco($parametros)
	{
		//Inclui a biblioteca do JSON
		LibFactory::getInstance(null,null,'Zend/Json.php');
		
		//Instanciamos o componente de validação
		$ComponenteValidacao = getComponent('validacoes/faleconosco.validacao','FaleconoscoValidacao');
			
		//Executamos a validação dos dados
		$resultado_validacao = $ComponenteValidacao->ValidarFormulario($parametros);
		
		//Verifica o resultado da validacao
		if(count($resultado_validacao) == 0)
		{
			//Trata os dados antes de gravar no banco de dados
			$parametros = HelperFactory::getInstance()->TrataValor($parametros,null,null,null,true);
			
			//Inclui o registro no banco de dados
			if(TableFactory::getInstance('FaleConosco')->incluirFaleConosco($parametros))
			{
				//Instancia a tabela de Textos Layout e retorna os textos cadastrados com base no idioma selecionado
				$TextosLayout = TableFactory::getInstance('TextosLayout')->getLayoutTexts();
				
				//Pega os textos de acordo com o idioma selecionado
				$TextosLayout2 = $textosLayout->getLayoutTexts();
				
				//Mensagem de confirmação via SESSION(usar sempre o indice view_data)
				$_SESSION['view_data'] = array('mensagem_confirmacao' => $TextosLayout2[21]);
				
				//chama metodo que manda mail para o usuaário
				$this->MandaEmailUsuario($parametros);
				
				//Manda email para o administrador
				$this->MandaEmailAdmin($parametros);

				//Retorna true em caso de sucesso
				echo Zend_Json::encode(array("1", $parametros['txt_email']));
			}
			else
			{
				//Erro ao cadastrar o Servicos
				return false;
			}
			 
		}else{
				
			//Retorna os erros da validação
			echo Zend_Json::encode($resultado_validacao);
		}
	}
	
	public function Captcha()
	{
		$helper = HelperFactory::getInstance('captcha');

		//informa(Imagem de fundo do captcha, a fonte que será usada, toral caracteres, tamanho da fonte, angulo)
		$helper->CreateCaptcha(DEFAULT_CAPTCHA_IMAGE,DEFAULT_CAPTCHA_FONT,6, 30, 0);
	}
} 
?>