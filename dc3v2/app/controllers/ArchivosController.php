<?php

class ArchivosController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    /**
     * Descargar un archivo adjunto
     *
     * @param $arc_id ID del archivo a descargar
     */
    public function descargarAction($arc_id)
    {
        $this->attachment->download($arc_id);
    }
}

