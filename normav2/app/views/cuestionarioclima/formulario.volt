<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{url('assets/favicon.svg')}}" />
    {{ stylesheet_link('bootstrap/css/bootstrap.min.css') }}
    {{ stylesheet_link('css/validaciones/color.css') }}
    {{ stylesheet_link('css/alertify.min.css') }}
    {{ stylesheet_link('css/nom.css') }}
    {{ javascript_include('js/alertify.min.js') }}

    <title>Clima laboral</title>
</head>
<body>


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

	.caja
	{
		display: block;
	}
	.media
	{
		width: 100%;
	
	}

	

	@media only screen and (min-width: 655px) {
		.caja
	{
		display: flex;
	}
	.media
	{
		width: 50%;
		display: flex;
	}
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

	


	$seccion=1;
	//con esta funcion ocultamos todas las secciones
    $(document).ready(function() 
	{
		$('#seccion2').hide();
		$('#seccion3').hide();
		$('#seccion4').hide();
		$('#seccion5').hide();
		$('#seccion6').hide();
		$('#seccion7').hide();
		$('#seccion8').hide();
		$('#seccion9').hide();
		$('#seccion10').hide();
		$('#seccion11').hide();
		$('#seccion12').hide();
		$('#seccion13').hide();
		$('#seccion14').hide();
		$('#seccion15').hide();
		$('#seccion16').hide();
		$('#enviar').hide();
		$('#previous').hide();
		/*
		document.getElementById('seccioncomment53').style.display = 'none';
		document.getElementById('comment53').style.display = 'none';
		*/
		document.getElementById('26').style.display = 'none';
		document.getElementById('Seccioncomment26').style.display = 'none';

		



		
		
		
		
    });

	document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=radio]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });


	$(function (){
		/*
		//pregunta
		$('input[type=radio][name=52]').change(function() {
			valor=$("input[name=52]:checked").val();
		    if(valor>=4){
				document.getElementById('seccioncomment53').style.display = 'block';
				document.getElementById('comment53').style.display = 'block';

		    }
			else{
				document.getElementById('seccioncomment53').style.display = 'none';
				document.getElementById('comment53').style.display = 'none';


			}
		}
		)
		*/

		//pregunta 25
		$('input[type=radio][name=25]').change(function() {
			valor=$("input[name=25]:checked").val();
		    if(valor<=3){
				forzarrequiredUno('26');
				document.getElementById('Seccioncomment26').style.display = 'block';
				document.getElementById('26').style.display = 'block';

		    }
			else{
				document.getElementById('Seccioncomment26').style.display = 'none';
				document.getElementById('26').style.display = 'none';


			}
		}
		)

	});
	  
	function forzarrequiredUno(id)
	{	
		$("#"+id+"").prop('required',true);
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

	function validacion(){
		var total=0;
		

		switch ($seccion) {
			

			
			case 1:
				for (var i = 1; i <= 4; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					
					}
				}
			break;


			case 2:
				for (var i = 5; i <= 8; i++) {
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
				for (var i = 23; i <= 24; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				valor25=$("input[name=25]:checked").val();
				if(typeof valor25 == 'undefined'){
						total=1;
				}
					//aqui evaluamos el text area
				if(valor25<=3)
				{
					var commentario26 =$('#26').val();
					if(commentario26==='')
					{
						alertify.alert('REQUERIDO','Debe escribir su comentario');
						

						total=1;
					}

			
				}

				valor27=$("input[name=27]:checked").val();
				if(typeof valor27 == 'undefined'){
						total=1;
				}
				

			break;

			case 7:
				for (var i = 28; i <= 32; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			
			case 8:
				for (var i = 33; i <= 36; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 9:
				for (var i = 37; i <= 40; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 10:
				for (var i = 41; i <= 43; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;
			case 11:
				for (var i = 44; i <= 46; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 12:
				for (var i = 47; i <= 50; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 13:
			
			
				
				var valorcomment53=$('#53').val();
			
						if(valorcomment53.length<=0)
						{
							alertify.alert('REQUERIDO','Debe escribir su explicación en la pregunta 2.1');
							total=1;
						}

				for (var i = 51; i <= 52; i++) {
					valor=$("input[name="+i+"]:checked").val();
				
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
					
				for (var i = 54; i <= 55; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
				
			break;

			case 14:
				for (var i = 56; i <= 59; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 15:
				for (var i = 60; i <= 61; i++) {
					valor=$("input[name="+i+"]:checked").val();
					if(typeof valor == 'undefined'){
						total=1;
					}
				}
			break;

			case 16:
				
			break;



					
		}
		return total;
	}

	function ocultar(){
    	//with this function hides every elements like secciion1 
		$('#seccion1').hide();
		$('#seccion2').hide();
		$('#seccion3').hide();
		$('#seccion4').hide();
		$('#seccion5').hide();
		$('#seccion6').hide();
		$('#seccion7').hide();
		$('#seccion8').hide();
		$('#seccion9').hide();
		$('#seccion10').hide();
		$('#seccion11').hide();
		$('#seccion12').hide();
		$('#seccion13').hide();
		$('#seccion14').hide();
		$('#seccion15').hide();
		$('#seccion16').hide();
		//buttons
    	$('#previous').hide();
    	$('#next').hide();
    	$('#enviar').hide();
    }

	function validarpre(){
    	ocultar();
    	$seccion--;
    	seccionactiva();
    }

	function seccionactiva(){
    	switch ($seccion) {
			case 1:
				$('#seccion1').show();
				$('#next').show();
				
			break;
			
			case 2:
				$('#seccion2').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 3:
				$('#seccion3').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 4:
				$('#seccion4').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 5:
				$('#seccion5').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 6:
				$('#seccion6').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 7:
				$('#seccion7').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 8:
				$('#seccion8').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 9:
				$('#seccion9').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 10:
				$('#seccion10').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 11:
				$('#seccion11').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 12:
				$('#seccion12').show();
				$('#previous').show();
				$('#next').show();	
			break;


			case 13:
				$('#seccion13').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 14:
				$('#seccion14').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 15:
				$('#seccion15').show();
				$('#previous').show();
				$('#next').show();	
			break;

			case 16:
				$('#seccion16').show();
				$('#previous').show();
				$('#next').hide();	
				$('#enviar').show();
			break;

			
		}
    }

	function validarsig()
	{
    	ocultar();

		
    	var bandera = validacion();
    	console.log(bandera);
		if(bandera==0){
    		$seccion++;
			//console.log($seccion);
    	}
    	seccionactiva();
    	return false;
    }


	function enviarform(){
    	var bandera = validacion();
    	if(bandera==0){
    		var folio=document.getElementById("folio").value;
			/* Act on the event */
			var $form = $(this);
			var urlcrear="<?php echo $this->url->get('cuestionarioclima/guardar/') ?>";
			var redireccionar="<?php echo $this->url->get('principal/gracias2/') ?>";
			redireccionar=redireccionar+"?folio="+folio;
			var errorredireccion="<?php echo $this->url->get('principal/index/') ?>";
			$form.find("button").prop("disabled", true);
			$.ajax({
			type: "POST",
			url: urlcrear,
			data: $("#cuestionariouno").serialize(),
			success: function(res)
			{
				// console.log(res);
		
				if(res[0]<=0)
			  {
			  	alertify.alert("Error",res[1], function(){ 
			      window.location=errorredireccion;
			    });
			  }
			  else
			  {
			    // cargarlista();
			 document.getElementById("cuestionariouno").reset();

			    alertify.alert("Éxito","Datos guardados correctamente.", function(){ 
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
    	return false;
    }
	

	

	
    

</script>
<div class="x_title_2">
	<div class="container text-center " style="padding-top:2rem; padding-bottom: 2rem;">
		<div class="col-sm-2" style="margin-top: 5px;">
			{{ image("assets/images/config/"~logoactual, "height": "50") }}
		</div>
	 	<div class="col-sm-10 ">
             
			<h1>Encuesta clima laboral</h1>
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


							<tr>
								<td>
									<h3 class="suntitulo"> INSTRUCCIONES</h2>
										<p class="intructions">
										
											<br>

										Por favor <strong> lee antes de responder la pregunta </strong> y contesta seleccionando la opción que represente con mayor exactitud tu sentir o percepción. <strong> Al final
										 amplía tus comentarios.</strong> Si no puedes responder alguna pregunta, déjala en blanco. <br> <br> Tus respuestas son confidenciales. 
										  Para proteger la
										  confidencialidad de los encuestados, tus respuestas serán combinadas con los resultados del resto de tus compañeros.

										</p>
								</td>
							</tr>
							<br>

                			<label><input style="display: none;" id="folio" name="folio"  value="<?php echo $_GET['folio'] ?>" required ></label>
		            		<h3 class="suntitulo">SECCIÓN 1: 
							</h3>
		            		<table>
					

            					<tr>
									<td>
										<label for="fname">1. Estoy satisfecho con mi trayectoria/carrera dentro de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="1" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="1" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="1" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="1" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="1" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="fname">2. Me siento orgulloso de pertenecer a esta Empresa</label><br>
										<div class="group">
                                            <label><input type="radio" name="2" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="2" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="2" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="2" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="2" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Me siento integrado y tomado en cuenta dentro de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="3" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="3" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="3" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="3" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="3" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Conozco la visión, misión y políticas de la Empresa</label><br>
										<div class="group">
											<label><input type="radio" name="4" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="4" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="4" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="4" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="4" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
							
						</div>
                        
						<div id="seccion2" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 2:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Cuento con las habilidades necesarias para hacer que mi trabajo muestre los resultados que la Empresa espera de mí.</label><br>
										<div class="group">
											<label><input type="radio" name="5" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="5" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="5" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="5" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="5" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. He contado desde mi ingreso con la capacitación necesaria para hacer que mi trabajo dé los resultados que la Empresa espera de mí.
                                        </label><br>
										<div class="group">
                                            <label><input type="radio" name="6" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="6" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="6" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="6" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="6" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                                <tr>
									<td>
										<label for="lname">3. Cuando entré a la Empresa, recibí en tiempo y forma adecuada la inducción por parte de la Empresa</label><br>
										<div class="group">
                                            <label><input type="radio" name="7" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="7" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="7" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="7" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="7" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                                <tr>
									<td>
										<label for="lname">4. Conozco y estoy enterado de los servicios que se ofrecen en SERCOMEX.</label><br>
										<div class="group">
                                            <label><input type="radio" name="8" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="8" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="8" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="8" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="8" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
						</div>

						<div id="seccion3" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 3:</h3>
							<br>
							<table>
            				
								<tr>
									<td>
										<label for="lname">1. Cuento con buenos  amigos dentro de la Empresa.

                                        </label><br>
										<div class="group">
                                            <label><input type="radio" name="9" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="9" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="9" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="9" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="9" value="1"> Totalmente en desacuerdo.</label>
                                        </div>
									</td>
								</tr>
                                <tr>
									<td>
										<label for="lname">2. Convivo con mis Compañeros fuera de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="10" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="10" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="10" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="10" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="10" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

								<tr>
									<td>
										<label for="lname">3. Me llevo bien con mis compañeros de área.</label><br>
										<div class="group">
                                            <label><input type="radio" name="11" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="11" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="11" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="11" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="11" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

								<tr>
									<td>
										<label for="lname">4. Existe un ambiente de trabajo armonioso y libre de enfrentamientos y conflictos entre áreas.</label><br>
										<div class="group">
                                            <label><input type="radio" name="12" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="12" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="12" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="12" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="12" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div id="seccion4" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 4:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Considero justo el salario y prestaciones que recibo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="13" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="13" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="13" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="13" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="13" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Mi percepción económica es justa respecto a lo que mi trabajo aporta a la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="14" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="14" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="14" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="14" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="14" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. La compensación económica que recibo satisface mis necesidades de acuerdo al estilo de vida que llevo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="15" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="15" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="15" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="15" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="15" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Me parece justa la manera en cómo están balanceadas las compensaciones en la empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="16" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="16" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="16" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="16" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="16" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

							</table>
						</div>

                        <div id="seccion5" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 5:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Como Colaborador de esta Empresa siento que me valoran.</label><br>
										<div class="group">
                                            <label><input type="radio" name="17" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="17" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="17" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="17" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="17" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Tengo claro lo que se espera de mí y del resultado de mi trabajo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="18" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="18" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="18" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="18" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="18" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Creo que todos nos enfocamos al resultado de la misma forma para alcanzar los objetivos de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="19" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="19" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="19" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="19" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="19" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Conozco los objetivos principales de mi área y su relación con los objetivos principales de la Empresa. </label><br>
										<div class="group">
                                            <label><input type="radio" name="20" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="20" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="20" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="20" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="20" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

                                <tr>
									<td>
										<label for="lname">5. Sé el valor que mi trabajo aporta a los objetivos principales de la Empresa, no solo de mi área.</label><br>
										<div class="group">
                                            <label><input type="radio" name="21" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="21" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="21" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="21" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="21" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                                <tr>
									<td>
										<label for="lname">6. Siento míos y parte de mi responsabilidad los objetivos generales de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="22" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="22" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="22" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="22" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="22" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                                




							</table>
						</div>

                        <div id="seccion6" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 6:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Recomendaría a SERCOMEX como una Empresa en donde puedes desarrollar al máximo tu potencial personal y profesional.</label><br>
										<div class="group">
                                            <label><input type="radio" name="23" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="23" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="23" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="23" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="23" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Practico los valores de la empresa y adopto la misión y visión de SERCOMEX como propios.</label><br>
										<div class="group">
                                            <label><input type="radio" name="24" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="24" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="24" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="24" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="24" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Me gustaría trabajar en SERCOMEX por muchos años más.</label><br>
										<div class="group">
                                            <label><input type="radio" name="25" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="25" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="25" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="25" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="25" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td id="Seccioncomment26">
										<label for="lname">3.1 Tu respuesta es negativa, por favor déjanos saber los motivos</label><br>
										
                                             <!-- <label><input type="radio" name="26" value="1"> Totalmente en desacuerdo.</label>  -->
											  <textarea class="form-control" rows="5" name="26" id="26"  maxlength="100"></textarea> 

									
									</td>
								</tr>

                                <tr>
									<td>
										<label for="lname">4. Creo que gran parte de mis compañeros se sienten satisfechos de trabajar en SERCOMEX.</label><br>
										<div class="group">
                                            <label><input type="radio" name="27" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="27" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="27" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="27" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="27" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                      
                                




							</table>
						</div>

                        <div id="seccion7" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 7:</h3><br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Cuando recibo instrucciones para desempeñar mis funciones, éstas son claras, precisas, concisas y oportunas. </label><br>
										<div class="group">
                                            <label><input type="radio" name="28" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="28" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="28" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="28" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="28" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Considero que las cargas de trabajo de las personas que integramos el área están bien balanceadas.</label><br>
										<div class="group">
                                            <label><input type="radio" name="29" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="29" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="29" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="29" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="29" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Mi horario de trabajo es satisfactorio.</label><br>
										<div class="group">
                                            <label><input type="radio" name="30" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="30" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="30" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="30" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="30" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Encuentro en SERCOMEX el campo fértil para lograr mi desarrollo humano y profesional</label><br>
										<div class="group">
                                            <label><input type="radio" name="31" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="31" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="31" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="31" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="31" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

                                <tr>
									<td>
										<label for="lname">5. Obtengo el  reconocimiento adecuado a los logros que realizo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="32" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="32" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="32" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="32" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="32" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
						</div>

                        <div id="seccion8" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 8:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Es fácil y eficiente ponernos de acuerdo cuando tenemos que realizar alguna meta en equipo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="33" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="33" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="33" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="33" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="33" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Existe una cooperación estrecha entre los participantes de los procesos de operación  para incrementar la eficiencia de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="34" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="34" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="34" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="34" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="34" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Se establece claramente el objetivo del equipo y la agenda para lograrlo en las reuniones que participó.</label><br>
										<div class="group">
                                            <label><input type="radio" name="35" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="35" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="35" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="35" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="35" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Mi Jefe sabe cómo coordinar y motivar al equipo de trabajo del cual  formo parte.</label><br>
										<div class="group">
                                            <label><input type="radio" name="36" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="36" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="36" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="36" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="36" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

							</table>
						</div>

                        <div id="seccion9" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 9:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Sé con exactitud quién es mi Jefe.</label><br>
										<div class="group">
                                            <label><input type="radio" name="37" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="37" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="37" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="37" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="37" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Mi Jefe da reconocimiento al trabajo bien realizado.</label><br>
										<div class="group">
                                            <label><input type="radio" name="38" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="38" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="38" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="38" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="38" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Mi Jefe favorece al máximo mi compromiso con la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="39" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="39" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="39" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="39" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="39" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Soy tratado con respeto y cordialidad por mi Jefe. </label><br>
										<div class="group">
                                            <label><input type="radio" name="40" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="40" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="40" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="40" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="40" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
				        	</table>
						</div>
                        
                        <div id="seccion10" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 10:</h3><br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Mis sugerencias e ideas son tomadas en cuenta para mejorar los procesos y métodos de trabajo en los que participo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="41" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="41" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="41" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="41" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="41" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Me adapto al cambio con facilidad y estoy dispuesto al logro más eficaz de objetivos.</label><br>
										<div class="group">
                                            <label><input type="radio" name="42" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="42" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="42" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="42" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="42" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Contamos con las herramientas tecnológicas adecuada para la realización el logro de nuestras metas en forma óptima.</label><br>
										<div class="group">
                                            <label><input type="radio" name="43" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="43" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="43" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="43" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="43" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
						</div>		
                        
                        
                        <div id="seccion11" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 11:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Confío en la capacidad de la Dirección para guiar y tomar las decisiones necesarias a fin de asegurar el futuro exitoso de la Empresa.</label><br>
										<div class="group">
                                            <label><input type="radio" name="44" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="44" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="44" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="44" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="44" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Cuando la Dirección dice algo, se pude estar seguro de que es verdad.</label><br>
										<div class="group">
                                            <label><input type="radio" name="45" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="45" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="45" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="45" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="45" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Mi Jefe me transmite la  misión, visión y valores de SERCOMEX en forma verbal y en su conducta habitual.</label><br>
										<div class="group">
                                            <label><input type="radio" name="46" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="46" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="46" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="46" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="46" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
							</table>
						</div>

                        
                        <div id="seccion12" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 12:
                            </h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Considero que la Calidad es un valor importante y presente en mí actuar y mis resultados.</label><br>
										<div class="group">
                                            <label><input type="radio" name="47" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="47" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="47" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="47" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="47" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. La reducción de costos es  importante  en mi trabajo diario.</label><br>
										<div class="group">
                                            <label><input type="radio" name="48" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="48" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="48" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="48" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="48" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Considero que lo que hago actualmente está bien hecho y que no hay otra forma de hacerlo.</label><br>
										<div class="group">
                                            <label><input type="radio" name="49" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="49" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="49" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="49" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="49" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">4. Existen procesos de mejora continua y de verificación de la calidad de mi trabajo y de mis colaboradores.</label><br>
										<div class="group">
                                            <label><input type="radio" name="50" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="50" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="50" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="50" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="50" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
						</table>
						</div>
                        
                        <div id="seccion13" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 13:
                            </h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Sé con exactitud qué servicios  suministramos a los clientes.</label><br>
										<div class="group">
                                            <label><input type="radio" name="51" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="51" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="51" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="51" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="51" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Conozco y entiendo correctamente lo que Valoran los clientes de SERCOMEX.</label><br>
										<div class="group">
                                            <label><input type="radio" name="52" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="52" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="52" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="52" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="52" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>
								<tr>
									<td id="seccioncomment53">
										<label for="lname">2.1 Explicar.</label><br>
										
											<!-- <label><input type="radio" name="53" value="5" required >Totalmente de acuerdo.</label><br> -->
					                         <textarea class="form-control" rows="5" name="53" id="53" maxlength="100"></textarea> 

										
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">3. Tengo una cultura de cumplimiento a los compromisos contraídos con usuarios y clientes.</label><br>
										<div class="group">
                                            <label><input type="radio" name="54" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="54" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="54" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="54" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="54" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

                                <tr>
									<td>
										<label for="lname">4. Normalmente tengo la mejor disposición de atender a nuestros clientes siempre que me solicitan atención o me buscan.</label><br>
										<div class="group">
                                            <label><input type="radio" name="55" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="55" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="55" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="55" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="55" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
                         




							</table>
						</div>

                        
                        <div id="seccion14" class="cardcuestionario">
							<h3 class="suntitulo">SECCIÓN 14:</h3>
							<br>
							<table>
            					<tr>
									<td>
										<label for="lname">1. Creo que se tomarán medidas basadas en los resultados de esta encuesta.</label><br>
										<div class="group">
                                            <label><input type="radio" name="56" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="56" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="56" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="56" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="56" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">2. Tengo idea de cuáles son los planes de crecimiento de la Empresa a un año.</label><br>
										<div class="group">
                                            <label><input type="radio" name="57" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="57" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="57" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="57" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="57" value="1"> Totalmente en desacuerdo.</label>										</div>
									</td>
								</tr>

								<tr>
									<td>
										<label for="lname">3. Contamos con un proceso adecuado para la definición de la planeación estratégica de mi área.</label><br>
										<div class="group">
                                            <label><input type="radio" name="58" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="58" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="58" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="58" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="58" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

                     
								
								<tr>
									<td>
										<label for="lname">4. En general, estoy de acuerdo con las estrategias, metas y políticas de SERCOMEX.</label><br>
										<div class="group">
                                            <label><input type="radio" name="59" value="5" required >Totalmente de acuerdo.</label><br>
											<label><input type="radio" name="59" value="4" required > Parcialmente de acuerdo.</label><br>
											<label><input type="radio" name="59" value="3" required > Ni de acuerdo ni en desacuerdo.</label><br>
											<label><input type="radio" name="59" value="2" required > Parcialmente en desacuerdo.</label><br>
											<label><input type="radio" name="59" value="1"> Totalmente en desacuerdo.</label>
										</div>
									</td>
								</tr>

			

                            
							</table>
						</div>

                        <div id="seccion15" class="cardcuestionario">
							<h3 class="suntitulo">INFORMACIÓN DEMOGRÁFICA </h3>
							<br>
							<table>
                                <tr>
                                    <td>
                                        <label for="lname">
                                            Las siguientes preguntas se hacen sólo para facilitar el manejo de la información. Nos ayudan a comprender mejor cómo ven las cosas los grupos mayoritarios de Colaboradores. Por favor contesta de acuerdo a lo que se te pide:

                                        </label>
                                    </td>
                                 </tr>

            					<tr>
									<td>
										<label for="lname">Años de servicio en la Empresa:</label><br>
										<div class="group">           
											<label><input type="radio" name="60" value="3" required > Menos de un Año.</label><br>
											<label><input type="radio" name="60" value="2" required > Entre un año y tres años.</label><br>
											<label><input type="radio" name="60" value="1">Más de tres años.</label>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="lname">Edad:</label><br>
										<div class="group">
                                            <label><input type="radio" name="61" value="3" required >Menos de 25 años de edad..</label><br>
											<label><input type="radio" name="61" value="2" required > De 25 a 40 años.</label><br>
											<label><input type="radio" name="61" value="1" required > De 40 en adelante.</label><br>
										</div>
									</td>
								</tr>
                                
								               
							</table>
						</div>

                        <div id="seccion16" class="cardcuestionario">
							<h3 class="suntitulo">COMENTARIOS ABIERTOS </h3>
							<br>
							<table>
                                <tr>
                                    <td>
                                        <label for="">
                                            Si deseas agregar algún comentario, por favor escríbelo en el espacio de abajo.Tus comentarios se transcribirán y manejarán de manera anónima. Únicamente te pedimos identificar a qué factor corresponde, de acuerdo a la siguiente lista:
                                        </label>
                                    </td>
                                </tr>

                              
								
								<tr>
									<td>
										<div class="caja">
											<div class="media" > 
												1.- Sentido de Pertenencia
											</div>
	
											<div > 
												9. Liderazgo (relación con Jefe)


											</div>
									
										</div>
	
										<div class="caja">
											<div class="media" > 
												2.- Capacitación
											</div>
	
											<div class="" > 
												10.- Innovación y tecnología

											</div>
									
										</div>
										<div class="caja">
											<div class="media" > 
												3.- Relaciones internas
											</div>
	
											<div class="" > 
												11.- Desempeño de la  Dirección

											</div>
									
										</div>
										<div class="caja">
											<div class="media" > 
												4.- Compensación
											</div>
	
											<div class="" > 
												12.- Calidad y Productividad

											</div>
									
										</div>

										<div class="caja">
											<div class="media" > 
												5.- Compromiso
											</div>
	
											<div class="" > 
												13.- Enfoque al Cliente
											</div>
									
										</div>

										<div class="caja">
											<div class="media" > 
												6.- Identificación con la Empresa
											</div>
	
											<div class="" > 
												14.- Estrategias de la Compañía
											</div>
									
										</div>

										<div class="caja">
											<div class="media" > 
												
												7.- Trabajo en sí
											</div>
	
											<div class="" > 
												15.- Otra Categoría no enunciada											</div>
									
										</div>

										<div class="caja">
											<div class="media" > 
												
												8.- Trabajo en Equipo
											</div>
	
											<div class="" > 
											
											</div>
									
										</div>


										





										
									</td>
								</tr>
            					<tr class="">
									<td  class="">
				
										           
										<textarea class="form-control" rows="5" name="62" id="62"></textarea>

										
										
									</td>
								</tr>			               
							</table>
						</div>
                        <!-- <a type="submit" onclick="validarpre();" class="previous">&laquo; Anterior</a> -->
						<!-- <a type="submit" onclick="validarsig();" class="next">Siguiente &raquo;</a> -->
						
							<br>
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


<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
{{ javascript_include('js/validaciones/jquery.validate.js') }}
{{ javascript_include('js/validaciones/additional-methods.js') }}
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
<script type="text/javascript">
	
</script>
    
</body>
</html>     