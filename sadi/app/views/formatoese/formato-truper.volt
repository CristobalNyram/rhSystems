{% set cuarentaycuatro = acceso.verificar(44,rol_id) %}
{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set cuarenta = acceso.verificar(40,rol_id) %}
{% set sesentaytres  = acceso.verificar(63,rol_id) %}
{% set sesentaycuatro = acceso.verificar(64,rol_id) %}
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
{% include "/formatoese/formato-truper-js.volt" %}

<!----------------------------------------------------------------------------------- VER TODO EL ESE INICIO-->


<!-- Estudio completo incio-------------------------------------------------------------------------------incio -->
<div class="modal fade" id="ver_completo_estudio_formato_ese_truper-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
          
          <h5 class="text-center" id="" >Estudio No. <span id="ese_id_ese_actual_formato_ese_truper"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header ancla" id="link-ese-truper" data-toggle="tab" href="#SeccionDatosPersonales_formato_truper-md" role="tab" aria-controls="home-md" aria-selected="false" onclick="cargarDatosSeccion_A_ESES_formato_ese_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos personales</a>
                  </li>
   
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_domicilio_formato_truper" data-toggle="tab" href="#SeccionDatosDomicilio_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_B_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos vivienda</a>
                  </li>


                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_escolares_truper" data-toggle="tab" href="#SeccionDatosEscolares_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_C_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos académicos</a>
                  </li>

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_medicos_truper" data-toggle="tab" href="#SeccionDatosMedicos_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_D_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text());">Datos médicos</a>
                  </li>

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_familiares" data-toggle="tab" href="#SeccionDatosFamiliares_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_E_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos familiares</a>
                  </li>
          

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_comprobatorios_truper" data-toggle="tab" href="#SeccionDatosComprobatorios_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_F_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Documentos</a>
                  </li>

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_financieros_truper" data-toggle="tab" href="#SeccionDatosFinancieros_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_G_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos financieros </a>
                  </li>


                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_bienes_inmuebles_truper" data-toggle="tab" href="#SeccionDatosBienesInmuebles_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_H_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Afiliaciones y propiedad </a>
                  </li>

                  
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_ref_laborales_truper" data-toggle="tab" href="#SeccionRefLaborales_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_I_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Referencias laborales </a>
                  </li>

        

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_referencia_truper" data-toggle="tab" href="#SeccionDatosDeReferencia_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_J_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos de referencia </a>
                  </li>
                  
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_evaluacion_final_truper" data-toggle="tab" href="#SeccionDatosEvaluacionFinal_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_FINAL_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Resultados </a>
                  </li>
                  {% if cuarenta==1%}
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link_seccion_datos_finales_truper" data-toggle="tab" href="#SeccionDatosFinales_formato_truper-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_FINAL_ESE_ESES_formato_truper($('#ese_id_ese_actual_formato_ese_truper').text())">Datos finales </a>
                  </li>
                  {% endif %}

                  

                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        
        <div class="modal-body" style="padding-top:5px;">
          <center>
            <h5 style="margin-top: 0; margin-bottom:0">
              <span class="text-warning" id="ese_nombrecompleto_actual_formato_ese_truper" name="ese_nombrecompleto_actual_formato_ese_truper"></span>
              <span class="text-warning" id="ese_aliasempresa_actual_formato_ese_truper" name="ese_aliasempresa_actual_formato_ese_truper"></span>

            </h5>
          </center>
            <section class="mr-3 ml-3 ">
        
      
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
            <!-- FOMULARIO DE DATOS PERSONALES INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="SeccionDatosPersonales_formato_truper-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                          A | DATOS PERSONALES   <i class="mdi mdi-face-recognition white "></i>
                        </p>
                      </center>
                          
  
                    </div>
  

                
                   </div>
                   
                   {% include "/formatoese/forms-ese-truper/form-datos-personales.volt" %}

  
  
                </div>
            <!-- FORMULARIO DE DATOS DOMICILIO INCIO----------------------------------------------------------------------------------------------------------------------------------------INCIO -->
                  <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosDomicilio_formato_truper-md" role="tabpanel" aria-labelledby="profile-tab-md">
                      
                      
                    <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
                                  <div class="container row d-flex justify-content-center">
                                    
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                                          B | DATOS VIVIENDA  <i class="mdi mdi-home white"></i>
                                        </p>
                
                                  </div>

                      
                  
                    </div>
                    {% include "/formatoese/forms-ese-truper/form-datos-domicilio.volt" %}




                  </div>
                <!-- FOMULARIO DE DATOS ESCOLARES INICIO--------------------------------------------------------------------------------------------INICIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosEscolares_formato_truper-md" role="tabpanel" aria-labelledby="profile-tab-md">
                      
                      
                  <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                        
                                    
                                <div class="container row d-flex justify-content-center">
                                  
                                      <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase" >
                                        C | DATOS académicos  <i class="mdi mdi-school white"></i>
                                      </p>
              
                                </div>

                    
                
                  </div>
                  {% include "/formatoese/forms-ese-truper/form-datos-escolares.volt" %}




                </div>


                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosMedicos_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                D | Datos médicos <i class="fas fa-user-md  white mdi-18px"></i>
                            </p>

                    </div>
                  </div>

                  {% include "/formatoese/forms-ese-truper/form-datos-medicos.volt" %}



             
                </div>




                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosFamiliares_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                E | Datos familiares <i class="far fa-handshake white mdi-18px"></i>
                            </p>

                    </div>
                  </div>



                  {% include "/formatoese/forms-ese-truper/form-datos-familiares.volt" %}

             
                </div>
                

              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosComprobatorios_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                          <div class="container ">
                    
                                  <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                      F | Documentos <i class="mdi mdi-file white"></i>
                                  </p>

                          </div>
                        </div>



                  {% include "/formatoese/forms-ese-truper/form-datos-comprobatorios.volt" %}

             
              </div>




              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosFinancieros_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                  <div class="container ">
            
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                            G | SITUACIÓN FINANCIERA DEL CANDIDATO									
                              <i class="mdi mdi-cash white"></i>
                          </p>

                  </div>
                </div>



                    {% include "/formatoese/forms-ese-truper/form-datos-financieros.volt" %}

              
              </div>
                

              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosBienesInmuebles_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                  <div class="container ">
            
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                            H | AFILIACIONES Y PROPIEDADES																
                            <i class="far fa-laugh white mdi-18px"></i>
                            <i class="fas fa-home white mdi-18px"></i>
                          </p>

                  </div>
                </div>



                    {% include "/formatoese/forms-ese-truper/form-datos-bienesinmuebles.volt" %}

              
              </div>
                



              
              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionRefLaborales_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                  <div class="container ">
            
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                            I | REFERENCIAS LABORALES																							
                            <i class="fas fa-address-book white mdi-18px"></i>
                                                    </p>

                  </div>
                </div>



                    {% include "/formatoese/forms-ese-truper/form-datos-ref-laborales.volt" %}

              
              </div>


              <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosDeReferencia_formato_truper-md" role="tabpanel" aria-labelledby="profile-tab-md">
       

                {% include "/formatoese/forms-ese-truper/form-datos-referencia.volt" %}

              

                
              </div>





              

              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosEvaluacionFinal_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
   

                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                  <div class="container ">
            
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                            EVALUACIÓN FINAL																												
                            <i class="fas fa-file-signature white mdi-18px"></i>
                          
                          
                          
                          </p>

                  </div>
                </div>

                {% include "/formatoese/forms-ese-truper/form-datos-evalucion-truper.volt" %}

              
              </div>


              <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionDatosFinales_formato_truper-md" role="tabpanel" aria-labelledby="contact-tab-md">
   

                <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                  <div class="container ">
            
                          <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                           DATOS FINALES				
                           <i class="fab fa-font-awesome-flag white mdi-24px"></i>																							
                          
                          
                          
                          </p>
  
                  </div>
                </div>
  
                {% include "/formatoese/forms-ese-truper/form-datos-finales.volt" %}
  
              
              </div>
  
              
            </section>

     
  
  
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
<!-- scripts inicio  -->
{% include "/datospersonales/ese-formato-truper/script-ajax-especifico.volt" %}
{% include "/datospersonales/ese-formato-truper/script-ajax-set-update.volt" %}

{% include "/datovivienda/formato-ese-truper/script-ajax-especifico.volt" %}
{% include "/datovivienda/formato-ese-truper/script-ajax-set-update.volt" %}


{% include "/datoviviendanterdetalles//formato-ese-truper/tabla-modal.volt" %}

{% include "/datoescolar/formato-ese-truper/detalles.volt" %}

{% include "/estadosalud/formato-ese-truper/detalles.volt" %}



<!-- dato familiar  inicio-->
{% include "/datogrupofamiliar/formato-ese-truper/script-ajax-detalle.volt" %}
{% include "/datogrupofamiliar/formato-ese-truper/script-ajax-set-update.volt" %}

{% include "/datogrupofamiliardetalles/formato-ese-truper/viven-tabla-modal-truper.volt" %}
{% include "/datogrupofamiliardetalles/formato-ese-truper/trabajancompania-tabla-modal-truper.volt" %}
{% include "/datogrupofamiliardetalles/formato-ese-truper/negociootrabajoen-tabla-modal-truper.volt" %}
{% include "/datogrupofamiliardetalles/script-ajax-borrar-general.volt" %}


<!-- dato familiar  fin-->


<!-- datos comprobatorios -->
{% include "/datocomprobatorio/ese-formato-truper/script-ajax-especifico.volt" %}
{% include "/datocomprobatorio/ese-formato-truper/script-ajax-set-update.volt" %}

<!-- datos comprobatorios -->



<!-- situacion economica  -->

{% include "/situacioneconomica/formato-ese-truper/script-ajax-get-detalle.volt" %}
{% include "/situacioneconomica/formato-ese-truper/script-ajax-set-update.volt" %}

{% include "/situacioneconomicaingresos/formato-ese-truper/candidato/tabla-modal.volt" %}
{% include "/situacioneconomicaingresos/formato-ese-truper/familiares/tabla-modal.volt" %}

<!-- situacion economica  -->


<!--bienes inmuebles, antecedentes sociales  -->
{% include "/antecedentesocial/formato-ese-truper/detalles.volt" %}
{% include "/bieninmuebledetalles/formato-ese-truper/tabla-modal.volt" %}
{% include "/bieninmuebledetalles/eliminar-general-js.volt" %}

{% include "/automovil/formato-ese-truper/tabla-modal.volt" %}
{% include "/automovil/eliminar-general-js.volt" %}



<!--bienes inmuebles, antecedentes sociales  -->



<!-- ref laborales -->
{% include "/seccionlaboral/formato-ese-truper/script-ajax-get-detalle.volt" %}
{% include "/seccionlaboral/formato-ese-truper/script-ajax-set-update.volt" %}

{% include "/referencialaboral/formato-ese-truper/tabla-modal.volt" %}
{% include "/trayectorialaboralregistradodetalles/formato-ese-truper/tabla-modal.volt" %}
{% include "/trayectorialaboral/formato-ese-truper/tabla-modal.volt" %}


<!-- ref laborales -->

<!--datos referencias  -->
{% include "/seccionpersonal/formato-ese-truper/script-ajax-get-detalle.volt" %}
{% include "/referenciapersonal/formato-ese-truper/tabla-modal.volt" %}
{% include "/referenciavecinal/formato-ese-truper/tabla-modal.volt" %}
{% include "/referenciafamiliar/formato-ese-truper/tabla-modal.volt" %}

<!--datos referencias  -->



<!-- evaluacion final truper -->
{% include "/evaluaciontruper/formato-ese-truper/script-ajax-get-detalle.volt" %}
{% include "/evaluaciontruper/formato-ese-truper/script-ajax-set-update.volt" %}

<!-- evaluacion final truper -->



<!-- datos fianles  inicio-->
{% include "/datofinal/formato-ese-truper/detalles.volt" %}
<!-- datos finales fin -->




<!-- scripts fin  -->



