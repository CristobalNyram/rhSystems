<script type="">
    function fnEditarReferenciaPersonalFormatoTruper(rep_id){
      let form_ocupado=document.getElementById('frm_editar_truper_referenciapersonal');
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
            $('#rep_ese_id_editar-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
            $('#rep_ese_nombre_editar-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

            $('#rep_id_editar-formato_truper').val(res['data'].rep_id);
            $('#rep_nombre_editar-formato_truper').val(res['data'].rep_nombre);
            $('#rep_tiempo_editar-formato_truper').val(res['data'].rep_tiempo);
            $('#rep_telefono_editar-formato_truper').val(res['data'].rep_telefono);
            $('#rep_notas_editar-formato_truper').val(res['data'].rep_notas);


            let recomienda= (is_number(res['data'].rep_lorecomienda )==null ) ?-1:res['data'].rep_lorecomienda;
                          $('#rep_lorecomienda_editar-formato_truper').val(recomienda);
                          $('#rep_lorecomienda_editar-formato_truper').trigger('change');



            $('#rep_conceptocomopersona_editar-formato_truper').val(res['data'].rep_conceptocomopersona);
            $('#rep_pasatiempos_editar-formato_truper').val(res['data'].rep_pasatiempos);
            $('#rep_conocedonhatrabajado_editar-formato_truper').val(res['data'].rep_conocedonhatrabajado);
            $('#rep_estadocivil_editar-formato_truper').val(res['data'].rep_estadocivil);
            $('#rep_comoloconocio_editar-formato_truper').val(res['data'].rep_comoloconocio);

            $('#rep_tiempo_editar-formato_truper').val(res['data'].rep_tiempo);
            $('#rep_empresatrabaja_editar-formato_truper').val(res['data'].rep_empresatrabaja);
            $('#rep_direccioncompleta_editar-formato_truper').val(res['data'].rep_direccioncompleta);

            $('#rep_edad_editar-formato_truper').val(res['data'].rep_edad);


            $('#rep_ocupacion_editar-formato_truper').val(res['data'].rep_ocupacion);
            $('#rep_conocesudomicilio_editar-formato_truper').val(res['data'].rep_conocesudomicilio);

            


            
            



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
      $('#frm_editar_truper_referenciapersonal').submit(function(event) {
      // event.preventDefault();
      // if($('#rep_nombre_editar').val()=='')
      //   {
      //     alertify.alert("Error","Debe llenar el nombre completo.")
      //     return false;
      //   }
      // let formulario=$("#frm_editar_truper_referenciapersonal");
      // let $form = $(this);
      // $form.find("button").prop("disabled", true);
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciapersonal/actualizar_formato_truper/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_truper_referenciapersonal').serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
              $form.find("button").prop("disabled", false);
              let form_ocupado=document.getElementById('frm_editar_truper_referenciapersonal');
              form_ocupado.reset();
              $('#editar-referenciapersonal-truper-modal').modal('hide');
              fnCargarTablaDatoReferenciaPersonalFormatoTruper(res['sep_id']);
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
 
 

<div class="modal fade" id="editar-referenciapersonal-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar una referencia personal  del estudio No. <span id="rep_ese_id_editar-formato_truper"></span> "<span id="rep_ese_nombre_editar-formato_truper"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_truper_referenciapersonal" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" name="rep_id" id="rep_id_editar-formato_truper" />

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Nombre completo</label>
                  <input name="rep_nombre" id="rep_nombre_editar-formato_truper" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Edad</label>
                  <input name="rep_edad" id="rep_edad_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad..."  maxlength="10"/>

                </div>
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Teléfono</label>
                  <input name="rep_telefono" id="rep_telefono_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>

                </div>
                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Dirección                    </label>
                  <input name="rep_direccioncompleta" id="rep_direccioncompleta_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Dirección..."  maxlength="45"/>

                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Ocupación						
                  </label>
                  <input name="rep_ocupacion" id="rep_ocupacion_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Ocupación..."  maxlength="55"/>

                </div>
   
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Empresa en la que trabaja			
                  </label>
                  <input name="rep_empresatrabaja" id="rep_empresatrabaja_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Empresa en la que trabaja..."  maxlength="55"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Tiempo en conocerlo</label>
                  <input name="rep_tiempo" id="rep_tiempo_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo en conocerlo..."  maxlength="55"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Como lo conoció                    </label>
                  <input name="rep_comoloconocio" id="rep_comoloconocio_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Como lo conoció..."  maxlength="55"/>

                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq"> Conoce su domicilio                    </label>
                  <input name="rep_conocesudomicilio" id="rep_conocesudomicilio_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder=" Conoce su domicilio  ..."  maxlength="55"/>

                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq"> Conoce su estado civil                    </label>
                  <input name="rep_estadocivil" id="rep_estadocivil_editar-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su estado civil..."  maxlength="55"/>

                </div>


      


      
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Sabe donde ha trabajado		                    </label>
                  <input name="rep_conocedonhatrabajado" id="rep_conocedonhatrabajado_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sabe donde ha trabajado	..."  maxlength="45"/>


                </div>


                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Conoce sus pasatiempos			                    </label>
                  <input name="rep_pasatiempos" id="rep_pasatiempos_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce sus pasatiempos..."  maxlength="45"/>


                </div>

      
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Su concepto como persona es                    </label>
                  <input name="rep_conceptocomopersona" id="rep_conceptocomopersona_editar-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Su concepto como persona es..."  maxlength="45"/>


                </div>


                
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Lo recomienda                    </label>
                  <select name="rep_lorecomienda"  id="rep_lorecomienda_editar-formato_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                  <textarea name="rep_notas" id="rep_notas_editar-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" placeholder="Comentarios..."></textarea>

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
