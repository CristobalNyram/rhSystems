{% set cuarentaycuatro = acceso.verificar(44,rol_id) %}
{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set cuarenta = acceso.verificar(40,rol_id) %}
{% set ochenta = acceso.verificar(80,rol_id) %}

<script type="text/javascript">
  
  $(document).ready(function(){
    /*
    $(".ancla").click(function(evento){
      const element = document.getElementById("ese_nombrecompleto_actual_formato_gabencognv");
      element.scrollIntoView();
    });
    */
  });
  
</script>
<!-- scripts generales -->
{% include "/formatoese/formato-gabencognv-js.volt" %}

<!----------------------------------------------------------------------------------- VER TODO EL ESE INICIO-->


<!-- Estudio completo incio-------------------------------------------------------------------------------incio -->
<div class="modal fade" id="ver_completo_estudio_formato_gabencognv-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
          
          <h5 class="text-center" id="" >Estudio No. <span id="ese_id_ese_actual_formato_gabencognv"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header ancla" id="link-gabencognv" data-toggle="tab" href="#SeccionDatosPersonales_formato_gabencognv-md" role="tab" aria-controls="home-md" aria-selected="false" onclick="cargarDatosSeccion_A_ESES_formato_gabencognv($('#ese_id_ese_actual_formato_gabencognv').text())">Datos personales</a>
                  </li>
   
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_ref_laborales_gabencognv" data-toggle="tab" href="#SeccionReferenciasLaborales_formato_gabencognv-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_B_ESES_formato_gabencognv($('#ese_id_ese_actual_formato_gabencognv').text())">Referencias laborales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_finales_gabencognv" data-toggle="tab" href="#SeccionDatosFinales_formato_gabencognv-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_C_ESES_formato_gabencognv($('#ese_id_ese_actual_formato_gabencognv').text())" >Datos finales</a>
                  </li>

      
  
 
                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        
        <div class="modal-body" style="padding-top:5px;">
          <center>
            <h5 style="margin-top: 0; margin-bottom:0">
              <span class="text-warning" id="ese_nombrecompleto_actual_formato_gabencognv" name="ese_nombrecompleto_actual_formato_gabencognv"></span>
              <span class="text-warning" id="ese_aliasempresa_actual_formato_gabencognv" name="ese_aliasempresa_actual_formato_gabencognv"></span>

            </h5>
          </center>
            <section class="mr-3 ml-3 ">
        
      
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
            <!-- FOMULARIO DE DATOS PERSONALES INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="SeccionDatosPersonales_formato_gabencognv-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                          A | DATOS PERSONALES   <i class="mdi mdi-face-recognition white "></i>
                        </p>
                      </center>
                          
  
                    </div>
  

                
                   </div>
                   
                   {% include "/formatoese/forms-ese-gabencognv/form-datos-datocomprobatorio.volt" %}

  
  
                </div>
                <!-- FORMULARIO DE DATOS ESCOLARES INCIO----------------------------------------------------------------------------------------------------------------------------------------INCIO -->
           
              <!-- FORMULARIO DE ANTETECEDEMTES SOCIALES INCIO----------------------------------------------------------------------------------------------------INCIO -->
  
           
              <!-- FORMULARIO DE ENTECEDENTES SOCIALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                <!-- FORMULARIO DE ESTADO GENERAL DE SALUD INCIO------------------------------------------------------------------------------------INCIO -->
                
          
  
  
              <!-- FORMULARIO DE ESTADO GENERAL DE SALUD FIN------------------------------------------------------------------------------------FIN--->
  
  
     <!-- FOMULARIO DE GRUPO FAMILIAR INCIO------------------------------------------------------------------------------------INCIO -->

  <!-- FOMULARIO DE GRUPO FAMILIAR FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE ANTECEDENTES LABORALES INCIO------------------------------------------------------------------------------------INCIO -->
  
           
              <!-- FOMULARIO DE ANTECEDENTES LABORALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                 <!-- FOMULARIO DE SITUACION ECONOMICA INCIO------------------------------------------------------------------------------------INCIO -->
          
                <!-- FOMULARIO DE SITUACION ECONOMICA FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE BIENES INMUEBLES INCIO------------------------------------------------------------------------------------INICIO-------- -->
  
          
  
                <!-- FOMULARIO DE BIENES INMUEBLES FIN------------------------------------------------------------------------------------FIN -->
  
                
  
  
  
                
                <!-- FOMULARIO DE REFERENCIAS PERSONALES INCICIO------------------------------------------------------------------------------------INCIO-->
             
     
                <!-- REFERENCIAS LABORALES INICIO ------------------------------------------------------------------------------------------------------INICO -->

                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasLaborales_formato_gabencognv-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                B | Referencias laborales <i class="mdi mdi-nature-people white"></i>
                            </p>

                    </div>
                  </div>

                  {% include "/formatoese/forms-ese-gabencognv/form-datos-referencias-laborales.volt" %}



             
                </div>


                <!-- FOMULARIO DE CREDITOS VIGENTES FIN------------------------------------------------------------------------------------FIN -->
  
               

                <!-- INICIO FORMULARIO DATOS FINALES --->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosFinales_formato_gabencognv-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              DATOS FINALES  <i class="mdi mdi-school white"></i>
                            </p>

                    </div>
                  </div>
                
                  {% include "/formatoese/forms-ese-gabencognv/form-datos-final.volt" %}

                  
                </div>

                <!-- FIN FORMULARIO DATOS FINALES --->

              </div>
    
            </section>
            
  
  
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- Js de situacion economica fin->
  
  
  <!-- bienes inmuebles -->

  <!-- bienes inmuebles fin-->
  

  
  
  <!-- Estuudio completo fin-----------------------------------------------------fin -->
  
  
  <!-- VER TODO EL ESE FIN -->

<!-- selelets dinamicos incio -->


<!-- scripts datos comprobatorios start -->
{% include "/datocomprobatorio/ese-formato-gabencognv/script-ajax-get-especifico.volt" %}
{% include "/datocomprobatorio/ese-formato-gabencognv/script-ajax-set-update.volt" %}
<!-- seccion laboral start -->
{% include "/seccionlaboral/formato-ese-gabencognv/script-ajax-get-detalle.volt" %}
{% include "/seccionlaboral/formato-ese-gabencognv/script-ajax-set-update.volt" %}
{% include "/referencialaboral/formato-ese-gabencognv/tabla-modal.volt" %}
{% include "/periodoinactivo/formato-ese-gabencognv/tabla-modal.volt" %}
<!-- seccion laboral end -->


<!--empleos ocultos inicio -->
{% include "/empleooculto/formato-ese-gabencognv/tabla-modal.volt" %}
<!--empleos ocultos fin -->

<!-- seccion datos finales start -->
{% include "/datofinal/detalles-formato-gabencognv.volt" %}
<!-- seccion datos finales end -->



{#




#}