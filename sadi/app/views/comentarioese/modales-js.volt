
{% include "/comentarioese/script-js.volt" %}

<div class="modal fade" id="comentariosese-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_comentarionuevoese"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          {% if acceso.verificar(17,rol_id)==1 %}
            <div class="row ml-2">
              <div class="">
                  {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#comentarionuevoese-modal","title":"Agregar comentario") }}
              </div>
              <span class="ml-3 h6  text-success">Agregar comentario</span>

            </div>

            
          {% endif %}

          
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            
            <div id="comentariolistadoese">
            </div>
          </div>
        <!-- </div> -->
      <!-- </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="comentarionuevoese-modal" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;z-index: 9999;">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h2><div id="msae_comentarionuevoese"></div></h2>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crearcomentarioese" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" id="ese_idcomentario" name="ese_idcomentario" />
              <div class="form-group">
                <label class="control-label col-xs-12">Comentario
                </label>
                <label class="col-form-label title-busq" id="label_com_comentario_ese_comentario"></label>

                  <div class="col-xs-12">
                    <textarea id="comentario_nuevo" required name="comentario_nuevo" oninput="handleInput(event)" onkeyup="actualizaInfo(2000,'comentario_nuevo', 'label_com_comentario_ese_comentario')"  class="form-control-textarea text_area_a" style="min-height:50px"></textarea>
                  </div>
              </div>
              
              <hr>
              <div class="ln_solid">
              </div>
              <div class="modal-footer">
                <div class="row">
               
                  <div class="col-lg-6 mt-4">
                    <button class="tn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                  </div>
                  <div class="col-lg-6 mt-4">
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Agregar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>