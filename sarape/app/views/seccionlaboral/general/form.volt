{# PERMISOS INCIOS #}
{# periodo inactivo #}
{% set treintaytres= acceso.verificar(33,rol_id) %}

{# Empleos ocultos #}
{% set treintaycuatro= acceso.verificar(34,rol_id) %}


{% set treintaysiete= acceso.verificar(37,rol_id) %}

{# Rerencias lab #}
{% set treintaycinco= acceso.verificar(35,rol_id) %}
{% set treintayseis= acceso.verificar(36,rol_id) %}
{% set cincuenta= acceso.verificar(50,rol_id) %}


{# permisos para mostrar lista de registros inicio  #}
{% set ochentaycinco_per_lis= acceso.verificar(85,rol_id) %}
{% set ochentayseis_emc_lis= acceso.verificar(86,rol_id) %}
{% set ochentaysiete_rl_lis= acceso.verificar(87,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}


{# permisos para solicitar una auxiliar inicio #}
{% set ochentayocho= acceso.verificar(88,rol_id) %}
{# permisos para solicitar un  auxiliar fin  #}



{# PERMISO FIN #}

<form id="form_seccionlaboral-general" class="form-vertical mt-1">
                  
                  
    <input type="hidden" id="sel_id-general" name="sel_id">

      {% if ochentaysiete_rl_lis==1 %}
        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
            <div class="container ">

              <center>
                <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
              Referencias laborales<i class="mdi mdi-bed-double white"></i>
                </p>
              </center>
                  

            </div>
          </div>
      {% endif %}

    <div class="row col-lg-12 d-flex ml-3 ">
          {% if treintaycinco==1 %}
          <div class="">
            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' ),"data-toggle":"modal","data-target":"#agregar-referencialaboral-modal","title":"Agregar.",'id':'agregar-referencialaboral-general') }}
          </div>
          <span class="ml-3 h6  text-success">Agregar referencias laborales</span>  
          {% endif %}
         
   

    </div>
      {% if ochentaysiete_rl_lis==1 %}
       <div class="form-group row m-3" id="dato_referencialaboral_listado_mensaje"
          style="
            display: flex;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
          "
        >
        {{ link_to('#', image("assets/images/sistema/loader.gif"), 'class': 'tu-clase-css') }}

        </div>
      {% endif %}

      {% if ochentaysiete_rl_lis==1 %}
         <div class="form-group row m-3" id="dato_referencialaboral_listado">
         </div>
      {% endif %}
  

        {% if ochentaycinco_per_lis==1 %}
        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
            <div class="container ">

              <center>
                <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
              Periodos de inactividad <i class="mdi mdi-bed-double white"></i>
                </p>
              </center>
                  

            </div>
          </div>
          {% endif %}
         
    
        <div class="row col-lg-12 d-flex ml-3 ">
           {% if treintaytres==1 %}
            <div class="text-left">
                    {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-periodoinactivo-modal","title":"Agregar periodo de inactividad" ,'id':'agregar-periodo_inactividad-general' ) }}
                
                    <span class="ml-3 h6  text-success">Agregar periodos inactivos</span>

            </div>     
          {% endif %}
         
        </div>

        {% if ochentaycinco_per_lis==1 %}
          <div class="form-group row m-3" id="dato_periodoinactivo_mensaje"
            style="
              display: flex;
              justify-content: center;
              font-size: 1.5rem;
              font-weight: bold;
            "
          >
          {{ link_to('#', image("assets/images/sistema/loader.gif"), 'class': 'tu-clase-css') }}

          </div> 

          <div class="form-group row m-3" id="dato_periodoinactivo_listado">
          </div>
        
        {% endif %}
       
      
    <section class="mt-3">
        
                <div id="" >
    
                       {% if ochentayseis_emc_lis==1 %}
                      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0 mb-5">                  
                          <div class="container ">
                            <center>
                              <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
                                  Empleos ocultos <i class="mdi mdi-worker white"></i>
                              </p>
                            </center>
                          </div>
                        </div>
                      {% endif %}
               

                      <div class="form-group row ">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Empleos ocultos</p>
                        </div>
                          <div class="col-lg-4">
                            <select  name="sel_empleosocultos" id="sel_empleosocultos-general" class="form-control select2-single col-1  fnMostrarSiONoEmpleosOcultos" data-toggle="select2" data-placeholder="Seleccionar ...">
                              <optgroup>
                                <option value="-1">Seleccionar ...</option>
                                <option value="1">1.-SI</option>
                                <option value="0">2.-NO</option>
                              </optgroup>
                            </select>
                          </div>
                      </div>
                      

                    {% if ochentayocho==1 %}
                    <div class="form-group row ">
                          <div class="col-lg-2">
                              <p class="col-form-label title-busq ml-2">Necesita ayuda</p>
                          </div>
                          <div class="col-lg-4">
                            <select  name="sel_necesitoauxiliar" id="sel_necesitoauxiliar-general" class="form-control select2-single col-1  fnMostrarSiONoEmpleosOcultos" data-toggle="select2" data-placeholder="Seleccionar ...">
                              <optgroup>
                                <option value="-1">Seleccionar ...</option>
                                <option value="1">1.-SI</option>
                                <option value="0">2.-NO</option>
                              </optgroup>
                            </select>
                          </div>
                    </div>
                    <div class="form-group row " id="row_input_auxiliar" style="display:none;">
                        <div class="col-lg-2">
                          <p class="col-form-label title-busq ml-2">Auxiliar</p>
                        </div>
                          <div class="col-lg-4">
                            <select  name="usu_idauxiliar" id="usu_idauxiliar-general" class="form-control select2-single col-1  fnMostrarSiONoEmpleosOcultos" data-toggle="select2" data-placeholder="Seleccionar ...">
                             
                            </select>
                          </div>

                          
                      </div>
                      
                    {% endif %}

                  

                      
                      <div id="container-empleos-ocultos" > 
                        <div class="row col-lg-12 d-flex ml-3  " id="btn-empleo-oculto-general" >
                          {% if treintaycuatro==1 %}
                          <div class="text-left" >
                            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-empleooculto-modal","title":"Agregar empleos ocultos" ,'id':'agregar-empleooculto-general') }}
                        
                            <span class="ml-3 h6  text-success">Agregar empleos ocultos</span>
                
                          </div>
                          {% endif %}

                        </div>


                        {% if ochentayseis_emc_lis==1 %}
                        <div class="form-group row m-3" id="dato_empleo_oculto_general_mensaje"
                          style="
                            display: flex;
                            justify-content: center;
                            font-size: 1.5rem;
                            font-weight: bold;
                          "
                        >
                        {{ link_to('#', image("assets/images/sistema/loader.gif"), 'class': 'tu-clase-css') }}

                        </div> 
                        <div  class="form-group row m-3" id="dato_empleo_oculto_general_listado" >
                          
                        </div>
                        {% endif %}

                        

                      </div>
                       

                </div>

      {% if cincuenta==1 %}
       <div class="form-group row">
                    <div class="col-lg-2">
                      <p class="col-form-label title-busq ml-2">Notas</p>
                    </div>
                    <div class="col-lg-10">
                      <textarea id="sel_notas-general"  name="sel_notas" oninput="handleInput(event)" onkeyup="actualizaInfo(500,'sel_notas-general', 'label_sel_notas')" class="form-control-textarea text_area_a" style="min-height:8rem" placeholder="Notas..." maxlength="500"></textarea>
                      <label class="col-form-label title-busq" id="label_sel_notas"></label>

                    </div>
                  </div>



                <div>
        {% endif %}
             



        {% if treintayseis==1 %}
        <div class="form-group row d-flex flex-row-reverse">
          <div class="col-lg-4">
            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
            <select  name="sel_calificacion" id="sel_calificacion-general" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup>
                <option value="-1">Seleccionar ...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

              </optgroup>
            </select>
          </div>
        </div>  
        {% endif %}
       
    </section>
    <div class="row col-lg-12">
       <div class="col-sm-4 col-md-4 text-center mt-5">
          <div class="form-group">
          </div>
      </div>
      <div class="col-sm-4 col-md-4 text-center mt-5">
          <div class="form-group">
            <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
          </div>
      </div>
      <div class="col-sm-4 col-md-4  text-center mt-5 ">
          <div class="form-group">
            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
          </div>
      </div>
    </div>
  </form> 
</div>