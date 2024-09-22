{% set cuarentaycuatro = acceso.verificar(44,rol_id) %}
{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set cuarenta = acceso.verificar(40,rol_id) %}
{% set ochenta = acceso.verificar(80,rol_id) %}

<script type="text/javascript">
  
  $(document).ready(function(){
    /*
    $(".ancla").click(function(evento){
      const element = document.getElementById("ese_nombrecompleto_actual_formato_gabtubos");
      element.scrollIntoView();
    });
    */
  });
  
</script>
<!-- scripts generales -->
{% include "/formatoese/formato-gabtubos-js.volt" %}

<!----------------------------------------------------------------------------------- VER TODO EL ESE INICIO-->


<!-- Estudio completo incio-------------------------------------------------------------------------------incio -->
<div class="modal fade" id="ver_completo_estudio_formato_gabtubos-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
          
          <h5 class="text-center" id="" >Estudio No. <span  id="ese_id_ese_actual_formato_gabtubos"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header ancla" id="link_gabtubos" data-toggle="tab" href="#SeccionDatosPersonales_formato_gabtubos-md" role="tab" aria-controls="home-md" aria-selected="false" onclick="cargarDatosSeccion_A_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())">Datos personales</a>
                  </li>
   
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_escolares_gabtubos" data-toggle="tab" href="#SeccionDatosEscolares_formato_gabtubos-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_B_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())">Datos escolares</a>
                  </li>

                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="link_seccion_dato_grupo_familiar_formato_gabtubos" data-toggle="tab" href="#SeccionDatosgrupoFamiliar_formato_gabtubos-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_C_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())">Datos de grupo familiar</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="link_seccion_ref_personales_formato_gabtubos" data-toggle="tab" href="#SeccionReferenciasPersonales_formato_gabtubos-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_D_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())" >Referencias personales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="link_seccion_ref_laborales_formato_gabtubos" data-toggle="tab" href="#SeccionReferenciasLaborales_formato_gabtubos-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_E_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())" >Referencias laborales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_finales_formato_gabtubos" data-toggle="tab" href="#SeccionDatosFinales_formato_gabtubos-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_F_ESES_formato_gabtubos($('#ese_id_ese_actual_formato_gabtubos').text())" >Datos finales</a>
                  </li>
  
 
                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        
        <div class="modal-body" style="padding-top:5px;">

            <script>
            
            </script>
          <center>
            <h5>
              <span  class="text-warning" id="ese_nombrecompleto_actual_formato_gabtubos_titulo" name="ese_nombrecompleto_actual_formato_gabtubos_titulo" ></span>
              <span class="text-warning" id="ese_aliasempresa_actual_formato_gabtubos" name="ese_aliasempresa_actual_formato_gabtubos"></span>

            </h5>
            <h5 class="text-warning" id="" ></h5>
            <h5 class="text-warning" style="display: none;" id="ese_nombrecompleto_actual_formato_gabtubos"></h5>

          </center>
          
            <section class="mr-3 ml-3 ">
        
      
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
            <!-- FOMULARIO DE DATOS PERSONALES INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="SeccionDatosPersonales_formato_gabtubos-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                          A | DATOS PERSONALES   <i class="mdi mdi-face-recognition white "></i>
                        </p>
                      </center>
                          
  
                    </div>
  

                
                   </div>
                   
                   {% include "/formatoese/forms-ese-gabtubos/form-datos-datocomprobatorio.volt" %}

  
  
                </div>
                <!-- FORMULARIO DE DATOS ESCOLARES INCIO----------------------------------------------------------------------------------------------------------------------------------------INCIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosEscolares_formato_gabtubos-md" role="tabpanel" aria-labelledby="profile-tab-md">
                
                
                    <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
                                  <div class="container row d-flex justify-content-center">
                                    
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                          B | DATOS ESCOLARES  <i class="mdi mdi-school white"></i>
                                        </p>
                
                                  </div>

                      
                  
                    </div>
                    {% include "/formatoese/forms-ese-gabtubos/form-datos-escolares.volt" %}

  
                <!-- FOMULARIO DE DATOS ESCOLARES FIN--------------------------------------------------------------------------------------------FIN -->
  
  
                </div>
              <!-- FORMULARIO DE ANTETECEDEMTES SOCIALES INCIO----------------------------------------------------------------------------------------------------INCIO -->
  
           
              <!-- FORMULARIO DE ENTECEDENTES SOCIALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                <!-- FORMULARIO DE ESTADO GENERAL DE SALUD INCIO------------------------------------------------------------------------------------INCIO -->
                
          
  
  
              <!-- FORMULARIO DE ESTADO GENERAL DE SALUD FIN------------------------------------------------------------------------------------FIN--->
  
  
     <!-- FOMULARIO DE GRUPO FAMILIAR INCIO------------------------------------------------------------------------------------INCIO -->
     <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosgrupoFamiliar_formato_gabtubos-md" role="tabpanel" aria-labelledby="contact-tab-md">
      
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container row d-flex justify-content-center">
  
                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                  C | DATOS DE GRUPO FAMILIAR   <i class="mdi mdi-worker white"></i>
                </p>

        </div>
     </div>

     {% include "/formatoese/forms-ese-gabtubos/form-datos-grupofamiliar.volt" %}

  
    </div>
  
  <!-- FOMULARIO DE GRUPO FAMILIAR FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE ANTECEDENTES LABORALES INCIO------------------------------------------------------------------------------------INCIO -->
  
           
              <!-- FOMULARIO DE ANTECEDENTES LABORALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                 <!-- FOMULARIO DE SITUACION ECONOMICA INCIO------------------------------------------------------------------------------------INCIO -->
          
                <!-- FOMULARIO DE SITUACION ECONOMICA FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE BIENES INMUEBLES INCIO------------------------------------------------------------------------------------INICIO-------- -->
  
          
  
                <!-- FOMULARIO DE BIENES INMUEBLES FIN------------------------------------------------------------------------------------FIN -->
  
                
  
  
  
                
                <!-- FOMULARIO DE REFERENCIAS PERSONALES INCICIO------------------------------------------------------------------------------------INCIO-->
             
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasPersonales_formato_gabtubos-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                              D | Referencias personales <i class="mdi mdi-nature-people white"></i>
                            </p>

                    </div>
                </div>
                {% include "/formatoese/forms-ese-gabtubos/form-datos-referencias-personales.volt" %}

                 
                </div>
                <!-- REFERENCIAS LABORALES INICIO ------------------------------------------------------------------------------------------------------INICO -->

                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasLaborales_formato_gabtubos-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                              E | Referencias laborales <i class="mdi mdi-nature-people white"></i>
                            </p>

                    </div>
                  </div>

                  {% include "/formatoese/forms-ese-gabtubos/form-datos-referencias-laborales.volt" %}

             
                </div>


                <!-- FOMULARIO DE CREDITOS VIGENTES FIN------------------------------------------------------------------------------------FIN -->
  
               

                <!-- INICIO FORMULARIO DATOS FINALES --->
             
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosFinales_formato_gabtubos-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              DATOS FINALES  <i class="mdi mdi-school white"></i>
                            </p>

                    </div>
                  </div>
                
                  {% include "/formatoese/forms-ese-gabtubos/form-datos-final.volt" %}

                  
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
{% include "/datocomprobatorio/ese-formato-gabtubos/script-ajax-get-especifico.volt" %}
{% include "/datocomprobatorio/ese-formato-gabtubos/script-ajax-especifico.volt" %}
{% include "/datocomprobatorio/ese-formato-gabtubos/script-ajax-set-update.volt" %}

<!-- scripts datos comprobatorios end -->

<!-- scripts datos escolares start -->
{% include "/datoescolar/formato-ese-gabtubos/detalles.volt" %}
<!-- scripts datos escolares end -->

<!-- scripts datos grupos fam start -->
{% include "/datogrupofamiliar/formato-ese-gabtubos/script-ajax-get-detalle.volt" %}
{% include "/datogrupofamiliar/formato-ese-gabtubos/script-ajax-set-update.volt" %}
{% include "/datogrupofamiliar/formato-ese-gabtubos/tabla-modal.volt" %}
<!-- scripts datos grupos fam end -->


<!-- seccion personal start -->
{% include "/seccionpersonal/formato-ese-gabtubos/script-ajax-get-detalle.volt" %}
{% include "/seccionpersonal/formato-ese-gabtubos/script-ajax-set-update.volt" %}
{% include "/referenciapersonal/formato-ese-gabtubos/tabla-modal.volt" %}
<!-- seccion personal end -->

<!-- seccion laboral start -->
{% include "/seccionlaboral/formato-ese-gabtubos/script-ajax-get-detalle.volt" %}
{% include "/seccionlaboral/formato-ese-gabtubos/script-ajax-set-update.volt" %}
{% include "/referencialaboral/formato-ese-gabtubos/tabla-modal.volt" %}
{% include "/periodoinactivo/formato-ese-gabtubos/tabla-modal.volt" %}
<!-- seccion laboral end -->


<!-- empleos ocultos inicio-->
{% include "/empleooculto/formato-ese-gabtubos/tabla-modal.volt" %}
<!-- empleosocultos inicio-->

<!-- seccion datos finales start -->
{% include "/datofinal/detalles-formato-gabtubos.volt" %}
<!-- seccion datos finales end -->
