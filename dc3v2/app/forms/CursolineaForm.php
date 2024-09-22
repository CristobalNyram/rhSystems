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

class CursolineaForm extends Form
{
	/**
     * [NuevosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
	public function NuevosCampos()
	{
		$curso = new CursoForm;
		$this->add($curso->FillSelect());

		$hora = new Text("cuo_horas");
		$hora->setLabel("Horas del Curso");
		$hora->setFilters(array('striptags', 'string'));
		$hora->setAttributes(array('maxlength' => 150));
		$hora->addValidators(array(
			new PresenceOf(array(
				'message' => 'Horas obligatorio'
			))
		));
		$this->add($hora);

		$admin = new AdministradorForm;
		$this->add($admin->FillSelect());

		$instructor = new InstructorForm;
		$this->add($instructor->FillSelect());

		$pais = new PaisForm;
		$this->add($pais->FillSelect());

		$estado = new EstadoForm;
		$this->add($estado->FillSelect());

		$municipio = new MunicipioForm;
		$this->add($municipio->FillSelect());

		$hora = new Text("cuo_clave");
		$hora->setLabel("Clave");
		$hora->setFilters(array('striptags', 'string'));
		$hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();","value"=>"CA-"));
		$hora->addValidators(array(
			new PresenceOf(array(
				'message' => 'Clave obligatorio'
			))
		));
		$this->add($hora);

		$estatus = new Select('cuo_estatus');
		$estatus->setLabel('Estatus');
		$estatus->setAttributes(array("class"=>"form-control"));
		$estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
		$this->add($estatus);

		$fechasol = new Date('cuo_fechainicio');
		$fechasol->setLabel('Fecha de inicio');
		$fechasol->setAttributes(array("class"=>"form-control"));
		$this->add($fechasol);

		// $fechasol = new Date('cuo_fechafinal');
		// $fechasol->setLabel('Fecha de fin');
		// $fechasol->setAttributes(array("class"=>"form-control"));
		// $this->add($fechasol);

		$cuo_diploma = new Select('cuo_diploma');
        $cuo_diploma->setLabel('Diploma');
        $cuo_diploma->setAttributes(array("class"=>"form-control"));
        $cuo_diploma->setOptions(array('1'=>'Físico','2'=>'Digital'));
        $this->add($cuo_diploma);

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
    	$id = new Text("cuo_id");
    	$id->setLabel("ID");
    	$id->setFilters(array('striptags', 'string'));
    	$id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
    	$id->addValidators(array(
    		new PresenceOf(array(
    			'message' => 'ID obligatorio'
    		))
    	));
    	$this->add($id);

    	$hora = new Text("cuo_clave");
    	$hora->setLabel("Clave");
    	$hora->setFilters(array('striptags', 'string'));
    	$hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
    	$hora->addValidators(array(
    		new PresenceOf(array(
    			'message' => 'Clave obligatorio'
    		))
    	));
    	$this->add($hora);

    	$pais = new PaisForm;
    	$this->add($pais->FillSelect());

    	$estado = new EstadoForm;
    	$this->add($estado->FillSelect());

    	$municipio = new MunicipioForm;
    	$this->add($municipio->FillSelect());

    	$curso = new CursoForm;
    	$this->add($curso->FillSelect());

    	$hora = new Text("cuo_horas");
    	$hora->setLabel("Horas del Curso");
    	$hora->setFilters(array('striptags', 'string'));
    	$hora->setAttributes(array('maxlength' => 150));
    	$hora->addValidators(array(
    		new PresenceOf(array(
    			'message' => 'Horas obligatorio'
    		))
    	));
    	$this->add($hora);

		$admin = new AdministradorForm;
		$this->add($admin->FillSelect());

    	$instructor = new InstructorForm;
    	$this->add($instructor->FillSelect());

    	$estatus = new Select('cuo_estatus');
    	$estatus->setLabel('Estatus');
    	$estatus->setAttributes(array("class"=>"form-control"));
    	$estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
    	$this->add($estatus);

    	$fechasol = new Date('cuo_fechainicio');
    	$fechasol->setLabel('Fecha de inicio');
    	$fechasol->setAttributes(array("class"=>"form-control"));
    	$this->add($fechasol);

    	// $fechasol = new Date('cuo_fechafinal');
    	// $fechasol->setLabel('Fecha de fin');
    	// $fechasol->setAttributes(array("class"=>"form-control"));
    	// $this->add($fechasol);

    	$cuo_diploma = new Select('cuo_diploma');
        $cuo_diploma->setLabel('Diploma');
        $cuo_diploma->setAttributes(array("class"=>"form-control"));
        $cuo_diploma->setOptions(array('1'=>'Físico','2'=>'Digital'));
        $this->add($cuo_diploma);

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
		$cuo_id= new Cursootorgado();
		$cuo_id = new Select('cuo_id', $cuo_id->FillSelect($baja), array(
			'using'      => array('cuo_id', 'cuo_id')
		));
		$cuo_id->setLabel('País');
		return $cuo_id;
	}
}