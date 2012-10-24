<?php
//Arquivo de configura��o do framework
require_once '../system/config.php';
require_once '../system/helpers/ftp_backupHelper.php';

//Instancia o Helper de backup de arquivos
$BackupClass = new ftp_backupHelper();

//pega a data informando (ano, mes, dia)
$data = $BackupClass->VerificaData(0, 6);

//exclui o arquivo conforme a data informada
$BackupClass->ExcluiArquivo($data, ".zip");

// conectando ao banco
mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

//Nome do arquivo
$filename = date('d-m-Y_H-i-s');

// gerando um arquivo sql. Como?
// a fun��o fopen, abre um arquivo, que no meu caso, ser� chamado como: nomedobanco.sql
// note que eu estou concatenando dinamicamente o nome do banco com a extens�o .sql.
$back = fopen($filename.".sql","w");

// aqui, listo todas as tabelas daquele banco selecionado acima
$res = mysql_list_tables(DB_NAME) or die(mysql_error());

//Em seguida, vamos, verificar quais s�o as tabelas daquela base, lista-las, e em um la�o for, vamos mostrar cada uma delas, e resgatar as fun��es de cria��o da tabela, para serem gravadas no arquivo sql mais adiante.

// resgato cada uma das tabelas, num loop
while ($row = mysql_fetch_row($res))
{
	$table = $row[0];
	// usando a fun��o SHOW CREATE TABLE do mysql, exibo as fun��es de cria��o da tabela,
	// exportando tamb�m isso, para nosso arquivo de backup
	$res2 = mysql_query("SHOW CREATE TABLE $table") or die(mysql_error());
	// digo que o comando acima deve ser feito em cada uma das tabelas

	while ( $lin = mysql_fetch_row($res2))
	{
		// instru��es que ser�o gravadas no arquivo de backup
		fwrite($back,"\n#\n# Cria��o da Tabela : $table\n#\n\n");
		fwrite($back,"$lin[1] ;\n\n#\n# Dados a serem inclu�dos na tabela\n#\n\n");

		//Teremos ent�o de pegar os dados que est�o dentro de cada campo de cada tabela, e abri-los tamb�m para serem gravados no nosso arquivo de backup.

		// seleciono todos os dados de cada tabela pega no while acima
		// e depois gravo no arquivo .sql, usando comandos de insert
		$res3 = mysql_query("SELECT * FROM $table");
		
		while($r=mysql_fetch_row($res3))
		{
			$sql="INSERT INTO $table VALUES (";

			//Agora vamos pegar cada dado do campo de cada tabela, e executar tarefas como, quebra de linha, substitui��o de aspas, espa�os em branco, etc. Deixando o arquivo confi�vel para ser importado em outro banco de dados.
			// este la�o ir� executar os comandos acima, gerando o arquivo ao final,
			// na fun��o fwrite (gravar um arquivo)
			// este la�o tamb�m ir� substituir as aspas duplas, simples e campos vazios
			// por aspas simples, colocando espa�os e quebras de linha ao final de cada registro, etc
			// deixando o arquivo pronto para ser importado em outro banco
			 
			for($j=0; $j<mysql_num_fields($res3);$j++)
			{
				if(!isset($r[$j]))
				$sql .= " '',";
				elseif($r[$j] != "")
				$sql .= " '".addslashes($r[$j])."',";
				else
				$sql .= " '',";
			}
			$sql = ereg_replace(",$", "", $sql);
			$sql .= ");\n";

			fwrite($back,$sql);
		}
	}
}
fclose($back);

// Cria a instancia do ZIP
$zip = new ZipArchive;
// se conseguir criar o arquivo ZIP
if( $zip->open($filename.".zip", ZIPARCHIVE::CREATE) === true )
{
	// Adiciona o arquivo dentro do zip
	$zip->addFile($filename.'.sql', $filename.".sql");
	$zip->close(); // fecha a conex�o com o ZIP
	// Opcionalmente pode-se excluir o arquivo original, basta inserir uma vari�vel nos par�metros
	unlink($filename.".sql");
	echo "Backup Realizado Com Sucesso";
}
else
{
	echo "Backup Mal sucedido";
}
?>