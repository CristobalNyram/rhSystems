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

class RepresentanteForm extends Form
{
    /**
     * [NuevosCampos Seleccionar los campos de la tabla pais]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("rep_nombre");
        $nombre->setLabel("Nombre representante");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Nombre representante", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("rep_primerapellido");
        $nombre->setLabel("Primer apellido representante");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Primer apellido representante", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("rep_segundoapellido");
        $nombre->setLabel("Segundo apellido representante");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Segundo apellido representante", "class"=>"form-control"));
        $this->add($nombre);

        $nombre = new Text("rep_tipo");
        $nombre->setLabel("Tipo de representante");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150, 'placeholder' => "Tipo representante", "class"=>"form-control","required" => "true"));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Tipo obligatorio'
            ))
        ));
        $this->add($nombre);        
    }

	/**
	 * [FillSelect Seleccionar los registros de la tabla pais]
	 * @param  $baja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
    public function FillSelect($baja=false)
    {
        $rep_id= new Representante();
        $rep_id = new Select('rep_id', $rep_id->FillSelect($baja), array(
            'using'      => array('rep_id', 'rep_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $rep_id->setLabel('Representante');
        return $rep_id;
    }
}