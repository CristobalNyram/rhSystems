<script type="text/javascript">
	$(function (){
		$("#frm_crearcomentarioese").submit(function(event) 
	    {
	    /* Act on the event */
	    var $form = $(this);
	    var urlpag="<?php echo $this->url->get('comentarioese/crear/') ?>";
	    // var idpolc = document.getElementById("pol_idcomentario").value;
	    $form.find("button").prop("disabled", true);
	    $.ajax({
	      type: "POST",
	      url: urlpag,
	      data: $("#frm_crearcomentarioese").serialize(),
	      success: function(res)
	      {
	        if(res[0]<=0)
	        {
	          $('#comentariosese-modal').modal('hide');
	          alertify.alert("Error",res[1]);
	        }
	        else
	        {
	          // cargarlista();
	        
			Swal.fire({title:'Éxito',text:'Comentario agregado correctamente.',type:"success"})
                .then((value) => {
													// location.reload();
					document.getElementById("comentariolistadoese").innerHTML="";

					// reciboListado = document.getElementById('recibolistado');
					// tablaprincipal();
					$("#comentario_nuevo").val('');
					reloadcomentariorecibo(res[2]);
					$('#comentarionuevoese-modal').modal('hide');
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

	function comentarioese(id_ese){
        reciboListado = document.getElementById('comentariolistadoese');
        url="<?php echo $this->url->get('comentarioese/tabla/') ?>";
        url+=id_ese;
        $("#ese_idcomentario").val(id_ese);
        // $("#cliente_recibo").html("Cliente: "+cliente);
        // $("#descripcion_recibo").html("Descripción: "+descripcion);
        $.post(url, $(this).serialize() , function(data)
        {
            $('#comentariolistadoese').html(data);
            // divListado.innerHTML=data;
            $('#comentariotableese').DataTable(
            {
              "pageLength": 10,
              'order': [[2, 'desc']],
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
                
                buttons: [{
                      extend: 'excelHtml5',
                      exportOptions: {
                          columns: ':visible'
                      }
                  }, 
                  {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ":visible"
                    }
                  },
                  'colvis'
                ]
            });
        }).done(function() { 
          url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

          $.ajax({
                      type: "POST",
                      url: url_enviar_ese_data+id_ese,
                      success: function(res)
                      {

                          if(res.length>0){

                            let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                           // $("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);
                            $("#msae_comentarionuevoese").html("Comentarios de estudio: "+id_ese+mensaje_empresa_candidato);


                          }

                      
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });



         
        }).fail(function() {
        })
    }



    function reloadcomentariorecibo(id_ese,detalles=''){
    	var listado='comentariolistadoese'+detalles;
        document.getElementById(listado).innerHTML="";
        reciboListado = document.getElementById(listado);
        urlreload="<?php echo $this->url->get('comentarioese/tabla/') ?>";
        urlreload+=id_ese;
        $("#ese_idcomentario").val(id_ese);
        // $("#msae_archivo").html("Archivos de póliza: "+num_poliza);
        // $("#cliente_recibo").html("Cliente: "+cliente);
        // $("#descripcion_recibo").html("Descripción: "+descripcion);
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#'+listado).html(data);
            // divListado.innerHTML=data;
            $('#comentariotableese').DataTable(
            {
              "pageLength": 10,
              'order': [[2, 'desc']]
            });
        }).done(function() { 
        }).fail(function() {
        })
    }




</script>