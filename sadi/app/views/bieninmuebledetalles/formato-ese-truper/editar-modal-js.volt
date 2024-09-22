<script type="">
    function fnEditarBienInmuebleDetallesFormatoTruper(bid_id){
      let form_ocupado=document.getElementById('frm_editar_formatotruper_bieninmuebledetalles');
      form_ocupado.reset();
      let url_enviar="<?php echo $this->url->get('bieninmuebledetalles/ajax_get_detalle/') ?>";
                                       
                                       $.ajax({
                                          type: "POST",
                                          url: url_enviar+bid_id,
                                           success: function(res)
                                             {   
                                                                                                                       
                                               if(res[0]==2)
                                                {
                                                                        
                                                  $('#bid_ese_id_truper_editar').text($('#ese_id_ese_actual_formato_ese_truper').text());
                                                  $('#bid_ese_nombre_truper_editar').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

                                                  $('#bid_id_truper_editar').val(res['data'].bid_id);
                                                  

                                                  let id_tipo_nombre=(res['data'].bid_nombre =='-1' || res['data'].bid_nombre == null  ) ?-1 : res['data'].bid_nombre;
                                                  $('#bid_nombre_truper_editar').val(id_tipo_nombre);
                                                  $('#bid_nombre_truper_editar').trigger('change');

                                                 

                                                  $('#bid_antiguedad_truper_editar').val(res['data'].bid_antiguedad);
                                                  $('#bid_valor_truper_editar').val(res['data'].bid_valor);

                                                  $('#bid_valor_truper_editar').val(res['data'].bid_valor);
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
          $('#frm_editar_formatotruper_bieninmuebledetalles').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                        if($('#bid_nombre_truper_editar').val()=='-1')
                          {
                        

                            Swal.fire({title:'FALTAN DATOS',text:"Debe seleccionar el tipo de bieninmueble..",type:"warning"})
                                                            .then((value) => {
                                                });
                            return false;                                        
                          }
                          if($('#bid_antiguedad_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar la antigüedad.")
                            return false;
                          }


                          
                          
                     
                     
                          
                        let formulario=$("#frm_editar_formatotruper_bieninmuebledetalles");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('bieninmuebledetalles/actualizar_formatotruper/') ?>";
                        $.ajax({
                                      type: "POST",
                                      url: url_enviar,
                                      data: formulario.serialize(),
                                      success: function(res)
                                      {   
                                       
                                      
                                        if(res[0]==2)
                                        {
                       

                                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                 .then((value) => {

                                                            $form.find("button").prop("disabled", false);
                                                            let form_ocupado=document.getElementById('frm_editar_formatotruper_bieninmuebledetalles');
                                                            form_ocupado.reset();
                                                            $('#editar-bieninmuebledetalles-formato_truper-modal').modal('hide');
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
 
 

<div class="modal fade" id="editar-bieninmuebledetalles-formato_truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar un bien inmueble del estudio No. <span id="bid_ese_id_truper_editar"></span> "<span id="bid_ese_nombre_truper_editar"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_formatotruper_bieninmuebledetalles" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" name="bid_id_editar" id="bid_id_truper_editar" />

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Bien</label>
                  <select name="bid_nombre_editar" id="bid_nombre_truper_editar" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup class="text-uppercase">
                      <option value="-1">Seleccionar ...</option>
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
                  <input name="bid_antiguedad_editar" id="bid_antiguedad_truper_editar" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Antigüedad..."  maxlength="100"/>

                </div>

                <div class="col-lg-12">
                  <label class="col-form-label title-busq">Valor</label>
                  <input   name="bid_valor_editar" id="bid_valor_truper_editar" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Valor($)..."  maxlength="20"/>

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
