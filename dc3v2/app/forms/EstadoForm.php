<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;

class EstadoForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla estado]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $nombre = new Text("est_nombre");
        $nombre->setLabel("Nombre del Estado");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('est_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $pais = new PaisForm;
        $this->add($pais->FillSelect());
    }

    /**
     * [NuevosCampos Seleccionar los campos de la tabla estado]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("est_nombre");
        $nombre->setLabel("Nombre del Estado");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('est_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $pais = new PaisForm;
        $this->add($pais->FillSelect());
    }

    /**
     * [TodosCampos Seleccionar los campos de la tabla estado]
     * @param       []
     * @return []   []
     */
    public function EditarCampos()
    {
        $id = new Text("est_id");
        $id->setLabel("ID del Estado");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("est_nombre");
        $nombre->setLabel("Nombre del Estado");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('est_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $pais = new PaisForm;
        $this->add($pais->FillSelect());
    }

	/**
	 * [FillSelect Seleccionar los registros de la tabla estado]
	 * @param  $baja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
    public function FillSelect($baja=false)
    {
        $est_id= new Estado();
        $est_id = new Select('est_id', $est_id->FillSelect($baja), array(
            'using'      => array('est_id', 'est_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $est_id->setLabel('Estado');
        return $est_id;
    }
}