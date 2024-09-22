<script type="text/javascript">
    function fndatosempresa(){
		  fncontactos();
      fncentros();
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
			// console.log(data);
			  // Agregar nuevos sub-departamentos
			  if (data.length > 0) {
			      $subsnegocio.append(function () {
			          var options = '';
			          options += '<option selected value="-1">Todos</option>';
			          $.each(data, function (key, dat) {
			            options += '<option value="' + dat.cne_id + '">' +dat.cne_nombre+' '+dat.cne_primerapellido+' '+dat.cne_segundoapellido+ '</option>';
			          });

			          return options;
			      });
			  }else{

          if($('#emp_id').val()==-1)
          {
            $subsnegocio.append(function () {
                    var options = '';
                    options += '<option selected value="-1">Seleccione una empresa</option>';
                    return options;
                });

          }
          else{
              $subsnegocio.append(function () {
                    var options = '';
                    options += '<option selected value="-1">No hay contactos asignados</option>';
                    return options;
                });
              }
          }			    
			},
			error: function(res)
			{
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

    $(document).ready(function() {
		fnestados();

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
	            // console.log(data);
	              // Agregar nuevos sub-departamentos
				if (data.length > 0) {
					$subsnegocio.append(function () {
						var options = '';
						options += '<option selected value="-1">Todos</option>';
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
            alert('Error en el servidor...');
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
			// console.log(data);
			  // Agregar nuevos sub-departamentos
			  if (data.length > 0) {
			      $subsnegocio.append(function () {
			          var options = '';
			          options += '<option selected value="-1">Todos</option>';
			          $.each(data, function (key, dat) {
			            options += '<option value="' + dat.mun_id + '">' +dat.mun_nombre+'</option>';
			          });

			          return options;
			      });
			  }else{

          if($('#est_id').val()==-1)
          {
            $('#mun_id').val(-1);
            $('#mun_id').select2({ placeholder: ""});
            $subsnegocio.append(function () {
			        var options = '';
			        options += '<option selected value="-1">Seleccione un estado</option>';
			        return options;
			    });

          }
          else
          {
            $subsnegocio.append(function () {
			        var options = '';
			        options += '<option selected value="-1">No aplica</option>';
			        return options;
			    });
          }
			    
			  }
			},
			error: function(res)
			{
			  // $("#btn_aprobar").prop("disabled", false);
			}
		});
	}

</script>

   

<script>
$(document).ready(()=>{

 
      let filtro_fecha_alta =document.getElementById('filtro_fecha_alta');
      filtro_fecha_alta.addEventListener('click',()=>{ 
                if(filtro_fecha_alta.classList.toggle('active')){
                  $('#fecha_alta_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_alta_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#exc_registro_fechainicial').val('');
                  $('#exc_registro_fechafinal').val('');

                }
          });
     /*
      let filtro_fecha_cancelación =document.getElementById('filtro_fecha_cancelación');
      filtro_fecha_cancelación.addEventListener('click',()=>{ 
                if(filtro_fecha_cancelación.classList.toggle('active')){
                  $('#fecha_cancelacion_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_cancelacion_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#exc_fechacancelacion_f_inicial').val('');
                  $('#exc_fechacancelacion_f_final').val('');

                }
          });*/

      let filtro_vac_fechafin = document.getElementById('filtro_vac_fechafin');
      filtro_vac_fechafin.addEventListener('click', () => {
        if (filtro_vac_fechafin.classList.toggle('active')) {
          $('#fecha_vacfin_div').removeClass('d-none').hide().slideDown(400);
        } else {
          $('#fecha_vacfin_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
        
        }
          $('#vac_fechavacfin_f_inicial').val('');
          $('#vac_fechavacfin_f_final').val('');
      });

      let filtro_vac_actualizacion =document.getElementById('filtro_vac_actualizacion');
      filtro_vac_actualizacion.addEventListener('click',()=>{ 
        if(filtro_vac_actualizacion.classList.toggle('active')){
          $('#vac_actualizacion_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#vac_actualizacion_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#vac_actualizacion_f_inicial').val('');
          $('#vac_actualizacion_f_final').val('');
        }
      });

      let filtro_vac_fechareactivoproceso =document.getElementById('filtro_vac_fechareactivoproceso');
      filtro_vac_fechareactivoproceso.addEventListener('click',()=>{ 
        if(filtro_vac_fechareactivoproceso.classList.toggle('active')){
          $('#vac_fechareactivoproceso_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#vac_fechareactivoproceso_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#vac_reactivoproceso_f_inicial').val('');
          $('#vac_reactivoproceso_f_final').val('');
        }
      });

      let filtro_sexo = document.getElementById('filtro_sexo');
      filtro_sexo.addEventListener('click',()=>{ 
        if(filtro_sexo.classList.toggle('active')){
          $('#filtro_sexo_div').removeClass('d-none').hide().slideDown(400);
          $('#sex_id').val('-1').trigger('change');
        }
        else
        {
          $('#filtro_sexo_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#sex_id').val('-1').trigger('change');
        }
      });

      let filtro_tpg_id =document.getElementById('filtro_tpg_id');
      filtro_tpg_id.addEventListener('click',()=>{ 
        if(filtro_tpg_id.classList.toggle('active')){
          $('#filtro_tpg_div').removeClass('d-none').hide().slideDown(400);
          $('#tpg_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_tpg_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#tpg_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_estadocivil = document.getElementById('filtro_estadocivil');
      filtro_estadocivil.addEventListener('click',()=>{ 
        if(filtro_estadocivil.classList.toggle('active')){
          $('#filtro_estadocivil_div').removeClass('d-none').hide().slideDown(400);
          $('#esc_id').val('-1');
        }
        else
        {
          $('#filtro_estadocivil_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#esc_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_gra_id = document.getElementById('filtro_gra_id');
      filtro_gra_id.addEventListener('click',()=>{ 
        if(filtro_gra_id.classList.toggle('active')){
          $('#filtro_gra_div').removeClass('d-none').hide().slideDown(400);
          $('#gra_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_gra_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#gra_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_tie_id = document.getElementById('filtro_tie_id');
      filtro_tie_id.addEventListener('click',()=>{ 
        if(filtro_tie_id.classList.toggle('active')){
          $('#filtro_tie_div').removeClass('d-none').hide().slideDown(400);
          $('#tie_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_tie_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#tie_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_tip_id = document.getElementById('filtro_tip_id');
      filtro_tip_id.addEventListener('click',()=>{ 
        if(filtro_tip_id.classList.toggle('active')){
          $('#filtro_tip_div').removeClass('d-none').hide().slideDown(400);
          $('#tip_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_tip_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#tip_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_usu_idreactivoproceso = document.getElementById('filtro_usu_idreactivoproceso');
      filtro_usu_idreactivoproceso.addEventListener('click',()=>{ 
        if(filtro_usu_idreactivoproceso.classList.toggle('active')){
          $('#filtro_usu_idreactivoproceso_div').removeClass('d-none').hide().slideDown(400);
          $('#usu_idreactivoproceso').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_usu_idreactivoproceso_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#usu_idreactivoproceso').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_vac_estatus = document.getElementById('filtro_vac_estatus');
      filtro_vac_estatus.addEventListener('click',()=>{ 
        if(filtro_vac_estatus.classList.toggle('active')){
          $('#filtro_vac_estatus_div').removeClass('d-none').hide().slideDown(400);
          $('#vac_estatus').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_vac_estatus_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#vac_estatus').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_pre_id = document.getElementById('filtro_pre_id');
      filtro_pre_id.addEventListener('click',()=>{ 
        if(filtro_pre_id.classList.toggle('active')){
          $('#filtro_pre_div').removeClass('d-none').hide().slideDown(400);
          $('#pre_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_pre_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#pre_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_can_valido = document.getElementById('filtro_can_valido');
      filtro_can_valido.addEventListener('click',()=>{ 
        if(filtro_can_valido.classList.toggle('active')){
          $('#filtro_can_valido_div').removeClass('d-none').hide().slideDown(400);
          $('#can_valido').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_can_valido_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#can_valido').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_can_correo = document.getElementById('filtro_can_correo');
      filtro_can_correo.addEventListener('click',()=>{ 
        if(filtro_can_correo.classList.toggle('active')){
          $('#filtro_can_correo_div').removeClass('d-none').hide().slideDown(400);
          $('#can_correo').val('');
        }
        else
        {
          $('#filtro_can_correo_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#can_correo').val('');
        }
      });

      let filtro_ent_seleccionado = document.getElementById('filtro_ent_seleccionado');
      filtro_ent_seleccionado.addEventListener('click',()=>{ 
        if(filtro_ent_seleccionado.classList.toggle('active')){
          $('#filtro_ent_seleccionado_div').removeClass('d-none').hide().slideDown(400);
          $('#ent_seleccionado').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_ent_seleccionado_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#ent_seleccionado').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_ent_fecharegistro =document.getElementById('filtro_ent_fecharegistro');
      filtro_ent_fecharegistro.addEventListener('click',()=>{ 
        if(filtro_ent_fecharegistro.classList.toggle('active')){
          $('#filtro_ent_fecharegistro_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_ent_fecharegistro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_ent_fecharegistro_f_inicial').val('');
          $('#filtro_ent_fecharegistro_f_final').val('');
        }
      });

      let filtro_fat_fecharegistro =document.getElementById('filtro_fat_fecharegistro');
      filtro_fat_fecharegistro.addEventListener('click',()=>{ 
        if(filtro_fat_fecharegistro.classList.toggle('active')){
          $('#filtro_fat_fecharegistro_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_fat_fecharegistro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_fat_fecharegistro_f_inicial').val('');
          $('#filtro_fat_fecharegistro_f_final').val('');
        }
      });

      let filtro_cit_registro =document.getElementById('filtro_cit_registro');
      filtro_cit_registro.addEventListener('click',()=>{ 
        if(filtro_cit_registro.classList.toggle('active')){
          $('#filtro_cit_registro_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_cit_registro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_cit_registro_f_inicial').val('');
          $('#filtro_cit_registro_f_final').val('');
        }
      });

      let filtro_cit_fecha =document.getElementById('filtro_cit_fecha');
      filtro_cit_fecha.addEventListener('click',()=>{ 
        if(filtro_cit_fecha.classList.toggle('active')){
          $('#filtro_cit_fecha_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_cit_fecha_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_cit_fecha_f_inicial').val('');
          $('#filtro_cit_fecha_f_final').val('');
        }
      });

      let filtro_cit_hora =document.getElementById('filtro_cit_hora');
      filtro_cit_hora.addEventListener('click',()=>{ 
        if(filtro_cit_hora.classList.toggle('active')){
          $('#filtro_cit_hora_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_cit_hora_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_cit_hora_f_inicial').val('');
          $('#filtro_cit_hora_f_final').val('');
        }
      });

      let filtro_tic_id =document.getElementById('filtro_tic_id');
      filtro_tic_id.addEventListener('click',()=>{ 

        if(filtro_tic_id.classList.toggle('active')){
          $('#filtro_tic_id_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_tic_id_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
         
        }
        $('#tic_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
      });

      let filtro_med_id =document.getElementById('filtro_med_id');
      filtro_med_id.addEventListener('click',()=>{ 
        if(filtro_med_id.classList.toggle('active')){
          $('#filtro_med_id_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_med_id_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
        
        }
        $('#med_id').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 

      });

      let filtro_sel_registro =document.getElementById('filtro_sel_registro');
      filtro_sel_registro.addEventListener('click',()=>{ 
        if(filtro_sel_registro.classList.toggle('active')){
          $('#filtro_sel_registro_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_sel_registro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_sel_registro_f_inicial').val('');
          $('#filtro_sel_registro_f_final').val('');
        }
      });

      let filtro_sel_calificacion =document.getElementById('filtro_sel_calificacion');
      filtro_sel_calificacion.addEventListener('click',()=>{ 
        if(filtro_sel_calificacion.classList.toggle('active')){
          $('#filtro_sel_calificacion_div').removeClass('d-none').hide().slideDown(400);
          $('#sel_calificacion').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
        else
        {
          $('#filtro_sel_calificacion_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#sel_calificacion').val('-1').trigger('change').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }

      });

      let filtro_sel_necesitoauxiliar =document.getElementById('filtro_sel_necesitoauxiliar');
      filtro_sel_necesitoauxiliar.addEventListener('click',()=>{ 
        if(filtro_sel_necesitoauxiliar.classList.toggle('active')){
          $('#filtro_sel_necesitoauxiliar_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_sel_necesitoauxiliar_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
        }
        $('#sel_necesitoauxiliar').val('-1').trigger('change');

      });

      let filtro_sel_empleosocultos =document.getElementById('filtro_sel_empleosocultos');
      filtro_sel_empleosocultos.addEventListener('click',()=>{ 
        if(filtro_sel_empleosocultos.classList.toggle('active')){
          $('#filtro_sel_empleosocultos_div').removeClass('d-none').hide().slideDown(400);
          $('#sel_empleosocultos').val('-1').trigger('change');
          

        }
        else
        {
          $('#filtro_sel_empleosocultos_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#sel_empleosocultos').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });


      // psicometria inicio
       let filtro_psi_calificacion =document.getElementById('filtro_psi_calificacion');
      filtro_psi_calificacion.addEventListener('click',()=>{ 
        if(filtro_psi_calificacion.classList.toggle('active')){
          $('#filtro_psi_registro_div').removeClass('d-none').hide().slideDown(400);
          $('#psi_calificacion').val('-1').trigger('change');
          

        }
        else
        {
          $('#filtro_psi_registro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#psi_calificacion').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });

      let filtro_psi_fecharegistro =document.getElementById('filtro_psi_fecharegistro');
      filtro_psi_fecharegistro.addEventListener('click',()=>{ 
        if(filtro_psi_fecharegistro.classList.toggle('active')){
          $('#filtro_psi_registro_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_psi_registro_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_psi_fecharegistro_f_inicial').val('');
          $('#filtro_psi_fecharegistro_f_final').val('');
        }
      });


      // psicometria fin



    // garantia inicio
     let filtro_usu_idgarantia =document.getElementById('filtro_usu_idgarantia');
      filtro_usu_idgarantia.addEventListener('click',()=>{ 
        if(filtro_usu_idgarantia.classList.toggle('active')){
          $('#filtro_usu_idgarantia_div').removeClass('d-none').hide().slideDown(400);
          $('#usu_idgarantia').val('-1').trigger('change');
          

        }
        else
        {
          $('#filtro_usu_idgarantia_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#usu_idgarantia').val('-1').trigger('change');//esto es para simular el evento de que cambia de opcion en select 
        }
      });
      let filtro_exc_fechagarantia =document.getElementById('filtro_exc_fechagarantia');
      filtro_exc_fechagarantia.addEventListener('click',()=>{ 
        if(filtro_exc_fechagarantia.classList.toggle('active')){
          $('#filtro_exc_fechagarantia_div').removeClass('d-none').hide().slideDown(400);
        }
        else
        {
          $('#filtro_exc_fechagarantia_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#filtro_exc_fechagarantia_f_inicial').val('');
          $('#filtro_exc_fechagarantia_f_final').val('');
        }
      });
    // garantia fin


    // Vacante ID Inicio
    let filtro_vac_id = document.getElementById('filtro_vac_id');
      filtro_vac_id.addEventListener('click', () => {
        if (filtro_vac_id.classList.toggle('active')) {
          $('#filtro_vac_id_div').removeClass('d-none').hide().slideDown(400);
        } else {
          $('#filtro_vac_id_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
        
        }
        
          $('#vac_id').val('');
      });
    // Vacante ID fin







  


});

</script>


<script>
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
						options += '<option selected value="-1">Todos</option>';
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

</script>



