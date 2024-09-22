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

class InstructorForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $hora = new Text("ins_nombre");
        $hora->setLabel("Nombre(s)");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre(s)", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_primerapellido");
        $hora->setLabel("Primer apellido");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_segundoapellido");
        $hora->setLabel("Segundo apellido");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Correo", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('ins_estatus');
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
     * [NuevosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    // public function NuevosCampos()
    // {
    //     $nombre = new Text("cur_nombre");
    //     $nombre->setLabel("Nombre del curso");
    //     $nombre->setFilters(array('striptags', 'string'));
    //     $nombre->setAttributes(array('maxlength' => 150));
    //     $nombre->addValidators(array(
    //         new PresenceOf(array(
    //             'message' => 'Nombre obligatorio'
    //         ))
    //     ));
    //     $this->add($nombre);

    //     $estatus = new Select('cur_estatus');
    //     $estatus->setLabel('Estatus');
    //     $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
    //     $this->add($estatus);
    // }

    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function EditarCampos()
    {
        $id = new Text("ins_id");
        $id->setLabel("ID");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $hora = new Text("ins_nombre");
        $hora->setLabel("Nombre(s)");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre(s)", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_primerapellido");
        $hora->setLabel("Primer apellido");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_segundoapellido");
        $hora->setLabel("Segundo apellido");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("ins_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Correo", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('ins_estatus');
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
        $ins_id= new Instructor();
        $ins_id = new Select('ins_id', $ins_id->FillSelect($baja), array(
            'using'      => array('ins_id',"nombre"),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $ins_id->setLabel('Instructor');
        return $ins_id;
    }
}