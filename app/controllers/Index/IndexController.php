<?php

/**
 * Controller Index
 * @author Linea Comunica��o com Design - http://www.lineacom.com.br
 *
 */
class IndexController extends ControllerBase {

    public function IndexController($controller, $action, $urlparams) {
        //Inicializa os par�metros da SuperClasse
        parent::ControllerBase($controller, $action, $urlparams);
        //Envia o Controller para a action solicitada
        $this->$action();
    }

    private function index_action() {
        //Apresenta a view
        $this->getNoticia();
        $this->View()->assign('Helper', HelperFactory::getInstance());
        $this->View()->display('index.php');
    }

    private function getNoticia() {
        $dados_noticias = $this->Delegator('IndexModel', 'SelectNoticias');
        $this->View()->assign('dados_noticias', $dados_noticias);
        return $dados_noticias;
    }

}

?>