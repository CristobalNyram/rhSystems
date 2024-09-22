{{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
{{ stylesheet_link('css/validaciones/color.css') }}
{{ stylesheet_link('css/alertify.min.css') }}
{{ stylesheet_link('css/nom.css') }}
{{ javascript_include('js/alertify.min.js') }}
<title>Cuestionario uno</title>

<link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />

<style>
	div.group{display:inline-block;
    color:#5E5E5E;
	padding-left: 30px;
		font-style: oblique;
	}
	

	button {
	  text-decoration: none;
	  display: inline-block;
	  padding: 8px 16px;
	}

	button:hover {
	  background-color: #ddd;
	  color: black;
	}

	.previous {
	  background-color: #f1f1f1;
	  color: black;
	  border-radius: 80px;
	  outline: none;
	}
		.previous:active {
	  outline: none;
	}

	.next {
	  background-color: #4CAF50;
	  color: white;
	  border-radius: 80px;
	  outline: none;
	}
	
		.next:active {
	  outline: none;
	}
	
	.info {
	  background-color:#4BB3FF;
	  color: white;
	  border-radius: 80px;
		outline: none;
	}
	
	.info:active {
		outline: none;
	}

	.round {
	  border-radius: 50%;
	}

	td {
	  padding-bottom:20px;
    padding-left: 35px;
	}
</style>
{{ javascript_include('js/jquery.min.js') }}
{{ javascript_include('js/bootstrap.min.js') }}
<script type="text/javascript">
	// $(function (){
		function validarfolio(){
	      // divListado = document.getElementById('cen_idasignar');
	      folio=document.getElementById("folio").value;
	      urlfolio="<?php echo $this->url->get('cuestionariouno/revisarfolio/') ?>";
	      urlfolio=urlfolio+folio;
	      // centro="";
	      $.ajax({
	        type: "POST",
	        url: urlfolio,
	        data: folio,
	        success: function(res)
	        {
	          if(res[0]<=0)
	          {
	            alertify.alert("Error",res[1]);
	          }
	          else
	          {
	            // cargarlista();
	            alertify.alert("Éxito","Puedes continuar", function(){ 
	              // location.reload();
	            });
	          }
	          // $form.find("button").prop("disabled", false); 
	        },
	        error: function(res)
	        { 
	          // $form.find("button").prop("disabled", false); 
	        }
	      });
	    };
    // });
    $(document).ready(function() {
    	document.getElementById('seccion2').style.display = 'none';
    	document.getElementById('seccion3').style.display = 'none';
    	document.getElementById('seccion4').style.display = 'none';
    	document.getElementById('previous').style.display = 'none';
    	document.getElementById('enviar').style.display = 'none';
    });

    function validacion(tipo){
    	bandera=0;
    	
    	var uno=$("input[name=1]:checked").val();
    	var dos=$("input[name=2]:checked").val();
    	var tres=$("input[name=3]:checked").val();
    	var cuatro=$("input[name=4]:checked").val();
    	var cinco=$("input[name=5]:checked").val();
    	var seis=$("input[name=6]:checked").val();

    	if(tipo==1){
    		var total=2;
	    	if(typeof uno != 'undefined' && typeof dos != 'undefined' && typeof tres != 'undefined' && typeof cuatro != 'undefined' && typeof cinco != 'undefined' && typeof seis != 'undefined'){
	    		total=1;
	    		if(uno==0 && dos==0 && tres==0 && cuatro==0 && cinco==0 && seis==0){
	    			//si total es 0 no es necesario continuar con el cuestionario
		    		total=0;
		    	}
	    	}
	    	
	    }
	    if(tipo==2){
	    	var total=2;
	    	if(typeof uno != 'undefined' && typeof dos != 'undefined' && typeof tres != 'undefined' && typeof cuatro != 'undefined' && typeof cinco != 'undefined' && typeof seis != 'undefined'){
	    		total=1;
	    		if(uno==0 && dos==0 && tres==0 && cuatro==0 && cinco==0 && seis==0){
	    			//si total es 0 no es necesario continuar con el cuestionario
		    		total=0;
		    	}else{
		    		contador=0;
		    		for (var i = 7; i <= 20; i++) {
		    			valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							contador++;
						}
					}
					if(contador==0){
						total=0;
					}
		    	}
	    	}
	    }

	    return total;
    	
    }

    function forzarrequired(){
    	for (var i = 7; i <= 20; i++) {
    		$("#"+i+"").prop('required',true);
    	}
    	
    }

    function quitarrequired(){
    	for (var i = 7; i <= 20; i++) {
    		$("#"+i+"").prop('required',false);
    	}
    	
    }

    function mostrar(){
    	document.getElementById('seccion1').style.display = 'none';
    	document.getElementById('seccion2').style.display = 'block';
    	document.getElementById('seccion3').style.display = 'block';
    	document.getElementById('seccion4').style.display = 'block';
    	document.getElementById('previous').style.display = 'block';
    	document.getElementById('next').style.display = 'none';
    	document.getElementById('enviar').style.display = 'block';
    }

    function ocultar(){
    	document.getElementById('seccion1').style.display = 'block';
    	document.getElementById('seccion2').style.display = 'none';
    	document.getElementById('seccion3').style.display = 'none';
    	document.getElementById('seccion4').style.display = 'none';
    	document.getElementById('previous').style.display = 'none';
    	document.getElementById('next').style.display = 'block';
    	document.getElementById('enviar').style.display = 'none';
    }

    function validarpre(){
    	// alert('hola');
    	ocultar();
    	total= validacion(1);
        

        return false;
    }

    function validarsig(){
        total= validacion(1);
        if(total==1){
        	forzarrequired();
        	mostrar();
        	// enviar();
        }
        if(total==0){
        	quitarrequired();
        	//si es 0 no necesita continuar con la encuesta aquí termina
        	ocultar();
        	enviarform();
        }
        console.log(total);
        return false;
    }

    function enviarform(){
    	var bandera = validacion(2);
    	if(bandera==0){
    		/* Act on the event */
			var $form = $(this);
			var urlcrear="<?php echo $this->url->get('cuestionariouno/guardar/') ?>";
			var redireccionar="<?php echo $this->url->get('principal/gracias2/') ?>";
			var errorredireccion="<?php echo $this->url->get('principal/index/') ?>";
			$form.find("button").prop("disabled", true);
			$.ajax({
			type: "POST",
			url: urlcrear,
			data: $("#cuestionariouno").serialize(),
			success: function(res)
			{
			  if(res[0]<=0)
			  {
			    alertify.alert("Error",res[1], function(){ 
				document.getElementById("cuestionariouno").reset();
			      window.location=errorredireccion;
			    });
			  }
			  else
			  {
			    // cargarlista();
			    alertify.alert("Éxito","Datos guardados correctamente.", function(){ 
				document.getElementById("cuestionariouno").reset();
			      window.location=redireccionar;
			    });
			  }
			  $form.find("button").prop("disabled", false); 
			},
			error: function(res)
			{ 
			  $form.find("button").prop("disabled", false); 
			}
			});
			return false;
    		// alert('formulario enviado');
    	}
    	// console.log(bandera);
    	return false;
    	// alert('formulario enviado');
    }
</script>
<div class="x_title_2">
	<div class="container text-center">
		<div class="col-sm-2" style="margin-top: 25px;">
			{{ image("assets/images/config/"~logoactual, "height": "50") }}
		</div>
	 	<div class="col-sm-10">
			<h1>Cuestionario para identificar a los trabajadores que fueron sujetos a acontecimientos traumáticos severos</h1>
	 	</div>
	</div>
 </div>

<div class="tab-content colorback">
  <div id="id-1" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                	<form id="cuestionariouno" name="cuestionariouno"  class="data-parsley-validate"  onsubmit="return false;">
                		<div id="seccion1" class="cardcuestionario">
                			<label><input type="hidden" id="folio" name="folio" onblur="validarfolio();" value="<?php echo $_GET['folio'] ?>" required ></label>
		            		<h3 class="suntitulo">I.- Acontecimiento traumático severo</h3>
		            		<label>¿Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimiento como los siguientes:</label><br><br>
		            		<table>
            					<tr>
									<td>
										<label for="fname">¿Accidente que tenga como consecuencia la muerte, la pérdida de un miembro o una lesión grave?</label><br>
										<div class="group">
											<label><input type="radio" name="1" value="1" required > Si</label><br>
											<label><input type="radio" name="1" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">¿Asaltos?</label><br>
										<div class="group">
											<label><input type="radio" name="2" value="1" required > Si</label><br>
											<label><input type="radio" name="2" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Actos violentos que derivaron en lesiones graves?</label><br>
										<div class="group">
											<label><input type="radio" name="3" value="1" required > Si</label><br>
											<label><input type="radio" name="3" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Secuestro?</label><br>
										<div class="group">
											<label><input type="radio" name="4" value="1" required > Si</label><br>
											<label><input type="radio" name="4" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Amenazas?, o</label><br>
										<div class="group">
											<label><input type="radio" name="5" value="1" required > Si</label><br>
											<label><input type="radio" name="5" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Cualquier otro que ponga en riesgo su vida o salud, y/o la de otras personas?</label><br>
										<div class="group">
											<label><input type="radio" name="6" value="1" required > Si</label><br>
											<label><input type="radio" name="6" value="0"> No</label>
										</div>
									</td>
								</tr>
							</table>
							
						</div>
						<div id="seccion2" class="cardcuestionario">
							<h3 class="suntitulo">II.- Recuerdos persistentes sobre el acontecimiento (durante el último mes):</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">¿Ha tenido recuerdos recurrentes sobre el acontecimiento que le provocan malestares?</label><br>
										<div class="group">
											<label><input type="radio" name="7" id="7" value="1"> Si</label><br>
											<label><input type="radio" name="7" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha tenido sueños de carácter recurrente sobre el acontecimiento, que le producen malestar?</label><br>
										<div class="group">
											<label><input type="radio" name="8" id="8" value="1"> Si</label><br>
											<label><input type="radio" name="8" value="0"> No</label>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<div id="seccion3" class="cardcuestionario">
							<h3 class="suntitulo">III.-  Esfuerzo  por  evitar  circunstancias  parecidas  o  asociadas  al  acontecimiento  (durante  el último mes):</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">¿Se ha esforzado por evitar todo tipo de sentimientos, conversaciones o situaciones que le puedan recordar el acontecimiento?</label><br>
										<div class="group">
											<label><input type="radio" name="9" id="9" value="1"> Si</label><br>
											<label><input type="radio" name="9" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Se ha esforzado por evitar todo tipo de actividades, lugares o personas que motivan recuerdos del acontecimiento?</label><br>
										<div class="group">
											<label><input type="radio" name="10" id="10" value="1"> Si</label><br>
											<label><input type="radio" name="10" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha tenido dificultad para recordar alguna parte importante del evento?</label><br>
										<div class="group">
											<label><input type="radio" name="11" id="11" value="1"> Si</label><br>
											<label><input type="radio" name="11" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha disminuido su interés en sus actividades cotidianas?</label><br>
										<div class="group">
											<label><input type="radio" name="12" id="12" value="1"> Si</label><br>
											<label><input type="radio" name="12" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Se ha sentido usted alejado o distante de los demás?</label><br>
										<div class="group">
											<label><input type="radio" name="13" id="13" value="1"> Si</label><br>
											<label><input type="radio" name="13" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha notado que tiene dificultad para expresar sus sentimientos?</label><br>
										<div class="group">
											<label><input type="radio" name="14" id="14" value="1"> Si</label><br>
											<label><input type="radio" name="14" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha tenido la impresión de que su vida se va a acortar, que va a morir antes que otras personas o que tiene un futuro limitado?</label><br>
										<div class="group">
											<label><input type="radio" name="15" id="15" value="1"> Si</label><br>
											<label><input type="radio" name="15" value="0"> No</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion4" class="cardcuestionario">
							<h3 class="suntitulo">IV Afectación (durante el último mes)</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">¿Ha tenido usted dificultades para dormir?</label><br>
										<div class="group">
											<label><input type="radio" name="16" id="16" value="1"> Si</label><br>
											<label><input type="radio" name="16" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha estado particularmente irritable o le han dado arranques de coraje?</label><br>
										<div class="group">
											<label><input type="radio" name="17" id="17" value="1"> Si</label><br>
											<label><input type="radio" name="17" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha tenido dificultad para concentrarse?</label><br>
										<div class="group">
											<label><input type="radio" name="18" id="18" value="1"> Si</label><br>
											<label><input type="radio" name="18" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Ha estado nervioso o constantemente en alerta?</label><br>
										<div class="group">
											<label><input type="radio" name="19" id="19" value="1"> Si</label><br>
											<label><input type="radio" name="19" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">¿Se ha sobresaltado fácilmente por cualquier cosa?</label><br>
										<div class="group">
											<label><input type="radio" name="20" id="20" value="1"> Si</label><br>
											<label><input type="radio" name="20" value="0"> No</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<!-- <a type="submit" onclick="validarpre();" class="previous">&laquo; Anterior</a> -->
						<!-- <a type="submit" onclick="validarsig();" class="next">Siguiente &raquo;</a> -->
						<table class="container row">
							<br>
            				<tr>
								<td class="col-sm-4">
									<button type="submit" id='previous' onclick="validarpre();" class="previous btn btn-block">&laquo; Anterior</button>
								</td>
								<td class="col-sm-4">
									<button type="submit" id="next" onclick="validarsig();" class="next btn btn-block btn-success">Siguiente &raquo;</button>
								</td>
								<td class="col-sm-4">
									<button type="submit" id="enviar" onsubmit="return true;" onclick="enviarform();" class="info btn btn-block btn-info">Enviar</button>
								</td>
								<td>
							</tr>
						</table>
					</form> 
                 
                            
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
<script type="text/javascript">
	
</script>