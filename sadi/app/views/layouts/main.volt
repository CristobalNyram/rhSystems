
{{ stylesheet_link('css/validaciones/color.css') }}

  <!-- chart js -->
  {{ javascript_include('js/chartjs/chart.min.js') }}

<script type="text/javascript">
    $(document).ready(function(){

      $('input[type=text]:not(.data-not-lt-active)').attr("data-lt-active", "true");
     

    });

    

</script>

  <style type="text/css">
    
    /*body.nav-md .container.body .right_col {
      margin-left: 0px!important;
    }*/

    /*.main_container .top_nav {
      margin-left: 0px!important;
    }

    .top_nav .navbar-right {
      width: 20%;
    }

    .nav>li>a:hover, .nav>li>a:focus {
      background-color: #00addc;
    }*/

    .recorte {
      width: 150px;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .recorte2 {
      width: 80px;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

    .recorte3 {
      width: 200px;
      white-space: nowrap;
      text-overflow: ellipsis;
      overflow: hidden;
    }

      .polvencida {
        /* background-color: #FE0303!important; */
        color: red;
        /* font-weight: bold; */
      }
      .polvencida a {
        color: red;
      }

      .polvencida6 {
        background-color: rgba(226, 99, 99, 0.3)!important;
        color: red;
        font-weight: bold;
        /* background-color: #E26363!important; */
        /* opacity: 0.6; */
        /* color: white; */
      }
   
  </style>
 {% include "/layouts/funciones-generales-js.volt" %}
 {% include "/layouts/verificar-sesion-js.volt" %}



 <!-- estilos personalizados desde la bd -->
 <?= $this->assets->outputCss() ?>
 <!-- estilos personalizados desde la bd -->

 
<div id="wrapper">

    <!-- <div class="main_container" id="{{gcolor}}"> -->
        
        <!-- top navigation -->
        <header id="topnav">

            <div class="navbar-custom navbar-custom-crm">
                <div class="container-fluid">
                  <ul class="list-unstyled topnav-menu float-right mb-0">

                            <li class="dropdown notification-list ">
                                <!-- Mobile menu toggle-->

                                <a class="navbar-toggle nav-link navigation-color">
                                    <div class="lines">
                                      <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user mr-0 " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                  {{ image("assets/images/users/avatar-1.jpg", "alt": "user-image", "class": "rounded-circle") }}
                                    <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
                                    <span class="pro-user-name d-none d-xl-inline-block ml-2 navigation-color">
                                    Hola, <b>{{ nombreadmin }}</b>  <i class="mdi mdi-chevron-down"></i> 
                                    </span>
                                </a>
                                <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <!-- item-->
                                    <ul class="dropdown-menu dropdown-menu-right">
                                      {{ link_To(['usuario/perfil','class': 'dropdown-item','<i class="mdi mdi-account-outline"></i><span> Perfil</span>']) }}

                                      
                                      <!-- item-->
                                      <div class="dropdown-divider"></div>

                                      <!-- item-->
                                      {{ link_To(['session/end','class': 'dropdown-item','<i class="mdi mdi-logout-variant"></i><span> Salir</span>']) }}
                                    </ul>
                                </li>
                              </ul>
                            </li>

                  </ul>
                  <div class="logo-box">
                      <a class="logo text-center">
                          <span class="logo-lg">
                            
                            {{ image("assets/images/small/logo_white.svg", "alt": " ", "height": "36", 'onclick':'redirecion_dash()') }} 
                            
                          </span>
                          <span class="logo-sm">
                            {{ image("assets/images/small/logo_sm.svg", "alt": " ", "height": "36", 'onclick':'redirecion_dash()') }}
                          </span>
                      </a>
                  </div>
                    
          
                  <div id="navigation">
                            <!-- Navigation Menu-->
                            <ul class="navigation-menu">
                              
                              {% if acceso.verificar(5,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/alta','Alta investigación','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(7,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/asignarinvestigador_index','Asignar investigador','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(8,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/trafico_index','Tráfico','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(84,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['cita/agenda_index','Agenda','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(25,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['transporte/aprobar_index','Transporte','class': 'navigation-color space-nav']) }}
                              </li>
                              {% endif %}

                              {% if acceso.verificar(11,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/asignaranalista_index','Asignar analista','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(12,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/traficoanalista_index','Tráfico analista','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(15,rol_id)==1 %}
                                <li class="has-submenu">
                                  {{ link_To(['estudio/autorizacion_index','Autorización ESES','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                              {% if acceso.verificar(18,rol_id)==1 %}
                              <li class="has-submenu" >
                                <a href="#"  class="navigation-color space-nav">Reportes<i class="arrow-down"></i></a>
                                <ul class="submenu" style="height: auto">
                        
                            
                                  
                                    {% if acceso.verificar(27,rol_id)==1 %}
                                      <li>{{ link_To(['reporte/estatus_index','Estatus']) }}</li>
                                    {% endif %}

                                    {% if acceso.verificar(26,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['consulta/index','Consulta']) }}
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(37,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['reporte/honorario_index','Honorario/Viático']) }}
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(47,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['incidencia/reporte_index','Incidencias']) }}
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(68,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['reporte/comentarioese_index','Comentarios']) }}
                                    </li>
                                    {% endif %}
                                   

                                    {% if acceso.verificar(73,rol_id)==1 %}
                                    <li class="has-submenu">
                                        <a href="#">Encuestas calidad<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                          {% if acceso.verificar(74,rol_id)==1 %}
                                              <li >
                                                <li>{{ link_To(['encuestacalidad/index','Realizar encuesta']) }}</li>
                                              </li>
                                          {% endif %}
                                          {% if acceso.verificar(75,rol_id)==1 %}
                                            <li >
                                              {{ link_To(['encuestacalidad/reporte','Encuesta calidad 2023']) }}
                                            </li>
                                            <li >
                                              {{ link_To(['encuestacalidadreporte/reporte_vdos','Encuesta calidad 2024']) }}
                                            </li> 
                                          {% endif %}
                                        </ul>
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(78,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['reporte/efectividad_index','Efectividad']) }}
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(83,rol_id)==1 %}

                                    {% if acceso.verificar(87,rol_id)==1 %}
                                    <li class="has-submenu">
                                        <a href="#">Soporte<div class="arrow-down"></div></a>
                                        <ul class="submenu">
                                          {% if acceso.verificar(88,rol_id)==1 %}
                                              <li >
                                                <li>{{ link_To(['soporte/estudio_index','Editar honorario']) }}</li>
                                              </li>
                                          {% endif %}
                                          {% if acceso.verificar(83,rol_id)==1 %}
                                          <li >
                                            {{ link_To(['soporte/transporte_index','Asignar transporte']) }}
                                          </li>
      
                                          {% endif %}
                                        </ul>
                                    </li>
                                    {% endif %}
                                     {% if acceso.verificar(93,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['reporte/transporte_index','Transporte']) }}
                                    </li>
                                    {% endif %}
                                    {% if acceso.verificar(97,rol_id)==1 %}
                                    <li >
                                      {{ link_To(['reporte/ese_cancelado_index','Cancelados']) }}
                                    </li>
                                    {% endif %}
                                    {% endif %}
                                  </ul>                          
                              </li>


                              {% endif %}
                                <!-- <li class="has-submenu"> -->
                                {% if acceso.verificar(38,rol_id)==1 %}
                                  <li class="has-submenu" >
                                    <a href="#"  class="navigation-color space-nav">Catálogos<i class="arrow-down"></i></a>
                                    <ul class="submenu" style="height: auto">
                                        {% if acceso.verificar(1,rol_id)==1 %}
                                          <li class="has-submenu">
                                              <a href="#">Usuarios<div class="arrow-down"></div></a>
                                              <ul class="submenu">
                                                  <li>{{ link_To(['usuario/index','Usuarios']) }}</li>
                                                  {% if acceso.verificar(2,rol_id)==1 %}
                                                    <li>{{ link_To(['rol/index','Roles']) }}</li>
                                                  {% endif %}
                                                  {% if acceso.verificar(3,rol_id)==1 %}
                                                    <li>{{ link_To(['bitacora/index','Bitácora']) }}</li>
                                                  {% endif %}
                                              </ul>
                                          </li>
                                        {% endif %}
                                        {% if acceso.verificar(4,rol_id)==1 %}
                                          <li class="has-submenu">
                                            <a href="#">Complemento <div class="arrow-down"></div></a>
                                            <ul class="submenu">
                                                <li>{{ link_To(['estado/index','Estados']) }}</li>
                                                <li>{{ link_To(['municipio/index','Municipio']) }}</li>
                                            </ul>
                                          </li>
                                        {% endif %}
                                        {% if acceso.verificar(6,rol_id)==1 %}
                                          <li>{{ link_To(['empresa/index','Empresas']) }}</li>
                                        {% endif %}
                                        {% if acceso.verificar(19,rol_id)==1 %}
                                          <li>{{ link_To(['tipoestudio/index','Tipo de estudio']) }}</li>
                                        {% endif %}
                                        {% if acceso.verificar(23,rol_id)==1 %}
                                          <li>{{ link_To(['negocio/index','Grupo de negocio']) }}</li>
                                        {% endif %}
                                        {% if acceso.verificar(96,rol_id)==1 %}

                                        <li class="has-submenu">
                                          <a href="#">Configuración <div class="arrow-down"></div></a>

                                            <ul class="submenu">
                                              {% if acceso.verificar(85,rol_id)==1 %}
                                              <li>{{ link_To(['configuracion/apariencia_index','Apariencia del sistema']) }}</li>
                                              {% endif %}
                                              {% if acceso.verificar(95,rol_id)==1 %}
                                              <li>{{ link_To(['configuracion/correos_index','Envio de correo']) }}</li>
                                              {% endif %}
                                            </ul>
                                        </li>
                                        {% endif %}


                                      </ul>                          
                                  </li>
                                {% endif %}
                                {% if acceso.verificar(82,rol_id)==1 %}
                                  <li class="has-submenu">
                                    {{ link_To(['cliente/index','Mis estudios','class': 'navigation-color space-nav']) }}
                                  </li>
                                {% endif %}
                                <!-- </li> -->
                            </ul>
                            <!-- End navigation menu -->
                            <div class="clearfix"></div>
                            
                  </div>
                  <div class="clearfix"></div>
                </div>
            </div>

        </header>
       
        <div class="content-page" style="background-color:#E0E0E0">
          <div class="content">
            <div class="container-fluid">
              {{ flash.output() }}
              {{ content() }}
            </div>

          </div>
        </div>

       
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>  

<div id="hide-me" class="loading" style="z-index: 9999;">Loading...</div>

<!-- <div class="loader-page"></div> -->

