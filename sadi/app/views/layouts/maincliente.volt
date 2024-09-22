{{ stylesheet_link('css/validaciones/color.css') }}
<!-- chart js -->
{{ javascript_include('js/chartjs/chart.min.js') }}
<script type="text/javascript">
  $(document).ready(function(){
    $('input[type=text]:not(.data-not-lt-active)').attr("data-lt-active", "true");
  });
  $(window).on('load', function () {
    $('#hide-me').fadeOut("slow");       
  });
  $( document ).ajaxStart(function() {
    $('#hide-me').css('display', 'block');
  });
  $(document).ajaxStop(function(){ 
    $('#hide-me').fadeOut("slow");
  });
</script>
<style type="text/css">
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
    color: red;
  }
  .polvencida a {
    color: red;
  }
  .polvencida6 {
    background-color: rgba(226, 99, 99, 0.3)!important;
    color: red;
    font-weight: bold;
  }
</style>
 {% include "/layouts/funciones-generales-js.volt" %}
 {% include "/layouts/verificar-sesion-js-cliente.volt" %}

 <!-- estilos personalizados desde la bd -->
 <?= $this->assets->outputCss() ?>
 <!-- estilos personalizados desde la bd -->
<div id="wrapper">
  <header id="topnav">
    <div class="navbar-custom navbar-custom-crm">
      <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
          <li class="dropdown notification-list ">
            <a class="navbar-toggle nav-link navigation-color">
              <div class="lines">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </a>
          </li>
          <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              {{ image("assets/images/users/avatar-1.jpg", "alt": "user-image", "class": "rounded-circle") }}
              <span class="pro-user-name d-none d-xl-inline-block ml-2 navigation-color">
                Hola, <b>{{ nombreadmin }}</b>  <i class="mdi mdi-chevron-down"></i>
              </span>
            </a>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <ul class="dropdown-menu dropdown-menu-right">
                  <div class="dropdown-divider"></div>
                  {{ link_To(['session/end_cliente','class': 'dropdown-item','<i class="mdi mdi-logout-variant"></i><span> Salir</span>']) }}
                </ul>
              </li>
            </ul>
          </li>
        </ul>
        <div class="logo-box">
          <a class="logo text-center">
            <span class="logo-lg">
              {{ image("assets/images/small/logo_white.svg", "alt": " ", "height": "36") }}
            </span>
            <span class="logo-sm">
              {{ image("assets/images/small/logo_sm.svg", "alt": " ", "height": "36") }}
            </span>
          </a>
        </div>
        <div id="navigation">
          <ul class="navigation-menu">
            <li class="has-submenu">
              {{ link_To(['cliente/asiginv_index','Asignar investigador','class': 'navigation-color space-nav']) }}
            </li>
            <li class="has-submenu">
              {{ link_To(['cliente/trafico_index','Tráfico','class': 'navigation-color space-nav']) }}
            </li>
            <li class="has-submenu">
              {{ link_To(['cliente/agenda_index','Agenda','class': 'navigation-color space-nav']) }}
            </li>
            <li class="has-submenu">
              {{ link_To(['cliente/traficoanalista_index','Tráfico analista','class': 'navigation-color space-nav']) }}
            </li>
            <li class="has-submenu">
              {{ link_To(['cliente/historial_index','Historial','class': 'navigation-color space-nav']) }}
            </li>
          </ul>
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