<?php

/**
 * BaseHoteisRelacaoCaracteristicasAcomodacoes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $acamodacoesCaracteristicas_cod_id
 * @property integer $hoteisAcomodacoes_cod_id
 * @property integer $cod_opcao
 * @property HoteisAcamodacoesCaracteristicas $HoteisAcamodacoesCaracteristicas
 * @property HoteisAcomodacoes $HoteisAcomodacoes
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHoteisRelacaoCaracteristicasAcomodacoes extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('hoteisRelacaoCaracteristicasAcomodacoes');
        $this->hasColumn('acamodacoesCaracteristicas_cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('hoteisAcomodacoes_cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cod_opcao', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('HoteisAcamodacoesCaracteristicas', array(
             'local' => 'acamodacoesCaracteristicas_cod_id',
             'foreign' => 'cod_id'));

        $this->hasOne('HoteisAcomodacoes', array(
             'local' => 'hoteisAcomodacoes_cod_id',
             'foreign' => 'cod_id'));
    }
}