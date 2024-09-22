<script>
    function mostraListaCambioEstatusDeAcordeEstatus(exc_id=0,continua=0,estatus_en_vista=0){
    let url = "<?php echo $this->url->get('expedientecan/ajax_get_detalle_estatus_cambio/') ?>";
    let select = $("#exc_estatus-cambiar_estatus_exc_general");
    select.empty();
    $.ajax({
      type: "POST",
      url: url + exc_id,
      success: function(res) {
      
        // Agregar la opción "Seleccionar" al select
        select.append($('<option>', {
          value: -1,
          text: 'Seleccionar'
        }));

        let data_opciones=res.opciones.data;
          if(continua=="1"){
             $.each(data_opciones.no, function(key, value) {
              select.append($('<option>', {
                value: value.valor,
                text: value.texto
              }));
            });
          }else if(continua=="2"){
            $.each(data_opciones.si, function(key, value) {
              select.append($('<option>', {
                value: value.valor,
                text: value.texto
              }));
            });

          }else{
              select.empty();
              $("#exc_estatus-cambiar_estatus_exc_general").append($('<option>', {
                                    value: -1,
                                    text: "Seleccione una opción ¿Continúa en el proceso? "
                                  }));
          }
        
      },
      error: function(data) {
      alert(data.responseText); // Rechaza la Promesa con el valor de data
      }
    });
 

    }

    let exc_id_cambiar_estatus=0; 
    let callback_cambiar_estatus=0; 
    let EXC_ESTATUS_ACTUAL_cambiar_estatus_autorizar=0;

    function fnCambiarEstatusExc(exc_id=0,exc_estatus=0,callback=0){
        $("#exc_pregunta-cambiar_estatus_exc_general").attr("onchange", "");
        $('#form_cambiar_estatus_exc_general')[0].reset(); // Reinicia el formulario
        $("#exc_estatus-cambiar_estatus_exc_general").empty();
        EXC_ESTATUS_ACTUAL_cambiar_estatus_autorizar=0;
        fnGetDetalleExc(exc_id)
                          .then(function(res) {
                            exc_id_cambiar_estatus=exc_id;
                            callback_cambiar_estatus=callback;

                              try {
                                let data=res.data;
                        
                                llenarSelectValoracionContinuaSiNo("exc_pregunta-cambiar_estatus_exc_general");
                                let mensaje=` del expediente folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);
                                EXC_ESTATUS_ACTUAL_cambiar_estatus_autorizar=data.exc_estatus;
                                $("#exc_id-cambiar_estatus_exc_general").val(exc_id);
                                $("#vac_id-cambiar_estatus_exc_general").val(data.vac_id);

                                $("#cambiar_estatus_exc_general-titulo").html(mensaje);
                                let onChangeExc = `mostraListaCambioEstatusDeAcordeEstatus( ${exc_id},event.currentTarget.value)`;
                                $("#exc_pregunta-cambiar_estatus_exc_general").attr("onchange", onChangeExc);
                                //$("#exc_estatus-cambiar_estatus_exc_general option:first-child").text(`Seleccione una opción ¿Continúa en el proceso? `);
                                  $("#exc_estatus-cambiar_estatus_exc_general").append($('<option>', {
                                    value: -1,
                                    text: "Seleccione una opción ¿Continúa en el proceso? "
                                  }));
                                $("#exc_estatus-cambiar_estatus_exc_general").select2();
                              } catch (error) {
                                // Manejo de la excepción
                                swalalertErrorSoporte(error);
                                // Realizar acciones adicionales en caso de error
                              }

                          })
                          .catch(function(error) {
                              alert(error.responseText);
                          });
      
    }
     $(document).ready(()=>{
   
		$("#form_cambiar_estatus_exc_general").submit(function(event) 
        {
            event.preventDefault();
		        let $form = $(this);  
            let selectsAValidar = [
			    	{ id: "#exc_pregunta-cambiar_estatus_exc_general", name: " ¿Continúa en el proceso? " },
            { id: "#exc_estatus-cambiar_estatus_exc_general", name: " Proceso " },
          ];

            let valoresPosiblesNoAceptados = ["-1", "-2"];

            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
            if (!isValidSelects) {
              return false;
            }
               
            let urled="<?php echo $this->url->get('expedientecan/cambiar_estatus/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+exc_id_cambiar_estatus,
              data: $form.serialize(),
              success: function(res)
              { 
              
              switch (res['estado']) {
                    case 2:

                       if(res["no_cotinua_mostrar_agradecimiento"]==false  && EXC_ESTATUS_ACTUAL_cambiar_estatus_autorizar=="4"){ 
                      let tempalte_no_cotinua=`
                      ${res['mensaje']}
                      <br>
                      <div class="container">
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <button type="button" class="btn btn-success btn-block" title="Enviar WhatsApp de agradecimiento" onclick="enviarWhatsAppAgradecimiento_General(${res["candidato"].can_id},${res["vac_id"]})">Enviar WhatsApp de agradecimiento</button>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-info btn-block" title="Enviar correo de agradecimiento" onclick="enviarCorreoAgradecimiento_General_PREGUNTA(${res["candidato"].can_id},${res["vac_id"]})">Enviar Correo de agradecimiento</button>
                          </div>
                        </div>
                      </div>
                      `;
                      swalalertHTML('Cambio de estatus',tempalte_no_cotinua, 0);
                    //para validar si continua con el proceso el candidato  fin 

                    }else{
                      swalalert('Éxito',res['mensaje'], "success", 0);
                    }
                    console.log(res);
                    if(callback_cambiar_estatus!=0){
                      callback_cambiar_estatus();
                    }else{
                        location.reload();  

                    }
                      //fnCargarTablaCitas(res['vac_id'])
                      $("#cambiar_estatus_exc_general-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                     
                      break;
                  
                    case -2:
                   swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    break;
                    case -1:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning");
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

{{  modal.crear("Cambiar  estatus  <span id='cambiar_estatus_exc_general-titulo'><span>", "form_cambiar_estatus_exc_general","cambiar_estatus_exc_general-modal",
[
 {"tamanio":"0","leyenda":"","id":"vac_id-cambiar_estatus_exc_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_id-cambiar_estatus_exc_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"6","leyenda":"¿CONTINÚA EN EL PROCESO?","id":"exc_pregunta-cambiar_estatus_exc_general","name":"exc_pregunta","tipo":"select","required":""  },
 {"tamanio":"6","leyenda":"PROCESO","id":"exc_estatus-cambiar_estatus_exc_general","name":"exc_estatus","tipo":"select","required":""  },
 {"tamanio":"12","leyenda":"OBSERVACIONES","tipo":"seccion"},
 {"tamanio":"12","leyenda":"OBSERVACIONES","id":"com_comentario-crear_cit_general","name":"com[com_comentario]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'}
],
,[{"complementomodal":' tabindex="9"  '}]
)
}}