<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla usuario
 */
class Usuario extends Model
{
	public $usu_correo;
	public $usu_id;
	public $usu_nombre;
	public $usu_apellidop;
	public $usu_apellidom;
	public $usu_estatus;
	public $usu_tipo;
	public $usu_foto;
	public $usu_pue;
	public $error;
	
	/**
	 * [getEstatusDetail Obtener el estado de un usuario]
	 * @param  ' ' 			[Sin parametros]
	 * @return [string] 	[Descripción del estatus del usuario]
	 */
	public function getEstatusDetail()
	{
		if ($this->usu_estatus == 1) 
		{
			return 'Baja';
		}
		if ($this->usu_estatus == 2) 
		{
			return 'Alta';
		}
		if ($this->usu_estatus == 0) 
		{
			return '0';
		}
		if ($this->usu_estatus < 0) 
		{
			return '-1';
		}
	}

	/**
	 * [BuscarRegistro     Busca y verifica los datos recibidos para iniciar la sesión]
	 * @param  $data 		[Parametros del ajax con la contraseña encriptada en sha256]
	 * @return [boolean] 	[true(iniciar sesión),false(datos incorrectos)]
	 */
	public function BuscarRegistro($data)
	{
		$this->error='Email o contraseña incorrectos';
		$usu=Usuario::findFirstByusu_correo(strtolower($data["correo"]));
		if($usu)
		{	
			//$comp=Empresa::findFirstByusu_id($usu->usu_id);
			$comp=false;
			if($comp)
			{
				$this->usu_tipo='Companies';
			}else
			{
				$this->usu_tipo='Users';
			}
			$this->usu_id=$usu->usu_id;
			$this->usu_nombre=$usu->usu_nombre;
			$this->usu_nombre_completo=$usu->usu_nombre.' '.$usu->usu_primerapellido.' '.$usu->usu_segundoapellido;

			$this->usu_correo=$usu->usu_correo;
			$this->usu_id=$usu->usu_id;
			// $this->usu_foto='perfil.jpg';
			$this->rol_id=$usu->rol_id;

			$crypt = new Crypt();
			$text = $usu->usu_contrasena;
			// $key  = "v9BhpzZK7fx2phNe1ujMu4dwUuxpabuxFLvvEyOTeIQMlqMcRZnb0Rz8gsMy438J6wf0lFTAt1hhF6YS2zzzsRAmssIgxG91VBA4";
			$key = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
			$desencrip = trim($crypt->decryptBase64($text, $key));
			
			if($data["password"]==$desencrip)
			{
				if($usu->usu_estatus==1)
				{
					$this->error="Tu cuenta se encuentra bloqueada, contacta al equipo de soporte para mayor información.";
					return false;
				}
				if($usu->usu_estatus<=0)
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
				$bitacora= new Bitacora();
				$databit['bit_descripcion']= "Intento iniciar sesión con este correo ".$data["correo"].' con la siguiente info recopilada por el servidor  IP :'.$IP.' y la IP del cliente es '.$data["ip_cliente"];
				$databit['usu_id']=0;
				$databit['bit_tablaid']=0;
				$databit['bit_modulo']="Sesión";
				$bitacora->NuevoRegistro($databit);
			}
		}
		return false;
	}	

	/**
	 * [NuevoRegistro Crea un nuevo registro de la tabla usuario]
	 * @param  $data 		[datos del ajax con los datos para el registro]
	 * @return [boolean y ID del usuario creado]  	[Tuvo éxito el registro o no(true-false) y ] 
	 */
	public function NuevoRegistro($data,$id)
	{
		/*verifica si exite el registro*/
		// $auth = $this->session->get('auth');
		// $correo=Usuario::findFirstByusu_correo($data["usu_correo"]);
		$usuario=Usuario::findFirstByusu_correo($data["usu_correo"]);
		if($usuario)
		{
			/*si el esta dado de baja 1 o de alta 2 muestra registro existente, en caso de ser negativo significa que fue eliminado por el usuario y se considera como si no existiera*/
			
			if($usuario->usu_estatus>=0)
			{
				$this->error="El correo ya se encuentra registrado en algún usuario";
				return false;
			}
		}
		else
		{
			//si no existe el registro se crea la clase
			$usuario= new Usuario();
		}

		// $form = new UsuarioForm;
		// $form->NuevosCampos();
		// if (!$form->isValid($data, $usuario)) {
		// 	$this->error="error al validar";
		// 	return false;
		// }
		
		$sha256=hash('sha256', $data['usu_contrasena']);
		$crypt = new Crypt();
		$key = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
		$text = $sha256;
		$encrypt = $crypt->encryptBase64($text, $key);
		// $usuario->usu_id_registro=$id;
		$usuario->usu_correo=$data['usu_correo'];
		$usuario->usu_estatus=$data['usu_estatus'];
		$usuario->rol_id=$data['rol_id'];
		$usuario->usu_nombre=trim($data['usu_nombre']);
		$usuario->usu_primerapellido=trim($data['usu_primerapellido']);
		$usuario->usu_segundoapellido=trim($data['usu_segundoapellido']);
		$usuario->usu_telefono=$data['usu_telefono'];
		$usuario->usu_celular=$data['usu_celular'];
		$usuario->usu_rfc=$data['usu_rfc'];

		//$usuario->usu_honorario1=$data['usu_honorario1'];
		//$usuario->usu_honorario2=$data['usu_honorario2'];ya no se ocupan mas en la bd

		$usuario->usu_contrasena=$encrypt;
		// $usuario->usu_foto='perfil.jpg';
		$usuario->usu_tipo=1;
		if ($usuario->save() == false){
			$this->error='Error al guardar el registro';
			return -1;
		}
		else{
			return ["respuesta"=> 1,"usu_id"=> $usuario->usu_id];
		}

	}
	/**
	 * [EditarRegistro Editar un registro de la tabla usuario]
	 * @param  $data, $id 	[datos del ajax con los datos para el registro,id del usuario a editar]
	 * @return [boolean] 	[Tuvo éxito la edición o no(true-false)]
	 */
	public function EditarRegistro($data)
	{
		$usuario = Usuario::findFirstByusu_id($data['usu_id']);
		if($usuario==true)
		{
			if($usuario->usu_estatus==1 ||$usuario->usu_estatus==2)
			{
			}
			else
			{
				$this->error[0]="Registro NO existente";
				return false;
			}
		}
		else
		{
			$this->error[0]="Registro NO existente";
			return false;
		}
		/*Valida y mueve los datos a la clase*/
		$form = new UsuarioForm;
		$form->EditarCampos();
        if (!$form->isValid($data, $usuario)) {
        	$this->error=$form->getMessages();
        	return false;
        }
        // $usuario->usu_estatus=$data['usu_estatus'];
		if ($usuario->save() == false) 
        {
    		
        	return false;
        
        }
        else
        {
        	return true;
            
        }	
	}

	public function ComprobarContrasenia($id,$password)
	{
		$usu=Usuario::findFirstByusu_id($id);
		if($usu)
		{
			$crypt = new Crypt();
			$text = $usu->usu_contrasena;
			// $key  = "v9BhpzZK7fx2phNe1ujMu4dwUuxpabuxFLvvEyOTeIQMlqMcRZnb0Rz8gsMy438J6wf0lFTAt1hhF6YS2zzzsRAmssIgxG91VBA4";
			$key = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
			$desencrip = trim($crypt->decryptBase64($text, $key));
			if($password==$desencrip)
			{
				if($usu->usu_estatus==1)
				{
					return false;
				}
				if($usu->usu_estatus<=0)
					return false;

				return true;
			}
		}
		return false;
	}
	/**
	 * [FillSelect Seleccionar los registros de la tabla usuario]
	 * @param  $incluyebaja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
	public function FillSelect($incluyebaja=false)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		$usuario = Usuario::find(array(
                "not EXISTS (select * from Empresa WHERE Usuario.usu_id=Empresa.usu_id) and usu_estatus<=2 and usu_estatus>=:min:",
                'columns'=>array('usu_id as usu_jefe',"CONCAT(usu_nombre, ' ', usu_apellidop, ' ',usu_apellidom) as nombre"),
                'order'=>'usu_nombre',
                'bind' => array('min' => $min)
            ));
		return $usuario;
	}

	/**
	 * [FillSelect Seleccionar los registros de la tabla usuario]
	 * @param  $incluyebaja 	[Trae todos los datos]
	 * @return [array] 	[Regresa los datos]
	 */
	public function FillSelectUsuario($incluyebaja=false,$todos=1,$lclave=-1)
	{
		$min=0;
		if($incluyebaja)
			$min=1;
		else
			$min=2;
		if($todos==1)
		{
			$usuarios=Usuario::find(array("usu_estatus<=2  and usu_estatus>=:min: and usu_tipo<>'Companies'",
									'columns'=>array('usu_id',"CONCAT(usu_nombre, ' ', usu_apellidop, ' ',usu_apellidom) as nombre"),
                                    "order"=>"nombre",
                                    'bind' => array('min' => $min)
                                    ));	
		}
		else
		{
			$usuarios=Usuario::find(array("usu_estatus<=2  and usu_estatus>=:min: and usu_tipo<>'Companies' and usu_id=:clave:",
									'columns'=>array('usu_id',"CONCAT(usu_nombre, ' ', usu_apellidop, ' ',usu_apellidom) as nombre"),
                                    "order"=>"nombre",
                                    'bind' => array('min' => $min,
                                					'clave' => $lclave)
                                    ));
		}
		
		return $usuarios;
	}

	public function ActualizarSueldo($id)
	{
		$usuario=Usuario::findFirstByusu_id($id);
		$sueldo=Sueldo::query()
        ->where('sue_estatus=2 and usu_id='.$id)
        ->orderBy('sue_fecha desc')
        ->execute();

        $usuario->usu_sueldo=$sueldo[0]->sue_cantidad;
        if($usuario->save())
        {
        	return true;
        }
        return false;

	}

	public function ActualizarHorasCap($id)
	{
		$usuario=Usuario::findFirstByusu_id($id);
		$horas=Horascapacitacion::query()
		->columns('sum(hca_tiempo) as horascap')
        ->where('hca_estatus=2 and usu_id='.$id)
        ->execute();

        $usuario->usu_horascap=$horas[0]->horascap;
        if($usuario->save())
        {
        	return true;
        }
        return false;

	}

	public function getNombre($id)
	{
		if($id==0){
			return "Registro generado automáticamente";
		}
		$usuario=Usuario::findFirstByusu_id($id);
		if($usuario)
			return $usuario->usu_nombre." ".$usuario->usu_primerapellido." ".$usuario->usu_segundoapellido;
		else
			return "";
	}

	public function getRol()
	{
		$rol=Rol::findFirstByrol_id($this->rol_id);
		if($rol)
			return $rol->rol_nombre;
		else
			return "";
	}

	public function getinvestigador()
	{
        $subs=new Builder();
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'))
        ->addFrom('Usuario','u')
        ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->where('usu_estatus=2 and r.men_id=8 and rrm_estatus=1')
        ->getQuery()
        ->execute();
        
        return $subs;
    }

    public function getanalista()
    {
        $subs=new Builder();
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'))
        ->addFrom('Usuario','u')
        ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->where('usu_estatus=2 and r.men_id=12 and rrm_estatus=1')
        ->getQuery()
        ->execute();
        
        return $subs;
    }
    
    protected function resDiasexactos($fecha,$dias)
    {
        
        $f= date('Y-m-d', strtotime($fecha));
        $dt= new DateTime($f);
        
        $dt->sub(new DateInterval("P".$dias."D"));
        $fecha= $dt->format("Y-m-d");
        
        return $fecha;
    }

    public function getCandidato()
    {
    	$date= new DateTime();
        $hoy=$date->format('Y-m-d');
        $diasmenos = $this->resDiasexactos($hoy,180);

        $subs=new Builder();
        $subs=$subs
        ->columns(array('ese_id', 'ese_curp', 'CONCAT(ese_nombre, " ", ese_primerapellido, " ", ese_segundoapellido) as nombre','ese_puesto'))
        ->addFrom('Estudio','e')
        // ->join('Relrolmenu','r.rol_id=u.rol_id','r')
        ->where("ese_registro>='".$diasmenos. "'")
        ->getQuery()
        ->execute();
        
        return $subs;
    }
	public function getRolNivel($rol_id_get=0)
	{
		$rol=Rol::findFirstByrol_id($rol_id_get);
		if($rol)
			return $rol->rol_nivel;
		else
			return "";
	}
	public function actualizarPerfil($data){
		$this->usu_nombre=$data["usu_nombreeditar"];
		$this->usu_primerapellido=$data["usu_primerapellidoeditar"];
		$this->usu_segundoapellido=$data["usu_segundoapellidoeditar"];
		$this->usu_correo=$data["usu_correoeditar"];
		$this->usu_rfc=$data["usu_rfceditar"];

		$this->usu_estatus=$data["usu_estatuseditar"];
		$this->rol_id=$data["rol_ideditar"];

		$empresa=null;
		if($data["emp_ideditar"]!=-1){
			$empresa=$data["emp_ideditar"];
		}
		$this->emp_id=$empresa;
		$this->usu_telefono=$data["usu_telefonoeditar"];
		$this->usu_celular=$data["usu_celulareditar"];
		
		if($this->update()){
			return ['estado'=>2,'mensaje'=>'Se ha actualizadó.'];
		}else{
			return ['estado'=>-2,'mensaje'=>'No se ha actualizadó.'];

		}

	}

	public function getlistausuario()
	{
        $subs=new Builder();
        $subs=$subs
        ->columns(array('u.usu_id','CONCAT(usu_nombre, " ", usu_primerapellido, " ", usu_segundoapellido) as nombre'))
        ->addFrom('Usuario','u')
        ->where('usu_estatus=2')
        ->getQuery()
        ->execute();
        
        return $subs;
    }

	public function getNombreObj(){
		return $this->usu_nombre." ".$this->usu_primerapellido." ".$this->usu_segundoapellido;
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