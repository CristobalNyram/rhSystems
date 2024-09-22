<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Cliente extends Model
{
    public function BuscarRegistro($data)
    {
		$this->error='Email o contraseña incorrectos';
		$cli=Cliente::findFirstBycli_correo(strtolower($data["correo"]));
		if($cli)
		{	
			//$comp=Empresa::findFirstByusu_id($usu->usu_id);
			// $comp=false;
			// if($comp)
			// {
			// 	$this->usu_tipo='Companies';
			// }else
			// {
			$this->nivel=$cli->cli_tipo;
			$this->cli_tipo='Cliente';
			// }
			$this->cli_id=$cli->cli_id;
			$this->cli_nombre=$cli->cli_nombre;
			$this->cli_nombre_completo=$cli->cli_nombre.' '.$cli->cli_primerapellido.' '.$cli->cli_segundoapellido;

			$this->cli_correo=$cli->cli_correo;
			// $this->cli_id=$usu->cli_id;
			// $this->usu_foto='perfil.jpg';
			$this->rol_id=$cli->cli_tipo;
			// $this->nivel=$cli->cli_tipo;
			$this->neg_id=$cli->neg_id;
			$this->emp_id=$cli->emp_id;
			$this->cne_id=$cli->cne_id;

			$crypt = new Crypt();
			$text = $cli->cli_contrasena;
			// $key  = "v9BhpzZK7fx2phNe1ujMu4dwUuxpabuxFLvvEyOTeIQMlqMcRZnb0Rz8gsMy438J6wf0lFTAt1hhF6YS2zzzsRAmssIgxG91VBA4";
			$key = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
			$desencrip = trim($crypt->decryptBase64($text, $key));
			
			if($data["password"]==$desencrip)
			{
				if($cli->cli_estatus==1)
				{
					$this->error="Tu cuenta se encuentra bloqueada, contacta al equipo de soporte para mayor información.";
					return false;
				}
				if($cli->cli_estatus<=0)
					return false;
				date_default_timezone_set('America/Mexico_City');
				// $usu->usu_ultimaconexion=date('Y-m-d  H:i:s');
				// if($usu->save())
					return true;
				// else
					// return false;
				// return true;
			}else{
				$IP=$this->obtenerIP();
				$bitacora= new Bitacoracliente();
				$databit['bic_descripcion']= "Intentó iniciar sesión con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
				$databit['cli_id']=0;
				$databit['bic_tablaid']=0;
				$databit['bic_modulo']="Sesión";
				$bitacora->NuevoRegistro($databit);
			}
		}else{
			$IP=$this->obtenerIP();
			$bitacora= new Bitacoracliente();
			$databit['bic_descripcion']= "Intento iniciar sesión con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
			$databit['cli_id']=0;
			$databit['bic_tablaid']=0;
			$databit['bic_modulo']="Sesión";
			$bitacora->NuevoRegistro($databit);
		}
		return false;
	}

	function obtenerIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
	}
}