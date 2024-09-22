<script>
    __CALLLBACK_RELOAD_TABLE_RESCHEDULE_CIT=0;
    function fnReprogramarCita(cit_id=0,callback=0){
        
        $('#form_reprogramar_cit_general')[0].reset(); // Reinicia el formulario
        __CALLLBACK_RELOAD_TABLE_RESCHEDULE_CIT=callback;
        
        fnGetDetalleCit(cit_id)
          .then(function(res) {
            try {
              let data=res.data;
              
              $("#cit_id-reprogramar_cit_general").val(cit_id);
              
              let mensaje=` del expediende folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} - `+generateBadgeExcEstatusHTML(data.exc_estatus);
              
              $('#reprogramar_cit_general-titulo').html(mensaje);
              
              fntipocita_adaptable($("#tic_id-reprogramar_cit_general"),data.tic_id);

              $("#cit_fecha-reprogramar_cit_general").val(data.cit_fecha);

              $("#cit_hora-reprogramar_cit_general").val(data.cit_hora);
                            
              } catch (error) {
                // Manejo de la excepción
                swalalertErrorSoporte(error);
                // Realizar acciones adicionales en caso de error
              }
            })
            .catch(function(error) {
                alert(error);
            });
    }
     $(document).ready(()=>{
		  $("#form_reprogramar_cit_general").submit(function(event) 
        {
          event.preventDefault();
		    	let $form = $(this);
          let selectsAValidar = [
            { id: "#tic_id-reprogramar_cit_general", name: "tipo cita" },
          ];

          let valoresPosiblesNoAceptados = ["-1", "-2"];
      	  if (!$form.valid()) {
            return false;
          }
            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
            if (!isValidSelects) {
              return false;
            }

            let cit_id =$("#cit_id-reprogramar_cit_general").val();

            let urled="<?php echo $this->url->get('cita/reprogramar_general/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+cit_id,
              data: $form.serialize(),
              success: function(res)
              { 
              
              switch (res['estado']) {
                case 2:
                swalalert('Éxito',res['mensaje'], "success", 0);
                      
                  if(__CALLLBACK_RELOAD_TABLE_RESCHEDULE_CIT=="0"){
                    fnCargarTablaCitas(res['vac_id'])
                  }else{
                    __CALLLBACK_RELOAD_TABLE_RESCHEDULE_CIT(res['vac_id']);
                  }

                  $("#reprogramar_cit_general-modal").modal("hide");
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


{{  modal.crear("Reprogramar  cita <span id='reprogramar_cit_general-titulo'><span>", "form_reprogramar_cit_general","reprogramar_cit_general-modal",
[
  {"tamanio":"0","leyenda":"","id":"cit_id-reprogramar_cit_general","name":"cit_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  
  {"tamanio":"4","leyenda":"FECHA DE LA CITA","id":"cit_fecha-reprogramar_cit_general","name":"cit_fecha_re","tipo":"date","required":"required","funcion":'onchange=""'},
  {"tamanio":"4","leyenda":"HORA","id":"cit_hora-reprogramar_cit_general","name":"cit_hora_re","tipo":"time","required":"required",'complemento':' list="listahorasdeseadascitas" '},
  {"tamanio":"4","leyenda":"TIPO DE CITA","id":"tic_id-reprogramar_cit_general","name":"tic_id_re","tipo":"select","required":"required"}
],
[{"complementomodal":' tabindex="99"  '}]
)
}}