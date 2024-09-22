
<script>  
      /*
      *Variables globales para actualizar tablas y mandar IDS
      */
    let exc_id_autorizar=0; 
    let callback_autorizar=0; 

    function fnAprobarONo(exc_id=0,callback=0){
        $("#exc_pregunta-cambiar_estatus_exc_general").attr("onchange", "");
        $('#form_cambiar_estatus_exc_general')[0].reset(); // Reinicia el formulario
        $("#exc_estatus-cambiar_estatus_exc_general").empty();
       
        fnGetDetalleExc(exc_id)
                          .then(function(res) {
                            exc_id_autorizar=exc_id;
                            callback_autorizar=callback;

                              try {
                                let data=res.data;
                                let mensaje=` del expediente folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);
                                $("#autorizar_exc_general-titulo").html(mensaje);
                             
                                let opciones = [
                                      { value: -1, text: "Seleccione una opción" },
                                      { value: 0, text: "NO" },
                                      { value: 1, text: "SI" }
                                  ];

                                let selectElement = $("#exc_autorizado-autorizar_exc_general");
                                selectElement.empty();
                                for (let i = 0; i < opciones.length; i++) {
                                    selectElement.append($('<option>', {
                                        value: opciones[i].value,
                                        text: opciones[i].text
                                    }));
                                }

                                $("#exc_autorizado-autorizar_exc_general").select2();
                                $("#exc_autorizado-autorizar_exc_general").val(data.exc_autorizado !== null && data.exc_autorizado !== -1 ? data.exc_autorizado : -1);
                                $('#exc_autorizado-autorizar_exc_general').trigger('change');

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
   
		$("#form_autorizar_exc_general").submit(function(event) 
        {
            event.preventDefault();
		        let $form = $(this);  
            let selectsAValidar = [
			    	{ id: "#exc_autorizado-autorizar_exc_general", name: " ¿Autorizo? " }
            ];
            let valoresPosiblesNoAceptados = ["-1", "-2"];
            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
            if (!isValidSelects) {
              return false;
            }
               
            let urled="<?php echo $this->url->get('expedientecan/autorizar/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+exc_id_autorizar,
              data: $form.serialize(),
              success: function(res)
              { 
              
              switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                    if(callback_autorizar!=0){
                      callback_autorizar();
                    }else{
                        location.reload();  

                    }
                      //fnCargarTablaCitas(res['vac_id'])
                      $("#autorizar_exc_general-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                      $form[0].reset();;

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

{% set check_input = '
<div class="row col-12 card-check">
    <div class="rating-container row">
      
        <div class="rating">
            <label for="super-happy2">
                <input type="radio" name="rating" class="super-happy" id="super-happy2" value="super-happy2" checked />
                <svg viewBox="0 0 24 24"><path d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z" /></svg>
            </label>
            <label for="super-sad2">
                <input type="radio" name="rating" class="super-sad" id="super-sad2" value="super-sad2" />
                <svg viewBox="0 0 24 24"><path d="M19,15H23V3H19M15,3H6C5.17,3 4.46,3.5 4.16,4.22L1.14,11.27C1.05,11.5 1,11.74 1,12V14A2,2 0 0,0 3,16H9.31L8.36,20.57C8.34,20.67 8.33,20.77 8.33,20.88C8.33,21.3 8.5,21.67 8.77,21.94L9.83,23L16.41,16.41C16.78,16.05 17,15.55 17,15V5C17,3.89 16.1,3 15,3Z" /></svg>
            </label>
        </div>
    </div>
</div>
' %}



{{  modal.crear("Autorizar expediente  <span id='autorizar_exc_general-titulo'><span>", "form_autorizar_exc_general","autorizar_exc_general-modal",
[


 {"tamanio":"0","leyenda":"","id":"vac_id-autorizar_exc_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_id-autorizar_exc_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"6","leyenda":"AUTORIZAR","id":"exc_autorizado-autorizar_exc_general","name":"exc_autorizado","tipo":"select","required":""  },

 {"tamanio":"12","leyenda":"OBSERVACIONES","tipo":"seccion"},
 {"tamanio":"12","leyenda":"COMENTARIO","id":"com_comentarioautorizar_exc_general","name":"com[com_comentario]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'}
]
,[{"complementomodal":' tabindex="9"  '}]

)
}}