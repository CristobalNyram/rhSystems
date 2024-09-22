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

class AdministradorForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("adm_nombre");
        $nombre->setLabel("Nombre de la empresa administradora");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('placeholder' => "Nombre de la empresa administradora", "class"=>"form-control","onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("adm_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'RFC obligatorio'
            ))
        ));
        $this->add($hora);

        // $hora = new Text("adm_nombredirector");
        // $hora->setLabel("Nombre del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Nombre obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $hora = new Text("adm_primerapellidodirector");
        // $hora->setLabel("Primer apellido del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido del director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Primer apellido obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $hora = new Text("adm_segundoapellidodirector");
        // $hora->setLabel("Segundo apellido del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido del director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Segundo apellido obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $adm_puestofirma = new Text("adm_puestofirma");
        // $adm_puestofirma->setLabel("Puesto");
        // $adm_puestofirma->setFilters(array('striptags', 'string'));
        // $adm_puestofirma->setAttributes(array('maxlength' => 30, 'placeholder' => "Puesto", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $adm_puestofirma->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Puesto'
        //     ))
        // ));
        // $this->add($adm_puestofirma);

        $estatus = new Select('adm_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $estatus = new Select('adm_default');
        $estatus->setLabel('Default');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('0'=>'Secundario','1'=>'Principal'));
        $this->add($estatus);

        $nombre = new Submit("enviar");
        $nombre->setLabel("");
        $nombre->setAttributes(array('value' => "Siguiente", 'class' =>"btn-block btn-btnempresa submit"));
        $this->add($nombre);

        $logo = new File("adm_logo");
        $logo->setLabel("Logo");
        $logo->setFilters(array('striptags', 'string'));
        $logo->setAttributes(array('maxlength' => 300));
        $logo->addValidators(array(
            new PresenceOf(array(
                'message' => 'Imagen obligatorio'
            ))
        ));
        $this->add($logo);

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
        $id = new Text("adm_id");
        $id->setLabel("ID");
        $id->setFilters(array('striptags', 'string'));
        $id->setAttributes(array('maxlength' => 150, 'readonly' => "true", "class"=>"form-control"));
        $id->addValidators(array(
            new PresenceOf(array(
                'message' => 'ID obligatorio'
            ))
        ));
        $this->add($id);

        $nombre = new Text("adm_nombre");
        $nombre->setLabel("Nombre de la empresa administradora");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('placeholder' => "Nombre de la empresa administradora", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $hora = new Text("adm_rfc");
        $hora->setLabel("RFC");
        $hora->setFilters(array('striptags', 'string'));
        $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "RFC", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        $hora->addValidators(array(
            new PresenceOf(array(
                'message' => 'RFC obligatorio'
            ))
        ));
        $this->add($hora);

        // $hora = new Text("adm_nombredirector");
        // $hora->setLabel("Nombre del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Nombre obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $hora = new Text("adm_primerapellidodirector");
        // $hora->setLabel("Primer apellido del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido del director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Primer apellido obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $hora = new Text("adm_segundoapellidodirector");
        // $hora->setLabel("Segundo apellido del director");
        // $hora->setFilters(array('striptags', 'string'));
        // $hora->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido del director", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $hora->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Segundo apellido obligatorio'
        //     ))
        // ));
        // $this->add($hora);

        // $adm_puestofirma = new Text("adm_puestofirma");
        // $adm_puestofirma->setLabel("Puesto");
        // $adm_puestofirma->setFilters(array('striptags', 'string'));
        // $adm_puestofirma->setAttributes(array('maxlength' => 30, 'placeholder' => "Puesto", "class"=>"form-control", "onkeyup"=>"javascript:this.value=this.value.toUpperCase();"));
        // $adm_puestofirma->addValidators(array(
        //     new PresenceOf(array(
        //         'message' => 'Puesto'
        //     ))
        // ));
        // $this->add($adm_puestofirma);

        $estatus = new Select('adm_default');
        $estatus->setLabel('Default');
        $estatus->setAttributes(array("class"=>"form-control"));
        $estatus->setOptions(array('0'=>'Secundario','1'=>'Principal'));
        $this->add($estatus);

        $estatus = new Select('adm_estatus');
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
        $adm_id= new Administrador();
        $adm_id = new Select('adm_id', $adm_id->FillSelect($baja), array(
            'using'      => array('adm_id',"adm_nombre"),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $adm_id->setLabel('Administrador');
        return $adm_id;
    }
}