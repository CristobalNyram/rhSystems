<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CuestionariodosController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cuestionariodos');
        parent::initialize();
        // $this->view->gmenu=0;
        // $rol = new Rol();
        // $auth = $this->session->get('auth');
        // if(!$rol->verificar(8,$auth['rol_id'])) //el número en la funcion es el correspondiente a la bdd
        // {
        //     $this->flash->error("No cuenta con los permisos necesarios para acceder a esta característica.");
        //     $this->response->redirect('index/panel');
        //     $this->view->disable();
        //     return;   
        // }
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function formularioAction()
    {
    	$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function guardarAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $folio= new Foliocuedos();
            $folio->save();

            $id=$folio->fod_id;

            $calificacion= new Calificacion();
            $data = $this->request->getPost();

            // for ($i=1; $i <= 5 ; $i++) { 
            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['1']);
            $cuestionario->prd_id=1;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['2']);
            $cuestionario->prd_id=2;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['3']);
            $cuestionario->prd_id=3;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['4']);
            $cuestionario->prd_id=4;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['5']);
            $cuestionario->prd_id=5;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['6']);
            $cuestionario->prd_id=6;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['7']);
            $cuestionario->prd_id=7;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['8']);
            $cuestionario->prd_id=8;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['9']);
            $cuestionario->prd_id=9;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['10']);
            $cuestionario->prd_id=10;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['11']);
            $cuestionario->prd_id=11;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['12']);
            $cuestionario->prd_id=12;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['13']);
            $cuestionario->prd_id=13;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['14']);
            $cuestionario->prd_id=14;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['15']);
            $cuestionario->prd_id=15;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['16']);
            $cuestionario->prd_id=16;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['17']);
            $cuestionario->prd_id=17;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['18']);
            $cuestionario->prd_id=18;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['19']);
            $cuestionario->prd_id=19;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['20']);
            $cuestionario->prd_id=20;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['21']);
            $cuestionario->prd_id=21;
            $cuestionario->fod_id=$id;
            $cuestionario->save();
            
            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['22']);
            $cuestionario->prd_id=22;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['23']);
            $cuestionario->prd_id=23;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['24']);
            $cuestionario->prd_id=24;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['25']);
            $cuestionario->prd_id=25;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['26']);
            $cuestionario->prd_id=26;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['27']);
            $cuestionario->prd_id=27;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['28']);
            $cuestionario->prd_id=28;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['29']);
            $cuestionario->prd_id=29;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['30']);
            $cuestionario->prd_id=30;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['31']);
            $cuestionario->prd_id=31;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['32']);
            $cuestionario->prd_id=32;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['33']);
            $cuestionario->prd_id=33;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['34']);
            $cuestionario->prd_id=34;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['35']);
            $cuestionario->prd_id=35;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['36']);
            $cuestionario->prd_id=36;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['37']);
            $cuestionario->prd_id=37;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['38']);
            $cuestionario->prd_id=38;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['39']);
            $cuestionario->prd_id=39;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['40']);
            $cuestionario->prd_id=40;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['clientes']);
            $cuestionario->prd_id=47;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            if($data['clientes']==1){
                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['41']);
                $cuestionario->prd_id=41;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['42']);
                $cuestionario->prd_id=42;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['43']);
                $cuestionario->prd_id=43;
                $cuestionario->fod_id=$id;
                $cuestionario->save();
            }else{
                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=41;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=42;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=43;
                $cuestionario->fod_id=$id;
                $cuestionario->save();
            }
            
            $cuestionario = new Rescuedos();
            $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['trabajadores']);
            $cuestionario->prd_id=48;
            $cuestionario->fod_id=$id;
            $cuestionario->save();

            if($data['trabajadores']==1){
                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['44']);
                $cuestionario->prd_id=44;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['45']);
                $cuestionario->prd_id=45;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['46']);
                $cuestionario->prd_id=46;
                $cuestionario->fod_id=$id;
                $cuestionario->save();
            }else{
                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=44;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=45;
                $cuestionario->fod_id=$id;
                $cuestionario->save();

                $cuestionario = new Rescuedos();
                $cuestionario->cal_id=1;
                $cuestionario->prd_id=46;
                $cuestionario->fod_id=$id;
                $cuestionario->save();
            }
            
         
            $answer[0]=1;
            $answer[2]=$id;
            
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
    }

    public function respuestaAction($ini,$fin){
        $this->view->disable();

        $letras=["C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ"];
        $posicion=2;

        $preguntas=Preguntacuedos::query()
        ->columns('prd_texto')
        ->orderBy('prd_orden')
        // ->where($condicionendoso)
        // ->join('Endoso','e.end_id=Reciboendoso.end_id','e')
        // ->groupBy($group)
        ->execute();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Respuestas cuestionario dos")
        ->setSubject("Respuestas cuestionario dos")
        ->setDescription("Respuestas cuestionario dos")
        ->setKeywords("Respuestas cuestionario dos")
        ->setCategory("Respuestas cuestionario dos");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Folio');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nombre');
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        for ($i=0; $i < 48; $i++) { 
            $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->prd_texto);
        }

        $folioinicial=$ini;
        $foliofinal=$fin;
        $condicion="fod_id>=".$folioinicial." and fod_id<=".$foliofinal;

        

        $folios=Foliocuedos::query()
            ->columns('fod_id')
            ->where($condicion)
            ->execute();
        
        for ($i=0; $i < count($folios); $i++) {
            $respuesta=Rescuedos::query()
                ->columns('cal_texto')
                ->where('fod_id='.$folios[$i]->fod_id)
                // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
                ->join('Calificacion','c.cal_id=Rescuedos.cal_id','c')
                // ->orderBy('prd_id')
                ->execute();

                for ($j=0; $j < count($respuesta); $j++) {
                    $objPHPExcel->getActiveSheet()->SetCellValue($letras[$j].$posicion, $respuesta[$j]->cal_texto);
                }
                $posicion++;
            
        }
        
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/cuestionariodos.xlsx');

        $file='cuestionariodos.xlsx';
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

    public function reporteAction($ini,$fin){
        $this->view->disable();

        $letras=["C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ"];
        $posicion=2;

        // $preguntas=Preguntacuedos::query()
        // ->columns('prd_texto')
        // ->orderBy('prd_orden')
        // // ->where($condicionendoso)
        // // ->join('Endoso','e.end_id=Reciboendoso.end_id','e')
        // // ->groupBy($group)
        // ->execute();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Respuestas cuestionario dos")
        ->setSubject("Respuestas cuestionario dos")
        ->setDescription("Respuestas cuestionario dos")
        ->setKeywords("Respuestas cuestionario dos")
        ->setCategory("Respuestas cuestionario dos");  
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Categoría');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Calificación');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Nivel de riesgo');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Dominio');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Calificación');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Nivel de riesgo');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Dimensión');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Item');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Participación en el dominio');
        // $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Dimensión');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

        // for ($i=0; $i < 48; $i++) { 
        //     $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->prd_texto);
        // }

        $folioinicial=$ini;
        $foliofinal=$fin;
        $condicion="fod_id>=".$folioinicial." and fod_id<=".$foliofinal;

        

        $folios=Foliocuedos::query()
            ->columns('fod_id')
            ->where($condicion)
            ->execute();
        
        for ($i=0; $i < count($folios); $i++) {
            $respuesta=Rescuedos::query()
                ->columns('cal_texto')
                ->where('fod_id='.$folios[$i]->fod_id)
                // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
                ->join('Calificacion','c.cal_id=Rescuedos.cal_id','c')
                // ->orderBy('prd_id')
                ->execute();

                for ($j=0; $j < count($respuesta); $j++) {
                    $objPHPExcel->getActiveSheet()->SetCellValue($letras[$j].$posicion, $respuesta[$j]->cal_texto);
                }
                $posicion++;
            
        }
        
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/cuestionariodos.xlsx');

        $file='cuestionariodos.xlsx';
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