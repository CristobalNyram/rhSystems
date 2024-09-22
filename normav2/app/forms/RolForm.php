<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;

class RolForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla puesto]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $nombre = new Text("rol_nombre");
        $nombre->setLabel("Nombre del rol");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('rol_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $descripcion = new Text("rol_descripcion");
        $descripcion->setLabel("Descripción del rol");
        $descripcion->setFilters(array('striptags', 'string'));
        $descripcion->setAttributes(array('maxlength' => 150));
        $descripcion->addValidators(array(
            new PresenceOf(array(
                'message' => 'Descripción obligatorio'
            ))
        ));
        $this->add($descripcion);

    }

    /**
     * [NuevosCampos Seleccionar los campos de la tabla puesto]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("rol_nombre");
        $nombre->setLabel("Nombre del rol");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('rol_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $descripcion = new Text("rol_descripcion");
        $descripcion->setLabel("Descripción del rol");
        $descripcion->setFilters(array('striptags', 'string'));
        $descripcion->setAttributes(array('maxlength' => 150));
        $descripcion->addValidators(array(
            new PresenceOf(array(
                'message' => 'Descripción obligatorio'
            ))
        ));
        $this->add($descripcion);

    }

    /**
     * [TodosCampos Seleccionar los campos de la tabla puesto]
     * @param       []
     * @return []   []
     */
    public function EditarCampos()
    {
        $id = new Numeric('rol_id');
        $id->setLabel('ID del Rol');
        $id->setFilters(array('striptags', 'string'));
        $this->add($id); 

        $nombre = new Text("rol_nombre");
        $nombre->setLabel("Nombre del rol");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('rol_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $descripcion = new Text("rol_descripcion");
        $descripcion->setLabel("Descripción del Puesto");
        $descripcion->setFilters(array('striptags', 'string'));
        $descripcion->setAttributes(array('maxlength' => 150));
        $descripcion->addValidators(array(
            new PresenceOf(array(
                'message' => 'Descripción obligatorio'
            ))
        ));
        $this->add($descripcion);

    }

	/**
	 * [FillSelect Seleccionar los registros de la tabla puesto]
	 * @param  $baja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
    public function FillSelect($baja=false)
    {
        $rol_id= new Rol();
        $rol_id = new Select('rol_id', $rol_id->FillSelect($baja), array(
            'using'      => array('rol_id', 'rol_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $rol_id->setLabel('Rol');
        return $rol_id;
    }
}