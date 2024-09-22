<script>

     
     function fn_archivo_transporte_tabla_modal(transporte_id,ese_id)
   {
    let transporte_id_modal = document.getElementById('archivotransporte_tra_id_nuevo');
    let ese_id_modal=document.getElementById('archivotransporte_ese_id_nuevo');
    ese_id_modal.value=ese_id;
    transporte_id_modal.value=transporte_id;

      reciboListado = document.getElementById('archivoslistado_transporte');
        url="<?php echo $this->url->get('transporte/archivo_tabla/') ?>";
        url+=transporte_id;
        $("#mensaje_modal_archivo").html(` <i class="mdi mdi-image"></i> Archivos transporte del: #${transporte_id}`);
        $("#mensaje_modal_agregar_archivo").html(`<i class="mdi mdi-plus-box blue"></i> Agregar archivo al transporte #${transporte_id}`);


        $.post(url, $(this).serialize() , function(data)
        {
          if(data[0]<=0)
          {
            $('#archivos-modal').modal('hide');
            Swal.fire({title:'Error',text:data[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
            
          }
          else
          {
            $('#archivoslistado_transporte').html(data);
            // divListado.innerHTML=data;
            $('#archivotable_transporte').DataTable(
            {
              "pageLength": 10
            });
          }
        }).done(function() {
        }).fail(function() {
        })


   }





</script>

<script>
    $(function (){
   
      let modalTransporteArchivNuevo = $('#archivonuevo-transporte-modal');
      modalTransporteArchivNuevo.on('shown.bs.modal', function() {
          let formulario = modalTransporteArchivNuevo.find('form');
          $("#preview-container-archivos-arc-tra").empty();
          formulario[0].reset();
      });



        $('#frm_creararchivo_transporte').submit(function(event)
        {
          let $form=$(this);

            if($('#archivo_transporte').val()=='')
            {
            Swal.fire({title:'Error',text:"Debe seleccionar al menos un archivo a subir.",type:"error"})
                                                                 .then((value) => {
                                                                     });
            return false;
            }
            if($('#archivotransporte_art_nota_nuevo').val()=='' )
            {
            // alertify.alert("Error","Debe escribir una nota/descripción acerca del archivo que esta esta subiendo.");
            Swal.fire({title:'Error',text:"Debe escribir una nota/descripción acerca del archivo que esta esta subiendo.",type:"error"})
                                                                 .then((value) => {
                                                                     });
            return false;


            }

            document.getElementById("subirArchivoTransporte").disabled = true;
            document.getElementById("subirArchivoTransporte").style.cursor = "not-allowed";            

                /*Ejecutamos la función ajax de jQuery*/
            let url="<?php echo $this->url->get('transporte/ajax_subir_archivo_transporte/') ?>";
                $.ajax({
                        url: url,//Url a donde la enviaremos
                        type:'POST', //Metodo que usaremos
                        // contentType:false, //Debe estar en false para que pase el objeto sin procesar
                        // data: $("#frm_creararchivo").serialize(), //Le pasamos el objeto que creamos con los archivos
                        // processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
                        // cache:false, //Para que el formulario no guarde cache
                        data: new FormData(this),
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(res)
                        {
                          if(res['estado']<=0)
                        {
                            Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
                        }
                        else
                        {
                          document.getElementById("subirArchivoTransporte").disabled = false;
                 document.getElementById("subirArchivoTransporte").style.cursor = "";     
                            // cargarlista();
              
                            Swal.fire({title:'Éxito',text:"Se procesaron los archivos correctamente del transporte #"+res['tra_id'],type:"success"})
                                                                 .then((value) => {
                                                                  reloadarchivoTransporte(res['tra_id']);
                                                                  document.getElementById("frm_creararchivo_transporte").reset();
                                                                  $('#archivonuevo-transporte-modal').modal('hide');
                                                                     });

                        }

                        },
                        error: function(res)
                        {
                          alert('error');
                        }

                    });
                    return false;
                });

        });


        function reloadarchivoTransporte(id_tra){
        document.getElementById("archivoslistado_transporte").innerHTML="";

        reciboListado = document.getElementById('archivoslistado_transporte');
        urlreload="<?php echo $this->url->get('transporte/archivo_tabla/') ?>";
        urlreload+=id_tra;
        $.post(urlreload, $(this).serialize() , function(data)
        {
        
            $('#archivoslistado_transporte').html(data);
            // divListado.innerHTML=data;
            $('#archivotable_transporte').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() {
        }).fail(function() {
        })
    }





</script>
<script>



  function fneliminarevidenciaTransporte(id_archivo_transporte,id_transporte){

                          var urleliminarare="<?php echo $this->url->get('transporte/eliminar_evidencia_transporte/') ?>";
                          // var urlindexare="<?php echo $this->url->get('administrador/index/') ?>";
                          mensaje=`¿Está seguro que desea eliminar el archivo #${id_archivo_transporte}? `;
                          alertify.confirm("Eliminar archivo",mensaje, function()
                          {
                          $.ajax({
                              type: "POST",
                              url: urleliminarare+id_archivo_transporte,
                              success: function(res)
                              {



                              if(res[0]=='1')
                              {
                                  Swal.fire({title:'Eliminado',text:"El archivo ha sido eliminado correctamente",type:"success"})
                                                                 .then((value) => {
                                                                     });
                                  
                                  reloadarchivoTransporte(id_transporte);
                                  // window.location=urlindexare;
                              }
                              else
                              {
                                  if(res[0]=='-1'){
                                  // alertify.alert("Error",res[1]);
                                  Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                     });
                                  
                                  }
                                  else
                                  {
                                  Swal.fire({title:'Error',text:"Ocurrio un error al cambiar el estatus",type:"error"})
                                                                 .then((value) => {
                                                                     });
                                  }
                              }
                              }
                          });
                          }, function()
                          {
                  }).set('labels', {ok:'Eliminar', cancel:'Cancelar'});
  }

  </script>
