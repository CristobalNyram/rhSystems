<style>

  </style>
<script>
    $(document).ready(()=>
    {
    
      
    $('#actualizarAnuncioGracias1Form').submit(()=>
    {
    
      var $form = $(this);
      var urlenviar="<?php echo $this->url->get('configuracion/actualizaranuncio/') ?>";
       $.ajax(
        {
        type: "POST",
        url: urlenviar,
        data: $("#actualizarAnuncioGracias1Form").serialize(),
        success:function(res)
    {

          if(res[0])
          {
            alertify.alert("Éxito","Se actualizó exitosamente el  <strong> {{configuracion_mensaje['con_nombre']}}.</strong> ",function(){ $('#actualizarAnuncioBienvenidaForm').modal('hide');  $form.find("button").prop("disabled", false);  location.reload();});
          
          
          
          }
          else
          {
            alertify.errorAlert('Error',"<strong>NO se actualizó </strong>  el {{configuracion_mensaje['con_nombre']}}.",function(){ $('#actualizarAnuncioBienvenidaForm').modal('hide');  $form.find("button").prop("disabled", false);});

          }
      
    }
    ,error:function(error)
    {
      alertify.errorAlert('Error',"<strong>NO se actualizó </strong> exitosamente el  {{configuracion_mensaje['con_nombre']}}.",function(){ $('#actualizarAnuncioBienvenidaForm').modal('hide');  $form.find("button").prop("disabled", false);});

    }
        }
       );
       
      
    
                    
    
       
     
    
    });
    
    
    });
    </script>
    
    
    <div class="mt-3">
        <div class="card card-crm">
          <div class="text-center col-md-12 ">
            <div class="mt-1"><span class="font-16 btn-link-crm">{{configuracion_mensaje['con_nombre']}}</span>
            </div>
          </div>
          <hr class="line-down">
    
    
                  <div class="container  justify-content-center">
                      <div class="row mt-2 mb-2 ">  
                        <div class="col-12 border border-primary p-3 lead" >
                          {{configuracion_mensaje['con_texto']}}
                        </div>                                          
                        
                      </div>
                   </div>
    
    
          <div class="col-12 row justify-content-end">
    
                            <div class="col-lg-3 col-12  col-sm-6 text-right mt-5 offset-lg-0">
                                    <div class="form-group">
    
    
                                      <a href="#" data-toggle="modal" data-target="#actualizarAnuncioGracias1-modal" class="btn-dark btn-rounded btn btn-buscar"> Actualizar anuncio de gracias <i class="fas fa-exchange-alt"></i></a>
    
    
    
                                  </div>
                            </div>
          </div>
                              <!-- </div> -->
                            <!-- </div> -->
    
        </div>
    </div>
    
    <!-- START MODDAL ---------------------------------------------------------------------------------------------------START MODAL-->
    
    <div class="modal fade" id="actualizarAnuncioGracias1-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
      
      
      
                            <div class="modal-content" id="contentSession">
                                  <div class="modal-header text-center">
                                    <h5 class="" id="exampleModalLabel"><br>{{configuracion_mensaje['con_nombre']}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
      
                                    <form method="post" target="_self" id="actualizarAnuncioGracias1Form"  onsubmit="return false" class="form-vertical mt-1">
                                      <input type="number" style="display:none;" value="{{configuracion_mensaje['con_id']}}" name="con_id_edit">  

                                      
                                      <div class="md-form amber-textarea active-amber-textarea"> 
                                        <i class="fas fa-pencil-alt prefix"></i> 
                                        <textarea id="con_nombre_edit" name="con_nombre_edit" class="md-textarea form-control" style="min-height:90px" rows="3"> {{configuracion_mensaje['con_texto_edit']}}</textarea>
                                        <!-- <label for="form24">Editar</label> -->

                                      </div>
      
                      
      
                                                  <div class="col-lg-12    text-center d-flex justify-content-end mt-5">
                                                      <div class="form-group col-lg-3 ">
                                                        <a class="btn-dark btn-rounded btn btn-limpiar"  data-dismiss="modal"  ><i class=" mdi mdi-close white"></i>  Cancelar</a>
                                                      </div>
                                                      <div class="form-group col-lg-3">
                                                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Actualizar  <i class="fas fa-exchange-alt"></i> </button>
                                                      </div>
    
                                                  </div>
      
      
      
      
      
      
      
                                    </form>
      
      
                                  </div>
      
      
      
                            </div>
      
      
      
        </div>
      
      
      
      
      </div>
      
      
      <!-- END MODDAL--------------------------------------------------------------------------------------------END MODAL-->