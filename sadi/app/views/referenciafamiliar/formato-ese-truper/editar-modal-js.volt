<script type="">
    function fnEditarReferenciaFamiliarFormatoTruper(ref_id){
      let form_ocupado=document.getElementById('frm_editar_truper_referenciafamiliar');
  
      form_ocupado.reset();
  
  
  
      let url_enviar="<?php echo $this->url->get('referenciafamiliar/ajax_get_detalle/') ?>";
                                       
      $.ajax({
        type: "POST",
        url: url_enviar+ref_id,
        success: function(res)
        {                                                                            
          if(res[0]==2)
          {
  
            $('#ref_ese_id_editar-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
            $('#ref_ese_nombre_editar-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
  
  
            
            $('#ref_id_editar-formato_truper').val(res['data'].ref_id);
  
  
            $('#ref_nombre_editar-formato_truper').val(res['data'].ref_nombre);
            $('#ref_edad_editar-formato_truper').val(res['data'].ref_edad);
            $('#ref_telefono_editar-formato_truper').val(res['data'].ref_telefono);
            $('#ref_direccion_editar-formato_truper').val(res['data'].ref_direccion);
  
  
            let recomienda= (is_number(res['data'].ref_lorecomienda )==null ) ?-1:res['data'].ref_lorecomienda;
                          $('#ref_lorecomienda_editar-formato_truper').val(recomienda);
                          $('#ref_lorecomienda_editar-formato_truper').trigger('change');
                        
            $('#ref_ocupacion_editar-formato_truper').val(res['data'].ref_ocupacion);
            $('#ref_parentesco_editar-formato_truper').val(res['data'].ref_parentesco);
            $('#ref_conocesuempleo_editar-formato_truper').val(res['data'].ref_conocesuempleo);

            $('#ref_comentario_editar-formato_truper').val(res['data'].ref_comentario);
  
  
  
            
  
  
          }
          else
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
              .then((value) => {
              location.reload();  
            });
          }
                                                                                                  
        },
        error: function(res)
        { 
          alert('error en el servidor...');
        }
      });
    }
  
    $(function (){
        $('#frm_editar_truper_referenciafamiliar').submit(function(event) {
        let $form = $(this);
        a=$form.valid();
        if(a==false){
            return false;
        }
        $form.find("button").prop("disabled", true);
        let url_enviar="<?php echo $this->url->get('referenciafamiliar/actualizar_formato_truper/') ?>";
        $.ajax({
          type: "POST",
          url: url_enviar,
          data: $('#frm_editar_truper_referenciafamiliar').serialize(),
          success: function(res)
          {
            if(res[0]==2)
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
                $form.find("button").prop("disabled", false);
                  let form_ocupado=document.getElementById('frm_editar_truper_referenciafamiliar');
                  form_ocupado.reset();
                  $('#editar-referenciafamiliar-truper-modal').modal('hide');
                  fnCargarTablaDatoReferenciaFamiliarFormatoTruper(res['sep_id']);
              });
            }
            else
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                .then((value) => {
                location.reload();
              });
            }
          },
          error: function(res)
          { 
            alert('ERROR EN EL SERVIDOR');
          }
        });
        return false;
      });
    });
   </script>
  


  
 
 <div class="modal fade" id="editar-referenciafamiliar-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-pencil"></i>Editar una referencia familiar al estudio No. <span id="ref_ese_id_editar-formato_truper"></span>  "<span id="ref_ese_nombre_editar-formato_truper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_editar_truper_referenciafamiliar" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="ref_id_editar-formato_truper" name="ref_id" />

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Nombre completo</label>
                    <input name="ref_nombre" id="ref_nombre_editar-formato_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="150" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Edad</label>
                    <input name="ref_edad" id="ref_edad_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad..."  maxlength="10"/>

                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="ref_telefono" id="ref_telefono_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="20"/>

                  </div>
                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Dirección                    </label>
                    <input name="ref_direccion" id="ref_direccion_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Dirección..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6">
                   <label class="col-form-label title-busq">Ocupación                    </label>
                   <input name="ref_ocupacion" id="ref_ocupacion_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Ocupación..."  maxlength="45"/>

                 </div>
     
                 <div class="col-lg-6">
                   <label class="col-form-label title-busq">Parentesco                    </label>
                   <input name="ref_parentesco" id="ref_parentesco_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parentesco..."  maxlength="45"/>

                 </div>
     

             
            



                     

                 


        
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Conoce su empleo                    </label>
                    <input name="ref_conocesuempleo" id="ref_conocesuempleo_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su empleo..."  maxlength="45"/>


                  </div>


              
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Lo recomienda</label>
                    <select name="ref_lorecomienda"  id="ref_lorecomienda_editar-formato_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup class="text-uppercase">
                        <option value="-1">Seleccionar...</option>
                        <option value="1">RECOMENDABLE</option>
                        <option value="2">RECOMENDABLE C / RESERVAS			
                        </option>
                        <option value="3"> --  NO -- RECOMENDABLE			
                        </option>
                      </optgroup>
                    </select>

                  </div>

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Comentarios                    </label>
                    <textarea name="ref_comentario" id="ref_comentario_editar-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" placeholder="Comentarios..."></textarea>

                  </div>

    

                

                  <div class="row col-lg-12">
                    <div class="col-sm-6 col-md-6 text-center mt-5">
                    </div>
                    <div class="col-sm-3 col-md-3 text-center mt-5">
                        <div class="form-group">
                          <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3  text-center mt-5 ">
                        <div class="form-group">
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar  <i class="mdi mdi-content-save white"></i></button>
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
  