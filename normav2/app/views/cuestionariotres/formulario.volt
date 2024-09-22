{{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
{{ stylesheet_link('css/validaciones/color.css') }}
{{ stylesheet_link('css/alertify.min.css') }}
{{ stylesheet_link('css/nom.css') }}
{{ javascript_include('js/alertify.min.js') }}
<title>Cuestionario tres</title>
<link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
<script>
	//variables para hacer la redireccion dinamica-

	



</script>


<style>
	

	div.group
	{
	display:inline-block;
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
	function validarfolio(){
      // divListado = document.getElementById('cen_idasignar');
      folio=document.getElementById("folio").value;
      urlfolio="<?php echo $this->url->get('cuestionariotres/revisarfolio/') ?>";
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
	$seccion=1;
    $(document).ready(function() {
    	document.getElementById('seccion2').style.display = 'none';
    	document.getElementById('seccion3').style.display = 'none';
    	document.getElementById('seccion4').style.display = 'none';
    	document.getElementById('seccion5').style.display = 'none';
    	document.getElementById('seccion6').style.display = 'none';
    	document.getElementById('seccion7').style.display = 'none';
    	document.getElementById('seccion8').style.display = 'none';
    	document.getElementById('seccion9').style.display = 'none';
    	document.getElementById('seccion10').style.display = 'none';
    	document.getElementById('seccion11').style.display = 'none';
    	document.getElementById('seccion12').style.display = 'none';
    	document.getElementById('seccion13').style.display = 'none';
    	document.getElementById('validacliente1').style.display = 'none';
    	document.getElementById('validacliente2').style.display = 'none';
    	document.getElementById('validacliente3').style.display = 'none';
    	document.getElementById('validacliente4').style.display = 'none';
    	document.getElementById('validatrabajador1').style.display = 'none';
    	document.getElementById('validatrabajador2').style.display = 'none';
    	document.getElementById('validatrabajador3').style.display = 'none';
    	document.getElementById('validatrabajador4').style.display = 'none';
    	document.getElementById('previous').style.display = 'none';
    	document.getElementById('enviar').style.display = 'none';
    });

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=radio]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });

    $(function (){
	    $('input[type=radio][name=clientes]').change(function() {
		    valor=$("input[name=clientes]:checked").val();
		    if(valor==1){
		    	forzarrequired(65,68);
		    	document.getElementById('validacliente1').style.display = 'block';
		    	document.getElementById('validacliente2').style.display = 'block';
		    	document.getElementById('validacliente3').style.display = 'block';
		    	document.getElementById('validacliente4').style.display = 'block';
		    }else{
		    	quitarrequired(65,68);
		    	document.getElementById('validacliente1').style.display = 'none';
		    	document.getElementById('validacliente2').style.display = 'none';
		    	document.getElementById('validacliente3').style.display = 'none';
		    	document.getElementById('validacliente4').style.display = 'none';
		    }
		});

		$('input[type=radio][name=trabajadores]').change(function() {
		    valor=$("input[name=trabajadores]:checked").val();
		    if(valor==1){
		    	forzarrequired(69,72);
		    	document.getElementById('validatrabajador1').style.display = 'block';
		    	document.getElementById('validatrabajador2').style.display = 'block';
		    	document.getElementById('validatrabajador3').style.display = 'block';
		    	document.getElementById('validatrabajador4').style.display = 'block';
		    }else{
		    	quitarrequired(69,72);
		    	document.getElementById('validatrabajador1').style.display = 'none';
		    	document.getElementById('validatrabajador2').style.display = 'none';
		    	document.getElementById('validatrabajador3').style.display = 'none';
		    	document.getElementById('validatrabajador4').style.display = 'none';
		    }
		});
    });

    function validacion(){
    	//total =0 puede avanzar, si encuentra que falta contestar una pregunta total =1
    	var total=0;
		switch ($seccion) {
			case 1:
				for (var i = 1; i <= 5; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 2:
				for (var i = 6; i <= 8; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 3:
				for (var i = 9; i <= 12; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 4:
				for (var i = 13; i <= 16; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 5:
				for (var i = 17; i <= 22; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 6:
				for (var i = 23; i <= 28; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 7:
				for (var i = 29; i <= 30; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 8:
				for (var i = 31; i <= 36; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 9:
				for (var i = 37; i <= 41; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 10:
				for (var i = 42; i <= 46; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 11:
				for (var i = 47; i <= 56; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 12:
				for (var i = 57; i <= 64; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				break;
			case 13:
				for (var i = 1; i <= 64; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						
						total=1;
						break;
					}
				}
				if(total==0){
					clientes=$("input[name=clientes]:checked").val();
					if(typeof clientes == 'undefined'){
						
						total=1;
						break;
					}
					if(clientes==1){
						for (var i = 65; i <= 68; i++) {
							valor=$("input[name="+i+"]:checked").val();
							if(typeof valor == 'undefined'){
								total=1;
								break;
							}
						}
					}
					trabajadores=$("input[name=trabajadores]:checked").val();
					if(typeof trabajadores == 'undefined'){
						total=1;
						break;
					}
					if(trabajadores==1){
						for (var i = 69; i <= 72; i++) {
							valor=$("input[name="+i+"]:checked").val();
							if(typeof valor == 'undefined'){
								total=1;
								break;
							}
						}
					}
				}
				break;
		}
    	return total;
    }

    function forzarrequired(inicio, fin){
    	for (var i = inicio; i <= fin; i++) {
    		$("#"+i+"").prop('required',true);
    	}
    }

    function quitarrequired(inicio, fin){
    	for (var i = inicio; i <= fin; i++) {
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
    	document.getElementById('seccion1').style.display = 'none';
    	document.getElementById('seccion2').style.display = 'none';
    	document.getElementById('seccion3').style.display = 'none';
    	document.getElementById('seccion4').style.display = 'none';
    	document.getElementById('seccion5').style.display = 'none';
    	document.getElementById('seccion6').style.display = 'none';
    	document.getElementById('seccion7').style.display = 'none';
    	document.getElementById('seccion8').style.display = 'none';
    	document.getElementById('seccion9').style.display = 'none';
    	document.getElementById('seccion10').style.display = 'none';
    	document.getElementById('seccion11').style.display = 'none';
    	document.getElementById('seccion12').style.display = 'none';
    	document.getElementById('seccion13').style.display = 'none';
    	document.getElementById('previous').style.display = 'none';
    	document.getElementById('next').style.display = 'none';
    	document.getElementById('enviar').style.display = 'none';
    }

    function validarpre(){
    	ocultar();
    	$seccion--;
    	seccionactiva();
    }

    function seccionactiva(){
    	switch ($seccion) {
			case 1:
				document.getElementById('seccion1').style.display = 'block';
				document.getElementById('next').style.display = 'block';
				break;
			case 2:
				document.getElementById('seccion2').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 3:
				document.getElementById('seccion3').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 4:
				document.getElementById('seccion4').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 5:
				document.getElementById('seccion5').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 6:
				document.getElementById('seccion6').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 7:
				document.getElementById('seccion7').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 8:
				document.getElementById('seccion8').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 9:
				document.getElementById('seccion9').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 10:
				document.getElementById('seccion10').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 11:
				document.getElementById('seccion11').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 12:
				document.getElementById('seccion12').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('next').style.display = 'block';
				break;
			case 13:
				document.getElementById('seccion13').style.display = 'block';
				document.getElementById('previous').style.display = 'block';
    			document.getElementById('enviar').style.display = 'block';
				break;
		}
    }

    function validarsig(){
    	ocultar();
    	var bandera = validacion();
    	if(bandera==0){
    		$seccion++;
    	}
    	seccionactiva();
        return false;
    }

    function enviarform(){
    	var bandera = validacion();
    	if(bandera==0){
    		folio=document.getElementById("folio").value;
    		/* Act on the event */
			var $form = $(this);
			var urlcrear="<?php echo $this->url->get('cuestionariotres/guardar/') ?>";
			var redireccionar="<?php echo $this->url->get('principal/gracias/') ?>";
			redireccionar=redireccionar+"?folio="+folio;


			var urlcomplete = window.location.href;
			var url=urlcomplete.split('/?');
			var urlImporntant=url[1]
			var redireccionDinamica=urlImporntant.substring(7,10);

			var redireccionarSiguiente="<?php echo $this->url->get('cuestionario"+redireccionDinamica+"/formulario/') ?>";
			redireccionarSiguiente=redireccionarSiguiente+"?folio="+folio;

			var errorredireccion="<?php echo $this->url->get('principal/index/') ?>";
			$form.find("button").prop("disabled", true);
			$.ajax({
			type: "POST",
			url: urlcrear,
			data: $("#cuestionariotres").serialize(),
			success: function(res)
			{
			  if(res[0]<=0)
			  {
			  	alertify.alert("Error",res[1], function(){ 
			      window.location=errorredireccion;
			    });
			  }
			  else
			  {
			    // cargarlista();
			    alertify.alert("Éxito","Datos guardados correctamente.", function(){ 
				
				
					if(redireccionDinamica==='nac')
					{
						document.getElementById("cuestionariotres").reset();
						
						window.location=redireccionarSiguiente;
					}
					else
					{
						document.getElementById("cuestionariotres").reset();

						window.location=redireccionar;

					}
				
				





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
    	return false;
    }

</script>
<div class="x_title_2">
	<div class="container text-center">
		<div class="col-sm-2" style="margin-top: 25px;">
			{{ image("assets/images/config/"~logoactual, "height": "50") }}

		</div>
	 	<div class="col-sm-10">
			<h1>Cuestionario para identificar los factores de riesgo psicosocial en los centros de trabajo</h1>
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
                	<form id="cuestionariotres" name="cuestionariotres"  class="data-parsley-validate"  onsubmit="return false;">
                		<div id="seccion1" class="cardcuestionario">
                			<!-- <label for="lname">Escriba su folio</label><br> -->
							<!-- <div class="group"> -->
								<label><input type="hidden" id="folio" name="folio" onblur="validarfolio();" value="<?php echo $_GET['folio'] ?>" required ></label><br>
								
							<!-- </div> -->
                			<!-- style="position:fixed" -->
		            		<h3 class="suntitulo">Para responder las preguntas siguientes considere las condiciones ambientales de su centro de trabajo.</h3>
		            		<br>
		            		<table>
            					<tr>
									<td>
										<label for="fname">1.- El espacio donde trabajo me permite realizar mis actividades de manera segura e higiénica</label>
									<br>
										<div class="group">
											<label><input type="radio" name="1" value="0" required > Siempre </label><br>
											<label><input type="radio" name="1" value="1"> Casi siempre </label><br>
											<label><input type="radio" name="1" value="2"> Algunas veces </label><br>
											<label><input type="radio" name="1" value="3"> Casi nunca </label><br>
											<label><input type="radio" name="1" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">2.- Mi trabajo me exige hacer mucho esfuerzo físico</label>
									<br>
										<div class="group">
											<label><input type="radio" name="2" value="4" required > Siempre</label><br>
											<label><input type="radio" name="2" value="3"> Casi siempre </label><br>
											<label><input type="radio" name="2" value="2"> Algunas veces </label><br>
											<label><input type="radio" name="2" value="1"> Casi nunca </label><br>
											<label><input type="radio" name="2" value="0"> Nunca
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3.- Me preocupa sufrir un accidente en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="3" value="4" required > Siempre </label><br>
											<label><input type="radio" name="3" value="3"> Casi siempre </label><br>
											<label><input type="radio" name="3" value="2"> Algunas veces </label><br>
											<label><input type="radio" name="3" value="1"> Casi nunca </label><br>
											<label><input type="radio" name="3" value="0"> Nunca </label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">4.- Considero que en mi trabajo se aplican las normas de seguridad y salud en el trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="4" value="0" required > Siempre </label><br>
											<label><input type="radio" name="4" value="1"> Casi siempre </label><br>
											<label><input type="radio" name="4" value="2"> Algunas veces </label><br>
											<label><input type="radio" name="4" value="3"> Casi nunca </label><br>
											<label><input type="radio" name="4" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">5.- Considero que las actividades que realizo son peligrosas</label>
									<br>
										<div class="group">
											<label><input type="radio" name="5" value="4" required > Siempre</label><br>
											<label><input type="radio" name="5" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="5" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="5" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="5" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
						<div id="seccion2" class="cardcuestionario">
							<h3 class="suntitulo">Para responder a las preguntas siguientes piense en la cantidad y ritmo de trabajo que tiene.</h3>
							<br>
							<table>
								<tr>
									<td>
										<label for="lname">6.- Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno</label>
									<br>
										<div class="group">
											<label><input type="radio" name="6" value="4" required > Siempre</label><br>
											<label><input type="radio" name="6" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="6" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="6" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="6" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">7.- Por la cantidad de trabajo que tengo debo trabajar sin parar</label>
									<br>
										<div class="group">
											
											<label><input type="radio" name="7" value="4" required > Siempre</label><br>
											<label><input type="radio" name="7" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="7" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="7" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="7" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">8.- Considero que es necesario mantener un ritmo de trabajo acelerado</label>
									<br>
										<div class="group">
											<label><input type="radio" name="8" value="4" required> Siempre</label><br>
											<label><input type="radio" name="8" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="8" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="8" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="8" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
						<div id="seccion3" class="cardcuestionario">
							<h3 class="suntitulo">Las preguntas siguientes están relacionadas con el esfuerzo mental que le exige su trabajo.</h3>
							<br>
							<table>
								<tr>
									<td>
										<label for="lname">9.- Mi trabajo exige que esté muy concentrado</label>
									<br>
										<div class="group">
											<label><input type="radio" name="9" value="4" required > Siempre</label><br>
											<label><input type="radio" name="9" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="9" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="9" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="9" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
            					<tr>
									<td>
										<label for="fname">10.- Mi trabajo requiere que memorice mucha información</label>
									<br>
										<div class="group">
											<label><input type="radio" name="10" value="4" required > Siempre</label><br>
											<label><input type="radio" name="10" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="10" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="10" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="10" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">11.- En mi trabajo tengo que tomar decisiones difíciles muy rápido</label>
									<br>
										<div class="group">
											<label><input type="radio" name="11" value="4" required > Siempre</label><br>
											<label><input type="radio" name="11" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="11" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="11" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="11" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">12.- Mi trabajo exige que atienda varios asuntos al mismo tiempo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="12" value="4" required > Siempre</label><br>
											<label><input type="radio" name="12" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="12" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="12" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="12" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
        						
							</table>
						</div>
						<div id="seccion4" class="cardcuestionario">
							<h3 class="suntitulo">Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene</h3>
							<br>
							<table>
								<tr>
									<td>
										<label for="lname">13.- En mi trabajo soy responsable de cosas de mucho valor</label>
									<br>
										<div class="group">
											<label><input type="radio" name="13" value="4" required > Siempre</label><br>
											<label><input type="radio" name="13" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="13" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="13" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="13" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
            					<tr>
									<td>
										<label for="fname">14.- Respondo ante mi jefe por los resultados de toda mi área de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="14" value="4" required > Siempre</label><br>
											<label><input type="radio" name="14" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="14" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="14" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="14" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">15.- En el trabajo me dan órdenes contradictorias</label>
									<br>
										<div class="group">
											<label><input type="radio" name="15" value="4" required > Siempre</label><br>
											<label><input type="radio" name="15" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="15" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="15" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="15" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">16.- Considero que en mi trabajo me piden hacer cosas innecesarias</label>
									<br>
										<div class="group">
											<label><input type="radio" name="16" value="4" required > Siempre </label><br>
											<label><input type="radio" name="16" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="16" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="16" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="16" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
        						
							</table>
						</div>
						<div id="seccion5" class="cardcuestionario">
							<h3 class="suntitulo">Las preguntas siguientes están relacionadas con su jornada de trabajo.</h3>
							<br>
							<table>
								<tr>
									<td>
										<label for="lname">17.- Trabajo horas extras más de tres veces a la semana</label>
									<br>
										<div class="group">
											<label><input type="radio" name="17" value="4" required > Siempre</label><br>
											<label><input type="radio" name="17" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="17" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="17" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="17" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
            					<tr>
									<td>
										<label for="fname">18.- Mi trabajo me exige laborar en días de descanso, festivos o fines de semana</label>
									<br>
										<div class="group">
											<label><input type="radio" name="18" value="4" required > Siempre</label><br>
											<label><input type="radio" name="18" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="18" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="18" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="18" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">19.- Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales</label>
									<br>
										<div class="group">
											<label><input type="radio" name="19" value="4" required > Siempre</label><br>
											<label><input type="radio" name="19" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="19" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="19" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="19" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">20.- Debo atender asuntos de trabajo cuando estoy en casa (No aplica si usted se encuentra trabajando desde casa por el tema de Contingencia COVID-19)</label>
									<br>
										<div class="group">
											<label><input type="radio" name="20" value="4" required > Siempre</label><br>
											<label><input type="radio" name="20" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="20" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="20" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="20" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">21.- Pienso en las actividades familiares o personales cuando estoy en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="21" value="4" required > Siempre</label><br>
											<label><input type="radio" name="21" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="21" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="21" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="21" value="0"> Nunca</label>

										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">22.- Pienso que mis responsabilidades familiares afectan mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="22" value="4" required > Siempre</label><br>
											<label><input type="radio" name="22" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="22" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="22" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="22" value="0"> Nunca</label>
										</div>
									</td>
								
							</table>
						</div>
						<div id="seccion6" class="cardcuestionario">
							<h3 class="suntitulo">Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo.</h3>
							<br>
							<table>
								</tr>
            					<tr>
									<td>
										<label for="fname">23.- Mi trabajo permite que desarrolle nuevas habilidades</label>
									<br>
										<div class="group">
											<label><input type="radio" name="23" value="0" required > Siempre</label><br>
											<label><input type="radio" name="23" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="23" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="23" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="23" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">24.- En mi trabajo puedo aspirar a un mejor puesto</label>
									<br>
										<div class="group">
											<label><input type="radio" name="24" value="0" required > Siempre</label><br>
											<label><input type="radio" name="24" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="24" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="24" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="24" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">25.- Durante mi jornada de trabajo puedo tomar pausas cuando las necesito</label>
									<br>
										<div class="group">
											<label><input type="radio" name="25" value="0" required > Siempre</label><br>
											<label><input type="radio" name="25" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="25" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="25" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="25" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">26.- Puedo decidir cuánto trabajo realizo durante la jornada laboral</label>
									<br>
										<div class="group">
											<label><input type="radio" name="26" value="0" required > Siempre</label><br>
											<label><input type="radio" name="26" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="26" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="26" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="26" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">27.- Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="27" value="0" required > Siempre</label><br>
											<label><input type="radio" name="27" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="27" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="27" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="27" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
            					<tr>
									<td>
										<label for="fname">28.- Puedo cambiar el orden de las actividades que realizo en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="28" value="0" required > Siempre</label><br>
											<label><input type="radio" name="28" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="28" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="28" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="28" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
						<div id="seccion7" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con cualquier tipo de cambio que ocurra en su trabajo (considere los últimos cambios realizados).</h3>
		            		<br>
		            		<table>
		            			<tr>
									<td>
										<label for="fname">29.- Los cambios que se presentan en mi trabajo dificultan mi labor</label>
									<br>
										<div class="group">
											<label><input type="radio" name="29" value="4" required > Siempre</label><br>
											<label><input type="radio" name="29" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="29" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="29" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="29" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">30.- Cuando se presentan cambios en mi trabajo se tienen en cuenta mis ideas o aportaciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="30" value="0" required > Siempre</label><br>
											<label><input type="radio" name="30" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="30" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="30" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="30" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion8" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con la capacitación e información que se le proporciona sobre su trabajo.</h3>
		            		<br>
		            		<table>
        						<tr>
									<td>
										<label for="lname">31.- Me informan con claridad cuáles son mis funciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="31" value="0" required > Siempre</label><br>
											<label><input type="radio" name="31" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="31" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="31" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="31" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">32.- Me explican claramente los resultados que debo obtener en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="32" value="0" required > Siempre</label><br>
											<label><input type="radio" name="32" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="32" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="32" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="32" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">33.- Me explican claramente los objetivos de mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="33" value="0" required > Siempre</label><br>
											<label><input type="radio" name="33" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="33" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="33" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="33" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">34.- Me informan con quién puedo resolver problemas o asuntos de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="34" value="0" required > Siempre</label><br>
											<label><input type="radio" name="34" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="34" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="34" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="34" value="4"> Nunca</label>
										</div>
									</td>
									
								</tr>
								<tr>
									<td>
										<label for="fname">35.- Me permiten asistir a capacitaciones relacionadas con mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="35" value="0" required > Siempre</label><br>
											<label><input type="radio" name="35" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="35" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="35" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="35" value="4"> Nunca</label>
										</div>
									</td>
									
								</tr>
								<tr>
									<td>
										<label for="fname">36.- Recibo capacitación útil para hacer mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="36" value="0" required > Siempre</label><br>
											<label><input type="radio" name="36" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="36" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="36" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="36" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion9" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con el o los jefes con quien tiene contacto.</h3>
		            		<br>
		            		<table>
								<tr>
									<td>
										<label for="fname">37.- Mi jefe ayuda a organizar mejor el trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="37" value="0" required > Siempre</label><br>
											<label><input type="radio" name="37" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="37" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="37" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="37" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">38.- Mi jefe tiene en cuenta mis puntos de vista y opiniones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="38" value="0" required > Siempre</label> <br>
											<label><input type="radio" name="38" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="38" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="38" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="38" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">39.- Mi jefe me comunica a tiempo la información relacionada con el trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="39" value="0" required > Siempre</label><br>
											<label><input type="radio" name="39" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="39" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="39" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="39" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">40.- La orientación que me da mi jefe me ayuda a realizar mejor mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="40" value="0" required > Siempre</label><br>
											<label><input type="radio" name="40" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="40" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="40" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="40" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">41.- Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="41" value="0" required> Siempre</label><br>
											<label><input type="radio" name="41" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="41" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="41" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="41" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion10" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes se refieren a las relaciones con sus compañeros.</h3>
		            		<br>
		            		<table>
								<tr>
									<td>
										<label for="lname">42.- Puedo confiar en mis compañeros de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="42" value="0" id="42" required> Siempre</label><br>
											<label><input type="radio" name="42" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="42" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="42" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="42" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">43.- Entre compañeros solucionamos los problemas de trabajo de forma respetuosa</label>
									<br>
										<div class="group">
											<label><input type="radio" name="43" value="0" id="43" required> Siempre</label><br>
											<label><input type="radio" name="43" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="43" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="43" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="43" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">44.- En mi trabajo me hacen sentir parte del grupo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="44" value="0" id="44" required> Siempre</label><br>
											<label><input type="radio" name="44" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="44" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="44" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="44" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">45.- Cuando tenemos que realizar trabajo de equipo los compañeros colaboran</label>
									<br>
										<div class="group">
											<label><input type="radio" name="45" value="0" id="45" required> Siempre</label><br>
											<label><input type="radio" name="45" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="45" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="45" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="45" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">46.- Mis compañeros de trabajo me ayudan cuando tengo dificultades</label>
									<br>
										<div class="group">
											<label><input type="radio" name="46" value="0" id="46" required> Siempre</label><br>
											<label><input type="radio" name="46" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="46" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="46" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="46" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion11" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con la información que recibe sobre su rendimiento en el trabajo, el reconocimiento, el sentido de pertenencia y la estabilidad que le ofrece su trabajo.</h3>
		            		<br>
		            		<table>
								<tr>
									<td>
										<label for="lname">47.- Me informan sobre lo que hago bien en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="47" value="0" id="47" required> Siempre</label><br>
											<label><input type="radio" name="47" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="47" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="47" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="47" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">48.- La forma como evalúan mi trabajo en mi centro de trabajo me ayuda a mejorar mi desempeño</label>
									<br>
										<div class="group">
											<label><input type="radio" name="48" value="0" id="48" required> Siempre</label><br>
											<label><input type="radio" name="48" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="48" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="48" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="48" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">49.- En mi centro de trabajo me pagan a tiempo mi salario</label>
									<br>
										<div class="group">
											<label><input type="radio" name="49" value="0" id="49" required> Siempre</label><br>
											<label><input type="radio" name="49" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="49" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="49" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="49" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">50.- El pago que recibo es el que merezco por el trabajo que realizo</label>
									<br>
										<div class="group">
											
											<label><input type="radio" name="50" value="0" id="50" required> Siempre</label><br>
											<label><input type="radio" name="50" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="50" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="50" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="50" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">51.- Si obtengo los resultados esperados en mi trabajo me recompensan o reconocen</label>
									<br>
										<div class="group">
											<label><input type="radio" name="51" value="0" id="51" required> Siempre</label><br>
											<label><input type="radio" name="51" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="51" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="51" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="51" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">52.- Las personas que hacen bien el trabajo pueden crecer laboralmente</label>
									<br>
										<div class="group">
											<label><input type="radio" name="52" value="0" id="52" required> Siempre</label><br>
											<label><input type="radio" name="52" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="52" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="52" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="52" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">53.- Considero que mi trabajo es estable</label>
									<br>
										<div class="group">
											<label><input type="radio" name="53" value="0" id="53" required>Siempre</label><br>
											<label><input type="radio" name="53" value="1">Casi siempre</label><br>
											<label><input type="radio" name="53" value="2">Algunas veces</label><br>
											<label><input type="radio" name="53" value="3">Casi nunca</label><br>
											<label><input type="radio" name="53" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">54.- En mi trabajo existe continua rotación de personal</label>
									<br>
										<div class="group">
											<label><input type="radio" name="54" value="0" id="54" required> Siempre</label><br>
											<label><input type="radio" name="54" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="54" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="54" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="54" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">55.- Siento orgullo de laborar en este centro de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="55" value="0" id="55" required> Siempre</label><br>
											<label><input type="radio" name="55" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="55" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="55" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="55" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">56.- Me siento comprometido con mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="56" value="0" id="56" required> Siempre</label><br>
											<label><input type="radio" name="56" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="56" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="56" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="56" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion12" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con actos de violencia laboral (malos tratos, acoso, hostigamiento, acoso psicológico).</h3>
		            		<br>
		            		<table>
		            			<tr>
									<td>
										<label for="fname">57.- En mi trabajo puedo expresarme libremente sin interrupciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="57" value="0" required > Siempre</label><br>
											<label><input type="radio" name="57" value="1"> Casi siempre</label><br>
											<label><input type="radio" name="57" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="57" value="3"> Casi nunca</label><br>
											<label><input type="radio" name="57" value="4"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">58.- Recibo críticas constantes a mi persona y/o trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="58" value="4" required > Siempre</label><br>
											<label><input type="radio" name="58" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="58" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="58" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="58" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">59.- Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="59" value="4" required > Siempre</label><br>
											<label><input type="radio" name="59" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="59" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="59" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="59" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">60.- Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="60" value="4" required > Siempre</label><br>
											<label><input type="radio" name="60" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="60" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="60" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="60" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">61.- Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador</label>
									<br>
										<div class="group">
											<label><input type="radio" name="61" value="4" required > Siempre</label><br>
											<label><input type="radio" name="61" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="61" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="61" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="61" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">62.- Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores</label>
									<br>
										<div class="group">
											<label><input type="radio" name="62" value="4" required > Siempre</label><br>
											<label><input type="radio" name="62" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="62" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="62" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="62" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">63.- Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="63" value="4" required > Siempre</label><br>
											<label><input type="radio" name="63" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="63" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="63" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="63" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">64.- He presenciado actos de violencia en mi centro de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="64" value="4" required > Siempre</label><br>
											<label><input type="radio" name="64" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="64" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="64" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="64" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion13" class="cardcuestionario">
		            		<h3 class="suntitulo">Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.</h3>
		            		<br>
		            		<table>
            					<tr>
									<td>
										<label for="fname">En mi trabajo debo brindar servicio a clientes o usuarios:</label>
									<br>
										<div class="group">
											<label><input type="radio" name="clientes" value="1" required > Si</label><br>
											<label><input type="radio" name="clientes" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr id="validacliente1">
									<td>
										<label for="fname">65.- Atiendo clientes o usuarios muy enojados</label>
									<br>
										<div class="group">
											<label><input type="radio" name="65" value="4" id="65"> Siempre</label><br>
											<label><input type="radio" name="65" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="65" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="65" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="65" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validacliente2">
									<td>
										<label for="lname">66.- Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas</label>
									<br>
										<div class="group">
											<label><input type="radio" name="66" value="4" id="66"> Siempre</label><br>
											<label><input type="radio" name="66" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="66" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="66" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="66" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
        						<tr id="validacliente3">
									<td>
										<label for="lname">67.- Para hacer mi trabajo debo demostrar sentimientos distintos a los míos</label>
									<br>
										<div class="group">
											<label><input type="radio" name="67" value="4" id="67"> Siempre</label><br>
											<label><input type="radio" name="67" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="67" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="67" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="67" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validacliente4">
									<td>
										<label for="lname">68.- Mi trabajo me exige atender situaciones de violencia</label>
									<br>
										<div class="group">
											<label><input type="radio" name="68" value="4" id="68"> Siempre</label><br>
											<label><input type="radio" name="68" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="68" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="68" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="68" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>
										<label for="lname">Soy jefe de otros trabajadores:</label>
									<br>
										<div class="group">
											<label><input type="radio" name="trabajadores" value="1" required > Si</label><br>
											<label><input type="radio" name="trabajadores" value="0"> No</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador1">
									<td>
										<label for="lname">69.- Comunican tarde los asuntos de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="69" value="4" id="69"> Siempre</label><br>
											<label><input type="radio" name="69" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="69" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="69" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="69" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador2">
									<td>
										<label for="lname">70.- Dificultan el logro de los resultados del trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="70" value="4" id="70"> Siempre</label><br>
											<label><input type="radio" name="70" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="70" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="70" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="70" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador3">
									<td>
										<label for="lname">71.- Cooperan poco cuando se necesita</label>
									<br>
										<div class="group">
											<label><input type="radio" name="71" value="4" id="71"> Siempre</label><br>
											<label><input type="radio" name="71" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="71" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="71" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="71" value="0"> Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador4">
									<td>
										<label for="lname">72.- Ignoran las sugerencias para mejorar su trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="72" value="4" id="72"> Siempre</label><br>
											<label><input type="radio" name="72" value="3"> Casi siempre</label><br>
											<label><input type="radio" name="72" value="2"> Algunas veces</label><br>
											<label><input type="radio" name="72" value="1"> Casi nunca</label><br>
											<label><input type="radio" name="72" value="0"> Nunca</label>
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
											<button type="submit" id="enviar" onsubmit="return true;" onclick="enviarform();" formaction="/send_data.php" class="info btn btn-block btn-info">Enviar</button>
										</td>
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

<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Nom 035</h4>
			</div>
			<div class="modal-body">
				El estrés laboral es aquél donde la creciente presión en el entorno laboral puede provocar la saturación física y/o mental del trabajador, generando diversas consecuencias que no sólo afectan la salud, sino también su entorno más próximo ya que genera un desequilibrio entre lo laboral y lo personal. El 75% de los mexicanos padece fatiga por estrés laboral, superando a países como China y Estados Unidos. (Salud en línea IMSS 2019)
				<br>
				<br>
				El 23 de octubre del 2019 entro en vigor las nuevas reglas de salud laboral para prevenir los riesgos psicosociales en el trabajo (NOM-035-STPS-2018, Factores de riesgo psicosocial en el trabajo-Identificación, análisis y prevención).
				Esta norma aplica a todas las empresas y centros de trabajo en el país, y su objetivo es identificar, analizar y prevenir los factores que puedan provocar estrés laboral en el personal, a través de los cuestionarios que encontrarás a continuación.
				Esta encuesta debe ser personal y honesta, ya que de ésta dependen las acciones y programas de prevención que tu empresa realice como resultado de la misma.
				<br><br>
				Cuestionario 2
				<br>
				<br>
				En este cuestionario encontraras algunas preguntas o situaciones, en las cuales responderás en base a la frecuencia con que has vivido las situaciones en el centro de trabajo en el que te encuentras actualmente.


			</div>
		</div>
	</div>
</div> -->

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
<!-- <script type="text/javascript">
	$(document).ready(function() {
    	$('#myModal').modal('toggle');
    });
</script> -->