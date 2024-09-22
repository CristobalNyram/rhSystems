<script type="">
   function fnCrearBienInmuebleDetalles(){
    // $('#agd_agf_id').val($('#agf_id').val());
     let form_ocupado=document.getElementById('frm_crear_bieninmuebledetalles');
      form_ocupado.reset();
     $('#bid_ese_id_crear').text($('#ese_id_ese_actual').text());
     $('#bid_ese_nombre_crear').text($('#ese_nombrecompleto_actual').text()); 

     $('#bid_bie_id').val($('#bie_id').val());
     
    }
    $(function (){
          $('#frm_crear_bieninmuebledetalles').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                          if($('#bid_nombre_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el nombre .")
                            return false;
                          }
                          if($('#bid_ubicacion_crear').val()=='')
                          {
                            alertify.alert("Error","Debe llenar la ubicación .")
                            return false;
                          }
                 
                         
                     
                          
                        let formulario=$("#frm_crear_bieninmuebledetalles");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('bieninmuebledetalles/crear/') ?>";
                                       
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
                                                        let form_ocupado=document.getElementById('frm_crear_bieninmuebledetalles');
                                                        form_ocupado.reset();

                                                        $('#agregar-bieninmuebledetalles-modal').modal('hide');
                                                        fnRe_CargarTablaDatoBienInmuebleDetalles(res['bie_id']);                                                          
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



<div class="modal fade" id="agregar-bieninmuebledetalles-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar un bien inmueble al estudio No. <span id="bid_ese_id_crear"></span> "<span id="bid_ese_nombre_crear"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_bieninmuebledetalles" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="bid_bie_id" name="bid_bie_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="bid_nombre_crear" id="bid_nombre_crear" type="text" re class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre..." maxlength="100" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Ubicación</label>
                    <input name="bid_ubicacion_crear" id="bid_ubicacion_crear" type="text" required class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Ubicación..."  maxlength="100"/>

                  </div>

                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Valor</label>
                    <input   name="bid_valor_crear" id="bid_valor_crear" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Valor ($)..."  maxlength="20"/>

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
  