{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}

{% set sesentaysiete = acceso.verificar(67,rol_id) %}



<script type="text/javascript">
	///escuchador de eventos empresa
	function fnOcultarMostrarInputsEmpresaCrearEse(eventValue,classToCleanOrShow="inputs-empresa-reculta-crear-ese") {
        let selectedValue = eventValue;
		let empresasRecluta =__ESE_EMPRESA_IDS_RECLUTA_FORMATO_;
        let elementos = document.querySelectorAll('.' + classToCleanOrShow);
        if (empresasRecluta.includes(selectedValue)) {
            elementos.forEach(function(elemento) {
                elemento.style.display = 'block';

                let inputs = elemento.getElementsByTagName('input');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].value = '';
					inputs[i].required = false;
                }
            });
        } else {
            elementos.forEach(function(elemento) {
                elemento.style.display = 'none';

                let inputs = elemento.getElementsByTagName('input');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].value = '';
					inputs[i].required = false;
                }
            });
        }
    }
	
	$(document).ready(function() {

		fnestados();
		fnempresas();
		//fntiposformatos();
	});
	function fnestados()
	{
	    var negocio="<?php echo $this->url->get('estado/ajax_estados/') ?>";
	    var $subsnegocio = $('select[name="est_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	          
	        success: function(data)
	        {
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.est_id + '">' +dat.est_nombre+'</option>';
						});

					    return options;
				  	});
				}else{
					$subsnegocio.append(function () {
					    var options = '';
					    options += '<option selected value="-1">No aplica</option>';
					    return options;
					});
				}
	        },
	        error: function(res)
	        {
	            // $("#btn_aprobar").prop("disabled", false);
	        }
	    });
	}

	function fnempresas()
	{
	    var negocio="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
	    var $subsnegocio = $('select[name="emp_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	          
	        success: function(data)
	        {
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.emp_id + '">' +dat.emp_nombre+'</option>';
						});

					    return options;
				  	});
				}else{
					$subsnegocio.append(function () {
					    var options = '';
					    options += '<option selected value="-1">No aplica</option>';
					    return options;
					});
				}
	        },
	        error: function(res)
	        {
	            // $("#btn_aprobar").prop("disabled", false);
	        }
	    });
	}

	function fntiposformatosAcordeEmpresa(){
		let emp_id = $("#emp_id").val();
		let url="<?php echo $this->url->get('tipoformato/ajax_tiposformatos_acorde_a_empresa/') ?>";
		let $subsnegocio = $('select[name="tif_id"]');
		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: url+emp_id,
			success: function(data)
			{
				
				// Agregar nuevos sub-departamentos
			if (data.length > 0) {
				if(data.length==1){
					$subsnegocio.append(function () {
					var options = '';
					$.each(data, function (key, dat) {
					options += '<option selected data-tipoestudio="'+dat.tip_id+'" data-tipoformato="'+dat.tif_id+'" value="' + dat.tif_id + '">' +dat.tif_nombre+'</option>';
					});
				    return options;
				  	});
					$('#tif_id').trigger('change');
				}else{
					$subsnegocio.append(function () {
					var options = '';
					options += '<option selected value="-1">Seleccionar</option>';
					$.each(data, function (key, dat) {
					options += '<option data-tipoestudio="'+dat.tip_id+'" data-tipoformato="'+dat.tif_id+'" value="' + dat.tif_id + '">' +dat.tif_nombre+'</option>';
					});

				    return options;

			  		});
					  $('#tif_id').trigger('change');


				}


		

			}else{
				$subsnegocio.append(function () {
				    var options = '';
				    options += '<option selected value="-1">No hay formato asignados</option>';
				    return options;

				});
				$('#tif_id').trigger('change');

			}
			},
			error: function(res)
			{
			   // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

	function fntiposformatos(){
		let negocio="<?php echo $this->url->get('tipoformato/ajax_tiposformatos/') ?>";
		let $subsnegocio = $('select[name="tif_id"]');
		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: negocio,
			success: function(data)
			{
			     // Agregar nuevos sub-departamentos
			if (data.length > 0) {
				$subsnegocio.append(function () {
					var options = '';
					options += '<option selected value="-1">Seleccionar</option>';
					$.each(data, function (key, dat) {
					options += '<option data-tipoestudio="'+dat.tip_id+'" data-tipoformato="'+dat.tif_id+'" value="' + dat.tif_id + '">' +dat.tif_nombre+'</option>';
					});

				    return options;
			  	});
			}else{
				$subsnegocio.append(function () {
				    var options = '';
				    options += '<option selected value="-1">No aplica</option>';
				    return options;
				});
			}
			},
			error: function(res)
			{
			   // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

	function fnmunicipios(editar=0){
	    if(editar==0){
	      var $estado = $("#est_id").val();
	      var $subsnegocio = $('select[name="mun_id"]');
	    }
	    else{
	      var $estado = $("#est_ideditar").val();
	      var $subsnegocio = $('select[name="mun_ideditar"]');
	    }
    	var negocio="<?php echo $this->url->get('municipio/ajax_municipios/') ?>"+$estado;
    
	    $subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: negocio,

			success: function(data)
			{
			  // Agregar nuevos sub-departamentos
			  if (data.length > 0) {
			      $subsnegocio.append(function () {
			          var options = '';
			          options += '<option selected value="-1">Seleccionar</option>';
			          $.each(data, function (key, dat) {
			            options += '<option value="' + dat.mun_id + '">' +dat.mun_nombre+'</option>';
			          });

			          return options;
			      });
			  }else{
			    $subsnegocio.append(function () {
			        var options = '';
			        options += '<option selected value="-1">No aplica</option>';
			        return options;
			    });
			  }
			},
			error: function(res)
			{
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

	$(function (){
		$("#frm_crearese").submit(function(event) 
		{	
			event.preventDefault();

		
			let password =null;
			if($("#emp_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar la empresa.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			if($("#cne_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar quien solicita.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			if($("#cen_id").val()==-2){
				Swal.fire({title:"Error",text:"Debe seleccionar el centro de costo.",type:"error"})
				.then((value) => {

				});
				return false;
			}
			if($("#tif_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el tipo de formato.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			if($("#tip_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el tipo de estudio.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			if($("#tip_id").val()==2){
				if($("#ver_id").val()==-1){
					Swal.fire({title:"Error",text:"Debe seleccionar el tipo de verificación.",type:"error"})
					.then((value) => {
					});
					return false;
				}
			}
			if($("#ese_tippersona").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el tipo de persona.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			if($("#est_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el estado.",type:"error"})
				.then((value) => {
				});
				return false;
			}
			/*
	        if($("#mun_id").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el municipio.",type:"error"})
                	.then((value) => {
					});
	         	return false;
	        }*/
			var $form = $(this);
			var urled="<?php echo $this->url->get('estudio/nuevo/') ?>";
			a=$form.valid();
			if(a==false){
				return false;
			}
			//valdiar si es ESE
			let tipo = $("#tip_id").val();
			if(tipo=='1'){
			
					let ese_aes_preg =$('#ese_aes_preg');
		

			
					if(ese_aes_preg.is(':checked')){

						let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/;
						let p1=$("#ese_aes_contrasenia").val();
			

						let valido= regex.test(p1);
									
								if(valido==false ){
									Swal.fire({title:'Aviso',text:'La nueva contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@,*,_,# por ejemplo)',type:"warning"})
												.then((value) => {

												});

									return false;
								}else{

									$('#ese_aes_contrasenia').val(SHA256($('#ese_aes_contrasenia').val()));

								}
					}


			}
		
			
	

			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled,
				data: $("#frm_crearese").serialize(),
		
				success: function(res)
				{

					
					
					if(res[0]=='0')
					{
						Swal.fire({title:"Error",text:res[1],type:"error"})
						.then((value) => {
						});
					}

					if(res[0]=='-2')
					{
						Swal.fire({title:"Advertencia",text:"El correo ya está registrado...",type:"warning"})
						.then((value) => {
						
						});
					}
					else
					{

						Swal.fire({title:res['titular'],html:res['mensaje'],type:"success"})
						.then((value) => {
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
		});
    });

	function fndatosempresa(){
		fncontactos();
		fncentros();

		fntiposformatosAcordeEmpresa();


	}

	function fncontactos(editar=0){
		if(editar==0){
			var $empresa = $("#emp_id").val();
			var $subsnegocio = $('select[name="cne_id"]');
		}
		else{
			var $empresa = $("#emp_ideditar").val();
			var $subsnegocio = $('select[name="cne_ideditar"]');
		}
		var negocio="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>"+$empresa;

		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: negocio,

			success: function(data)
			{
			  // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
							options += '<option value="' + dat.cne_id + '">' +dat.cne_nombre+' '+dat.cne_primerapellido+' '+dat.cne_segundoapellido+ '</option>';
						});

						return options;
					});
				}else{
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">No hay contactos asignados</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
				alert('Error en el servidor...');
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}
	
	function fncentros(editar=0){
		if(editar==0){
			var $empresa = $("#emp_id").val();
			var $subsnegocio = $('select[name="cen_id"]');
		}
		else{
			var $empresa = $("#emp_ideditar").val();
			var $subsnegocio = $('select[name="cen_ideditar"]');
		}
		var negocio="<?php echo $this->url->get('centrocosto/ajax_centros/') ?>"+$empresa;

		$subsnegocio.empty();
		$.ajax({
			type: "POST",
			url: negocio,

			success: function(data)
			{
			  // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-2">Seleccionar</option>';
						$.each(data, function (key, dat) {
							options += '<option value="' + dat.cen_id + '">' +dat.cen_nombre+'</option>';
						});

						return options;
					});
				}else{
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">No hay centros asignados</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

	$(document).ready(function() {
		$('#tif_id').on('change', function() {
			
			$('#contenedor_modulo_referencias_alta_estudio').hide();
			var $option = $(this).find(':selected');
			let $option_value=$option.val();

			var datotipo = $option.data('tipoestudio');
			var tipoformato = $option.data('tipoformato');

			$("#tip_id").val(datotipo);
			// You might want to do something with imageUrl here:
			// $('#uploadImage').attr('src', imageUrl);
			var tipo = $("#tip_id").val();
		
			if($option_value=='-1'){
				sinformato();
				remove_autoestudio();
			}
			
			if(tipo==1){
				tipoese();
				if(tipoformato==1){
					{% if sesentaysiete==1 %}

					autoestudio();
					{% endif %}


				}else{
					remove_autoestudio();

				}

			}
			if(tipo==2){
				tipover();
				remove_autoestudio();
			}
			if(tipo==3){
				tiponegocio();
				remove_autoestudio();

			}
			if(tipo==4){
				tiposupervivencia();
				remove_autoestudio();

			}
			if(tipo==5){
				tipoese();
				remove_autoestudio();

			}
		});	
		$('#ese_aes_preg').on('change', function() {	
			let element= $(this);

			if(element.is(':checked')){

				$("#ese_aes_correo").prop('disabled', false);
				$("#ese_aes_contrasenia").prop('disabled', false);
				let ese_aes_correo = document.getElementById("ese_aes_correo");
				ese_aes_correo.setAttribute('required','required');
				let ese_aes_contrasenia = document.getElementById("ese_aes_contrasenia");
				ese_aes_contrasenia.setAttribute('required','required');
				
				$('.group-inputs-aes').show('slow');
			
			}else{

				$("#ese_aes_correo").prop('disabled', true);
				$("#ese_aes_contrasenia").prop('disabled', true);
				$("#ese_aes_correo").val('');
				$("#ese_aes_contrasenia").val('');
				
				$('.group-inputs-aes').hide('slow');


			}

		});
	});

	function tipoese(){
		// document.getElementById('verdiv').style.display = 'none';
		// document.getElementById('divtipover').style.display = 'none';
		$('#contenedor_modulo_referencias_alta_estudio').show();
		$("#verdiv").hide();
		$("#divtipover").hide();
		$("#divtipoese").show();
		$("#divnumcontrol").hide();
		// document.getElementById('divtipoese').style.display = 'block';
		var ese_folioverificacion = document.getElementById("ese_folioverificacion");
		ese_folioverificacion.removeAttribute('required');

		let ese_folio_ese=document.getElementById('ese_folioverificacion_eses');
		// ese_folio_ese.required = true;                 //turns required on through reflected attribute
		var ese_numerocontrol = document.getElementById("ese_numerocontrol");
		ese_numerocontrol.removeAttribute('required');
		//alert('ese');
		
	}
	function sinformato(){
		$('#contenedor_modulo_referencias_alta_estudio').hide();
		$("#verdiv").hide();
		$("#divtipover").hide();
		$("#divtipoese").hide();
		$("#divnumcontrol").hide();
	}

	function autoestudio(){
		
				$('#contenedor_modulo_autoestudios').show();
				$("#ese_aes_correo").prop('disabled', true);
				$("#ese_aes_contrasenia").prop('disabled', true);
				$("#ese_aes_correo").val('');
				$("#ese_aes_contrasenia").val('');

	}
	function remove_autoestudio(){
		$("#ese_aes_preg").prop("checked", false);
		$('#contenedor_modulo_autoestudios').hide();
		let ese_aes_correo = document.getElementById("ese_aes_correo");
		ese_aes_correo.removeAttribute('required');
		let ese_aes_contrasenia = document.getElementById("ese_aes_contrasenia");
		ese_aes_contrasenia.removeAttribute('required');
		

		$("#ese_aes_correo").prop('disabled', true);
		$("#ese_aes_contrasenia").prop('disabled', true);
		$("#ese_aes_correo").val('');
		$("#ese_aes_contrasenia").val('');

	}

	function tipover(){
		// document.getElementById('verdiv').style.display = 'block';
		// document.getElementById('verdiv').style.display = 'block';
		$("#verdiv").show();
		$("#divtipover").show();
		$("#divtipoese").hide();
		$("#divnumcontrol").hide();
		let ese_folio_ese=document.getElementById('ese_folioverificacion_eses');
		ese_folio_ese.required = false;   
		
		// document.getElementById('divtipoese').style.display = 'none';
		fnverificaciones();
		var ese_folioverificacion = document.getElementById("ese_folioverificacion");
		ese_folioverificacion.setAttribute('required','required');

		var ese_numerocontrol = document.getElementById("ese_numerocontrol");
		ese_numerocontrol.removeAttribute('required');
	}

	function tiponegocio(){
		// document.getElementById('verdiv').style.display = 'block';
		// document.getElementById('verdiv').style.display = 'block';
		let ese_folio_ese=document.getElementById('ese_folioverificacion_eses');
		ese_folio_ese.required = false;   
		$("#verdiv").hide();
		$("#divtipover").hide();
		$("#divtipoese").hide();
		$("#divnumcontrol").show();
		// document.getElementById('divtipoese').style.display = 'none';
		// fnverificaciones();
		var ese_folioverificacion = document.getElementById("ese_folioverificacion");
		ese_folioverificacion.removeAttribute('required');

		var ese_numerocontrol = document.getElementById("ese_numerocontrol");
		ese_numerocontrol.setAttribute('required','required');
	}

	function tiposupervivencia(){
		// document.getElementById('verdiv').style.display = 'block';
		// document.getElementById('verdiv').style.display = 'block';
		let ese_folio_ese=document.getElementById('ese_folioverificacion_eses');
		ese_folio_ese.required = false;   
		$("#verdiv").hide();
		$("#divtipover").hide();
		$("#divtipoese").hide();
		$("#divnumcontrol").show();
		// document.getElementById('divtipoese').style.display = 'none';
		// fnverificaciones();
		var ese_folioverificacion = document.getElementById("ese_folioverificacion");
		ese_folioverificacion.removeAttribute('required');

		var ese_numerocontrol = document.getElementById("ese_numerocontrol");
		ese_numerocontrol.setAttribute('required','required');
	}

	function fnverificaciones()
	{
	    var negocio="<?php echo $this->url->get('verificaciones/ajax_verificaciones/') ?>";
	    var $subsnegocio = $('select[name="ver_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	          
	        success: function(data)
	        {
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.ver_id + '">(' +dat.ver_alias+") " +dat.ver_nombre+'</option>';
						});

					    return options;
				  	});
				}else{
					$subsnegocio.append(function () {
					    var options = '';
					    options += '<option selected value="-1">Error al buscar</option>';
					    return options;
					});
				}
	        },
	        error: function(res)
	        {
	            // $("#btn_aprobar").prop("disabled", false);
	        }
	    });
	}

	function fnselecttipopersona(){
		var tipopersona = $("#ese_tippersona").val();
		if(tipopersona==1){
			document.getElementById('fisica1').style.display = 'block';
			document.getElementById('fisica2').style.display = 'block';
			var ese_primerapellido = document.getElementById("ese_primerapellido");
			ese_primerapellido.setAttribute('required','required');
		}else{
			document.getElementById('fisica1').style.display = 'none';
			document.getElementById('fisica2').style.display = 'none';
			var ese_primerapellido = document.getElementById("ese_primerapellido");
			ese_primerapellido.removeAttribute('required');
		}
	}

	function borrar_esta_row_crear_referencia(event)
	{ 
	//targetamos el botón =li
	let btn= event.target;
	//esta accede al padre,del padre hasta llegar al row
	let row_del_btn=btn.parentElement.parentElement.parentElement;

	$(`#${row_del_btn.id}`).hide('slow', function(){ $(`#${row_del_btn.id}`).remove(); });
		
		



			
	}
</script>


{% include "/estudio/alta-estudio/alta-ese-referencias-dinamicas-js.volt" %}




<!-- INICIO DE AGREGAR REFEFERENCIA PERSONAL  INCIO ------------------------------------------------REF PERSONAL DINAMICO -->
{% include "/estudio/alta-estudio/alta-ese-referencia-personal-modal.volt" %}	
<!-- FIN DE AGREGAR REFEFERENCIA PERSONAL  FIN ------------------------------------------------REF PERSONAL DINAMICO -->


<!-- INICIO DE REF LABORALES INCIO ------------------------------------------------------------REF LABORALES INCIO -->
{% include "/estudio/alta-estudio/alta-ese-referencia-laboral-modal.volt" %}	

<!-- INICIO DE REF LABORALES fin ------------------------------------------------------------REF LABORALES  -->
