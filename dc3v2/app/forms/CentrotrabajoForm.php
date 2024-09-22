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

class CentrotrabajoForm extends Form
{
    /**
     * [NuevosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("cen_ubicacion");
        $nombre->setLabel("Ubicación");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Ubicación", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("rep_idlegal");
        $nombre->setLabel("Representante legal");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Representante", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("rep_idtra");
        $nombre->setLabel("Representante trabajadores");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Representante", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("emp_id");
        $nombre->setLabel("Empresa");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Empresa", "class"=>"form-control","required" => "true"));
        $this->add($nombre);
    }

	/**
	 * [FillSelect Seleccionar los registros de la tabla pais]
	 * @param  $baja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
    public function FillSelect($baja=false)
    {
        $cen_id= new Centrotrabajo();
        $cen_id = new Select('cen_id', $cen_id->FillSelect($baja), array(
            'using'      => array('cen_id', 'cen_ubicacion'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $cen_id->setLabel('Centro de trabajo');
        return $cen_id;
    }
}