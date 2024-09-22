<script>


    function fnCargarTablaArchivos(div_listado='archivoslistado',tif_id=0,id_ese=0,ocultar=0){

        reciboListado = document.getElementById(div_listado);

        if(tif_id!='10'){
            url="<?php echo $this->url->get('archivo/tabla/') ?>";
        }
        if(tif_id=='10'){
            url="<?php echo $this->url->get('archivo/tabla_truper/') ?>";
        }

        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
        url+=id_ese+'/'+ocultar;
        
        fnCargarTablaGeneral(url,div_listado,id_ese,tif_id,ocultar);



     
    
    }


    function fnCargarTablaGeneral(url=0,div_listado,id_ese=0,tif_id=0,ocultar=0){
        $(`#${div_listado}`).html("CARGANDO...");

        $.post(url, $(this).serialize() , function(data)
        {
          $(`#${div_listado}`).empty();

          if(data[0]<=0)
          {
            $('#archivos-modal').modal('hide');
            alertify.alert("Error",data[1]);       
          }
          else
          {
            $(`#${div_listado}`).html(data);
            // divListado.innerHTML=data;
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
          }

        }).done(function() { 

            //obteniendo datos de ese
            $.ajax({
                      type: "POST",
                      url: url_enviar_ese_data+id_ese,
                      success: function(res)
                      {

                          if(res.length>0){

                            let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                            $("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);

                          }

                      
                      },
                      error: function(data)
                      {
                          alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                        
                      }
             });
        }).fail(function() {
        });

    }

</script>