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

        $nivel = new Select("rol_nivel");
        $nivel->setLabel("Nivel");
        $nivel->setOptions(array('1'=>"1 (Más alto)",'2'=>'2','3'=>'3','4'=>'4','5'=>"5 (Más bajo)"));
        // $nivel->setAttributes(array('maxlength' => 1, 'placeholder' => 'No. de nivel'));
        
        $this->add($nivel);

        $rol_traaprobar = new Numeric('rol_traaprobar');
        $rol_traaprobar->setLabel('Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte');
        $rol_traaprobar->setFilters(array('striptags', 'string'));
        $rol_traaprobar->setAttributes(array('placeholder' => "Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)', "min"=>"0"));
        $this->add($rol_traaprobar);

        $rol_trasolicitar = new Numeric('rol_trasolicitar');
        $rol_trasolicitar->setLabel('Monto máximo con el que pueden solicitar un pago de transporte');
        $rol_trasolicitar->setFilters(array('striptags', 'string'));
        $rol_trasolicitar->setAttributes(array('placeholder' => "Monto máximo con el que pueden solicitar un pago de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)', "min"=>"0"));
        $this->add($rol_trasolicitar);

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


        $nivel = new Select("rol_nivel");
        $nivel->setLabel("Nivel");
        $nivel->setOptions(array('1'=>"1 (Más alto)",'2'=>'2','3'=>'3','4'=>'4','5'=>"5 (Más bajo)"));
        $this->add($nivel);

        $rol_traaprobar = new Numeric('rol_traaprobar');
        $rol_traaprobar->setLabel('Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte');
        $rol_traaprobar->setFilters(array('striptags', 'string'));
        $rol_traaprobar->setAttributes(array('placeholder' => "Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)',"min"=>"0"));
        $this->add($rol_traaprobar);

        $rol_trasolicitar = new Numeric('rol_trasolicitar');
        $rol_trasolicitar->setLabel('Monto máximo con el que pueden solicitar un pago de transporte');
        $rol_trasolicitar->setFilters(array('striptags', 'string'));
        $rol_trasolicitar->setAttributes(array('placeholder' => "Monto máximo con el que pueden solicitar un pago de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)',"min"=>"0"));
        $this->add($rol_trasolicitar);

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


        $nivel = new Select("rol_nivel");
        $nivel->setLabel("Nivel");
        $nivel->setOptions(array('1'=>"1 (Más alto)",'2'=>'2','3'=>'3','4'=>'4','5'=>"5 (Más bajo)"));
        $this->add($nivel);

        $rol_traaprobar = new Numeric('rol_traaprobar');
        $rol_traaprobar->setLabel('Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte');
        $rol_traaprobar->setFilters(array('striptags', 'string'));
        $rol_traaprobar->setAttributes(array('placeholder' => "Monto máximo con el que pueden pre-aprobar y autorizar pagos de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)', "min"=>"0"));
        $this->add($rol_traaprobar);

        $rol_trasolicitar = new Numeric('rol_trasolicitar');
        $rol_trasolicitar->setLabel('Monto máximo con el que pueden solicitar un pago de transporte');
        $rol_trasolicitar->setFilters(array('striptags', 'string'));
        $rol_trasolicitar->setAttributes(array('placeholder' => "Monto máximo con el que pueden solicitar un pago de transporte", "required" => "true","oninput"=>'limitDecimalPlaces(event, 2)', "min"=>"0"));
        $this->add($rol_trasolicitar);
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
            'class'     =>"form-control select2-single bar-right"
        ));
        $rol_id->setLabel('Rol');
        return $rol_id;
    }
}