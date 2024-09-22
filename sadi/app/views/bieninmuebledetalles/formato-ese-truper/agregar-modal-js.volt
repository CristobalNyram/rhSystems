<script type="">
   function fnCrearBienInmuebleDetallesFormatoTruper(){
    // $('#agd_agf_id').val($('#agf_id').val());
     let form_ocupado=document.getElementById('frm-formato_truper_crear_bieninmuebledetalles');
      form_ocupado.reset();
     $('#bid_ese_id-formato_truper_crear').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#bid_ese_nombre-formato_truper_crear').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

      $('#bid_nombre-formato_truper').val(-1);
      $('#bid_nombre-formato_truper').trigger('change');
     

     $('#bid_bie_id_formatotruper').val($('#ans_bie_id-formato_truper').val());
     
    }
    $(function (){
          $('#frm-formato_truper_crear_bieninmuebledetalles').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                          if($('#bid_nombre-formato_truper').val()=='-1')
                          {
                            Swal.fire({title:'FALTAN DATOS',text:"Debe seleccionar el tipo de bieninmueble..",type:"warning"})
                                                            .then((value) => {
                                                });
                            return false;      
                          }

                          
                          if($('#bid_valor-formato_truper_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el valor .")
                            return false;
                          }
                 
                         
                     
                          
                        let formulario=$("#frm-formato_truper_crear_bieninmuebledetalles");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('bieninmuebledetalles/crear_formatotruper/') ?>";
                                       
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
                                                        let form_ocupado=document.getElementById('frm-formato_truper_crear_bieninmuebledetalles');
                                                        form_ocupado.reset();

                                                        $('#agregar-bieninmuebledetalles-formato_truper-modal').modal('hide');
                                                        fnCargarTablaDatoBienInmuebleDetallesFormatoTruper(res['bie_id']);                                                          
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



<div class="modal fade" id="agregar-bieninmuebledetalles-formato_truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar un bien inmueble al estudio No. <span id="bid_ese_id-formato_truper_crear"></span> "<span id="bid_ese_nombre-formato_truper_crear"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm-formato_truper_crear_bieninmuebledetalles" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" name="bid_bie_id" id="bid_bie_id_formatotruper" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Bien</label>
              
                      <select name="bid_nombre_crear" id="bid_nombre-formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option selected value="-1">Seleccionar ...</option>
                          <option value="0">CASA					
                          </option>
                          <option value="1">DEPARTAMENTO							
                          </option>
                          <option value="2">EDIFICIO									
                          </option>
                          <option value="3">RANCHO							
                          </option>
                          <option value="4">TIEMPO COMPARTIDO							
                          </option>
                          <option value="5">TERRENO							
                          </option>
                          <option value="6">LOCALES COMERCIALES											
                          </option>
                          <option value="7">NEGOCIO										
                          </option>
          
                        </optgroup>
                      </select>
              
             
                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Antigüedad                    </label>
                    <input name="bid_antiguedad_crear" id="bid_antiguedad-formato_truper_crear" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Antigüedad..."  maxlength="100"/>

                  </div>

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Valor</label>
                    <input   name="bid_valor_crear" id="bid_valor-formato_truper_crear" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Valor ($)..."  maxlength="20"/>

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
  