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

class CursoForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $nombre = new Text("cur_nombre");
        $nombre->setLabel("Nombre del Curso");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("cur_horas");
        $hora->setLabel("Horas del Curso");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('cur_tipo');
        $estatus->setLabel('Tipo de curso');
        $estatus->setOptions(array('1'=>'Interno','2'=>'Externo'));
        $this->add($estatus);

        $estatus = new Select('cur_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $area = new AreatematicaForm;
        $this->add($area->FillSelect());

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
    public function NuevosCampos()
    {
        $nombre = new Text("cur_nombre");
        $nombre->setLabel("Nombre del Curso");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre del curso", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $nombre = new Text("cur_clave");
        $nombre->setLabel("Clave del Curso");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del curso", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("cur_horas");
        $hora->setLabel("Horas del Curso");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Horas del curso", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('cur_tipo');
        $estatus->setLabel('Tipo de curso');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('1'=>'INTERNO','2'=>'EXTERNO'));
        $this->add($estatus);

        $estatus = new Select('cur_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $area = new AreatematicaForm;
        $this->add($area->FillSelect());

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);
    }

    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function EditarCampos()
    {
        $id = new Text("cur_id");
        $id->setLabel("ID del curso");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("cur_clave");
        $nombre->setLabel("Clave del Curso");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del curso", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $nombre = new Text("cur_nombre");
        $nombre->setLabel("Nombre del Curso");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre del curso", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("cur_horas");
        $hora->setLabel("Horas del Curso");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Horas del curso", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('cur_tipo');
        $estatus->setLabel('Tipo de curso');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('1'=>'INTERNO','2'=>'EXTERNO'));
        $this->add($estatus);

        $estatus = new Select('cur_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $area = new AreatematicaForm;
        $this->add($area->FillSelect());

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
        $cur_id= new Curso();
        $cur_id = new Select('cur_id', $cur_id->FillSelect($baja), array(
            'using'      => array('cur_id', 'cur_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $cur_id->setLabel('Curso');
        return $cur_id;
    }
}