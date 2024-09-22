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
            $folio= new Foliocueuno();
            $folio->save();

            $id=$folio->fou_id;

            $calificacion= new Calificacion();
            $data = $this->request->getPost();

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
            

            
            // }
            // $cuestionario = new Rescueuno();
            // $cuestionario->cal_id=1;
            // $cuestionario->pru_id=1;
            // $part= Participante::findFirstBypar_id($data['par_idasig']);
            // $part->emp_id= $data['emp_idasignar'];
            // if($data['cen_idasignar']!=0){
            //     $part->cen_id= $data['cen_idasignar'];
            //     $centro= Centrotrabajo::findFirstBycen_id($data['cen_idasignar']);
            //     $part->rep_idlegal=$centro->rep_idlegal;
            //     $part->rep_idtra=$centro->rep_idtra;
            // }
            // if($cuestionario->save())
            // {
                $answer[0]=1;
                $answer[2]=$id;
            // }
            // else
                // $answer[0]=0;
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
        $condicion="fou_id>=".$folioinicial." and fou_id<=".$foliofinal;

        

        $folios=Foliocueuno::query()
            ->columns('fou_id')
            ->where($condicion)
            ->execute();
        
        for ($i=0; $i < count($folios); $i++) {
            $respuesta=Rescueuno::query()
                ->columns('cal_texto')
                ->where('fou_id='.$folios[$i]->fou_id)
                // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
                ->join('Calificacion','c.cal_id=Rescueuno.cal_id','c')
                ->orderBy('pru_id')
                ->execute();

                for ($j=0; $j < count($respuesta); $j++) {
                    // for ($k=0; $k < 20; $k++) { 
                        $objPHPExcel->getActiveSheet()->SetCellValue($letras[$j].$posicion, $respuesta[$j]->cal_texto);
                    // }
                    // $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $respuesta[$i]->pru_texto);
                }
                $posicion++;
            
        }
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Curso');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Empresa');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Fecha inicial');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Fecha final');
        // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
        // array(
        //     'font' => array(
        //         'bold' => true,
        //         'size' => 9
        //         )
        //     )
        // );
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
}