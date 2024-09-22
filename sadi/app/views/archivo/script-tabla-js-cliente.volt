<script>
    function fnCargarTablaGeneralCliente(id_ese=0,div_listado=0){
        if(div_listado=="0"){
          div_listado="archivoslistadocliente";
        }
        $(`#${div_listado}`).html("CARGANDO...");
        let url="<?php echo $this->url->get('archivo/tabla_cliente/') ?>";
        url=url+id_ese;
        $.post(url, $(this).serialize() , function(data)
        {
          $(`#${div_listado}`).empty();
          if(data[0]<=0)
          {
            $('#archivos-cliente-modal').modal('hide');
          }
          else
          {
            $(`#${div_listado}`).html(data);
            // divListado.innerHTML=data;
            $('#archivotablecliente').DataTable(
            {
              "pageLength": 10
            });
          }

        }).done(function() { 
          
        }).fail(function(res) {
          // console.error(res);
        });

    }
</script>
{% include "/archivo/leer-archivo-cliente.volt" %}

<div class="modal fade" id="archivos-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5>Archivos <div id="msae_archivo_cliente"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            
            <div id="archivoslistadocliente">
            </div>
          </div>

      
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>