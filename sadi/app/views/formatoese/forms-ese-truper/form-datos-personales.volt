<form id="form_estudio_seccionDatosPersonales_formato_ese_truper" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
    <section class=" "> 
      <div class="form-group row d-flex justify-content-end">
        <div class="col-lg-4">
          <label class="col-form-label title-busq" for="ese_nombre">Fecha de visita</label>
          <input type="date" class="form-control input-rounded data-not-lt-active" placeholder="Nombre..." id="formato_truper_ese_fechavisita" name="ese[ese_fechavisita]" maxlength="150"    />
        </div>
       </div>
          <div class="form-group row">
            <input type="hidden" value="" id="ese_formato_ese_truper_ese_id" name="ese[ese_id]">
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_nombre">Nombre</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre..." id="formato_truper_ese_nombre" name="ese[ese_nombre]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_primerapellido">Primer apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido..."  name="ese[ese_primerapellido]" id="formato_truper_ese_primerapellido" maxlength="150" oninput="handleInput(event)" />

            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Segundo apellido</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido..."  name="ese[ese_segundoapellido]" id="formato_truper_ese_segundoapellido" maxlength="150" oninput="handleInput(event)" />

            </div>
            
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="">Puesto</label>
              <input type="text" class="form-control input-rounded" placeholder="Puesto..." id="formato_truper_ese_puesto" name="ese[ese_puesto]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="">Área</label>
              <input type="text" class="form-control input-rounded" placeholder="Área..." id="formato_truper_ese_area" name="ese[ese_area]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
           
            <div class="col-lg-5">
              <label class="col-form-label title-busq" for="ese_formato_ese_truper_ese_lugarnacimiento">Lugar de nacimiento</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Lugar de nacimiento..." id="formato_truper_ese_lugarnacimiento" name="ese[ese_lugarnacimiento]" />
            </div>
              
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="cop_nacimientofecha">Fecha de nacimiento</label>
              <input type="date" class="form-control input-rounded" placeholder="00-00-00"  name="ese[ese_fechanacimiento]" id="formato_truper_ese_fechanacimiento" maxlength="" oninput="establecerFechaCalculada(event.target,'formato_truper_ese_edad') "/>

            </div>

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_edad">Edad</label>
              <input type="number" class="form-control input-rounded"  placeholder="Edad..."    readonly name="ese[ese_edad]" id="formato_truper_ese_edad" maxlength="20"/>
            </div>
            
            
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_genero">Género</label>
              <select name="ese[ese_sexo]" id="formato_truper_ese_sexo" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                <option value="-1">Seleccionar...</option>
                <option value="2">Masculino</option>
                <option value="1">Femenino</option>
             
              </select>
            </div>
       

        
       

            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_estado_civil">Estado civil</label>
              <select name="ese[esc_id_eses]" id="formato_truper_esc_id_eses" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
              </select>

            </div>

            <div class="col-lg-6" hidden>
              <label class="col-form-label title-busq" for="">CURP</label>
              <input type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="CURP..."     name="ese[ese_curp]" id="formato_truper_ese_curp" maxlength="19"/>

            </div>
       

            <div class="col-lg-6" hidden>
              <label class="col-form-label title-busq" for="">IMSS</label>
              <input type="text" oninput="handleInput(event)"  class="form-control input-rounded"  placeholder="IMSS..."     name="ese[ese_nss]" id="formato_truper_ese_nss" maxlength="19"/>

            </div>

          </div>


          <div class="form-group row">

            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle</label>
              <input type="text" class="form-control input-rounded" placeholder="Calle..." id="formato_truper_ese_calle" name="ese[ese_calle]" maxlength="150"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número exterior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número exterior..." id="formato_truper_ese_numext" maxlength="45" name="ese[ese_numext]"  oninput="handleInput(event)"  />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="estudio_domicilio">Número interior</label>
              <input type="text" class="form-control input-rounded" placeholder="Número interior..." id="formato_truper_ese_numint" maxlength="45" name="ese[ese_numint]"  oninput="handleInput(event)"  />
            </div>
          

              <div class="col-lg-4">
                <label class="col-form-label title-busq" for="estudio_domicilio_colonia">Colonia</label>
                <input type="text" class="form-control input-rounded" placeholder="Colonia..." id="formato_truper_ese_colonia" maxlength="90" name="ese[ese_colonia]"  oninput="handleInput(event)"  />
              </div>
            
      

              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Estado</label>
                <select name="ese[est_id]" id="formato_truper_est_id" class="form-control select2-single " onchange="fnmunicipios_adaptable($('#formato_truper_mun_id'),$('#formato_truper_est_id').val(),-1)" data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>
  
              </div>
              <div class="col-lg-6">
                <label class="col-form-label title-busq" for="estudio_mucipio">Municipio</label>
                <select name="ese[mun_id]" id="formato_truper_mun_id"  class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                
                </select>

              </div>
            
         

          </div>

          <div class="form-group row">
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="estudio_codigo_postal">Código postal</label>
              <input type="text" class="form-control input-rounded" placeholder="Código..." id="formato_truper_ese_codpostal" maxlength="10" name="ese[ese_codpostal]"  oninput="handleInput(event)"/>
              
            </div>
            <div class="col-lg-9" >
              <label class="col-form-label title-busq" for="estudio_entrecalles">Entre calles</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Entre calles..." id="formato_truper_ese_entrecalles" name="ese[ese_entrecalles]" />
            </div>
            <div class="col-lg-12">
              <label class="col-form-label title-busq" for="estudio_entrecalles">Referencia de ubicación</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="150" class="form-control input-rounded" placeholder="Referencia ubicación..." id="formato_truper_ese_referenciaubicacion" name="ese[ese_referenciaubicacion]" />
            </div>
  
  
          
  
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_celular">Celular</label>
              <input type="text" oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Celular..."  id="formato_truper_ese_celular" name="ese[ese_celular]"/>
            </div>
  
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_telefono">Teléfono</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Teléfono..." id="formato_truper_ese_telefono" name="ese[ese_telefono]" />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="estudio_telefono">Teléfono de recados</label>
              <input type="text"   oninput="handleInput(event)"  maxlength="20" class="form-control input-rounded" placeholder="Teléfono de recados..." id="formato_truper_ese_telefonorecado" name="ese[ese_telefonorecado]" />
            </div>
  
  
  
  
  
          
  
  

  
  
  
   
          </div>

            
        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 mt-5" style="margin: 1px;">                  
            <div class="container ">
      
                    <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                      A | UBICACIÓN DEL DOMICILIO									
                
                        <i class="mdi mdi-map white"></i>
                    </p>

            </div>
        </div>


        <div class="form-group row text-uppercase d-flex  d-flex justify-content-center">
          <div class="">
            <h5><span class="text-secondary">Seleccione la ubicación de la vivienda </span></h5>
          </div>
        </div>
          
          <div class="container justify-content-center">
            <div class="row d-flex justify-content-center">
                   <div class="col-1 p-1 m-1  border text-center">
                  •
                  </div>
                  <div class=" col-2">
                   
                   </div>
                  <div class="col-3 p-1 m-1 border bg-danger text-center text-white">
                  NORTE
                  </div>

                  <div class=" col-2">
                    
                   </div>

                  <div class="col-1 p-1 m-1  border text-center">
                    •
                  </div>
                  
                  
            </div>
            <div class="d-flex justify-content-center" id="calle_norte-truper">
              <div id="ese_ese_nombre_calle_norte-truper"></div>
       
          </div>
            <div class="">

            </div>
            <div class="row d-flex justify-content-center">
            
              <div class="col-1 p-1 m-1  border bg-danger text-center text-white">
                OESTE
                <br>


               
              </div>
              <div class=" col-2" style="word-wrap: break-word ; overflow: auto;" id="calle_oeste-truper" >
                <div class="d-flex justify-content-center" >
                  <div id="ese_ese_nombre_calle_oeste-truper"  ></div>
                </div>
               </div>
              <div class="col-3 p-1 m-1 border">
                <div class="col-12 d-flex justify-content-between">
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_1"  name="ese[ese_ubicacioncasa]" value="1"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_2" class=""  name="ese[ese_ubicacioncasa]" value="2"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_3"  name="ese[ese_ubicacioncasa]" value="3"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_4"   name="ese[ese_ubicacioncasa]" value="4"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_5"  name="ese[ese_ubicacioncasa]" value="5"/> 


                </div>
                <br>
                <div class="col-12 d-flex justify-content-between">
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_6"  name="ese[ese_ubicacioncasa]" value="6"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_7"   class="d-none"  name="ese[ese_ubicacioncasa]" value="7"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_8"  class="d-none"  name="ese[ese_ubicacioncasa]" value="8"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_9"   class="d-none"  name="ese[ese_ubicacioncasa]" value="9"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_10"  name="ese[ese_ubicacioncasa]" value="10"/> 

                </div>
                <br>

                <div class="col-12 d-flex justify-content-between">
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_11"  name="ese[ese_ubicacioncasa]" value="11"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_12"   name="ese[ese_ubicacioncasa]" value="12"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_13"  name="ese[ese_ubicacioncasa]" value="13"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_14" name="ese[ese_ubicacioncasa]" value="14"/> 
                  <input  type="radio" id="formato_truper_ese_ubicacioncasa_15"  name="ese[ese_ubicacioncasa]" value="15"/> 

                </div>



              </div>
              <div class=" col-2" style="word-wrap: break-word ; overflow: auto;" id="calle_este-truper" >
                <div class="d-flex justify-content-center">
                  <div id="ese_ese_nombre_calle_este-truper" ></div>
                </div>
               </div>
                          
              <div class="col-1 p-1 m-1   border bg-danger text-center text-white">
                ESTE
                <br>
                
              </div>
          </div>
               <div class="d-flex justify-content-center" id="calle_sur-truper">
                  <div id="ese_ese_nombre_calle_sur-truper"></div>
           
              </div>
                <div class="row d-flex justify-content-center">
                      
                      <div class="col-1 p-1 m-1 border text-center">
                        •
                      </div>
                      <div class=" col-2">
                        
                       </div>
                      <div class="col-3 p-1 m-1  border bg-danger text-center text-white">
                        SUR
                      </div>
                      <div class=" col-2">
                        
                       </div>
                      <div class="col-1 p-1 m-1 border text-center">
                        •
                      </div>
                </div>
          </div>

          <div>
         

          <div class="form-group row ">
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle norte</label>
              <input type="text" class="form-control input-rounded input-calle-norte" placeholder="Calle norte.." id="formato_truper_ese_callenorte" name="ese[ese_callenorte]" maxlength="55"  oninput="handleInput(event); escribir_nombre_calle_norte(event.currentTarget.value);"  />
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle sur</label>
              <input type="text" class="form-control input-rounded  input-calle-sur" placeholder="Calle sur..." id="formato_truper_ese_callesur" name="ese[ese_callesur]" maxlength="55"  oninput="handleInput(event);escribir_nombre_calle_sur(event.currentTarget.value);" />
            </div>          
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle oeste</label>
              <input type="text" class="form-control input-rounded input-calle-oeste" placeholder="Calle oeste..." id="formato_truper_ese_calleoeste" name="ese[ese_calleoeste]" maxlength="55"  oninput="handleInput(event); escribir_nombre_calle_oeste(event.currentTarget.value);" />
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="estudio_domicilio">Calle este</label>
              <input type="text" class="form-control input-rounded input-calle-este" placeholder="Calle este..." id="formato_truper_ese_calleeste" name="ese[ese_calleeste]" maxlength="55"  oninput="handleInput(event);escribir_nombre_calle_este(event.currentTarget.value);" />
            </div>            
           
            
          </div>

          <div class="form-group row justify-content-center">

     

          </div>

     
    
      <div class="row col-lg-12">
        <div class="col-sm-3 col-md-3 text-center mt-5">
        </div>                          
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),12)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
            </div>
          {% endif %}
        </div>
        <div class="col-sm-3 col-md-3 text-center mt-5">
            <div class="form-group">
              <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
            </div>
        </div>
        <div class="col-sm-3 col-md-3  text-center mt-5 ">
            <div class="form-group">
             
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
              
            </div>
        </div>
      </div>

  </section>

  </form>      


  <script>

    function escribir_nombre_calle_norte(value){


      $('#ese_ese_nombre_calle_norte-truper').text(value);
    }


    function escribir_nombre_calle_sur(value){
      $('#ese_ese_nombre_calle_sur-truper').text(value);
    }
    function escribir_nombre_calle_este(value){
      $('#ese_ese_nombre_calle_este-truper').text(value);
    }

    function escribir_nombre_calle_oeste(value){
      $('#ese_ese_nombre_calle_oeste-truper').text(value);
    }

    $('.input-calle-norte').blur(function(){
      $('#calle_norte-truper').css(
        {'background':'white',
        'border':'none',
        'color':'black'
      });
    });
    $(".input-calle-norte").on("input", function(e) {
 
        $('#calle_norte-truper').css(
        {'background':'#1A8ED3',
        'border':'1px solid black',
        'color':'white',
        'border-radius': '10px'

       });

    });


    $('.input-calle-sur').blur(function(){
      $('#calle_sur-truper').css(
        {'background':'white',
        'border':'none',
        'color':'black'
      });
    });
    $(".input-calle-sur").on("input", function(e) {
 
        $('#calle_sur-truper').css(
        {'background':'#1A8ED3',
        'border':'1px solid black',
        'color':'white',
        'border-radius': '10px'
       });

    });


    
    $('.input-calle-este').blur(function(){
      $('#calle_este-truper').css(
        {'background':'white',
        'border':'none',
        'color':'black'
      });
    });
    $(".input-calle-este").on("input", function(e) {
 
        $('#calle_este-truper').css(
        {'background':'#1A8ED3',
        'border':'1px solid black',
        'color':'white',
        'border-radius': '10px'
       });

    });

    $('.input-calle-oeste').blur(function(){
      $('#calle_oeste-truper').css(
        {'background':'white',
        'border':'none',
        'color':'black'
      });
    });
    $(".input-calle-oeste").on("input", function(e) {
 
        $('#calle_oeste-truper').css(
        {'background':'#1A8ED3',
        'border':'1px solid black',
        'color':'white',
        'border-radius': '10px'
       });

    });


    

  </script>