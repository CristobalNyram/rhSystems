

<form id="form_estudio_seccionDatosReferencias_formato_ese_truper" class="form-vertical " method="post">

        

    <input type="hidden" name="sep_id" id="sep_id-formato_truper">

 
    <section>
        <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
          <div class="container ">
      
                  <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                    REFERENCIAS VECINALES									
                    <i class="mdi mdi-network white  mdi-18px"></i>
                  </p>
      
          </div>
        </div>


        <div class="row col-lg-12 d-flex ml-3 ">
            <div class="">
              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaVecinalFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-referenciavecinal-truper-modal","title":"Agregar."  ) }}
            </div>
            <span class="ml-3 h6  text-success">Agregar referencias vecinales</span>
      
        </div>
      
      
          <div class="form-group row m-3" id="dato_referenciavecinal_truper_listado">
          </div>

     </section>


  

   
  





     <section>
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">
    
                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                  REFERENCIAS PERSONALES									
                  <i class="fas fa-hands  mdi-18px"></i>
                </p>
    
        </div>
      </div>
        <div class="row col-lg-12 d-flex ml-3 ">
            <div class="">
              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaPersonalFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-referenciapersonal-truper-modal","title":"Agregar."  ) }}
            </div>
            <span class="ml-3 h6  text-success">Agregar una referencia personal</span>
      
        </div>

        
 
        <div class="form-group row m-3" id="dato_referenciapersonal_truper_listado">
        </div>
     </section>







     

    <section>
   
      <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">
    
                <p class=" text-white text-center font-weight-bold h6 sin-margen" >
                  REFERENCIAS FAMILIAR									
                  <i class="fas fa-child white  mdi-18px"></i>
                </p>
    
        </div>
      </div>

              <div class="row col-lg-12 d-flex ml-3 ">
                <div class="">
                {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearreferenciaFamiliarFormatoTruper()'),"data-toggle":"modal","data-target":"#agregar-referenciafamiliar-truper-modal","title":"Agregar."  ) }}
                </div>
                <span class="ml-3 h6  text-success">Agregar una referencia familiar</span>
        
            </div>
        
        
            <div class="form-group row m-3" id="dato_referenciafamiliar_truper_listado">
            </div>

     </section>


     <div class="row col-lg-12 d-flex justify-content-end">
    
                              
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),21)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
            </div>
          {% endif %}
        </div>
    
    </div>


</form>