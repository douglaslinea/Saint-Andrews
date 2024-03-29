<?php

/**
 * BasePermissaoPerfis
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_tipo
 * @property string $txt_perfil
 * @property Doctrine_Collection $PermissaoVinculo
 * @property Doctrine_Collection $Usuarios
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePermissaoPerfis extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('permissaoPerfis');
        $this->hasColumn('cod_tipo', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('txt_perfil', 'string', 255, array(
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
        $this->hasMany('PermissaoVinculo', array(
             'local' => 'cod_tipo',
             'foreign' => 'cod_perfil'));

        $this->hasMany('Usuarios', array(
             'local' => 'cod_tipo',
             'foreign' => 'cod_perfil'));
    }
}