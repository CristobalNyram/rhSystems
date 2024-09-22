<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\File;

class DocumentoForm extends Form
{	
    /**
     * [TodosCampos Seleccionar los campos de la tabla documento]
     * @param       []
     * @return []   []
     */
    public function TodosCampos()
    {
        $doc_comentario = new Text("doc_comentario");
        $doc_comentario->setLabel("Comentario del documento.");
        $doc_comentario->setFilters(array('striptags', 'string'));
        $this->add($doc_comentario);

        $doc_archivo = new File("doc_archivo");
        $doc_archivo->setLabel("Documento");
        $doc_archivo->setFilters(array('striptags', 'string'));
        $doc_archivo->setAttributes(array('maxlength' => 255));
        $doc_archivo->addValidators(array(
            new PresenceOf(array(
                'message' => 'Firma obligatorio'
            ))
        ));
        $this->add($doc_archivo); 

        $doc_tipo = new Select('doc_tipo');
        $doc_tipo->setLabel('Tipo de documento');
        $doc_tipo->setOptions(array('Confidencialidad'=>'Confidencialidad','Conflicto de interés'=>'Conflicto de interés','Constancia'=>'Constancia','Contrato'=>'Contrato','Exámen'=>'Exámen','Otros'=>'Otros'));
        $this->add($doc_tipo);

        $usuario= new UsuarioForm;
        $this->add($usuario->FillSelectUsuario());

    }

    /**
     * [NuevosCampos Seleccionar los campos de la tabla vacaciones]
     * @param       []
     * @return []   []
     */
    public function NuevosCampos()
    {
        
    }
}