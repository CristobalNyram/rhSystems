<?php

use Phalcon\Mvc\User\Component;

class Acceso extends Component {

	public function verificar($menu,$rol="")
    {

        $auth = $this->session->get('auth');
        if($auth)
        {
            if($rol=="")
                $rol=$auth['rol_id'];
        }
        else
        {
            if($rol=="")
                return 0;
        }
        $existe=Relrolmenu::query()
            ->where('men_id='.$menu.' and rol_id='.$rol)
            ->execute();
        if (count($existe)>0) {
            if($existe[0]->rrm_estatus==0)
            {
            	return 0;
            }
            return 1;
        }
        return 0;
    }

    public function verificar_existencia_archivo($ruta="") {

        return file_exists($ruta);

    }

}