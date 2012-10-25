<?php
/**
 * Model do Controller Index
 * O objetivo desta classe � conectar O Controller com o seu Modelo de Abstra��o
 * Que por sua vez conectar� o Controller com a base de dados (Vide Classe Database)
 * @author Linea Comunica��o com Design - http://www.lineacom.com.br
 *
 */
class IndexModel
{	
	public function SelectNoticias(){
            return TableFactory::getInstance('ImprensaNoticias')->SelectNoticias();
        }
        
}
?>