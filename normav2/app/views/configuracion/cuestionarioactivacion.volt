<script>
  
                $(document).ready(()=>{

                  let statusCuestionario = $('input[name=statusC]').each(function(indice,elemento){

                  });


                  $("#cambiarCuestionarioActivoForm").submit
                           (
                              function(event)
                               {
                                let checkBoxesCuestionarios = $("input[name=cuestionarioR]:checked");
                                let respuesta = Array();

                                //con esta funcion/variable recojemos todos los valores los checboxes activos
                                let checkBoxes = checkBoxesCuestionarios.each(function(indice,elemento){
                                  respuesta[indice]=(elemento.value);
                                });
                              
                                      //evaluamos que no pueda selecionar los tres cuestionarios a la ves
                                      if(respuesta.length>=3)
                                       {
                                          alertify.errorAlert('No puede seleccionar más de tres cuestionarios al mismo tiempo.');
                                          
                                       }
                                       
                                       //aqui evaluamos que no pueda seleccionar el cuestionario 2 y 3 
                                        else if(respuesta[0]==='C2' & respuesta[1]==='C3')
                                        {
                                          alertify.errorAlert('No puede seleccionar el cuestionario 2 y 3 al mismo tiempo.');

                                        }
                                        else if(respuesta[0]==='C2'  & respuesta[1]==='CL')
                                        {
                                          alertify.errorAlert('No puede activar un cuestionario de la NOM 35 y el de clima laboral al mismo tiempo.');

                                        }
                                        else if( respuesta[0]==='C1' & respuesta[1]==='CL')
                                        {
                                          alertify.errorAlert('No puede activar un cuestionario de la NOM 35 y el de clima laboral al mismo tiempo.');

                                        }
                                        else if( respuesta[0]==='C3' & respuesta[1]==='CL')
                                        {
                                          alertify.errorAlert('No puede activar un cuestionario de la NOM 35 y el de clima laboral al mismo tiempo.');

                                        }
                                      

                                        //here we evaluate if array is empty
                                        else if (respuesta.length===0)
                                        {
                                          alertify.errorAlert('Debes de seleccionar al menos un cuestionario.');

                                        }
                                        else
                                        {
                                            var formulario =$(this);
                                            var urlSend="<?php echo $this->url->get('configuracion/actualizarcuestionarioactivo/') ?>";
                                            formulario.find("button").prop("disabled", true);
                                            $.ajax({
                                              url:urlSend,
                                              type:"POST",
                                              data: {respuesta},
                                  
                                              success: function(res)
                                              {
                                                
                                                
                                                alertify.alert('Actualizado','Hemos actualizado los cuestionarios activos',function(){ $('#cambiarCuestionarioActivo').modal('hide');  formulario.find("button").prop("disabled", false);  location.reload();});
                                               

                                              }
                                              ,error: function(res)
                                              {
                                                alertify.alert('ERROR','Error al actualizar los cuestionarios.');

                                              }

                                            });
                                          
                                          
                                    
                                        }
 

                               }

                          );

                });

                       



                    



</script>
<div class="mt-3">
    <div class="card card-crm">
      <div class="text-center col-md-12 ">
        <div class="mt-1"><span class="font-16 btn-link-crm">Cuestionarios activos</span>
        </div>
      </div>
      <hr class="line-down">


              <div class="container  justify-content-center">
                  <div class="row">                                            
                  {% for cue in cues %}
                           {% if (cue['estado'])%}
                                      <div  id="0" class="col-11  col-sm-3   hijo_role_activo  mr-2 ml-2 text-center">
                                                <strong>
                                                      <p> 
                                                         <input id='' name='statusC' type="checkbox" class="mx-auto" disabled checked />   {{cue['nombre']}}
                                                      </p>
                                                 </strong>
                                     </div>
                                  {% else %}
                                        <div  id="0" class="col-11  col-sm-3   hijo_role_desactivo  mr-2 ml-2 text-center">
                                                <strong>
                                                    <p> 
                                                      <input id='' name='statusC' type="checkbox"  value=""  class="mx-auto" disabled />   {{cue['nombre']}}
                                                  </p>
                                              </strong>
                                        </div>
                            {% endif %}
                                                        
                  {% endfor %}
               
                  </div>
               </div>


      <div class="col-12 row justify-content-end">

                        <div class="col-lg-3 col-12  col-sm-6 text-right mt-5 offset-lg-0">
                                <div class="form-group">


                                  <a href="#" data-toggle="modal" data-target="#cambiarCuestionarioActivo" class="btn-dark btn-rounded btn btn-buscar"> Actualizar cuestionarios activos <i class="fas fa-exchange-alt"></i></a>



                              </div>
                        </div>
      </div>
                          <!-- </div> -->
                        <!-- </div> -->

    </div>
</div>





<!-- START MODDAL ---------------------------------------------------------------------------------------------------START MODAL-->



<div class="modal fade" id="cambiarCuestionarioActivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">



                      <div class="modal-content" id="contentSession">
                            <div class="modal-header text-center">
                              <h5 class="" id="exampleModalLabel"><br>Actualizar cuestionarios activos</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <form method="post" target="_self" id="cambiarCuestionarioActivoForm"  onsubmit="return false" class="form-vertical mt-1">


                                            <div class="col-lg-12">
                                                        <label class="col-form-label title-busq" >Selecciona la seríe de cuestionarios que deseas activar</label>
 
                                                          <div class="group ml-4">


                                                   {% for cue in cues %}
                                                            {% if cue['estado']==1 %}
                                                                      <li class="sub_hijo_menu puntos ">
                                                                        <p class="title-busq">
                                                                          <input id="{{cue['nombre']}}" name='cuestionarioR' value="{{cue['value']}}" checked  type="checkbox" class="mr-2"  title="Debe seleccionar alguna opción para poder actualizarlo." >
                                                                          <label for="{{cue['nombre']}}">  {{cue['nombre']}}</label>
                                                                        
                                                                        </p>
                                                                      </li>
                                 
                                                                   {% else %}

                                                                   <li class="sub_hijo_menu puntos ">
                                                                    <p class="title-busq">
                                                                      <input id="{{cue['nombre']}}" name='cuestionarioR' value="{{cue['value']}}"   type="checkbox" class="mr-2"  title="Debe seleccionar alguna opción para poder actualizarlo." >
                                                                      <label for="{{cue['nombre']}}">  {{cue['nombre']}}</label>
                                                                    
                                                                    </p>
                                                                  </li>
                                                                        
                                 
                                                             {% endif %}
                                                                                         
                                                   {% endfor %}

                                                          </div>


                                            </div>


                                            <div class="col-lg-12 m-5">

                                            </div>


                                            <div class="col-lg-12    text-center d-flex justify-content-end ">
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