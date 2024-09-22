<!-- links start  -->
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}

<!-- links end -->

<script>
$(document).ready(function(){
  
  var url_descarga="<?php echo $this->url->get('reporte/respuestascuestionariodos/') ?>";

  $("#form_reporte_calificacion_cuestionario_2").submit(function(event) 
      {
        event.preventDefault();
  var urlEnviar="<?php echo $this->url->get('reporte/manejadorconsultacuestionario2/') ?>";
         $.ajax(
           {
                url:urlEnviar,
                type:"POST",
                data:$("#form_reporte_calificacion_cuestionario_2").serialize(),
                success: function(res)
                {
                  var res = eval("("+res+")");
                  const respuesta = Object.values(res);
                  if(respuesta[0]>=1)
                  {
                    window.open(url_descarga+respuesta[1]+"/"+res["fol_id"]);
                  }
                  else
                  {
                    alertify.errorAlert('No hay registros en el filtro seleccionado.');
                  }

                },
                error: function(res)
                {
                }
              }
            );


         }); 
    
});      

</script>


<div class="mb-2">

       <div class="card card-crm ">
         
               <div class="text-center col-md-12 ">
                           <div class="mt-1">
                                      <span class="font-16 btn-link-crm">
                                          Reporte de las calificaciones de los cuestionarios 2 de la NOM-35

                                      </span>
                           </div>
                 </div>
                      <hr class="line-down">
                      
                <form class="container" method="post" enctype="multipart/form-data" id="form_reporte_calificacion_cuestionario_2">
                      <div class="row">
                        <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                          <label class="col-form-label title-busq font-17 ">Selecciona  la empresa:</label>
                        </div>
                        <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                          <label class="col-form-label title-busq font-17 ">Folio:</label>
                        </div>

                        
                      
                      </div>
                      <div class="row">
                            <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                              <select name="emp_id" id="empresa_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                                <optgroup>
                                    <option   value="-1" >Todas</option>
                                    {% for empresa in empresas %}
                                    <option   value="{{empresa['emp_id']}}" >{{empresa['emp_nombre']}}</option>
                                                         
                                   {% endfor %}
                 
                                </optgroup>
                              </select>
                            </div>
                            <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                              <select name="fol_id" id="folio" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                                <optgroup>
                                    <option   value="" >Todos</option>
                                {% for fol in folios %}
                                    {% set selected =  '' %}
    
                                    <option value="{{ fol['fol_id'] }}" {{ selected }}>{{ fol['fol_id'] }}.-{{ fol['fol_nombre'] }}</option>
                                    {% endfor %}
                                        
                                </optgroup>
                              </select>

                                  <!-- <input type="number" oninput="soloNumeroPositivos(event);"  step="00.00" name="fol_id" id="folio" placeholder="Folio"  class="form-control  input-rounded "> -->
                            </div>


                
                        
                      </div>

                      <div class="d-flex justify-content-end mt-4">
                        <div class="col-lg-3 col-md-3 col-lx-3 col-sm-4  mt-2 padding-responsive">
                          <div class="form-group">                                         
                           <button class="btn-dark btn-rounded btn btn-buscar ">Generar reporte <i class="mdi mdi-download white"></i> </button>
                         </div>
                        </div>

                      </div>
                </form>

        </div>  

</div>


<div class="container  bg-white rounded ">

   
   <div class="row">
    
            

        <div class="row m-5"  id="contentdownload"  style="display: none;">

          <div class="row " >
            
            
            <button >
             {{ link_To(["reporte/respuestascuestionariotres/",'class':'font-16 btn-link-crm d-flex mr-auto ml-auto','<i class="mdi mdi-download"></i> Descargable EXCEL de cuestionario 3 NOM-35</span> <i class="mdi mdi-download"></i>']) }}                  
            </button>
          </div>
        

          
        </div>
        
      
           
   </div>
  
</div>











