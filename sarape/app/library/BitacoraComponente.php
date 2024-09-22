<?php

use Phalcon\Mvc\User\Component;

class BitacoraComponente extends Component {

    public function guardar($data)
    {
        $bitacora= new Bitacora();
		$bitacora->bit_descripcion=$data['bit_descripcion'];
		$bitacora->usu_id=$data['usu_id'];
		$bitacora->bit_tablaid=$data['bit_tablaid'];
		$bitacora->bit_modulo=$data['bit_modulo'];

		$vac_id=0;
		if(isset($data['vac_id'])){
			$vac_id=$data['vac_id'];
		}
		$bitacora->vac_id=$vac_id;
		
		if ($bitacora->save() == false){
			$this->error='Error al guardar el registro';
			return false;
		}
		else{
			return $bitacora->bit_id;
		}	
    }
}