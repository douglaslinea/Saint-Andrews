<?php

/**
 * BaseUsuarios
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $cod_id
 * @property integer $cod_perfil
 * @property integer $cod_referencia
 * @property integer $cod_status
 * @property string $txt_nome
 * @property string $txt_email
 * @property string $txt_login
 * @property string $txt_senha
 * @property PermissaoPerfis $PermissaoPerfis
 * @property UsuariosStatus $UsuariosStatus
 * @property Doctrine_Collection $LogsAlteracoes
 * @property Doctrine_Collection $LogsLogin
 * @property Doctrine_Collection $PermissaoUsuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsuarios extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('usuarios');
        $this->hasColumn('cod_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('cod_perfil', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cod_referencia', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('cod_status', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('txt_nome', 'string', 60, array(
             'type' => 'string',
             'length' => 60,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('txt_email', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('txt_login', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('txt_senha', 'string', 255, array(
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
        $this->hasOne('PermissaoPerfis', array(
             'local' => 'cod_perfil',
             'foreign' => 'cod_tipo'));

        $this->hasOne('UsuariosStatus', array(
             'local' => 'cod_status',
             'foreign' => 'cod_id'));

        $this->hasMany('LogsAlteracoes', array(
             'local' => 'cod_id',
             'foreign' => 'cod_usuario'));

        $this->hasMany('LogsLogin', array(
             'local' => 'cod_id',
             'foreign' => 'cod_user'));

        $this->hasMany('PermissaoUsuario', array(
             'local' => 'cod_id',
             'foreign' => 'cod_usuario'));
    }
}