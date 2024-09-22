<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla puesto
 */
class Autoestudio extends Model
{

    public function NuevoRegistro($ese_id,$data){

        $registro =new Autoestudio();
        $crypt = new Crypt();
        $key  = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
        $text = $data['aes_contrasenia'];
        $encrypt = $crypt->encryptBase64($text, $key);
        $registro->ese_id=$ese_id;
        $registro->aes_contrasenia=$encrypt;
        $registro->aes_correo=$data['aes_correo'];
        if ( $registro->save()) {
            return ['estado'=>2,'ese_id'=>$registro->ese_id,'aes_id'=>$registro->aes_id];
        }else{
            return ['estado'=>-2];

        }
    }

    public function ValidarExisteCorreoActivo($correo){

        $answer=[];
        $aes_activo=Autoestudio::query()->where('aes_correo="'.$correo.'" and aes_estatus = 2') ->execute(); 
        
        if(count($aes_activo)>0)
            $answer['estado']=true;
        else
             $answer['estado']=false;

        
        return $answer;
    }

    public function Convertirlo_A_Autoestudio($ese_id){
        $fecha_y_hora = date("Y-m-d H:i:s");
        $estudio=Estudio::findFirstByese_id($ese_id);
        // $estudio->ese_fechaentregainvestigador=$fecha_y_hora;
        $estudio->ese_fechaasiginvestigador=$fecha_y_hora;
        $estudio->ese_estatus=2;
        $estudio->ese_autoestudio=1;

        $estudio->inv_id=172;

        if ( $estudio->update()) {
            return ['estado'=>2,'ese_id'=>$estudio->ese_id];
        }else{
            return ['estado'=>-2];

        }


    }

    public function BuscarRegistro($data){
        
        $answer['estado']=false;
        $answer['mensaje']='Contraseña o correo incorrectos..';

		$aes_usu_busqueda=$this->ValidarUnicoCorreoActivo(strtolower($data["correo"]));
		if($aes_usu_busqueda['estado'])
		{	
            $answer=$aes_usu_busqueda;
		}

        return $answer;
		
    }

    public function getUsuarioParaSesion($ese_id,$usuario_id=172,$aes_id=0){
       
        $usuario=Usuario::findFirstByusu_id($usuario_id);
        $ese=Estudio::findFirstByese_id($ese_id);

        $usuario->usu_nombre=$usuario->usu_nombre;
        $usuario->usu_correo=$usuario->usu_correo;
        $usuario->usu_nombre_candidato=$ese->get_nombrecompletocandidato();
        $usuario->nombre_candidato=$ese->get_nombre();

      	$usuario->rol_id=$usuario->rol_id;
        $usuario->usu_tipo=-1;
        $usuario->aes_id=$aes_id;
        $usuario->ese_id=$ese_id;
        $usuario->usu_tipo='Autoestudios';
        $usuario->usu_autoestudio=1;
        $usuario->ese_id=$ese_id;
        
        $usuario->rol_nivel=1;

      
     return $usuario;

          

    }
    public function setHoraInicioContestacion(){
        $fecha_y_hora = date("Y-m-d H:i:s");

        if( $this->aes_fechaingreso==null){
            $this->aes_fechaingreso=$fecha_y_hora;

        }



    }

    public function CompararContraseniasIguales($contrasenia_establecida,$contasenia_entrante){
        $crypt = new Crypt();
        $text =$contrasenia_establecida;
        $key = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
        $desencrip = trim($crypt->decryptBase64($text, $key));
       
        if($contasenia_entrante==$desencrip){
            return true;
        }else{
            return false;
        }

       
    }

        public function ValidarUnicoCorreoActivo($aes_correo){
            $aes=Autoestudio::query()->where('aes_correo="'.$aes_correo.'" and aes_estatus = 2') ->execute(); 
            $answer=[];
            $answer['estado']=false;
            $answer['mensaje']='No existe un correo con estos datos...';

            if(count($aes)==1){
              
                $answer['estado']=true;
                $answer['aes_id']=$aes[0]->aes_id;
                $answer['ese_id']=$aes[0]->ese_id;
                $answer['aes_contrasenia']=$aes[0]->aes_contrasenia;
                $answer['aes_correo']=$aes[0]->aes_correo;


            }
         


            return $answer;

        }


        public function EnviarATraficoAnalista($aes_id){
            $fecha_y_hora = date("Y-m-d H:i:s");

            $aes=Autoestudio::findFirstByaes_id($aes_id);
            $aes->aes_estatus=3;
            $aes->aes_fechacontesto=$fecha_y_hora;
            $aes->aes_ip=$_SERVER['REMOTE_ADDR'];


            if($aes->update()){
                return ['estado'=>true,'aes_id'=>$aes_id];
            }else{
                return ['estado'=>false,'aes_id'=>$aes_id];

            }



        }


        public function BuscarUnicoRegistroActivo($ese_id){

            $aes_activo=Autoestudio::query()->where('ese_id="'.$ese_id.'" and aes_estatus > 0') ->execute(); 
        
            if(count($aes_activo)>0){
                $answer['estado']=true;
                $answer['ese_id']=$ese_id;
                $answer['aes_id']=$aes_activo[0]->aes_id;
                $answer['aes_correo']=$aes_activo[0]->aes_correo;
            }else
                 $answer['estado']=false;
    
            
            return $answer;

        }


        public function CompararContraseniasIgualesParaGuardar($contrasenia_1,$contrasenia_2){
          
            if($contrasenia_1==$contrasenia_2){

                $answer['estado']=true;
               
            }else{
                $answer['estado']=-1;
                $answer['titular']='Contraseñas.';
                $answer['mensaje']='Contraseñas no son iguales';
    
            }

            return $answer;
         
         
            

        }

        public function ValidarCorreoNoRepetido($aes_id,$aes_correo){
          
            $aes_buscar=Autoestudio::query()->where('aes_correo="'.strtolower($aes_correo).'" and aes_estatus = 2 and aes_id != '.$aes_id) ->execute(); 

            if(count($aes_buscar)>0){
                $answer['estado']=-1;
                $answer['titular']='Correo repetido';
                $answer['mensaje']='El correo ya esta en uso por otro registro';


            }else
                $answer['estado']=true;

       
            
            return $answer;
            

        }


        public function ActualizarDatosUsuario($data){
            $crypt = new Crypt();
            $key  = "jiljJLISJDFLIEPASDU78209348KJSO8UO4NWHNI7H3OLNKJJLjlijlamdnuknKNUKUnuknKNADKAPDmqma634heVZ41mla65vsZ";
            $text = $data['aes_contrasenia'];
            $encrypt = $crypt->encryptBase64($text, $key);
            
            $this->aes_correo=strtolower($data['aes_correo']);
            $this->aes_contrasenia=$encrypt;

            if($this->update())
                return ['estado'=>2,'aes_id'=>$this->aes_id,'ese_id'=>$this->aes_id];
            else
                return ['estado'=>-2];

        }


        public function BuscarRegistroActivoByese_id($ese_id){
            $answer=[];
            $aes_buscar=Autoestudio::query()->where('ese_id="'.$ese_id.'" and aes_estatus > 0 ') ->execute(); 
            
            if(count($aes_buscar)>0){
                $answer['estado']=true;
                $answer['aes_id']=$aes_buscar[0]->aes_id;
            }
              


            else
                 $answer['estado']=false;

            return $answer;     
            

        }

        public function BuscarRegistroCanceladoByese_id($ese_id){
            $answer=[];
            $aes_buscar=Autoestudio::query()->where('ese_id="'.$ese_id.'" and aes_estatus = -2 ') ->execute(); 
            
            if(count($aes_buscar)>0){
                $answer['estado']=true;
                $answer['aes_id']=$aes_buscar[0]->aes_id;
            }
              


            else
                 $answer['estado']=false;

            return $answer;     
            

        }

        public function CancelarAES(){
            $fecha_y_hora = date("Y-m-d H:i:s");

            $this->aes_estatus=-2;
            $this->aes_fechacancelacion=$fecha_y_hora;

            if($this->update())
                return ['estado'=>true,'mensaje'=>'Canceló el autoestudio con ID interno '.$this->aes_id];

            else
            return ['estado'=>false,'mensaje'=>''];

            

        }

        public function ReActivarContestado(){
            $this->aes_estatus=2;

            if($this->update())
            return ['estado'=>true,'mensaje'=>'Reactivo el autoestudio No. '.$this->aes_id];
            else
            return ['estado'=>false,'mensaje'=>''];
        }

        public function ReActivarEnviado(){
            $this->aes_estatus=2;

            if($this->update())
            return ['estado'=>true,'mensaje'=>'Reactivo el autoestudio No. '.$this->aes_id];
            else
            return ['estado'=>false,'mensaje'=>''];
        }

      
    
        
  

    

}