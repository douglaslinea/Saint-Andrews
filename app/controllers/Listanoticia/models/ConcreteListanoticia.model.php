<?php
/**
 * Model
 * O objetivo desta classe щ conectar o Controller com o seu Modelo de Abstraчуo
 * Que por sua vez conectarс o Controller com a base de dados (Vide Classe Database)
 * @author Linea Comunicaчуo - http://www.lineacom.com.br
 *
 */
class ConcreteListanoticia extends Noticias
{
	public function SelectNoticias()
	{
		return parent::SelectNoticias();
	}
	
	public function SelectNoticiasId($parametros)
	{
		return parent::SelectNoticiasId($parametros['permalink']);
	}
	
	public function SelectMaisNoticias($parametros)
	{
		return parent::SelectMaisNoticias($parametros['permalink']);
	}
}
?>