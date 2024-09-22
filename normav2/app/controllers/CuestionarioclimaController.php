<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class CuestionarioclimaController extends ControllerBase
{
    public function initialize()
    {
    $configuracion=new Configuracion();
    $estatusLogoConfiguracion=$configuracion->estatusConfiguracionAnuncio(5);
    $logo_actual=$estatusLogoConfiguracion['con_texto'];
    $this->view->logoactual=$logo_actual;
        $this->tag->setTitle('Cuestionario clima laboral');
        parent::initialize();
       
    }


    //con esta funcion mostramos el formulario
    public function formularioAction()
    {
        
    
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

        $cuestionarios= new Cueactivo();
        $IdCuestionario=4;
        $EstadoCuestionario= $cuestionarios->estadoDeFormulario($folio,$IdCuestionario);
         if ( $EstadoCuestionario==1) {
               $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
         }
         else
         {
            $this->response->redirect('principal/index'); 
            $this->flash->warning('No esta disponible este cuestionario.'); 
            $this->view->disable();             
         }
    
    }


    public function guardarAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        // return 'si estas conectado';

        if ($this->request->isAjax()) 
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

                    $foliocue=Foliocueclima::findFirstByfolcucli_id($data['folio']);
                    if($foliocue)
                     {
                          $answer[0]=-1;
                          $answer[1]='Ya se respondio anteriormente la encuesta con ese folio. ';
                          $this->response->setJsonContent($answer);
                          $this->response->send(); 
                        
                        return;
                  
                      }
                      else 
                      {
                          
                        $folio= new Foliocueclima();
                        $folio->folcucli_id=$data['folio'];
                        $folio->save();
                      
                        $id=$folio->folcucli_id;

                        $calificacion= new Calificacion();

                        $cuestionario = new Rescueclima();
                        //                    accedemos al modeleo cuestionario...mandamos la opcion y la respusta seleccionada
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['1']);

                        //guardamos el numero de pregunta---esta llave primaria corresponde a la llave primaria de preguntacueclima 
                        $cuestionario->precucli_id=1; //precucli_id=preguntas cuestionario clima id   
                       
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde

                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['2']);
                        $cuestionario->precucli_id=2; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['3']);
                        $cuestionario->precucli_id=3; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['4']);
                        $cuestionario->precucli_id=4; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['5']);
                        $cuestionario->precucli_id=5; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['6']);
                        $cuestionario->precucli_id=6; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();


                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['7']);
                        $cuestionario->precucli_id=7; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['8']);
                        $cuestionario->precucli_id=8; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['9']);
                        $cuestionario->precucli_id=9; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['10']);
                        $cuestionario->precucli_id=10; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['11']);
                        $cuestionario->precucli_id=11; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['12']);
                        $cuestionario->precucli_id=12; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['13']);
                        $cuestionario->precucli_id=13; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['14']);
                        $cuestionario->precucli_id=14; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['15']);
                        $cuestionario->precucli_id=15; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['16']);
                        $cuestionario->precucli_id=16; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['17']);
                        $cuestionario->precucli_id=17; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['18']);
                        $cuestionario->precucli_id=18; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['19']);
                        $cuestionario->precucli_id=19; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['20']);
                        $cuestionario->precucli_id=20; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();
                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['21']);
                        $cuestionario->precucli_id=21; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['22']);
                        $cuestionario->precucli_id=22; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['23']);
                        $cuestionario->precucli_id=23; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['24']);
                        $cuestionario->precucli_id=24; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['25']);
                        $cuestionario->precucli_id=25; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();


                        if($data['25']<=3)
                        {
                            
                            $cuestionario = new Rescueclima();
                            $cuestionario->cal_id=$calificacion->getCalificacion(7,3);
                            $cuestionario->precucli_id=26; //precucli_id=preguntas cuestionario clima id                          
                            $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                            $cuestionario->save();

                            $comentario = new Commentcue();
                            $comentario->com_texto=$data['26'];
                            $comentario->recli_id= $cuestionario->recli_id;
                            $comentario->save();
                          

                            
                            
                            
                           
                            
                        }
                            
                     

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['27']);
                        $cuestionario->precucli_id=27; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['28']);
                        $cuestionario->precucli_id=28; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['29']);
                        $cuestionario->precucli_id=29; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['30']);
                        $cuestionario->precucli_id=30; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['31']);
                        $cuestionario->precucli_id=31; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['32']);
                        $cuestionario->precucli_id=32; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['33']);
                        $cuestionario->precucli_id=33; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['34']);
                        $cuestionario->precucli_id=34; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['35']);
                        $cuestionario->precucli_id=35; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['36']);
                        $cuestionario->precucli_id=36; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['37']);
                        $cuestionario->precucli_id=37; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['38']);
                        $cuestionario->precucli_id=38; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['39']);
                        $cuestionario->precucli_id=39; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['40']);
                        $cuestionario->precucli_id=40; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['41']);
                        $cuestionario->precucli_id=41; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['42']);
                        $cuestionario->precucli_id=42; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['43']);
                        $cuestionario->precucli_id=43; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['44']);
                        $cuestionario->precucli_id=44; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['45']);
                        $cuestionario->precucli_id=45; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['46']);
                        $cuestionario->precucli_id=46; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['47']);
                        $cuestionario->precucli_id=47; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['48']);
                        $cuestionario->precucli_id=48; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['49']);
                        $cuestionario->precucli_id=49; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['50']);
                        $cuestionario->precucli_id=50; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['51']);
                        $cuestionario->precucli_id=51; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['52']);
                        $cuestionario->precucli_id=52; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        /*
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['53']);
                        $cuestionario->precucli_id=53; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();
                        */
                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(7,2);
                        $cuestionario->precucli_id=53; //precucli_id=preguntas cuestionario clima id   
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        
                        $cuestionario->save();
                        //comenatario
                        $comentario = new Commentcue();
                        $comentario->com_texto=$data['53'];
                        $comentario->recli_id= $cuestionario->recli_id;
                        $comentario->save();
                        



                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['54']);
                        $cuestionario->precucli_id=54; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['55']);
                        $cuestionario->precucli_id=55; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['56']);
                        $cuestionario->precucli_id=56; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['57']);
                        $cuestionario->precucli_id=57; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['58']);
                        $cuestionario->precucli_id=58; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(4,$data['59']);
                        $cuestionario->precucli_id=59; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(5,$data['60']);
                        $cuestionario->precucli_id=60; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        
                        $cuestionario = new Rescueclima();
                        $cuestionario->cal_id=$calificacion->getCalificacion(6,$data['61']);
                        $cuestionario->precucli_id=61; //precucli_id=preguntas cuestionario clima id                          
                        $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                        $cuestionario->save();

                        if(!empty($data['62']))
                        {
                            $cuestionario = new Rescueclima();
                            $cuestionario->cal_id=$calificacion->getCalificacion(7,1);
                            $cuestionario->precucli_id=62; //precucli_id=preguntas cuestionario clima id                          
                            $cuestionario->focli_id=$id;//focli_id= folio cuestionario clima...con esto indicamos al folio que corresponde
                            $cuestionario->save();

                            $comentario = new Commentcue();
                            $comentario->com_texto=$data['62'];
                            $comentario->recli_id= $cuestionario->recli_id;
                            $comentario->save();
                            
                            
                        }


                        $answer[0]=1;
                        $answer[2]=$id;
                      
                      }
                    
                      


                      
                      
            
        }   
        else
        {
            return 'no es un AJAX'; 

        }
    
    }


    public function respuestaAction(){

        $ini=Folio::minimum(array("column" => "fol_id"));
        $fin=Folio::maximum(array("column" => "fol_id"));
        $this->view->disable();

        $letras=["B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];
        // $letrasOpcion2=["AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];
        $letras2=["B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BC","BD","BE","BF","BG","BH","BI","BJ","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];

        $posicion=2;

        $preguntas=Preguntacueclima::query()
        ->columns('pregclima_texto')
        ->orderBy('pregclima_orden')
        ->execute();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Respuestas cuestionario clima")
        ->setSubject("Respuestas cuestionario clima")
        ->setDescription("Respuestas cuestionario clima")
        ->setKeywords("Respuestas cuestionario clima")
        ->setCategory("Respuestas cuestionario clima");  
        
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Folio');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

        for ($i=0; $i < 62; $i++) { 
            $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->pregclima_texto);
        }

        $folioinicial=$ini;
        $foliofinal=$fin;
        $condicion="folcucli_id>=".$folioinicial." and folcucli_id<=".$foliofinal;

        $folios=Foliocueclima::query()
        ->columns('folcucli_id,emp_id')
        ->join('Folio','f.fol_id=Foliocueclima.folcucli_id','f')
        ->where($condicion)
        ->execute();

        $empresaslistado=Empresa::query()
        ->columns('emp_id ,emp_nombre')
        ->where('emp_estatus=2')
        ->execute();

        for ($i=0; $i < count($folios); $i++) 
        {
            $respuesta=Rescueclima::query()
            ->columns('c.cal_id,cal_texto, focli_id, recli_id,precucli_id')
            ->where('precucli_id<>26 and precucli_id<>53 and precucli_id<>62 and focli_id='.$folios[$i]->folcucli_id)
            // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
            ->join('Calificacion','c.cal_id=Rescueclima.cal_id','c')
            // ->orderBy('prd_id')
            ->execute();
  
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$posicion, $respuesta[0]->focli_id);
            // Lllenamos todas las preguntas estaticas
            for ($j=0; $j<=58; $j++) 
            {
                //llenamos la columna de folios
                
                    // $objPHPExcel->getActiveSheet()->SetCellValue("BB".$posicion, $respuesta53[0]->com_texto);
                                    
                $objPHPExcel->getActiveSheet()->SetCellValue($letras2[$j].$posicion, $respuesta[$j]->cal_texto);   
                
                if($respuesta[$j]->precucli_id==25)
                {
                    //evaluacion relacionada a si es que se reciven respuestas negativas
                    if($respuesta[$j]->cal_id==16 || $respuesta[$j]->cal_id==17 || $respuesta[$j]->cal_id==18 )
                    {
                                    
                        $condicionpreguntaComentarioAbierto26="focli_id=".$folios[$i]->folcucli_id." and precucli_id=26";
                        //extrajendo comentatios del inciso 53
                        $respuesta26=Rescueclima::query()
                        ->columns('com_texto,focli_id,precucli_id')
                        ->where($condicionpreguntaComentarioAbierto26)
                        // ->join('Foliocueuno','f.fou_id=Rescueuno.fou_id','f')
                        ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                        // ->orderBy('prd_id')
                        ->execute();

                        $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$posicion,$respuesta26[0]->com_texto);
                    }
                    else
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$posicion, 'N/A');   
                    }
                    
                    // $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$posicion,$respuesta[$j]->cal_id);                   
                }

                if($respuesta[$j]->precucli_id==52)
                {
                    $condicionpreguntaComentarioAbierto53="focli_id=".$folios[$i]->folcucli_id." and precucli_id=53";
                    //extrajendo comentatios del inciso 53
                    $respuesta53=Rescueclima::query()
                    ->columns('com_texto,focli_id,precucli_id')
                    ->where($condicionpreguntaComentarioAbierto53)
                    ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                    ->execute();

                    $objPHPExcel->getActiveSheet()->SetCellValue('BB'.$posicion,$respuesta53[0]->com_texto);   
                  
                }

                if($respuesta[$j]->precucli_id==61)
                {
                    $condicionpreguntaComentarioAbierto62="focli_id=".$folios[$i]->folcucli_id." and precucli_id=62";
                    //extrajendo comentatios del inciso 63
                    $respuesta62=Rescueclima::query()
                    ->columns('com_texto,focli_id,precucli_id')
                    ->where($condicionpreguntaComentarioAbierto62)
                    ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                    ->execute();
                    
                    if(count($respuesta62)>0)
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('BK'.$posicion,$respuesta62[0]->com_texto);   

                    }
                    else
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('BK'.$posicion,'No dejaron comentario.');
                    }
                }
            }
            //CONTROL Y LLAVE QUE CIIERA PARA COMENTAR
            for ($emp_index=0; $emp_index <count($empresaslistado) ; $emp_index++) { 
                if($empresaslistado[$emp_index]->emp_id==$folios[$i]->emp_id)
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue("B".$posicion, $empresaslistado[$emp_index]->emp_nombre);
                    
                    continue;

                }
                elseif($folios[$i]->emp_id=='')
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue("B".$posicion,'N/A');

                }
         

            }

            
            
            $posicion++;
            // die();
        }

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/cuestionarioclima.xlsx');

        $file='cuestionarioclima.xlsx';
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


    public function formatoAction(){

        $ini=Folio::minimum(array("column" => "fol_id"));
        $fin=Folio::maximum(array("column" => "fol_id"));
        $this->view->disable();

        $letras=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];
        // $letrasOpcion2=["AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];
        $letras2=["B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BC","BD","BE","BF","BG","BH","BI","BJ","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"];

        $posicion=2;

        // $preguntas=Preguntacueclima::query()
        // ->columns('pregclima_texto')
        // ->orderBy('pregclima_orden')
        // ->execute();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
        ->setCreator("SIPS")
        ->setLastModifiedBy("SIPS")
        ->setTitle("Respuestas cuestionario clima")
        ->setSubject("Respuestas cuestionario clima")
        ->setDescription("Respuestas cuestionario clima")
        ->setKeywords("Respuestas cuestionario clima")
        ->setCategory("Respuestas cuestionario clima");  
        
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->createSheet();

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'CONTROL');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', '#PERSONA');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Comunicación');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DIMENSIÓN');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'DESCRIPCIÓN DIMENSIÓN');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SATISFACCIÓN');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Área funcional');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Antigüedad');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'COMENTARIO ABIERTO (agrupar por categoria)');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Empresa');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A:J')->setAutoSize(true);

        // for ($i=0; $i < 62; $i++) { 
        //     $objPHPExcel->getActiveSheet()->SetCellValue($letras[$i].'1', $preguntas[$i]->pregclima_texto);
        // }

        $folioinicial=$ini;
        $foliofinal=$fin;
        $condicion="focli_id>1 and precucli_id<>26 and precucli_id<>53 and precucli_id<>60 and precucli_id<>61 and precucli_id<>62";

        $resp=Rescueclima::query()
        ->columns('recli_id, p.pregclima_orden, Rescueclima.focli_id, pregclima_dimension, pregclima_texto, cal_ponderacion, fol_puesto, cal_texto, emp_nombre')
        ->where($condicion)
        ->join('Calificacion','c.cal_id=Rescueclima.cal_id','c')
        ->join('Preguntacueclima','p.pregclima_id=Rescueclima.precucli_id','p')
        ->join('Folio','f.fol_id=Rescueclima.focli_id','f')
        ->join('Empresa','e.emp_id=f.emp_id','e')
        // ->leftjoin('commentcue','f.fol_id=r.focli_id','c')
        ->orderBy('recli_id')
        ->execute();

        $persona=0;
        $buscar=1; //si buscar 0 NO buscar, si buscar 1 SI buscar
        $antiguedad='';
        for ($i=0; $i < count($resp); $i++) 
        {
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$posicion, $resp[$i]->pregclima_orden);
            $objPHPExcel->getActiveSheet()->SetCellValue("B".$posicion, $resp[$i]->focli_id);

            if($persona==$resp[$i]->focli_id){
                $buscar=0;
            }else{
                $buscar=1;
            }
            if($buscar==1){
                $condicionanios="focli_id=".$resp[$i]->focli_id." and precucli_id=60";
                    //extrajendo comentatios del inciso 53
                    $respuesta53=Rescueclima::query()
                    ->columns('cal_texto,focli_id')
                    ->where($condicionanios)
                    ->join('Calificacion','c.cal_id=Rescueclima.cal_id','c')
                    ->execute();

                $antiguedad=$respuesta53[0]->cal_texto;
            }
            // $persona=$resp[0]->focli_id;
            // $objPHPExcel->getActiveSheet()->SetCellValue("C".$posicion, $resp[0]->pregclima_orden);
            $objPHPExcel->getActiveSheet()->SetCellValue("D".$posicion, $resp[$i]->pregclima_dimension);
            $objPHPExcel->getActiveSheet()->SetCellValue("E".$posicion, $resp[$i]->pregclima_texto);
            $objPHPExcel->getActiveSheet()->SetCellValue("F".$posicion, $resp[$i]->cal_ponderacion);
            $objPHPExcel->getActiveSheet()->SetCellValue("G".$posicion, $resp[$i]->fol_puesto);

            $objPHPExcel->getActiveSheet()->SetCellValue("H".$posicion, $antiguedad);

            if($resp[$i]->pregclima_orden==1)
            {
                $condicionpreguntaComentarioAbierto62="focli_id=".$resp[$i]->focli_id." and precucli_id=62";
                //extrajendo comentatios del inciso 63
                $respuesta62=Rescueclima::query()
                ->columns('com_texto,focli_id,precucli_id')
                ->where($condicionpreguntaComentarioAbierto62)
                ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                ->execute();
                
                if(count($respuesta62)>0)
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,$respuesta62[0]->com_texto);   

                }
                else
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,'No dejaron comentario.');
                }
            }

            if($resp[$i]->pregclima_orden==25)
            {
                $condicionpreguntaComentarioAbierto25="focli_id=".$resp[$i]->focli_id." and precucli_id=26";
                //extrajendo comentatios del inciso 63
                $respuesta25=Rescueclima::query()
                ->columns('com_texto,focli_id,precucli_id')
                ->where($condicionpreguntaComentarioAbierto25)
                ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                ->execute();
                
                if(count($respuesta25)>0)
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,$respuesta25[0]->com_texto);   

                }
                // else
                // {
                //     $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,'No dejaron comentario.');
                // }
            }

            if($resp[$i]->pregclima_orden==51)
            {
                $condicionpreguntaComentarioAbierto52="focli_id=".$resp[$i]->focli_id." and precucli_id=53";
                //extrajendo comentatios del inciso 63
                $respuesta52=Rescueclima::query()
                ->columns('com_texto,focli_id,precucli_id')
                ->where($condicionpreguntaComentarioAbierto52)
                ->join('Commentcue','com.recli_id=Rescueclima.recli_id','com')
                ->execute();
                
                if(count($respuesta52)>0)
                {
                    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,$respuesta52[0]->com_texto);   

                }
                // else
                // {
                //     $objPHPExcel->getActiveSheet()->SetCellValue('I'.$posicion,'No dejaron comentario.');
                // }
            }

            $objPHPExcel->getActiveSheet()->SetCellValue("J".$posicion, $resp[$i]->emp_nombre);
            //CONTROL Y LLAVE QUE CIIERA PARA COMENTAR
            $posicion++;
            // die();
        }

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $answer=array();
        $objWriter->save('reporte/cuestionarioclima.xlsx');

        $file='cuestionarioclima.xlsx';
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