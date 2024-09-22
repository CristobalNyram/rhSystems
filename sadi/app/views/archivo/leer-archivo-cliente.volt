<script type="text/javascript">
	function leerarchivocliente(id,nombre_archivo,tipo){
      readarchivo="<?php echo $this->url->get() ?>";
      readarchivo+=tipo+'/';
      readarchivo+= unescape(encodeURIComponent(nombre_archivo));
      // readarchivo="./polizas/"+arc_nombre;
      $("#nombre_archivolectura").html("Archivo: "+nombre_archivo);
      $("#archivoread").attr('src', readarchivo);
    }
</script>

<div class="modal fade" id="leerarchivo-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index: 9999;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5 class="" id="exampleModalLabel"><div id="nombre_archivolectura"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body" >
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            <div class="container">
              <ul class="list-unstyled">
                
              </ul>
            </div>
            <div id="leerarchivolistado">
              <iframe id="archivoread" name="archivoread" src="" frameborder="0" width="100%" height="auto" style="height: 70vh;"></iframe>
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>