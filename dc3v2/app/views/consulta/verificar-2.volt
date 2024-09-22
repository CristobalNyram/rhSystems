<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />

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
	<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LeaWNAUAAAAACzUHJkA9wWdpdUr9P5Oaf74TXeW'
        });
      };
    </script>
	


	{{ javascript_include('js/jquery.min.js') }}
	{{ javascript_include('js/nprogress.js') }}
	{{ javascript_include('js/alertify.min.js') }}

	<script type="text/javascript">
		var id=1;
		$(function (){
			$("#frm_buscar").submit(function(event) 
			{
				var response = grecaptcha.getResponse();

				if(response.length == 0){
					alert('No ha habilitado el reCAPTCHA');
					return false;
				}
				/* Act on the event */
				var $form = $(this);
				var urlcrear="<?php echo $this->url->get('consulta/buscar/') ?>";
				$form.find("button").prop("disabled", true);
				$.ajax({
					type: "POST",
					url: urlcrear,
					data: $("#frm_buscar").serialize(),
					success: function(res)
					{
						if(res[0]<=0)
						{
							alertify.alert("Error",res[1]);
						}
						if(res[0]==1)
						{
							$(".valido").empty();
							var datos='';
							if(res[1]==1)
							{
								datos='<h3 id="consulta'+id+'"style="color:green; font-family:montserrat; font-size:200%; text-align:center;">El documento DC3 es válido con la siguiente información</h3><br>';
							}
							else
							{
								datos='<h3 id="consulta'+id+'"style="color:green; font-family:montserrat; font-size:200%; text-align:center;">El Diploma es válido con la siguiente información</h3><br>';
							}
							
							$(".valido").append(datos);
							var nombre='<h1 style=" color:black; font-family:montserrat; font-size:180%; text-align:center;">Trabajador: '+res[2]+'... '+res[3]+'... '+res[4]+'...</label><br>';
							$(".valido").append(nombre);
							var curso='<h1 style=" color:black; font-family:montserrat; font-size:180%; text-align:center;">Curso: '+res[5]+'</label>';
							$(".valido").append(curso);
							var periodo='<h1 style=" color:black; font-family:montserrat; font-size:180%; text-align:center;">En el periodo: De '+res[6]+' a '+res[7]+'</label>';
							$(".valido").append(periodo);
					     	$('html,body').animate({
				            scrollTop: $("#consulta"+id).offset().top},
				            'slow');
				            id++;
					   
					    }
					    if(res[0]==2)
						{
							$(".valido").empty();
							var datos='<h4 id="consulta'+id+'"style="color:red; font-family:montserrat; font-size:200%;">No se ha encontrado registro con la información proporcionada</h4>';
							$(".valido").append(datos);
							$('html,body').animate({
				            scrollTop: $("#consulta"+id).offset().top},
				            'slow');
				            id++;
					     	
					    }
					    grecaptcha.reset();
					    $form.find("button").prop("disabled", false); 
					  },
					  error: function(res)
					  { 
					  	$form.find("button").prop("disabled", false); 
					  }
					});
				return false;
			});
		});
	</script>
</head>
<body  class="nav-md">
	<div class="tab-content">
		<div id="id-1" class="tab-pane fade in active">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12 col-sm-offset-4">
					<div id="formulario-largo" class="x_panel margin-top shadow">
						<div class="x_title">
							<h3>Verificación de folios</h3>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<div>
										<form id="frm_buscar" data-parsley-validate class="captura form-horizontal form-label-left">
											<div class="ln_solid"></div>
											<div class="row ">
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Folio</label>
														<input type="text" name="folio" id="folio" class="form-control" placeholder="Folio" required="true">
													</div>
												</div>
											</div>
											<div class="row ">
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Fecha</label>
														<input type="date" name="fecha" id="fecha" class="form-control" placeholder="Fecha" required="true">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Tipo de documento</label>
														<div class="controls">
															<select name="tipo" id="tipo" class="js-example-basic-multiple form-control">
																<option value="1">DC3</option>
																<option value="2">Diploma</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<center><div id="html_element"></div></center>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<div class="row">
													<div class="col-xs-4">
														<button type="submit" class="btn-block btn-btnempresa submit ">Buscar</button>
													</div>	
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id='resultado' class="x_panel margin-top shadow">
						<div class='valido'>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer style="position:fixed;bottom:0;right:0">
		<div class="copyright-info">
			<p class="pull-right">© 2019 SIPS v.1 - 2019
			</p>
		</div>
		<div class="clearfix"></div>
	</footer>

	{{ javascript_include('js/bootstrap.min.js') }}
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
</body>

</html>