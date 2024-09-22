<script type="text/javascript">
		$(document).ready(function() {
		fnestados();
		fnempresas();
		fntipovacante();
		fntipoempleo();
		fngeneracion();
		fnestadocivil();
		fnsexo();
		fngradoescolar();
		fnEjecutivo();
		fnPrestaciones();
		fnGetTipoPago();
		$(".campos_contacto_empresa").hide();

		//ProgressBar.init('progress-bar', 'frm_crear_vac', 'input, textarea, select');	
	});
	
	function fnEjecutivo() {
		var url = "<?php echo $this->url->get('usuario/ajax_get_all_ejecutivos/') ?>";
		var $select = $('select[name="eje_id"]');
		$select.empty();

		$.ajax({
			type: "POST",
			url: url,
			success: function(response) {
				let data=response.data;		
				if (data.length > 0) {
					var options = '<option selected value="-1">Seleccionar</option>';
					$.each(data, function (key, data) {
						
						options += '<option value="' + data.usu_id + '">' + data.usu_nombre +' '+data.usu_primerapellido+' '+data.usu_segundoapellido +'</option>';
					});
					$select.html(options);
				} else {
					$select.html('<option selected value="-1">No aplica</option>');
				}		
			},
			error: function(response) {
				// Manejo de error en caso de que la solicitud falle
				// $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

	function fnPrestaciones() {
		var url = "<?php echo $this->url->get('prestacion/ajax_prestaciones/') ?>";
		var $select = $('select[name="pre_id"]');
		$select.empty();

		$.ajax({
			type: "POST",
			url: url,
			success: function(response) {
				let data=response;

		
				if (data.length > 0) {
					var options = '<option selected value="-1">Seleccionar</option>';
					$.each(data, function (key, data) {
						options += '<option value="' + data.pre_id + '">' + data.pre_nombre +'</option>';
					});
					$select.html(options);
				} else {
					$select.html('<option selected value="-1">No aplica</option>');
				}		
			},
			error: function(response) {
				// Manejo de error en caso de que la solicitud falle
				// $("#btn_aprobar").prop("disabled", false);
			}
		});
	}
	function fntipovacante()
	{
	    var negocio="<?php echo $this->url->get('tipovacante/ajax_tipovacantes/') ?>";
	    var $subsnegocio = $('select[name="tip_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.tip_id + '">' +dat.tip_nombre+'</option>';
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

	function fntipoempleo()
	{
	    var negocio="<?php echo $this->url->get('tipoempleo/ajax_tipoempleos/') ?>";
	    var $subsnegocio = $('select[name="tie_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.tie_id + '">' +dat.tie_nombre+'</option>';
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

	function fngeneracion()
	{
	    var negocio="<?php echo $this->url->get('generacion/ajax_generaciones/') ?>";
	    var $subsnegocio = $('select[name="gen_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.gen_id + '">' +dat.gen_nombre+'</option>';
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

	function fnestadocivil()
	{
	    var negocio="<?php echo $this->url->get('estadocivil/ajax_estadoscivil/') ?>";
	    var $subsnegocio = $('select[name="esc_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.esc_id + '">' +dat.esc_nombre+'</option>';
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

	function fnsexo()
	{
	    var negocio="<?php echo $this->url->get('sexo/ajax_sexos/') ?>";
	    var $subsnegocio = $('select[name="sex_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.sex_id + '">' +dat.sex_nombre+'</option>';
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

	function fnGetTipoPago()
	{
	    var negocio="<?php echo $this->url->get('helper/ajax_tipopagos/') ?>";
	    var $subsnegocio = $('select[name="tpg_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(res)
	        {
				let data =res.data;
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.tpg_id + '">' +dat.tpg_nombre+'</option>';
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

	function fngradoescolar()
	{
	    var negocio="<?php echo $this->url->get('gradoescolar/ajax_gradosescolares/') ?>";
	    var $subsnegocio = $('select[name="gra_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.gra_id + '">' +dat.gra_nombre+'</option>';
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
		$('#cne_id').val("-1").trigger('change');

	    var negocio="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
	    var $subsnegocio = $('select[name="emp_id"]');
	    $subsnegocio.empty();
	    $.ajax({
	        type: "POST",
	        url: negocio,
	        success: function(data)
	        {
	            if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Seleccionar</option>';
						$.each(data, function (key, dat) {
						options += '<option value="' + dat.emp_id + '">' +dat.emp_nombre+' ('+dat.emp_alias+')</option>';
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

	function tipoDeEmpleoInpust(value){
		if(value=="3"){
			$(".tipo-empleo-eventual").slideDown("slow");
			$("#vac_tiempomeses").prop('required',true);
			$("#tpg_id").prop('required',false);


		}else{
			$(".tipo-empleo-eventual").slideUp("slow");
			$("#vac_tiempomeses").prop('required',false);
			$("#tpg_id").prop('required',false);

		}

	}
	$(function (){
		$("#frm_crear_vac").submit(function(event) {
  			event.preventDefault();
			var $form = $(this);
			var urled = "<?php echo $this->url->get('vacante/nuevo/') ?>";
			var selectsAValidar = [
				{ id: "#emp_id", name: "empresa" },
				{ id: "#cne_id", name: "quien solicita" },
				{ id: "#tip_id", name: "tipo vacante" },
				{ id: "#cav_id", name: "vacante" },
				{ id: "#vac_numero", name: "NO. VACANTES" },
				{ id: "#tie_id", name: "tipo de empleo" },
				{ id: "#est_id", name: " estado " },
				{ id: "#mun_id", name: " municipio " },
				{ id: "#vac_privacidad", name: " EL CLIENTE DESEA QUE LA VACANTE SEA " },

			];
			
			var numeroDeOpciones_cen_id = $("#cen_id option").length;
			if(numeroDeOpciones_cen_id!="1"){
			selectsAValidar.push({ id: "#cen_id", name: " centro de costos" });
			}else{

			}

		

			var valoresPosiblesNoAceptados = ["-1", "0", "-2"];

			var isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
			if (!isValidSelects) {
				return false;
			}

			if (!$form.valid()) {
				return false;
			}

			$form.find("button").prop("disabled", true);

			//file inciio
            let file = $("#arv_vac_cotizacion")[0].files[0]; // Obtener el archivo seleccionado
            let formData = new FormData($form[0]); // Crear objeto FormData con los datos del formulario
            formData.append("arv", file); // Agregar el archivo al objeto FormData
            //file fin
			$.ajax({
			  type: "POST",
			  url: urled,
			  data: formData, // Usar el objeto FormData en la solicitud AJAX
              dataType: 'json',
              contentType: false,
              cache: false,
              processData:false,
			  success: function(res) {

					switch (res['estado']) {
						case 2:
						swalalert('Éxito',res['mensaje'], "success", 1);
						break;
						case -2:
						swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
						$form.find("button").prop("disabled", false);
						console.warn(res['detalle']);							
						break;
						case -1:
						swalalert('AVISO',res['mensaje'], "warning", 1);
						$form.find("button").prop("disabled", false);
						console.warn(res);							
						break;
						default:
						
						break;
					}

				},
				error: function(res) {
				console.log(res.responseText);
				$form.find("button").prop("disabled", false);
				}
			});

			return false;
			});
    });

	function fndatosempresa(){
		fncontactos();
		fncentros();
		fnvacantes();
		getContactoDetalleAltaVacante();
	}

	function fnvacantes(editar=0){
		if(editar==0){
			var $empresa = $("#emp_id").val();
			var $subsnegocio = $('select[name="cav_id"]');
		}
		else{
			var $empresa = $("#emp_ideditar").val();
			var $subsnegocio = $('select[name="cav_ideditar"]');
		}
		var negocio="<?php echo $this->url->get('catvacante/ajax_catvacantes/') ?>"+$empresa;

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
							options += '<option value="' + dat.cav_id + '">' +dat.cav_nombre+'</option>';
						});
						return options;
					});
				}else{
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">No hay vacantes asignadas</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
				alert('Error en el servidor...'+res.responseText);
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
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
				alert('Error en el servidor...'+res.responseText);
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

	function getContactoDetalleAltaVacante(id_cne=0){
      
      let url="<?php echo $this->url->get('contactoemp/ajax_get_detalle_uno/') ?>"+id_cne;
      $.ajax({
        type: "POST",
        url: url,
        success: function(res)
        {
          if(res.length==0){
			$('.campos_contacto_empresa').hide();
            $("#cne_correo").val("");
            $("#cne_telefono").val("");
            $("#cne_puesto").val("");
			$("#cne_celular").val("");

          }else{
            let data = res[0];
			$('.campos_contacto_empresa').show();
            $("#cne_correo").val(data.cne_correo);
            $("#cne_telefono").val(data.cne_tel);
            $("#cne_puesto").val(data.cne_puesto);
            $("#cne_celular").val(data.cne_celular);

          }

		  

      
        },
        error: function(res)
        {
          alert('Error en el servidor...');
        // $("#btn_aprobar").prop("disabled", false);
        }
      });

  }
</script>