<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;

class MenuForm extends Form
{
	/**
     * [NuevosCampos Seleccionar los campos de la tabla puesto]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        $nombre = new Text("men_titulo");
        $nombre->setLabel("Menú");
        $nombre->setFilters(array('striptags', 'string'));
        $nombre->setAttributes(array('maxlength' => 150));
        $nombre->addValidators(array(
            new PresenceOf(array(
                'message' => 'Nombre obligatorio'
            ))
        ));
        $this->add($nombre);

        $estatus = new Select('men_estatus');
        $estatus->setLabel('Estatus');
        $estatus->setOptions(array('2'=>'Alta','1'=>'Baja'));
        $this->add($estatus);

        $descripcion = new Text("men_padre");
        $descripcion->setLabel("Menú padre (0 para raíz)");
        $descripcion->setFilters(array('striptags', 'string'));
        $descripcion->setAttributes(array('maxlength' => 150));
        $descripcion->addValidators(array(
            new PresenceOf(array(
                'message' => 'Padre obligatorio'
            ))
        ));
        $this->add($descripcion);

        $orden = new Text("men_orden");
        $orden->setLabel("Orden del menú (Se recomienda poner el siguiente id del menú)");
        $orden->setFilters(array('striptags', 'string'));
        $orden->setAttributes(array('maxlength' => 150));
        $orden->addValidators(array(
            new PresenceOf(array(
                'message' => 'Orden obligatorio'
            ))
        ));
        $this->add($orden);

        
    }
}