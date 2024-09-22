<script>
$(document).ready(function()
{






$('#fechaCuestionarioActivadosForm').submit(()=>
{
      var fechaInicio = $('input[name=con_fechaini_edit]').val();    
      var fechaFinal= $('input[name=con_fechafin_edit]').val();

      var dateStart=  fechaInicio.split('-').reverse();
      var dateEnd=  fechaFinal.split('-').reverse();
      var dateS=new Date(dateStart);
      var dateE=new Date(dateEnd);


      if(fechaInicio === '' || fechaFinal =='')
      {
        alertify.errorAlert('Los campos deben ser llenados'); 
      }
      else if(fechaInicio===fechaFinal)
      {
        alertify.errorAlert('Deben ser fechas diferentes');
      }
      else if(dateS>dateE)
      {
        alertify.errorAlert('La fecha de inicio debe ser menor a la fecha de fin.');

      }
      else
      {
        var fechaIniciNewFormat=dateStart[0]+'-'+dateStart[1]+'-'+dateStart[2];
        var fechaFinalNewFormat=dateEnd[0]+'-'+dateEnd[1]+'-'+dateEnd[2];
        var formulario =$(this);
        var urlSend="<?php echo $this->url->get('configuracion/actualizarfechadecuestionarioactivo/') ?>";

       formulario.find("button").prop("disabled", true);

       $.ajax({
        url:urlSend,
        type:"POST",
        data:
        {
          'fechaInicio':fechaIniciNewFormat,
          'fechaFinal':fechaFinalNewFormat
        },
        success: function(res)
                      { 
                        if(res==='1')
                        {
                          alertify.alert('Actualizado','Hemos actualizado las fechas de los cuestionarios.',function(){ $('#cambiarCuestionarioActivo').modal('hide');  formulario.find("button").prop("disabled", false);  location.reload();});
                          
                        }
                        else if(res==='-1')
                        {
                          alertify.alert('ERROR','Error al cargar los datos');
                        }

                       }
                      ,
        error: function(res)
                       {
                       }
       });
                     
                                          
       
      }
    

});
  
});




</script>

<div class="mt-3">
    <div class="card card-crm">
      <div class="text-center col-md-12 ">
        <div class="mt-1"><span class="font-16 btn-link-crm">{{estadoconf['nombre']}}</span>
        </div>
      </div>
      <hr class="line-down">

      <div class="container  justify-content-center">
          <div class="row">             
                 <table class="table" id="table_con_estatus">
                        <thead>
                           <tr>
                             <th scope="col" class="text-center">Fecha inicio </th>
                             <th scope="col" class="text-center">Fecha final</th>
                              <th scope="col " class="text-center">Número de días de activación</th>
                              <th scope="col" class="text-center">Tiempo restante</th>
                           </tr>
                           </thead>
                                              <tbody>
                               <tr>
                                <td class="font-weight-bold text-center" id="con_fechaini_status">    
                                  {{ date("d-m-Y ", strtotime(estadoconf['fechainicio'])) }}
                                </td>
                                 <td class="font-weight-bold text-center" id="con_fechafin_status"> 
                                  
                                    {{ date("d-m-Y ", strtotime(estadoconf['fechafinal'])) }}
                                  </td>
                                 <td class="font-weight-bold text-center">
                                   {{estadoconf['diasactvios']}}
                                  </td>
                                 <td class="font-weight-bold text-center">
                                  
                                   {%if estadoconf['formatoMensaje']==1 %}
                                                {{estadoconf['diasrestantes']}}
                                    {% else %}
                                          <div class="text-danger">{{estadoconf['diasrestantes']}}</div>
                                    {% endif %}
                                 </td>
                                
                                 
                          
                               </tr>  
                      </tbody>
                  </table>
            
          </div>

        </div>

      <div class="col-12 row justify-content-end">

                        <div class="col-lg-3 col-12  col-sm-6 text-right mt-5 offset-lg-0">
                                <div class="form-group mr-5">

                                  <a href="#" data-toggle="modal" data-target="#cambiarCuestionarioActivo" class="btn-dark btn-rounded btn btn-buscar mt-5 mr-5"> Actualizar fecha límite <i class="fas fa-exchange-alt"></i></a>

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
                              <center>
                              <h5 class="" id="exampleModalLabel text-center">Actualizar fecha límite de cuestionarios</h5>
                            </center>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">

                              <form method="post" target="_self" id="fechaCuestionarioActivadosForm"  onsubmit="return false" class="form-vertical mt-1">
                                <div class="form-group row">
                           
                               
                                 
                                  <div class="col-lg-3 col-xl-6">
                                    <label class="col-form-label title-busq">Fecha de inicio</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-rounded-right" placeholder="dd-mm-yyyy" name="con_fechaini_edit" id="datepicker-autoclose" >
                                      <div class="input-group-append">
                                          <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                      </div>
                                    </div>
                                  </div>

                                     
                                  <div class="col-lg-3 col-xl-6">
                                    <label class="col-form-label title-busq">Fecha de final</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control input-rounded-right" placeholder="dd-mm-yyyy"  name="con_fechafin_edit" id="datepicker">
                                      <div class="input-group-append">
                                          <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                      </div>
                                    </div>
                                  </div>


                                  
                                  <div class="col-12 row justify-content-end">
                         
                                    <div class="col-sm-3 col-md-3 text-center mt-5">
                                        <div class="form-group">
                                          <button type="button"  data-dismiss="modal"  class="btn-dark btn-rounded btn btn-limpiar"><i class=" mdi mdi-close white"></i>  Cancelar</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3  text-center mt-5 ">
                                        <div class="form-group">
                                          <button class="btn-dark btn-rounded btn btn-buscar">Actualizar <i class="mdi mdi-chevron-right white"></i> </button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </form>      
                            </div>

                      </div>

  </div>


</div>


<!-- END MODDAL--------------------------------------------------------------------------------------------END MODAL-->

<script>
  //FILL THE MODAL
var dateStartModal=($("td[id=con_fechaini_status]").text());
var dateEndModal=($("td[id=con_fechafin_status]").text());
$('input[name=con_fechaini_edit]').val(dateStartModal.trim());
$('input[name=con_fechafin_edit]').val(dateEndModal.trim());

</script>