<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CuestionarioController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Cuestionario');
        parent::initialize();
        
    }

    public function indexAction(){

    }

    public function activarfolioAction(){

    }

	public function tablafolioAction(){
		$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function folionuevoAction()
    {
        if($this->request->isPost())
        {
            $data = $this->request->getPost();
            if($this->request->hasFiles() == true){
                $uploads = $this->request->getUploadedFiles();
                $isUploaded = false;
                $date= new DateTime();
                $upload=$uploads[0];

                $a=''.$date->format('Y-m-d-H-i-s').'-'.strtolower($upload->getname());
                #do a loop to handle each file individually
                // foreach($uploads as $upload){

                #define a “unique” name and a path to where our file must go
                $path = 'cuestionario/'.$a;
                $data = $this->request->getPost();            
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
                #if any file couldn’t be moved, then throw an message
                if($isUploaded){
                    // require_once 'PHPExcel/Classes/PHPExcel.php';
                    $archivo = $path;
                    $inputFileType = PHPExcel_IOFactory::identify($archivo);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($archivo);
                    $sheet = $objPHPExcel->getSheet(0); 
                    $highestRow = $sheet->getHighestRow(); 
                    $highestColumn = $sheet->getHighestColumn();
                    $curpvaciaidtra=0;
                    $auth = $this->session->get('auth');
                    for ($row = 2; $row <= $highestRow; $row++){ 
                        $existe=false;
                        $data['fol_matricula']= !empty($sheet->getCell("A".$row)->getValue()) ? trim($sheet->getCell("A".$row)->getValue()) : ' ';
                        // $data['tra_curp']= $sheet->getCell("A".$row)->getValue();
                        if($data['fol_matricula']!= ' ')
                        {
                            $existe=Folio::findFirstByfol_matricula($data["fol_matricula"]);
                        }
                        if($existe){
                            $res=1;
                        }
                        else{
                            //si el trabajador no existe
                            $folio= new Folio();


                            // A==5 ? dispara(): espera();
                            // $data['tra_nombre']= $sheet->getCell("B".$row)->getValue()!=null ? trim($sheet->getCell("B".$row)->getValue()) : '';
                            $data['fol_nombre']= $this->upper(trim($sheet->getCell("B".$row)->getValue()));
                            $data['fol_primerapellido'] = $this->upper(trim($sheet->getCell("C".$row)->getValue()));
                            // $data['tra_segundoapellido']= trim($sheet->getCell("D".$row)->getValue());
                            $data['fol_segundoapellido']= !empty($sheet->getCell("D".$row)->getValue()) ? $this->upper(trim($sheet->getCell("D".$row)->getValue())) : ' ';

                            
                            // $data['tra_puesto']= $sheet->getCell("E".$row)->getValue();
                            //busqueda de ocupación de acuerdo a clave de excel
                            
                            // $data['emp_id']=$data['id_emp'];
                            // echo "<br>";

                            $res=$folio->NuevoRegistro($data,$auth['id']);
                            // $curpvaciaidtra=$res;
                        }
                        if($res>0){
                            
                        }
                    }
                }
                $this->flash->success("Datos guardados correctamente");
                $this->response->redirect('cuestionario/activarfolio/');
                $this->view->disable();
                return;
            }
        }
    }
}