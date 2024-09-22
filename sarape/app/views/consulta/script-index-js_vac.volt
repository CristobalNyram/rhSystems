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
                  $('#ese_registro_fechainicial').val('');
                  $('#ese_registro_fechafinal').val('');

                }
          });


      let filtro_vac_fechafin = document.getElementById('filtro_vac_fechafin');
      filtro_vac_fechafin.addEventListener('click', () => {
        if (filtro_vac_fechafin.classList.toggle('active')) {
          $('#fecha_vacfin_div').removeClass('d-none').hide().slideDown(400);
        } else {
          $('#fecha_vacfin_div').slideUp(400, function() {
            $(this).addClass('d-none');
          });
          $('#vac_fechafin_f_inicial').val('');
          $('#vac_fechafin_f_final').val('');
        }
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
          $('#sex_id').val('-1');
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

      /*let filtro_usu_idreactivoproceso = document.getElementById('filtro_usu_idreactivoproceso');
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
      });*/

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



