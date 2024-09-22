

    <div class="row col d-flex justify-content-center ">
           <h5 class="text-center"> Familiares que viven o no viven con el candidato</h5>
    </div>

    <div class="row col-lg-12 d-flex ml-3 ">
        <div class="">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearDatoGrupoFamiliarDetalles_vivecon_formato_truper()'),"data-toggle":"modal","data-target":"#agregar-familiarvivecon-formato_truper-modal","title":"Agregar."  ) }}
        </div>

        <span class="ml-3 h6  text-success">Agregar familiares</span>

    </div>
    <section>

      <div class="form-group row m-3" id="datogrupofamiliardetalles_viven_formato_truper_listado">

      </div>

    </section>




    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">

                <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                    E | FAMILIARES QUE TRABAJAN EN LA COMPAÑÍA										
                    <i class="mdi mdi-worker white"></i>
                </p>

        </div>
    </div>
    <div class="row col-lg-12 d-flex ml-3 ">
        <div class="">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearDatoGrupoFamiliarDetalles_trabajancompania_formato_trabacompania_truper()'),"data-toggle":"modal","data-target":"#agregar-familiartrabajancompania-formato_trabacompania_truper-modal","title":"Agregar."  ) }}
        </div>

        <span class="ml-3 h6  text-success">Agregar familiares</span>

    </div>
    <section>

      <div class="form-group row m-3" id="datogrupofamiliardetalles_trabajancompania_formato_truper_listado">

      </div>

    </section>

    
    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
        <div class="container ">

                <p class=" text-white text-center font-weight-bold h6 text-uppercase sin-margen" >
                    E | FAMILIARES QUE TIENEN NEGOCIO (S) Y/O TRABAJAN EN EL GIRO FERRETERO																				
                    <i class="mdi mdi-worker white"></i>
                </p>

        </div>
    </div>
    <div class="row col-lg-12 d-flex ml-3 ">
        <div class="">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearDatoGrupoFamiliarDetalles_negociootrabajoen_formato_negociootrabajoen_truper()'),"data-toggle":"modal","data-target":"#agregar-formato_negociootrabajoen_truper-modal","title":"Agregar."  ) }}
        </div>

        <span class="ml-3 h6  text-success">Agregar un familiar</span>

    </div>
    <section>

      <div class="form-group row m-3" id="datogrupofamiliardetalles_negociootrabajoen_formato_truper_listado">

      </div>

    </section>

    <section class="border-top mt-4 pt-3">

        <form id="form_estudio_seccionDatosFamiliares_formato_ese_truper" class=" form-vertical mt-1 ">

            <input type="hidden" id="dgf_ese_id-formato-truper"  name="ese_id">
            <input type="hidden" id="dgf_id-formato-truper"  name="dgf_id">

            <div class="form-group row mr-2 ml-2">
                <div class="col-lg-2">
                  <label for="" class="col-form-label title-busq ml-2">Comentario de datos familiares</label>
        
                </div>
                <div class="col-lg-10">
        
                  <textarea id="dgf_comentario-formato-truper" name="dgf_comentario" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" onkeyup="actualizaInfo(400,'dgf_comentario-formato-truper', 'label-dgf_comentario-formato-truper')"></textarea>
                  <label  id="label-dgf_comentario-formato-truper" for="label-dgf_comentario-formato-trupe" class="col-form-label title-busq ml-2"></label>
        
                </div>
            </div>  


            <div class="row col-lg-12">
                <div class="col-sm-3 col-md-3 text-center mt-5">
                  </div>                          
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                    {% if cuarentayseis==1%}
                   
                      <div class="form-group">
                        <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),16)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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



    </section>