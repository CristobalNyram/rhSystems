
{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
			integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>


{% include "/encuestacalidadreporte/complementos/vdos/reporte/script-tabla-reporte-encuestas-js.volt" %}
{% include "/encuestacalidadreporte/complementos/vdos/reporte/script-tabla-reporte-respuestas-js.volt" %}

{% include "/investigador/script-ajax-get-todos.volt" %}
{% include "/empresa/script-ajax-get-todos.volt" %}
{% include "/analista/script-ajax-get-todos.volt" %}

<script type="text/javascript">
    
    $(document).ready(function(){
     
      setMesAnterior('enc_fecha-reporte');
      fnGetTodosLosInvestigadores('inv_id-reporte');
      fnGetTodasEmpresas('emp_id-reporte');
      fnGetTodosLosAnalistas('ana_id-reporte');



    });

    function fnRerporteRespuestas(){

    }


    function fnmostrarbusqueda(){
    
      $('.busqueda').show('slow');
      $('#otrabusqueda').hide('slow');

    }


 



    function consultar_tabla_reporte_encuesta_calidad(){

                    if($('#enc_estatus-reporte').val()=='-1'){
                      Swal.fire({title:'Aviso',text:'Falta  seleccionar el estatus de encuesta que deseas seleccionar...',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                      return false;
                    }
                    if($('#enc_formato-reporte').val()==''){
                      Swal.fire({title:'Aviso',text:'Falta  seleccionar el formato de la encuesta que deseas...',type:"warning"})
                                                      .then((value) => {
                                                    
                                          });
                      return false;
                    }
                    if($('#enc_fecha_inical-reporte').val()==''){
                      Swal.fire({title:'Aviso',text:'Falta  seleccionar la fecha inicial de entrega cliente...',type:"warning"})
                                                      .then((value) => {                               
                                          });
                      return false;
                    }


                     let fecha_consultar= $('#enc_fecha-reporte').val();
     
                     let tipo_busqueda= $('#enc_tipo-reporte').val();

                     document.getElementById("listado-encuestas").innerHTML="";
                     document.getElementById("listado-respuestas").innerHTML="";
                     //

                     
                     if(tipo_busqueda=='1'){
                      consultar_tabla_reporte_respuestas();
                      $('#listado-graficas-respuestas-container').show();
                   

                     }
                     if(tipo_busqueda=='2'){
                      consultar_tabla_reporte_encuesta();
                      $('#listado-graficas-respuestas-container').hide();

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
    
      {% include "/encuestacalidadreporte/complementos/vdos/reporte_vdos_form.volt" %}

      {% endif %}
    </div>

    <!-- listado de encuesta /respuestas tabla inicio -->
    <div class="card card-crm" id="listado-encuestas" style="display: none;">
    </div>

    <div class="card card-crm" id="listado-respuestas" style="display: none;">
    </div>
    <!-- listado de encuesta /respuestas tabla fin -->


    
        <!-- end content -->

  </div>
    <!-- END content-page -->

</div>

        <!-- END wrapper -->