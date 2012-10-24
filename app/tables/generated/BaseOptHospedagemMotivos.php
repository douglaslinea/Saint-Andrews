<?php

/**
 * BaseOptHospedagemMotivos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_id
 * @property string $cod_motivo
 * @property Doctrine_Collection $FormularioHospedagem
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseOptHospedagemMotivos extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('optHospedagemMotivos');
        $this->hasColumn('cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('cod_motivo', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
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
        $this->hasMany('FormularioHospedagem', array(
             'local' => 'cod_id',
             'foreign' => 'cod_motivo'));
    }
}