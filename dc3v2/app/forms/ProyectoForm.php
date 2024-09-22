<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Password;

class ProyectoForm extends Form
{

    /**
     * Initialize the products form
     */
    public function initialize($entity = null, $options = array())
    {



    }
    
    public function FillSelect($baja=false)
    {
        $proyecto= new Proyecto();
        $proyecto = new Select('pro_id', $proyecto->FillSelect($baja), array(
            'using'      => array('pro_id', 'pro_nombre'),
            'class'     =>"form-control js-example-basic-multiple"
        ));
        $proyecto->setLabel('Proyecto');
        return $proyecto;
    }
    
}