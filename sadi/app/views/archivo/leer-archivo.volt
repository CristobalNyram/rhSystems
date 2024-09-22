<script type="text/javascript">
	function leerarchivo(id,nombre_archivo,tipo){
      console.log(id,nombre_archivo,tipo);
      let url = "<?php echo $this->url->get('archivo/ajax_getImagen/') ?>";
      const archivoURL = "<?php echo $this->url->get() ?>" + tipo+"/"+ encodeURIComponent(nombre_archivo);
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
        const iframe = document.getElementById("archivoread");
        $.ajax({
          type: "POST",
          url: url + id+"/"+tipo,
          success: function(res) {      
          if(res.mensaje=="Found"){
             $("#nombre_archivolectura").html("Archivo: " + nombre_archivo);
            iframe.src =archivoURL; // Limpia cualquier contenido existente    
            // console.log(archivoURL);      
          }else{
            $("#nombre_archivolectura").html(`<span class="text-danger"> Archivo no encontrado </span>: ` + nombre_archivo);
            $("#archivoread").attr('src', ''); // Limpia el src del iframe
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