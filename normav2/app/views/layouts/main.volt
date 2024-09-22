{% include "/layouts/js-funciones-generales.volt" %}

        <!-- Begin page -->
        <div id="wrapper">
                        <!-- Navigation Bar-->
                        <header id="topnav">
                            <!-- Topbar Start -->
                            <div class="navbar-custom navbar-custom-crm">
                                <div class="container-fluid">
                                    <ul class="list-unstyled topnav-menu float-right mb-0">

                                        <li class="dropdown notification-list ">
                                            <!-- Mobile menu toggle-->
                                            <a class="navbar-toggle nav-link navigation-color">
                                                <div class="lines">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </a>
                                            <!-- End mobile menu toggle-->
                                        </li>

                                        <li class="dropdown notification-list">
                                            <a class="nav-link dropdown-toggle nav-user mr-0 " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            
                                            {{ image("assets/images/users/" ~ fotoadmin,"alt":"user-image" ,"class": "rounded-circle") }}  
                                                <span class="pro-user-name d-none d-xl-inline-block ml-2 navigation-color">
                                                        Hola, <b>{{ nombreadmin }} </b>  <i class="mdi mdi-chevron-down"></i>
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                                <!-- item-->
                                               
                                                        {{link_To(['usuario/perfil','class':'dropdown-item notify-item','<i class="mdi mdi-account-outline"></i> <span>Perfil</span>'])}}

                                                <!-- item-->
                                                <div class="dropdown-divider"></div>
                                                {{ link_To(['session/end','class':'dropdown-item notify-item','<i class="mdi mdi-logout-variant"></i> <span> Cerrar Sesión</span>']) }}

                                            </div>
                                        </li>

                                    </ul>

                                    <!-- LOGO -->
                                    <div class="logo-box">

                                        
                                        <a href="#" class="logo text-center">
                                            <span class="logo-lg ">
                                                {{ link_to('cuestionario/activarfolio', image("assets/images/config/"~logoactual,"height": "50",'class':'mt-2')) }}

                                                    <!-- <img src="assets/images/small/logo_white.svg" alt="" height="36"> -->
                                                    <!-- <span class="logo-lg-text-light">Simple</span> -->
                                            </span>
                                            <span class="logo-sm">

                                                <!-- <span class="logo-sm-text-dark">S</span> -->
                                                    <!-- <img src="assets/images/small/logo_sm.svg" alt="" height="36"> -->
                                                   {# {{image('assets/images/small/logo_white.svg','height':'36')}} #}                 
                                            </span>
                                        </a>
                                    </div>

                                    <div id="navigation">
                                        <!-- Navigation Menu-->
                                        <ul class="navigation-menu ">
                                        
                                            <li class="has-submenu">
                                                
                                                          <li>{{link_To(['cuestionario/activarfolio','class':'','Cuestionario'])}}</li>
                                            </li>


                                        
                            
                            <!--modulo de reportes-->
                            <li class="has-submenu">
                                                <a href="#"  class="navigation-color space-nav">Reportes <i class="arrow-down"></i></a>
                                                    <ul class="submenu ">
                                                

                                                    <li class="has-submenu">
                                                        <ul>
                                                        <a href="#"> <i class="mdi mdi-download"></i > Descargar <div class="arrow-down"></div></a>
                                                        </ul>
                                                        <ul class="submenu">
                                                     {% for cuestionario in estadoCuestionariosDescarga %}
                                                                     {% if cuestionario['estado']==1 %}
                                                                     <ul>


                                                                     {{ link_To(["cuestionario"~cuestionario['prefijo']~"/respuesta",'class':'dropdown-item notify-item','<i class="mdi mdi-file-download"></i> <span>Respuesta: '~cuestionario['nombreMinusculas']~'</span>']) }}
                                                                            {% if cuestionario['prefijo']=='clima' %}
                                                                                     {{ link_To(["cuestionario"~cuestionario['prefijo']~"/formato",'class':'dropdown-item notify-item','<i class="mdi mdi-file-download"></i> <span>Formato de: '~cuestionario['nombreMinusculas']~'</span>']) }}
                                                                            {% endif %}
                                                                    </ul>
                                                                     {% endif %}

                                                                     

    
                                                    {% endfor %}

                                                        </ul>
                                                    </li>
                                                    <li class="has-submenu">
                                                        <ul>
                                                            {{ link_To(['reporte/avancecuestionario','class':'dropdown-item notify-item','<i class="mdi mdi-file-chart"></i> <span>Avance de cuestionario</span>']) }}

                                                        </ul>
                                                    </li>
                                                    <li class="has-submenu">
                                                        <ul>
                                                            {{ link_To(['reporte/avancepordiacuestionario','class':'dropdown-item notify-item','<i class="mdi mdi-calendar"></i> <span>Avance por fecha cuestionario</span>']) }}

                                                        </ul>
                                                    </li>

                                                    <li class="has-submenu">
                                                        <a href="#"> <i class="mdi mdi-chart-bar"></i > Respuestas  <div class="arrow-down"></div></a>
                                                        <ul class="submenu">                                                    
                                        {% for cuestionario in estadoCuestionariosDescarga %}
                                        
                                                            {% if cuestionario['estado']==1 %}
                                                                   {% if cuestionario['prefijo']=='uno' %}
                                                                            <ul>
                                                                            {{ link_To(["reporte/respuestascuestionariouno",'class':'dropdown-item notify-item','<i class="mdi mdi-progress-check"></i> <span>Repuestas de cuestionario 1 NOM-35</span>']) }}                  
                                                                            </ul>
                                                                   {% endif %}
                                            
                                                                   {% if cuestionario['prefijo']=='dos' %}
                                                                        <ul>
                                                                            {{ link_To(["reporte/respuestascuestionariodosvista",'class':'dropdown-item notify-item','<i class="mdi mdi-file-excel-box"></i> Descargable de cuestionario 2 NOM-35</span> ']) }}                  
                                                                        </ul>
                                                                   {% endif %}

                                                                   {% if cuestionario['prefijo']=='tres' %}
                                                                        <ul>
                                                                            {{ link_To(["reporte/respuestascuestionariotresvista",'class':'dropdown-item notify-item','<i class="mdi mdi-file-excel-box"></i> Descargable de cuestionario 3 NOM-35</span> ']) }}                  
                                                                        </ul>
                                                                   {% endif %}

                                                            {% endif %}                                                            

                                           {% endfor %}
                                                        </ul>
                                                        

                                                             
                                                    </li>


                                                </ul>
                                            </li>
                              <!--FIN modulo reportes-->





                                            <!--  modulo de configuración     -->
                                            <li class="has-submenu">
                                                <a href="#"  class="navigation-color  space-nav">Configuración <i class="arrow-down"></i></a>
                                                <ul class="submenu">

                                                          <li>{{link_To(['configuracion/cuestionarioactivacion','<i class="mdi mdi-text-subject"></i > Cuestionarios activos'])}}</li>
                                                          <li>{{link_To(['configuracion/logo','<i class="mdi mdi-image"></i > Logo de sistema'])}}</li>
                                                          <li>{{link_To(['configuracion/fechacuestionario',' <i class="mdi mdi-calendar-range"></i> <span>Fechas de cuestionario</span> '])}}</li>
                                                         
                                                          <li class="has-submenu">
                                                            <a href="#"> <i class="mdi mdi-file-cad-box"></i > Anuncios <div class="arrow-down"></div></a>
                                                            <ul class="submenu">
                                                            
                                                                {{ link_To(['configuracion/anunciobienvenida','class':'dropdown-item ','<i class="mdi mdi-file-cad-box"></i> <span>Bienvenida</span>']) }}
                                                                {{ link_To(['configuracion/anunciogracias1','class':'dropdown-item ','<i class="mdi  mdi-file-cad-box"></i> <span>Gracias 1</span>']) }}
                                                                {{ link_To(['configuracion/anunciogracias2','class':'dropdown-item ','<i class="mdi  mdi-file-cad-box"></i> <span>Gracias 2</span>']) }}
                                                                {{ link_To(['configuracion/anunciotextover/6','class':'dropdown-item ','<i class="mdi  mdi-file-cad-box"></i> <span>Registro</span>']) }}

                                                            </ul>
                                                        </li>
                                                          
                                                    

                                                </ul>
                                            </li>
                                        


                                        <!-- End navigation menu -->

                                        <div class="clearfix"></div>
                                    </div>
                                    <!-- end #navigation -->

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <!-- end Topbar -->
                        </header>
                        <!-- End Navigation Bar-->

         <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

            <div class="content-page" style="background-color:#E0E0E0">
                <div class="content">
                    {{ flash.output() }}
                    {{ content() }}
  
                </div>        
               
            </div>
        
        <!-- *****************************
            END content-page
        *********************************** -->



             <!-- Footer Start -->
             <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                           2020 &copy; Todos los Derechos Reservados. <a href="">SIPS RH</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->



        </div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div> 