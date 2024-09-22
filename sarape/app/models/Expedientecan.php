<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Crypt;

/**
 * Modelo de la tabla Expedientecan
 */
class Expedientecan extends Model
{
    public  $estatus_proceso=[1,2,3,4];
    public  $estatus_facturado=[5];
    public  $estatus_garantia=[7];
    public  $estatus_activos=[];
    public  $estatus_cancelados=[11,12,13,14,21,31,41,42,43,51];

    public $opcion_estatus_cita = array(
        "si" => array(
            0 => array(
                "valor" => 2,
                "texto" => "REFERENCIAS",
            ),
            2 => array(
                "valor" => 3,
                "texto" => "PSICOMETRÍA",
            ),
           /* 3 => array(
                "valor" => 4,
                "texto" => "ENTREVISTA",
            ),*/
            4 => array(
                "valor" => 5,
                "texto" => "AUTORIZACIÓN",
            ),
           /* 5 => array(
                "valor" => 6,
                "texto" => "FACTURACIÓN",
            )*/
        ),
        "no" => array(
            0 => array(
                "valor" => 11,
                "texto" => "NO CONTESTÓ (CITAS)",
            ),
            2 => array(
                "valor" => 12,
                "texto" => "NO LE INTERESÓ (CITAS)",
            ),
            3 => array(
                "valor" => 13,
                "texto" => "NO CUMPLIO EL PERFIL (CITAS)",
            ),
            4=>array(
                "valor" => 14,
                "texto" => "NO SE PRESENTÓ (CITAS)",
            )
        ),
    );

    public $opcion_estatus_referencias = array(
        "si" => array(
            0 => array(
                "valor" => 1,
                "texto" => "CITAS",
            ),
            2 => array(
                "valor" => 3,
                "texto" => "PSICOMETRÍA",
            ),
           /* 3 => array(
                "valor" => 4,
                "texto" => "ENTREVISTA",
            ),*/
            4 => array(
                "valor" => 5,
                "texto" => "AUTORIZACIÓN",
            ),
            // 5 => array(
            //     "valor" => 6,
            //     "texto" => "FACTURACIÓN",
            // )
        ),
        "no" => array(
            0 => array(
                "valor" => 21,
                "texto" => "NO CUMPLIO (REFERENCIAS)",
            ),
           /* 2 => array(
                "valor" => 12,
                "texto" => "NO LE INTERESÓ (CITAS)",
            ),
            3 => array(
                "valor" => 13,
                "texto" => "NO CUMPLIO EL PERFIL (CITAS)",
            ),*/
        ),
    );

    public $opcion_estatus_entrevista= array(
        "si" => array(
            0 => array(
                "valor" => 1,
                "texto" => "CITAS",
            ),
            2 => array(
                "valor" => 3,
                "texto" => "PSICOMETRÍA",
            ),
            3 => array(
                "valor" => 2,
                "texto" => "REFERENCIAS",
            ),
            4 => array(
                "valor" => 5,
                "texto" => "AUTORIZACIÓN",
            ),
            5 => array(
                "valor" => 6,
                "texto" => "FACTURACIÓN",
            )
        ),
        "no" => array(
            0 => array(
                "valor" => 41,
                "texto" => "NO CUMPLIO PERFIL (ENTREVISTA)",
            ),
           2 => array(
                "valor" => 42,
                "texto" => "NO SE PRESENTÓ (ENTREVISTA)",
            ),
            3 => array(
                "valor" => 43,
                "texto" => "NO LE INTERESÓ AL CANDIDATO (ENTREVISTA) ",
            ),
        ),
    );

    public $opcion_estatus_autorizacion= array(
        "si" => array(
            4 => array(
                "valor" => 4,
                "texto" => "ENTREVISTA",
            )
        ),
        "no" => array(
            0 => array(
                "valor" => 51,
                "texto" => "NO CUMPLIO (AUTORIZACIÓN)",
            ),
           2 => array(
                "valor" => 42,
                "texto" => "NO SE PRESENTÓ (ENTREVISTA)",
            ),
            3 => array(
                "valor" => 43,
                "texto" => "NO LE INTERESÓ AL CANDIDATO (ENTREVISTA) ",
            ),
            //extras
            4 => array(
                "valor" => 1,
                "texto" => "CITAS",
            ),
            5 => array(
                "valor" => 3,
                "texto" => "PSICOMETRÍA",
            ),
            6 => array(
                "valor" => 2,
                "texto" => "REFERENCIAS",
            ),
          
        ),
    );


    public $opcion_estatus_psicometria= array(
        "si" => array(
            0 => array(
                "valor" => 1,
                "texto" => "CITAS",
            ),
            2 => array(
                "valor" => 5,
                "texto" => "AUTORIZACIÓN",
            ),
            3 => array(
                "valor" => 2,
                "texto" => "REFERENCIAS",
            ),
           /* 4 => array(
                "valor" => 4,
                "texto" => "ENTREVISTA",
            ),*/
            /*5 => array(
                "valor" => 6,
                "texto" => "FACTURACIÓN",
            )*/
        ),
        "no" => array(
            0 => array(
                "valor" => 31,
                "texto" => "NO CUMPLIO (PSICOMETRÍA)",
            ),
         /*  2 => array(
                "valor" => 42,
                "texto" => "NO SE PRESENTÓ (ENTREVISTA)",
            ),
            3 => array(
                "valor" => 43,
                "texto" => "NO LE INTERESÓ AL CANDIDATO (ENTREVISTA) ",
            ),*/
        ),
    );

    public $opcion_estatus_default= array(
        "si" => array(
            0 => array(
                "valor" => -1,
                "texto" => "SIN INFO",
            ),
           
        ),
        "no" => array(
            0 => array(
                "valor" => -1,
                "texto" => "SIN INFO",
            ),
       
        ),
    );



    public function NuevoRegistro($data,$auth){
        $registro=new Expedientecan();
        $registro->exc_estatus=1;
        $registro->can_id=$data["can_id"];
        $registro->usu_idalta=$auth["id"];
        $registro->eje_idprincipal=$auth["id"];
        $registro->vac_id=$data["vac_id"];

        if($registro->save()){
            $answer['estado']=2;
            $answer['mensaje']='ok';
            $answer['can_id']=$registro->can_id;
            $answer['exc_id']=$registro->exc_id;
            $answer['vac_id']=$registro->vac_id;

        }else{
            $answer['estado']=-2;
            $answer['mensaje']='error';

        }

        return $answer;


    }


     /**
     * Actualiza un registro de expediente de candidato encontrado.
     *
     * @param int $can_id  ID del candidato a actualizar. Por defecto: 0.
     * @param int $exc_id  ID del registro de expediente a actualizar. Por defecto: 0.
     * @param array $auth Arreglo con información de autenticación o usuario actual.
     *
     * @return array Arreglo con los siguientes elementos: 'estado', 'mensaje', 'can_id', 'exc_id'.
     */
    public function ActualizarCandidatoEncontrado($can_id,$exc_id,$auth){
        $registro = Expedientecan::findFirst($exc_id);
        $answer['estado']=-2;
        $answer['mensaje']='error';

        if($registro){
            $registro->can_id=$can_id;
            $registro->usu_idactualizo=$auth["id"];
    
            if($registro->update()){
                $answer['estado']=2;
                $answer['mensaje']='ok';
                $answer['can_id']=$registro->can_id;
                $answer['exc_id']=$registro->exc_id;
    
            }
        }
   

        return $answer;

    }
    public function getEstatusTexto($estatus)
    {
        switch($estatus)
        {   
            case -2:
                return "CANCELADO";
            break;
            case -1:
                return "VACANTE CANCELADA";
            break;
            case 1:
                return "CITAS";
            break;

            case 2:
                return "REFERENCIAS";
            break;

            case 3:
                return "PSICOMETRÍA";
            break;

            case 4:
                 return "ENTREVISTA";
            break;

            case 5:
                return "AUTORIZACIÓN";
            break;
            case 6:
                return "FACTURACIÓN";
            case 7:
                 return "GARANTÍA";

            case 21:
                return "NO CUMPLIO (REFERENCIAS)";
            break;
            
            case 11:
                return "NO CONTESTÓ (CITAS)";
            break;
            case 12:
                return "NO LE INTERESÓ (CITAS)";
            break;
            case 13:
                return "NO CUMPLIO EL PERFIL (CITAS)";
            case 14:
                return "NO SE PRESENTÓ (CITAS)";   
            break;
            case 31:
                return "NO CUMPLIO (PSICOMETRÍA)";
            break;

            case 51:
                 return "NO CUMPLIO (AUTORIZACIÓN)";
            break;

            case 41:
                return "NO CUMPLIO PERFIL (ENTREVISTA)";
            break;

            case 42:
                return "NO SE PRESENTÓ (ENTREVISTA)";
            break;  
            case 43:
                return "NO LE INTERESÓ AL CANDIDATO (ENTREVISTA)";
            break;
            default:
            return "";
            break;
        }
    }
    public function  getEstatusBanderaColor($estatus)
    {

        switch($estatus)
        {   
            case -2:
            return "badge-danger";
            break;

            case 1:
            return "badge-success badge-exc-cit-ok";
            break;

            case 2:
            return "badge-success badge-exc-ref-ok";
            break;

            case 3:
            return "badge-success badge-exc-psi-ok";
            break;

            case 4:
            return "badge-success badge-exc-ent-ok";
            break;

            case 5:
            return "badge-success badge-exc-aut-ok";
            break;

            case 6:
            return "badge-success badge-exc-fat-ok";
            break;

            case 7:
            return "badge-success badge-exc-gar-ok";
            break;

            case 8:
            return "badge-danger";
            break;

            case 11:
            case 12:
            case 13:
            case 14:
            return "badge-exc-cit-no-ok";
            break;
            case 21:
            return "badge-exc-ref-no-ok";
            break;
            case 31:
            return "badge-exc-psi-no-ok";
            break;
            case 41:
            case 42:
            case 43:
            return "badge-exc-ent-no-ok";
            break;
            case 51:
            return "badge-exc-aut-no-ok";
            break;
            default:
            return "badge-danger";
            break;
        }
    }

    public function cambiarEstatus($data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='error';
        $this->exc_estatusprevio=$this->exc_estatus;
        $this->exc_estatus=$data["exc_estatus"];

        if($data["exc_estatus"]==6){
            $this->exc_fechafacturacion=date("Y-m-d H:i:s");
            $this->usu_idfacturo=$auth["id"];

        }elseif($data["exc_estatus"]==7){
            $this->exc_fechagarantia=date("Y-m-d H:i:s");
            $this->usu_idgarantia=$auth["id"];

        }

        $this->exc_actualizo=date("Y-m-d H:i:s");
        $this->usu_idactualizo=$auth["id"];

        
        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='OK';
            $answer['vac_id']=$this->vac_id;
            $answer['can_id']=$this->can_id;
            $answer['exc_id']=$this->exc_id;


        }else{
            $answer['estado']=-2;

        }
    
      return $answer;

    }

    public function autorizar_o_no($data,$auth){
        $answer['estado']=-2;
        $answer['mensaje']='error';
      
        $this->exc_actualizo=date("Y-m-d H:i:s");
        $this->usu_idactualizo=$auth["id"];
        $this->exc_autorizado=$data["exc_autorizado"];
        $this->exc_fechaautorizo=date("Y-m-d H:i:s");

    
        
        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='OK';
            $answer['vac_id']=$this->vac_id;
            $answer['can_id']=$this->can_id;
            $answer['exc_id']=$this->exc_id;


        }
    
      return $answer;

    }

    public function getEstatusSiNoMostrar($estatus){
        $answer=[];
            switch ($estatus) {   

                case '1':
                    $answer["data"]=$this->opcion_estatus_cita;
                break;
                case '2':
                    $answer["data"]=$this->opcion_estatus_referencias;
                    break;
                case '3':
                    $answer["data"]=$this->opcion_estatus_psicometria;
                    break;
                case '4':
                    $answer["data"]=$this->opcion_estatus_entrevista;
                    break;
                case '5':
                     $answer["data"]=$this->opcion_estatus_autorizacion;
                    break;
                default:
                     $answer["data"]=$this->opcion_estatus_default;
                break;
           
        }
        return $answer;
    
    }
    public function validarSiConcidenEstatusFrontBack($estatus_actual,$estatus_frontend){
        $answer['estado']=-2;
        $answer['mensaje']='ERROR';
        $answer['titular']='ERROR';
        if ($estatus_actual==$estatus_frontend) {
            $answer['mensaje']='El expediente esta OK para el cambio de estatus';
            $answer['titular']='OK';
            $answer['estado']=2;

        }else{
            $answer['mensaje']='El expediente ha sido cambiado previamente de estatus ';
            $answer['titular']='AVISO';
            $answer['estado']=-1;

        }
        return $answer;
    }


    public function validarEstatusParaReactivarExc(){
        $answer['estado']=-2;
        $answer['mensaje']='error';  
        $estatus_no_permitidos = [-1,1,2,3,4,5,6,7];
        
        if (!in_array($this->exc_estatus,$estatus_no_permitidos)) {
            $answer['estado']=2;
            $answer['mensaje']='OK';
            $answer['vac_id']=$this->vac_id;
            $answer['exc_id']=$this->exc_id;            
        }else{
            $answer['estado']=-1;
            $answer["mensaje"]="No se puede realizar el movimiento porque el expediente candidato está en ".$this->getEstatusTexto($this->exc_estatus);
        }
      return $answer;
    }

    public function reactivarRegistro($auth){
      $answer['estado']=-2;
      $answer['mensaje']='error';  
      $estatus_a_cambiar=$this->exc_estatusprevio;
      $estatus_previo=$this->exc_estatus;

      $this->exc_estatusprevio=$estatus_previo;
      $this->exc_estatus=$estatus_a_cambiar;
      $this->usu_idreactivoproceso=$auth["id"];
      $this->exc_fechareactivoproceso=date("Y-m-d H:i:s");

      if($this->update()){
          $answer['estado']=2;
          $answer['mensaje']='OK';
          $answer['vac_id']=$this->vac_id;
          $answer['can_id']=$this->can_id;
          $answer['exc_id']=$this->exc_id;
          $answer['estatus_anterior_text']=$this->getEstatusTexto($estatus_previo);
          $answer['estatus_actual_text']=$this->getEstatusTexto($estatus_a_cambiar);

      }
       
      return $answer;
    }

    public function cambiarEstatusRegresarFacturacion($auth){
        $answer['mensaje']='error';  
        $answer['titular']='error';  
        $answer['estado']=-2;

        $estatus_previo=$this->exc_estatus;
        $this->exc_estatusprevio=$estatus_previo;
        $this->exc_estatus=4;
        $this->usu_idregresofacturacion=$auth["id"];
        $this->exc_fecharegresofacturacion=date("Y-m-d H:i:s");
  
        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='se regreso el expediente con ID '.$this->exc_id;
            $answer['vac_id']=$this->vac_id;
            $answer['can_id']=$this->can_id;
            $answer['exc_id']=$this->exc_id;
            $answer['estatus_anterior_text']=$this->getEstatusTexto($estatus_previo);
            $answer['estatus_actual_text']=$this->getEstatusTexto(4);
  
        }
         
        return $answer;
    }

    public function getTodosEstatusExc(){
        // Combina todos los arreglos en uno solo
        $estatus_combinados_no = array_merge(
            $this->opcion_estatus_cita["si"],
            $this->opcion_estatus_referencias["si"],
            $this->opcion_estatus_entrevista["si"],
            $this->opcion_estatus_autorizacion["si"],
            $this->opcion_estatus_psicometria["si"],
            $this->opcion_estatus_cita["no"],
            $this->opcion_estatus_referencias["no"],
            $this->opcion_estatus_entrevista["no"],
            $this->opcion_estatus_autorizacion["no"],
            $this->opcion_estatus_psicometria["no"]
        );
    
        
    
        foreach ($estatus_combinados_no as $item) {
            $valor = $item['valor'];
            if (!isset($filteredArray[$valor])) {
                $filteredArray[$valor] = $item;
            }
        }
    
        // Reindexamos el arreglo para tener índices numéricos
        $filteredArray = array_values($filteredArray);

        // Ordenar el arreglo en base al valor "valor" de mayor a menor
        usort($filteredArray, function($a, $b) {
            return $a['valor'] - $b['valor'];
        });
    
        return $filteredArray;
    }

    function buscaValorEnArrayCitaNoSigue($valor) {
        $valores_array_cita=$this->opcion_estatus_cita["no"];

        foreach ($valores_array_cita as $item) {
            if ($item['valor'] == $valor) {
                return true;
            }
        }
        return false;
    }

    function cambiarEjecutivoPropietario($data=[],$auth){
        $answer['mensaje']='error';  
        $answer['titular']='error';  
        $answer['estado']=-2;

        $this->eje_idanterior= $this->eje_idprincipal;
        $this->eje_idprincipal=$data['eje_id'];
        $this->usu_idactualizo=$auth["id"];
        $this->exc_actualizo=date("Y-m-d H:i:s");
  
        if($this->update()){
            $answer['estado']=2;
            $answer['mensaje']='se cambio de ejecutivo';
            $answer['vac_id']=$this->vac_id;
            $answer['can_id']=$this->can_id;
            $answer['exc_id']=$this->exc_id;
            $answer['eje_idprincipal']=$this->eje_idprincipal;
            $answer['eje_idanterior']=$this->eje_idanterior;
        
        }
         
        return $answer;   
    }

    public $estatus_no_sigue=[
        11,
        12,
        13,
        14,
        21,
        31,
        41,
        42,
        43
    ];

    


    

}