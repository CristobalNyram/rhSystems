<script type="">
   function fnCrearAutomovilDetallesFormatoTruper(){
    // $('#agd_agf_id').val($('#agf_id').val());
     let form_ocupado=document.getElementById('frm_crear_automovil_formato_truper');
      form_ocupado.reset();
     $('#aut_ese_id_crear_formatotruper').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#aut_ese_nombre_crear_formatotruper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

     $('#aut_bie_id-formato_truper').val($('#ans_bie_id-formato_truper').val());
     fngetDataTipoAuto_FormatoTruper(0,$('#aut_tipo_crear_formatotruper'));
    }
    $(function (){
          $('#frm_crear_automovil_formato_truper').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                          if($('#aut_marca_crear_formatotruper').val()=='')
                          {
                         
                            Swal.fire({title:'FALTAN DATOS',text:"Debe llenar la marca.",type:"warning"})
                                                            .then((value) => {
                                                });
                                                return false;                                        

                          }
                       /*   if($('#aut_modelo_crear_formatotruper').val()=='')
                          {
                          
                            Swal.fire({title:'FALTAN DATOS',text:"Debe llenar el modelo.",type:"warning"})
                                                            .then((value) => {
                                                });

                                                return false;                                        
                    
                          }*/
                          if($('#aut_tipo_crear_formatotruper').val()=='-2' || $('#aut_tipo_crear_formatotruper').val()=='-1')
                          {
                       

                            Swal.fire({title:'FALTAN DATOS',text:"Debe seleccionar el tipo de automóvil.",type:"warning"})
                                                            .then((value) => {
                                                });
                            return false;                                        
                    
                          }
                 
                         
                     
                          
                        let formulario=$("#frm_crear_automovil_formato_truper");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('automovil/crear/') ?>";
                                       
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
                                                              let form_ocupado=document.getElementById('frm_crear_automovil_formato_truper');
                                                              form_ocupado.reset();

                                                              $('#agregar-automovil-formato-truper-modal').modal('hide');
                                                              fnCargarTablaAutomovilDetallesFormatoTruper(res['bie_id']);                                                          
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



<div class="modal fade" id="agregar-automovil-formato-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agrega un automóvil al estudio No. <span id="aut_ese_id_crear_formatotruper"></span> "<span id="aut_ese_nombre_crear_formatotruper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_automovil_formato_truper" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="aut_bie_id-formato_truper" name="aut_bie_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tipo</label>
                    <select name="aut_tipo_crear" id="aut_tipo_crear_formatotruper" required class="form-control select2-single "   data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Valor</label>
                    <input   name="aut_valor_crear" id="aut_valor_crear_formatotruper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Valor ($)..."  maxlength="20"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Marca</label>
                    <input name="aut_marca_crear" id="aut_marca_crear_formatotruper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Marca..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6" style="display:none;">
                    <label class="col-form-label title-busq">Modelo (Año)</label>
                    <input   name="aut_modelo_crear" id="aut_modelo_crear_formatotruper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Modelo..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Modelo Año</label>
                    <input   name="aut_anio_crear" id="aut_anio_crear_formatotruper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Año..."  maxlength="45"/>

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
  