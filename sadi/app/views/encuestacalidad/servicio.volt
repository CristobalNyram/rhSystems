

<style>
.card-data-cliente {
    box-shadow: 0 2px 4px rgba(0,0,0,0.25), 0 3px 1px rgba(0,0,0,0.22);
    margin:0 1rem 3rem 1rem;
    border-radius:15px;
}


</style><!-- <iframe src="<?php echo $this->url->get('encuestacalidad/servicio_content_modal/') ?>" 
     style="   
    width: 100%;
    height: 100%;
    border: none !important;
    margin: 0px !important;

    " ></iframe> -->


    {% include "/encuestacalidad/servicio/script-ajax-get-opciones.volt" %}
    {% include "/encuestacalidad/servicio/script-ajax-get-preguntas.volt" %}
    {% include "/encuestacalidad/servicio/script-ajax-guardar-respuestas.volt" %}
    {% include "/encuestacalidad/servicio/script-ajax-no-contesto.volt" %}


 <div class=" card card-crm p-3 m-2">

      <div class="row col-12 d-flex justify-content-center ">

         <a  class="ancla" id="titulo"></a>
     
            <h4 >

               ENCUESTA DE EVALUACIÓN DE CALIDAD EN EL SERVICIO DE INVESTIGACIÓN.

            </h4>
      
            
      </div>

      <div class="row    card-data-cliente">
         <div class=" col-12 row ">
            <div class="col-12 col-sm-12  ">
               <h5 id="ese_nombrecompleto_actual "> <span class="text-color-sistema ">Encuestado:</span>{{ enc_data['ese_nombre'] }}</h5>
   
            </div>
   
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



    {% include "/encuestacalidad/servicio_formulario.volt" %}

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
   
   data-toggle="popover" title="Guión para hacer la llamada" data-content='
   Buenos días / tardes
      Soy {{ nombreadmin }}, te hablo de la empresa SIPS RH, la empresa que te realizó tu estudio socioeconómico por parte de {{  enc_data['empresa_nombre'] }}, el motivo de mi llamada es para realizar una pequeña encuesta de calidad, te haría unas preguntas y te robaría 3 minutos de tu tiempo. ¿Nos podrás apoyar con esta encuesta?
   '
   role="button" class="bg-custom">
 <i class="mdi mdi-comment-question-outline mdi-36px" style="    font-size: 30px;"></i>
</a>

 <script>
$(document).ready(function(){
   $('#ese_id-encuestacalidadservicio').val(" {{ enc_data['ese_id'] }}");
   $('#enc_id-encuestacalidadservicio').val(" {{ enc_data['enc_id'] }}");

   $(".ancla").click(function(evento){
      const element = document.getElementById("ese_nombrecompleto_actual");
      element.scrollIntoView();
    });


   fnGetOpcionesRespuestaServicioCalidad(
      $('#preg_1_opciones-encuestacalidadservicio'),
      $('#preg_2_opciones-encuestacalidadservicio'),
      $('#preg_3_opciones-encuestacalidadservicio'),
      $('#preg_4_opciones-encuestacalidadservicio'),
      $('#preg_5_opciones-encuestacalidadservicio'),
      $('#preg_6_opciones-encuestacalidadservicio'),
      $('#preg_7_opciones-encuestacalidadservicio'),
      $('#preg_8_opciones-encuestacalidadservicio'),
      $('#preg_9_opciones-encuestacalidadservicio'),
      $('#preg_10_opciones-encuestacalidadservicio'),
      $('#preg_11_opciones-encuestacalidadservicio'),
      $('#preg_12_opciones-encuestacalidadservicio'),
      $('#preg_13_opciones-encuestacalidadservicio'),
      $('#preg_14_opciones-encuestacalidadservicio'),
      $('#preg_15_opciones-encuestacalidadservicio'),
      $('#preg_16_opciones-encuestacalidadservicio'),
      $('#preg_17_opciones-encuestacalidadservicio'),
      $('#preg_18_opciones-encuestacalidadservicio'),

      );

   let obj_labels=[
      {
         'label_id':'label_preg_1-encuestacalidadservicio',
      },
      {
         'label_id':'label_preg_2-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_3-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_4-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_5-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_6-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_7-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_7-1-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_8-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_8-1-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_9-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_10-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_11-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_12-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_12-1-encuestacalidadservicio',

      },
      {
         
         'label_id':'label_preg_13-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_14-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_15-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_15-1-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_16-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_16-1-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_17-encuestacalidadservicio',

      },
      {
         'label_id':'label_preg_18-encuestacalidadservicio',

      },
   ];

   fnGetTextoPreguntasServicioCalidad(obj_labels)

});

 </script>
