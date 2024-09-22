<script>

        let _VAC_ID_MANDAR_GAR_VAC=0;
        let _CALLBACK_REOLAD_TABLE_MANDAR_GAR_VAC=0;
        function fnMandarGarantiaVac(vac_id=0,callbak_table=0)
          {
            _VAC_ID_MANDAR_GAR_VAC=vac_id;
            _CALLBACK_REOLAD_TABLE_MANDAR_GAR_VAC=callbak_table;
            let url="<?php echo $this->url->get('vacante/ajax_get_detalle/') ?>";
              $.ajax({
                  type: "POST",
                  url: url+_VAC_ID_MANDAR_GAR_VAC,
                  success: function(res)
                  {
                    let data=res.data;
     
                    let analiticas=res.analiticas;
                    let mensaje=` ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
                    $('#mandar_garantia_vac-titulo').html(mensaje);
                    $('#est_nombre-mandar_garantia_vac').val(data.est_nombre);
                    $('#mun_nombre-mandar_garantia_vac').val(data.mun_nombre);
                    $('#cav_nombre-mandar_garantia_vac').val(data.cav_nombre);
                    $('#emp_nombre-mandar_garantia_vac').val(data.emp_nombre);
                    $('#tip_nombre-mandar_garantia_vac').val(data.tip_nombre);
                    $('#tie_nombre-mandar_garantia_vac').val(data.tie_nombre);
                    $('#vac_id-mandar_garantia_vac').val(data.vac_id);
                    $('#vac_estatus-mandar_garantia_vac').val(data.vac_estatus);
                    $('#tie_nombre-mandar_garantia_vac').val(data.tie_nombre);
                  },
                  error: function(data)
                  {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText);               
                  }
                });    
          }
      $(document).ready(()=>{
       
            $("#form_mandar_garantia_vac").submit(function(event) 
            {
              event.preventDefault();
              let $form = $(this);
              let urled="<?php echo $this->url->get('vacante/mandar_garantia/') ?>";
              $form.find("button").prop("disabled", true);
              
              $.ajax({
                  type: "POST",
                  url: urled+_VAC_ID_MANDAR_GAR_VAC,
                  data: $form.serialize(),
                  success: function(res)
                  {   
                  
                    switch (res['estado']) {
                        case 2:
                      
                          if(_CALLBACK_REOLAD_TABLE_MANDAR_GAR_VAC!=0){
                            swalalert('Éxito',res['mensaje'], "success", 0);

                            _CALLBACK_REOLAD_TABLE_MANDAR_GAR_VAC();
                          }else{
                            swalalert('Éxito',res['mensaje'], "success", 1);
                          }

                          $('#mandar_garantia_vac-modal').modal('hide');
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
    
    
    
    
    {{  modal.crear("Mandar a garantía la vacante  <span id='mandar_garantia_vac-titulo'><span>", "form_mandar_garantia_vac","mandar_garantia_vac-modal",
    [
    
      {"tamanio":"12","leyenda":"DATOS DE LA VACANTE","tipo":"seccion"},
      {"tamanio":"3","leyenda":"TIPO DE VACANTE","id":"tip_nombre-mandar_garantia_vac","name":"tip_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"VACANTE","id":"cav_nombre-mandar_garantia_vac","name":"cav_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"NO. VACANTES","id":"vac_nuumero-mandar_garantia_vac","name":"vac_numero","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"TIPO DE EMPLEO","id":"tie_nombre-mandar_garantia_vac","name":"tie_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"ESTADO","id":"est_nombre-mandar_garantia_vac","name":"est_nombre","tipo":"text","required":"","complemento":'readonly'},
      {"tamanio":"3","leyenda":"MUNICIPIO","id":"mun_nombre-mandar_garantia_vac","name":"mun_nombre","tipo":"text","required":"","nombreprimeroption":"Selecciona un estado","complemento":'readonly'},
      {"tamanio":"3","leyenda":"GENERACIÓN DE LA VACANTE POR","id":"gen_id-mandar_garantia_vac","name":"gen_id","tipo":"text","required":"","complemento":'readonly'},
      {"value":"<div class='col-12 mt-1 mb-1' id='datos-info-mandar_garantia_vac'></div>","tipo":"html"},
      {"tamanio":"12","leyenda":"COMENTARIO","tipo":"seccion"},
      {"tamanio":"12","leyenda":" ","id":"cmv_comentario-mandar_garantia_vac","name":"cmv_comentario","tipo":"textarea","required":"","complemento":'style="min-height:150px"'},
      {"tamanio":"12","leyenda":" ","id":"vac_id-mandar_garantia_vac","name":"vac_id","tipo":"hidden"},
      {"tamanio":"12","leyenda":" ","id":"vac_estatus-mandar_garantia_vac","name":"vac_estatus","tipo":"hidden"}
    ]
    )
    }}
    
    