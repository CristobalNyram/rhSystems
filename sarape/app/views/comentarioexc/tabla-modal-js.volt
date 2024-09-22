
{% include "/comentarioexc/script-js.volt" %}

<div class="modal fade" id="comentarioexc-modal" tabindex="999999" style="z-index:999999;" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="mensaje-tablacomentarios-titulo-modal"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      
            <div class="row ml-2" id="btnAgregarComentarioExc">
              <div class="">
                  {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'), "onclick":"fnCrearComentario()","data-toggle":"modal","data-target":"#comentarionuevoexc-modal","title":"Agregar comentario") }}
              </div>
              <span class="ml-3 h6  text-success">Agregar comentario</span>

            </div>

            
    

          
          <div class="modal-body">
        
            
            <div id="comentariolistadoexc">
            </div>
          </div>
  
    </div>
  </div>
</div>

<div class="modal fade" id="comentarionuevoexc-modal" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="999999" style="display: none;z-index: 999999;">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="mensaje-nuevocomentario-titulo-modal"></div></h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_crearcomentarioexc" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" id="exc_id-comentario" name="exc_id" />
              <div class="form-group">
                <label class="control-label col-xs-12">Comentario
                </label>
                <label class="col-form-label title-busq" id="label_com_comentario_exc_comentario"></label>

                  <div class="col-xs-12">
                    <textarea id="comentario_nuevo" required name="comentario_nuevo" oninput="handleInput(event)" onkeyup="actualizaInfo(2000,'comentario_nuevo', 'label_com_comentario_exc_comentario')"  class="form-control-textarea text_area_a" style="min-height:50px"></textarea>
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