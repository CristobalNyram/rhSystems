<?php

use Phalcon\Mvc\Model\Query\Builder;

class ConsultaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Consulta');
        parent::initialize();
        $this->view->gmenu=1;
    }

    
    public function participanteAction($id)
    {
        $auth = $this->session->get('auth');
        // if($auth)
        // {
            // if($auth['tipo']=='Companies')
            //     return $this->forward('empresa/index');       
            // else
            //     return $this->forward('index/panel');       
                // return $this->response->redirect('index/panel');

            //$this->view->prueba=$prueba;
            //$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        // }
        // else
        // {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $par_id = Participante::findFirstBypar_id($id);
        $valido=0;
        $tra_nombre='';
        $curso='';
        $inicial='';
        $final='';

        if ($par_id) 
        {
            $participante=new Builder();
            $participante=$participante
            ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cur_horas','cuo_fechainicio','cuo_fechafinal','par_id'))
            ->addFrom('Participante','p')
            ->join('Trabajador','p.tra_id=t.tra_id','t')
            ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
            ->join('Curso','c.cur_id=co.cur_id','c')
            ->where('par_id='.$id)
            ->getQuery()
            ->execute();

            $valido=1;
            $tra_nombre=$participante[0]->tra_nombre.' '.$participante[0]->tra_primerapellido.' '.$participante[0]->tra_segundoapellido;
            $curso=$participante[0]->cur_nombre;
            $inicial=$participante[0]->cuo_fechainicio;
            $final=$participante[0]->cuo_fechafinal;
        }

        $this->view->valido=$valido;
        $this->view->tra_nombre=$tra_nombre;
        $this->view->curso=$curso;
        $this->view->inicial=$inicial;
        $this->view->final=$final;
        $this->view->prueba=$prueba;

        // }
    }

    public function participantedc3Action($id)
    {
        // $auth = $this->session->get('auth');

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $par_id = Participante::findFirstBypar_foliodc3($id);
        $valido=0;
        $tra_nombre='';
        $curso='';
        $inicial='';
        $final='';
        $expedicion='';

        if ($par_id) 
        {   
            if($par_id->par_estatus==2)
            {
                $participante=new Builder();
                $participante=$participante
                ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_fechainicio','cuo_fechafinal','par_id','DATE_FORMAT(par_fechadc3, "%d-%m-%Y") as fechadc3'))
                ->addFrom('Participante','p')
                ->join('Trabajador','p.tra_id=t.tra_id','t')
                ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
                ->join('Curso','c.cur_id=co.cur_id','c')
                ->where('par_estatus=2 and par_foliodc3='.$id)
                ->getQuery()
                ->execute();

                $valido=1;
                $tra_nombre=$participante[0]->tra_nombre.' '.$participante[0]->tra_primerapellido.' '.$participante[0]->tra_segundoapellido;
                $curso=$participante[0]->cur_nombre;
                $inicial=$participante[0]->cuo_fechainicio;
                $final=$participante[0]->cuo_fechafinal;
                $expedicion=$participante[0]->fechadc3;
            }
        }

        $this->view->valido=$valido;
        $this->view->tra_nombre=$tra_nombre;
        $this->view->curso=$curso;
        $this->view->inicial=$inicial;
        $this->view->final=$final;
        $this->view->prueba=$prueba;
        $this->view->expedicion=$expedicion;

        // }
    }

    public function participantedipAction($id)
    {
        // $auth = $this->session->get('auth');

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $par_id = Participante::findFirstBypar_foliodip($id);
        $valido=0;
        $tra_nombre='';
        $curso='';
        $inicial='';
        $final='';
        $expedicion='';

        if ($par_id) 
        {
            if($par_id->par_estatus==2)
            {
                $participante=new Builder();
                $participante=$participante
                ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','tra_curp','cur_nombre','cuo_fechainicio','cuo_fechafinal','par_id','DATE_FORMAT(par_fechadip, "%d-%m-%Y") as fechadip'))
                ->addFrom('Participante','p')
                ->join('Trabajador','p.tra_id=t.tra_id','t')
                ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
                ->join('Curso','c.cur_id=co.cur_id','c')
                ->where('par_foliodip='.$id)
                ->getQuery()
                ->execute();

                $valido=1;
                $tra_nombre=$participante[0]->tra_nombre.' '.$participante[0]->tra_primerapellido.' '.$participante[0]->tra_segundoapellido;
                $curso=$participante[0]->cur_nombre;
                $inicial=$participante[0]->cuo_fechainicio;
                $final=$participante[0]->cuo_fechafinal;
                $expedicion=$participante[0]->fechadip;
            }
        }

        $this->view->valido=$valido;
        $this->view->tra_nombre=$tra_nombre;
        $this->view->curso=$curso;
        $this->view->inicial=$inicial;
        $this->view->final=$final;
        $this->view->prueba=$prueba;
        $this->view->expedicion=$expedicion;

        // }
    }

    public function verificarAction()
    {
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);   
    }

    public function buscarAction()
    {
        $answer=array();
        $answer[0]=1;
        $this->view->disable();
        if($this->request->isAjax())
        {
            $data = $this->request->getPost();
            $captcha=$data['g-recaptcha-response'];
            $secret='6LeaWNAUAAAAAP1SHm8cHXswtOvU_Ytp7bUwbOC8';
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
            $arr = json_decode($response, TRUE);
            if ($arr['success']) {
                if($data["tipo"]==1){
                    $participante=Participante::findFirstBypar_foliodc3($data["folio"]);

                }
                else
                {
                    $participante=Participante::findFirstBypar_foliodip($data["folio"]);

                }

                if($participante)
                {
                    $valido=0;
                    if($data["tipo"]==1)
                    {
                        $fecha = date("Y-m-d", strtotime($participante->par_fechadc3));
                        if($fecha==$data["fecha"]){
                            $valido=1;
                            $answer[1]=1;
                        }
                    }
                    else
                    {
                        $fecha = date("Y-m-d", strtotime($participante->par_fechadip));
                        if($fecha==$data["fecha"]){
                            $valido=1;
                            $answer[1]=2;
                        }

                    }
                    if($valido==1)
                    {
                        $datos=new Builder();
                        $datos=$datos
                        ->columns(array('tra_nombre','tra_primerapellido','tra_segundoapellido','cur_nombre','DATE_FORMAT(cuo_fechainicio, "%d-%m-%Y") as fechainicio','DATE_FORMAT(cuo_fechafinal, "%d-%m-%Y") as fechafinal','par_id'))
                        ->addFrom('Participante','p')
                        ->join('Trabajador','p.tra_id=t.tra_id','t')
                        ->join('Cursootorgado','co.cuo_id=p.cuo_id','co')
                        ->join('Curso','c.cur_id=co.cur_id','c')
                        ->where('par_id='.$participante->par_id)
                        ->getQuery()
                        ->execute();
                        $answer[0]=1;
                        $answer[2]=mb_substr($datos[0]->tra_nombre, 0, 3);
                        $answer[3]=mb_substr($datos[0]->tra_primerapellido, 0, 3);
                        $answer[4]=mb_substr($datos[0]->tra_segundoapellido, 0, 3);
                        $answer[5]=$datos[0]->cur_nombre;
                        $answer[6]=$datos[0]->fechainicio;
                        $answer[7]=$datos[0]->fechafinal;
                    }
                    else
                    {
                        $answer[0]=2;
                        $answer[1]='No existe';
                    }

                }
                else
                {
                    $answer[0]=2;
                    $answer[1]='No existe';
                }
            }else 
            {
                $answer[0]=-1;
                $this->response->setJsonContent($answer);
                $this->response->send();
            }
            
        }
        else
            $answer[0]=-1;
        $this->response->setJsonContent($answer);
        $this->response->send();
    }
    
    public function diplomainstructorAction($id)
    {
        // $auth = $this->session->get('auth');

        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

        $par_id = Diplomainstructor::findFirstBydip_foliodip($id);
        $valido=0;
        $ins_nombre='';
        $curso='';
        $inicial='';
        $final='';
        $expedicion='';

        if ($par_id) 
        {   
            if($par_id->dip_estatus==2)
            {
                $participante=new Builder();
                $participante=$participante
                ->columns(array('ins_nombre','ins_primerapellido','ins_segundoapellido','cur_nombre','DATE_FORMAT(cuo_fechainicio, "%d-%m-%Y") as cuo_fechainicio','DATE_FORMAT(cuo_fechafinal, "%d-%m-%Y") as cuo_fechafinal','DATE_FORMAT(dip_fechadip, "%d-%m-%Y") as fechadip'))
                ->addFrom('Diplomainstructor','d')
                ->join('Instructor','d.ins_id=i.ins_id','i')
                ->join('Cursootorgado','co.cuo_id=d.cuo_id','co')
                ->join('Curso','c.cur_id=co.cur_id','c')
                ->where('dip_estatus=2 and dip_foliodip='.$id)
                ->getQuery()
                ->execute();

                $valido=1;
                $ins_nombre=$participante[0]->ins_nombre.' '.$participante[0]->ins_primerapellido.' '.$participante[0]->ins_segundoapellido;
                $curso=$participante[0]->cur_nombre;
                $inicial=$participante[0]->cuo_fechainicio;
                $final=$participante[0]->cuo_fechafinal;
                $expedicion=$participante[0]->fechadip;
            }
        }

        $this->view->valido=$valido;
        $this->view->ins_nombre=$ins_nombre;
        $this->view->curso=$curso;
        $this->view->inicial=$inicial;
        $this->view->final=$final;
        $this->view->prueba=$prueba;
        $this->view->expedicion=$expedicion;

    }
}
