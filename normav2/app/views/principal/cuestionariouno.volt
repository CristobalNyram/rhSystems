<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Landing Page - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
   {{ get_title() }}
  {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
  {{ stylesheet_link('fonts/font-awesome/css/font-awesome.min.css') }}
  {{ stylesheet_link('css/animate.min.css') }}

  {{ stylesheet_link('css/alertify.min.css') }}
  {{ stylesheet_link('css/custom.css') }}
  {{ stylesheet_link('css/maps/jquery-jvectormap-2.0.3.css') }}
  {{ stylesheet_link('css/icheck/flat/green.css') }}
  {{ stylesheet_link('css/floatexamples.css') }}
  {{ stylesheet_link('css/diseno.css') }}
  

  {{ javascript_include('js/jquery.min.js') }}
  {{ javascript_include('js/nprogress.js') }}
  {{ javascript_include('js/alertify.min.js') }}

  

</head>

<body>
	<div class="container body">
    <div class="main_container" id="{{gcolor}}">
<div role="main">

            <div class="right_col" role="main">
            	{{ flash.output() }}

 <div class="card border-light">
    <div class="card-body">
        <h3>Guía de referencia I</h3>
        <p>

En este cuestionario te presentaremos algunas situaciones, en las cuales debes considerar si te ha sucedido en la empresa en la que laboras actualmente. 
<br>
<br>
En este cuestionario te presentaremos algunas situaciones, en las cuales debes considerar si te ha sucedido en la empresa en la que laboras actualmente. 
<br>
<br>
En este cuestionario te presentaremos algunas situaciones, en las cuales debes considerar si te ha sucedido en la empresa en la que laboras actualmente. 
<br>
<br>
En este cuestionario te presentaremos algunas situaciones, en las cuales debes considerar si te ha sucedido en la empresa en la que laboras actualmente. 
<br>
<br>

</p>
    </div>
</div>

{{ form('principal/validarcuestionariouno', 'id': 'rol_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
	<div class="ln_solid"></div>
	<div class="row ">
	  <div class="col-sm-4 col-xs-12">
	    <!-- <h5>Datos Generales</h5> -->
	  </div>
	</div>
	<div class="row ">
	  <div class="col-sm-6 col-xs-12">
	    <div class="form-group">
	      {{ form.label('folio') }}
	      {{ form.render('folio', ['class': 'form-control','required': 'true','placeholder':'Folio']) }}
		
	    </div>
	  </div>
	</div>
	
	<div class="ln_solid"></div>
	<div class="form-group">
	  <div class="row">
	    <div class="col-xs-3 pull-right">
	      <button type="submit" class="btn-block btn-btnempresa submit ">Validar</button>
	    </div>
	    <div class="col-xs-3 pull-right">
	      <a href="{{ url('principal/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
	        <li class="fa fa-times"></li> Cancelar
	      </a>
	      <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
	    </div>
	  </div>
	</div>
</form>
</div>
        </div>
        </div>
        </div>
  <!-- Bootstrap core JavaScript -->
{{ javascript_include('js/bootstrap.min.js') }}

</body>

</html>
