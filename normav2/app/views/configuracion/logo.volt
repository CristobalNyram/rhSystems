<script type="text/javascript">
  $(function (){
    $("#frm_cambiarlogo").submit(function(event) 
    {
      var archivos = document.getElementById("img_logo");//Creamos un objeto con el elemento que contiene los archivos: el campo 
      var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
      //Creamos una instancia del Objeto FormDara.
      var archivos = new FormData();
       /* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
       Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
       indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/  

       for(i=0; i<archivo.length; i++){
          archivos.append('img_logo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice 

       }
      
      var url="<?php echo $this->url->get('configuracion/cambiarlogo/') ?>";
  
      $.ajax({
        url: url,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        contentType:false, //Debe estar en false para que pase el objeto sin procesar
        data:archivos, //Le pasamos el objeto que creamos con los archivos
        processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
        cache:false, //Para que el formulario no guarde cache
        success: function(res)
          {
 if(res[0]<=0)
 {
   alertify.alert("Error",res[1]);
 }
 else
 {
   // cargarlista();
   alertify.alert("Éxito","Archivo subido correctamente.", function(){ 
    location.reload();
  
   });
 }
                     

              // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          { 
  
            // $form.find("button").prop("disabled", false); 
          }
      
      });
      return false;
    });
  });
  </script>
    </script>
    
    
    <div class="mt-3">
        <div class="card card-crm">
          <div class="text-center col-md-12 ">
            <div class="mt-1"><span class="font-16 btn-link-crm">{{estatusLogoConfiguracion['con_nombre']}}</span>
            </div>
          </div>
          <hr class="line-down">
    
    


          <div class="col-md-12">
                <div class="row">
                        <div class="col-md-4">
                        </div> 
                    <div class="col-md-2">
                          <div class="member-thumb mb-2 center-page mx-auto row">
                                <div class="col-2">
                                  {{ image("assets/images/config/"~logoactual,"height": "100","alt": "profile-image", "class": "") }}

                                </div>
                            </div>
                    </div>
                </div>
         </div>
    
    
          <div class="col-12 row justify-content-end">
    
                            <div class="col-lg-3 col-12  col-sm-6 text-right mt-5 offset-lg-0">
                                    <div class="form-group">    
                                 
                                      <a href="#" data-toggle="modal" data-target="#cambiar-logo-modal" class="btn-dark btn-rounded btn btn-buscar"> Actualizar logo <i class="fas fa-exchange-alt"></i></a>
                                 
                                    </div>
                            </div>
          </div>
                              <!-- </div> -->
                            <!-- </div> -->
    
        </div>
    </div>
    
    <!-- START MODDAL ---------------------------------------------------------------------------------------------------START MODAL-->
    
    <div class="modal fade" id="cambiar-logo-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog detalle modal-dialog-scrollable">
      
      
      
                            <div class="modal-content" id="contentSession">
                                  <div class="modal-header text-center">
                                    <h5 class="" id="exampleModalLabel"><br>{{estatusLogoConfiguracion['con_nombre']}} </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
      
                                 <form id="frm_cambiarlogo" enctype="multipart/form-data" class="form-horizontal form-label-left captura">
   
                                                <div class="col-lg-6 mb-4">
                                                  
                                                    <label class="col-form-label title-busq">Para cambiar logo, seleccionar nuevo archivo (mínimo tamaño recomendado de 150px x 150px)</label>
                                                    <div class="form-group mb-0">
                                                      <input type="file" id="img_logo" accept="image/png, image/jpg, image/jpeg" name="img_logo" required="required" class="filestyle" data-btnClass="btn filestyle-rounded">
                                                    </div>
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