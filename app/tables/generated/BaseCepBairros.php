<?php

/**
 * BaseCepBairros
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_id
 * @property integer $cod_cidade
 * @property string $txt_bairro
 * @property CepCidades $CepCidades
 * @property Doctrine_Collection $CepRuas
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCepBairros extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cepBairros');
        $this->hasColumn('cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('cod_cidade', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('txt_bairro', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
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
        $this->hasOne('CepCidades', array(
             'local' => 'cod_cidade',
             'foreign' => 'cod_id'));

        $this->hasMany('CepRuas', array(
             'local' => 'cod_id',
             'foreign' => 'cod_bairro'));
    }
}