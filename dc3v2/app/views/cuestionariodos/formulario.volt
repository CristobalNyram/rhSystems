{{ stylesheet_link('css/validaciones/color.css') }}
{{ stylesheet_link('css/alertify.min.css') }}
{{ javascript_include('js/alertify.min.js') }}
<style>
	div.group{display:inline-block;}

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
	}

	.next {
	  background-color: #4CAF50;
	  color: white;
	}

	.round {
	  border-radius: 50%;
	}

	td {
	  padding-bottom:20px;
	}
</style>
{{ javascript_include('js/jquery.min.js') }}
<script type="text/javascript">
	$seccion=1;
    $(document).ready(function() {
    	document.getElementById('seccion2').style.display = 'none';
    	document.getElementById('seccion3').style.display = 'none';
    	document.getElementById('seccion4').style.display = 'none';
    	document.getElementById('seccion5').style.display = 'none';
    	document.getElementById('seccion6').style.display = 'none';
    	document.getElementById('seccion7').style.display = 'none';
    	document.getElementById('validacliente1').style.display = 'none';
    	document.getElementById('validacliente2').style.display = 'none';
    	document.getElementById('validacliente3').style.display = 'none';
    	document.getElementById('validatrabajador1').style.display = 'none';
    	document.getElementById('validatrabajador2').style.display = 'none';
    	document.getElementById('validatrabajador3').style.display = 'none';
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
		    	forzarrequired(41,43);
		    	document.getElementById('validacliente1').style.display = 'block';
		    	document.getElementById('validacliente2').style.display = 'block';
		    	document.getElementById('validacliente3').style.display = 'block';

		    }else{
		    	quitarrequired(41,43);
		    	document.getElementById('validacliente1').style.display = 'none';
		    	document.getElementById('validacliente2').style.display = 'none';
		    	document.getElementById('validacliente3').style.display = 'none';
		    }
		});

		$('input[type=radio][name=trabajadores]').change(function() {
		    valor=$("input[name=trabajadores]:checked").val();
		    if(valor==1){
		    	forzarrequired(44,46);
		    	document.getElementById('validatrabajador1').style.display = 'block';
		    	document.getElementById('validatrabajador2').style.display = 'block';
		    	document.getElementById('validatrabajador3').style.display = 'block';

		    }else{
		    	quitarrequired(44,46);
		    	document.getElementById('validatrabajador1').style.display = 'none';
		    	document.getElementById('validatrabajador2').style.display = 'none';
		    	document.getElementById('validatrabajador3').style.display = 'none';
		    }
		});
    });

    function validacion(){
    	//total =0 puede avanzar, si encuentra que falta contestar una pregunta total =1
    	var total=0;
    		switch ($seccion) {
				case 1:
					for (var i = 1; i <= 9; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 2:
					for (var i = 10; i <= 13; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 3:
					for (var i = 14; i <= 17; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 4:
					for (var i = 18; i <= 22; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 5:
					for (var i = 23; i <= 27; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 6:
					for (var i = 28; i <= 40; i++) {
						valor=$("input[name="+i+"]:checked").val();
						if(typeof valor == 'undefined'){
							total=1;
						}
					}
					break;
				case 7:
					for (var i = 1; i <= 40; i++) {
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
							for (var i = 41; i <= 43; i++) {
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
							for (var i = 44; i <= 46; i++) {
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
    		/* Act on the event */
			var $form = $(this);
			var urlcrear="<?php echo $this->url->get('cuestionariodos/guardar/') ?>";
			$form.find("button").prop("disabled", true);
			$.ajax({
			type: "POST",
			url: urlcrear,
			data: $("#cuestionariodos").serialize(),
			success: function(res)
			{
			  if(res[0]<=0)
			  {
			    alertify.alert("Error",res[1]);
			  }
			  else
			  {
			    // cargarlista();
			    alertify.alert("Éxito","Datos guardados correctamente. Tu folio es: "+res[2], function(){ 
			      location.reload();
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
<div class="tab-content">
  <div id="id-1" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          <div class="x_title">
            <h1>Guia de referencia 2</h1>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                	<form id="cuestionariodos" name="cuestionariodos"  class="data-parsley-validate"  onsubmit="return false;">
                		<div id="seccion1">
		            		<h3>Para responder las preguntas siguientes considere las condiciones de su centro de trabajo, así como la cantidad y ritmo de trabajo.</h3>
		            		<table>
            					<tr>
									<td>
										<label for="fname">1.- Mi trabajo me exige hacer mucho esfuerzo físico</label>
									<br>
										<div class="group">
											<label><input type="radio" name="1" value="4" required checked>Siempre</label> <br>
											<label><input type="radio" name="1" value="3">Casi siempre </label><br>
											<label><input type="radio" name="1" value="2">Algunas veces </label><br>
											<label><input type="radio" name="1" value="1">Casi nunca </label><br>
											<label><input type="radio" name="1" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">2.- Me preocupa sufrir un accidente en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="2" value="4" required checked>Siempre</label> <br>
											<label><input type="radio" name="2" value="3">Casi siempre </label><br>
											<label><input type="radio" name="2" value="2">Algunas veces </label><br>
											<label><input type="radio" name="2" value="1">Casi nunca</label> <br>
											<label><input type="radio" name="2" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3.- Considero que las actividades que realizo son peligrosas</label>
									<br>
										<div class="group">
											<label><input type="radio" name="3" value="4" required checked>Siempre </label><br>
											<label><input type="radio" name="3" value="3">Casi siempre </label><br>
											<label><input type="radio" name="3" value="2">Algunas veces </label><br>
											<label><input type="radio" name="3" value="1">Casi nunca</label> <br>
											<label><input type="radio" name="3" value="0">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">4.- Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno</label>
									<br>
										<div class="group">
											<label><input type="radio" name="4" value="4" required checked>Siempre </label><br>
											<label><input type="radio" name="4" value="3">Casi siempre </label><br>
											<label><input type="radio" name="4" value="2">Algunas veces </label><br>
											<label><input type="radio" name="4" value="1">Casi nunca </label><br>
											<label><input type="radio" name="4" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">5.- Por la cantidad de trabajo que tengo debo trabajar sin parar</label>
									<br>
										<div class="group">
											<label><input type="radio" name="5" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="5" value="3">Casi siempre</label><br>
											<label><input type="radio" name="5" value="2">Algunas veces</label><br>
											<label><input type="radio" name="5" value="1">Casi nunca</label><br>
											<label><input type="radio" name="5" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">6.- Considero que es necesario mantener un ritmo de trabajo acelerado</label>
									<br>
										<div class="group">
											<label><input type="radio" name="6" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="6" value="3">Casi siempre</label><br>
											<label><input type="radio" name="6" value="2">Algunas veces</label><br>
											<label><input type="radio" name="6" value="1">Casi nunca</label><br>
											<label><input type="radio" name="6" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">7.- Mi trabajo exige que esté muy concentrado</label>
									<br>
										<div class="group">
											<label><input type="radio" name="7" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="7" value="3">Casi siempre</label><br>
											<label><input type="radio" name="7" value="2">Algunas veces</label><br>
											<label><input type="radio" name="7" value="1">Casi nunca</label><br>
											<label><input type="radio" name="7" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">8.- Mi trabajo requiere que memorice mucha información</label>
									<br>
										<div class="group">
											<label><input type="radio" name="8" value="4" required >Siempre</label><br>
											<label><input type="radio" name="8" value="3">Casi siempre</label><br>
											<label><input type="radio" name="8" value="2">Algunas veces</label><br>
											<label><input type="radio" name="8" value="1">Casi nunca</label><br>
											<label><input type="radio" name="8" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">9.- Mi trabajo exige que atienda varios asuntos al mismo tiempo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="9" value="4" required >Siempre</label><br>
											<label><input type="radio" name="9" value="3">Casi siempre</label><br>
											<label><input type="radio" name="9" value="2">Algunas veces</label><br>
											<label><input type="radio" name="9" value="1">Casi nunca</label><br>
											<label><input type="radio" name="9" value="0">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion2">
							<h3>Las preguntas siguientes están relacionadas con las actividades que realiza en su trabajo y las responsabilidades que tiene.</h3>
							<table>
            					<tr>
									<td>
										<label for="fname">10.- En mi trabajo soy responsable de cosas de mucho valor</label>
									<br>
										<div class="group">
											<label><input type="radio" name="10" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="10" value="3">Casi siempre</label><br>
											<label><input type="radio" name="10" value="2">Algunas veces</label><br>
											<label><input type="radio" name="10" value="1">Casi nunca</label><br>
											<label><input type="radio" name="10" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">11.- Respondo ante mi jefe por los resultados de toda mi área de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="11" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="11" value="3">Casi siempre</label><br>
											<label><input type="radio" name="11" value="2">Algunas veces</label><br>
											<label><input type="radio" name="11" value="1">Casi nunca</label><br>
											<label><input type="radio" name="11" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">12.- En mi trabajo me dan órdenes contradictorias</label>
									<br>
										<div class="group">
											<label><input type="radio" name="12" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="12" value="3">Casi siempre</label><br>
											<label><input type="radio" name="12" value="2">Algunas veces</label><br>
											<label><input type="radio" name="12" value="1">Casi nunca</label><br>
											<label><input type="radio" name="12" value="0">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">13.- Considero que en mi trabajo me piden hacer cosas innecesarias</label>
									<br>
										<div class="group">
											<label><input type="radio" name="13" value="4" required >Siempre</label><br>
											<label><input type="radio" name="13" value="3">Casi siempre</label><br>
											<label><input type="radio" name="13" value="2">Algunas veces</label><br>
											<label><input type="radio" name="13" value="1">Casi nunca</label><br>
											<label><input type="radio" name="13" value="0">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion3">
							<h3>Las preguntas siguientes están relacionadas con el tiempo destinado a su trabajo y sus responsabilidades familiares.</h3>
							<table>
            					<tr>
									<td>
										<label for="fname">14.- Trabajo horas extras más de tres veces a la semana</label>
									<br>
										<div class="group">
											<label><input type="radio" name="14" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="14" value="3">Casi siempre</label><br>
											<label><input type="radio" name="14" value="2">Algunas veces</label><br>
											<label><input type="radio" name="14" value="1">Casi nunca</label><br>
											<label><input type="radio" name="14" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">15.- Mi trabajo me exige laborar en días de descanso, festivos o fines de semana</label>
									<br>
										<div class="group">
											<label><input type="radio" name="15" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="15" value="3">Casi siempre</label><br>
											<label><input type="radio" name="15" value="2">Algunas veces</label><br>
											<label><input type="radio" name="15" value="1">Casi nunca</label><br>
											<label><input type="radio" name="15" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">16.- Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales</label>
									<br>
										<div class="group">
											<label><input type="radio" name="16" value="4" required checked>Siempre </label><br>
											<label><input type="radio" name="16" value="3">Casi siempre</label><br>
											<label><input type="radio" name="16" value="2">Algunas veces</label><br>
											<label><input type="radio" name="16" value="1">Casi nunca</label><br>
											<label><input type="radio" name="16" value="0">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">17.- Pienso en las actividades familiares o personales cuando estoy en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="17" value="4" required >Siempre</label><br>
											<label><input type="radio" name="17" value="3">Casi siempre</label><br>
											<label><input type="radio" name="17" value="2">Algunas veces</label><br>
											<label><input type="radio" name="17" value="1">Casi nunca</label><br>
											<label><input type="radio" name="17" value="0">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion4">
							<h3>Las preguntas siguientes están relacionadas con las decisiones que puede tomar en su trabajo</h3>
							<table>
            					<tr>
									<td>
										<label for="fname">18.- Mi trabajo permite que desarrolle nuevas habilidades</label>
									<br>
										<div class="group">
											<label><input type="radio" name="18" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="18" value="1">Casi siempre</label><br>
											<label><input type="radio" name="18" value="2">Algunas veces</label><br>
											<label><input type="radio" name="18" value="3">Casi nunca</label><br>
											<label><input type="radio" name="18" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">19.- En mi trabajo puedo aspirar a un mejor puesto</label>
									<br>
										<div class="group">
											<label><input type="radio" name="19" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="19" value="1">Casi siempre</label><br>
											<label><input type="radio" name="19" value="2">Algunas veces</label><br>
											<label><input type="radio" name="19" value="3">Casi nunca</label><br>
											<label><input type="radio" name="19" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">20.- Durante mi jornada de trabajo puedo tomar pausas cuando las necesito</label>
									<br>
										<div class="group">
											<label><input type="radio" name="20" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="20" value="1">Casi siempre</label><br>
											<label><input type="radio" name="20" value="2">Algunas veces</label><br>
											<label><input type="radio" name="20" value="3">Casi nunca</label><br>
											<label><input type="radio" name="20" value="4">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">21.- Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="21" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="21" value="1">Casi siempre</label><br>
											<label><input type="radio" name="21" value="2">Algunas veces</label><br>
											<label><input type="radio" name="21" value="3">Casi nunca</label><br>
											<label><input type="radio" name="21" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">22.- Puedo cambiar el orden de las actividades que realizo en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="22" value="0" required >Siempre</label><br>
											<label><input type="radio" name="22" value="1">Casi siempre</label><br>
											<label><input type="radio" name="22" value="2">Algunas veces</label><br>
											<label><input type="radio" name="22" value="3">Casi nunca</label><br>
											<label><input type="radio" name="22" value="4">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion5">
							<h3>Las  preguntas  siguientes  están  relacionadas  con  la  capacitación  e  información  que  recibe  sobre  su trabajo.</h3>
							<table>
            					<tr>
									<td>
										<label for="fname">23.- Me informan con claridad cuáles son mis funciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="23" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="23" value="1">Casi siempre</label><br>
											<label><input type="radio" name="23" value="2">Algunas veces</label><br>
											<label><input type="radio" name="23" value="3">Casi nunca</label><br>
											<label><input type="radio" name="23" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">24.- Me explican claramente los resultados que debo obtener en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="24" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="24" value="1">Casi siempre</label><br>
											<label><input type="radio" name="24" value="2">Algunas veces</label><br>
											<label><input type="radio" name="24" value="3">Casi nunca</label><br>
											<label><input type="radio" name="24" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">25.- Me informan con quién puedo resolver problemas o asuntos de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="25" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="25" value="1">Casi siempre</label><br>
											<label><input type="radio" name="25" value="2">Algunas veces</label><br>
											<label><input type="radio" name="25" value="3">Casi nunca</label><br>
											<label><input type="radio" name="25" value="4">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">26.- Me permiten asistir a capacitaciones relacionadas con mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="26" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="26" value="1">Casi siempre</label><br>
											<label><input type="radio" name="26" value="2">Algunas veces</label><br>
											<label><input type="radio" name="26" value="3">Casi nunca</label><br>
											<label><input type="radio" name="26" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">27.- Recibo capacitación útil para hacer mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="27" value="0" required >Siempre</label><br>
											<label><input type="radio" name="27" value="1">Casi siempre</label><br>
											<label><input type="radio" name="27" value="2">Algunas veces</label><br>
											<label><input type="radio" name="27" value="3">Casi nunca</label><br>
											<label><input type="radio" name="27" value="4">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion6">
							<h3>Las preguntas siguientes se refieren a las relaciones con sus compañeros de trabajo y su jefe.</h3>
							<table>
            					<tr>
									<td>
										<label for="fname">28.- Mi jefe tiene en cuenta mis puntos de vista y opiniones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="28" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="28" value="1">Casi siempre</label><br>
											<label><input type="radio" name="28" value="2">Algunas veces</label><br>
											<label><input type="radio" name="28" value="3">Casi nunca</label><br>
											<label><input type="radio" name="28" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">29.- Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="29" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="29" value="1">Casi siempre</label><br>
											<label><input type="radio" name="29" value="2">Algunas veces</label><br>
											<label><input type="radio" name="29" value="3">Casi nunca</label><br>
											<label><input type="radio" name="29" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">30.- Puedo confiar en mis compañeros de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="30" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="30" value="1">Casi siempre</label><br>
											<label><input type="radio" name="30" value="2">Algunas veces</label><br>
											<label><input type="radio" name="30" value="3">Casi nunca</label><br>
											<label><input type="radio" name="30" value="4">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr>
									<td>
										<label for="lname">31.- Cuando tenemos que realizar trabajo de equipo los compañeros colaboran</label>
									<br>
										<div class="group">
											<label><input type="radio" name="31" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="31" value="1">Casi siempre</label><br>
											<label><input type="radio" name="31" value="2">Algunas veces</label><br>
											<label><input type="radio" name="31" value="3">Casi nunca</label><br>
											<label><input type="radio" name="31" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">32.- Mis compañeros de trabajo me ayudan cuando tengo dificultades</label>
									<br>
										<div class="group">
											<label><input type="radio" name="32" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="32" value="1">Casi siempre</label><br>
											<label><input type="radio" name="32" value="2">Algunas veces</label><br>
											<label><input type="radio" name="32" value="3">Casi nunca</label><br>
											<label><input type="radio" name="32" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">33.- En mi trabajo puedo expresarme libremente sin interrupciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="33" value="0" required checked>Siempre</label><br>
											<label><input type="radio" name="33" value="1">Casi siempre</label><br>
											<label><input type="radio" name="33" value="2">Algunas veces</label><br>
											<label><input type="radio" name="33" value="3">Casi nunca</label><br>
											<label><input type="radio" name="33" value="4">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">34.- Recibo críticas constantes a mi persona y/o trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="34" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="34" value="3">Casi siempre</label><br>
											<label><input type="radio" name="34" value="2">Algunas veces</label><br>
											<label><input type="radio" name="34" value="1">Casi nunca</label><br>
											<label><input type="radio" name="34" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">35.- Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="35" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="35" value="3">Casi siempre</label><br>
											<label><input type="radio" name="35" value="2">Algunas veces</label><br>
											<label><input type="radio" name="35" value="1">Casi nunca</label><br>
											<label><input type="radio" name="35" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">36.- Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones</label>
									<br>
										<div class="group">
											<label><input type="radio" name="36" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="36" value="3">Casi siempre</label><br>
											<label><input type="radio" name="36" value="2">Algunas veces</label><br>
											<label><input type="radio" name="36" value="1">Casi nunca</label><br>
											<label><input type="radio" name="36" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">37.- Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador</label>
									<br>
										<div class="group">
											<label><input type="radio" name="37" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="37" value="3">Casi siempre</label><br>
											<label><input type="radio" name="37" value="2">Algunas veces</label><br>
											<label><input type="radio" name="37" value="1">Casi nunca</label><br>
											<label><input type="radio" name="37" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">38.- Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores</label>
									<br>
										<div class="group">
											<label><input type="radio" name="38" value="4" required checked>Siempre </label><br>
											<label><input type="radio" name="38" value="3">Casi siempre</label><br>
											<label><input type="radio" name="38" value="2">Algunas veces</label><br>
											<label><input type="radio" name="38" value="1">Casi nunca</label><br>
											<label><input type="radio" name="38" value="0">Nunca</label><br>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">39.- Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="39" value="4" required checked>Siempre</label><br>
											<label><input type="radio" name="39" value="3">Casi siempre</label><br>
											<label><input type="radio" name="39" value="2">Algunas veces</label><br>
											<label><input type="radio" name="39" value="1">Casi nunca</label><br>
											<label><input type="radio" name="39" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">40.- He presenciado actos de violencia en mi centro de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="40" value="4" required >Siempre</label><br>
											<label><input type="radio" name="40" value="3">Casi siempre</label><br>
											<label><input type="radio" name="40" value="2">Algunas veces</label><br>
											<label><input type="radio" name="40" value="1">Casi nunca</label><br>
											<label><input type="radio" name="40" value="0">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion7">
		            		<h3>Las preguntas siguientes están relacionadas con la atención a clientes y usuarios.</h3>
		            		<table>
            					<tr>
									<td>
										<label for="fname">En mi trabajo debo brindar servicio a clientes o usuarios:</label>
									<br>
										<div class="group">
											<label><input type="radio" name="clientes" value="1" required >Si</label><br>
											<label><input type="radio" name="clientes" value="0">No</label>
										</div>
									</td>
								</tr>
								<tr id="validacliente1">
									<td>
										<label for="fname">41.- Atiendo clientes o usuarios muy enojados</label>
									<br>
										<div class="group">
											<label><input type="radio" name="41" value="4" id="41">Siempre</label><br>
											<label><input type="radio" name="41" value="3">Casi siempre</label><br>
											<label><input type="radio" name="41" value="2">Algunas veces</label><br>
											<label><input type="radio" name="41" value="1">Casi nunca</label><br>
											<label><input type="radio" name="41" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validacliente2">
									<td>
										<label for="lname">42.- Mi trabajo me exige atender personas muy necesitadas de ayuda o enfermas</label>
									<br>
										<div class="group">
											<label><input type="radio" name="42" value="4" id="42">Siempre</label><br>
											<label><input type="radio" name="42" value="3">Casi siempre</label><br>
											<label><input type="radio" name="42" value="2">Algunas veces</label><br>
											<label><input type="radio" name="42" value="1">Casi nunca</label><br>
											<label><input type="radio" name="42" value="0">Nunca</label>
										</div>
									</td>
								</tr>
        						<tr id="validacliente3">
									<td>
										<label for="lname">43.- Para hacer mi trabajo debo demostrar sentimientos distintos a los míos</label>
									<br>
										<div class="group">
											<label><input type="radio" name="43" value="4" id="43">Siempre</label><br>
											<label><input type="radio" name="43" value="3">Casi siempre</label><br>
											<label><input type="radio" name="43" value="2">Algunas veces</label><br>
											<label><input type="radio" name="43" value="1">Casi nunca</label><br>
											<label><input type="radio" name="43" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>
										<label for="lname">Soy jefe de otros trabajadores:</label>
									<br>
										<div class="group">
											<label><input type="radio" name="trabajadores" value="1" required >Si</label><br>
											<label><input type="radio" name="trabajadores" value="0">No</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador1">
									<td>
										<label for="lname">44.- Comunican tarde los asuntos de trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="44" value="4" id="44">Siempre</label><br>
											<label><input type="radio" name="44" value="3">Casi siempre</label><br>
											<label><input type="radio" name="44" value="2">Algunas veces</label><br>
											<label><input type="radio" name="44" value="1">Casi nunca</label><br>
											<label><input type="radio" name="44" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador2">
									<td>
										<label for="lname">45.- Dificultan el logro de los resultados del trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="45" value="4" id="45">Siempre</label><br>
											<label><input type="radio" name="45" value="3">Casi siempre</label><br>
											<label><input type="radio" name="45" value="2">Algunas veces</label><br>
											<label><input type="radio" name="45" value="1">Casi nunca</label><br>
											<label><input type="radio" name="45" value="0">Nunca</label>
										</div>
									</td>
								</tr>
								<tr id="validatrabajador3">
									<td>
										<label for="lname">46.- Ignoran las sugerencias para mejorar su trabajo</label>
									<br>
										<div class="group">
											<label><input type="radio" name="46" value="4" id="46">Siempre</label><br>
											<label><input type="radio" name="46" value="3">Casi siempre</label><br>
											<label><input type="radio" name="46" value="2">Algunas veces</label><br>
											<label><input type="radio" name="46" value="1">Casi nunca</label><br>
											<label><input type="radio" name="46" value="0">Nunca</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<!-- <a type="submit" onclick="validarpre();" class="previous">&laquo; Anterior</a> -->
						<!-- <a type="submit" onclick="validarsig();" class="next">Siguiente &raquo;</a> -->
						<table>
            				<tr>
								<td>
									<button type="submit" id='previous' onclick="validarpre();" class="previous">&laquo; Anterior</button>
								</td>
								<td>
									<button type="submit" id="next" onclick="validarsig();" class="next">Siguiente &raquo;</button>
								</td>
								<td>
									<button type="submit" id="enviar" onsubmit="return true;" onclick="enviarform();" formaction="/send_data.php" class="next">Enviar</button>
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

<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
{{ javascript_include('js/validaciones/pais/validaciones.js') }}