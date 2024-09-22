<!-- {{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }} -->

<!-- {{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }} -->
{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}

<!-- {{ javascript_include("assets/libs/jspdf/jspdf.min.js") }}
{{ javascript_include("assets/libs/jspdf/jspdf.debug.js") }}
{{ javascript_include("assets/libs/html2canvas/html2canvas.min.js") }} -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
			integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>


{% include "/encuestacalidad/reporte/script-tabla-reporte-encuestas-js.volt" %}
{% include "/encuestacalidad/reporte/script-tabla-reporte-respuestas-js.volt" %}
{% include "/encuestacalidad/reporte/script-graficas-respuestas-js.volt" %}
{% include "/investigador/script-ajax-get-todos.volt" %}


<script type="text/javascript">
    
    $(document).ready(function(){
     
      setMesAnterior('enc_fecha-reporte');
      fnGetTodosLosInvestigadores('inv_id-reporte');




    })

    function fnRerporteRespuestas(){
     /* let doc = new jsPDF();
      doc.text(20, 20, 'Hello world!');
      doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
      doc.addPage();
      doc.text(20, 20, 'Do you like that?');

      doc.save('Test.pdf');*/

      


    }


    function fnmostrarbusqueda(){
    
      $('.busqueda').show('slow');
      $('#otrabusqueda').hide('slow');

    }

    function fnConsultarReporteRespuestasEstadisticasPDF(fecha_input,tipo_reporte=0,inv_id_input=0){

      let inv_id=(inv_id_input.val()=='-1') ? 0 :inv_id_input.val();
    
      let url_data="<?php echo $this->url->get('reporte/respuesta_estadisticas_servicio_calidad/') ?>";
      let fecha =fecha_input.val();
      let fechaObj = new Date(fecha);
      let mes= fecha.substring(fecha.length - 2)
      let anio = fecha.split("-")[0]; // extrae 

      url_data+=`${mes}/${anio}/${tipo_reporte}/${inv_id}`;
      window.open(url_data, "_blank");

    }

 



    function consultar_tabla_reporte_encuesta_calidad(){

                    if($('#enc_estatus-reporte').val()=='-1'){
                      Swal.fire({title:'Aviso',text:'Falta  seleccionar el estatus de encuesta que deseas seleccionar...',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                      return false;
                    }

                     let fecha_consultar= $('#enc_fecha-reporte').val();
     
                     let tipo_busqueda= $('#enc_tipo-reporte').val();

                     document.getElementById("listado-encuestas").innerHTML="";
                     document.getElementById("listado-respuestas").innerHTML="";
                     fnLimipiarGraficasReporteRespuestasCalidad();
                     //

                     
                     if(tipo_busqueda=='1'){
                      consultar_tabla_reporte_respuestas();
                      consultar_estadisticas_respuestas('form_encuestas_respuestas');
                      $('#listado-graficas-respuestas-container').show();
                     // $('#listado-graficas-respuestas').show();
                      //$('#listado-graficas-respuestas-row').hide();

                     }
                     if(tipo_busqueda=='2'){
                      consultar_tabla_reporte_encuesta();
                      $('#listado-graficas-respuestas-container').hide();
                     // $('#listado-graficas-respuestas').hide();
                      //$('#listado-graficas-respuestas-row').show();


                     }

         


                  

                
    }

    function verificar_que_tipo_busqueda_mostrar(event,select_id){

      let event_value=event.currentTarget.value;


      if(event_value!='3'){

        $('#enc_tipo-reporte').empty();
        $("#enc_tipo-reporte").append("<option value='2'>Ver listado de encuestas</option>");
        $("#enc_tipo-reporte option[value='2']").prop('selected', true);
        $('#enc_tipo-reporte').trigger('change');
        //$('.usu_id-reporte').hide('hide');

       // $('#usu_id-reporte').empty();


      }else{
        $('#enc_tipo-reporte').empty();
        $("#enc_tipo-reporte").append("<option value='1'>Ver Respuestas</option> <option value='2'>Ver listado de encuestas</option>");
        $("#enc_tipo-reporte option[value='1']").prop('selected', true);
        $('#enc_tipo-reporte').trigger('change');
        //$('.usu_id-reporte').show('slow');
        //fnGetTodosLosInvestigadores('usu_id-reporte');

      }

    }


      

</script>


<div class="row">
  <div class="col-9">
          <h4 class="header-title header-title-crm">Reporte: respuesta de encuesta calidad en el servicio</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
    </div>
  </div>
</div>
<div class="mt-3">
  <div class="card card-crm">
    <div id="busqueda" name="busqueda" class="busqueda">
      {% if acceso.verificar(75,rol_id)==1 %}
    
    <form id="form_encuestas_respuestas"  class="form-vertical col-md-12 row">
            <div class="col-lg-3  fecha_consulta">
              
                    
                             <label class="col-form-label  title-busq" for="enc_fecha-reporte">Rango de Fecha</label>
                              
                                        <input style="    
                                                border-radius: 44px;
                                                " 
                                        onchange="fecha_no_mayor_a_la_actual_MES_ANIO(event.currentTarget.value,'enc_fecha-reporte','btn_buscar_enc')" type="month" id="enc_fecha-reporte" name="enc_fecha" class="form-control bar-left"  />

              

            </div>

            <div class="col-lg-3  usu_id-reporte" >
              
                    
                            <label class="col-form-label  title-busq" for="enc_fecha-reporte">Investigador</label>
                              
                            <select name="inv_id" id="inv_id-reporte" onchange="" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
                           
                            </select>             

              

            </div>

            <div class="col-lg-3">
            
                  <label class="col-form-label  title-busq">Estatus de encuestas</label>
          
                  <select name="enc_estatus" id="enc_estatus-reporte" onchange="verificar_que_tipo_busqueda_mostrar(event,'enc_tipo-reporte')" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
                    <optgroup>
                      <option value="0">Todas las encuestas</option>
                      <option value="3" selected >Encuestas contestadas</option>
                      <option value="2">Encuestas pendientes</option>

                      <option value="1">Encuestas no contestadas</option>
                    </optgroup>
                  </select>             
              
            </div>


            <div class="col-lg-3">
            
                  <label class="col-form-label  title-busq">Tipo de busqueda</label>
          
                  <select name="enc_tipo" id="enc_tipo-reporte" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
                    <optgroup>
                      <option value="1" selected>Ver Respuestas</option>
                      <option value="2">Ver listado de encuestas</option>
          
                    </optgroup>
                  </select>             
          
               </div>
  
            </div>
          
            <div class="col-12 d-flex justify-content-end mt-4 busqueda">
                <div class="col-lg-3 col-9  text-right busqueda">
                    <div class="form-group busqueda">
                   <!-- <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>  -->

                   <button type="submit" id="btn_buscar_enc" name="btn_buscar_enc" onclick="consultar_tabla_reporte_encuesta_calidad(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar" ><i class=" mdi mdi-magnify white"></i>  Buscar</button> 
                  </div>
               </div>
               <div class="col-lg-1 col-3  text-right busqueda">
                   <div class="form-group">
                   {{ link_to('encuestacalidad/reporte', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
                   </div>
               </div>

            </div>
    
    
        
  
    </form>
      {% endif %}
    </div>

    <div class="card card-crm" id="listado-encuestas" style="display: none;">
    
    </div>

    <div class="card card-crm" id="listado-respuestas" style="display: none;">
    
    </div>

    <div class="card card-crm d-flex " id="listado-graficas-respuestas-container" style="display: none;">
      <div id="texto-cabezera-reporte-respuesta" class="text-center texto-graficas" >
       

      </div>

        <div class="row" id="listado-graficas-respuestas" style="display: none;">
          <div class="col-12 col-md-12 mb-5 border-bottom">

            <div id="textos-reporte-respuestas-pregunta-1" class="text-center texto-graficas" >
            </div>

            <div id="pie-chart-reporte-respuestas-pregunta-1" class="pie-chart-reporte-respuestas"></div>

            

            

          </div>
    
          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-2" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-2" class="pie-chart-reporte-respuestas"></div>
           
          </div>
    
          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-3" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-3" class="pie-chart-reporte-respuestas"> </div>
           
          </div>

          
          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-4" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-4" class="pie-chart-reporte-respuestas"></div>
            
          </div>
        
          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-5" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-5" class="pie-chart-reporte-respuestas"></div>
           
          </div>
        
          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-6" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-6" class="pie-chart-reporte-respuestas"></div>
          
          </div>

          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-7" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-7" class="pie-chart-reporte-respuestas"></div>
           
          </div>


          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-8" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-8" class="pie-chart-reporte-respuestas"></div>
          
          </div>


          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-9" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-9" class="pie-chart-reporte-respuestas"></div>
           
          </div>

          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-10" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-10" class="pie-chart-reporte-respuestas"></div>
            
          </div>

          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-11" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-11" class="pie-chart-reporte-respuestas"></div>
           
          </div>

          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-12" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-12" class="pie-chart-reporte-respuestas"></div>
           
          </div>
          <div class="col-12 col-md-6 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-13" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-13" class="pie-chart-reporte-respuestas"></div>
          
          </div>

          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-14" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-14" class="pie-chart-reporte-respuestas"></div>
         
          </div>
        
          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-15" class="text-center texto-graficas col-12" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-15" class="pie-chart-reporte-respuestas col-12"></div>
           
          </div>
          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-16" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-16" class="pie-chart-reporte-respuestas"></div>
         
          </div>

          <div class="col-12 col-md-12 mb-5 border-bottom">
            <div id="textos-reporte-respuestas-pregunta-17" class="text-center texto-graficas" >
             

            </div>
            <div id="pie-chart-reporte-respuestas-pregunta-17" class="pie-chart-reporte-respuestas"></div>
          
          </div>


        </div>
      
     </div>

    <div class="card card-crm" id="listado-graficas-respuestas" style="display: none;">
      
     
     </div>
    
        <!-- end content -->

  </div>
    <!-- END content-page -->

</div>

        <!-- END wrapper -->