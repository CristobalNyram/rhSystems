<script type="">
    function fnEditarReferenciaPersonal_formato_gabtubos(rep_id){
      let form_ocupado=document.getElementById('frm_editar_referenciapersonal_formato_gabtubos');
      form_ocupado.reset();
     
      let url_enviar="<?php echo $this->url->get('referenciapersonal/ajax_get_detalle/') ?>";
                                       
      $.ajax({
        type: "POST",
        url: url_enviar+rep_id,
        success: function(res)
        {   
          // console.log(res);
          if(res[0]==2)
          {
            $('#rep_ese_id_editar_formato_gabtubos').text($('#ese_id_ese_actual_formato_gabtubos').text());
            $('#rep_ese_nombre_editar_formato_gabtubos').text($('#ese_nombrecompleto_actual_formato_gabtubos').text()); 

            $('#rep_id_editar_formato_gabtubos').val(res['data'].rep_id);
            $('#rep_nombre_editar_formato_gabtubos').val(res['data'].rep_nombre);
            $('#rep_tiempo_editar_formato_gabtubos').val(res['data'].rep_tiempo);
            $('#rep_callenumero_editar_formato_gabtubos').val(res['data'].rep_callenumero);
            $('#rep_codpostal_editar_formato_gabtubos').val(res['data'].rep_codpostal);
            $('#rep_colonia_editar_formato_gabtubos').val(res['data'].rep_colonia);
            $('#rep_telefono_editar_formato_gabtubos').val(res['data'].rep_telefono);
            $('#rep_notas_editar_formato_gabtubos').val(res['data'].rep_notas);
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
      $('#frm_editar_referenciapersonal_formato_gabtubos').submit(function(event) {
      // event.preventDefault();
      // if($('#rep_nombre_editar').val()=='')
      //   {
      //     alertify.alert("Error","Debe llenar el nombre completo.")
      //     return false;
      //   }
      // let formulario=$("#frm_editar_referenciapersonal");
      // let $form = $(this);
      // $form.find("button").prop("disabled", true);
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciapersonal/actualizar/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_referenciapersonal_formato_gabtubos').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
              $form.find("button").prop("disabled", false);
              let form_ocupado=document.getElementById('frm_editar_referenciapersonal_formato_gabtubos');
              form_ocupado.reset();
              $('#editar-referenciapersonal_formato_gabtubos-modal').modal('hide');
              fnCargarTablaDatoReferenciaPersonal_formato_gabtubos(res['sep_id']);
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
          alert('ERROR EN EL SERVIDOR...');
        }
      });
      return false;
    });
  });
 </script>
 
 

<div class="modal fade" id="editar-referenciapersonal_formato_gabtubos-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar una referencia personal  del estudio No. <span id="rep_ese_id_editar_formato_gabtubos"></span> "<span id="rep_ese_nombre_editar_formato_gabtubos"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_referenciapersonal_formato_gabtubos" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="rep_id_editar_formato_gabtubos" name="rep_id_editar" />

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre</label>
                  <input name="rep_nombre_editar" id="rep_nombre_editar_formato_gabtubos" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Tiempo</label>
                  <input name="rep_tiempo_editar" id="rep_tiempo_editar_formato_gabtubos" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo de conocer al candidato..."  maxlength="10"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Número de calle</label>
                  <input name="rep_callenumero_editar" id="rep_callenumero_editar_formato_gabtubos" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Número de calle..."  maxlength="45"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Colonia</label>
                  <input name="rep_colonia_editar" id="rep_colonia_editar_formato_gabtubos" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Nombre de la colonia..."  maxlength="45"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Código postal</label>
                  <input name="rep_codpostal_editar" id="rep_codpostal_editar_formato_gabtubos" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Código postal..."  maxlength="10"/>

                </div>
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rep_telefono_editar" id="rep_telefono_editar_formato_gabtubos" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono (10 dígitos)..."  maxlength="45"/>

                </div>


                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Notas</label>
                  <textarea id="rep_notas_editar_formato_gabtubos"   placeholder="Notas.." name="rep_notas_editar" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="300"></textarea>

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
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar  <i class="mdi mdi-pencil-box -save white"></i></button>
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
