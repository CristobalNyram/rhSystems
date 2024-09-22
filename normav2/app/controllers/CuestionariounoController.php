<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CuestionariounoController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cuestionariouno');
        parent::initialize();
    
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function formularioAction($id=0)
    {
        $cuestionarios= new Cueactivo();
        // $folio=$_GET['folio'];
        $folio = $this->request->getQuery('folio', 'int');
        if (!$folio) {
            $this->flash->error('No existe el folio');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }
        $folioBuscar = Folio::findFirstByfol_id($folio);
        // validaciones de busqueda ini
        if (!$folioBuscar) {
            $this->flash->error('No existe el folio');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }
        if ($folioBuscar->fol_estatus!=2) {
            $this->flash->error('No existe el folio -E');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }
        // validaciones de busqueda fin 
        
        $IdCuestionario=1;
        $EstadoCuestionario= $cuestionarios->estadoDeFormulario($folio,$IdCuestionario);
         if ( $EstadoCuestionario) {
               $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
         }
         else
         {
               $this->response->redirect('principal/index'); 
               $this->flash->warning('No esta disponible este cuestionario.');        
         }
         
    
    }

    public function guardarAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();

            $folioval=Folio::findFirstByfol_id($data['folio']);
            if($folioval){
            }
            else{
                $answer[0]=-1;
                $answer[1]='No existe el folio con el que intenta responder.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;
            }

            $foliocue=Foliocueuno::findFirstByfou_id($data['folio']);
            if($foliocue)
            {
                $answer[0]=-1;
                $answer[1]='Ya se respondio anteriormente la encuesta con ese folio.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;

            }

            $folio= new Foliocueuno();
            $folio->fou_id=$data['folio'];
            $folio->save();

            $id=$folio->fou_id;

            $calificacion= new Calificacion();
            

            // for ($i=1; $i <= 5 ; $i++) { 
            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['1']);
            $cuestionario->pru_id=1;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['2']);
            $cuestionario->pru_id=2;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['3']);
            $cuestionario->pru_id=3;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['4']);
            $cuestionario->pru_id=4;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['5']);
            $cuestionario->pru_id=5;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescueuno();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['6']);
            $cuestionario->pru_id=6;
            $cuestionario->fou_id=$id;
            $cuestionario->save();

            if($data['1']==1 || $data['2']==1 || $data['3']==1 || $data['4']==1 || $data['5']==1 || $data['6']==1){
                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['7']);
                $cuestionario->pru_id=7;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['8']);
                $cuestionario->pru_id=8;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['9']);
                $cuestionario->pru_id=9;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['10']);
                $cuestionario->pru_id=10;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['11']);
                $cuestionario->pru_id=11;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['12']);
                $cuestionario->pru_id=12;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['13']);
                $cuestionario->pru_id=13;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['14']);
                $cuestionario->pru_id=14;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['15']);
                $cuestionario->pru_id=15;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['16']);
                $cuestionario->pru_id=16;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['17']);
                $cuestionario->pru_id=17;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['18']);
                $cuestionario->pru_id=18;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['19']);
                $cuestionario->pru_id=19;
                $cuestionario->fou_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescueuno();
                $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['20']);
                $cuestionario->pru_id=20;
                $cuestionario->fou_id=$id;
                $cuestionario->save();
            }else{
                for ($i=7; $i <= 20 ; $i++) {
                    $cuestionario = new Rescueuno();
                    $cuestionario->cal_id=1;
                    $cuestionario->pru_id=$i;
                    $cuestionario->fou_id=$id;
                    $cuestionario->save();
                }
            }
            
                $answer[0]=1;
                $answer[2]=$id;
          
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function respuestaAction(){

        $ini=Folio::minimum(array("column" => "fol_id"));
        $fin=Folio::maximum(array("column" => "fol_id"));
        $this->view->disable();

        $letras=["C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ"];
        $posicion=2;

        $preguntas=Preguntacueuno::query()
        ->columns('pru_texto')
        // ->where($condicionendoso)
        // ->join('Endoso','e.end_id=Reciboendoso.end_id','e')
        // ->groupBy($group)
        ->execute();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Respuestas cuestionario uno")
        ->setSubject("Respuestas cuestionario uno")
        ->setDescription("Respuestas cuestionario uno")
        ->setKeywords("Respuestas cuestionario uno")
        ->setCategory("Respuestas cuestionario uno");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Folio');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nombre');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        for ($i=0; $i < 20; $i++) { 
            $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->pru_texto);
        }

        $folioinicial=$ini;
        $foliofinal=$fin;
        $condicion="f.fol_estatus=2 and fou_id>=".$folioinicial." and fou_id<=".$foliofinal;

        

        $folios=Foliocueuno::query()
            ->columns('fou_id ,emp_id')
            ->join('Folio','f.fol_id=Foliocueuno.fou_id','f')
            ->where($condicion)
            ->execute();


            


        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Nombre de empresa');
        $empresaslistado=Empresa::query()
        ->columns('emp_id ,emp_nombre')
        ->where('emp_estatus=2')
        ->execute();


        
        for ($i=0; $i < count($folios); $i++) {
            $respuesta=Rescueuno::query()
                ->columns('cal_texto, fou_id')
                ->where('fou_id='.$folios[$i]->fou_id)
                ->join('Calificacion','c.cal_id=Rescueuno.cal_id','c')
                ->orderBy('pru_id')
                ->execute();                   
                
      


                for ($j=0; $j < count($respuesta); $j++) {

                        $objPHPExcel->getActiveSheet()->SetCellValue("A".$posicion, $respuesta[$j]->fou_id);
                        $objPHPExcel->getActiveSheet()->SetCellValue($letras[$j].$posicion, $respuesta[$j]->cal_texto);
                    // }
                }


                for ($emp_index=0; $emp_index <count($empresaslistado) ; $emp_index++) { 
                    if($empresaslistado[$emp_index]->emp_id==$folios[$i]->emp_id)
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue("B".$posicion, $empresaslistado[$emp_index]->emp_nombre);

                    }
                    elseif($folios[$i]->emp_id=='')
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue("B".$posicion,'N/A');

                    }
                    

                }

              
                

                $posicion++;
            
        }

     
 



    
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/cuestionariouno.xlsx');

        $file='cuestionariouno.xlsx';
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

    public function revisarfolioAction($folio)
    {
        $answer=array();
        $this->view->disable();
        // if($this->request->isAjax()&&$folio>0)
        // {
            $folioval=Folio::findFirstByfol_id($folio);
            if($folioval)
            {
                $foliocue=Foliocueuno::findFirstByfou_id($folio);
                if($foliocue)
                {
                    $answer[0]=-1;
                    $answer[1]='Ya se respondio la encuesta con ese folio';
                }
                else
                {
                    $answer[0]=1;
                }

                
            }
            else
            {
                $answer[0]=-1;
                $answer[1]='No existe el folio';    
            }
            
        // }
        // else
        //     $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }
}