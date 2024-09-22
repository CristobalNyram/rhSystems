<script>
     $(document).ready(()=>{
      $("#form_tipoestudio").submit(function(event){
      let $form =$(this);
      event.preventDefault();
      let honorarioMin= $('#tipoestudio_transportemin').val();
      let honorarioMax= $('#tipoestudio_transportemax').val();
      
      if((honorarioMax===honorarioMin) || (honorarioMin>=honorarioMax))
      {
        // alertify.alert('ERROR','Agregué un honorario valido.');
        Swal.fire({title:'ERROR',text:'Agregué un honorario valido.',type:"error"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
                                                                     return false;
      }
      else
      {
        $form.find("button").prop("disabled", true);
        var urled="<?php echo $this->url->get('transporte/comprobar_transporte_investigador/') ?>";

        $.ajax({
              type: "POST",
              url: urled,
              data: $("#form_tipoestudio").serialize(),
              success: function(res)
              {      
              
                if(res[0]==2)
                {
       
                  Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                 .then((value) => {
                                                                     location.reload();  
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
                  alert('Error en el servidor...');
              }
            });
          }
      });



    });
</script>

<div class="modal fade" id="modal_nuevo_tps" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">Crear tipo de estudio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
  
                 <form action="" id="form_tipoestudio">
  
                        <div class="form-group row mt-2">
                              <div class="col-lg-4">
                                <label class="col-form-label title-busq" for="tipoestudio_nombre">Nombre del tipo de estudio:</label>
                                <input type="text" class="form-control input-rounded" name="tipoestudio_nombre" id="tipoestudio_nombre" placeholder="Nombre del tipo de estudio..."  oninput="handleInput(event)" />
                              </div>
  
                              <div class="col-lg-8">
                                <label class="col-form-label title-busq" for="tipoestudio_descripcion">Descripción:</label>
                                <input type="text" class="form-control input-rounded" placeholder="Descripción..."  name="tipoestudio_descripcion" id="tipoestudio_descripcion"  oninput="handleInput(event)"/>
                              </div>      
                        </div>
                        <div class="form-group row mt-2">
                              <div class="col-lg-5">
                                <label class="col-form-label title-busq" for="tipoestudio_honorario">Honorario:</label>
                                <input type="number" class="form-control input-rounded" placeholder="Honorario...($)"  name="tipoestudio_honorario" id="tipoestudio_honorario"  oninput="handleInput(event)"/>
  
                              </div>  
  
                              <div class="col-lg-5">
                                <label class="col-form-label title-busq" for="tipoestudio_transportemin">Transporte:</label>
                                    <div class="input-group" id="">
                                      <input type="number" id="tipoestudio_transportemin" name="tipoestudio_transportemin" class="form-control bar-left" value" placeholder="Mínimo ($)"  oninput="limitDecimalPlaces(event,2)"/>
                                      <input type="number" id="tipoestudio_transportemax" name="tipoestudio_transportemax" class="form-control bar-right" placeholder="Máxima ($)" value="" oninput="limitDecimalPlaces(event,2)"/>
                                    </div>
  
                              </div>
                        </div>  
                    
  
                        <div class="row col-lg-12">
                          <div class="col-sm-6 col-md-6 text-center mt-5">
                          </div>
                          <div class="col-sm-3 col-md-3 text-center mt-5">
                              <div class="form-group">
                                <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                              </div>
                          </div>
                          <div class="col-sm-3 col-md-3  text-center mt-5 ">
                              <div class="form-group">
                                <button class="btn-dark btn-rounded btn btn-buscar" id="btn_nuevo_guardar_tipo_estudio">Guardar <i class="mdi mdi-content-save white"></i> </button>
                              </div>
                          </div>
                        </div>
                </form>
            
         </div>
                    
        
        </div>
      </div>
    </div>
  </div>
  
  