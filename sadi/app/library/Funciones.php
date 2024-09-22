<?php

use Phalcon\Mvc\User\Component;

class Funciones extends Component {

	public function extensionvalida($nombrearchivo)
    {
    	$extension= pathinfo($nombrearchivo, PATHINFO_EXTENSION);
		$extension = strtolower($extension);
    	$valido=0;
    	switch ($extension) {
		   /* case "pdf":
		    	$valido=1;
		        break;*/
		    case "jpg":
		        $valido=1;
		        break;
		    case "jpeg":
		        $valido=1;
		        break;
		    case "png":
		        $valido=1;
		        break;
			case "jfif":
		        $valido=1;
		        break;
		}

		return $valido;
    }

	public function excluirCategoriasParaAdjuntar($categoria_id){
		$valido=0;
    	switch ($categoria_id) {
		   /* case "pdf":
		    	$valido=1;
		        break;*/
		 	// case 1:
		    //     $valido=1;
		    case 3:
		        $valido=1;
		        break;
		    case 4:
		        $valido=1;
		        break;
			case 5:
		        $valido=1;
		        break;
			case 6:
		   		$valido=1;
		        break;

				//adjuntadas pero no aperecen
			case 7:
				$valido=1;
			case 8:
				$valido=1;
		}

		return $valido;
	}


	public function excluirCategoriasParaAdjuntar_FormatoTruper($categoria_id){
		$valido=0;
    	switch ($categoria_id) {
		   /* case "pdf":
		    	$valido=1;
		        break;*/
		 	// case 1:
		    //     $valido=1;
		    case 3:
		        $valido=1;
		        break;
		    case 4:
		        $valido=1;
		        break;
			case 5:
		        $valido=1;
		        break;
			case 6:
		   		$valido=1;
		        break;

				//adjuntadas pero no aperecen
			case 7:
				$valido=1;
			case 8:
				$valido=1;
		}

		return $valido;
	}

	
}