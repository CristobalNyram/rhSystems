<script type="">
   function fnCrearSituacionEconomicaCreditos(){
    // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_crear_situacioneconomicacredito');
      form_ocupado.reset();
     $('#sec_ese_id_crear').text($('#ese_id_ese_actual').text());
     $('#sec_sie_id').val($('#sie_id').val());
     $('#sec_ese_nombre_crear').text($('#ese_nombrecompleto_actual').text()); 

    }
    $(function (){
          $('#frm_crear_situacioneconomicacredito').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                        if($('#sec_institucion_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el nombre completo de la institución.")
                            return false;
                          }
                          if($('#sec_tipo_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el tipo de crédito.")
                            return false;
                          }
                       
                          if($('#sec_mensual_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el pago mensual.")
                            return false;
                          }
                         
                     
                          
                        let formulario=$("#frm_crear_situacioneconomicacredito");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('situacioneconomicacredito/crear/') ?>";
                                       
                        $.ajax({
                                      type: "POST",
                                      url: url_enviar,
                                      data: formulario.serialize(),
                                      success: function(res)
                                      {   
                                        // console.log(res);
                               
                                      
                                     
                                        if(res[0]==2)
                                        {
                                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                      $form.find("button").prop("disabled", false);
                                                                                      let form_ocupado=document.getElementById('frm_crear_situacioneconomicacredito');
                                                                                      form_ocupado.reset();
                                                                                   

                                                                                      $('#agregar-situacioneconomica-credito-modal').modal('hide');
                                                                                      fnRe_CargarTablaDatoSituacionEconomicaCreditos(res['sie_id']);
                                                                                       });
                                                                                       $('#sie_creditos').val(res['sie_creditos_total']);
                                                                                       sumarTodosLosMontosEgresos();


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
                                        alert('Error en el servidor');  
                                      }
                            });
                            return false;
                
        });



  });
</script>



<div class="modal fade" id="agregar-situacioneconomica-credito-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar un crédito vigente al estudio No. <span id="sec_ese_id_crear"></span> "<span id="sec_ese_nombre_crear"></span>"
              </div></h5>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_situacioneconomicacredito" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="sec_sie_id" name="sec_sie_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Intitución</label>
                    <input name="sec_institucion_crear" id="sec_institucion_crear" type="text" re class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre de la institución..." maxlength="45" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tipo</label>
                    <input name="sec_tipo_crear" id="sec_tipo_crear" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tipo de crédito..."  maxlength="20"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Saldo</label>
                    <input   name="sec_saldo_crear" id="sec_saldo_crear" type="number" required  class="form-control input-rounded"  oninput="limitDecimalPlaces(event,2)" placeholder="Saldo ($)..." max="999999999"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Pago mensual</label>
                    <input   name="sec_mensual_crear" id="sec_mensual_crear" type="number" required  class="form-control input-rounded"  oninput="limitDecimalPlaces(event,2)" placeholder="Pago mensual ($)..."  max="999999999"/>

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
  