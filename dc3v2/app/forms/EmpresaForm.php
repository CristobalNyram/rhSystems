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
use Phalcon\Forms\Element\File;

class EmpresaForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $nombre = new Text("emp_razonsocial");
        $nombre->setLabel("Razón social de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("emp_logo");
        $hora->setLabel("Logo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("emp_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('emp_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $hora = new Text("emp_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

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
        $nombre = new Text("emp_razonsocial");
        $nombre->setLabel("Razón social de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Razón social", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Razón social obligatorio'
            ))
        ));
        $this->add($nombre);

        $nombre = new Text("emp_nombre");
        $nombre->setLabel("Nombre de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre de la empresa", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("emp_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('emp_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $hora = new Text("emp_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Correo", "class"=>"form-control","required" => "true"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $nombre = new Text("emp_nombrelegal");
        $nombre->setLabel("Nombre representante legal");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre representante legal", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_primerapellidolegal");
        $nombre->setLabel("Primer apellido representante legal");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido representante legal", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_segundoapellidolegal");
        $nombre->setLabel("Segundo apellido representante legal");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido representante legal", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_nombretrabajador");
        $nombre->setLabel("Nombre representante de trabajadores");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre representante de trabajadores", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_primerapellidotrabajador");
        $nombre->setLabel("Primer apellido representante de trabajadores");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido representante de trabajadores", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_segundoapellidotrabajador");
        $nombre->setLabel("Segundo apellido representante de trabajadores");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido representante de trabajadores", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $this->add($nombre);

        $nombre = new Text("emp_ubicacion");
        $nombre->setLabel("Ubicación del centro de trabajo");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Ubicación", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Ubicación obligatoria'
            ))
        ));
        $this->add($nombre);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

        $logo = new File("emp_logo");
        $logo->setLabel("Imagen");
        $logo->setFilters(array('striptags', 'string'));
        $logo->setAttributes(array('maxlength' => 300,"required" => "true"));
        $logo->addValidators(array(
            new PresenceOf(array(
                'message' => 'Imagen obligatorio'
            ))
        ));
        $this->add($logo);
    }

    public function CrearCampos()
    {
        $nombre = new Text("emp_razonsocial");
        $nombre->setLabel("Razón social de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Razón social", "class"=>"form-control","required" => "true"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $nombre = new Text("emp_nombre");
        $nombre->setLabel("Nombre de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre de la empresa", "class"=>"form-control","required" => "true"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("emp_logo");
        $hora->setLabel("Logo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control","required" => "true"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $hora = new Text("emp_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control","required" => "true"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('emp_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $hora = new Text("emp_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Correo", "class"=>"form-control","required" => "true"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $replegal = new Text("rep_idlegal");
        $replegal->setLabel("Rep legal");
        $replegal->setFilters(array('striptags', 'string'));
        $replegal->setAttributes(array('maxlength' => 150, 'placeholder' => "Rep legal", "class"=>"form-control"));
        $this->add($replegal);

        $reptra = new Text("rep_idtra");
        $reptra->setLabel("Rep trabajadores");
        $reptra->setFilters(array('striptags', 'string'));
        $reptra->setAttributes(array('maxlength' => 150, 'placeholder' => "Rep trabajadores", "class"=>"form-control"));
        $this->add($reptra);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

        $logo = new File("emp_logo");
        $logo->setLabel("Imagen");
        $logo->setFilters(array('striptags', 'string'));
        $logo->setAttributes(array('maxlength' => 300,"required" => "true"));
        $logo->addValidators(array(
            new PresenceOf(array(
                'message' => 'Imagen obligatorio'
            ))
        ));
        $this->add($logo);
    }

    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function EditarCampos()
    {
        $id = new Text("emp_id");
        $id->setLabel("ID de la empresa");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("emp_nombre");
        $nombre->setLabel("Nombre de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre de la empresa", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $nombre = new Text("emp_razonsocial");
        $nombre->setLabel("Razón social de la empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Razón social", "class"=>"form-control","required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        

        $hora = new Text("emp_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control", "required" => "true","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

        $estatus = new Select('emp_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $hora = new Text("emp_correo");
        $hora->setLabel("Correo");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Clave del área temática", "class"=>"form-control", "required" => "true"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'Horas obligatorio'
            ))
        ));
        $this->add($hora);

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
        $emp_id= new Empresa();
        $emp_id = new Select('emp_id', $emp_id->FillSelect($baja), array(
            'using'      => array('emp_id', 'emp_razonsocial'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $emp_id->setLabel('Empresa');
        return $emp_id;
    }
}