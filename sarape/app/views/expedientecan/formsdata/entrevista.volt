<style>
  #vac_estatus-resumen_ex .badge
   {
    width: 100%;
    font-size: 1rem;
}
</style>
<form id="form-ent-resumen_exc" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
                    
    <section class="m-3 "> 

          <div class="form-group row">
           
            <div class="col-lg-4">
              <label class="col-form-label title-busq text-uppercase" for="ent_fecha-resumen_exc">FECHA DE ENTREVISTA</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="ent_fecha-resumen_exc"  readonly name="ent_fecha-resumen_exc" maxlength="150"   />
            </div>
             <div class="col-lg-4">
              <label class="col-form-label title-busq text-uppercase" for="ent_hora-resumen_exc">HORA DE ENTREVISTA</label>
              <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="ent_hora-resumen_exc"  readonly name="ent_hora-resumen_exc" maxlength="150"    />
            </div>
        
            <div class="col-lg-4">

  

      

            

          </div>

  </section>

  <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
      <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
           
          <div class="container "> 
                <center>
                  <p class=" text-white text-center font-weight-bold h6 sin-margen">
                    FACTURACIÓN    <i class="mdi mdi-cash-multiple white "></i>
                  </p>
                </center>
                    
          </div>
  
      </div>


 </div>

 <section class="m-3 "> 

  <div class="form-group row">
   
    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_seleccionado-resumen_exc">Sueldo </label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="fat_sueldo-resumen_exc"  readonly name="fat_sueldo-resumen_exc" maxlength="150"     />
    </div>
    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_seleccionado-resumen_exc">Factor </label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="fat_factor-resumen_exc"  readonly name="fat_factor-resumen_exc" maxlength="150"     />
    </div>

    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_seleccionado-resumen_exc">Requiere factura </label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="fat_reqfactura-resumen_exc"  readonly name="fat_reqfactura-resumen_exc" maxlength="150"     />
    </div>
    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_seleccionado-resumen_exc">Monto a facturar </label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="fat_montofacturar-resumen_exc"  readonly name="fat_montofacturar-resumen_exc" maxlength="150"     />
    </div>

    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_seleccionado-resumen_exc">Estatus de vacante cuando se facturó</label>
      <div id="vac_estatus-resumen_ex">

      </div>
    </div>
    <div class="col-lg-4">
      <label class="col-form-label title-busq text-uppercase" for="ent_hora-resumen_exc">FECHA DE INGRESO</label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="fat_fechaingreso-resumen_exc"  readonly name="fat_fechaingreso-resumen_exc" maxlength="150"    />
    </div>
   



    

  </div>





</section>


  </form>    

   <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
                   <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">

                                
                    <div class="container ">
                      
                      <center>
                        <p class=" text-white text-center font-weight-bold h6 sin-margen">
                            ARCHIVOS    <i class="mdi mdi-folder-open white "></i>
                        </p>
                      </center>
                          
  
                    </div>
                
                    </div>

  

                
      </div>


      <div class="form-group row m-3"  id="contenedorcom-ent-resumen_exc"></div>
    <div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
      <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
        <div class="container">
          <center>
            <p class=" text-white text-center font-weight-bold h6 sin-margen">
              SEGUIMIENTO<i class="mdi mdi-comment-processing white "></i>
            </p>
          </center>
        </div>
      </div>
    </div>
    <div class="form-group row m-3"  id="contenedorcomentario-ent-resumen_exc"></div>

      <div class="row col-lg-12" style="display:flex; justify-content:space-between;">
                                
        
        <div class="col-sm-3 col-md-3  text-center mt-5 ">
              <div class="form-group">
                  <button type="button" id="btnAnteriorSeccionEntrevista"  class="btn-dark btn-rounded btn btn-buscar"> <i class="mdi mdi-arrow-collapse-left white"></i>  Anterior sección</button>
                
              </div>
        </div>
        <div class="col-sm-3 col-md-3  text-center mt-5 ">
            <div class="form-group">
             
             <button type="button"  id="btnSIguienteSeccionEntrevista" class="btn-dark btn-rounded btn btn-buscar">Siguiente sección <i class="mdi mdi-arrow-collapse-right white"></i> </button>
              
            </div>
        </div>
      </div>