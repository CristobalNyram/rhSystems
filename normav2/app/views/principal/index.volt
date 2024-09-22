<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" type="image/svg+xml" href="{{url('images/favicon.svg')}}" />


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />


  {% if estadoDeCuestionarios==='NOM-ACTIVADO'  %}
  
            <title>NORMA 035</title>
  {% else %}
                 
          <title>Clima laboral</title>
  {% endif %}
 

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

<body style="font-size: 17px;">
	<div class="container body">
    <div class="main_container" id="{{gcolor}}">
      <div role="main">

            <div class="right_col" role="main">
            	{{ flash.output() }}

 <div class="card border-light">
    <div class="card-body">
			{{ link_to('cuestionario/activarfolio', image("assets/images/config/"~logoactual,"height": "50",'class':'mt-2')) }}
        <br>
        {% if estadoDeCuestionarios==='NOM-ACTIVADO'  %}
              <br>
              <center><h3>Riesgo Psicosocial en el Trabajo</h3></center>
              <center>
                <p>
                 
                Norma Oficial Mexicana 035 STPS
                <br>
                <br>
                </p>
              </center>
        {% else %}
                  <br>
                  <center><h3>  Encuesta de clima laboral

                  </h3></center>
                  <br>
          
        {% endif %}
       
    </div>
</div>
<div class="col-sm-12">
  <div class="col-sm-3">
  </div>
  <div class="col-sm-6">  
  {{ form('principal/validarcuestionario', 'id': 'rol_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
  	<div class="ln_solid"></div>
  	<div class="row ">
  	  <div class="col-sm-4 col-xs-12">
  	    <!-- <h5>Datos Generales</h5> -->
  	  </div>
  	</div>
  	<div class="row ">
  	  <div class="col-sm-12 col-xs-12">
  	    <div class="form-group" style="color:white">
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
  	      <a href="{{ url('principal/index2clima') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
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
        </div>
        </div>


  <!-- Bootstrap core JavaScript -->
{{ javascript_include('js/bootstrap.min.js') }}


</body>

</html>
