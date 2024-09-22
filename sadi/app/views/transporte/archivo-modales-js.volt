

<!-- 
  INCIO : MODAL QUE MUESTRA TODOS LOS ARCHIVOS DEL TRANSPORTE----------------------------------------------------------------------------------------------------------------------INICIO
 -->
<div class="modal fade" id="archivos-transporte-modal" tabindex="-1" aria-labelledby="modal_tra_solicitar" aria-hidden="true"  style="display: none; z-index: 9999;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel"> 
            <div id="mensaje_modal_archivo">          

            </div>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


          <div class="col-2">
              <div class="text-left" id="container_options_archivos">
                {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'), "data-toggle":"modal", "data-target":"#archivonuevo-transporte-modal", "title":"Agregar archivo") }} 
              </div>
            </div>
            
            <div class="modal-body">
              <!-- <br /> -->
              <!-- <h2><div id="cliente_recibo"></div></h2> -->
              <!-- <h2><div id="descripcion_recibo"></div></h2> -->
              
              <div id="archivoslistado_transporte">
              </div>

  
          
       </div>
                  
      
      </div>
    </div>
  </div>
</div>
<!-- 
  FIN : MODAL QUE MUESTRA TODOS LOS ARCHIVOS DEL TRANSPORTE----------------------------------------------------------------------------------------------------------------------FIN
 -->



 <!-- 
  INCIO : MODAL QUE MUESTRA MODAL PARA AGREGAR UN ARCHIVO NUEVO ----------------------------------------------------------------------------------------------------------------------INICIO
 -->

<div class="modal fade" id="archivonuevo-transporte-modal" tabindex="1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index: 9999;">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5>
                    <div id="mensaje_modal_agregar_archivo"> 
                    </div>
              
                </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_creararchivo_transporte" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
                            <div class="form-group row">
                                 <div class="col-lg-12">
                                <input type="hidden" name="archivotransporte_ese_id_nuevo" id="archivotransporte_ese_id_nuevo">
                                <input type="hidden" name="archivotransporte_tra_id_nuevo" id="archivotransporte_tra_id_nuevo">
                                <label class="col-form-label title-busq">Descripción</label>
                                <input type="text" class="form-control  input-rounded" name="archivotransporte_art_nota_nuevo" id="archivotransporte_art_nota_nuevo" placeholder="Descripción acerca del archivo."  oninput="handleInput(event)" required minlength="10" />
                                
                                  </div>

                            <div class="col-lg-12 mt-3">
                                    <label class="col-form-label title-busq">Archivo</label>
                                    <div class="form-group mb-0">
                                        <input type="file" class="filestyle" 
                                          id="archivo_transporte" 
                                          name="archivo_transporte[]" 
                                          data-size-limit="1048576"
                                          data-file-limit="4"
                                          onchange="fnValidateSizeFile(event,'preview-container-archivos-arc-tra');"
                                          accept=".png, .jpg, .jpeg" data-btnClass="btn filestyle-rounded" onchange="">
                                    </div>                    
                            </div>
                            <div id="preview-container-archivos-arc-tra">
                            </div>

                            <div class="row col-lg-12">
                                <div class="col-sm-6 col-md-6 text-center mt-5">
                                </div>
                                <div class="col-sm-3 col-md-3 text-center mt-5">
                                    <div class="form-group">
                                    <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                    <div class="form-group">
                                    <button type="submit" id="subirArchivoTransporte" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
                                    </div>
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
  
 <!-- 
  FIN : MODAL QUE MUESTRA MODAL PARA AGREGAR UN ARCHIVO NUEVO ----------------------------------------------------------------------------------------------------------------------FIN
 -->
