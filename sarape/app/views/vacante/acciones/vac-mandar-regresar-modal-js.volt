<script>

        let _VAC_ID_REGRESAR_VAC_GENERAL=0;
        let _CALLBACK_REOLAD_TABLE_REGRESAR_VAC_GENERAL=0;
        function fnRegresarVacanteGeneral(vac_id=0,callbak_table=0)
          {
            _VAC_ID_REGRESAR_VAC_GENERAL=vac_id;
            _CALLBACK_REOLAD_TABLE_REGRESAR_VAC_GENERAL=callbak_table;
            let url="<?php echo $this->url->get('vacante/ajax_get_detalle/') ?>";
              $.ajax({
                  type: "POST",
                  url: url+_VAC_ID_REGRESAR_VAC_GENERAL,
                  success: function(res)
                  {
                    let data=res.data;
     
                    let analiticas=res.analiticas;
                    let mensaje=` ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
                    $('#regresar_vac_general-titulo').html(mensaje);
                    $('#est_nombre-regresar_vac_general').val(data.est_nombre);
                    $('#mun_nombre-regresar_vac_general').val(data.mun_nombre);
                    $('#cav_nombre-regresar_vac_general').val(data.cav_nombre);
                    $('#emp_nombre-regresar_vac_general').val(data.emp_nombre);
                    $('#tip_nombre-regresar_vac_general').val(data.tip_nombre);
                    $('#tie_nombre-regresar_vac_general').val(data.tie_nombre);
                    $('#vac_id-regresar_vac_general').val(data.vac_id);
                    $('#vac_estatus-regresar_vac_general').val(data.vac_estatus);
                    $('#tie_nombre-regresar_vac_general').val(data.tie_nombre);

                    // Limpiar el select
                    $('#vac_estatus_select-regresar_vac_general').empty();

                    // Agregar las nuevas opciones
                    $('#vac_estatus_select-regresar_vac_general').append(`<option value="-1">Seleccionar</option><option value="2">Proceso</option> <option value="5">Garantía</option>`);
                    $('#vac_estatus_select-regresar_vac_general').val('-1').change();
                  },
                  error: function(data)
                  {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText);               
                  }
                });    
          }
      $(document).ready(()=>{
       
            $("#form_regresar_vac_general").submit(function(event) 
            {
              event.preventDefault();
              let $form = $(this);
              let urled="<?php echo $this->url->get('vacante/regresar_vacante_fin/') ?>";
              $form.find("button").prop("disabled", true);
              $.ajax({
                  type: "POST",
                  url: urled+_VAC_ID_REGRESAR_VAC_GENERAL,
                  data: $form.serialize(),
                  success: function(res)
                  {   
                    console.log(res);
                  
                    switch (res['estado']) {
                        case 2:
                      
                          if(_CALLBACK_REOLAD_TABLE_REGRESAR_VAC_GENERAL!=0){
                            swalalert('Éxito',res['mensaje'], "success", 0);

                            _CALLBACK_REOLAD_TABLE_REGRESAR_VAC_GENERAL();
                          }else{
                            swalalert('Éxito',res['mensaje'], "success", 1);
                          }

                          $('#regresar_vac_general-modal').modal('hide');
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
    
    
    
    
    {{  modal.crear("Regresar la vacante  <span id='regresar_vac_general-titulo'><span>", "form_regresar_vac_general","regresar_vac_general-modal",
    [
    
      {"tamanio":"12","leyenda":"DATOS DE LA VACANTE","tipo":"seccion"},
      {"tamanio":"3","leyenda":"TIPO DE VACANTE","id":"tip_nombre-regresar_vac_general","name":"tip_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"VACANTE","id":"cav_nombre-regresar_vac_general","name":"cav_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"NO. VACANTES","id":"vac_nuumero-regresar_vac_general","name":"vac_numero","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"TIPO DE EMPLEO","id":"tie_nombre-regresar_vac_general","name":"tie_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"ESTADO","id":"est_nombre-regresar_vac_general","name":"est_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"MUNICIPIO","id":"mun_nombre-regresar_vac_general","name":"mun_nombre","tipo":"text","required":"","nombreprimeroption":"Selecciona un estado","complemento":'readonly'},
      {"tamanio":"3","leyenda":"GENERACIÓN DE LA VACANTE POR","id":"gen_id-regresar_vac_general","name":"gen_id","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"12","leyenda":"ESTATUS CAMBIO","tipo":"seccion"},
      {"tamanio":"12","leyenda":"ESTATUS CAMBIO","id":"vac_estatus_select-regresar_vac_general","name":"vac_estatus","tipo":"select","required":""},
      {"value":"<div class='col-12 mt-1 mb-1' id='datos-info-regresar_vac_general'></div>","tipo":"html"},
      {"tamanio":"12","leyenda":"COMENTARIO","tipo":"seccion"},
      {"tamanio":"12","leyenda":" ","id":"cmv_comentario-regresar_vac_general","name":"cmv_comentario","tipo":"textarea","required":"","complemento":'style="min-height:150px"'},
      {"tamanio":"12","leyenda":" ","id":"vac_id-regresar_vac_general","name":"vac_id","tipo":"hidden"},
      {"tamanio":"12","leyenda":" ","id":"vac_estatus-regresar_vac_general","name":"vac_estatus_actual","tipo":"hidden"}
    ]
    )
    }}
    
    