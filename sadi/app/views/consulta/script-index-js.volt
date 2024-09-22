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
<script type="text/javascript">



	function principal(){
        document.getElementById("listadoprincipal").innerHTML="";
        urlreloadprincipal="<?php echo $this->url->get('consulta/tabla/') ?>";
        
        $.post(urlreloadprincipal, $('form').serialize() , function(data)
        {
            $('#listadoprincipal').html(data);
            let nombrearchivo= document.getElementById("nombrearchivo").value;
              var table=$('#datatable-buttons').DataTable({
                "pageLength": 100,
                "order": [0, 'desc'],
                scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
                "language": {
                  "sProcessing":     "Procesando...",
                  "sLengthMenu":     "Mostrar _MENU_ registros",
                  "sZeroRecords":    "No se encontraron resultados",
                  "sEmptyTable":     "Ningún dato disponible en esta tabla",
                  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                  "sSearch":         "Buscar:",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                      "sFirst":    "Primero",
                      "sLast":     "Último",
                      "sNext":     "Siguiente",
                      "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  },
                  "buttons": {
                      "copy": "Copiar",
                      "colvis": "Personalizar",
                      "excel":"Excel",
                      "pdf":"PDF",
                      "print":"PDF"

                  }
              },
        			
              buttons: [
                {
                    extend: 'excelHtml5',
                    title: nombrearchivo
                }, 
                {
                  extend: 'pdfHtml5',
                  orientation: 'landscape',
                  pageSize: 'LEGAL',
                
                },
                'colvis'
              ]
              
    		    });
            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

            document.getElementById('busqueda').style.display = 'none';
            document.getElementById('busqueda-filtros').style.display = 'none';



        }).done(function() { 

        }).fail(function() {
          $('#otrabusqueda').show('slow');

        })
    }

    function fnmostrarbusqueda(){
    
      $('#busqueda').show('slow');
      $('#busqueda-filtros').show('slow');

      document.getElementById('otrabusqueda').style.display = 'none';
    }
</script>
   

<script>
$(document).ready(()=>{

  let filtro_entrega_cliente =document.getElementById('filtro_entrega_cliente');
      filtro_entrega_cliente.addEventListener('click',()=>{ 
            if(filtro_entrega_cliente.classList.toggle('active')){
              $('#fecha_entrega_cliente_div').removeClass('d-none').hide().slideDown(400);
            }
            else
            {
              $('#fecha_entrega_cliente_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
              $('#ese_fechaentregacliente_f_inicial').val('');
              $('#ese_fechaentregacliente_f_final').val('');

            }
      });

  let filtro_entrega_investigador =document.getElementById('filtro_entrega_investigador');
     filtro_entrega_investigador.addEventListener('click',()=>{ 
                if(filtro_entrega_investigador.classList.toggle('active')){
                  $('#fecha_entrega_inv_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_entrega_inv_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_fechaentregainvestigador_f_inicial').val('');
                  $('#ese_fechaentregainvestigador_f_final').val('');

                }
          });

    let filtro_entrega_analista =document.getElementById('filtro_entrega_analista');
    filtro_entrega_analista.addEventListener('click',()=>{ 
                if(filtro_entrega_analista.classList.toggle('active') ){
                  $('#fecha_entrega_ana_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_entrega_ana_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_fechaentregaanalista_f_inicial').val('');
                  $('#ese_fechaentregaanalista_f_final').val('');

                }
    });
      let filtro_transporte_asig =document.getElementById('filtro_transporte_asig');
      filtro_transporte_asig.addEventListener('click',()=>{ 
                if(filtro_transporte_asig.classList.toggle('active')){
                  $('#trasnporte_asig_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#trasnporte_asig_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_transporte').val(-1);
                  $('#ese_transporte').select2({ placeholder: "Seleccionar"});
                }
          });      

    let filtro_asig_analista =document.getElementById('filtro_asig_analista');
    filtro_asig_analista.addEventListener('click',()=>{ 
                if(filtro_asig_analista.classList.toggle('active')){
                  $('#fecha_asig_ana_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_asig_ana_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_fechaasiganalista_f_inical').val('');
                  $('#ese_fechaasiganalista_f_final').val('');

                }
          });
          
      let filtro_asig_inv =document.getElementById('filtro_asig_inv');
      filtro_asig_inv.addEventListener('click',()=>{ 
                if(filtro_asig_inv.classList.toggle('active')){
                  $('#fecha_asig_inv_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fecha_asig_inv_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_fechaasiginvestigador_f_inical').val('');
                  $('#ese_fechaasiginvestigador_f_final').val('');

                }
          });
          
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
      let filtro_fol_verificacion =document.getElementById('filtro_fol_verificacion');
      filtro_fol_verificacion.addEventListener('click',()=>{ 
                if(filtro_fol_verificacion.classList.toggle('active')){
                  $('#fol_verificacion_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#fol_verificacion_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#ese_folioverificacion').val('');
                }
          });
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
                  $('#ese_fechacancelacion_f_inicial').val('');
                  $('#ese_fechacancelacion_f_final').val('');

                }
          });
        let filtro_tipo_estudio =document.getElementById('filtro_tipo_estudio');
      filtro_tipo_estudio.addEventListener('click',()=>{ 
                if(filtro_tipo_estudio.classList.toggle('active')){
                  $('#tipo_estudio_div').removeClass('d-none').hide().slideDown(400);
                }
                else
                {
                  $('#tipo_estudio_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                  $('#tipo_estudio_div').val('');
                  $('#tipo_estudio_div').val('');

                }
          });
          {% if ochentaynueve ==1 %}

          let filtro_ese_calificacion = document.getElementById('filtro_ese_calificacion');
            filtro_ese_calificacion.addEventListener('click', () => {
              if (filtro_ese_calificacion.classList.toggle('active')) {
                $('#ese_calificacion_div').removeClass('d-none').hide().slideDown(400);
              } else {
                $('#ese_calificacion_div').slideUp(400, function() {
                  $(this).addClass('d-none');
                });
              }
              $('#ese_calificacion').val('-1');
              $('#ese_calificacion').trigger('change');
            });
          

          {% endif %}

          {% if noventaycuatro ==1 %}
            let filtro_ese_empresarecluta = document.getElementById('filtro_ese_empresarecluta');
            filtro_ese_empresarecluta.addEventListener('click', () => {
                if (filtro_ese_empresarecluta.classList.toggle('active')) {
                  $('#ese_empresarecluta_div').removeClass('d-none').hide().slideDown(400);
                } else {
                  $('#ese_empresarecluta_div').slideUp(400, function() {
                    $(this).addClass('d-none');
                  });
                }
                  $('#ese_empresarecluta').val('');
                  $('#ese_empresarecluta').val('-1');
                  $('#ese_empresarecluta').trigger('change');
              });


            {% endif %}


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