<script type="">
   function fnCrearReferenciaPersonalFormatoTruper(){
    let form_ocupado=document.getElementById('frm_crear_truper_referenciapersonal');
    form_ocupado.reset();
     $('#rep_ese_id_crear-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#rep_ese_nombre_crear-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

     $('#rep_sep_id-formato_truper').val($('#sep_id-formato_truper').val());
       
     $('#rep_lorecomienda_crear-formato_truper').val('-1');
      $('#rep_lorecomienda_crear-formato_truper').trigger('change');

     
   

    }
    $(function (){
      $('#frm_crear_truper_referenciapersonal').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('referenciapersonal/crear_formato_truper/') ?>";
                     
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $("#frm_crear_truper_referenciapersonal").serialize(),
        success: function(res)
        {   
          // console.log(res);
          if(res[0]==2)
          {
     
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
            $form.find("button").prop("disabled", false);
            let form_ocupado=document.getElementById('frm_crear_truper_referenciapersonal');
            form_ocupado.reset();

            $('#agregar-referenciapersonal-truper-modal').modal('hide');
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
          alert('error en el servidor...');
        
        }
      });
      return false;
    });



  });
</script>



<div class="modal fade" id="agregar-referenciapersonal-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar una referencia personal al estudio No. <span id="rep_ese_id_crear-formato_truper"></span>  "<span id="rep_ese_nombre_crear-formato_truper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_truper_referenciapersonal" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="rep_sep_id-formato_truper" name="sep_id" />

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Nombre completo</label>
                    <input name="rep_nombre" id="rep_nombre_crear-formato_truper" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="55" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Edad</label>
                    <input name="rep_edad" id="rep_edad_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad..."  maxlength="10"/>

                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="rep_telefono" id="rep_telefono_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="45"/>

                  </div>
                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Dirección                    </label>
                    <input name="rep_direccioncompleta" id="rep_direccioncompleta_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Dirección..."  maxlength="45"/>

                  </div>


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Ocupación						
                    </label>
                    <input name="rep_ocupacion" id="rep_ocupacion_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Ocupación..."  maxlength="55"/>

                  </div>
     
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Empresa en la que trabaja			
                    </label>
                    <input name="rep_empresatrabaja" id="rep_empresatrabaja_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Empresa en la que trabaja..."  maxlength="55"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tiempo en conocerlo</label>
                    <input name="rep_tiempo" id="rep_tiempo_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo en conocerlo..."  maxlength="55"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Como lo conoció                    </label>
                    <input name="rep_comoloconocio" id="rep_comoloconocio_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Como lo conoció..."  maxlength="55"/>

                  </div>


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq"> Conoce su domicilio                    </label>
                    <input name="rep_conocesudomicilio" id="rep_conocesudomicilio_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder=" Conoce su domicilio  ..."  maxlength="55"/>

                  </div>


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq"> Conoce su estado civil                    </label>
                    <input name="rep_estadocivil" id="rep_estadocivil_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su estado civil..."  maxlength="55"/>

                  </div>


        


        
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Sabe donde ha trabajado		                    </label>
                    <input name="rep_conocedonhatrabajado" id="rep_conocedonhatrabajado_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Sabe donde ha trabajado	..."  maxlength="45"/>


                  </div>


                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Conoce sus pasatiempos			                    </label>
                    <input name="rep_pasatiempos" id="rep_pasatiempos_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce sus pasatiempos..."  maxlength="45"/>


                  </div>

        
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Su concepto como persona es                    </label>
                    <input name="rep_conceptocomopersona" id="rep_conceptocomopersona_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Su concepto como persona es..."  maxlength="45"/>


                  </div>


                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Lo recomienda                    </label>
                    <select name="rep_lorecomienda"  id="rep_lorecomienda_crear-formato_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
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
                    <textarea name="rep_notas" id="rep_notas_crear-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" placeholder="Comentarios..."></textarea>

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
  