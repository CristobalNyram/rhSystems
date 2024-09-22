<script type="">
  function fnEditarEmpleoOculto(epl_id){
    let form_ocupado=document.getElementById('frm_editar_empleooculto');
    form_ocupado.reset();
    let url_enviar="<?php echo $this->url->get('empleooculto/ajax_get_detalle/') ?>";
                                     
    $.ajax({
      type: "POST",
      url: url_enviar+epl_id,
      success: function(res)
      {
       // console.log(res);
        if(res[0]==2)
        {

          $('#epl_ese_id_editar').text($('#ese_id_ese_actual').text());
          $('#epl_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text());

          $('#epl_id_editar').val(res['data'].epl_id);
          $('#epl_empresa_editar').val(res['data'].epl_empresa);
          $('#epl_telefono_editar').val(res['data'].epl_telefono);
          $('#epl_fechaingreso_editar').val(res['data'].epl_fechaingreso);
          $('#epl_fechasalida_editar').val(res['data'].epl_fechasalida);
          $('#epl_motivo_editar').val(res['data'].epl_motivoseparacion);



     

          $('#epl_recomendable_editar').val(res['data'].epl_recomendable);
          $('#epl_demanda_editar').val(res['data'].epl_demanda);

          
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
    $('#frm_editar_empleooculto').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('empleooculto/actualizar_general/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_empleooculto').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
        

            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
                $form.find("button").prop("disabled", false);

                  let form_ocupado=document.getElementById('frm_editar_empleooculto');
                  form_ocupado.reset();
                  $('#editar-empleooculto-modal').modal('hide');
                  CargarTablaDatoEmpleosOcultos(res['sel_id']);
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
        }
      });
      return false;
    });
  });
 </script>

<div class="modal fade" id="editar-empleooculto-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil"></i>Editar un empleo oculto al estudio No. <span id="epl_ese_id_editar"></span> "<span id="epl_ese_nombre_editar"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_empleooculto" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="epl_id_editar" name="epl_id" />

                <div class="col-lg-6">
                 <label class="col-form-label title-busq">Nombre de empresa</label>
                 <input required name="epl_empresa" id="epl_empresa_editar" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)" placeholder="Nombre de empresa" maxlength="55"/>
               </div>
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="epl_telefono" id="epl_telefono_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Teléfono" maxlength="20"/>
                </div>

                <div class="col-lg-6">
                 <label class="col-form-label title-busq">Fecha de ingreso</label>
                 <input name="epl_fechaingreso" id="epl_fechaingreso_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
               </div>
                <div class="col-lg-6">
                 <label class="col-form-label title-busq">Fecha de salida</label>
                 <input name="epl_fechasalida" id="epl_fechasalida_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
               </div>

               

               <div class="col-lg-6">
                 <label class="col-form-label title-busq">Demanda</label>
      
                 <input name="epl_demanda" id="epl_demanda_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Demanda..." maxlength="155"/>

               </div>

               <div class="col-lg-6">
                 <label class="col-form-label title-busq">Recomendable</label>
              
                 <input name="epl_recomendable" id="epl_recomendable_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Recomendable..." maxlength="155"/>

               </div>
                <div class="col-lg-12">
                 <label class="col-form-label title-busq">Motivo de separación</label>
                 <input name="epl_motivoseparacion" id="epl_motivo_editar" type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Motivo de separación..." maxlength="800" />
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
