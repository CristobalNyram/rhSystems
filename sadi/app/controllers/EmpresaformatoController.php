<?php
use Phalcon\Crypt;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Di;
require "intervention_image/index.php";

use Intervention\Image\ImageManager;

class EmpresaformatoController extends ControllerBase
{

       /**
     * [tablaAction Muestra los registros de la tabla empresaformato]
     * @param        []
     * @return []    []
     */
    public function tablaAction($emp_id=0)
    {   

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $obj_empresaformato=new Empresaformato();
        $condicion ="emf_estatus>=0 and emp_id='$emp_id'";

            $emf=Empresaformato::query()
            ->columns('Empresaformato.emf_estatus,Empresaformato.emf_id,Empresaformato.emf_id,tif.tif_nombre,Empresaformato.emp_id')
            ->where($condicion)
            ->leftjoin('Tipoformato','tif.tif_id=Empresaformato.tif_id','tif')
            ->execute();
        
        $this->view->empresaformato=$emf;
        $this->view->obj_empresaformato=$obj_empresaformato;

    }
    public function ajax_detalleAction($emf_id=0){
        $this->view->disable();
        $answer=[];
        $obj_empresaformato=new Empresaformato();
       
        $subs = Empresaformato::findFirstByemf_id($emf_id);
        if($subs) {
            $answer['data'] = $subs->toArray();
            $answer['estatus_name'] = $obj_empresaformato->getNombreEstatusACambiar($subs->emf_estatus);
            $answer['estatus']=2;
            
        }
        return $this->response->setJsonContent($answer);
    }

    public function desactivar_activarAction($emf_id=0){

        $this->view->disable();
        $answer=array();
        $descripcion_extra_bicatora='';
        if($this->request->isAjax() and $emf_id!=0 and is_numeric($emf_id))
        {
            $buscar_emf=Empresaformato::findFirst($emf_id);
            if($buscar_emf)
            {   
                if($buscar_emf->emf_estatus==2){
                    $buscar_emf->emf_estatus=1;
                    $descripcion_extra_bicatora='Se desactivó';

                }else{
                    $buscar_emf->emf_estatus=2;
                    $descripcion_extra_bicatora='Se activó';
                }

                    if($buscar_emf->update())
                    {
                        $auth = $this->session->get('auth');

                        $bitacora= new Bitacora();
                        $databit['bit_descripcion']= $descripcion_extra_bicatora.' un formato de empresa que tiene por id el '.$buscar_emf->tif_id.' a la empresa con clave interna '.$buscar_emf->emp_id;
                        $databit['usu_id']=$auth['id'];
                        $databit['bit_tablaid']=$buscar_emf->emf_id;
                        $databit['bit_modulo']="Empresa formato.";
                        $bitacora->NuevoRegistro($databit);

                        $answer[0]=2;
                        $answer['titular']='Éxito';
                        $answer['mensaje']='Se actualizaron los datos ';
                        $answer['emf_id']= $buscar_emf->emf_id;
                        $answer['emp_id']= $buscar_emf->emp_id;
                 
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;  

                    }
                    else
                    {
                        $answer[0]=-2;
                        $answer['titular']='ERROR';
                        $answer['mensaje']='No se pudieron procesar los datos.';
                        $this->response->setJsonContent($answer);
                        $this->response->send(); 
                        return;    
                        
                    }
            }
            else
            {
                $answer[0]=-2;
                $answer['titular']='NO DISPONIBLE';
                $answer['mensaje']='El archivo ha sido modificadó anteriormente.';
                $this->response->setJsonContent($answer);
                $this->response->send(); 
                return;    
            }
            
        }

    }

    public function ajax_formatos_disponibles_para_empresaAction($emp_id=0){
        $this->view->disable();
        $answer=[];
        $obj_empresaformato=new Empresaformato();
          
        $di = Di::getDefault();
        $db = $di->get('db');
        $sql = '
            SELECT tif_id, tif_nombre
            FROM tipoformato
            WHERE NOT EXISTS (
            SELECT *
            FROM empresaformato
            WHERE empresaformato.tif_id = tipoformato.tif_id and empresaformato.emp_id='.$emp_id.' and empresaformato.emf_estatus>0 
            ) and tif_estatus=2
            ';
        $result = $db->query($sql);
        $answer['data']= $result->fetchAll();
        $answer['estatus']= 2;
        return $this->response->setJsonContent($answer);

        
    }

    public function asignar_a_empresaAction($emp_id=0){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()&& $emp_id!=0 && is_numeric($emp_id))
        {
            $data = $this->request->getPost();
            $empresa=Empresa::findFirstByemp_id($emp_id);
            $empresaformato = new Empresaformato();

            foreach ($data['emp_tipoformato'] as $key => $emp_tipoformato) 
            {
                 $res_emp_tipoformato= $empresaformato->NuevoRegistro($emp_tipoformato,$empresa->emp_id);          
            }
    
    
            
            $auth = $this->session->get('auth');
            $bitacora= new Bitacora();
            $databit['bit_descripcion']= 'Asigno formato de estudio a la empresa con ID '.$empresa->emp_id.' interno con nombre '.$empresa->emp_alias;
            $databit['usu_id']=$auth['id'];
            $databit['bit_tablaid']=$empresa->emp_id;
            $databit['bit_modulo']="Empresa formato";
            $bitacora->NuevoRegistro($databit);

            $answer[0]=2;
            $answer['titular']='Éxito';
            $answer['mensaje']='Se asignaron correctamente los formatos a la empresa '.$empresa->emp_alias;
            $answer['emp_id']=$emp_id;
            return $this->response->setJsonContent($answer);


        }else{
            return http_response_code(400);
        }
       


    }

    public function ajax_empresas_con_formato($tif_id){
        $this->view->disable();
        $answer=array();
        if($this->request->isAjax()&& $tif_id!=0 && is_numeric($tif_id))
        {

            $empresas= Empresa::query()
            ->leftjoin('Empresaformato','emf.usu_id=Empresa.emp_id','emf')
            ->where('emf.tif_id='.$tif_id.' Empresa.emp_estatus=2')
            ->execute();

        }

       


    }
}