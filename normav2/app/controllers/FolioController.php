<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Http\Request;

class FolioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Folio');
        parent::initialize();
     
    }


   
  

}