<?php
class Textos extends BaseTextos
{
	private $table_alias = 'textos te';
	
	public function SelectTexto()
	{
		try
		{
			$query = Doctrine_Query::create()
			->select('*')
			->from($this->table_alias)
			->where("te.cod_idioma = ?", LANGUAGE)
			->execute()
			->toArray();
			
			return $query;
		}
	 	catch (Doctrine_Exception $e)
	 	{
	 		echo $e->getMessage();
		}
	}
	
	public function SelectTextoId($cod_id)
	{
		try
		{
			$query = Doctrine_Query::create()
			->select('*')
			->from($this->table_alias)
			->where("te.cod_id = ?",$cod_id)
			->andWhere("te.cod_idioma = ?", LANGUAGE)
			->execute();
			
			//Verifica se houve resultado
			if($query->count() > 0)
			{
				$dados = $query->toArray();
				return $dados[0];
			}
			else
			{
				return false;
			}
		}
	 	catch (Doctrine_Exception $e)
	 	{
	 		echo $e->getMessage();
		}
	}

	public function getTexto($ids=null)
	{
		try
		{
			//Monta a Query
			$query = Doctrine_Query::create()
			->select('*')
			->from($this->table_alias)
			->andWhere('te.cod_idioma = ?',LANGUAGE);
			
			//Verifica se pelo menos um id foi especificado, caso contrário todos os textos serão resgatados
			if(!is_null($ids)){
				
			   //Filtra pelos ids informados	
			   $query->whereIn('te.cod_texto',$ids);
			}

			//Executa a Query
			$recordset = $query->execute();
			
			//Armazena os textos em um array indexado pelo Id do texto
			$ArrayTextos = array();
			
			//Percorre os textos e atribui ao Array resultante
			foreach($recordset as $dado)
			{
				//Atribui os dados ao Array
				$ArrayTextos[$dado['cod_texto']] = array('txt_titulo' => $dado['txt_titulo'], 'texto' => $dado['txt_texto'], 'img' => $dado['img_texto']);				
			}

			//Retorna o array de textos
            return $ArrayTextos;
		}
		catch (Doctrine_Exception $e)
		{	
			 echo $e->getMessage();
		}	
	}
	
	/**
	 * Busca os dados dos textos
	 * @param Integer $cod_id
	 */
	/*public function ExecutegetTexto($cod_id){
		
		try {
			
			//Monta a Query
			$query = Doctrine_Query::create()
					 ->select('*,idioma.*')
					 ->innerJoin('wt.WebsiteIdiomas as idioma')
					 ->from($this->table_alias)
					 ->where('id = ?',$cod_id)
					 ->limit('1');					 
					 
			//Verifica se houve resultado		 
			if($query->count() > 0){
			
				//Executa a query
				$recordset = $query->execute();			
				//Retorna os dados resgatados
				return $recordset[0];
				
			}else{
			
				return false;
			}		 			
			
		} catch (Doctrine_Exception $e) {
			
			echo $e->getMessage();
		}
	}*/
	
	/**
	 * Salva os dados da atualização do texto no banco de dados
	 * @param Array $parametros
	 */
	/*public function ExecuteEditaTexto($parametros){
	
		try {
			
			//Localiza o registro
			$tabela = $this->getTable()->find($parametros['id']);

			//Verifica se o registro foi encontrado
			if($tabela){
				
					  //Recebe os campos da tabela com seus respectivos valores
					  $campos_tabela = $this->setValues($tabela, $parametros, UPDATE);
	
					  //Percorre os campos da tabela
					  foreach($campos_tabela as $chave => $valor){
					  
						  	//Atribui o valor ao campo da tabela em questão
						  	$tabela->$chave = $campos_tabela->$chave;				  	
					  }
					  
					  //Atualiza as informações do registro no banco de dados
					  $tabela->save();
					  
					  //Retorna true em caso de sucesso
					  return true;
			
			}else{

				      //Retorn falso em caso de erro
				  	  return false;
			}
			
		} catch (Doctrine_Exception $e) {
			
			echo $e->getMessage();
		}		
	}*/
	
	/**
	 * Busca textos na base de dados com base nos parâmetros informados
	 */
	/*public function ExecuteBuscarTextos($cod_idioma=null,$termo_busca=null){
		
		try {
			
			//Condição do filtro de idioma
			$condicao_idioma = !is_null($cod_idioma) && strlen(trim($cod_idioma)) > 0;
			//Condição do termo de busca
			$condicao_termo_busca = !is_null($termo_busca) && strlen(trim($termo_busca)) > 0;
			
			//Instancia o objeto da Query
			$query = Doctrine_Query::create();
			
			//Campos a serem selecionados na Query
			$select = "*,idioma.*";
			
			//Verifica se foi informado um termo para a busca
			if($condicao_termo_busca){
				
					//Trata o termo a ser buscado - coloca parenteses no final para a expressão regular
					$StringBusca = HelperFactory::getInstance()->antiInjection($termo_busca."*");	
					
					//Dados da relevancia a serem selecionados								
					$select .= ",( 999999 * MATCH(wt.txt_titulo) AGAINST ({$StringBusca} IN BOOLEAN MODE) +";
					$select .= " 1.0 * MATCH(wt.txt_texto) AGAINST ({$StringBusca} IN BOOLEAN MODE) ) as relevance";						
			} 

					 //Monta o restante da Query 
					 $query->select($select)
					 ->from($this->table_alias)
					 ->leftJoin('wt.WebsiteIdiomas as idioma');
					 
					 //Verifica se um idioma foi informado
					 if($condicao_idioma){
					 
					 	//Adiciona o filtro por Idioma
					 	$query->where('wt.cod_idioma = ?',$cod_idioma);
					 }
					 
					 //Verifica a condição do termo de busca
					 if($condicao_termo_busca){
					 	
					 	//Adiciona o filtro por termo de busca
					 	$query->andWhere('MATCH(wt.txt_titulo,wt.txt_texto) AGAINST (? IN BOOLEAN MODE )',$StringBusca."*");	
					 	//Ordenação por relevância
					 	$query->orderBy('relevance DESC');				 
					 }
					 
			//Verifica o resultado da Query		 
		    if($query->count() > 0){
		    
		        return $query->execute()->toArray();
		    	
		    }else{
		    
		    	return false;		    	
		    }
			
		} catch (Doctrine_Exception $e) {
			
			echo $e->getMessage();
		}
	
	}*/
}