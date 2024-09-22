<script type="text/javascript">
  function fndetallesestudio(id){
      var urlfned="<?php echo $this->url->get('estudio/detalles/') ?>";
      // $("#msae").html("Detalles de póliza "+nombre); 
      $.ajax(
      {
          type: "POST",
          url: urlfned+id,
          success: function(res)
          {
            if(res[0]<=0)
            {
              $('#detallesver-modal').modal('hide');
              Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                .then((value) => {
                                                                      });  
            }
            else
            {
            // var subtotal=parseFloat(res[1])+parseFloat(res[2])+parseFloat(res[3]);
              if(res[1].tip_id==2){
                $("#detallesestudiover").html("Detalles Estudio con Folio: "+id);
                $("#emp_iddetallever").val(res[1].emp_nombre);
                $("#cne_iddetallever").val(res[1].contacto);
                $("#cen_id_detallever").val(res[1].ese_centrocosto);
                $("#ver_id_detallever").val(res[1].verificacion);
                $("#ese_nombre_detallever").val(res[1].ese_nombre);
                $("#ese_folioverificacion_detallever").val(res[1].ese_folioverificacion);
              // $("#agenota_detalle").val(res[1].age_nota);
              }
            }
          }
        });
    }

</script>

<div class="modal fade" id="detallesese-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Detalles estudios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarempresa" class="form-vertical mt-1">
          <div class="form-group row">

              <input id="emp_iddetalleese" style="display:none;" name="emp_iddetalleese" type="text" class="form-control input-rounded" minlength="2" placeholder="Nombre/Alias" required oninput="handleInput(event)"/>
          

            <div class="col-lg-5">
              <label class="col-form-label title-busq">Nombre de la empresa</label>
              <input id="emp_nombreeditar" name="emp_nombreeditar" type="text" class="form-control input-rounded" placeholder="Nombre" required oninput="handleInput(event)"/>
            </div>
           
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Alias</label>
              <input id="emp_aliaseditar" name="emp_aliaseditar" type="text" class="form-control input-rounded" placeholder="Alias" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq">RFC</label>
              <input id="emp_rfceditar" name="emp_rfceditar" type="text" class="form-control input-rounded" placeholder="RFC" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-8">
              <label class="col-form-label title-busq">Tipo de formato</label>
              <select name="emp_tipoformatoeditar" id="emp_tipoformatoeditar" class="form-control select2-single" data-toggle="select2" data-placeholder="Seleccionar ...">
                <optgroup>
                    <option value="1" >Formato 1</option>
                    <option value="2" >Formato 2</option>
                    <option value="3" >Formato 3</option>

                </optgroup>
              </select>
            </div>
            <div class="col-lg-4" >
                <label class="col-form-label title-busq">GRUPO DE NEGOCIO</label>
                <select name="neg_ideditar" id="neg_ideditar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <option selected value="-1">Seleccione</option>
                </select>
            </div>
            
            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
     
    </div>
  </div>
          
</div>


<div class="modal fade" id="detallesver-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="detallesestudiover">Detalles Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearcontacto" class="form-vertical mt-1">
          <div class="form-group row">
            <!-- <input type="hidden" id="emp_idcrear" name="emp_idcrear" /> -->
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Empresa</label>
              <input id="emp_iddetallever" name="emp_iddetallever" type="text" class="form-control input-rounded" minlength="2" placeholder="Empresa" disabled required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Solicita</label>
              <input id="cne_iddetallever" name="cne_iddetallever" type="text" class="form-control input-rounded" placeholder="Solicita" disabled required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Centro de costo</label>
              <input id="cen_id_detallever" name="cen_id_detallever" type="text" class="form-control input-rounded" placeholder="Centro de costo" disabled required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Tipo de verificación</label>
              <input id="ver_id_detallever" name="ver_id_detallever" type="text" class="form-control input-rounded" placeholder="Verificación" disabled required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="ese_nombre_detallever" name="ese_nombre_detallever" type="text" class="form-control input-rounded" placeholder="Nombre" disabled oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Folio de verificación</label>
              <input id="ese_folioverificacion_detallever" name="ese_folioverificacion_detallever" type="text" class="form-control input-rounded" disabled placeholder="Folio de verificacion" oninput="handleInput(event)"/>
            </div>
            <div class="row col-lg-12">
              <!-- <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                  </div>
              </div>
              <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
              </div> -->
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

