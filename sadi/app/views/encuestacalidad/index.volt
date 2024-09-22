<style>
    .card-data-cliente {
        box-shadow: 0 2px 4px rgba(0,0,0,0.25), 0 3px 1px rgba(0,0,0,0.22);
        margin:0 1rem 3rem 1rem;
        border-radius:15px;
    }
 
</style>
<script>
   __TIP_ID__="{{ enc_data['tip_id'] }}";
</script>
      {% include "/encuestacalidad/servicio2024/script-ajax-guardar-respuestas.volt" %}
      {% include "/encuestacalidad/servicio2024/script-ajax-no-contesto.volt" %}
     <div class=" card card-crm p-3 m-2 pt-5">
          <div class="row col-12 d-flex justify-content-center ">
             <a  class="ancla" id="titulo"></a>
                <h4>
                   ENCUESTA DE EVALUACIÓN DE CALIDAD EN EL SERVICIO DE INVESTIGACIÓN.
                </h4>  
          </div>
          
          <div class="row    card-data-cliente">
             <div class=" col-12 row ">
                <div class="col-12 col-sm-12  ">
                   <h5 id="ese_nombrecompleto_actual "> <span class="text-color-sistema ">Encuestado:</span>{{ enc_data['ese_nombre'] }}</h5>
                </div>
                <input type="hidden"  value=" {{ enc_data['ese_id'] }}"  id="ese_id-encuestacalidadservicio">
                <input type="hidden" value=" {{ enc_data['enc_id'] }}" name="enc_id" id="enc_id-encuestacalidadservicio">
                <div class="col-12 col-sm-6">
                   <h5><span class="text-color-sistema">Teléfono:</span> 
                      <span id="ese_telefono">
                         {{ enc_data['ese_telefono'] }}
                      </span>
                      {% if enc_data['ese_telefono'] is defined and enc_data['ese_telefono']|trim != '' %}
                      <button type="button" class="btn btn-info" style="padding:4px;" title="COPIAR" onclick="fnCopiarPortapapeles('ese_telefono','Teléfono');"><i class="mdi mdi-content-copy mdi-18px btn-icon text-white"></i></button>            
                      {% endif %}
                   </h5>
                </div>
                <div class="col-12 col-sm-6">
                   <h5><span class="text-color-sistema">Celular:</span> <span id="ese_celular">{{ enc_data['ese_celular'] }}</span> 
                      {% if enc_data['ese_celular'] is defined and enc_data['ese_celular']|trim != '' %}
                      <button type="button" class="btn btn-info" style="padding:4px;" title="COPIAR" onclick="fnCopiarPortapapeles('ese_celular','Celular');"><i class="mdi mdi-content-copy mdi-18px btn-icon text-white"></i></button>            
                      {% endif %}
                   </h5>
                </div>
                <div class="col-12 col-sm-6">
                   <h5><span class="text-color-sistema"> Empresa:</span> {{ enc_data['empresa_nombre'] }}</h5>
                </div>
                <div class="col-12 col-sm-6">
                   <h5> <span class="text-color-sistema"> Investigador:</span> {{ enc_data['inv_nombre'] }}</h5>
                </div>
             </div>
           </div>
           <iframe src="{{ encuesta_lime_sourvey_BASE_URL }}" 
           frameborder="0" 
           style="width: 100%; height: 3100px;"
           id="encuesta">
           </iframe>
     </div>  
     <a  
     style="
     padding-top: 9px;
     position: fixed;
     bottom: 50%;
     right: 1%;
     cursor: pointer;
     animation: palpitar 1s ease-in-out infinite;
       " 
       data-toggle="popover" 
       title="Guión para hacer la llamada" 
       data-content='Buenos días / tardes
        Soy {{ nombreadmin }}, te hablo de la empresa SIPS RH, la empresa que te realizó tu estudio socioeconómico por parte de {{  enc_data['empresa_nombre'] }}, el motivo de mi llamada es para realizar una pequeña encuesta de calidad, te haría unas preguntas y te robaría 3 minutos de tu tiempo. ¿Nos podrás apoyar con esta encuesta?
       '
       role="button" 
       class="bg-custom">
     <i class="mdi mdi-comment-question-outline mdi-36px" style="    font-size: 30px;"></i>
    </a>

    <a  
    style="
    padding-top: 9px;
    position: fixed;
    bottom: 50%;
    left: 1%;
    cursor: pointer;
    animation: palpitar 1s ease-in-out infinite;
    display: flex;
    flex-flow: column;
    justify-content: center;
    align-items: center;" 
      onclick="scrollDown(this);"
      role="button" 
      class="bg-custom">
    <i class="mdi mdi-arrow-down-bold " style="    font-size: 10px;"></i>
    <span style="color: white; font-size: 10px;">
      Mover hacia abajo
    </span>
   </a>

   
   <a  
   style="
   padding-top: 9px;
   position: fixed;
   bottom: 40%;
   left: 1%;
   cursor: pointer;
   animation: palpitar 1s ease-in-out infinite;
   display: flex;
   flex-flow: column;
   justify-content: center;
   align-items: center;" 
     onclick="scrollUp(this);"
     role="button" 
     class="bg-custom">
   <i class="mdi mdi-arrow-up-bold " style="    font-size: 10px;"></i>
   <span style="color: white; font-size: 10px;">
     Mover hacia arriba
   </span>
  </a>
    {% include "/encuestacalidad/servicio2024/script-js-sincronizacion.volt" %}