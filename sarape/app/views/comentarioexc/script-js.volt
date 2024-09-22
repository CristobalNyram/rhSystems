<script type="text/javascript">
	$(function (){
		$("#frm_crearcomentarioexc").submit(function(event) 
	    {
	    let $form = $(this);
	    let urlpag="<?php echo $this->url->get('comentarioexc/crear/') ?>";
	    $form.find("button").prop("disabled", true);
	    $.ajax({
	      type: "POST",
	      url: urlpag,
	      data: $form.serialize(),
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
					$("#comentario_nuevo").val('');
					reloadcomentariorecibo(res[2]);
					$('#comentarionuevoexc-modal').modal('hide');
					$("#comentario_nuevo").val("");
                });  

	        }
	        $form.find("button").prop("disabled", false); 
	      },
	      error: function(res)
	      { 
			alert(res.responseText);
	        $form.find("button").prop("disabled", false); 
	      }
	    });
	    return false;
	    });
	});

	function comentarioexc(exc_id,config={}){	
		   fnGetDetalleExc(exc_id)
                          .then(function(res) {


							if (config.hasOwnProperty('mostrarCrear')) {

								if( config.mostrarCrear=="1"){
									$('#btnAgregarComentarioExc').show();

								}else{
									$('#btnAgregarComentarioExc').hide();

								}

							}else{
									$('#btnAgregarComentarioExc').show();

							}

							let data=res.data;
                        	let mensaje=`Comentarios del expediente No. ${exc_id} - ${data.cav_nombre} - ${data.emp_nombre} - `+generateBadgeExcEstatusHTML(data.exc_estatus);

						  $("#mensaje-tablacomentarios-titulo-modal").html(mensaje);
					      $("#mensaje-nuevocomentario-titulo-modal").html("Agregar comentario al expediente candidato No. "+exc_id);

                          })
                          .catch(function(error) {
                              alert(error.responseText);
                          });
        
	

        let url="<?php echo $this->url->get('comentarioexc/tabla/') ?>";
         url+=exc_id;
        $("#exc_id-comentario").val(exc_id);
        $.post(url, $(this).serialize() , function(data)
        {

         
			 let promiseTabla = new Promise(function(resolve, reject) {
				$('#comentariolistadoexc').html("");
				$('#comentariolistadoexc').html(data);
				resolve();
				});

				promiseTabla.then(function() {
				pintarTablaSimple("comentariotableexc");
				});
            
        }).done(function() { 
  
         
        }).fail(function() {
        })
    }



    function reloadcomentariorecibo(exc_id,detalles=''){


    	var listado='comentariolistadoexc'+detalles;
        document.getElementById(listado).innerHTML="";
        reciboListado = document.getElementById(listado);
        urlreload="<?php echo $this->url->get('comentarioexc/tabla/') ?>";
        urlreload+=exc_id;
        $("#exc_id-comentario").val(exc_id);
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#'+listado).html(data);
            
          	pintarTablaSimple("comentariotableexc");

        }).done(function() { 
        }).fail(function() {
        })
    }

	function fnCrearComentario(exc_id=0){
		exc_id=$("#exc_id-comentario").val();


	}




</script>