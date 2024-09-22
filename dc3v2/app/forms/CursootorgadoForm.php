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

class CursootorgadoForm extends Form
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
        $curso = new CursoForm;
        $this->add($curso->FillSelect());

        $empresa = new EmpresaForm;
        $this->add($empresa->FillSelect());

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

        $centro = new CentrotrabajoForm;
        $this->add($centro->FillSelect());

        $rep_leg = new Text("rep_leg");
        $rep_leg->setLabel("Representante legal");
        $rep_leg->setFilters(array('striptags', 'string'));
        $rep_leg->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $rep_leg->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($rep_leg);

        $rep_tra = new Text("rep_tra");
        $rep_tra->setLabel("Representante trabajadores");
        $rep_tra->setFilters(array('striptags', 'string'));
        $rep_tra->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $rep_tra->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($rep_tra);

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
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();","value"=>"CC-"));
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

        $fechasol = new Date('cuo_fechafinal');
        $fechasol->setLabel('Fecha de fin');
        $fechasol->setAttributes(array("class"=>"form-control"));
        $this->add($fechasol);

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
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
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

        $centro = new CentrotrabajoForm;
        $this->add($centro->FillSelect());

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

        $empresa = new EmpresaForm;
        $this->add($empresa->FillSelect());

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

        $fechasol = new Date('cuo_fechafinal');
        $fechasol->setLabel('Fecha de fin');
        $fechasol->setAttributes(array("class"=>"form-control"));
        $this->add($fechasol);

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