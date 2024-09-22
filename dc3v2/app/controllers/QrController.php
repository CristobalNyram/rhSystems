<?php
use Phalcon\Http\Response;
use Phalcon\Mvc\Model\Query\Builder;

use Zxing\QrReader;
// namespace Zxing;
class QrController extends ControllerBase
{
	public function indexAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        include('phpqrcode/qrlib.php');
        $datos='prueba';

        //Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
        //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'test.png';
 
        //Parametros de Condiguración
	
	$tamaño = 5; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 1; //Tamaño en blanco
	$contenido = "http://codigosdeprogramacion.com1"; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
    
    //Mostramos la imagen generada
	echo '<img src="'.$dir.basename($filename).'" /><hr/>';  
	    
    }

    public function lectorAction(){
    	// $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        require "../vendor/autoload.php";
        
        $datos='prueba';

        $dir = 'temp/';

        $qr= new QrReader($dir.'qrprueba1.png');
        $text = $qr->text();
        echo $text;
  //       //Declaramos una carpeta temporal para guardar la imagenes generadas
		// $dir = 'temp/';
		
		// //Si no existe la carpeta la creamos
		// if (!file_exists($dir))
	 //        mkdir($dir);
		
	 //        //Declaramos la ruta y nombre del archivo a generar
		// $filename = $dir.'test.png';
	 
	 //        //Parametros de Condiguración
		
		// $tamaño = 5; //Tamaño de Pixel
		// $level = 'L'; //Precisión Baja
		// $framSize = 1; //Tamaño en blanco
		// $contenido = "http://codigosdeprogramacion.com1"; //Texto
		
	 //        //Enviamos los parametros a la Función para generar código QR 
		// QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	    
	 //    //Mostramos la imagen generada
		// echo '<img src="'.$dir.basename($filename).'" /><hr/>'; 
    }

    public function guardar_fotoAction(){
    	$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
	if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
	//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
	$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));

	//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
	//todo el contenido lo guardamos en un archivo
	$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

	//Calcular un nombre único
	$nombreImagenGuardada = "temp/qrprueba1.png";

	//Escribir el archivo
	file_put_contents($nombreImagenGuardada, $imagenDecodificada);

	//Terminar y regresar el nombre de la foto
	exit($nombreImagenGuardada);
    }
}