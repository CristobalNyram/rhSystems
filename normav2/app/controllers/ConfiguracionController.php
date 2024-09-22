<?php
require "intervention_image/index.php";
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Intervention\Image\ImageManager;



class ConfiguracionController extends ControllerBase
{
    public function initialize()
    {

        $this->tag->setTitle('Configuración');
        parent::initialize();
    }

    public function cuestionarioactivacionAction()
    {
         $cuestionario= new Cueactivo();
         $cues= $cuestionario->EstadoCuestionario();  
         $this->view->cues=$cues;
      
    }

    public function fechacuestionarioAction()
    {
        $estatuscon= new Configuracion();
        $estadoconfiguracion= $estatuscon->estatusConfiguracionFechaLimite();

        $nombre = $estadoconfiguracion->con_nombre;
        $fechaini=$estadoconfiguracion->con_fechaini;
        $fechafin=$estadoconfiguracion->con_fechafin;
       
        $date1 = new DateTime($fechaini);
        $date2 = new DateTime($fechafin);
        $date2->setTime(23, 59, 59); // Establecer la hora a 23:59:59

        $diff = $date1->diff($date2); 

        $todayDate=new DateTime(date('d-m-Y H:i:s'));

        if($todayDate>$date2)
        {
            $diasRestantes='El cuestionario ya no está disponible...';
            $formatoMensaje='0';//con esto indicamos que ya no estan disponibles los cuestionarios y con eso el FRONTED se dara cuenta si la fecha en negatica o positiva
        }
        else
        {
            $diffDiasRestante=$todayDate->diff($date2);
            $diasRestantes = $diffDiasRestante->days;

            $tiempoRestante =$diffDiasRestante->days." día(s)";

            if ($diasRestantes == 0 && $diffDiasRestante->h == 0 && $diffDiasRestante->i == 0) {
                $tiempoRestante = 'Menos de 1 minuto';
            } else {
                // Construir la cadena de tiempo restante
                $tiempoRestante = '';
            
                if ($diasRestantes > 0) {
                    $tiempoRestante .= $diasRestantes . ' día(s) ';
                }
            
                if ($diff->h > 0) {
                    $tiempoRestante .= $diffDiasRestante->h . ' hora(s) ';
                }
            
                if ($diff->i > 0) {
                    $tiempoRestante .= $diffDiasRestante->i . ' minuto(s)';
                }
            }            
            // error_log($tiempoRestante);
            $diasRestantes=$tiempoRestante;
            $formatoMensaje='1';//con esto indicamos que ya no estan disponibles los cuestionarios
    
        }
    
        $estatus = array(
            'nombre'=>$nombre,
            'fechainicio'=>$fechaini,
            'fechafinal'=>$fechafin,
            'diasactvios'=> $diff->days.' días',
            'diasrestantes'=>$diasRestantes,
            'formatoMensaje'=> $formatoMensaje,//con esto indicamos que ya no estan disponibles los cuestionarios
        );
        
      
         $this->view->estadoconf=$estatus;
    }

    public function actualizarcuestionarioactivoAction()
    {
        $answer=array();
        $this->view->disable();
        if($this->request->isAjax()===true)
        {   
            $data =$this->request->getPost('respuesta');
            if(!empty($data))
            {
                $cuestionario = new Cueactivo();
                if(count($data)===2)
                {
                      $cuestionario1 = $data[0];
                      $cuestionario2 = $data[1];

                     if($cuestionario1==='C1' & $cuestionario2==='C2')
                     {
                        $cuestionario->ActivarDosCuestionario($cuestionario1,$cuestionario2);
                            
                     }
                     elseif ($cuestionario1==='C1' & $cuestionario2==='C3') {
                                $cuestionario->ActivarDosCuestionario($cuestionario1,$cuestionario2);
                     }
        
                }
                //evaluamos si solo actualizaremos  un cuestionario
            elseif (count($data)===1) 
            {
                    $cuestionario1 = $data[0];  
                    switch ($cuestionario1) {
                        case 'C1':
                            $cuestionario->ActivarUnCuestionario($cuestionario1);
                            break;
                        case 'C2':
                            $cuestionario->ActivarUnCuestionario($cuestionario1);                                  
                            break;
                        case 'C3':
                            $cuestionario->ActivarUnCuestionario($cuestionario1);                                  
                            break;
                        case 'CL':
                            $cuestionario->ActivarUnCuestionario($cuestionario1);                                  
                            break;     
                    }      
                                         
                }   
             
            }
            else
            {
               return('el cuestionario esta vacio');

            }
        }
      
    }

    public function actualizarfechadecuestionarioactivoAction()
    {
        $this->view->disable();
        $data =$this->request->getPost();
        if(!empty($data))
            {
               $fechasConfiguracion= Configuracion::findFirstBycon_id(1); 
               $fechasConfiguracion->con_fechaini=$data['fechaInicio'];
               $fechasConfiguracion->con_fechafin=$data['fechaFinal']; 
               if ($fechasConfiguracion->save()) 
               {
                return '1';
               }
               else
               {
                return '-1';
               }
            }
            else
            {
              return '-1';

            }

    }

    public function anunciobienvenidaAction()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioBienvenida=$configuracion->estatusConfiguracionAnuncio(2);
        $this->view->estatusAnuncioBienvenida=$estatusAnuncioBienvenida;

    }
    public function actualizaranuncioAction()
    {
        $answer=array();
         $this->view->disable();
         
        if($this->request->isAjax()===true)
        {
            if(!empty($data =$this->request->getPost()))
            {

                $con_nombre_edit=($data['con_nombre_edit']);
                $configuracion= new Configuracion();
                if(is_numeric($data['con_id_edit']))
                {

                    if($configuracionactualizaranuncio= $configuracion->actualizarConfiguracionAnuncio($con_nombre_edit,$data['con_id_edit']))
                    {  
                        $answer[0]=1;
                    
                        return  json_encode($answer);
                    }   
                    else
                    {
                        return '-1';
                    } 
                }
                else
                {
                    return '-1';
                }             
            }
            else
            {
                return '-1';

            }
        }
   
    }
    
    public function anunciogracias1Action()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioGracias1=$configuracion->estatusConfiguracionAnuncio(3);
        $this->view->estatusAnuncioGracias1=$estatusAnuncioGracias1;
    }
    


    public function anunciogracias2Action()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioGracias2=$configuracion->estatusConfiguracionAnuncio(4);
        $this->view->estatusAnuncioGracias2=$estatusAnuncioGracias2;
    }

    public function logoAction()
    {
        $configuracion=new Configuracion();
        $estatusLogoConfiguracion=$configuracion->estatusConfiguracionAnuncio(5);
        $logo_actual=$estatusLogoConfiguracion['con_texto'];
  
  
        $this->view->estatusLogoConfiguracion=$estatusLogoConfiguracion;
        $this->view->logoactual=$logo_actual;

    }

    public function cambiarlogoAction()
    {
        if($this->request->isPost())
        {
            $this->view->disable();
            $data = $this->request->getPost();
            $ruta = 'assets/images/config/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos//
            $mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las 
            foreach ($_FILES as $key) //Iteramos el arreglo de archivos
            {
                if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
                { 
                    $date= new DateTime();

                    $Nombre='logo_sistema';
                    $Tipo=$key['type'];
                    $TipoImagen=explode( '/',  $Tipo);
                    $NombreImagen=$Nombre.$date->format('Y-m-d-H-i-s').'.'.$TipoImagen[1];

                      $configuracionImagenLogo= Configuracion::findFirstBycon_id(5); 
                      $configuracionImagenLogo->con_texto=$NombreImagen;
                      $configuracionImagenLogo->save();   

                    $temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
                    $Destino = $ruta.$NombreImagen;   //Creamos una ruta de destino con la variable ruta y 
                    move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta 

                    $width = 150; // your max width
                    $height = 150; // your max height
                    $img = new ImageManager(array('driver' => 'gd'));
                    $img->make($ruta.$NombreImagen);
                    $imageHeight = $img->make($ruta.$NombreImagen)->height();
                    $imageWidth = $img->make($ruta.$NombreImagen)->width();
                    $imageHeight > $imageWidth ? $width=null : $height=null;
                    if($imageHeight > $imageWidth){
                        $img->make($ruta.$NombreImagen)->heighten($height)->save($ruta.$NombreImagen,100);
                        
                    }else{
                    $img->make($ruta.$NombreImagen)->widen($width)->save($ruta.$NombreImagen,100);
                    }
                      
                }
                if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada arc
                {
                    $answer[0]=1;
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;
                }
                if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
                {
                }
                     $answer[0]=-1;
                    $answer[1]="Ocurrió un error, intente de nuevo o contacte a un administrador.";
                    $this->response->setJsonContent($answer);
                    $this->response->send();
                    return;

            }


            
           

            
        }
          
    
                        
        
        
        
    }

    
    public function anunciotextoverAction($id)
    {
        $configuracion=new Configuracion();
        $configuracion_mensaje=$configuracion->estatusConfiguracionAnuncio($id);
        $this->view->configuracion_mensaje=$configuracion_mensaje;
    }

    


}