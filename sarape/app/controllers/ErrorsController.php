<?php

class ErrorsController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Oops!');
        parent::initialize();
    }

    public function show404Action()
    {

    }

    public function show401Action()
    {

    }

    public function show500Action()
    {

    }

    public function errorpermisoAction(){
        $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        return; 
    }
}
