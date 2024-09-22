<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Di;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class ReporteController extends ControllerBase
{
    public function initialize()
    {
        
        $this->tag->setTitle('Reportes');
        parent::initialize();
    }

  

    public function respuestascuestionariounoAction($emp_id=0,$fol_id=0)
    {       
            //seccion -grafica circular---------------------------------------
            $condicion="";


            if (!is_numeric($emp_id) || !is_numeric($fol_id)) {
                $this->flash->error('Los datos deben ser números.');
                $this->response->redirect('reporte/respuestascuestionariouno');
                $this->view->disable();
                return;
            }
        
            if ($emp_id < 0 || $fol_id < 0) {
                $this->flash->error('Los números deben ser mayores o iguales a 0.');
                $this->response->redirect('reporte/respuestascuestionariouno');
                $this->view->disable();
                return;
            }

            $selected_emp_id=$emp_id;
            $selected_fol_id=($fol_id!=0? $fol_id:"");


            
            if($this->numerovalidoInputValido($emp_id))
                $condicion.=  ( trim($condicion)=="" ?  ' f.emp_id='.$emp_id: ' AND f.emp_id='.$emp_id);
            if($this->numerovalidoInputValido($fol_id))
                $condicion.=  ( trim($condicion)=="" ?  ' f.fol_id='.$fol_id: ' AND f.fol_id='.$fol_id);
            

            $empresas = Empresa::query()
                ->columns('emp_id,emp_nombre')
                ->where("emp_estatus=2")
                ->execute();
            $folios = Folio::query()
            ->columns([
                'fol_id',
                'CONCAT(fol_nombre, " ", fol_primerapellido, " ", fol_segundoapellido) AS fol_nombre'
                ])
                ->where("fol_estatus=2")
                ->execute();


            $di = Di::getDefault();
            $db = $di->get('db');
            $condicion_sql_total="f.fol_estatus = 2";
            $sql = '
            SELECT COUNT(DISTINCT fou_id) as total_fou_id 
            FROM rescueuno
            JOIN folio f ON f.fol_id = rescueuno.fou_id
            WHERE '.$this->agregarAndONoSQL($condicion).$condicion_sql_total.' ';
            $result = $db->query($sql);
            $data = $result->fetchAll();

            $total_encuestados=$data[0]['total_fou_id'];

            $condicion_NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta=" fol_estatus = 2 and cal_id = 3 and pru_id BETWEEN 1 AND 6";
            $NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta=count(Rescueuno::query()
            ->columns('fol_id')
            ->where($this->agregarAndONoSQL($condicion).$condicion_NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta)
            ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
            ->groupBy('fou_id')
            ->execute());
            // error_log($this->agregarAndONoSQL($condicion).$condicion_NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta);
          
            $NumeroDeFoliosQueDijeronNOElAlmenosEnUnaPregunta= $total_encuestados-$NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta;
 
            // seccion --grafica circular FIN----------------------------
  
           // SECCION 1 INICO --------------------------------------------------------------------------
           $repuestasSiEnSeccion1=[];
           for ($i=1; $i <=6 ; $i++) { 
                   
               $NumeroDeSiDeLaPregunta=count(Rescueuno::query()
               ->columns('fol_id , cal_id')
               ->where($this->agregarAndONoSQL($condicion)." fol_estatus=2 and pru_id=".$i." and cal_id=3 ")
               ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
               ->execute());
   
               array_push($repuestasSiEnSeccion1,$NumeroDeSiDeLaPregunta);
               
           }
           $repuestasNoEnSeccion=[];
           for ($i=1; $i <=6 ; $i++) { 
                   
               $NumeroDeNoDeLaPregunta=count(Rescueuno::query()
               ->columns('fol_id , cal_id')
               ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=".$i." and cal_id=2 ")
               ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
               ->execute());
   
               array_push($repuestasNoEnSeccion,$NumeroDeNoDeLaPregunta);
               
           }
         
           // SECCCION 1 FIN---------------------------------------------------------------------------

        // Seccion II INICIO//-------------------------------------------------------INCIO 
            $FoliosDeLaSeccion2Pregunta7ContestaronSi=count(Rescueuno::query()
                    ->columns('fol_id , cal_id')
                    ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=7 and cal_id=3 ")
                    ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
                    ->execute());
            
            $FoliosDeLaSeccion2Pregunta7ContestaronNo=count(Rescueuno::query()
                    ->columns('fol_id , cal_id')
                    ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=7 and cal_id=2 ")
                    ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
                    ->execute());

            $FoliosDeLaSeccion2Pregunta8ContestaronSi=count(Rescueuno::query()
                    ->columns('fol_id , cal_id')
                    ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=8 and cal_id=3 ")
                    ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
                    ->execute());
            
            $FoliosDeLaSeccion2Pregunta8ContestaronNo=count(Rescueuno::query()
                    ->columns('fol_id , cal_id')
                    ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=8 and cal_id=2 ")
                    ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
                    ->execute());

            $respuestasSeccion2=
            [
                    'pregunta8'=>
                            [
                            'NumRespuestaSi' =>$FoliosDeLaSeccion2Pregunta8ContestaronSi,
                            'NumRespuestaNo'=>$FoliosDeLaSeccion2Pregunta8ContestaronNo,
                            ],

                    'pregunta7'=>
                            [
                            'NumRespuestaSi' =>$FoliosDeLaSeccion2Pregunta7ContestaronSi,
                            'NumRespuestaNo'=>$FoliosDeLaSeccion2Pregunta7ContestaronNo,
                            ],
            ];
        // SECCION 2 FIN ---------------------------------------------------------------------------
        
        // SECCION 3 INICO --------------------------------------------------------------------------
        $repuestasSiEnSeccion3=[];
        for ($i=9; $i <=15 ; $i++) { 
                
            $NumeroDeSiDeLaPregunta=count(Rescueuno::query()
            ->columns('fol_id , cal_id')
            ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=".$i." and cal_id=3 ")
            ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
            ->execute());

            array_push($repuestasSiEnSeccion3,$NumeroDeSiDeLaPregunta);
            
        }
        $repuestasNoEnSeccion3=[];
        for ($i=9; $i <=15 ; $i++) { 
                
            $NumeroDeNoDeLaPregunta=count(Rescueuno::query()
            ->columns('fol_id , cal_id')
            ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=".$i." and cal_id=2 ")
            ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
            ->execute());

            array_push($repuestasNoEnSeccion3,$NumeroDeNoDeLaPregunta);
            
        }
        
        // SECCCION3 FIN---------------------------------------------------------------------------
         // SECCCION 4 INICIO---------------------------------------------------------------------------
         $repuestasSiEnSeccion4=[];
         for ($i=16; $i <=20 ; $i++) { 
                 
             $NumeroDeSiDeLaPregunta=count(Rescueuno::query()
             ->columns('fol_id , cal_id')
             ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=".$i." and cal_id=3 ")
             ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
             ->execute());
 
             array_push($repuestasSiEnSeccion4,$NumeroDeSiDeLaPregunta);
             
         }
         $repuestasNoEnSeccion4=[];
         for ($i=16; $i <=20 ; $i++) { 
                 
             $NumeroDeNoDeLaPregunta=count(Rescueuno::query()
             ->columns('fol_id , cal_id')
             ->where($this->agregarAndONoSQL($condicion)."fol_estatus=2 and pru_id=".$i." and cal_id=2 ")
             ->join('Folio','f.fol_id=Rescueuno.fou_id','f')
             ->execute());
 
            array_push($repuestasNoEnSeccion4,$NumeroDeNoDeLaPregunta);
             
         }

       
         
         // SECCCION 4 FIN---------------------------------------------------------------------------
        
        // seccion 1-------------------------------------
         //numero de cuestionarios que dijeron que si y num. que no incio
         $this->view->numDeFoliosQueDijeronQueSiEnAlmenosUnaPregunta=$NumeroDeFoliosQueDijeronSiElAlmenosEnUnaPregunta;    
         $this->view->numDeFoliosQueDijeronQueNoEnAlmenosUnaPregunta=$NumeroDeFoliosQueDijeronNOElAlmenosEnUnaPregunta;  
         //numero de cuestionarios que dijeron que si y num. que no fin

         $this->view->empresas=$empresas;

        $this->view->respuestaSiSeccion1=$repuestasSiEnSeccion1;    
        $this->view->respuestaNoSeccion1=$repuestasNoEnSeccion;    

        // seccion 2-------------------------------------
        $this->view->respuestasSeccion2=$respuestasSeccion2;       
        // seccion 3--------------------------------------
        $this->view->respuestaSiSeccion3=$repuestasSiEnSeccion3;  
        $this->view->respuestaNoSeccion3=$repuestasNoEnSeccion3;  
        //seccion 4------------------------------------
        $this->view->respuestaSiSeccion4=$repuestasSiEnSeccion4; 
        $this->view->respuestaNoSeccion4=$repuestasNoEnSeccion4;  
        $this->view->total_encuestados=$total_encuestados;

        $this->view->selected_emp_id=$selected_emp_id;  
        $this->view->selected_fol_id=$selected_fol_id;  

        $this->view->folios=$folios;  
   
    }

    public function avancecuestionarioAction()
    {
    }
    public function avancepordiacuestionarioAction()
    {
    }
    public function consultaravancecuestionarioAction()
    {
        $this->view->disable();
        if($this->request->isAjax()===true)
            {       
            $answer=array();
            $peticion =$this->request->getPost('consultaIdCuestionario');
        
            $folios = Folio::query()
            ->columns('fol_id')
            ->where("fol_estatus=2")
            ->execute();

            $foliosExistentes= count($folios);
            switch ($peticion) {
                case 'C1':
                    $folioCuestionarioSolicitado=count(Folio::query()
                    ->columns('fol_id')
                    ->where("fol_estatus=2")
                    ->join('Foliocueuno','f.fou_id=Folio.fol_id','f')
                    ->execute());
                    
                    break;

                case 'C2':

                    $folioCuestionarioSolicitado=count(Folio::query()
                    ->columns('fol_id')
                    ->where("fol_estatus=2")
                    ->join('Foliocuedos','f.fod_id=Folio.fol_id','f')
                    ->execute());
                    
                    break;

                case 'C3':
                    $folioCuestionarioSolicitado=count(Folio::query()
                    ->columns('fol_id')
                    ->where("fol_estatus=2")
                    ->join('Foliocuetres','f.fot_id=Folio.fol_id','f')
                    ->execute());
                    
                    break;
                    
                case 'CL':
                    $folioCuestionarioSolicitado=count(Folio::query()
                    ->columns('fol_id')
                    ->where("fol_estatus=2")
                    ->join('Foliocueclima','f.folcucli_id=Folio.fol_id','f')
                    ->execute());
                    break;
                
            }
        $foliosNocontestados=$foliosExistentes-$folioCuestionarioSolicitado;
        $answer[0]=$foliosNocontestados;
        $answer[1]=$folioCuestionarioSolicitado;//numero de folios ya contestados
        $this->response->setJsonContent($answer);
        $this->response->send();
        return;
        }

    }

    public function tablafolioAction($peticion){
	
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        if($this->request->isAjax()===true)
        {
            switch ($peticion) {
                case 'C1':
                    $folio = Folio::query()
                    ->columns('fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,fou_fecharegistro as fol_fecha')
                    ->where("fol_estatus=2")
                    ->join('Foliocueuno','f.fou_id=Folio.fol_id','f')
                    ->execute();
                    
                    break;

                case 'C2':

                    $folio = Folio::query()
                    ->columns('fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,fod_fecharegistro as fol_fecha')
                    ->where("fol_estatus=2")
                    ->join('Foliocuedos','f.fod_id=Folio.fol_id','f')
                    ->execute();
                    
                    break;

                case 'C3':
                    $folio = Folio::query()
                    ->columns('fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,fot_fecharegistro as fol_fecha')
                    ->where("fol_estatus=2")
                    ->join('Foliocuetres','f.fot_id=Folio.fol_id','f')
                    ->execute();
                    
                    break;
                    
                case 'CL':
                    $folio = Folio::query()
                        ->columns('fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,folcucli_fecharegistro as fol_fecha')
                        ->where("fol_estatus=2")
                        ->join('Foliocueclima','f.folcucli_id=Folio.fol_id','f')
                        ->execute();
                    break; 
            }
            $cuestionario= new Cueactivo();
            $cue= $cuestionario->EstadoCuestionario();
            $this->view->cuestionario=$cue;
            $this->view->page=$folio;

        }

    }

    public function consultaravancecuestionarioporfechaAction()
    {       
         $this->view->disable();
         if($this->request->isAjax()===true)
         {
            $answer=array();
            if($data =$this->request->getPost())
            {   
                $condicion='';

                switch ($data['idCuestionarioConsulta']) {
                    case 'C1':
                        if($data['fecha_ini']!='')
                        {
                            $condicion.=" and fou_fecharegistro >='".$data['fecha_ini']."'";
                        }
                        if($data['fecha_fin']!='')
                        {
                            $condicion.=" and fou_fecharegistro <='".$data['fecha_fin']."'";
                        }
                        $foliosDeEsaFecha=Folio::query()
                        ->columns("count(fol_id) folio_contestados,DATE_FORMAT(fou_fecharegistro,'%d/%m/%Y') fecha")
                        ->where("fol_estatus=2".$condicion)
                        ->join('Foliocueuno','f.fou_id=Folio.fol_id','f')
                        ->groupBy('fecha')
                        ->execute();
                        $folioCuestionarioSolicitado=count($foliosDeEsaFecha);

                        
                        break;
    
                    case 'C2':
                        if($data['fecha_ini']!='')
                        {
                            $condicion.=" and fod_fecharegistro >='".$data['fecha_ini']."'";
                        }
                        if($data['fecha_fin']!='')
                        {
                            $condicion.=" and fod_fecharegistro <='".$data['fecha_fin']."'";
                        }
                        $foliosDeEsaFecha=Folio::query()
                        ->columns("count(fol_id) folio_contestados ,DATE_FORMAT(fod_fecharegistro,'%d/%m/%Y') fecha")
                        ->where("fol_estatus=2 ".$condicion)
                        ->join('Foliocuedos','f.fod_id=Folio.fol_id','f')
                        ->groupBy('fecha')
                        ->execute();
                        $folioCuestionarioSolicitado=count($foliosDeEsaFecha);
                        break;
    
                    case 'C3':

                        if($data['fecha_ini']!='')
                        {
                            $condicion.=" and fot_fecharegistro >='".$data['fecha_ini']."'";
                        }
                        if($data['fecha_fin']!='')
                        {
                            $condicion.=" and fot_fecharegistro <='".$data['fecha_fin']."'";
                        }
                        $foliosDeEsaFecha=Folio::query()
                        ->columns("count(fol_id) folio_contestados ,DATE_FORMAT(fot_fecharegistro,'%d/%m/%Y') fecha")
                        ->where("fol_estatus=2".$condicion)
                        ->join('Foliocuetres','f.fot_id=Folio.fol_id','f')
                        ->groupBy('fecha')
                        ->execute();
                        $folioCuestionarioSolicitado=count($foliosDeEsaFecha);

                        break;
                        
                    case 'CL':
                        if($data['fecha_ini']!='')
                        {
                            $condicion.=" and folcucli_fecharegistro >='".$data['fecha_ini']."'";
                        }
                        if($data['fecha_fin']!='')
                        {
                            $condicion.=" and folcucli_fecharegistro <='".$data['fecha_fin']."'";
                        }
                      
                        $foliosDeEsaFecha=(Folio::query()
                        ->columns("count(fol_id) folio_contestados ,DATE_FORMAT(folcucli_fecharegistro,'%d/%m/%Y') fecha")
                        ->where("fol_estatus=2".$condicion)
                        ->join('Foliocueclima','f.folcucli_id=Folio.fol_id','f')
                        ->groupBy('fecha')
                        ->execute());
                        $folioCuestionarioSolicitado=count($foliosDeEsaFecha);
                        break;
                    
                }
                $answer['fecha_ini']=$data['fecha_ini'];
                $answer['fecha_fin']=$data['fecha_fin'];
                $answer['peticion']=$data['idCuestionarioConsulta'];
                $answer['folios']=$foliosDeEsaFecha;
                $answer['folioSolicitado']= $folioCuestionarioSolicitado;//numero de folios ya contestados
                $this->response->setJsonContent($answer);
                $this->response->send();
                return;
                       
            }
            else
                return -1;

            
         }

    }

    public function tablafolioporfechaAction($peticion){
	
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data =$this->request->getPost();
       
    
        if($this->request->isAjax()===true)
        {   
            $fecha_ini =$data['fecha_ini'];
            $fecha_fin =$data['fecha_fin'];
            $condicion='';

            switch ($peticion) {
                case 'C1':
                   
                    if($fecha_ini!='')
                    {
                        $condicion.=" and fou_fecharegistro >='$fecha_ini.'";

                    }
                    if($fecha_fin!='')
                    {
                        $condicion.=" and fou_fecharegistro <='$fecha_fin'";
                    }
                    $folio = Folio::query()
                    ->columns("fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,DATE_FORMAT(fou_fecharegistro,'%d/%m/%Y'), fou_fecharegistro as fol_fecha")
                    ->where("fol_estatus=2".$condicion)
                    ->join('Foliocueuno','f.fou_id=Folio.fol_id','f')
                    ->execute();
                    break;
                   

                case 'C2':
                    if($fecha_ini!='')
                    {
                        $condicion.=" and fod_fecharegistro >='$fecha_ini.'";

                    }
                    if($fecha_fin!='')
                    {
                        $condicion.=" and fod_fecharegistro <='$fecha_fin'";
                    }

                    $folio = Folio::query()
                    ->columns("fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,DATE_FORMAT(fod_fecharegistro,'%d/%m/%Y'), fod_fecharegistro as fol_fecha")
                    ->where("fol_estatus=2".$condicion)
                    ->join('Foliocuedos','f.fod_id=Folio.fol_id','f')
                    ->execute();
                    
                   
                    
                    break;

                case 'C3':
                    if($fecha_ini!='')
                    {
                        $condicion.=" and fot_fecharegistro >='$fecha_ini.'";

                    }
                    if($fecha_fin!='')
                    {
                        $condicion.=" and fot_fecharegistro <='$fecha_fin'";
                    }

                    $folio = Folio::query()
                    ->columns("fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,DATE_FORMAT(fot_fecharegistro,'%d/%m/%Y'), fot_fecharegistro as fol_fecha")
                    ->where("fol_estatus=2".$condicion)
                    ->join('Foliocuetres','f.fot_id=Folio.fol_id','f')
                    ->execute();
                    break;
                    
                case 'CL':
                    if($fecha_ini!='')
                    {
                        $condicion.=" and folcucli_fecharegistro >='$fecha_ini.'";

                    }
                    if($fecha_fin!='')
                    {
                        $condicion.=" and folcucli_fecharegistro <='$fecha_fin'";
                    }

                    $folio = Folio::query()
                    ->columns("fol_id,fol_matricula,fol_nombre,fol_primerapellido,fol_segundoapellido,fol_correo,DATE_FORMAT(folcucli_fecharegistro,'%d/%m/%Y'), folcucli_fecharegistro as fol_fecha")
                    ->where("fol_estatus=2".$condicion)
                    ->join('Foliocueclima','f.folcucli_id=Folio.fol_id','f')
                    ->execute();
                    
                    
                    break; 
            }

         
            $cuestionario= new Cueactivo();
            $cue= $cuestionario->EstadoCuestionario();
            $this->view->cuestionario=$cue;
            $this->view->page=$folio;

        }
   

    }



    public function respuestascuestionariodosvistaAction()
    {
        
         $empresas = Empresa::query()
        ->columns('emp_id,emp_nombre')
        ->where("emp_estatus=2")
        ->execute();

        $folios = Folio::query()
        ->columns([
            'fol_id',
            'CONCAT(fol_nombre, " ", fol_primerapellido, " ", fol_segundoapellido) AS fol_nombre'
            ])
            ->where("fol_estatus=2")
            ->execute();
        $this->view->empresas=$empresas;
        $this->view->folios=$folios;    }

    public function manejadorconsultacuestionario2Action()
    {
        $this->view->disable();
        $answer=array();
        $answer["fol_id"]=0;

        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $empresa_id= $data['emp_id'];
            $condicion='';

            $condicion.=  ( trim($condicion)=="" ?  'f.fol_estatus=2 and Rescuedos.prd_id=1': ' AND f.fol_estatus=2 and Rescuedos.prd_id=1');

            if($this->numerovalidoInputValido($data['fol_id'])){
                $condicion.=  ( trim($condicion)=="" ?  'f.fol_id='.$data['fol_id']: ' AND f.fol_id='.$data['fol_id']);
                $answer["fol_id"]=$data['fol_id'];

            }

            if($empresa_id==='-1')
            {
                $total_de_encuestados=Rescuedos::query()
                ->columns('count(f.fol_id) as total')
                 ->join('Folio','f.fol_id=Rescuedos.fod_id','f')
                 ->join('Calificacion','c.cal_id=Rescuedos.cal_id','c')
                ->where($condicion)
                ->execute();
                if($total_de_encuestados[0]['total']>=1)
                {
                    $answer[0]=1;
                    $answer[1]=0;
                    return json_encode($answer);

                }
                if ($total_de_encuestados[0]['total']<=0) 
                {
                        $answer[0]=-1;
                        return json_encode($answer);
                } 


                $answer[0]=1;
                $answer[1]='';
                return json_encode($answer);
                
            }
            else
            {
                $condicion.=  ( trim($condicion)=="" ? 'e.emp_id='.$empresa_id.' ': ' AND e.emp_id='.$empresa_id.' ');

                $total_de_encuestados_de_x_empresa=Rescuedos::query()
                    ->columns('count(f.fol_id) as total')
                     ->join('Folio','f.fol_id=Rescuedos.fod_id','f')
                     ->join('Calificacion','c.cal_id=Rescuedos.cal_id','c')
                     ->join('Empresa','e.emp_id=f.emp_id','e')
                    ->where($condicion)
                    ->execute();
                    if($total_de_encuestados_de_x_empresa[0]['total']>=1)
                    {
                     
                        $answer[0]=1;
                        $answer[1]=$empresa_id;
                        return json_encode($answer);
                        
                    }
                    if ($total_de_encuestados_de_x_empresa[0]['total']<=0) 
                    {
                        $answer[0]=-1;
                        return json_encode($answer);
                    } 

              }
          

        
        }

    }
     
    




    public function respuestascuestionariodosAction($emp_id,$fol_id=0)
    {
 
        $this->view->disable();


        $letras=["B","C","D",'E',"F","G","H","I","J","K"];
        $encabezadosDeLaTabla=["Categoria","Calificación","Nivel de riesgo",'Dominio','Calificación','Nivel de riesgo','Dimensión','Item','Participación en el dominio','Suma de items'];
        //las celdas a las que aplicamos bordes
        $RangoDeCeldasConBorde=['B9:D11','B13:D21','B23:D25','B27:D31','E9:G11','E13:G21','E23:G25','E27:G31','H9:K11','H13:K21','H23:K25','H27:K31', 'B35:D35',];

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Reporte de cuestionario dos")
        ->setSubject("Reporte de cuestionario dos")
        ->setDescription("Reporte de cuestionario dos")
        ->setKeywords("Reporte de cuestionario dos")
        ->setCategory("Reporte de cuestionario doss");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);

        //estilos inicio
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '001219'),
                ),
            ),
        );
        $styleArrayInsideBorder = array(
            'borders' => array(
                'inside' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '001219'),
                ),
            ),
        );
        $styleAlignment = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );
        
        $objPHPExcel->getActiveSheet()->getStyle("B9:B27")->applyFromArray($styleAlignment);
        $objPHPExcel->getActiveSheet()->getStyle("E9:E31")->applyFromArray($styleAlignment);
        //aplicando border
        for($i=0;$i<count($RangoDeCeldasConBorde);$i++)
        {
            $objPHPExcel->getActiveSheet()->getStyle($RangoDeCeldasConBorde[$i])->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle($RangoDeCeldasConBorde[$i])->applyFromArray($styleArrayInsideBorder);
        }
          // FORMATO
          $CeldasQueSeVanUnir=[
            'B9:B11',
            'B13:B21',
            'B23:B25',
            'B27:B31',
            'E9:E11',
            'E13:E18',
            'E19:E21',
            'E24:E25',
            'E27:E28',
            'E29:E30',
            'C9:C11',
            'C13:C21',
            'C23:C25',
            'C27:C31',
            'D9:D11',
            'D13:D21',
            'D23:D25',
            'D27:D31',
            'G9:G11',
            'G13:G18',
            'G19:G21',
            'G24:G25',
            'G27:G28',
            'F9:F11',
            'G29:G30',
            'F13:F18',
            'F19:F21',
            'F24:F25',
            'F27:F28',
            'F29:F30',

        ];
            
        for ($i=0; $i <count($CeldasQueSeVanUnir) ; $i++) { 
                $objPHPExcel->getActiveSheet()->mergeCells($CeldasQueSeVanUnir[$i]);
        }


        ///colores que se usaran
        $color_verde='6FFF00';
        $color_azul='00C4FF';
        $color_amarillo='FFF700';
        $color_anaranjado='FABF33';
        $color_rojo='FF1A00';


    
        //estilos fin

        //titulo del archivo
        $CeldaTitulo="D2";
        
        $objPHPExcel->getActiveSheet()->getStyle($CeldaTitulo)->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->SetCellValue($CeldaTitulo, 'Calificaciones obtenidas.');
        $objPHPExcel->getActiveSheet()->getStyle( $CeldaTitulo )->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Total de encuestas');

        //TITULARES DE LA TABLA-------------------------------------------------------INICIO
        for ($i=0; $i <count($letras) ; $i++) 
        { 
            $objPHPExcel->getActiveSheet()->getColumnDimension($letras[$i])->setAutoSize(true);
            //formateamos todos los titulares en bold
            $objPHPExcel->getActiveSheet()->getStyle("$letras[$i]"."8")->getFont()->setBold( true );
            $objPHPExcel->getActiveSheet()->SetCellValue("$letras[$i]"."8","$encabezadosDeLaTabla[$i]");
        }    
        //TITULARES DE LA TABLA---------------------------------------------------------------FIN

        

        //COLUMNA CATEGORIA---------------------------INCIO--
        $objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Ambiente de trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('B13', 'Factores propios de la actividad');

        $objPHPExcel->getActiveSheet()->SetCellValue('B23', 'Organización del tiempo de trabajo ');

        $objPHPExcel->getActiveSheet()->SetCellValue('B27', 'Liderazgo y relaciones en el trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('B35', 'Calificación final del cuestionario ');
        //COLUMNA CATEGORIA ------------------------FIN----


        //COLUMNA DOMINIO -------------------------------INICIO
        $objPHPExcel->getActiveSheet()->SetCellValue('E9', 'Condiciones en el ambiente de trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('E13', 'Carga de trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('E19', 'Falta de control sobre el trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('E23', 'Jornada de trabajo');

        $objPHPExcel->getActiveSheet()->SetCellValue('E24', 'Interferencia en la relación trabajo-familia');

        $objPHPExcel->getActiveSheet()->SetCellValue('E27', 'Liderazgo');

        $objPHPExcel->getActiveSheet()->SetCellValue('E29', 'Relaciones en el trabajo ');

        $objPHPExcel->getActiveSheet()->SetCellValue('E31', 'Violencia');

        //COLUMNA DOMINIO --------------------------------FIN
        

        ///columna DIMENSION INICO--------------------INICIO 

        $contenidoDeLaColumnaDimension=[
            ['H9','Condiciones peligrosas e inseguras'],
            ['H10','Condiciones deficientes e insalubres'],
            ['H11','Trabajos peligrosos'],
            ['H13','Cargas cuantitativas'],
            ['H14','Ritmos de trabajo acelerado'],
            ['H15','Carga mental'],
            ['H16','Cargas psicológicas emocionales'],
            ['H17','Cargas de alta responsabilidad'],
            ['H18','Cargas contradictorias o inconsistentes'],
            ['H19','Falta de control y autonomía sobre el trabajo'],
            ['H20','Limitada o nula posibilidad de desarrollo'],
            ['H21','Limitada o inexistente capacitación'],
            ['H23','Jornadas de trabajo extensas'],
            ['H24','Influencia del trabajo fuera del centro laboral'],
            ['H25','Influencia de las responsabilidades familiares '],
            ['H27','Escasa claridad de funciones'],
            ['H28','Características del liderazgo'],
            ['H29','Relaciones sociales en el trabajo'],
            ['H30','Deficiente relación con los colaboradores que supervisa'],
            ['H31','Violencia laboral'],
        ];
    
        for($i=0;$i<count($contenidoDeLaColumnaDimension);$i++)
        {
            $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaDimension[$i][0], $contenidoDeLaColumnaDimension[$i][1]);
     
        }
       
        //COLUMNA dimencsion FIN-------------------------FIN

        //COLUMNA DE ITEMS-------------------------INICIO--
        $contenidoDeLaColumnaItems=[
            ['I9', '2'],
            ['I10', '1'],
            ['I11', '3'],
            ['I13', '4,9'],
            ['I14', '5,6'],
            ['I15', '7,8'],
            ['I16', '41,42,43'],
            ['I17', '10,11'],
            ['I18', '12,13'],
            ['I19', '20,21,22'],
            ['I20', '18,19'],
            ['I21', '26,27'],
            ['I23', '14,15'],
            ['I24', '16'],
            ['I25', '17'],
            ['I27', '23,24,25'],
            ['I28', '28,29'],
            ['I29', '30,31,32'],
            ['I30', '44,45,46'],
            ['I31', '33 A 40'],    
        ];
        for($i=0;$i<count($contenidoDeLaColumnaItems);$i++)
        {
            $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaItems[$i][0], $contenidoDeLaColumnaItems[$i][1]);

        }

        //LLENADO DE DATOS 
                    //NUMERO DE FOLIOS 
        $condicion='';
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', 'EMPRESA');
        if($emp_id==0)
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('C5', 'GENERAL');

        }
        elseif ($emp_id>=1) 
        {
            $nombre_empresa=Empresa::query()
            ->columns('emp_nombre as nombre')
            ->where('emp_id='.$emp_id)
            ->execute();

            $objPHPExcel->getActiveSheet()->SetCellValue('C5',$nombre_empresa[0]['nombre']);



        }
        $condicionNueroDeEncuestasContestadas="fol_estatus=2 and prd_id=1";
        if($emp_id>=1) {
            $condicion.=  ( trim($condicion)!="" ?  ' AND emp_id='.$emp_id.' ': '  emp_id='.$emp_id.' ');
        }
        if($fol_id>=1) {
           $condicion.=  ( trim($condicion)!="" ?  ' AND Folio.fol_id='.$fol_id.' ': '  Folio.fol_id='.$fol_id.' ');
        }
        $condicion_valor_rescueno_inical = ' fol_estatus=2 and Rescuedos.prd_id=#prd_id#';

        $condicion_valor_rescueno= $this->agregarAndONoSQL($condicion).$condicion_valor_rescueno_inical;
        $condicionNueroDeEncuestasContestadas=$this->agregarAndONoSQL($condicion).$condicionNueroDeEncuestasContestadas;

        $NumeroDeEncuestasContestadas=count(Folio::query()->columns('fol_id')
        ->where($condicionNueroDeEncuestasContestadas)
        ->join('Rescuedos','r.fod_id=Folio.fol_id','r')
        ->execute());
         $objPHPExcel->getActiveSheet()->SetCellValue('C6', $NumeroDeEncuestasContestadas);
         $columns='sum(c.cal_valor) as total';
        $resultadoPorPregunta=[]; 
        for ($i=1; $i <=48 ; $i++) 
        { 

            $condicion_rescuedos_dinamica = str_replace('#prd_id#', $i, $condicion_valor_rescueno);

            $valor=Rescuedos::query()
            ->columns($columns)
            ->join('Folio','Folio.fol_id=Rescuedos.fod_id')
            ->join('Calificacion','c.cal_id=Rescuedos.cal_id','c')
            ->where($condicion_rescuedos_dinamica)
            ->execute();            
            array_push($resultadoPorPregunta, $valor[0]["total"]);
           
        }
        
  
     
        //COLUMNA suma de items
        $sumaDeItemsDeAmbienteDeTrabajo=
        [
            number_format($resultadoPorPregunta[1]/$NumeroDeEncuestasContestadas,2),
            number_format($resultadoPorPregunta[0]/$NumeroDeEncuestasContestadas,2),
            number_format($resultadoPorPregunta[2]/$NumeroDeEncuestasContestadas,2),
        ];
     

        $sumaFactoresPropiosDeLaActiviidad=[
            number_format(($resultadoPorPregunta[3]+$resultadoPorPregunta[8])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[4]+$resultadoPorPregunta[5])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[6]+$resultadoPorPregunta[7])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[40]+$resultadoPorPregunta[41]+$resultadoPorPregunta[42])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[9]+$resultadoPorPregunta[10])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[11]+$resultadoPorPregunta[12])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[19]+$resultadoPorPregunta[20]+$resultadoPorPregunta[21])/$NumeroDeEncuestasContestadas,2),
            number_format((($resultadoPorPregunta[17]+$resultadoPorPregunta[18])/$NumeroDeEncuestasContestadas),2),
            number_format(($resultadoPorPregunta[25]+$resultadoPorPregunta[26])/$NumeroDeEncuestasContestadas,2),
        ];
        $sumaOrganizacionDelTiempoDeTrabajo=
        [
            number_format(($resultadoPorPregunta[13]+$resultadoPorPregunta[14])/$NumeroDeEncuestasContestadas,2),
            number_format( $resultadoPorPregunta[15]/$NumeroDeEncuestasContestadas,2),
            number_format($resultadoPorPregunta[16]/$NumeroDeEncuestasContestadas,2),

        ];
        $sumaLiderazgoRelacionesEnEltrabajo=[
            number_format(($resultadoPorPregunta[22]+$resultadoPorPregunta[23]+$resultadoPorPregunta[24])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[27]+$resultadoPorPregunta[28])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[29]+$resultadoPorPregunta[30]+$resultadoPorPregunta[31])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[43]+$resultadoPorPregunta[44]+$resultadoPorPregunta[45])/$NumeroDeEncuestasContestadas,2),
            number_format(($resultadoPorPregunta[32]+$resultadoPorPregunta[33]+$resultadoPorPregunta[34]+$resultadoPorPregunta[35]+$resultadoPorPregunta[36]+$resultadoPorPregunta[37]+$resultadoPorPregunta[38]+$resultadoPorPregunta[39])/$NumeroDeEncuestasContestadas,2),
        ];

        
        //columa califacion DOMINIO//
        $sumaDeAmbienteDeTrabajoTotal=array_sum($sumaDeItemsDeAmbienteDeTrabajo);
        $objPHPExcel->getActiveSheet()->SetCellValue('F9',number_format($sumaDeAmbienteDeTrabajoTotal,2) );

        $cargaDeTrabajo=$sumaFactoresPropiosDeLaActiviidad[0]+$sumaFactoresPropiosDeLaActiviidad[1]+$sumaFactoresPropiosDeLaActiviidad[2]+$sumaFactoresPropiosDeLaActiviidad[3]+$sumaFactoresPropiosDeLaActiviidad[4]+$sumaFactoresPropiosDeLaActiviidad[5];
        $objPHPExcel->getActiveSheet()->setCellValue('F13',number_format($cargaDeTrabajo,2));


        
        $sobreElcontrolDetrabajo=$sumaFactoresPropiosDeLaActiviidad[6]+$sumaFactoresPropiosDeLaActiviidad[7]+$sumaFactoresPropiosDeLaActiviidad[8];
        $objPHPExcel->getActiveSheet()->setCellValue('F19', $sobreElcontrolDetrabajo);

        $jornadaDeTrabajo=$sumaOrganizacionDelTiempoDeTrabajo[0];

        $objPHPExcel->getActiveSheet()->setCellValue('F23', $jornadaDeTrabajo);

        $interferencialEnRelacionTrabajoFamilia=$sumaOrganizacionDelTiempoDeTrabajo[1]+$sumaOrganizacionDelTiempoDeTrabajo[2];
        $objPHPExcel->getActiveSheet()->setCellValue('F24', $interferencialEnRelacionTrabajoFamilia);

        $liderazgoDominio=$sumaLiderazgoRelacionesEnEltrabajo[0]+$sumaLiderazgoRelacionesEnEltrabajo[1];
        $objPHPExcel->getActiveSheet()->setCellValue('F27',  $liderazgoDominio);

        $relacionDelTrabajoDominio=$sumaLiderazgoRelacionesEnEltrabajo[2]+$sumaLiderazgoRelacionesEnEltrabajo[3];
        $objPHPExcel->getActiveSheet()->setCellValue('F29',$relacionDelTrabajoDominio);

        $violenciaDelTrabajoDominio=$sumaLiderazgoRelacionesEnEltrabajo[4];
        $objPHPExcel->getActiveSheet()->setCellValue('F31', $violenciaDelTrabajoDominio);
         //columa califacion DOMINIO//

              //columna participacion dominio donde aparece el %
          



              $columna='K';
              $columnaSecundaria='J'; 
        for ($i = 0, $fila = 9; $i <count($sumaDeItemsDeAmbienteDeTrabajo) ; $i++ ,$fila++) { 
            
            $objPHPExcel->getActiveSheet()->SetCellValue($columna.$fila,$sumaDeItemsDeAmbienteDeTrabajo[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($columna.$fila)->getNumberFormat()->setFormatCode('0.00'); 
            if ($sumaDeAmbienteDeTrabajoTotal != 0) {
                $porcetajeDeparticipacionDeDominio = number_format((($sumaDeItemsDeAmbienteDeTrabajo[$i] * 100) / $sumaDeAmbienteDeTrabajoTotal), 2);
            } else {
                $porcetajeDeparticipacionDeDominio = 0; // O el valor que desees cuando el denominador es cero
            }
            $objPHPExcel->getActiveSheet()->SetCellValue($columnaSecundaria.$fila,"$porcetajeDeparticipacionDeDominio%");


        }
        for ($i = 0, $fila = 13; $i <count($sumaFactoresPropiosDeLaActiviidad) ; $i++ ,$fila++) { 
           
            $objPHPExcel->getActiveSheet()->SetCellValue($columna.$fila, $sumaFactoresPropiosDeLaActiviidad[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($columna.$fila)->getNumberFormat()->setFormatCode('0.00'); 

        }

        for ($i = 0, $fila = 23; $i <count($sumaOrganizacionDelTiempoDeTrabajo) ; $i++ ,$fila++) { 
           
            $objPHPExcel->getActiveSheet()->SetCellValue($columna.$fila, $sumaOrganizacionDelTiempoDeTrabajo[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($columna.$fila)->getNumberFormat()->setFormatCode('0.00'); 

        }
        for ($i = 0, $fila = 27; $i <count($sumaLiderazgoRelacionesEnEltrabajo) ; $i++ ,$fila++) { 
           
            $objPHPExcel->getActiveSheet()->SetCellValue($columna.$fila, $sumaLiderazgoRelacionesEnEltrabajo[$i]);
            $objPHPExcel->getActiveSheet()->getStyle($columna.$fila)->getNumberFormat()->setFormatCode('0.00'); 

        }
        //COLUMNA suma de items fin
       

        ////porcentaje de participación de dominio
        $objPHPExcel->getActiveSheet()->setCellValue('J13', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[0] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J14', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[1] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J15', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[2] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J16', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[3] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J17', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[4] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J18', $cargaDeTrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[5] * 100) / $cargaDeTrabajo, 2) . "%" : "N/A");

        $objPHPExcel->getActiveSheet()->setCellValue('J19', $sobreElcontrolDetrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[6] * 100) / $sobreElcontrolDetrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J20', $sobreElcontrolDetrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[7] * 100) / $sobreElcontrolDetrabajo, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J21', $sobreElcontrolDetrabajo != 0 ? number_format(($sumaFactoresPropiosDeLaActiviidad[8] * 100) / $sobreElcontrolDetrabajo, 2) . "%" : "N/A");

        $objPHPExcel->getActiveSheet()->setCellValue('J23', $jornadaDeTrabajo != 0 ? number_format(($sumaOrganizacionDelTiempoDeTrabajo[0] * 100) / $jornadaDeTrabajo, 2) . "%" : "N/A");

        $objPHPExcel->getActiveSheet()->setCellValue('J24', $interferencialEnRelacionTrabajoFamilia != 0 ? number_format(($sumaOrganizacionDelTiempoDeTrabajo[1] * 100) / $interferencialEnRelacionTrabajoFamilia, 2) . "%" : "N/A");
        $objPHPExcel->getActiveSheet()->setCellValue('J25', $interferencialEnRelacionTrabajoFamilia != 0 ? number_format(($sumaOrganizacionDelTiempoDeTrabajo[2] * 100) / $interferencialEnRelacionTrabajoFamilia, 2) . "%" : "N/A");



        $objPHPExcel->getActiveSheet()->setCellValue('J27' ,number_format(($sumaLiderazgoRelacionesEnEltrabajo[0]*100)/$liderazgoDominio,2)."%");
        $objPHPExcel->getActiveSheet()->setCellValue('J28' ,number_format(($sumaLiderazgoRelacionesEnEltrabajo[1]*100)/$liderazgoDominio,2)."%");



        $PorcetajeParcipacionItem30_31_32=number_format(($sumaLiderazgoRelacionesEnEltrabajo[2]*100)/$relacionDelTrabajoDominio,2);
        $objPHPExcel->getActiveSheet()->setCellValue('J29' ,$PorcetajeParcipacionItem30_31_32."%");
        

        $PorcetajeParcipacionItem44a46=number_format( ($sumaLiderazgoRelacionesEnEltrabajo[3]*100)/$relacionDelTrabajoDominio,2);
        $objPHPExcel->getActiveSheet()->setCellValue('J30' ,$PorcetajeParcipacionItem44a46."%");

        
        $PorcetajeParcipacionItem31a34=number_format(($sumaLiderazgoRelacionesEnEltrabajo[4]*100)/$violenciaDelTrabajoDominio,2);
        $objPHPExcel->getActiveSheet()->setCellValue('J31' ,"$PorcetajeParcipacionItem31a34%" );


      
                //Mensajes
                    $califacionPorCaetgoria=
                    [
                        ['D9',array_sum($sumaDeItemsDeAmbienteDeTrabajo)],
                        ['D13',array_sum($sumaFactoresPropiosDeLaActiviidad)],
                        ['D23',array_sum($sumaOrganizacionDelTiempoDeTrabajo)],
                        ['D27',array_sum($sumaLiderazgoRelacionesEnEltrabajo)],
                    
                    ];

                    switch ($califacionPorCaetgoria[0][1]) {
                        case $califacionPorCaetgoria[0][1]<3:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[0][0], 'Nulo o despreciable');
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Nulo o despreciable');
                            $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));
                            $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));



                            break;
                        
                        case $califacionPorCaetgoria[0][1]>=3 && $califacionPorCaetgoria[0][1]<5:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[0][0], 'Bajo');
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Bajo');
                                    $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));
                                    $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $color_verde) )));

                            break;

                        
                        case $califacionPorCaetgoria[0][1]>=5 && $califacionPorCaetgoria[0][1]<7:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[0][0], 'Medio');
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Medio');
                            $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$color_amarillo) ))); 
                            $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));


                            break;

                        case $califacionPorCaetgoria[0][1]>=7 && $califacionPorCaetgoria[0][1]<9:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[0][0], 'Alto');
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Alto');
                            $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));
                            $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));


                            break;
                        case $califacionPorCaetgoria[0][1]>=9:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[0][0], 'Muy alto');
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Muy alto');
                            $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$color_rojo) )));
                            $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$color_rojo) )));


                            break;
                    }

                    ///mensajes para factores de factores propios de la actividad
                    switch ($califacionPorCaetgoria[1][1]) {
                        case $califacionPorCaetgoria[1][1]<10:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[1][0], 'Nulo o despreciable');
                            $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[1][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                            break;
                        
                        case $califacionPorCaetgoria[1][1]>=10 && $califacionPorCaetgoria[1][1]<20:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[1][0], 'Bajo');
                            $objPHPExcel->getActiveSheet()->getStyle($califacionPorCaetgoria[1][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));
                        
                            break;

                        
                        case $califacionPorCaetgoria[1][1]>=20 && $califacionPorCaetgoria[1][1]<30:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[1][0], 'Medio');
                            $objPHPExcel->getActiveSheet()->getStyle($califacionPorCaetgoria[1][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$color_amarillo) )));

                            break;

                        case $califacionPorCaetgoria[1][1]>=30 && $califacionPorCaetgoria[1][1]<40:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[1][0], 'Alto');
                            $objPHPExcel->getActiveSheet()->getStyle($califacionPorCaetgoria[1][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                            break;
                        case $califacionPorCaetgoria[1][1]>=40:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[1][0], 'Muy alto');
                            $objPHPExcel->getActiveSheet()->getStyle($califacionPorCaetgoria[1][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                            break;
                    }
                ///mensajes para factores de factores propios de la actividad

                
                ///mensajes para factores de organizacion del tiempo de trabajo
                    switch ($califacionPorCaetgoria[2][1]) {
                        case $califacionPorCaetgoria[2][1]<4:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Nulo o despreciable');
                            $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[2][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$color_azul) )));

                            break;
                        
                        case $califacionPorCaetgoria[2][1]>=4 && $califacionPorCaetgoria[2][1]<6:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Bajo');
                            $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[2][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));
                            break;

                        
                        case $califacionPorCaetgoria[2][1]>=6 && $califacionPorCaetgoria[2][1]<9:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Medio');
                            $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[2][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));
            
                            break;

                        case $califacionPorCaetgoria[2][1]>=9 && $califacionPorCaetgoria[2][1]<12:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Alto');
                            $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[2][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                            break;
                        case $califacionPorCaetgoria[2][1]>=12:
                            $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Muy alto');
                            $objPHPExcel->getActiveSheet()->getStyle($califacionPorCaetgoria[2][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                            break;
                    }
                ///mensajes para  de organizacion del tiempo de trabajo


                ///mensajes para factores de liderazgo
                switch ($califacionPorCaetgoria[3][1]) {
                    case $califacionPorCaetgoria[3][1]<10:
                        $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[3][0], 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[3][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                        break;
                    
                    case $califacionPorCaetgoria[3][1]>=10 && $califacionPorCaetgoria[3][1]<18:
                        $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[3][0], 'Bajo');
                        $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[3][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));
                break;

                    
                    case $califacionPorCaetgoria[3][1]>=18 && $califacionPorCaetgoria[3][1]<28:
                        $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[2][0], 'Medio');
                        $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[3][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));
                break;

                    case $califacionPorCaetgoria[3][1]>=28 && $califacionPorCaetgoria[3][1]<38:
                        $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[3][0], 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[3][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                        break;
                    case $califacionPorCaetgoria[3][1]>=38:
                        $objPHPExcel->getActiveSheet()->setCellValue( $califacionPorCaetgoria[3][0], 'Muy alto');
                                $objPHPExcel->getActiveSheet()->getStyle( $califacionPorCaetgoria[3][0])->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                        break;
                }
            ///mensaje de lidearazgo califacion

            ///mensaje del nivel de riesgo del dominio
                
                

                    switch ($cargaDeTrabajo) {
                        case $cargaDeTrabajo<12:
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                            break;

                        case $cargaDeTrabajo>=12 && $cargaDeTrabajo<16:
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                            break;
                        case $cargaDeTrabajo>=16 && $cargaDeTrabajo<20:
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                            break;
                        case $cargaDeTrabajo>=20 && $cargaDeTrabajo<24:
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                            break; 
                        case $cargaDeTrabajo>=25:
                            $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                            break;
                            
                        
                    
                    }


            switch ($sobreElcontrolDetrabajo) {
                case $sobreElcontrolDetrabajo<5:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                    break;

                case $sobreElcontrolDetrabajo>=5 && $sobreElcontrolDetrabajo<8:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $sobreElcontrolDetrabajo>=8 && $sobreElcontrolDetrabajo<11:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $sobreElcontrolDetrabajo>=11 && $sobreElcontrolDetrabajo<14:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $sobreElcontrolDetrabajo>=14:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }
            ////------------
            switch ($jornadaDeTrabajo) {
                case $jornadaDeTrabajo<1:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                    break;

                case $jornadaDeTrabajo>=1 && $jornadaDeTrabajo<2:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $jornadaDeTrabajo>=2 && $jornadaDeTrabajo<4:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $jornadaDeTrabajo>=4 && $jornadaDeTrabajo<6:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $jornadaDeTrabajo>=6:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }


            switch ($interferencialEnRelacionTrabajoFamilia) {
                case $interferencialEnRelacionTrabajoFamilia<1:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                    break;

                case $interferencialEnRelacionTrabajoFamilia>=1 && $interferencialEnRelacionTrabajoFamilia<2:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $interferencialEnRelacionTrabajoFamilia>=2 && $interferencialEnRelacionTrabajoFamilia<4:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $interferencialEnRelacionTrabajoFamilia>=4 && $interferencialEnRelacionTrabajoFamilia<6:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $interferencialEnRelacionTrabajoFamilia>=6:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }


            switch ($liderazgoDominio) {
                case $liderazgoDominio<3:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Nulo o despreciable');

                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));
                break;

                case $liderazgoDominio>=3 && $liderazgoDominio<5:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $liderazgoDominio>=5 && $liderazgoDominio<8 :
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $liderazgoDominio>=8 && $liderazgoDominio<11:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $liderazgoDominio>=11:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }







            switch ($relacionDelTrabajoDominio) {
                case $relacionDelTrabajoDominio<5:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));


                    break;

                case $relacionDelTrabajoDominio>=5 && $relacionDelTrabajoDominio<8:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $relacionDelTrabajoDominio>=8 && $relacionDelTrabajoDominio<11:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));


                    break;
                case $relacionDelTrabajoDominio>=11 && $relacionDelTrabajoDominio<14:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));


                    break; 
                case $relacionDelTrabajoDominio>=14:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }

            switch ($violenciaDelTrabajoDominio) {
                case $violenciaDelTrabajoDominio<7:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                    break;

                case $violenciaDelTrabajoDominio>=7 && $violenciaDelTrabajoDominio<10:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $violenciaDelTrabajoDominio>=10 && $violenciaDelTrabajoDominio<13:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $violenciaDelTrabajoDominio>=13 && $violenciaDelTrabajoDominio<16:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $violenciaDelTrabajoDominio>=16:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));

                    break;
                    
                
            
            }


            $califacionTotal=array_sum($sumaDeItemsDeAmbienteDeTrabajo)+array_sum($sumaFactoresPropiosDeLaActiviidad)+array_sum($sumaOrganizacionDelTiempoDeTrabajo)+array_sum($sumaLiderazgoRelacionesEnEltrabajo);
                $objPHPExcel->getActiveSheet()->setCellValue('C35',$califacionTotal);

            


            switch ($califacionTotal) {
                case $califacionTotal<20:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D35', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('D35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_azul) )));

                    break;

                case $califacionTotal>=20 && $califacionTotal<45:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D35', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('D35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_verde) )));

                    break;
                case $califacionTotal>=45 && $califacionTotal<70:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D35', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('D35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_amarillo) )));

                    break;
                case $califacionTotal>=70 && $califacionTotal<90:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D35', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_anaranjado) )));

                    break; 
                case $califacionTotal>=90:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D35', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $color_rojo) )));
                    break;            
            }
                //CALIFACION FLINALL   
                    //columa califacion DOMINIO//
                    //columna califacion de categoria
                    $objPHPExcel->getActiveSheet()->SetCellValue('C9',array_sum($sumaDeItemsDeAmbienteDeTrabajo));
                    $objPHPExcel->getActiveSheet()->SetCellValue('C13',array_sum($sumaFactoresPropiosDeLaActiviidad));
                    $objPHPExcel->getActiveSheet()->SetCellValue('C23',array_sum($sumaOrganizacionDelTiempoDeTrabajo));
                    $objPHPExcel->getActiveSheet()->SetCellValue('C27',array_sum($sumaLiderazgoRelacionesEnEltrabajo));


                    //columna califacion de categoria
                    
                    //COLUMNA DE ITEMS -----------------------FIN

                    $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
                    $answer=array();
                    $objWriter->save('reporte/reportecuestionariodos.xlsx');
                    $file='reportecuestionariodos.xlsx';
                    $response = new Response();
                    $path = 'reporte/'.$file;
                    $filetype = filetype($path);
                    $filesize = filesize($path);   
                    $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
                    $response->setHeader("Content-Description", 'File Download');
                    $response->setHeader("Content-Type", $filetype);
                    $response->setHeader("Content-Length", $filesize);
                    $response->setFileToSend($path, str_replace(" ","-",$file), true);
                    $response->send();
                    die();
                }

                public function respuestascuestionariotresvistaAction()
                {
                    $empresas = Empresa::query()
                    ->columns('emp_id,emp_nombre')
                    ->where("emp_estatus=2")
                    ->execute();
                    $folios = Folio::query()
                    ->columns([
                        'fol_id',
                        'CONCAT(fol_nombre, " ", fol_primerapellido, " ", fol_segundoapellido) AS fol_nombre'
                        ])
                        ->where("fol_estatus=2")
                        ->execute();
                    $this->view->empresas=$empresas;
                    $this->view->folios=$folios;

                }

                public function manejadorconsultacuestionario3Action()
                {
                    $this->view->disable();
                    $answer=array();
                    $condicion='';
                    $condicion.=  ( trim($condicion)=="" ?  'f.fol_estatus=2 and  Rescuetres.prt_id=1': ' AND f.fol_estatus=2 and  Rescuetres.prt_id=1');

                    
        
                    if($this->request->isAjax())
                    {
                        $data = $this->request->getPost();
                        $empresa_id= $data['emp_id'];
                        $answer["fol_id"]=$data['fol_id'];

                        if($this->numerovalidoInputValido($data['fol_id'])){
                            $condicion.=  ( trim($condicion)=="" ?  'f.fol_id='.$data['fol_id']: ' AND f.fol_id='.$data['fol_id']);
                        }
                        
                        if($empresa_id==='-1')
                        {
                            $total_de_encuestados=Rescuetres::query()
                            ->columns('count(f.fol_id) as total')
                            ->join('Folio','f.fol_id=Rescuetres.fot_id','f')
                            ->where($condicion)
                            ->execute();
                            if($total_de_encuestados[0]['total']>=1)
                            {
                            
                            $answer[0]=1;
                            $answer[1]=0;
                            return json_encode($answer);

                            }
                            if ($total_de_encuestados[0]['total']<=0) 
                            {
                                    $answer[0]=-1;
                                    $answer[0]=-1;
                                    return json_encode($answer);
                            } 


                            
                        }
                        else
                        {
                            $condicion.=  ( trim($condicion)=="" ?  'e.emp_id='.$empresa_id: ' AND e.emp_id='.$empresa_id);

                            $total_de_encuestados_de_x_empresa=Rescuetres::query()
                                ->columns('count(f.fol_id) as total')
                                ->join('Folio','f.fol_id=Rescuetres.fot_id','f')
                                ->join('Calificacion','c.cal_id=Rescuetres.cal_id','c')
                                ->join('Empresa','e.emp_id=f.emp_id','e')
                                ->where($condicion)
                                ->execute();
                                if($total_de_encuestados_de_x_empresa[0]['total']>=1)
                                {
                                
                                    $answer[0]=1;
                                    $answer[1]=$empresa_id;
                                    return json_encode($answer);
                                    
                                }
                                if ($total_de_encuestados_de_x_empresa[0]['total']<=0) 
                                {
                                    $answer[0]=-1;
                                    return json_encode($answer);
                                } 

                        }
                    

                    
                    }

    }
     
    

    public function respuestascuestionariotresAction($emp_id,$fol_id=0)
    {

        // $answer["fol_id"]=$fol_id;

        $this->view->disable();
   
   
            //VARIABLES GLOBALES DE LA FUNCION
                    //Color de semaforo
                    $COLOR_VERDE='6FFF00';
                    $COLOR_AZUL='00C4FF';
                    $COLOR_AMARILLO='FFF700';
                    $COLOR_ANARANJADO='FABF33';
                    $COLOR_ROJO='FF1A00';

        $LISTA_CALIFACION_FINAL=
        [
            'nulo_despreciable'=>[50],
            'bajo'=>[50,75],
            'medio'=>[75,99],
            'alto'=>[99,140],
            'muy_alto'=>[140]
        ];

           $LISTA_DE_CALIFICACIONES_DE_CATEGORIA=
            [
                'AmbienteDeTrabajo'=>
                [  
                'nulo_despreciable'=>[5],
                'bajo'=>[5,9],
                'medio'=>[9,11],
                'alto'=>[11,14],
                'muy_alto'=>[14]
                ]
                ,
                'FactoresPropiosDeLaActividad'=>
                [
                    'nulo_despreciable'=>[15],
                    'bajo'=>[15,30],
                    'medio'=>[30,45],
                    'alto'=>[45,60],
                    'muy_alto'=>[60],
                ],
                'OrganizacionDelTiempoDeTrabajo'=>
                [
                    'nulo_despreciable'=>[5],
                    'bajo'=>[5,7],
                    'medio'=>[7,10],
                    'alto'=>[10,13],
                    'muy_alto'=>[13]
                ],
                'LiderazgoYRelacionesEnElTrabajo'=>
                [
                    'nulo_despreciable'=>[14],
                    'bajo'=>[14,29],
                    'medio'=>[29,42],
                    'alto'=>[42,58],
                    'muy_alto'=>[58]
                ],
                'EntornoOrganizacional'=>
                [
                    'nulo_despreciable'=>[10],
                    'bajo'=>[10,14],
                    'medio'=>[14,18],
                    'alto'=>[18,23],
                    'muy_alto'=>[23]
                ],
            ];

            $LISTA_DE_CALIFICACIONES_DE_DOMINIO=
            [
                'CondicionesEnElAmbienteDeTrabajo'=>
                [
                    'nulo_despreciable'=>[5],
                    'bajo'=>[5,9],
                    'medio'=>[9,11],
                    'alto'=>[11,14],
                    'muy_alto'=>[14]
                ],
                'CargaDeTrabajo'=>
                [
                    'nulo_despreciable'=>[15],
                    'bajo'=>[15,21],
                    'medio'=>[21,27],
                    'alto'=>[27,37],
                    'muy_alto'=>[37]
                ],
                'FaltaDeControlSobreElTrabajo'=>
                [
                    'nulo_despreciable'=>[11],
                    'bajo'=>[11,16],
                    'medio'=>[16,21],
                    'alto'=>[21,25],
                    'muy_alto'=>[25]
                ],
                'JornandDeTrabajo'=>
                [
                    'nulo_despreciable'=>[1],
                    'bajo'=>[1,2],
                    'medio'=>[2,4],
                    'alto'=>[4,6],
                    'muy_alto'=>[6]
                ],
                'InterferenciaEnLaRelacionDeTrabajoFamilia'=>
                [
                    'nulo_despreciable'=>[4],
                    'bajo'=>[4,6],
                    'medio'=>[6,8],
                    'alto'=>[8,10],
                    'muy_alto'=>[10]
                ],
                'Liderazgo'=>
                [
                    'nulo_despreciable'=>[9],
                    'bajo'=>[9,12],
                    'medio'=>[12,16],
                    'alto'=>[16,20],
                    'muy_alto'=>[20]
                ],
                'RelacionesEnElTrabajo'=>
                [
                    'nulo_despreciable'=>[10],
                    'bajo'=>[10,13],
                    'medio'=>[13,17],
                    'alto'=>[17,21],
                    'muy_alto'=>[21]
                ],
                'Violencia'=>
                [
                    'nulo_despreciable'=>[7],
                    'bajo'=>[7,10],
                    'medio'=>[10,13],
                    'alto'=>[13,16],
                    'muy_alto'=>[16],
                ],
                'ReconocimientoDelDesempeno'=>
                [
                    'nulo_despreciable'=>[6],
                    'bajo'=>[6,10],
                    'medio'=>[10,14],
                    'alto'=>[14,18],
                    'muy_alto'=>[18],
                ],
                'InsuficienteSentidoDePertencia'=>
                [
                    'nulo_despreciable'=>[4],
                    'bajo'=>[4,6],
                    'medio'=>[6,8],
                    'alto'=>[8,10],
                    'muy_alto'=>[10],
                ],

            ];


            //variables para el llenado de excel inicio 
            $letras=["B","C","D",'E',"F","G","H","I","J","K"];
            $RangoDeCeldasConBorde=['B9:D11','B13:D21','B23:D25','B27:D31','E9:G11','E13:G21','E23:G25','E27:G31','H9:K11','H13:K21','H23:K25','H27:K31','B33:K36','B40:D40' ];
            $encabezadosDeLaTabla=["Categoria","Calificación","Nivel de riesgo",'Dominio','Calificación','Nivel de riesgo','Dimensión','Item','Participación en el dominio','Suma de items'];
            

            
            
            //variables para el llenado de excel fin 
            $contenidoDeLaColumnaItems=[
                ['I9', '1,3'],
                ['I10', '2,4'],
                ['I11', '5'],
                ['I13', '6,12'],
                ['I14', '7,8'],
                ['I15', '8,19,11'],
                ['I16', '65,66,67,68'],
                ['I17', '13,14'],
                ['I18', '15,16'],
                ['I19', '25,26,27,28'],
                ['I20', '23,24'],
                ['I21', '35,36'],
                ['I23', '17,18'],
                ['I24', '19,20'],
                ['I25', '21,22'],
                ['I27', '31,32,33,34'],
                ['I28', '37,38,39,40,41'],
                ['I29', '42,43,44,45,46'],
                ['I30', '69,70,71,72'],
                ['I31', '57,58,59,60,61,62,63,64'],
                ['I33', '47,48'],
                ['I34', '49,50,51,52'],   
                ['I35', '55,56'],   
                ['I36', '53,54'],   

            ];

            $contenidoDeLaColumnaCategoria=
            [
                ['B9', 'Ambiente de trabajo'],
                ['B13', 'Factores propios de la actividad'],
                ['B23', 'Organización del tiempo de trabajo '],
                ['B27', 'Liderazgo y relaciones en el trabajo'],
                ['B33', 'Entorno organizacional'],
                ['B40', 'Calificación final del cuestionario'],
              
              
            ];
            $numeroDeFilasParaLlenar=
            [
                '9', 
                '10',
                '11',
                '13', 
                '14', 
                '15', 
                '16', 
                '17', 
                '18',
                '19', 
                '20', 
                '21', 
                '23', 
                '24', 
                '25',
                '27',
                '28', 
                '29', 
                '30', 
                '31',
                '33',
                '34',  
                '35',   
                '36', 

            ];

            $contenidoDeLaColumnaDimension=[
                ['H9','Condiciones peligrosas e inseguras'],
                ['H10','Condiciones deficientes e insalubres'],
                ['H11','Trabajos peligrosos'],
                ['H13','Cargas cuantitativas'],
                ['H14','Ritmos de trabajo acelerado'],
                ['H15','Carga mental'],
                ['H16','Cargas psicológicas emocionales'],
                ['H17','Cargas de alta responsabilidad'],
                ['H18','Cargas contradictorias o inconsistentes'],
                ['H19','Falta de control y autonomía sobre el trabajo'],
                ['H20','Limitada o nula posibilidad de desarrollo'],
                ['H21','Limitada o inexistente capacitación'],
                ['H23','Jornadas de trabajo extensas'],
                ['H24','Influencia del trabajo fuera del centro laboral'],
                ['H25','Influencia de las responsabilidades familiares '],
                ['H27','Escasa claridad de funciones'],
                ['H28','Características del liderazgo'],
                ['H29','Relaciones sociales en el trabajo'],
                ['H30','Deficiente relación con los colaboradores que supervisa'],
                ['H31','Violencia laboral'],
                ['H33','Escasa o nula retroalimentación del desempeño '],
                ['H34','Escaso o nulo reconocimiento y compensación'],
                ['H35','Limitado sentido de pertenencia'],
                ['H36','Limitado sentido de pertenencia'],
            ];
           

            $CeldasQueSeVanUnir=[
                'B9:B11',
                'B13:B21',
                'B23:B25',
                'B27:B31',
                'E9:E11',
                'E13:E18',
                'E19:E21',
                'E24:E25',
                'E27:E28',
                'E29:E30',
                'C9:C11',
                'C13:C21',
                'C23:C25',
                'C27:C31',
                'D9:D11',
                'D13:D21',
                'D23:D25',
                'D27:D31',
                'G9:G11',
                'G13:G18',
                'G19:G21',
                'G24:G25',
                'G27:G28',
                'F9:F11',
                'G29:G30',
                'F13:F18',
                'F19:F21',
                'F24:F25',
                'F27:F28',
                'F29:F30',
                'B33:B36',
                'C33:C36',
                'D33:D36',
                'E33:E34',
                'E35:E36',
                'F33:F34',
                'F35:F36',
                'G33:G34',
                'G35:G36',    
            ];


            $contenidoDeLaColumnaDominio=[
                ['E9', 'Condiciones en el ambiente de trabajo'],
                ['E13', 'Carga de trabajo'],
                ['E19', 'Falta de control sobre el trabajo'],
                ['E23', 'Jornada de trabajo'],
                ['E24', 'Interferencia en la relación trabajo-familia'],
                ['E27', 'Liderazgo'],
                ['E29', 'Relaciones en el trabajo '],
                ['E31', 'Violencia'],
                ['E31', 'Violencia'],
                ['E33', 'Reconocimiento del desempeño'],
                ['E35', 'Insuficiente sentido de pertenencia e inestabilidad'],
            ];

            $CeldaTitulo=['D2','Calificaciones obtenidas.'];


        ///estilos inicio
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '001219'),
                ),
            ),
        );
        $styleArrayInsideBorder = array(
            'borders' => array(
                'inside' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '001219'),
                ),
            ),
        );
        $styleAlignment = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );
        //FIN VARIABLES GLOBALES FIN                

        //EXCEL GEENERACION INICIO
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Reporte de cuestionario dos")
        ->setSubject("Reporte de cuestionario dos")
        ->setDescription("Reporte de cuestionario dos")
        ->setKeywords("Reporte de cuestionario dos")
        ->setCategory("Reporte de cuestionario doss");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);


        $objPHPExcel->getActiveSheet()->getStyle('K9:K36')->getNumberFormat()->setFormatCode('0.00');
        $objPHPExcel->getActiveSheet()->getStyle('F9:F36')->getNumberFormat()->setFormatCode('0.00'); 
        $objPHPExcel->getActiveSheet()->getStyle('C9:F40')->getNumberFormat()->setFormatCode('0.00'); 
      
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Total de encuestas');

              //FORMATO Y DISEñO DE LA HOJA DE EXCEL INCIO 
            $objPHPExcel->getActiveSheet()->getStyle("B9:B37")->applyFromArray($styleAlignment);
            $objPHPExcel->getActiveSheet()->getStyle("E9:E31")->applyFromArray($styleAlignment);
            

        
            $objPHPExcel->getActiveSheet()->getStyle($CeldaTitulo[0])->getFont()->setSize(16);
            $objPHPExcel->getActiveSheet()->SetCellValue($CeldaTitulo[0],$CeldaTitulo[1]);
            $letras2=["B","C","D",'A',"F","G","H","I","J","K"];


            for ($i=0; $i <count($letras) ; $i++) 
            { 
                $objPHPExcel->getActiveSheet()->getColumnDimension($letras2[$i])->setAutoSize(true);
                //formateamos todos los titulares en bold
                $objPHPExcel->getActiveSheet()->getStyle("$letras[$i]"."8")->getFont()->setBold( true );
                $objPHPExcel->getActiveSheet()->SetCellValue("$letras[$i]"."8","$encabezadosDeLaTabla[$i]");
            }    

            //aplicando border
            for($i=0;$i<count($RangoDeCeldasConBorde);$i++)
            {
                $objPHPExcel->getActiveSheet()->getStyle($RangoDeCeldasConBorde[$i])->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle($RangoDeCeldasConBorde[$i])->applyFromArray($styleArrayInsideBorder);
            }
            
            //aplicando uniendo de celdas
            for ($i=0; $i <count($CeldasQueSeVanUnir) ; $i++) { 
                    $objPHPExcel->getActiveSheet()->mergeCells($CeldasQueSeVanUnir[$i]);
            }

            //FORMATO Y DISEñO DE LA HOJA DE EXCEL fin---------------------------------------------------------------------------       


            //LLENADO DE LA HOJA EXCEL INICIO 
            for($i=0;$i<count($contenidoDeLaColumnaItems);$i++)
            {
                $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaItems[$i][0], $contenidoDeLaColumnaItems[$i][1]);
    
            }
            for($i=0;$i<count($contenidoDeLaColumnaCategoria);$i++)
            {
                $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaCategoria[$i][0], $contenidoDeLaColumnaCategoria[$i][1]);
            }
    
          
            //COLUMNA DOMINIO  INICIO
            for($i=0;$i<count($contenidoDeLaColumnaDominio);$i++)
            {
                $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaDominio[$i][0], $contenidoDeLaColumnaDominio[$i][1]);
            }

            //COLUMNA DIMENSION 
            for($i=0;$i<count($contenidoDeLaColumnaDimension);$i++)
            {
                $objPHPExcel->getActiveSheet()->SetCellValue($contenidoDeLaColumnaDimension[$i][0], $contenidoDeLaColumnaDimension[$i][1]);
         
            }
        

            /////////CONSULTA Y LLENADO DE DATOS
         


                 $columns='sum(c.cal_valor) as total';
               
                
                $lista_de_num_items_de_preguntas=[
                    [1,3],
                    [2,4],
                    [5],
                    [6,12],
                    [7,8],
                    [8,19,11],
                    [65,66,67,68],
                    [13,14],
                    [15,16],
                    [25,26,27,28],
                    [23,24],
                    [35,36],
                    [17,18],
                    [19,20],
                    [21,22],
                    [31,32,33,34],
                    [37,38,39,40,41],
                    [42,43,44,45,46],
                    [69,70,71,72],
                    [57,58,59,60,61,62,63,64],
                    [47,48],
                    [49,50,51,52],
                    [55,56],
                    [53,54],
                ];

     

            $lista_de_resultado_de_suma_de_items=[];
            
            $condicionGeneralDinamica="";

            $codicionNumeroEncuestasContestadas=" Folio.fol_estatus=2 AND prt_id=1";
            $condicion_rescuetres = ' Folio.fol_estatus=2 AND Rescuetres.prt_id=#prt_id#';

            if($emp_id>=1) {
                $condicionGeneralDinamica.=  ( trim($condicionGeneralDinamica)!="" ?  ' AND Folio.emp_id='.$emp_id.' ': '  Folio.emp_id='.$emp_id.' ');
            }
            if($fol_id>=1) {
                $condicionGeneralDinamica.=  ( trim($condicionGeneralDinamica)!="" ?  ' AND Folio.fol_id='.$fol_id.' ': '  Folio.fol_id='.$fol_id.' ');
            }
            $condicion_rescuetres=$this->agregarAndONoSQL($condicionGeneralDinamica).$condicion_rescuetres;
            $codicionNumeroEncuestasContestadas=$this->agregarAndONoSQL($condicionGeneralDinamica).$codicionNumeroEncuestasContestadas;

            // echo $condicion_rescuetres;
            // echo "<br>";
            // echo $codicionNumeroEncuestasContestadas;
            // die();

            $NumeroDeEncuestasContestadas=count(
                Folio::query()->columns('fol_id')
                ->where($codicionNumeroEncuestasContestadas)
                ->join('Rescuetres','r.fot_id=Folio.fol_id','r')
                ->execute()
            ); 
           
            $objPHPExcel->getActiveSheet()->SetCellValue('B5','EMPRESA');

            if(empty($emp_id))
            {
                $objPHPExcel->getActiveSheet()->SetCellValue('C5','TODAS');
            }
            else
            {
                $nombre_empresa=Empresa::query()
                ->columns('emp_nombre as nombre')
                ->where('emp_id='.$emp_id)
                ->execute();
                $objPHPExcel->getActiveSheet()->SetCellValue('C5',$nombre_empresa[0]['nombre']);
            }

           

                // $NumeroDeEncuestasContestadas=count(Folio::query()
                // ->columns('fol_id')
                // ->join('Rescuetres','r.fot_id=Folio.fol_id','r')
                // ->join('Empresa','e.emp_id=Folio.emp_id','e')
                // ->where($codicionNumeroEncuestasContestadas)
                // ->execute());
                $objPHPExcel->getActiveSheet()->SetCellValue('C6', $NumeroDeEncuestasContestadas);
             
                for ($i=0; $i <count($lista_de_num_items_de_preguntas) ; $i++) { 
                    $suma=0;
                  for ($j=0; $j <count($lista_de_num_items_de_preguntas[$i]) ; $j++) { 
                       $prt_id=$lista_de_num_items_de_preguntas[$i][$j];
                       $condicion_rescuetres_dinamica = str_replace('#prt_id#', $prt_id, $condicion_rescuetres);
                            $valor=Rescuetres::query()
                            ->columns($columns)
                            ->join('Folio','Folio.fol_id=Rescuetres.fot_id')
                            ->join('Calificacion','c.cal_id=Rescuetres.cal_id','c')
                           # ->join('Empresa','e.emp_id='.$emp_id.'','e')
                            ->where($condicion_rescuetres_dinamica)
                            ->execute();             
                           $suma+=$valor[0]['total'];
                  }
                  $promedio_suma_de_items=$suma/$NumeroDeEncuestasContestadas;
                  array_push($lista_de_resultado_de_suma_de_items,$promedio_suma_de_items); 
                }

                     

            

            $dominio_califacion_condiciones_ambiente_laboral=0;
            for ($i=0; $i<=2; $i++) { 
                $dominio_califacion_condiciones_ambiente_laboral+=$lista_de_resultado_de_suma_de_items[$i];
            }

        
            $dominio_califacion_carga_trabajo=0;
            for ($i=3; $i<=8; $i++) { 
                $dominio_califacion_carga_trabajo+=$lista_de_resultado_de_suma_de_items[$i];
            }

          
            $dominio_calificacion_falta_control_treabajo=0;
            for ($i=9; $i<=11; $i++) { 
                $dominio_calificacion_falta_control_treabajo+=$lista_de_resultado_de_suma_de_items[$i];
            }

            $dominio_califacion_jornada_trabajo=$lista_de_resultado_de_suma_de_items[12];
         
            $dominio_inferencia_relacion_trabajo_familia=$lista_de_resultado_de_suma_de_items[13]+$lista_de_resultado_de_suma_de_items[14];
           
            $dominio_califacion_liderezgo=$lista_de_resultado_de_suma_de_items[15]+$lista_de_resultado_de_suma_de_items[16];  
          
            $dominio_califacion_relacion_en_trabajo=$lista_de_resultado_de_suma_de_items[17]+$lista_de_resultado_de_suma_de_items[18];
          
            $dominio_califacion_violencia=$lista_de_resultado_de_suma_de_items[19];

          
            $doominio_califacion_reconocimiento_desempeno=$lista_de_resultado_de_suma_de_items[20]+$lista_de_resultado_de_suma_de_items[21];
           
            $dominio_califacion_insuficiente_sentido_pertenencia=$lista_de_resultado_de_suma_de_items[22]+$lista_de_resultado_de_suma_de_items[23];


            //columna  califacion dominio 
            $objPHPExcel->getActiveSheet()->SetCellValue('F9', $dominio_califacion_condiciones_ambiente_laboral);
            $objPHPExcel->getActiveSheet()->SetCellValue('F13', $dominio_califacion_carga_trabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F19', $dominio_calificacion_falta_control_treabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F23', $dominio_califacion_jornada_trabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F24', $dominio_inferencia_relacion_trabajo_familia);
            $objPHPExcel->getActiveSheet()->SetCellValue('F27', $dominio_califacion_liderezgo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F29', $dominio_califacion_relacion_en_trabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('F31', $dominio_califacion_violencia);
            $objPHPExcel->getActiveSheet()->SetCellValue('F33', $doominio_califacion_reconocimiento_desempeno);
            $objPHPExcel->getActiveSheet()->SetCellValue('F35', $dominio_califacion_insuficiente_sentido_pertenencia);

            //columna  califacion categoria 
            $categoria_calificacion_factores_propios_actviidad=$dominio_califacion_carga_trabajo+$dominio_calificacion_falta_control_treabajo;
            $categoria_calificacion_organizacion_trabajo=$dominio_califacion_jornada_trabajo+$dominio_inferencia_relacion_trabajo_familia;
            $categoria_calificacion_liderazgo_relaciones_trabajo=$dominio_califacion_liderezgo+$dominio_califacion_relacion_en_trabajo+$dominio_califacion_violencia;
            $categoria_calificacion_entorno_orgnizacional=$doominio_califacion_reconocimiento_desempeno+$dominio_califacion_insuficiente_sentido_pertenencia;
            $objPHPExcel->getActiveSheet()->SetCellValue('C9', $dominio_califacion_condiciones_ambiente_laboral);
            $objPHPExcel->getActiveSheet()->SetCellValue('C13', $categoria_calificacion_factores_propios_actviidad);
            $objPHPExcel->getActiveSheet()->SetCellValue('C23', $categoria_calificacion_organizacion_trabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('C27', $categoria_calificacion_liderazgo_relaciones_trabajo);
            $objPHPExcel->getActiveSheet()->SetCellValue('C33', $categoria_calificacion_entorno_orgnizacional);


            $calificaion_final_cuestionario=$dominio_califacion_condiciones_ambiente_laboral+
                                            $categoria_calificacion_factores_propios_actviidad+$categoria_calificacion_organizacion_trabajo+
                                            $categoria_calificacion_liderazgo_relaciones_trabajo+
                                            $categoria_calificacion_entorno_orgnizacional;
            
           $objPHPExcel->getActiveSheet()->SetCellValue('C40', $calificaion_final_cuestionario);

            for($i=0;$i<count($lista_de_resultado_de_suma_de_items);$i++)
            {

                
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$numeroDeFilasParaLlenar[$i], $lista_de_resultado_de_suma_de_items[$i]);
        
            }

            //columna participancion de de dominio 
            for ($i=0; $i<=2; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_califacion_condiciones_ambiente_laboral,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);

            } 
            for ($i=3; $i<=8; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_califacion_carga_trabajo,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }
            for ($i=9; $i<=11; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_calificacion_falta_control_treabajo,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }


            $participacionDominioJornadaDeTrabajo=number_format(($lista_de_resultado_de_suma_de_items[12]*100)/$dominio_califacion_jornada_trabajo,2).'%';
            $objPHPExcel->getActiveSheet()->SetCellValue('J23', $participacionDominioJornadaDeTrabajo);

            for ($i=13; $i<=14; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_inferencia_relacion_trabajo_familia,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }

            //liderazgo
            for ($i=15; $i<=16; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_califacion_liderezgo,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }
            for ($i=17; $i<=18; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_califacion_relacion_en_trabajo,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }

            $participacionDominioViolencia=number_format(($lista_de_resultado_de_suma_de_items[19]*100)/$dominio_califacion_violencia,2).'%';
            $objPHPExcel->getActiveSheet()->SetCellValue('J31', $participacionDominioViolencia);
          
            for ($i=20; $i<=21; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$doominio_califacion_reconocimiento_desempeno,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }
            for ($i=22; $i<=23; $i++) { 
                $participacionDominio=number_format(($lista_de_resultado_de_suma_de_items[$i]*100)/$dominio_califacion_insuficiente_sentido_pertenencia,2).'%';
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$numeroDeFilasParaLlenar[$i], $participacionDominio);
            }
        



            ///mensaje de  califacion  CATEGORIA INCIO 

            
            switch ($calificaion_final_cuestionario) {
                case $calificaion_final_cuestionario<$LISTA_CALIFACION_FINAL['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D40', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('D40')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
            
                    break;
            
                case $calificaion_final_cuestionario>=$LISTA_CALIFACION_FINAL['bajo'][0] &&  $calificaion_final_cuestionario<$LISTA_CALIFACION_FINAL['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D40', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('D40')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_VERDE) )));
            
                    break;
                case $calificaion_final_cuestionario>=$LISTA_CALIFACION_FINAL['medio'][0] &&   $calificaion_final_cuestionario < $LISTA_CALIFACION_FINAL['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D40', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('D40')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
            
                    break;
                case $calificaion_final_cuestionario>=$LISTA_CALIFACION_FINAL['alto'][0] &&  $calificaion_final_cuestionario < $LISTA_CALIFACION_FINAL['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D40', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D40')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
            
                    break; 
                case $calificaion_final_cuestionario>=$LISTA_CALIFACION_FINAL['muy_alto'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D40', 'Muy alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D40')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ROJO) )));
                    break;

                default:
                $objPHPExcel->getActiveSheet()->setCellValue('D40', '');
                break;
                
               
            }

            // error_log($calificaion_final_cuestionario."/"."s".$LISTA_CALIFACION_FINAL['muy_alto'][0]);





            switch ($dominio_califacion_condiciones_ambiente_laboral) {
                case $dominio_califacion_condiciones_ambiente_laboral<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D9', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
                    $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_califacion_condiciones_ambiente_laboral>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['bajo'][0] && $dominio_califacion_condiciones_ambiente_laboral<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D9', 'Bajo');
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Bajo');
                             $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_VERDE) )));
                             $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_condiciones_ambiente_laboral>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['medio'][0] && $dominio_califacion_condiciones_ambiente_laboral<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D9', 'Medio');
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_AMARILLO) ))); 
                    $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_condiciones_ambiente_laboral>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['alto'][0] && $dominio_califacion_condiciones_ambiente_laboral<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D9', 'Alto');
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
                    $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_condiciones_ambiente_laboral>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['AmbienteDeTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'D9', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->setCellValue( 'G9', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
                     $objPHPExcel->getActiveSheet()->getStyle('D9')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }



            switch ($categoria_calificacion_factores_propios_actviidad) {
                case $categoria_calificacion_factores_propios_actviidad<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D13', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('D13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $categoria_calificacion_factores_propios_actviidad>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['bajo'][0] && $categoria_calificacion_factores_propios_actviidad<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D13', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('D13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $categoria_calificacion_factores_propios_actviidad>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['medio'][0] && $categoria_calificacion_factores_propios_actviidad<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D13', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('D13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $categoria_calificacion_factores_propios_actviidad>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['alto'][0] && $categoria_calificacion_factores_propios_actviidad<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D13', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $categoria_calificacion_factores_propios_actviidad>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['FactoresPropiosDeLaActividad']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'D13', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('D13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }


            switch ($categoria_calificacion_organizacion_trabajo) {
                case $categoria_calificacion_organizacion_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D23', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('D23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
                    break;
                
                case $categoria_calificacion_organizacion_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['bajo'][0] && $categoria_calificacion_organizacion_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D23', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('D23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $categoria_calificacion_organizacion_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['medio'][0] && $categoria_calificacion_organizacion_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D23', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('D23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $categoria_calificacion_organizacion_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['alto'][0] && $categoria_calificacion_organizacion_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'D23', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('D23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $categoria_calificacion_organizacion_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['OrganizacionDelTiempoDeTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'D23', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('D23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }

            $celda_categoria_calificacion_liderazgo_relaciones_trabajo='D27';
            switch ($categoria_calificacion_liderazgo_relaciones_trabajo) {
                case $categoria_calificacion_liderazgo_relaciones_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue($celda_categoria_calificacion_liderazgo_relaciones_trabajo, 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle($celda_categoria_calificacion_liderazgo_relaciones_trabajo)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $categoria_calificacion_liderazgo_relaciones_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['bajo'][0] && $categoria_calificacion_liderazgo_relaciones_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue($celda_categoria_calificacion_liderazgo_relaciones_trabajo, 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle($celda_categoria_calificacion_liderazgo_relaciones_trabajo)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $categoria_calificacion_liderazgo_relaciones_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['medio'][0] && $categoria_calificacion_liderazgo_relaciones_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celda_categoria_calificacion_liderazgo_relaciones_trabajo, 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle($celda_categoria_calificacion_liderazgo_relaciones_trabajo)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $categoria_calificacion_liderazgo_relaciones_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['alto'][0] && $categoria_calificacion_liderazgo_relaciones_trabajo<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celda_categoria_calificacion_liderazgo_relaciones_trabajo, 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle($celda_categoria_calificacion_liderazgo_relaciones_trabajo)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $categoria_calificacion_liderazgo_relaciones_trabajo>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['LiderazgoYRelacionesEnElTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue($celda_categoria_calificacion_liderazgo_relaciones_trabajo, 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle($celda_categoria_calificacion_liderazgo_relaciones_trabajo)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }

            $celdad_entorno_organizacional_resultado='D33';
            switch ($categoria_calificacion_entorno_orgnizacional) {
                case $categoria_calificacion_entorno_orgnizacional<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celdad_entorno_organizacional_resultado, 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle($celdad_entorno_organizacional_resultado)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
                    break;
                
                case $categoria_calificacion_entorno_orgnizacional>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['bajo'][0] && $categoria_calificacion_entorno_orgnizacional<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celdad_entorno_organizacional_resultado, 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle($celdad_entorno_organizacional_resultado)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $categoria_calificacion_entorno_orgnizacional>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['medio'][0] && $categoria_calificacion_entorno_orgnizacional<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celdad_entorno_organizacional_resultado, 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle($celdad_entorno_organizacional_resultado)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $categoria_calificacion_entorno_orgnizacional>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['alto'][0] && $categoria_calificacion_entorno_orgnizacional<$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( $celdad_entorno_organizacional_resultado, 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle($celdad_entorno_organizacional_resultado)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $categoria_calificacion_entorno_orgnizacional>=$LISTA_DE_CALIFICACIONES_DE_CATEGORIA['EntornoOrganizacional']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( $celdad_entorno_organizacional_resultado, 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle($celdad_entorno_organizacional_resultado)->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }



            ///mensaje de  califacion  de CATEGORIA  FIN ----------------------


            ///mensaje de  califacion  de DOMINIO   INCIO 


            switch ($dominio_califacion_carga_trabajo) {
                case $dominio_califacion_carga_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
                    break;
                
                case $dominio_califacion_carga_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['bajo'][0] && $dominio_califacion_carga_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_carga_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['medio'][0] && $dominio_califacion_carga_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_carga_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['alto'][0] && $dominio_califacion_carga_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_carga_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['CargaDeTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G13', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G13')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }

            switch ($dominio_calificacion_falta_control_treabajo) {
                case $dominio_calificacion_falta_control_treabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_calificacion_falta_control_treabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['bajo'][0] && $dominio_calificacion_falta_control_treabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_calificacion_falta_control_treabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['medio'][0] && $dominio_calificacion_falta_control_treabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_calificacion_falta_control_treabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['alto'][0] && $dominio_calificacion_falta_control_treabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_calificacion_falta_control_treabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['FaltaDeControlSobreElTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G19', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G19')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }



            switch ($dominio_califacion_jornada_trabajo) {
                case $dominio_califacion_jornada_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_califacion_jornada_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['bajo'][0] && $dominio_califacion_jornada_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_jornada_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['medio'][0] && $dominio_califacion_jornada_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_jornada_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['alto'][0] && $dominio_califacion_jornada_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_jornada_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['JornandDeTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G23', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G23')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }
            switch ($dominio_inferencia_relacion_trabajo_familia) {
                case $dominio_inferencia_relacion_trabajo_familia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_inferencia_relacion_trabajo_familia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['bajo'][0] && $dominio_inferencia_relacion_trabajo_familia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_inferencia_relacion_trabajo_familia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['medio'][0] && $dominio_inferencia_relacion_trabajo_familia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_inferencia_relacion_trabajo_familia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['alto'][0] && $dominio_inferencia_relacion_trabajo_familia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_inferencia_relacion_trabajo_familia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InterferenciaEnLaRelacionDeTrabajoFamilia']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G24', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G24')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }

            



            switch ($dominio_califacion_liderezgo) {
                case $dominio_califacion_liderezgo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_califacion_liderezgo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['bajo'][0] && $dominio_califacion_liderezgo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_liderezgo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['medio'][0] && $dominio_califacion_liderezgo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_liderezgo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['alto'][0] && $dominio_califacion_liderezgo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_liderezgo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Liderazgo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G27', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G27')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }


            switch ($dominio_califacion_relacion_en_trabajo) {
                case $dominio_califacion_relacion_en_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
    
    
    
                    break;
                
                case $dominio_califacion_relacion_en_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['bajo'][0] && $dominio_califacion_relacion_en_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_relacion_en_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['medio'][0] && $dominio_califacion_relacion_en_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_relacion_en_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['alto'][0] && $dominio_califacion_relacion_en_trabajo<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_relacion_en_trabajo>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['RelacionesEnElTrabajo']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G29', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G29')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }

            switch ($dominio_califacion_violencia) {
                case $dominio_califacion_violencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
                    break;
                
                case $dominio_califacion_violencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['bajo'][0] && $dominio_califacion_violencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_violencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['medio'][0] && $dominio_califacion_violencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_violencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['alto'][0] && $dominio_califacion_violencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_violencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['Violencia']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G31', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G31')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }


            switch ($doominio_califacion_reconocimiento_desempeno) {
                case $doominio_califacion_reconocimiento_desempeno<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G33', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G33')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
                    break;
                
                case $doominio_califacion_reconocimiento_desempeno>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['bajo'][0] && $doominio_califacion_reconocimiento_desempeno<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G33', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G33')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $doominio_califacion_reconocimiento_desempeno>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['medio'][0] && $doominio_califacion_reconocimiento_desempeno<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G33', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G33')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $doominio_califacion_reconocimiento_desempeno>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['alto'][0] && $doominio_califacion_reconocimiento_desempeno<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G33', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G33')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $doominio_califacion_reconocimiento_desempeno>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['ReconocimientoDelDesempeno']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G33', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G33')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }



            
            switch ($dominio_califacion_insuficiente_sentido_pertenencia) {
                case $dominio_califacion_insuficiente_sentido_pertenencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['nulo_despreciable'][0]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G35', 'Nulo o despreciable');
                    $objPHPExcel->getActiveSheet()->getStyle('G35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AZUL) )));
                    break;
                
                case $dominio_califacion_insuficiente_sentido_pertenencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['bajo'][0] && $dominio_califacion_insuficiente_sentido_pertenencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['bajo'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G35', 'Bajo');
                    $objPHPExcel->getActiveSheet()->getStyle('G35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>    $COLOR_VERDE) )));
    
                    break;
    
                
                case $dominio_califacion_insuficiente_sentido_pertenencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['medio'][0] && $dominio_califacion_insuficiente_sentido_pertenencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['medio'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G35', 'Medio');
                    $objPHPExcel->getActiveSheet()->getStyle('G35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_AMARILLO) )));
    
    
                    break;
    
                case $dominio_califacion_insuficiente_sentido_pertenencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['alto'][0] && $dominio_califacion_insuficiente_sentido_pertenencia<$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['alto'][1]:
                    $objPHPExcel->getActiveSheet()->setCellValue( 'G35', 'Alto');
                    $objPHPExcel->getActiveSheet()->getStyle('G35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => $COLOR_ANARANJADO) )));
    
    
                    break;
                case $dominio_califacion_insuficiente_sentido_pertenencia>=$LISTA_DE_CALIFICACIONES_DE_DOMINIO['InsuficienteSentidoDePertencia']['muy_alto'][0]:
                      $objPHPExcel->getActiveSheet()->setCellValue( 'G35', 'Muy alto');
                     $objPHPExcel->getActiveSheet()->getStyle('G35')->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' =>$COLOR_ROJO) )));
    
    
                    break;
            }
            ///mensaje de  califacion  de DOMINIO   FIN ----------------------
            

            //LLENADO DE LA HOJA EXCEL FIN-------------------------------------------------------------------------------------------

        //EXCEL GEENERACION FIN

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/reportecuestionariotres.xlsx');

        $file='reportecuestionariotres.xlsx';
        $response = new Response();
        $path = 'reporte/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);   
        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();

    }

 
}




