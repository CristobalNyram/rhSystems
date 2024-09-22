{% set cincuentaycuatro= acceso.verificar(48,rol_id) %}
<style>
  #datos-vac-editar-vac-no{
    display: flex;
    justify-content: space-around;
  }
  #datos-vac-editar-vac-no .badge{
    font-size: 1rem;
    padding: 1rem;

  }

  .highlight {
    background: #ff0000cc;
    font-size: 1.2rem;    
    }

</style>
<script>

// Llamada a la función con el límite de opciones, el ID del select y el valor seleccionado  
    let _VAC_ID_EDITAR_VAC_NO=0;
    let _CALLBACK_REOLAD_TABLE__VAC_NO=0;
    function fnEditarVacNoDisponible(vac_id=0,callbak_table=0)
	  {
        $('#vac_estatus-editar_vac_no').parent().hide();
        _VAC_ID_EDITAR_VAC_NO=vac_id;
        _CALLBACK_REOLAD_TABLE__VAC_NO=callbak_table;
        $('#form_editar_vac_no')[0].reset(); // Reinicia el formulario
      //resetSelectValues('#form_editar_vac_general');
        let url="<?php echo $this->url->get('vacante/ajax_get_detalle_vac_numero/') ?>";
        $.ajax({
            type: "POST",
            url: url+_VAC_ID_EDITAR_VAC_NO,
            success: function(res)
            {
              let data=res.data;
              let analiticas=res.analiticas;

              let mensaje=`Actualizar espacios en la vacante No. ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
              let mensaje_vac=`${data.cav_nombre}`;

              $('#editar_vac_no-titulo').html(mensaje);
              $(`#datos-info-vac-editar-vac-no`).html(`<h5 class="text-center">VACANTE: ${mensaje_vac}<h5>`);
              $('#nota-vac-editar-vac-no').html(`Nota: No puedes actualizar el No. De vacantes menor al número de expedientes ya facturados`);
              $('#datos-vac-editar-vac-no').html(`
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
              llenarSelectConOpcionesPorNumeroEditar(30, "#vac_numero-editar_vac_no", data.vac_numero);
              $('#vac_numero-editar_vac_no').attr('onchange', `validarSeleccionVacNo(this, ${analiticas.vac_exc_fat},"#btn-fat-exc" );`);

            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }
  $(document).ready(()=>{
   
		$("#form_editar_vac_no").submit(function(event) 
        {
          event.preventDefault();
          var $form = $(this);

   
          
            var urled="<?php echo $this->url->get('vacante/actualizar_no_vac_disponibles/') ?>";
             $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+_VAC_ID_EDITAR_VAC_NO,
              data: $form.serialize(),
              success: function(res)
              {   

                switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                  
                      if(_CALLBACK_REOLAD_TABLE__VAC_NO!=0){
                        _CALLBACK_REOLAD_TABLE__VAC_NO();
                      }else{
                        window.location.reload();
                      }

                      $('#editar_vac_no-modal').modal('hide');
                      $form.find("button").prop("disabled", false);

                      break;
                   case -1:
                      swalalert('Aviso',res['mensaje'], "warning", 0);
                      $form.find("button").prop("disabled", false);

                      break;
                  
                    case -2:
                    swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                    $form.find("button").prop("disabled", false);
                    break;
                    default:
                    
                      break;
                  }
              
               

                
              },
              error: function(res)
              { 
            
                alert(res.responseText);
              }
            });
          
        });
  });
    

</script>




{{  modal.crear("<span id='editar_vac_no-titulo'><span>", "form_editar_vac_no","editar_vac_no-modal",
[

  {"tamanio":"12","leyenda":"DATOS DE LA VACANTE","tipo":"seccion"},
  {"value":"<div class='col-12 mt-1 mb-1' id='datos-info-vac-editar-vac-no'></div>","tipo":"html"},

  {"value":" <div class='col-12 mt-1 mb-1' id='graficas-vac-editar-vac-no'></div> <div class='col-12 mt-1 mb-1' id='datos-vac-editar-vac-no'></div>  ","tipo":"html"},


  {"tamanio":"12","leyenda":"NO. VACANTES","id":"vac_numero-editar_vac_no","name":"vac_numero","tipo":"select","required":""},
  {"value":"<div class='col-12 mt-1 mb-1' id='nota-vac-editar-vac-no'></div>","tipo":"html"}


]
)
}}

<!-- //{"tamanio":"4","leyenda":"GARANTÍA","id":"vac_garantia-editar_vac_general","name":"vac_garantia","tipo":"text","required":""}, -->
