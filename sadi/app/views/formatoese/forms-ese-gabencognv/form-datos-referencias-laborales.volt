<form id="form_estudio_seccionReferenciasLaborales_formato_gabencognv" class="form-vertical mt-1">
                  
               
    <!-- <div class="form-group row mt-3 mb-3 d-flex justify-content-center">
          <p class="text-danger font-weight-bold uppercase">
            Que no sean de parientes, ni de empleos anteriores
          </p>
    </div> -->
    <input type="hidden" id="sel_id_formato_gabencognv" name="sel_id">

    <div class="row col-lg-12 d-flex ml-3 " >
      <div class="">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50' , 'onclick':'fnCrearReferenciaLaboral_formato_gabencognv()'),"data-toggle":"modal","data-target":"#agregar-referencialaboral_formato_gabencognv-modal","title":"Agregar."  ) }}
      </div>
      <span class="ml-3 h6  text-success">Agregar referencias laborales</span>

    </div>


    <div class="form-group row m-3" id="dato_referencialaboral_listado_formato_gabencognv">
    </div>
 


    <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">                  
      <div class="container ">

        <center>
          <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
            B | Periodos de inactividad <i class="mdi mdi-bed-double white"></i>
          </p>
        </center>
            

      </div>
    </div>
    <div class="row col-lg-12 d-flex ml-3 ">
      <div class="text-left">
        {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearPeriodoInactivo_formato_gabencognv()'),"data-toggle":"modal","data-target":"#agregar-periodoinactivo_formato_gabencognv-modal","title":"Agregar periodo de inactividad" ,'id':'agregar_periodo_inactividad' ) }}
     
        <span class="ml-3 h6  text-success">Agregar periodos inactivos</span>

      </div>
    </div>

    <div class="form-group row m-3" id="dato_periodoinactivo_listado_formato_gabencognv">
    </div>

    <section class="mt-3">
      <div class="form-group row">
        <div class="col-lg-2">
          <p class="col-form-label title-busq ml-2">Observaciones finales</p>
        </div>
        <div class="col-lg-10">
          <textarea id="sel_notas_formato_gabencognv" required name="sel_notas" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" placeholder="Observaciones..."></textarea>
        </div>
      </div>


      {% if ochenta==1%}
          <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0 mb-5">                  
            <div class="container ">

              <center>
                <p class=" text-white text-center font-weight-bold h6 text-uppercase"  >
                  B | Empleos ocultos <i class="mdi mdi-worker white"></i>
                </p>
              </center>
                  

            </div>
          </div>


          <div class="form-group row">
            <div class="col-lg-2">
              <p class="col-form-label title-busq ml-2">Empleos ocultos</p>
            </div>
            <div class="col-lg-4">
              <select  name="sel_empleosocultos" id="sel_empleosocultos_formato_gabencognv" class="form-control select2-single col-1 fnMostrarSiONoEmpleosOcultosGabencognv" data-toggle="select2" data-placeholder="Seleccionar ...">
                <optgroup>
                  <option value="-1">Seleccionar ...</option>
                  <option value="1">1.-SI</option>
                  <option value="0">2.-NO</option>
                </optgroup>
              </select>
            </div>
          </div>


          <div id="container-empleos-ocultos-gab-gabencognv" style="display: none;"> 
            <div class="row col-lg-12 d-flex ml-3 "  >
              <div class="text-left">
                {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50', 'onclick':'fnCrearEmpleoOculto_formato_gabencognv()'),"data-toggle":"modal","data-target":"#agregar-empleooculto-gabencognv-modal","title":"Agregar empleos ocultos" ,'id':'img' ) }}
            
                <span class="ml-3 h6  text-success">Agregar empleos ocultos</span>

              </div>
            </div>

            


          <div class="form-group row m-3" id="dato_empleo_oculto_general_listado_gabencognv" >
            
          </div>

        </div>
      {% endif %}


      

      {% if cuarenta==1%}
        <div class="form-group row d-flex flex-row-reverse">
          <div class="col-lg-4">
            <label class="col-form-label title-busq text-uppercase ">Calificación</label>
            <select  name="sel_calificacion" id="sel_calificacion_formato_gabencognv" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup>
                <option value="-1">Seleccionar ...</option>
                <option value="1">1.-INAPROPIADO</option>
                <option value="2">2.-PROMEDIO</option>
                <option value="3">3.-APROPIADO</option>
              </optgroup>
            </select>
          </div>
        </div>
      {% endif %}
    </section>
    <div class="row col-lg-12">
      <div class="col-sm-3 col-md-3 text-center mt-5">
      </div>                          
      <div class="col-sm-3 col-md-3 text-center mt-5">
        {% if cuarentayseis==1%}
          <div class="form-group">
            <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_gabencognv').text(),10)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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

  {% if ochenta==1%}
<script>

// Escuchar el evento "change" del select por su clase
$('.fnMostrarSiONoEmpleosOcultosGabencognv').on('change', function() {

  // Obtener el valor seleccionado y convertirlo a un número entero
  const valorSeleccionado = parseInt($(this).val());

  // Obtener el div por su id
  const divEmpleosOcultos = $('#container-empleos-ocultos-gab-gabencognv');


  // Validar si el valor seleccionado es 1 y mostrar el div
  if (valorSeleccionado === 1) {
    divEmpleosOcultos.show('show');

  } else {
    divEmpleosOcultos.hide('show');
  

  }
});
</script>
{% endif %}
