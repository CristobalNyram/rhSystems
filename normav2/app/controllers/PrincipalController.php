<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "excel-php/PHPExcel.php";
require 'excel-php/PHPExcel/Writer/Excel2007.php';
require 'excel-php/PHPExcel/Reader/Excel2007.php';

class PrincipalController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Principal');
        parent::initialize();
    
    }

    /**
     * [indexAction Index para la tabla curso]
     * @param        []
     * @return []    []
     */
    public function indexAction()
    {
    $configuracion=new Configuracion();
    $estatusLogoConfiguracion=$configuracion->estatusConfiguracionAnuncio(5);
    $logo_actual=$estatusLogoConfiguracion['con_texto'];
    $this->view->logoactual=$logo_actual;
    $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
         $form = new PrincipalForm;
         $cuestionario= new Cueactivo();

        //con esta funcion estamos haciendo una consulta para verificar que cuestionarios estan activos
        $cue= $cuestionario->estadoactivoCuestionarioClimaONorma();
        $this->view->estadoDeCuestionarios=$cue;
        $form->Cueuno();
        $this->view->form = $form;
    }

    public function index2Action()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioBienvenida=$configuracion->estatusConfiguracionAnuncio(2);
        $requiere_carga_info_usuario=-2;
        $mensaje_reg="";

        $empresas=array();
        $folio = new stdClass();

        $fol_id = $this->request->getQuery('folio', 'int');
        $folioBuscar = Folio::findFirstByfol_id($fol_id);

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


        if ($configuracion->solicitar_datos_participante) {
            $campos_a_solicitar_fol=$configuracion->getCamposASolicitar();
            $obj_folio=new Folio();
            $configuracion_mensaje_reg=$configuracion->estatusConfiguracionAnuncio(6);
            $mensaje_reg=  $configuracion_mensaje_reg["con_texto"];

            $respuesta_modelo_buscar_info=$obj_folio->getCargoInfoPorSiMismo($fol_id,$campos_a_solicitar_fol);
            
           # $folio_info_cargada=$respuesta_modelo_buscar_info['estatus'];
            $folio=$respuesta_modelo_buscar_info['data'];

            $requiere_carga_info_usuario=$respuesta_modelo_buscar_info['falta_cargar_info'];
            $empresaslista = Empresa::find(
                "emp_estatus=2 "
            );
            $empresas = $empresaslista;
        }
        
        $this->view->app = $this->getDI()->get('app');

        // variables usuario ini
        $this->view->requiere_carga_info_usuario=$requiere_carga_info_usuario;
        $this->view->empresas=$empresas;
        $this->view->folio=$folio;
        $this->view->mensaje_reg=$mensaje_reg;

        // variables usuario fin

        // variables configuracion ini
        $estatusLogoConfiguracion=$configuracion->estatusConfiguracionAnuncio(5);
        $logo_actual=$estatusLogoConfiguracion['con_texto'];
        $this->view->logoactual=$logo_actual;
        $this->view->estatusAnuncioBienvenida=$estatusAnuncioBienvenida;
        // variables configuracion fin
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
       
    }

    public function index2climaAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function cuestionariounoAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $form = new PrincipalForm;
        $form->Cueuno();
        $this->view->form = $form;
    }

    public function validarcuestionarioAction()
    {
        $activo = Cueactivo::findFirstBycue_id(1);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $form = new PrincipalForm;
        $form->Cueuno();
        $data = $this->request->getPost();
        if (!$this->request->isPost()) {
            $this->flash->error('Error en los datos.');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }

        $configuracion = new Configuracion();
        if (!$configuracion->validacionFechaDeContestarCuestionarios()) {
            $this->flash->error('Los cuestionarios no están disponibles en este momento.');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }

        $folioval = Folio::findFirstByfol_id($data['folio']);
        if (!$folioval) {
            $this->flash->error('No existe el folio');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }

        if ($folioval->fol_estatus!=2) {
            $this->flash->error('No existe el folio -E');
            $this->response->redirect('principal/index');
            $this->view->disable();
            return;
        }

        if ($activo->cue_dos == 1 && $activo->cue_tres == 0 && $activo->cue_uno == 0 && $activo->cue_cuatro_clima == 0) //se valida si el cuestionario dos es el que se va a contestar y verificamos que los demas no esten activos
        {
            //cuestionario 2

            $foliocue = Foliocuedos::findFirstByfod_id($data['folio']);
            if ($foliocue) {
                $this->flash->error('Ya se respondio la encuesta con ese folio');
                $this->response->redirect('principal/index');
                $this->view->disable();
                return;
            } else {
                $this->response->redirect('principal/index2?cueinicio=dos&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }
        else if ($activo->cue_dos == 0 && $activo->cue_tres == 1 && $activo->cue_uno == 0 && $activo->cue_cuatro_clima == 0) //se valida si el cuestionario tres es el que se va a contestar
        {
            // return 'cuestionario 3';   
            $foliocue = Foliocuetres::findFirstByfot_id($data['folio']);
            if ($foliocue) {

                $this->flash->error('Ya se respondio la encuesta con ese folio');
                $this->response->redirect('principal/index');
                $this->view->disable();
                return;
            } else {

                $this->response->redirect('principal/index2?cueinicio=tres&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }

        //DOS CUESTIONARIOS ACTIVADOS -----START
        else if ($activo->cue_dos == 0 && $activo->cue_tres == 1 && $activo->cue_uno == 1 && $activo->cue_cuatro_clima == 0) //se valida si el cuestionario tres es el que se va a contestar
        {
            // return 'cuestionario 3 y 1';

            $foliocue = Foliocuetres::findFirstByfot_id($data['folio']);
            $foliocueuno = Foliocueuno::findFirstByfou_id($data['folio']);
            if ($foliocue) {
                if ($foliocueuno) {

                    $this->flash->error('Ya se respondio la encuesta con ese folio');
                    $this->response->redirect('principal/index');
                    $this->view->disable();
                    return;
                } else {
                    $this->response->redirect('principal/index2?cueinicio=uno&folio=' . $data['folio']);
                    $this->view->disable();
                    return;
                }
            } else {
                $this->response->redirect('principal/index2?cueinicio=tres&sigcue=uno&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }

        else if ($activo->cue_dos == 1 && $activo->cue_tres == 0 && $activo->cue_uno == 1 && $activo->cue_cuatro_clima == 0) //se valida si el cuestionario tres es el que se va a contestar
        {
            // return 'cuestionario 2 y 1';     
            $foliocue = Foliocuedos::findFirstByfod_id($data['folio']);
            $foliocueuno = Foliocueuno::findFirstByfou_id($data['folio']);
            if ($foliocue) {
                if ($foliocueuno) {

                    $this->flash->error('Ya se respondio la encuesta con ese folio');
                    $this->response->redirect('principal/index');
                    $this->view->disable();
                    return;
                } else {
                    $this->response->redirect('principal/index2?cueinicio=uno&folio=' . $data['folio']);
                    $this->view->disable();
                    return;
                }
            } else {
                $this->response->redirect('principal/index2?cueinicio=dos&sigcue=uno&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }

        else if ($activo->cue_dos == 0 && $activo->cue_tres == 0 && $activo->cue_uno == 1 && $activo->cue_cuatro_clima == 0) //se valida si el cuestionario tres es el que se va a contestar
        {
            // return 'cuestionario 1';
            $foliocueuno = Foliocueuno::findFirstByfou_id($data['folio']);
            if ($foliocueuno) {
                $this->flash->error('Ya se respondio la encuesta con ese folio');
                $this->response->redirect('principal/index');
                $this->view->disable();
                return;
            } else {
                $this->response->redirect('principal/index2?cueinicio=uno&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }
        //DOS CUESTIONARIOS ACTIVADOS -----END
        //cuestionario clima laboral
        else if ($activo->cue_cuatro_clima == 1) //se valida si el cuestionario de clima laboral se va a contestar
        {
            //validamos si el folio ya fue contestado en el cuestionario de clima laboral
            $foliocueclima = Foliocueclima::findFirstByfolcucli_id($data['folio']);
            if ($foliocueclima) {
                $this->flash->error('Ya se respondio la encuesta con ese folio');
                $this->response->redirect('principal/index');
                $this->view->disable();
                return;
            } else {
                $this->response->redirect('principal/index2?cueinicio=clima&folio=' . $data['folio']);
                $this->view->disable();
                return;
            }
        }

        $this->view->form = $form;
    }

    

    public function graciasAction()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioGracias1=$configuracion->estatusConfiguracionAnuncio(3);
        $this->view->estatusAnuncioGracias1=$estatusAnuncioGracias1;
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }

    public function gracias2Action()
    {
        $configuracion=new Configuracion();
        $estatusAnuncioGracias2=$configuracion->estatusConfiguracionAnuncio(4);
        $this->view->estatusAnuncioGracias2=$estatusAnuncioGracias2;
      
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    }
}
