<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{url('images/favicon.png')}}" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/09915e7de3.js" crossorigin="anonymous"></script>

	<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>-->
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;800;900&display=swap" rel="stylesheet">

	{{ get_title() }}
	{{ stylesheet_link('assets/bootstrap/css/bootstrap.min.css') }}
	
	{{ stylesheet_link('assets/css/all.css') }}

	{{ stylesheet_link('assets/css/magnific-popup.css') }}
	{{ stylesheet_link('assets/css/owl.carousel.min.css') }}
	{{ stylesheet_link('assets/css/style.css') }}
	{{ stylesheet_link('assets/css/flickity-docs.css') }}
	
	<script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LeaWNAUAAAAACzUHJkA9wWdpdUr9P5Oaf74TXeW'
        });
      };
    </script>
	

    {{ javascript_include('assets/js/jquery-3.3.1.min.js') }}
	
	

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
							alert("Error",res[1]);
						}
						if(res[0]==1)
						{
							$(".valido").empty();
							var datos='';
							if(res[1]==1)
							{
								datos='<h2 id="consulta'+id+'" class="mensaje"">El documento DC3 es válido con la siguiente información</h2><br>';
							}
							else
							{
								datos='<h2 id="consulta'+id+'" class="mensaje">El Diploma es válido con la siguiente información</h2><br>';
							}
							
							$(".valido").append(datos);
							var nombre='<h2><small>Trabajador: </small>'+res[2]+'... '+res[3]+'... '+res[4]+'...</h2><br>';
							$(".valido").append(nombre);
							var curso='<h2><small>Curso: </small>'+res[5]+'</h2>';
							$(".valido").append(curso);
							var periodo='<h2> <small>En el periodo: </small>De '+res[6]+' a '+res[7]+'</h2>';
							$(".valido").append(periodo);
					     	$('html,body').animate({
				            scrollTop: $("#consulta"+id).offset().top},
				            'slow');
				            id++;
					   
					    }
					    if(res[0]==2)
						{
							$(".valido").empty();
							var datos='<h2 id="consulta'+id+'" class="mensaje_negativo">No se ha encontrado registro con la información proporcionada</h2>';
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
<body data-spy="scroll" data-target=".navbar">
	<div class="ts-page-wrapper" id="page-top">
		<header id="ts-hero" class="">
			<nav class="navbar navbar_vacante navbar-expand-lg navbar-dark fixed-top ts-separate-bg-element" data-bg-color="#141a3a">
                <div class="container">
                    <a class="navbar-brand" href="https://sips.mx/index.php">
                        {{ image("assets/img/logo-w.svg", "height": "40px") }}
                    </a>
                    <!--end navbar-brand-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!--end navbar-toggler-->
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ml-auto  dropdown">
                            <a class="nav-item nav-link active ts-scroll" href="https://sips.mx/index.php">Inicio <span class="sr-only">(current)</span></a>
                            <a class="nav-item nav-link ts-scroll" href="https://sips.mx/nosotros.php">Nosotros</a>
                            <!--<a class="nav-item nav-link ts-scroll" href="https://cursos.sipscap.com/">Cursos en línea</a>-->
                         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Servicios SIPS</a>
            <ul class="dropdown-menu" style="font-size:16px;line-height: 1.8rem;">
                  <li><a class="dropdown-item" href="https://sips.mx/estudios_socioeconomicos.php"> Estudios Socioeconómicos <!--&raquo;--> </a>
                 <!--<ul class="submenu dropdown-menu">
                    <li><a class="dropdown-item" href="investigaciones_crediticias.html">Investigaciones Crediticias </a>
              </li>
                 </ul>-->
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/consultoria.php">Consultoría en Desarrollo Organizacional</a>
              </li>
                 <li><a class="dropdown-item" href="https://sips.mx/atraccion_personal.php"> Reclutamiento y Selección de Personal </a></li>
                  <li><a class="dropdown-item" href="https://sips.mx/pruebas_psicometricas.php">Pruebas Psicométricas </a></li>
                 <li><a class="dropdown-item" href="https://sips.mx/construccion.php">Asesoría en Normas Laborales </a></li>
            
              <!--<li><a class="dropdown-item" href="https://sips.mx/investigaciones_crediticias.html">Investigaciones Crediticias </a>
              </li>-->
              <!--<li><a class="dropdown-item" href="https://sips.mx/beneficios_empleados.html">Beneficios para Empleados</a></li>-->
        
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Capacitación</a>
            <ul class="dropdown-menu" style="font-size:16px;line-height: 1.8rem;">
                  <li><a class="dropdown-item" href="https://sips.mx/sips_capacitacion.php">Cursos Abiertos <!--&raquo;--> </a>
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/cursos_cerrados.php">Cursos Cerrados</a>
              </li>
                 <li><a class="dropdown-item" href="https://sipscap.com/dc3/consulta/verificar/">Verificación de Diplomas</a>
              </li>
            </ul>
        </li>
             <!--<li class="nav-item dropdown">-->
            <a class="nav-item nav-link ts-scroll" href="https://sips.mx/servicios_especializados.php">Servicios Especializados</a>
            <!--<ul class="dropdown-menu" style="font-size:16px;line-height: 1.8rem;">
                  <li><a class="dropdown-item" href="construccion.php">Reclutamiento y Selección de Personal</a>
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/construccion.php">Procesamiento de Nominas</a>
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/construccion.php">Procesos Administrativos</a>
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/construccion.php">Procesos Contables</a>
              </li>
                <li><a class="dropdown-item" href="https://sips.mx/construccion.php">Procesos de Gestión de Calidad</a>
              </li>
            </ul>-->
        </li> <a class="nav-item nav-link ts-scroll" href="https://sips.mx/vacantes_desglose.php">Vacantes</a>
                        <a class="nav-item nav-link ts-scroll" style="padding-right: 2px; padding-left:5px" href="https://www.facebook.com/SIPSRH">{{ image("assets/img/fb_logo.png", "height": "20px") }}</a>
                            <a class="nav-item nav-link ts-scroll" style="padding: 3px" href="https://www.instagram.com/sips_rh/">{{ image("assets/img/ig_logo.png", "height": "20px") }}</a>
                            <a class="nav-item nav-link ts-scroll" style="padding: 3px" href="https://twitter.com/rh_sips">{{ image("assets/img/tw_logo.png", "height": "20px") }}</a>
                            <a class="nav-item nav-link ts-scroll" style="padding: 3px" href="https://www.linkedin.com/company/sips">{{ image("assets/img/lknd_logo.png", "height": "20px") }}</a>
                        
                            <!--<a class="nav-item nav-link ts-scroll mr-2" href="#about-us">Contacto</a>-->
                            <!--<a class="ts-scroll btn btn-primary btn-sm m-1 px-3 ts-width__auto" href="#about-us">Contacto</a>-->
                        </div>
                        <!--end navbar-nav-->
                    </div>
                    <!--end collapse-->
                </div>
                <!--end container-->
            </nav>

        </header>

<section id="subscribe" class="ts-block_2 ts-separate-bg-element ts-background-repeat p-15 bg_validacion" data-bg-image-opacity=".05" data-bg-color="#ecf2fe">
	<div class="container">
		<div class="row">
			 <div class="col-sm-4 col-md-4 text-center">
	            <div class="card_2">
	                <div class="card_validacion">
						 <div class="py-3" style="margin-bottom: -25px;"><h3 class="text-center">Verificación de folios</h3></div>
						<form id="frm_buscar" data-parsley-validate class="captura form-horizontal form-label-left">
								<div class="ln_solid"></div>
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Folio</label>
											<input type="text" name="folio" id="folio" class="form-validacion" placeholder="Folio" required="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Fecha</label>
											<input type="date" name="fecha" id="fecha" class="form-validacion" placeholder="Fecha" required="true">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Tipo de documento</label>
											<div class="controls">
												<select name="tipo" id="tipo" class="js-example-basic-multiple form-validacion">
													<option value="1">DC3</option>
													<option value="2">Diploma</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row container">
									<center><div id="html_element"></div></center>
								</div>
								<div class="form-group text-center">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<button type="submit" class="ts-scroll btn btn-primary btn-sm m-1 px-3 ts-width__auto submit" style="color: #fff">Buscar</button>
											
										</div>	
									</div>
								</div>
							</form>
	                </div>
	               
	                <!--end card-footer-->
	            </div>
	            <!--end card-->
	        </div>
			 <div class="col-sm-8 col-md-8 text-center">
	            <div class="card_2">
	                <div class="card_validacion">
	                    <div id='resultado' class="">
							<div class='valido' style="padding-top: 13%;">
								<h2 id="consulta'+id+" class="mensaje">Rellene los datos en el formulario de verificación para obtener información</h2>
								
							</div>
						</div>
						
	                </div>
	               
	                <!--end card-footer-->
	            </div>
	            <!--end card-->
	        </div>
	   	 </div>
	</div>
</section>

</div>
	{{ javascript_include('assets/js/custom.hero.js') }}
	{{ javascript_include('assets/js/popper.min.js') }}
	{{ javascript_include('assets/bootstrap/js/bootstrap.min.js') }}
	{{ javascript_include('assets/js/imagesloaded.pkgd.min.js') }}
	{{ javascript_include('assets/js/isInViewport.jquery.js') }}
	{{ javascript_include('assets/js/jquery.magnific-popup.min.js') }}
	{{ javascript_include('assets/js/owl.carousel.min.js') }}

	{{ javascript_include('assets/js/scrolla.jquery.min.js') }}
	{{ javascript_include('assets/js/custom.js') }}
	{{ javascript_include('assets/js/flickity-docs.min.js') }}
	
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
</body>

</html>