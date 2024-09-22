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

 <!-- estilos personalizados desde la bd -->
 <?= $this->assets->outputCss() ?>
 <!-- estilos personalizados desde la bd -->
<div id="wrapper">

<!-- HORAS LIST -->
<datalist id="listahorasdeseadascitas">
  <option value="08:00"></option>
  <option value="08:15"></option>
  <option value="08:30"></option>
  <option value="08:45"></option>
  <option value="09:00"></option>
  <option value="09:15"></option>
  <option value="09:30"></option>
  <option value="09:45"></option>
  <option value="10:00"></option>
  <option value="10:15"></option>
  <option value="10:30"></option>
  <option value="10:45"></option>
  <option value="11:00"></option>
  <option value="11:15"></option>
  <option value="11:30"></option>
  <option value="11:45"></option>
  <option value="12:00"></option>
  <option value="12:15"></option>
  <option value="12:30"></option>
  <option value="12:45"></option>
  <option value="13:00"></option>
  <option value="13:15"></option>
  <option value="13:30"></option>
  <option value="13:45"></option>
  <option value="14:00"></option>
  <option value="14:15"></option>
  <option value="14:30"></option>
  <option value="14:45"></option>
  <option value="15:00"></option>
  <option value="15:15"></option>
  <option value="15:30"></option>
  <option value="15:45"></option>
  <option value="16:00"></option>
  <option value="16:15"></option>
  <option value="16:30"></option>
  <option value="16:45"></option>
  <option value="17:00"></option>
  <option value="17:15"></option>
  <option value="17:30"></option>
  <option value="17:45"></option>
  <option value="18:00"></option>
  <option value="18:15"></option>
  <option value="18:30"></option>
  <option value="18:45"></option>
  <option value="19:00"></option>
  <option value="19:15"></option>
  <option value="19:30"></option>
  <option value="19:45"></option>
  <option value="20:00"></option>
  <option value="20:15"></option>
  <option value="20:30"></option>
  <option value="20:45"></option>
  </datalist>
  <!-- HORAS LIST -->


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
                                  {{ link_To(['vacante/alta','Alta vacante','class': 'navigation-color space-nav']) }}
                                </li>
                              {% endif %}
                            {% if acceso.verificar(38,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['vacante/relacionvacante_index','Relación vacante','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
                            {% if acceso.verificar(27,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['cita/general_index','Citas','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
                   
                            {% if acceso.verificar(26,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['vacante/referencias_index','Referencias','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
                          
                            {% if acceso.verificar(43,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['psicometria/general_index','Psicometría','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
                          
                          
                             {% if acceso.verificar(45,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['vacante/autorizacion_index','Autorización','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
                            {% if acceso.verificar(46,rol_id)==1 %}
                              <li class="has-submenu">
                                {{ link_To(['vacante/entrevista_index','Entrevista','class': 'navigation-color space-nav']) }}
                              </li>
                            {% endif %}
           <!-- <li class="has-submenu"> -->
                              {% if acceso.verificar(51,rol_id)==1 %}
                                <li class="has-submenu" >
                                  <a href="#"  class="navigation-color space-nav">Reportes<i class="arrow-down"></i></a>
                                  <ul class="submenu" style="height: auto">
                                    {% if acceso.verificar(76,rol_id)==1 %}
                                      <li >{{ link_To(['consulta/index','Consulta expediente ']) }}</li>
                                    {% endif %}
                                    {% if acceso.verificar(77,rol_id)==1 %}
                                      <li >{{ link_To(['consulta/index_vac','Consulta vacante']) }}</li>
                                    {% endif %}
                                    {% if acceso.verificar(91,rol_id)==1 %}
                                      <li >{{ link_To(['reporte/facturacion_index','Facturación']) }}</li>
                                    {% endif %}
                                    </ul>                          
                                </li>
                              {% endif %}
                                <!-- <li class="has-submenu"> -->
                              {% if acceso.verificar(13,rol_id)==1 %}
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
                                      {% if acceso.verificar(11,rol_id)==1 %}
                                        <li>{{ link_To(['negocio/index','Grupo de negocio']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(16,rol_id)==1 %}
                                        <li>{{ link_To(['ocupacion/index','Ocupación']) }}</li>
                                      {% endif %}
                                      {# {% if acceso.verificar(17,rol_id)==1 %}
                                        <li>{{ link_To(['catvacante/index','Vacantes']) }}</li>
                                      {% endif %} #}
                                      {% if acceso.verificar(18,rol_id)==1 %}
                                        <li>{{ link_To(['tipovacante/index','Tipo de vacantes']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(21,rol_id)==1 %}
                                        <li>{{ link_To(['tipoempleo/index','Tipo de empleo']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(22,rol_id)==1 %}
                                        <li>{{ link_To(['generacion/index','Tipo de generación']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(74,rol_id)==1 %}
                                        <li>{{ link_To(['tipopago/index','Tipo pago']) }}</li>
                                      {% endif %}
                                   
                                      {% if acceso.verificar(23,rol_id)==1 %}
                                        <li>{{ link_To(['estadocivil/index','Estado civil']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(24,rol_id)==1 %}
                                        <li>{{ link_To(['sexo/index','Sexo']) }}</li>
                                      {% endif %}
                                    
                                      {% if acceso.verificar(25,rol_id)==1 %}
                                        <li>{{ link_To(['gradoescolar/index','Grado escolar']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(49,rol_id)==1 %}
                                        <li>{{ link_To(['prestacion/index','Prestaciones vacante']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(82,rol_id)==1 %}
                                        <li>{{ link_To(['medio/index','Medio']) }}</li>
                                      {% endif %}
                                      {% if acceso.verificar(19,rol_id)==1 %}
                                      <li class="has-submenu">
                                        <a href="#">Configuración <div class="arrow-down"></div> </a>
                                        <ul class="submenu">

                                        {% if acceso.verificar(20,rol_id)==1 %}
                                            <li>{{ link_To(['configuracion/apariencia_index','Colores del sistema']) }}</li>
                                        {% endif %}
                                        {% if acceso.verificar(97,rol_id)==1 %}
                                            <li>{{ link_To(['configuracion/correos_index','Envio de correo']) }}</li>
                                        {% endif %}
                                     
                                         </ul>

                                      </li>

                                     {% endif %}
                                     
                                       
                                    </ul>                          
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
              {# includes helper#}
              {% include "/helper/complementos/includes_general.volt" %}
              {# includes helper#}

            </div>

          </div>
        </div>

       
</div>
{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>  

<div id="hide-me" class="loading" style="z-index: 9999;">Loading...</div>

<!-- <div class="loader-page"></div> -->

