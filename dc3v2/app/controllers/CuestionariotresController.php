<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CuestionariotresController extends ControllerBase
{
      public function initialize()
      {
            $this->tag->setTitle('Cuestionariotres');
            parent::initialize();

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
                  $folio= new Foliocuetres();
                  $folio->save();

                  $id=$folio->fot_id;

                  $calificacion= new Calificacion();
                  $data = $this->request->getPost();

                        
                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['1']);
                  $cuestionario->prt_id=1;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['2']);
                  $cuestionario->prt_id=2;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['3']);
                  $cuestionario->prt_id=3;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['4']);
                  $cuestionario->prt_id=4;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['5']);
                  $cuestionario->prt_id=5;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['6']);
                  $cuestionario->prt_id=6;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['7']);
                  $cuestionario->prt_id=7;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['8']);
                  $cuestionario->prt_id=8;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['9']);
                  $cuestionario->prt_id=9;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['10']);
                  $cuestionario->prt_id=10;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['11']);
                  $cuestionario->prt_id=11;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['12']);
                  $cuestionario->prt_id=12;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['13']);
                  $cuestionario->prt_id=13;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['14']);
                  $cuestionario->prt_id=14;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['15']);
                  $cuestionario->prt_id=15;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['16']);
                  $cuestionario->prt_id=16;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['17']);
                  $cuestionario->prt_id=17;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['18']);
                  $cuestionario->prt_id=18;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['19']);
                  $cuestionario->prt_id=19;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['20']);
                  $cuestionario->prt_id=20;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['21']);
                  $cuestionario->prt_id=21;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['22']);
                  $cuestionario->prt_id=22;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['23']);
                  $cuestionario->prt_id=23;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['24']);
                  $cuestionario->prt_id=24;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['25']);
                  $cuestionario->prt_id=25;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['26']);
                  $cuestionario->prt_id=26;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['27']);
                  $cuestionario->prt_id=27;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['28']);
                  $cuestionario->prt_id=28;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['29']);
                  $cuestionario->prt_id=29;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['30']);
                  $cuestionario->prt_id=30;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['31']);
                  $cuestionario->prt_id=31;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['32']);
                  $cuestionario->prt_id=32;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['33']);
                  $cuestionario->prt_id=33;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['34']);
                  $cuestionario->prt_id=34;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['35']);
                  $cuestionario->prt_id=35;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['36']);
                  $cuestionario->prt_id=36;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['37']);
                  $cuestionario->prt_id=37;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['38']);
                  $cuestionario->prt_id=38;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['39']);
                  $cuestionario->prt_id=39;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['40']);
                  $cuestionario->prt_id=40;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['41']);
                  $cuestionario->prt_id=41;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['42']);
                  $cuestionario->prt_id=42;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['43']);
                  $cuestionario->prt_id=43;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['44']);
                  $cuestionario->prt_id=44;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['45']);
                  $cuestionario->prt_id=45;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['46']);
                  $cuestionario->prt_id=46;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['47']);
                  $cuestionario->prt_id=47;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['48']);
                  $cuestionario->prt_id=48;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['49']);
                  $cuestionario->prt_id=49;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['50']);
                  $cuestionario->prt_id=50;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['51']);
                  $cuestionario->prt_id=51;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['52']);
                  $cuestionario->prt_id=52;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['53']);
                  $cuestionario->prt_id=53;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['54']);
                  $cuestionario->prt_id=54;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['55']);
                  $cuestionario->prt_id=55;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['56']);
                  $cuestionario->prt_id=56;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(2,$data['57']);
                  $cuestionario->prt_id=57;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['58']);
                  $cuestionario->prt_id=58;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['59']);
                  $cuestionario->prt_id=59;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['60']);
                  $cuestionario->prt_id=60;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['61']);
                  $cuestionario->prt_id=61;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['62']);
                  $cuestionario->prt_id=62;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['63']);
                  $cuestionario->prt_id=63;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['64']);
                  $cuestionario->prt_id=64;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['clientes']);
                  $cuestionario->prt_id=73;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  if($data['clientes']==1){
                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['65']);
                        $cuestionario->prt_id=65;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['66']);
                        $cuestionario->prt_id=66;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['67']);
                        $cuestionario->prt_id=67;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['68']);
                        $cuestionario->prt_id=68;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();
                  }else{
                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=65;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=66;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=67;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=68;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();
                  }

                  $cuestionario = new Rescuetres();
                  $cuestionario->cal_id=$calificacion->getCalificacion(1,$data['trabajadores']);
                  $cuestionario->prt_id=74;
                  $cuestionario->fot_id=$id;
                  $cuestionario->save();

                  if($data['trabajadores']==1){
                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['69']);
                        $cuestionario->prt_id=69;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['70']);
                        $cuestionario->prt_id=70;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['71']);
                        $cuestionario->prt_id=71;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=$calificacion->getCalificacion(3,$data['72']);
                        $cuestionario->prt_id=72;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();
                  }else{
                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=69;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=70;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=71;
                        $cuestionario->fot_id=$id;
                        $cuestionario->save();

                        $cuestionario = new Rescuetres();
                        $cuestionario->cal_id=1;
                        $cuestionario->prt_id=72;
                        $cuestionario->fot_id=$id;
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

            $letras=["C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];
            $posicion=2;

            $preguntas=Preguntacuetres::query()
            ->columns('prt_texto')
            ->orderBy('prt_orden')
            // ->where($condicionendoso)
            // ->join('Endoso','e.end_id=Reciboendoso.end_id','e')
            // ->groupBy($group)
            ->execute();

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()
            ->setCreator("SIPS")
            ->setLastModifiedBy("SIPS")
            ->setTitle("Respuestas cuestionario tres")
            ->setSubject("Respuestas cuestionario tres")
            ->setDescription("Respuestas cuestionario tres")
            ->setKeywords("Respuestas cuestionario tres")
            ->setCategory("Respuestas cuestionario tres");  
            $objPHPExcel->setActiveSheetIndex(0); 
            $objPHPExcel->createSheet();
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Folio');
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Nombre');
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

            for ($i=0; $i < 74; $i++) { 
                  $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->prt_texto);
            }

            $folioinicial=$ini;
            $foliofinal=$fin;
            $condicion="fot_id>=".$folioinicial." and fot_id<=".$foliofinal;

            $folios=Foliocuetres::query()
                  ->columns('fot_id')
                  ->where($condicion)
                  ->execute();
        
            for ($i=0; $i < count($folios); $i++) {
                  $respuesta=Rescuetres::query()
                  ->columns('cal_texto')
                  ->where('fot_id='.$folios[$i]->fot_id)
                  // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
                  ->join('Calificacion','c.cal_id=Rescuetres.cal_id','c')
                  // ->orderBy('prd_id')
                  ->execute();

                  for ($j=0; $j < count($respuesta); $j++) {
                        $objPHPExcel->getActiveSheet()->SetCellValue($letras[$j].$posicion, $respuesta[$j]->cal_texto);
                  }
                  $posicion++;
            }
        
            $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
            $answer=array();
            $objWriter->save('reporte/cuestionariotres.xlsx');

            $file='cuestionariotres.xlsx';
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