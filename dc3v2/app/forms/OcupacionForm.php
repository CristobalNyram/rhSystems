<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Submit;

class OcupacionForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("ocu_clave");
        $nombre->setLabel("Clave de la ocupación");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave de la ocupación", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Clave obligatoria'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("ocu_denominacion");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Denominación", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('ocu_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

    }

    public function EditarCampos()
    {
        $id = new Text("ocu_id");
        $id->setLabel("ID de la ocupación");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("ocu_clave");
        $nombre->setLabel("Clave de la ocupación");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave de","class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Clave obligatoria'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("ocu_denominacion");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Denominación","class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('ocu_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);
    }

	/**
	 * [FillSelect Seleccionar los registros de la tabla pais]
	 * @param  $baja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
    public function FillSelect($baja=false)
    {
        $ocu_id= new Ocupacion();
        $ocu_id = new Select('ocu_id', $ocu_id->FillSelect($baja), array(
            'using'      => array('ocu_id',"ocu_denominacion"),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $ocu_id->setLabel('Ocupación');
        return $ocu_id;
    }
}