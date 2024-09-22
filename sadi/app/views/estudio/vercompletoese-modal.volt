{% set cuarenta  = acceso.verificar(40,rol_id) %}

{% set cuarentaycuatro = acceso.verificar(44,rol_id) %}
{% set cuarentayseis = acceso.verificar(46,rol_id) %}
{% set setentayuno = acceso.verificar(71,rol_id) %}
{% set ochenta = acceso.verificar(80,rol_id) %}

<script type="text/javascript">
  
  $(document).ready(function(){
    
    $(".ancla").click(function(evento){
      const element = document.getElementById("ese_nombrecompleto_actual");
      element.scrollIntoView();
    });
  });
</script>

<!----------------------------------------------------------------------------------- VER TODO EL ESE INICIO-->


<!-- Estudio completo incio-------------------------------------------------------------------------------incio -->
<div class="modal fade" id="ver_completo_estudio-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
          
          <h5 class="text-center" id="" >Estudio No. <span id="ese_id_ese_actual"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header ancla" id="home-tab-md-1" data-toggle="tab" href="#SeccionDatosPersonales-md" role="tab" aria-controls="home-md" aria-selected="false" onclick="cargarDatosSeccion_A_ESES($('#ese_id_ese_actual').text())">Datos personales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="profile-tab-md-2" data-toggle="tab" href="#SeccionDatosEscolares-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="cargarDatosSeccion_B_ESES($('#ese_id_ese_actual').text())">Datos escolares</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-3" data-toggle="tab" href="#SeccionAntecedentesSociales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_C_ESES($('#ese_id_ese_actual').text())">Antecedentes sociales</a>
                  </li>
                  
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-4" data-toggle="tab" href="#SeccionEstadoGeneralSal-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_D($('#ese_id_ese_actual').text())">Estado general de salud</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-5" data-toggle="tab" href="#SeccionDatosgrupoFamiliar-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_E_ESES($('#ese_id_ese_actual').text())">Datos de grupo familiar</a>
                  </li>
  
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-6" data-toggle="tab" href="#SecciondAntecedentesLaborales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_F_ESES($('#ese_id_ese_actual').text())">Antecedentes laborales de grupo familiar</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-7" data-toggle="tab" href="#SeccionSituacionEconomica-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_G_ESES($('#ese_id_ese_actual').text())"  >Situación económica</a>
                  </li>
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-8" data-toggle="tab" href="#SeccionBienesInmuebles-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_H_ESES($('#ese_id_ese_actual').text())">Bienes inmuebles</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-9" data-toggle="tab" href="#SeccionReferenciasPersonales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_I_ESES($('#ese_id_ese_actual').text())" >Referencias personales</a>
                  </li>
                  <li class="nav-item waves-effect waves-light">
                    <a class="nav-link class-for-header ancla" id="contact-tab-md-10" data-toggle="tab" href="#SeccionReferenciasLaborales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_J_ESES($('#ese_id_ese_actual').text())" >Referencias laborales</a>
                  </li>
                  {% if cuarentaycuatro==1 %}
                    <li class="nav-item waves-effect waves-light">
                      <a class="nav-link class-for-header ancla" id="contact-tab-md-8" data-toggle="tab" href="#SeccionDatosFinales-md" role="tab" aria-controls="contact-md" aria-selected="false" onclick="cargarDatosSeccion_Finales_ESES($('#ese_id_ese_actual').text())">Datos finales</a>
                    </li>
                  {% endif %}
                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        
        <div class="modal-body" style="padding-top:5px;">
  
            <section class="mr-3 ml-3 ">
        
              <center>
                <h5 style="margin-top: 0; margin-bottom:0"  >
                  <span class="text-warning" id="ese_nombrecompleto_actual" name="ese_nombrecompleto_actual"></span>
                  <span class="text-warning" id="ese_aliasempresa_actual" name="ese_aliasempresa_actual"></span>

                </h5>
              </center>
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
            <!-- FOMULARIO DE DATOS PERSONALES INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="SeccionDatosPersonales-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                          A | DATOS PERSONALES   <i class="mdi mdi-face-recognition white "></i>
                        </p>
                      </center>
                          
  
                    </div>
  
                    
                
                   </div>
                  
                   {% include "/formatoese/form-ese-completo/form-datos-comprobatorios.volt" %}

  
  
                </div>
                <!-- FORMULARIO DE DATOS ESCOLARES INCIO----------------------------------------------------------------------------------------------------------------------------------------INCIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosEscolares-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                    
                                
                    <div class="container row d-flex justify-content-center">
                      
                          <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                            B | DATOS ESCOLARES  <i class="mdi mdi-school white"></i>
                          </p>
  
                    </div>

                
            
                  </div>
                  {% include "/formatoese/form-ese-completo/form-datos-escolares.volt" %}

  
                <!-- FOMULARIO DE DATOS ESCOLARES FIN--------------------------------------------------------------------------------------------FIN -->
  
  
                </div>
                
              <!-- FORMULARIO DE ANTETECEDEMTES SOCIALES INCIO----------------------------------------------------------------------------------------------------INCIO -->
  
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionAntecedentesSociales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container row d-flex justify-content-center">
                 
                     <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                       C | ANTECEDENTES SOCIALES   <i class="mdi mdi-human-handsdown white "></i> <i class="mdi mdi-human-handsdown black "></i>
                     </p>

                   </div>
                </div>
                {% include "/formatoese/form-ese-completo/form-datos-antecedentes-sociales.volt" %}

                </div>
              <!-- FORMULARIO DE ENTECEDENTES SOCIALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                <!-- FORMULARIO DE ESTADO GENERAL DE SALUD INCIO------------------------------------------------------------------------------------INCIO -->
                
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionEstadoGeneralSal-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container row d-flex justify-content-center">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                            D | ESTADO GENERAL DE SALUD  <i class="mdi mdi-hospital-building white"></i>
                            </p>

                    </div>
                  </div>
                  {% include "/formatoese/form-ese-completo/form-datos-estado-general-salud.volt" %}

                
                </div>
  
  
              <!-- FORMULARIO DE ESTADO GENERAL DE SALUD FIN------------------------------------------------------------------------------------FIN--->
  
  
     <!-- FOMULARIO DE GRUPO FAMILIAR INCIO------------------------------------------------------------------------------------INCIO -->
  
     <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosgrupoFamiliar-md" role="tabpanel" aria-labelledby="contact-tab-md">
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container row d-flex justify-content-center">
  
                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                  E | DATOS DE GRUPO FAMILIAR   <i class="mdi mdi-worker white"></i>
                </p>

        </div>
     </div>
      
     {% include "/formatoese/form-ese-completo/form-datos-grupo-familiar.volt" %}

    </div>
  <!-- FOMULARIO DE GRUPO FAMILIAR FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE ANTECEDENTES LABORALES INCIO------------------------------------------------------------------------------------INCIO -->
  
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SecciondAntecedentesLaborales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container row d-flex justify-content-center">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              F | ANTECEDENTES LABORALES DE GRUPO FAMILIAR   <i class="mdi mdi-worker white"></i>
                            </p>

                    </div>
                 </div>

                 {% include "/formatoese/form-ese-completo/form-datos-antecedente-grup-familiar.volt" %}

                </div>
              <!-- FOMULARIO DE ANTECEDENTES LABORALES FIN------------------------------------------------------------------------------------FIN -->
  
  
                 <!-- FOMULARIO DE SITUACION ECONOMICA INCIO------------------------------------------------------------------------------------INCIO -->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionSituacionEconomica-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container row d-flex justify-content-center">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                              G | SITUACIóN ECONóMICA  <i class="mdi mdi-cash-usd white"></i>
                            </p>

                    </div>
                 </div>

                 {% include "/formatoese/form-ese-completo/form-datos-situacion-economica.volt" %}

                </div>
                <!-- FOMULARIO DE SITUACION ECONOMICA FIN------------------------------------------------------------------------------------FIN -->
  
  
  
                <!-- FOMULARIO DE BIENES INMUEBLES INCIO------------------------------------------------------------------------------------INICIO-------- -->
  
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionBienesInmuebles-md" role="tabpanel" aria-labelledby="contact-tab-md">
                  <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              H |  BIENES INMUEBLES <i class="mdi mdi-office-building white"></i>
                            </p>

                    </div>
                 </div>

                  
                 {% include "/formatoese/form-ese-completo/form-datos-bieninmueble.volt" %}

                </div>
  
                <!-- FOMULARIO DE BIENES INMUEBLES FIN------------------------------------------------------------------------------------FIN -->
  
                
  
  
  
                
                <!-- FOMULARIO DE REFERENCIAS PERSONALES INCICIO------------------------------------------------------------------------------------INCIO-->
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasPersonales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                              I | Referencias personales <i class="mdi mdi-nature-people white"></i>
                            </p>

                    </div>
                  </div>
                  {% include "/formatoese/form-ese-completo/form-datos-ref-personales.volt" %}

       
                </div>
                
                <!-- FOMULARIO DE CREDITOS VIGENTES FIN------------------------------------------------------------------------------------FIN -->
  
                <div class="tab-pane fade borde-inferior-del-sistema" id="SeccionReferenciasLaborales-md" role="tabpanel" aria-labelledby="contact-tab-md">
                      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                        <div class="container ">
                  
                                <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                                  J | Referencias laborales <i class="mdi mdi-nature-people white"></i>
                                </p>

                        </div>
                      </div>
                 {% include "/formatoese/form-ese-completo/form-datos-ref-laborales.volt" %}

                

                <!-- INICIO FORMULARIO DATOS FINALES --->
                <div class="tab-pane fade borde-inferior-del-sistema content-for-js" id="SeccionDatosFinales-md" role="tabpanel" aria-labelledby="profile-tab-md">
                  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
                    <div class="container ">
              
                            <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                              DATOS FINALES  <i class="mdi mdi-school white"></i>
                            </p>

                    </div>
                  </div>
                  {% include "/formatoese/form-ese-completo/form-datos-finales.volt" %}

                </div>

                <!-- FIN FORMULARIO DATOS FINALES --->

              </div>
    
            </section>
            
  
  
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>

    function limpiarActive(array_header,backgroundHeaderActive,timeAnimation,index_set)
    {
      let index_select= parseInt(index_set);
      for (let index = 0; index < array_header.length; index++) {
          if(index==index_select)
          {
            array_header[index].style.background=backgroundHeaderActive;
                    array_header[index].style.color='white';
                    array_header[index].style.fontWeight ='bold';
                    array_header[index].style.padding ='8px';
                    array_header[index].style.transitionDuration=timeAnimation;
          }
          else{

            array_header[index].style.background='';
                                    array_header[index].style.color='gray';
                                    array_header[index].style.fontWeight ='normal';
                                    array_header[index].style.padding ='8px';
          }
  
              
        }  
    }

    function pintarYDespintarHeader(array_header,backgroundHeaderActive,timeAnimation)
    {
        for (let index = 0; index < array_header.length; index++) {
            array_header[index].addEventListener('click',()=>{
                    array_header[index].style.background=backgroundHeaderActive;
                    array_header[index].style.color='white';
                    array_header[index].style.fontWeight ='bold';
                    array_header[index].style.padding ='8px';
                    array_header[index].style.transitionDuration=timeAnimation;
                            for (let index2 = 0; index2 < array_header.length; index2++) {
                                  if(index!=index2)
                                  {
                                    array_header[index2].style.background='';
                                    array_header[index2].style.color='gray';
                                    array_header[index2].style.fontWeight ='normal';
                                    array_header[index2].style.padding ='8px';
  
                        
                                  }
                            
                            }
  
              });
        }  
    }
   
    
  $( document ).ready(function() {
    let contents =document.getElementsByClassName('content-for-js');
    let headers =document.getElementsByClassName('class-for-header');
    headers[0].style.background='#16345e';
                  headers[0].style.color='white';
                  headers[0].style.fontWeight ='bold';
                  headers[0].style.padding ='15px';
  
    pintarYDespintarHeader(headers,'#16345e','.9s');      
  
  
       
  
  
  });
  
  
  </script>

  <!-- Js de situacion economica inicio -->
  <script>
 
    function sumarTodosLosMontosEgresos(){
      let monto_monto =document.querySelectorAll('.monto-monto');
        for (let index = 0; index < monto_monto.length; index++) {
            
            // console.log(monto_monto[2]);
                let sum = 0;
                    for (let index2 = 0; index2 <monto_monto.length; index2++) {
                          if(monto_monto[index2].value!='')
                          {
                            if(monto_monto[index2].value>=0)
                            {
                              sum +=parseFloat(monto_monto[index2].value);
        
                            }
                            else
                            {
                              monto_monto[index2].value=0;
                            }
                          }
                    } 
                  document.getElementById('sie_totalegresos').value=sum; 
                    
                
          
        
        }
    }

   let monto_monto =document.querySelectorAll('.monto-monto');
   for (let index = 0; index < monto_monto.length; index++) {
      
    monto_monto[index].addEventListener('change',()=>{
      // console.log(monto_monto[2]);
          let sum = 0;
              for (let index2 = 0; index2 <monto_monto.length; index2++) {
                    if(monto_monto[index2].value!='')
                    {
                      if(monto_monto[index2].value>=0)
                      {
                        sum +=parseFloat(monto_monto[index2].value);
  
                      }
                      else
                      {
                        monto_monto[index2].value=0;
                      }
                    }
              } 
            document.getElementById('sie_totalegresos').value=sum; 
              
          
        }); 
  
  }
  
      
  </script>
  <!-- Js de situacion economica fin->
  
  
  <!-- bienes inmuebles -->

  <!-- bienes inmuebles fin-->
  

  
  
  <!-- Estuudio completo fin-----------------------------------------------------fin -->
  
  
  <!-- VER TODO EL ESE FIN -->

<!-- selelets dinamicos incio -->

{% include "/nivelestudio/script-ajax-todos.volt" %}
{% include "/estadocivil/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-get-uno.volt" %}
{% include "/municipio/script-ajax-get-uno.volt" %}
<!-- selelets dinamicos final -->


<!-- script para cargar y guardar datos del estudio de la seccion A-->

{% include "/datocomprobatorio/script-ajax-especifico.volt" %}
{% include "/datocomprobatorio/script-ajax-get-especifico.volt" %}
{% include "/datocomprobatorio/script-ajax-set-update.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion A-->

<!-- script para cargar y guardar datos del estudio de la seccion B-->

{% include "/datoescolar/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion B-->

<!-- script para cargar y guardar datos del estudio de la seccion C-->

{% include "/antecedentesocial/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion C-->

<!-- script para cargar y guardar datos del estudio de la seccion D-->

{% include "/estadosalud/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion D-->


<!-- script para cargar y guardar datos de la seccion E  -->
{% include "/datogrupofamiliar/script-ajax-get-detalle.volt" %}
{% include "/datogrupofamiliar/script-ajax-set-update.volt" %}
{% include "/datogrupofamiliar/tabla-modal.volt" %}

<!-- script para cargar y guardar datos de la seccion E  -->


<!-- script para cargar y guardar los datos de la sección F incio -->
{% include "/antecedentegrupofamiliar/script-ajax-get-detalle.volt" %}
{% include "/antecedentegrupofamiliar/script-ajax-set-update.volt" %}
{% include "/antecedentegrupofamiliar/tabla-modal.volt" %}
<!-- script para cargar y guardar los datos de la sección F fin -->


<!-- script para cargar y guardar los datos de la sección G incio -->
{% include "/situacioneconomica/script-ajax-get-detalle.volt" %}
{% include "/situacioneconomica/script-ajax-set-update.volt" %}

<!-- ingresos -->
  {% include "/situacioneconomicaingresos/tabla-modal.volt" %}
<!-- inpuests -->
{% include "/situacioneconomicacredito/tabla-modal.volt" %}

<!-- script para cargar y guardar los datos de la sección G fin -->




<!-- script para cargar y guardar los datos de la sección H incio -->
{% include "/bieninmueble/script-ajax-get-detalle.volt" %}
{% include "/bieninmueble/script-ajax-set-update.volt" %}

{% include "/bieninmuebledetalles/tabla-modal.volt" %}

<!-- script para cargar y guardar los datos de la sección H fin -->

<!-- script para cargar y guardar los datos de la sección H incio -->
{% include "/seccionpersonal/script-ajax-get-detalle.volt" %}

{% include "/seccionpersonal/script-ajax-set-update.volt" %}

{% include "/referenciavecinal/tabla-modal.volt" %}
{% include "/referenciapersonal/tabla-modal.volt" %}





<!-- script para cargar y guardar los datos de la sección H fin -->

<!-- script para cargar y guardar datos del estudio de la seccion J incio-->
{% include "/seccionlaboral/script-ajax-get-detalle.volt" %}

{% include "/seccionlaboral/script-ajax-set-update.volt" %}

{% include "/referencialaboral/tabla-modal.volt" %}
{% include "/periodoinactivo/tabla-modal.volt" %}
{% include "/empleooculto/general/tabla-modal.volt" %}


<!-- script para cargar y guardar datos del estudio de la seccion J fin-->



<!-- script para cargar y guardar datos del estudio de la seccion datos finales-->

{% include "/datofinal/detalles.volt" %}

<!-- script para cargar y guardar datos del estudio de la seccion datos finales-->



<!-- script para cargar datos del estudio  start -->
{% include "/estudio/vercompletoese-modal-js.volt" %}
<!-- script para cargar datos del estudio end  -->



  <!-- SCRIPTS PARA GUARDAR DATOS DE VER ESTUDIOS -->

  
  <!-- SCRIPTS PARA GUARDAR DATOS DE VER ESTUDIOS -->

  <!-- INICIO SCRIPTS PARA INCIDENCIAS DE ESTUDIOS -->
  {% include "/incidencia/incidencia.volt" %}
  
  <!-- FIN SCRIPTS PARA INCIDENCIAS DE ESTUDIOS --> 


  <!-- seccion automovil inicio -->
  {% include "/automovil/tabla-modal.volt" %}

  <!-- seccio automovil fin -->


