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

    public function unsolofolionuevo()
    {
    }

	public function tablafolioAction(){
	
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $folio = Folio::query()
            ->columns('fol_id,fol_matricula,fol_nombre,fol_primerapellido,
                    fol_segundoapellido,fol_correo,fol_area,fol_puesto,
                    emp.emp_nombre,Folio.emp_id, Folio.fol_partactualizo
                    ')
            ->leftjoin('Empresa','emp.emp_id=Folio.emp_id','emp')
            ->where("fol_estatus=2")
            ->execute();
       

        $this->empresa = new Empresa();
        
        $this->view->empresa= $this->empresa;
        
        $this->foliouno = new Foliocueuno();
        $this->foliodos = new Foliocuedos();
        $this->foliotres = new Foliocuetres();
        $this->folioclima= new Foliocueclima();
        $this->view->page=$folio;
        $this->view->foliouno = $this->foliouno;
        $this->view->foliodos = $this->foliodos;
        $this->view->foliotres = $this->foliotres;
        $this->view->folioclima= $this->folioclima;
        //estado de los cuestionario,activo o no activo
        $cuestionario= new Cueactivo();
        $cue= $cuestionario->EstadoCuestionario();
        $this->view->cuestionario=$cue;
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


                $allowedExtensions = array("xlsx", "xls", "xlsm", "xlsb", "xltx", "xlt", "xltm", "xlam", "csv");
                $extension = pathinfo($upload->getName(), PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    $this->flash->error("Por favor, seleccione un archivo de Excel válido.");
                    $this->response->redirect('cuestionario/activarfolio/');
                    $this->view->disable();
                    return;
                }

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
                        if(trim($data['fol_matricula'])!= '')
                        {
                            $existe=Folio::findFirstByfol_matricula($data["fol_matricula"]);
                        }

                        if($existe){
                            $res=1;
                            $data['fol_matricula']=null;
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
                            $data['fol_correo']= !empty($sheet->getCell("E".$row)->getValue()) ? $this->upper(trim($sheet->getCell("E".$row)->getValue()) ) : ' ';
                        
                            $empresaObject = new Empresa();
                            
                            if(!empty($sheet->getCell("F".$row)->getValue()))
                            {
                                $empresaGet=strtoupper($sheet->getCell("F".$row)->getValue());
                             
                                if($empresaObject->findFirstByemp_nombre($empresaGet))
                                {
                                    $empresa = $empresaObject->findFirstByemp_nombre($empresaGet);
                                    if ($empresa) {
                                        $data['emp_id'] = $empresa->emp_id;
                                    } else {
                                        $data['emp_id'] = '';
                                    }
                
                                }
                                else
                                {
                                    $data['emp_id']='';
                                }                                

                            }
                            else
                            {
                                $data['emp_id']='';

                            }
                            $data['fol_area']= !empty($sheet->getCell("G".$row)->getValue()) ? $this->upper(trim($sheet->getCell("G".$row)->getValue())) : ' ';
                            $data['fol_puesto']= !empty($sheet->getCell("H".$row)->getValue()) ? $this->upper(trim($sheet->getCell("H".$row)->getValue())) : ' ';


                
                            $res=$folio->NuevoRegistro($data,$auth['id']);
                   
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

    public function enviarcorreoAction()
    {
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $data = $this->request->getPost();
        
        $arreglo=json_encode($data);
        $json=json_decode($arreglo,true);
        $cont= count($json['arreglo']);
        $valor=json_encode($json['arreglo'][0]['valor']);
        $entero=json_decode($valor);
        $var = $cont;
        
        $enviados=0;
        for($i=1;$i<=$var;$i++){
            $valor=json_encode($json['arreglo'][$i-1]['valor']);
            $entero=json_decode($valor);

            $foliodata = Folio::findFirstByfol_id($entero);
            if (filter_var($foliodata->fol_correo, FILTER_VALIDATE_EMAIL)) {
                $correo= new ServicioCorreo();
                $enviado=0;
                if($enviado==0){
                    if($correo->enviarinvitacion($foliodata->fol_id, $foliodata->fol_correo, $foliodata->fol_nombre)==1){
                        $enviado++;
                        $enviados++;
                    }
                }
            }
        }

        $answer[0]=1;
        $answer[1]=$enviados;
        $this->response->setJsonContent($answer);
        $this->response->send(); 
        return;
    }

    public function validarcorreoAction($entero){
        $this->view->disable();
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $foliodata = Folio::findFirstByfol_id($entero);
            if (filter_var($foliodata->fol_correo, FILTER_VALIDATE_EMAIL)) {
                $correo= new ServicioCorreo();
                $enviado=0;
                if($enviado==0){
                    if($correo->enviarinvitacion($foliodata->fol_id, $foliodata->fol_correo, $foliodata->fol_nombre)==1){
                        $enviado++;
                        $enviados++;
                    }
                }
            }
        return;
    }

}