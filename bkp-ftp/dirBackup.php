<?php
//Inclui o arquivo do Helper de arquivos
require_once '../system/helpers/ftp_backupHelper.php';

//Instancia o Helper de backup de arquivos
$BackupClass = new ftp_backupHelper();

//pega a data informando (ano, mes, dia)
$data = $BackupClass->VerificaData(1);

//exclui o arquivo conforme a data informada
$BackupClass->ExcluiArquivo($data, ".zip");

// pega o endereço do diretório
$diretorio = realpath('../');

//Cria o diretório de destino
$new_dir_name = date('d-m-Y_H-i-s');
mkdir($new_dir_name);

//Destino
$destino = "../bkp-ftp/".$new_dir_name;

//Copia o diretório
$BackupClass->copy_r($diretorio, $destino);

//Zipa o diretório
//$BackupClass->CompactarDiretorio($destino);

//Mensagem de confirmação
echo "Backup Realizado Com Sucesso";
?>