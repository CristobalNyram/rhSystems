{% set cincuentaycuatro= acceso.verificar(48,rol_id) %}
<style>
  #datos_vac-estadisticas_vac_info{
    display: flex;
    justify-content: space-around;
  }
  #datos_vac-estadisticas_vac_info .badge{
    font-size: 1rem;
    padding: 1rem;
  }
  .datos-container-estadisticas{
    display: flex;
    justify-content: space-around;
    flex-flow: inherit;

  }
 .datos-container-estadisticas .badge {
    font-size: 1rem;
    padding: 1rem;
    margin: 0.5rem;
    overflow: hidden;
    white-space: nowrap;
    width: 44%;
}

  @media only screen and (max-width: 480px) {
   .datos-container-estadisticas .badge {
   
    width:100%;
    }
  }

  .highlight {
    background: #ff0000cc;
    font-size: 1.2rem;    
    }
    

</style>

<script>
  function validarSeleccionVacNo(selectId, limite,badgeId ) {
      var selectedValue = parseInt($(selectId).val());

      if (selectedValue < limite) {
          swalalert('Aviso','El valor no puede ser menor que ' + limite, "warning", 0);

          $(selectId).val(limite);
          
          $(selectId).trigger("change");
          var $boton = $(badgeId);
         $boton.addClass('highlight'); // Agrega la clase para resaltar

          $boton.animate({ 'font-size': '+=5px' }, 1000)
                      .animate({ 'font-size': '-=5px' }, 100)
                      .animate({ 'font-size': '+=5px' }, 100)
                      .animate({ 'font-size': '-=5px' }, 100)
                      .animate({ 'font-size': '+=5px' }, 100)
                      .animate({ 'font-size': '-=5px' }, 100)
                      .animate({ 'font-size': '+=5px' }, 100)
                      .animate({ 'font-size': '-=5px' }, 100, function() {
                          $boton.removeClass('highlight'); // Quita la clase después de la animación
                      });
        
        }
  }

 
</script>


<script>


// Llamada a la función con el límite de opciones, el ID del select y el valor seleccionado  
    let _VAC_ID__ESTADISTICAS_VAC=0;
    let _CALLBACK_REOLAD_ESTADISTICAS_VAC=0;
    window.callback_estadisticas_vac=0;
    window.vac_id=0;
    function fnEstadisticasVacante(vac_id=0,callbak_table=0)
	  {
        // Obtén una referencia al formulario
          let form = document.getElementById('form_estadisticas_vac_info');
          let submitButton = form.querySelector('button[type="submit"]');
          let otroButton = form.querySelector('a[data-dismiss="modal"]');
          submitButton.style.display = 'none';
          otroButton.style.display = 'none';

        $('#vac_estatus-editar_vac_no').parent().hide();
        _VAC_ID__ESTADISTICAS_VAC=vac_id;
        _CALLBACK_REOLAD_ESTADISTICAS_VAC=callbak_table;
        window.callback_estadisticas_vac=callbak_table;
        window.vac_id=vac_id;

        $('#form_estadisticas_vac_info')[0].reset(); // Reinicia el formulario
     

        let url="<?php echo $this->url->get('vacante/ajax_get_detalle_vac_numero/') ?>";
        $.ajax({
            type: "POST",
            url: url+_VAC_ID__ESTADISTICAS_VAC,
            success: function(res)
            {
              let data=res.data;
              let analiticas=res.analiticas;
              let analiticas_canceladas=res.analiticas.vac_exc_cancelados.data;
              let mensaje=`Estadísticas en la vacante No. ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
              let mensaje_vac=`${data.cav_nombre}`;
              $('#estadisticas_vac_info-titulo').html(mensaje);
              $(`#datos-info-estadisticas_vac_info`).html(`<h5 class="text-center">VACANTE: ${mensaje_vac}<h5>`);
              $('#datos_vac-estadisticas_vac_info').html(`
                  <span class="badge badge-info text-white">  
                          <i class="mdi mdi-nature-people mdi-18px btn-icon text-white"></i>
                          Disponibles:
                          ${data.vac_numero}
                          
                  </span>
                  <span class="badge badge-secondary text-white">  
                    <i class="mdi mdi-stop-circle-outline mdi-18px btn-icon text-white"></i>
                    Registrados:
                    ${analiticas.vac_exc_general}
                    
                  </span>
                  <span class="badge badge-success text-white" id="btn-fat-exc">
                    <i class="mdi mdi-cash-multiple mdi-18px btn-icon analiticas text-white"></i>
                    Facturados:
                    ${analiticas.vac_exc_fat}

                  </span>

                  <span class="badge badge-warning text-white">
                    <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                    Garantías:
                    ${analiticas.vac_exc_gar}

                  </span>

              `);
              $("#datos_vac_text-estadisticas_vac_info").html(`
                <h5>Expedientes cancelados</h5>
              `);

              $("#datos_vac_canceladas-estadisticas_vac_info").html(`
                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CONTESTÓ (CITAS):
                      <br>
                      ${analiticas_canceladas.exc_estatus_11}

                  </span>

                

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO LE INTERESÓ (CITAS):
                      <br>
                      ${analiticas_canceladas.exc_estatus_12}

                  </span>

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CUMPLIO EL PERFIL (CITAS):
                      <br>
                      ${analiticas_canceladas.exc_estatus_13}

                  </span>

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO SE PRESENTÓ (CITAS):
                      <br>
                      ${analiticas_canceladas.exc_estatus_14}

                  </span>
                  
                 

              `);

               $("#datos_vac_canceladas_2-estadisticas_vac_info").html(`
                <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CUMPLIO (REFERENCIAS):
                      <br>
                      ${analiticas_canceladas.exc_estatus_21}

                  </span>
                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CUMPLIO (PSICOMETRÍA):
                      <br>
                      ${analiticas_canceladas.exc_estatus_31}

                  </span>

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CUMPLIO PERFIL (ENTREVISTA):
                      <br>
                      ${analiticas_canceladas.exc_estatus_41}

                  </span>

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO SE PRESENTÓ (ENTREVISTA):
                      <br>
                      ${analiticas_canceladas.exc_estatus_42}

                  </span>

              `);

                $("#datos_vac_canceladas_3-estadisticas_vac_info").html(`
                

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO LE INTERESÓ AL CANDIDATO (ENTREVISTA):
                      <br>
                      ${analiticas_canceladas.exc_estatus_43}

                  </span>

                  <span class="badge badge-cancelar-custom text-white">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      NO CUMPLIO (AUTORIZACIÓN):
                      <br>
                      ${analiticas_canceladas.exc_estatus_51}

                  </span>

              `);

              let progress_bar=`
                      <div class="progress" title="porcentaje de espacio cubiertos">
                        <div class="progress-bar bg-success" role="progressbar" style="width:${analiticas.porcentaje_progreso}%;" aria-valuenow="${analiticas.porcentaje_progreso}" aria-valuemin="0" aria-valuemax="100">${analiticas.porcentaje_progreso}% Facturados</div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: ${analiticas.porcentaje_progreso_faltante}%;" aria-valuenow="${analiticas.porcentaje_progreso_faltante}" aria-valuemin="0" aria-valuemax="100">${analiticas.porcentaje_progreso_faltante}% Por Facturar</div>
                      </div>

                      <div hidden class="progress mt-2" title="porcentaje de garantía permitidas utilizadas">
                        <div class="progress-bar bg-success" role="progressbar" style="width:${analiticas.porcentaje_progreso}%;" aria-valuenow="${analiticas.porcentaje_progreso}" aria-valuemin="0" aria-valuemax="100">${analiticas.porcentaje_progreso}% Facturados</div>
                        <div class="progress-bar bg-info" role="progressbar" style="width: ${analiticas.porcentaje_progreso_faltante}%;" aria-valuenow="${analiticas.porcentaje_progreso_faltante}" aria-valuemin="0" aria-valuemax="100">${analiticas.porcentaje_progreso_faltante}% Por Falturar</div>
                      </div>


                      <div  class="progress mt-2" title="porcentaje de garantía permitidas utilizadas">
                              <div  title="porcentaje de garantía permitidas utilizadas" class="progress-bar bg-warning" role="progressbar" style="width: ${analiticas.porcentaje_garantia_permitidas}%;" aria-valuenow="${analiticas.porcentaje_garantia_permitidas}" aria-valuemin="0" aria-valuemax="100">${analiticas.porcentaje_garantia_permitidas}%</div>
                      </div>
                    `;

              $('#graficas-vac-editar-vac-no').html(progress_bar);
      
          

            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }

   
$(document).ready(function() {
    let modal_estadisticas = $('#estadisticas_vac_info-modal');

    // Agrega un oyente para el evento hidden.bs.modal
    modal_estadisticas.on('hidden.bs.modal', function() {
      if(window.callback_estadisticas_vac!=0 &&  window.vac_id!=0){
        window.callback_estadisticas_vac(window.vac_id);
      }
     
    });
});
    

</script>




{{  modal.crear("<span id='estadisticas_vac_info-titulo'><span>", "form_estadisticas_vac_info","estadisticas_vac_info-modal",
[
  {"value":"<div class='col-12 mt-1 mb-1' id='datos-info-estadisticas_vac_info'></div>","tipo":"html"},
  {"value":" <div class='col-12 mt-1 mb-1 d-flex justify-content-space-around' id='graficas-estadisticas_vac_info'></div> <div
   class='col-12 mt-1 mb-1' id='datos_vac-estadisticas_vac_info'></div>  ","tipo":"html"},
  {"value":" <div class='col-12 mt-1 mb-1 d-flex justify-content-center' id='datos_vac_text-estadisticas_vac_info'></div> <div class='col-12 mt-1 mb-1 datos-container-estadisticas'  id='datos_vac_canceladas-estadisticas_vac_info'></div>  ","tipo":"html"},
  {"value":" <div class='col-12 mt-1 mb-1 d-flex justify-content-center' id='datos_vac_text-estadisticas_vac_info'></div> <div class='col-12 mt-1 mb-1 datos-container-estadisticas'  id='datos_vac_canceladas_2-estadisticas_vac_info'></div>  ","tipo":"html"},
  {"value":" <div class='col-12 mt-1 mb-1 d-flex justify-content-center' id='datos_vac_text-estadisticas_vac_info'></div> <div class='col-12 mt-1 mb-1 datos-container-estadisticas'  id='datos_vac_canceladas_3-estadisticas_vac_info'></div>  ","tipo":"html"},

  {"value":"<hr/>","tipo":"html"}

]
)
}}

<!-- //{"tamanio":"4","leyenda":"GARANTÍA","id":"vac_garantia-editar_vac_general","name":"vac_garantia","tipo":"text","required":""}, -->
