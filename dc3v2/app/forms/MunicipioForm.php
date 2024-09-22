<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;

class MunicipioForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla estado]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $nombre = new Text("mun_nombre");
        $nombre->setLabel("Nombre del Municipio");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('mun_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $estado = new EstadoForm;
        $this->add($estado->FillSelect());

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
        $nombre = new Text("mun_nombre");
        $nombre->setLabel("Nombre del municipio");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('mun_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $estado = new EstadoForm;
        $this->add($estado->FillSelect());

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
        $id = new Text("mun_id");
        $id->setLabel("ID del municipio");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("mun_nombre");
        $nombre->setLabel("Nombre del municipio");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('mun_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $estado = new EstadoForm;
        $this->add($estado->FillSelect());

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
        $mun_cla= new Municipio();
        $mun_cla = new Select('mun_cla', $mun_cla->FillSelect($baja), array(
            'using'      => array('mun_cla', 'mun_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $mun_cla->setLabel('Municipio');
        return $mun_cla;
    }
}