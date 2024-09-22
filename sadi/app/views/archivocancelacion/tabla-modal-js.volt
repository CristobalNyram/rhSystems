

<script type="text/javascript">
function fnTablaArchivosCancelacionEseEca(ese_id,eca_id=0){
  console.log(eca_id);
         let mensaje_eca_id = (eca_id && eca_id !== 0) ? " folio de cancelación " + eca_id : "";
        document.getElementById("archivoslistado_cancelacion").innerHTML="";
        document.getElementById("msae_archivo_cancelacion").innerHTML="";
        document.getElementById("msae_archivo_cancelacion").innerHTML = "Archivos de cancelación del estudio #" + ese_id + ": " + mensaje_eca_id;

        reciboListado = document.getElementById('archivoslistado');
        urlreload="<?php echo $this->url->get('archivocancelacion/tabla/') ?>";
        urlreload+=ese_id+"/"+eca_id;
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#archivoslistado_cancelacion').html(data);
            // divListado.innerHTML=data;
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
}

 
</script>

<div class="modal fade" id="archivos_cancelacion-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_archivo_cancelacion"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            <div id="archivoslistado_cancelacion">
            </div>
          </div>


        <!-- </div>
      </div> -->
    </div>
  </div>
</div>



{% include "/archivo/leer-archivo.volt" %}
