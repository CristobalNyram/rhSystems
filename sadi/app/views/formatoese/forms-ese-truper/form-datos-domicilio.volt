<form id="form_estudio_seccionDatosvivienda_formato_ese_truper" class="form-vertical mt-1">



    
   

 
  


<section class="m-3">

                         

                        
              
           
    <section class="mt-2 mb-2 mr-2 ml-2">
        <div class="form-group row">

                          <input type="hidden" id="ese_dav_id"  name="ese_id" >
                          <input type="hidden" id="dav_id"  name="dav_id" >

                              <div class="col-lg-2">
                                      <label class="col-form-label title-busq text-uppercase " for="dav_antiguedad">Antigüedad
                                       </label>
                                      <select  name="dav_antiguedad" id="dav_antiguedad" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase ">
              

                                        </optgroup>
                                      </select>
                              </div>
                              <div class="col-lg-3">
                                <label class="col-form-label title-busq text-uppercase " for="dav_zona">Zona
                                </label>
                                <select  name="dav_zona" id="dav_zona" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                               
                                  </optgroup>
                                </select>
                                </div>
    
                                <div class="col-lg-2">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_clasesocial">Clase social	
                                  </label>
                                  <select  name="dav_clasesocial" id="dav_clasesocial" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
      
                                    </optgroup>
                                  </select>
                                </div>
    
    
                                <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_vivienda">Vivienda                                </label>
                                  <select  name="dav_vivienda" id="dav_vivienda" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="ocultarCamposSiViviendaPropia(event);">
                                    <optgroup class="text-uppercase">
                                    
                                    </optgroup>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_inmueble">Inmueble
                                  </label>
                                  <select  name="dav_inmueble" id="dav_inmueble" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                     
                                    </optgroup>
                                  </select>
                                </div>
    
    
    
                      </div>
                    
                      <div class="form-group row">
                     
                              <div class="col-lg-3">
                                      <label class="col-form-label title-busq text-uppercase ">Formato de la vivienda	
                                      </label>
                                      <select  name="dav_formatovivienda" id="dav_formatovivienda" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase">
    
                                        </optgroup>
                                      </select>
                              </div>
    
                              <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase ">Niveles
                                  </label>
                                  <select  name="dav_nivel" id="dav_nivel" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
    
                                    </optgroup>
                                  </select>
                              </div>
    
                              <div class="col-lg-3">
                                <label class="col-form-label title-busq text-uppercase " for="dav_apariencia">Apariencia
                                </label>
                                <select  name="dav_apariencia" id="dav_apariencia" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase">
    
                                        </optgroup>
                                  </select>
                              </div>  
                              <div class="col-lg-3">
                                <label class="col-form-label title-busq text-uppercase " for="dav_estadomobiliario">Estado del Mobiliario	
                                </label>
                                <select  name="dav_estadomobiliario" id="dav_estadomobiliario" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
    
                                  </optgroup>
                                </select>
                        </div>
    
    
    
                              
    
    
                       </div>
    
                       
    
                       
                       
             
    
    
    
    
                       
    
    
              <div class="form-group row">
 
                  <div class="col-lg-2">
                          <label for="estudio_bienesinmuebles_distribucion_recamaras" class="col-form-label title-busq text-uppercase ">Recámaras</label>
                          <input type="number" class="form-control input-rounded"  placeholder="Número de racámaras (1-10)..."  oninput="this.value = Math.abs(this.value)"  min="0" max="10" name="dav_recamara" id="dav_recamara" step="0.0"/>
    
                      
                  </div>
                  <div class="col-lg-2">
                    <label  for="estudio_bienesinmuebles_distribucion_banos" class="col-form-label title-busq text-uppercase ">Baños</label>
                    <input type="number" class="form-control input-rounded"   placeholder="Número de baños (1,1.5,2,2.5..)..." max="5" oninput="this.value = Math.abs(this.value)"  name="dav_banio" id="dav_banio" maxlength="2" step="0.5"/>
    
    
                    </div>
    
                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_sala" >Sala</label>
                      <select  name="dav_sala" id="dav_salatruper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                     
                    </div>
    
                    <div class="col-lg-2">
                      <label   class="col-form-label title-busq text-uppercase " for="dav_cocina">Cocina</label>
                      <select  name="dav_cocina" id="dav_cocina" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                    </div>

                    <div class="col-lg-2">
                      <label   class="col-form-label title-busq text-uppercase " for="dav_comedor" >Comedor</label>
                      <select  name="dav_comedor" id="dav_comedor" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
    
                    </div>
                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_estudio" >Estudio</label>
                      <select  name="dav_estudio" id="dav_estudio" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                    </div>

                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_salajuego" >Sala de juegos</label>
                      <select  name="dav_salajuego" id="dav_salajuego" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                      
                    </div>


                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_terraza">Terraza</label>
                      <select  name="dav_terraza" id="dav_terraza" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                      
                    </div>

                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_cualavado" >Cuarto de lavado</label>
                      <select  name="dav_cualavado" id="dav_cualavado" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                      
                    </div>


                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_cuaservicio">Cuarto de servicio</label>
                      <select  name="dav_cuaservicio" id="dav_cuaservicio" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                    </div>

                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_garage">Garaje</label>
                     
                     <select  name="dav_garage" id="dav_garage" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup class="text-uppercase">
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                      </optgroup>
                    </select>
                    </div>


                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_jardin">Jardín</label>
                      <select  name="dav_jardin" id="dav_jardin" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                      
                    </div>


                    <div class="col-lg-2">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_piscina">Piscina</label>
                      <select  name="dav_piscina" id="dav_piscina" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup class="text-uppercase">
                          <option value="-1">Seleccionar ...</option>
                          <option value="1">SI</option>
                          <option value="0">NO</option>
                        </optgroup>
                      </select>
                      
                    </div>


                    <div class="col-lg-7 vivienda-no-propia">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_nombrepropietario">Nombre de propietario</label>
                      <input type="text" class="form-control input-rounded data-not-lt-active " oninput="handleInput(event);"  placeholder="Nombre de propietario..."  name="dav_nombrepropietario" id="dav_nombrepropietario" maxlength="45"/>
    
                      
                    </div>
    

                    <div class="col-lg-3 vivienda-no-propia">
                      <label  class="col-form-label title-busq text-uppercase " for="dav_telpropietario">Teléfono</label>
                      <input type="text" class="form-control input-rounded" oninput="handleInput(event);"  placeholder="Teléfono..."  name="dav_telpropietario" id="dav_telpropietario" maxlength="20"/>
    
                      
                    </div>
    

                    
    
    
              </div>

              <div class="form-group row">
                <div class="col-lg-2">
                  <p class="col-form-label title-busq ml-2">Comentarios del domicilio</p>  
                  
                
                </div>
                <div class="col-lg-10">
                  <textarea id="dav_comentario"  name="dav_comentario" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Comentarios..." maxlength="500" onkeyup="actualizaInfo(500,'dav_comentario', 'dav_comentario-formato_truper')"></textarea>
                  <label class="col-form-label title-busq" id="dav_comentario-formato_truper"></label>

                </div>
              </div>
    
    
    
    </section>





                 



</section>


<div >

    <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
        <div class="container row d-flex justify-content-center">
          
              <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                B | SERVICIOS EN LA ZONA  <i class="fas fa-cloud-meatball white mdi-18px"></i>
              </p>
    
        </div>
    
    
    
    </div>
    
    
    
    <section class="mt-2 mb-2 mr-2 ml-2">
        <div class="form-group row">

                              <div class="col-lg-2">
                                <input type="hidden" name="bie_id" id="bie_id">
                                      <label class="col-form-label title-busq text-uppercase " for="dav_agua">Agua</label>
                                      <select  name="dav_agua" id="dav_agua" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase">
                                          <option value="-1">Seleccionar ...</option>
                                          <option value="1">SI</option>
                                          <option value="0">NO</option>
                                        </optgroup>
                                      </select>
                              </div>
                              <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_drenaje">Drenaje</label>
                                <select  name="dav_drenaje" id="dav_drenaje" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                                </div>
    
                                <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_luz">Luz</label>
                                  <select  name="dav_luz" id="dav_luz" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                                </div>
    
    
                                <div class="col-lg-2">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_telefono">Teléfono</label>
                                  <select  name="dav_telefono" id="dav_telefono" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                                </div>
                                <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_alumbrado">Alumbrado</label>
                                  <select  name="dav_alumbrado" id="dav_alumbrado" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                                </div>
    
    
    
                      </div>
                    
                      <div class="form-group row">
                     
                              <div class="col-lg-3">
                                      <label class="col-form-label title-busq text-uppercase " for="dav_pavimento">Pavimento</label>
                                      <select  name="dav_pavimento" id="dav_pavimento" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase">
                                          <option value="-1">Seleccionar ...</option>
                                          <option value="1">SI</option>
                                          <option value="0">NO</option>
    
                                        </optgroup>
                                      </select>
                              </div>
    
                              <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_tvcable">TV cable</label>
                                  <select  name="dav_tvcable" id="dav_tvcable" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                    <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                              </div>
    
                              <div class="col-lg-3">
                                <label class="col-form-label title-busq text-uppercase " for="dav_internet" >Internet</label>
                                <select  name="dav_internet" id="dav_internet" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                        <optgroup class="text-uppercase">
                                          <option value="-1">Seleccionar ...</option>
                                          <option value="1">SI</option>
                                          <option value="0">NO</option>
    
                                        </optgroup>
                                  </select>
                              </div>  
                              <div class="col-lg-3">
                                    <label class="col-form-label title-busq text-uppercase " for="dav_hospital">Hospitales</label>
                                    <select  name="dav_hospital" id="dav_hospital" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                      <optgroup class="text-uppercase">
                                        <option value="-1">Seleccionar ...</option>
                                        <option value="1">SI</option>
                                    <option value="0">NO</option>
        
                                      </optgroup>
                                    </select>
                             </div>
                          <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_parque">Parques</label>
                                  <select  name="dav_parque" id="dav_parque" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                          </div>
                          <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_deportivo">Deportivos</label>
                                  <select  name="dav_deportivo" id="dav_deportivo" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                    <option value="0">NO</option>
      
                                    </optgroup>
                                  </select>
                          </div>
    
                          <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_club">Club</label>
                                  <select  name="dav_club" id="dav_club" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                          </div>


                          <div class="col-lg-3">
                                  <label for="dav_casacultura" class="col-form-label title-busq text-uppercase ">Casa cultura</label>
                                  <select  name="dav_casacultura" id="dav_casacultura" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
                                    </optgroup>
                                  </select>
                          </div>
    

                          <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_transportepub">Transporte público	
                                  </label>
                                  <select  name="dav_transportepub" id="dav_transportepub" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                    <option value="0">NO</option>
      
                                    </optgroup>
                                  </select>
                          </div>


                          <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_servgas">Servicio de Gas	
                                    
                                  </label>
                                  <select  name="dav_servgas" id="dav_servgas" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">ESTACIONARIO</option>
                                      <option value="2">NATURAL</option>
                                      <option value="3">CILINDRO</option>

                                    </optgroup>
                                  </select>
                         </div>


                   

                       <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_centrocomercial">Centros comerciales
                                    
                                  </label>
                                  <select  name="dav_centrocomercial" id="dav_centrocomercial" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
      
                                    </optgroup>
                                  </select>
                        </div>



                         <div class="col-lg-3">
                                  <label class="col-form-label title-busq text-uppercase " for="dav_fibraoptica">Fibra Óptica
                                    
                                  </label>
                                  <select  name="dav_fibraoptica" id="dav_fibraoptica" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                    <optgroup class="text-uppercase">
                                      <option value="-1">Seleccionar ...</option>
                                      <option value="1">SI</option>
                                      <option value="0">NO</option>
      
                                    </optgroup>
                                  </select>
                        </div>


                  
    


                       
                       

          	

                       
                       
             
    
    
    
    
                       
    
    
           
    
    
    
    </section>

</div>



<div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
    <div class="container row d-flex justify-content-center">
      
          <p class=" text-white text-center font-weight-bold h6 sin-margen" >
            B | ESTILO DE VIDA <i class="fas fa-american-sign-language-interpreting white mdi-18px"></i>
          </p>

    </div>




</div>



<section class="mt-2 mb-2 mr-2 ml-2">
  <div class="form-group row">

                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_television">Televisión
                                </label>
                                <select  name="dav_television" id="dav_television" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>
                      

                        
                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_pantalla">Pantalla
                                </label>
                                <select  name="dav_pantalla" id="dav_pantalla" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>

                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="bie_agua">Teatro en casa
                                </label>
                                <select  name="dav_teatrocasa" id="dav_teatrocasa" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>

                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_dvd">DVD
                                </label>
                                <select  name="dav_dvd" id="dav_dvd" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>

                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_blueray">Blue Ray
                                </label>
                                <select  name="dav_blueray" id="dav_blueray" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>
                        

                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_estereo">Estéreo
                                </label>
                                <select  name="dav_estereo" id="dav_estereo" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>


                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_pc">PC
                                </label>
                                <select  name="dav_pc" id="dav_pc" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_laptop">Laptop
                                </label>
                                <select  name="dav_laptop" id="dav_laptop" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_tablet">Tablet
                                </label>
                                <select  name="dav_tablet" id="dav_tablet" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_smartphone">Smartphone
                                </label>
                                <select  name="dav_smartphone" id="dav_smartphone" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_videocamara">Videocámara
                                </label>
                                <select  name="dav_videocamara" id="dav_videocamara" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_camara">Cámara
                                </label>
                                <select  name="dav_camara" id="dav_camara" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>


                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_cocinaintegral">Cocina integral
                                </label>
                                <select  name="dav_cocinaintegral" id="dav_cocinaintegral" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_estufa">Estufa
                                </label>
                                <select  name="dav_estufa" id="dav_estufa" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_horno">Horno
                                </label>
                                <select  name="dav_horno" id="dav_horno" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_microondas">Microondas
                                </label>
                                <select  name="dav_microondas" id="dav_microondas" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_licuadora">Licuadora
                                </label>
                                <select  name="dav_licuadora" id="dav_licuadora" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_plancha">Plancha
                                </label>
                                <select  name="dav_plancha" id="dav_plancha" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>




                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_lavadora">Lavadora
                                </label>
                                <select  name="dav_lavadora" id="dav_lavadora" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_refrigerador">Refrigerador
                                </label>
                                <select  name="dav_refrigerador" id="dav_refrigerador" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_lavatraste">Lavatrastes
                                </label>
                                <select  name="dav_lavatraste" id="dav_lavatraste" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>



                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_hidrolavadora">Hidrolavadora
                                </label>
                                <select  name="dav_hidrolavadora" id="dav_hidrolavadora" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>


                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_lampara">Lámparas
                                </label>
                                <select  name="dav_lampara" id="dav_lampara" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>


                        <div class="col-lg-2">
                                <label class="col-form-label title-busq text-uppercase " for="dav_cuadro">Cuadros
                                </label>
                                <select  name="dav_cuadro" id="dav_cuadro" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                                  <optgroup class="text-uppercase">
                                    <option value="-1">Seleccionar ...</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </optgroup>
                                </select>
                        </div>

                        



    
                                 
  </section>

  <div class="form-group row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
    <div class="container row d-flex justify-content-center">
      
          <p class=" text-white text-center font-weight-bold h6 sin-margen" >
            B |  DOMICILIOS ANTERIORES <i class="fas fa-house-damage white mdi-18px"></i>
          </p>

    </div>




</div>


<section>


        <div class="row col-lg-12 d-flex ml-3 ">
          <div class="">
            {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearDatoViviendaanteriorDetalles()'),"data-toggle":"modal","data-target":"#agregar-datoviviendaanterioranterior-modal","title":"Agregar."  ) }}
          </div>
          <span class="ml-3 h6  text-success">Agregar un domicilio de vivienda anterior  <span class="text-warning">(Llenar cuando se tenga menos de un año en el domicilio actual) </span> </span>

        </div>


 


        <div class="form-group row m-3" id="datoviviendanterdetalles_truper_listado">
        </div>

</section>




    
    

<div class="row col-lg-12">
<div class="col-sm-3 col-md-3 text-center mt-5">
</div>                          
<div class="col-sm-3 col-md-3 text-center mt-5">
  {% if cuarentayseis==1%}
    <div class="form-group">
      <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),13)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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



</form> 

<script>
  function ocultarCamposSiViviendaPropia(event) {
  
 
    let value=event.currentTarget.value;
    let elementos = document.querySelectorAll('.vivienda-no-propia');

    if(value==1){
        elementos.forEach(function(elemento) {
              elemento.style.display = 'none';

      });
    }else{
      // Recorrer todos los elementos y limpiar su contenido HTML
      elementos.forEach(function(elemento) {
        elemento.style.display = 'block';

      });

    }
  }
</script>