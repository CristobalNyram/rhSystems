<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

  private $_Menu = array(
    'Catálogos' => array(
      'Área temática' => array(
        'controller' => 'areatematica',
        'action' => 'index'
      ),
      'Ocupación específica' => array(
        'controller' => 'ocupacion',
        'action' => 'index'
      ),
      'Cursos' => array(
        'controller' => 'curso',
        'action' => 'index'
      ),
      'Empresas' => array(
        'controller' => 'empresa',
        'action' => 'index'
      ),
      'Instructor' => array(
        'controller' => 'instructor',
        'action' => 'index'
      ),
      'Administrador' => array(
        'controller' => 'administrador',
        'action' => 'index'
      )
    ),
    'Cursos realizados'=> array(
        'Cerrados' => array(
          'controller' => 'cursootorgado',
          'action'  => 'index'
        ),
        'Abiertos' => array(
          'controller' => 'cursoabierto',
          'action'  => 'index'
        ),
        'Línea' => array(
          'controller' => 'cursolinea',
          'action'  => 'index'
        )
      ),
    'Reportes'=> array(
        'Reporte general' => array(
          'controller' => 'reporte',
          'action'  => 'index'
        )
        // ,
        // 'Cursos cerrados por empresa' => array(
        //   'controller' => 'reporte',
        //   'action'  => 'participantescurso'
        // ),
        // 'Cursos abiertos por empresa' => array(
        //   'controller' => 'reporte',
        //   'action'  => 'participantescursoabierto'
        // )
      ),
    'Usuarios'=> array(
        'Usuarios' => array(
          'controller' => 'usuario',
          'action'  => 'index'
        ),
        'Rol' => array(
          'controller' => 'rol',
          'action'  => 'index'
        )
      )
    
  );

  




    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu($gmenu)
    {

      $controllerName = $this->view->getControllerName();
      $actionname= $this->view->getActionName();
      $bandera=0;
      if($gmenu==2)
        $usar=$this->_Menu_companies;
      else{
        if($gmenu==0)
          $usar=$this->_Menu_configuracion;
        else
        {
          $usar=$this->_Menu;
          $auth = $this->session->get('auth');
          
        }
      }

      $auth = $this->session->get('auth');
      if ($auth) 
      {
        foreach ($usar as $nombre => $menu) 
        {
          $bandera=0;
          $menu2=$menu;
          foreach ($menu2 as $controller => $option) {
              # code...
            if(array_key_exists('controller', $option))
            {
              if($controllerName==$option['controller']/* && $actionname==$option['action']*/)
              {
                $bandera=1;
              }
            }
            else
            {
              foreach ($option as $controller2 => $option2) 
              {
                if($option2['controller']==$controllerName /*&& $actionname==$option2['action']*/) 
                  $bandera=1;
                  # code...
              }
            }
          }
    
          echo ''.
          '<!--begin:Menu item-->' .
          '<div data-kt-menu-trigger="{default: \'click\', lg: \'hover\'}" data-kt-menu-placement="right-start" class="menu-item py-2">' .
          '<!--begin:Menu link-->' .
          '<span class="menu-link menu-center">' .
          '<span class="menu-icon me-0">' .
          '<i class="ki-duotone ki-element-11 fs-2x">' .
          '<span class="path1"></span>' .
          '<span class="path2"></span>' .
          '<span class="path3"></span>' .
          '</i>' .
          '</span>' .
          '</span>' .
          '<!--end:Menu link-->' ;
          echo ''.
          '<!--begin:Menu sub-->' .
          '<div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">' .
          '<!--begin:Menu item-->' .
          '<div class="menu-item">' .
          '<!--begin:Menu content-->' .
          '<div class="menu-content">' .
          '<span class="menu-section fs-5 fw-bold ps-1 py-1">Chat</span>' .
          '</div>' .
          '<!--end:Menu content-->' .
          '</div>' .
          '<!--end:Menu item-->' .
          '<!--begin:Menu item-->' .
          '<div class="menu-item">' .
          '<!--begin:Menu link-->' .
          '<a class="menu-link" href="apps/chat/private.html">' .
          '<span class="menu-bullet">' .
          '<span class="bullet bullet-dot"></span>' .
          '</span>' .
          '<span class="menu-title">Private Chat</span>' .
          '</a>' .
          '<!--end:Menu link-->' .
          '</div>' .
          '<!--end:Menu item-->' .
          '<!--begin:Menu item-->' .
          '<div class="menu-item">' .
          '<!--begin:Menu link-->' .
          '<a class="menu-link" href="apps/chat/group.html">' .
          '<span class="menu-bullet">' .
          '<span class="bullet bullet-dot"></span>' .
          '</span>' .
          '<span class="menu-title">Group Chat</span>' .
          '</a>' .
          '<!--end:Menu link-->' .
          '</div>' .
          '<!--end:Menu item-->' .
          '<!--begin:Menu item-->' .
          '<div class="menu-item">' .
          '<!--begin:Menu link-->' .
          '<a class="menu-link" href="apps/chat/drawer.html">' .
          '<span class="menu-bullet">' .
          '<span class="bullet bullet-dot"></span>' .
          '</span>' .
          '<span class="menu-title">Drawer Chat</span>' .
          '</a>' .
          '<!--end:Menu link-->' .
          '</div>' .
          '<!--end:Menu item-->' .
          '</div>' .
          '<!--end:Menu sub-->' ;
          echo '' ;
          '</div>' .
          '<!--end:Menu item-->';
     

          // submenu iinicio 
          
          // submenu fin
          
            
              
          
        }
   
      }


    }

    public function getMenuOld($gmenu)
    {

      $controllerName = $this->view->getControllerName();
      $actionname= $this->view->getActionName();
      $bandera=0;
      if($gmenu==2)
        $usar=$this->_Menu_companies;
      else{
        if($gmenu==0)
          $usar=$this->_Menu_configuracion;
        else
        {
          $usar=$this->_Menu;
          $auth = $this->session->get('auth');
          
        }
      }

      $auth = $this->session->get('auth');
      if ($auth) 
      {
        foreach ($usar as $nombre => $menu) 
        {
          $bandera=0;
          $menu2=$menu;
          foreach ($menu2 as $controller => $option) {
              # code...
            if(array_key_exists('controller', $option))
            {
              if($controllerName==$option['controller']/* && $actionname==$option['action']*/)
              {
                $bandera=1;
              }
            }
            else
            {
              foreach ($option as $controller2 => $option2) 
              {
                if($option2['controller']==$controllerName /*&& $actionname==$option2['action']*/) 
                  $bandera=1;
                  # code...
              }
            }
          }
          if($bandera==0)
            echo '<li>';
          else
            echo '<li>';
          echo '<a>';
          echo '<i class="fa fa-list"></i>'.$nombre.' <span class="fa fa-chevron-down"></span>';
          echo '</a>';
          echo '<ul class="nav child_menu">';
          foreach ($menu as $controller => $option) 
          {
            $bandera2=0;
            if(array_key_exists('controller', $option))
            {
              if($controllerName==$option['controller'] /*&& $actionname==$option['action']*/) 
                echo '<li class="active">';
              else
                echo '<li>';
              //echo '<a href="'.$this->url->get($option['controller'].'/'.$option['action'].'/').'">'.$controller.'</a>';
              echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $controller);
              echo '</li>';
            }
            else
            {
              $bandera3=0;
              $option2=$option;
              foreach ($option2 as $controller2 => $option3) {
                  # code...
                if($option3['controller']==$controllerName /*&& $actionname==$option3['action']*/)
                  $bandera3=1;
              }
              unset($option2);
              if($bandera3==0)
                echo '<li>';
              else
                echo '<li>';
              echo '<a href="#"><i class="fa fa-plus"></i> '.$controller;
              echo '<span class="pull-right-container">';
              echo '<i class="fa fa-angle-left pull-right"></i>';
              echo '</span>';
              echo '</a>';
              echo '<ul class="nav child_menu" style="display: none">';
              foreach ($option as $controller2 => $option2) 
              {
                if($option2['controller']==$controllerName /*&& $actionname==$option2['action']*/) 
                  echo '<li class="active">';
                else
                  echo '<li>';
                echo $this->tag->linkTo($option2['controller']. '/' . $option2['action'],'<i class="fa fa-minus"></i> ' . $controller2 );
                echo '</li>';
                  # code...
              }
              echo '</ul>';
              echo '</li>';
            }
              # code...
          }
          echo '</ul>';
          echo '</li>';
          
        }
        echo '<li>';
        echo '</li>';
      }


    }
    public function buscaproyecto($clave)
    {
      $proyecto=Proyecto::findFirstBypro_id($clave);
      return $proyecto->pro_nombre;
    }
    public function buscadepartamento($clave)
    {
      $proyecto=Departamento::findFirstBydep_serie($clave);
      if(!$proyecto)
        $proyecto=Departamento::findFirstBydep_id($clave);
      return $proyecto->dep_nombre;
    }
     public function buscausuario($clave)
    {
      $proyecto=Usuario::findFirstByusu_id($clave);
      return $proyecto->usu_nombre.' '.$proyecto->usu_apellidop;
    }
    public function formatoNum($val=0)
    {
      return number_format($val, 2, '.', ',');
    }
    public function numround($num)
    {
      return round($num,8);
    }
    /**
     * regresa la url de la foto del usuario
     * @param  string $id [clave del usuario]
     * @return [string]     [url de la foto]
     */
    public function obtener_foto($id="")
    {
      if($id!="")
      {
        $usuario=Usuario::findFirstByusu_id($id);
        return $usuario->usu_foto;
      }
      else
        return "";
    }

    public function diffechaactual($fecha="",$fecha2="")
    {
      if($fecha2=="")
        $fi=new DateTime();
      else
        $fi=new DateTime($fecha2);
      $ff=new DateTime($fecha);
      if($fi<$ff)
        return "";
      $diff = $fi->diff($ff);
      return $diff->y." años ".$diff->m." meses ".$diff->d." días";
    }

    public function fechabaja($clave)
    {
      $usuario=Usuario::findFirst(array("usu_id=".$clave." order by hus_id desc"));
      if($usuario)
        return $usuario->hus_fecha;
      else
      {
        $fi=new DateTime();
        return $fi->format('Y-m-d');
      }

    }
    public function sueldoinicial($clave=0)
    {
      $sueldo=Sueldo::findFirst(array("sue_estatus>0 and usu_id=:clave: order by sue_id",
                                "bind" => array("clave"=> $clave)));
      if($sueldo)
      {
        return $sueldo->sue_cantidad;
      }
      else
        return 0;
    }
    public function acentos($val)
    {
      return html_entity_decode($val);
    }
    /**
     * Returns menu tabs
     */
    

    
  }
