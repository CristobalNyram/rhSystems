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
use Phalcon\Forms\Element\Date;

class ParticipanteForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("cuo_id");
        $nombre->setLabel("Clave del área temática");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Clave obligatoria'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("tra_id");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Área de denominación", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("par_estatus");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Área de denominación", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("emp_id");
        $hora->setLabel("Empresa");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Empresa", "class"=>"form-control"));
        $this->add($hora);

        $hora = new Text("cen_id");
        $hora->setLabel("Centro");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Centro", "class"=>"form-control"));
        $this->add($hora);

        $hora = new Text("rep_idlegal");
        $hora->setLabel("Rep. legal");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Rep. legal", "class"=>"form-control"));
        $this->add($hora);

        $hora = new Text("rep_idtra");
        $hora->setLabel("Rep. trabajador");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Rep. trabajador", "class"=>"form-control"));
        $this->add($hora);

        $par_fechaexamen = new Date("par_fechaexamen");
        $par_fechaexamen->setLabel("Fecha examen");
        $par_fechaexamen->setFilters(array('striptags', 'string'));
        $par_fechaexamen->setAttributes(array('maxlength' => 150, 'placeholder' => "Fecha examen", "class"=>"form-control"));
        $this->add($par_fechaexamen);

        $hora = new Text("tra_puesto");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Área de denominación", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $ocupacion = new OcupacionForm;
        $this->add($ocupacion->FillSelect());

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
        $id = new Text("are_id");
        $id->setLabel("ID del área");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("are_clave");
        $nombre->setLabel("Clave del área temática");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área","class"=>"form-control"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Clave obligatoria'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("are_denominacion");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Área de denominación","class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('are_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $hora = new Text("tra_puesto");
        $hora->setLabel("Denominación");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Área de denominación", "class"=>"form-control"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Denominación obligatorio'
            ))
        ));
        $this->add($hora);

        $ocupacion = new OcupacionForm;
        $this->add($ocupacion->FillSelect());

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
        $are_id= new Areatematica();
        $are_id = new Select('are_id', $are_id->FillSelect($baja), array(
            'using'      => array('are_id',"denominacion"),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $are_id->setLabel('Área temática');
        return $are_id;
    }
}