


<div class="modal fade" id="resumen_exc-modal" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" tabindex="9999" style="z-index:9999;">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
    
        <div class="modal-header " style="padding-bottom:0px ; padding-top:5px ; ">
         
          <h5 class="text-center" id="" >Expediente No. <span id="exc_id-resumen_exc"></span> </h5>
          <div class="ml-5 pl-2">
                <ul class="nav nav-tab" id="myTabMD" role="tablist">
                  
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-vac-resumen_exc" data-toggle="tab" href="#seccion_vacante_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" >Vacante</a>
                  </li>
          

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link active nav-link-moda class-for-header ancla" id="link-data-resumen_exc" data-toggle="tab" href="#seccion_datos_personal_resumen_vac-md" role="tab" aria-controls="home-md" aria-selected="false" >Datos personales</a>
                  </li>
   
                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-cit-resumen_exc" data-toggle="tab" href="#seccion_cita_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="">Cita</a>
                  </li>

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-referencias-resumen_exc" data-toggle="tab" href="#seccion_referencias_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" onclick="">Referencias Laborales</a>
                  </li>


                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-psi-resumen_exc" data-toggle="tab" href="#seccion_psicometria_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" >Psicometría</a>
                  </li>

                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-ent-resumen_exc" data-toggle="tab" href="#seccion_ent_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" >Entrevista</a>
                  </li>

              




                  <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-reporte-resumen_exc" data-toggle="tab" href="#seccion_reporte_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" >Reportes</a>
                  </li>

                  <!-- <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-metricas-resumen_exc" data-toggle="tab" href="#seccion_metricas_resumen_vac-md" role="tab" aria-controls="profile-md" aria-selected="false" >Métricas</a>
                  </li> -->
                   <li class="nav-item waves-effect waves-light ">
                    <a class="nav-link class-for-header ancla" id="link-archivos_exc-resumen_exc" data-toggle="tab" href="#seccion_archivos_exc-md" role="tab" aria-controls="profile-md" aria-selected="false" >Archivos</a>
                   </li>
                 

                  

                </ul>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
      <h5 class="text-center" id="titular-resumen_exc" >  </h5>
  
     
        <div class="modal-body" style="padding-top:5px;">
               <section class="mr-3 ml-3 ">
        
              <div id="ancla_exc_id-resumen_exc" ></div>
              <div class="tab-content card " style="padding-top: 0;" id="myTabContentMD">
  
                
                <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
                    <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                  
                        <div class="container ">
                          
                              <center>
                                <p class=" text-white text-center font-weight-bold h6 sin-margen">
                                    DATOS PERSONALES <i class="mdi mdi-contact-mail white "></i>
                                </p>
                              </center>
                              
      
                        </div>

    

                  
                    </div>

                  {% include "/expedientecan/formsdata/datospersonales.volt" %}

                </div>
              
              

                   <div class="tab-pane fade borde-inferior-del-sistema content-for-js " id="seccion_cita_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">

                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                        <center>
                                          <p class=" text-white text-center font-weight-bold h6 sin-margen">
                                              CITA <i class="mdi mdi-calendar white "></i>
                                          </p>
                                        </center>
                                        
                
                                  </div>
          

                        
                          </div>
                   
                         {% include "/expedientecan/formsdata/cita.volt" %}

  
  
                    </div>

                    <div class="tab-pane fade borde-inferior-del-sistema content-for-js " id="seccion_ent_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                      <center>
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                                            ENTREVISTA <i class="mdi mdi-wechat white "></i>
                                        </p>
                                      </center>
                                          
                
                                  </div>
          

                        
                          </div>
                   
                       {% include "/expedientecan/formsdata/entrevista.volt" %}

  
  
                    </div>


                    <div class="tab-pane fade  borde-inferior-del-sistema content-for-js " id="seccion_psicometria_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                      <center>
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                                            Psicometría <i class="mdi mdi-content-paste white "></i>
                                        </p>
                                      </center>
                                          
                
                                  </div>
          

                        
                          </div>
                   
                      {% include "/expedientecan/formsdata/psicometria.volt" %}

  
  
                    </div>
  
  



                <div class="tab-pane fade borde-inferior-del-sistema content-for-js " id="seccion_referencias_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
                          
                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                      <center>
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                                            Referencias Laborales <i class="mdi mdi-nature-people white "></i>
                                        </p>
                                      </center>
                                        
                
                                  </div>
          

                        
                          </div>

                          {% include "/expedientecan/formsdata/seccionlaboral.volt" %}


  
  
                </div>
                <div class="tab-pane fade   borde-inferior-del-sistema content-for-js " id="seccion_vacante_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md" >
                          
                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                      <center>
                                        <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                                            Vacante <i class="mdi mdi-face-recognition white "></i>
                                        </p>
                                      </center>
                                          
                
                                  </div>
          

                        
                          </div>
                   
                            {% include "/expedientecan/formsdata/vacante.volt" %}

  
  
                  </div>

                  <div class="tab-pane fade   borde-inferior-del-sistema content-for-js " id="seccion_reporte_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md" >
                          
                          <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                        
                                  <div class="container ">
                                    
                                    <center>
                                      <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                                          REPORTES <i class="mdi mdi-file-document white "></i>
                                      </p>
                                    </center>
                                        
                
                                  </div>
          

                        
                          </div>
                   
                          {% include "/expedientecan/formsdata/reporte.volt" %}

  
  
                  </div>

                  <div class="tab-pane fade borde-inferior-del-sistema content-for-js " id="seccion_metricas_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md" > 
                    <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                      <div class="container "> 
                        <center>
                          <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                              MÉTRICAS <i class="mdi mdi-chart-pie white "></i>
                          </p>
                        </center>
                      </div>
                    </div>
                    {% include "/expedientecan/formsdata/metricas.volt" %}
                  </div>


                  <div class="tab-pane fade borde-inferior-del-sistema content-for-js " id="seccion_archivos_exc-md" role="tabpanel" aria-labelledby="home-tab-md" > 
                    <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                      <div class="container "> 
                        <center>
                          <p class=" text-white text-center font-weight-bold h6 sin-margen text-uppercase">
                              ARCHIVOS DEL EXPEDIENTE <i class="mdi mdi-folder-multiple-image white "></i>
                          </p>
                        </center>
                      </div>
                    </div>
                    {% include "/expedientecan/formsdata/archivos.volt" %}
                  </div>

                    


                    
              
            </section>

     
        </div>
      </div>
    </div>
  </div>
  


