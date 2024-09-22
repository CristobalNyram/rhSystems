<script type="text/javascript">
	function leerarchivoVac(id,nombre_archivo,tipo,vac_id){
    
      let url = "<?php echo $this->url->get('archivovac/ajax_getImagen/') ?>";
      const archivoURL = "<?php echo $this->url->get() ?>" + tipo + '/' + vac_id + '/' + encodeURIComponent(nombre_archivo);
      const mensajeError = `
        <div style="    display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-size: 24px;
        background: #0A0734;
        color: white;
        font-size: 3rem;
        font-weight: bold;">

          <img hidden src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" alt="Imagen de archivo no encontrado" style="max-width: 80%; max-height: 80%;">


        Archivo no encontrado</div>`;
        const iframe = document.getElementById("archivoreadvac");

        $.ajax({
              type: "POST",
              url: url + id,
              success: function(res) {
              console.log(res.estado);

                    if(res.estado==2){
                         console.log(res.estado);

                       $("#nombre_archivolectura_vac").html("Archivo: " + nombre_archivo);
                        iframe.src =archivoURL; // Limpia cualquier contenido existe
                    }else{
                      $("#nombre_archivolectura_vac").html(`<span class="text-danger"> Archivo no encontrado </span>: ` + nombre_archivo);
                      $("#archivoreadvac").attr('src', ''); // Limpia el src del iframe
                        iframe.src = 'about:blank'; // Limpia cualquier contenido existente
                        iframe.contentWindow.document.open();
                        iframe.contentWindow.document.write(mensajeError);
                        iframe.contentWindow.document.close();
                    }

              },
              error: function(res) {
              }
            });

      
    }
</script>

<div class="modal fade" id="leerarchivo_vac-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index: 999999;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5 class="" id="exampleModalLabel"><div id="nombre_archivolectura_vac"></div></h5>
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
              <iframe id="archivoreadvac" name="archivoreadvac" src="" frameborder="0" width="100%" height="auto" style="height: 70vh;"></iframe>
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>