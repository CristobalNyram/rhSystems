{{ stylesheet_link('css/validaciones/color.css') }}

  <!-- chart js -->
  {{ javascript_include('js/chartjs/chart.min.js') }}
  <script type="text/javascript">
    var glateralm=1
      function menulateral()
      {
        if(glateralm==1)
        {
            $(".scroll-view").addClass("left_col");
            glateralm=2;
        }
        else
        {
            $(".scroll-view").removeClass("left_col");
            glateralm=1;  
        }
      }
  </script>
<div class="container body">
    <div class="main_container" id="{{gcolor}}">
        <div class="col-md-3 left_col">
            <div class="scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="#">
                    <!-- {{ image("images/fotos/" ~ fotoadmin,"alt":"Profile Image" ,"class": "profile_pic") }} -->
                    <div>
                        <div class="user-name" style="margin-top: 10px; color: white; font-size: 15px; text-align: center; ">
                            {{ nombreadmin }} 
                            <span style="color: white; font-weight: bold; font-size: 10px; text-align: center;">{{rol}}</span>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="clearfix">

                </div>
                <!-- menu prile quick info -->
                
                <!-- /menu prile quick info -->
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="sidebar-menu main_menu_side hidden-print main_menu" >
                    <div class="menu_section">
                        <div class="profile">
                        </div>
                        <ul class="nav side-menu">
                            {{elements.getMenu(gmenu)}}
                            {% if nombreadmin=="LUIS ALFONSO" %}
                                <li class="">
                                  {{ link_To(['bitacora/index','Bitácora']) }}
                                </li>
                            {% endif %}
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                  SIPS v {{version}}  
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle" onclick="menulateral()"><i class="fa fa-bars"></i></a>
                    </div>
                    {{ image("images/recursos/"~logo, "class": "navbar-brand") }}
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <!-- {{ image("images/fotos/"~ fotoadmin) }} -->
                                <div class="user-name">
                                    {{ nombreadmin }}
                                    <span>{{rol}}</span>
                                </div>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                {% if gmenu==2 %}
                                    <li>{{link_To(['empresa/perfil','Perfil'])}}</li>
                                {% else %}
                                    <li>{{link_To(['usuario/perfil','Perfil'])}}</li>
                                {% endif %}
                                
                                <li>
                                    {{ link_To(['session/end','<i class="fa fa-sign-out pull-right"></i> Cerrar Sesión']) }}
                                </li>
                            </ul>
                        </li>
                        <!--
                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-bell-o"></i>
                              <span class="badge bg-empresa">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                              <li>
                                <a>
                                  <span class="image">
                                    <img src="images/img.jpg" alt="Profile Image" />
                                  </span>
                                  <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                  </span>
                                  <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                  </span>
                                </a>
                              </li>
                              <li>
                                <div class="text-center">
                                  <a href="inbox.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                  </a>
                                </div>
                              </li>
                            </ul>
                        </li>-->

                       
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

      <!-- page content -->

        <div role="main">

            <div class="right_col" role="main">
            {{ flash.output() }}
            {{ content() }}

            </div>
        </div>

       <!--  <footer>
            <div class="copyright-info">
                <p class="pull-right">SIPS V 1.0 2019
                </p>
            </div>
            <div class="clearfix"></div>
        </footer> -->
    </div>
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>  



{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}