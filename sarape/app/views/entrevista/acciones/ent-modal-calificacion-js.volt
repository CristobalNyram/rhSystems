{% set cuarentayocho= acceso.verificar(48,rol_id) %}

<script>
    let CALLBACK_RELOAD_ENT_EDIT=0;
    let EXC_ESTATUS_ENT=0;
    function mostraListaCambioEstatusEntrevista(exc_id=0,continua=0,estatus_en_vista=0){
    let url = "<?php echo $this->url->get('expedientecan/ajax_get_detalle_estatus_cambio/') ?>";
    let select = $("#exc_estatus-editar_ent_general");
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
              $("#exc_estatus-editar_ent_general").append($('<option>', {
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
    function fnOcultarSeleccionado(value){
          if(value=="2"){
            $(".row-continua-proceso").slideDown("slow");
          }else{
            $(".row-continua-proceso").slideUp("slow");
          }
    }
    function fnEditarEnt(exc_id=0,callback=0){
        $('#form_editar_ent_general')[0].reset(); // Reinicia el formulario
        fnGetDetalleEnt(exc_id)
                          .then(function(res) {
                            try {
                              EXC_ESTATUS_ENT=0;
                              CALLBACK_RELOAD_ENT_EDIT=callback;

                              let data=res.data;
                              let mensaje=` de la vacante ${data.cav_nombre} - candidato  ${data.can_nombre}`;
                              $("#editar_ent_general-titulo").html(mensaje);
                              $("#ent_hora-editar_ent_general").val(data.ent_hora);
                              $("#ent_fecha-editar_ent_general").val(data.ent_fecha);
                              $("#ent_sueldo-editar_ent_general").val(data.ent_sueldo);
                              $("#ent_observacion-editar_ent_general").val(data.ent_observacion);
                              $("#exc_id-editar_ent_general").val(data.exc_id);
                              EXC_ESTATUS_ENT=data.exc_estatus;

                            
                          } catch (error) {
                            // Manejo de la excepción
                            swalalertErrorSoporte(error);
                            console.error(error);

                            // Realizar acciones adicionales en caso de error
                          }



                          })
                          .catch(function(error) {
                              alert(error.responseText);
                          });
        
       

    }
     $(document).ready(()=>{
   
		$("#form_editar_ent_general").submit(function(event) 
        {
            event.preventDefault();
		    	  let $form = $(this);

          
            if (!$form.valid()) {
              return false;
            }
            
        
            let can_id =$("#can_id-editar_ent_general").val();
            let exc_id =$("#exc_id-editar_ent_general").val();
            let vac_id =$("#vac_id-editar_ent_general").val();

          
            let urled="<?php echo $this->url->get('entrevista/actualizar_general/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+exc_id,
              data: $form.serialize(),
              success: function(res)
              { 
              
              switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                        if(CALLBACK_RELOAD_ENT_EDIT!=0){

                              CALLBACK_RELOAD_ENT_EDIT();
                              {% if cuarentayocho==1 %}
                              fnCambiarEstatusExc(exc_id,EXC_ESTATUS_ENT,CALLBACK_RELOAD_ENT_EDIT);
                              $("#cambiar_estatus_exc_general-modal").modal("show");
                              {% endif %}



                        }else{
                              location.reload();
                        }
                      $("#editar_ent_general-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                      break;
                  
                    case -2:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    console.error(res);							
                    break;
                    case -1:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning");
                    $form.find("button").prop("disabled", false);
                    console.warn(res);							
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




{{  modal.crear("Entrevista <span id='editar_ent_general-titulo'><span>", "form_editar_ent_general","editar_ent_general-modal",
[
 {"tamanio":"0","leyenda":"","id":"vac_id-editar_ent_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_id-editar_ent_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"can_id-editar_ent_general","name":"can_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},

 {"tamanio":"6","leyenda":"FECHA DE ENTREVISTA","id":"ent_fecha-editar_ent_general","name":"ent[ent_fecha]","tipo":"date","required":"required","funcion":'onchange=""'},
 {"tamanio":"6","leyenda":"HORA DE ENTREVISTA","id":"ent_hora-editar_ent_general","name":"ent[ent_hora]","tipo":"time","required":"required",'complemento':' list="listahorasdeseadascitas" '},
 {"tamanio":"12","leyenda":"OBSERVACIONES","id":"ent_observacion-editar_ent_general","name":"ent[ent_observacion]","tipo":"textarea","":"required","complemento":'style="min-height:100px"'},

 {"tamanio":"12","leyenda":"OBSERVACIONES","tipo":"seccion"},
 {"tamanio":"12","leyenda":"OBSERVACIONES","id":"com_comentario-editar_ent_general","name":"com[com_comentario]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'}

]
)
}}