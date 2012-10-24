<?php

/**
 * BaseCepCidades
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_uf
 * @property integer $cod_id
 * @property string $txt_cidade
 * @property CepUf $CepUf
 * @property Doctrine_Collection $CepBairros
 * @property Doctrine_Collection $Contatos
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCepCidades extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('cepCidades');
        $this->hasColumn('cod_uf', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('txt_cidade', 'string', 255, array(
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
        $this->hasOne('CepUf', array(
             'local' => 'cod_uf',
             'foreign' => 'cod_id'));

        $this->hasMany('CepBairros', array(
             'local' => 'cod_id',
             'foreign' => 'cod_cidade'));

        $this->hasMany('Contatos', array(
             'local' => 'cod_id',
             'foreign' => 'cod_cidade'));
    }
}