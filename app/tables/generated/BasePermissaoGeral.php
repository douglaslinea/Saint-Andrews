<?php

/**
 * BasePermissaoGeral
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_id
 * @property integer $cod_acao
 * @property integer $cod_controller
 * @property FrameworkControllers $FrameworkControllers
 * @property FrameworkAcoes $FrameworkAcoes
 * @property Doctrine_Collection $PermissaoUsuario
 * @property Doctrine_Collection $PermissaoVinculo
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePermissaoGeral extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('permissaoGeral');
        $this->hasColumn('cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('cod_acao', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cod_controller', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('FrameworkControllers', array(
             'local' => 'cod_controller',
             'foreign' => 'cod_id'));

        $this->hasOne('FrameworkAcoes', array(
             'local' => 'cod_acao',
             'foreign' => 'cod_id'));

        $this->hasMany('PermissaoUsuario', array(
             'local' => 'cod_id',
             'foreign' => 'cod_permissaoGeral'));

        $this->hasMany('PermissaoVinculo', array(
             'local' => 'cod_id',
             'foreign' => 'cod_permissaoGeral'));
    }
}