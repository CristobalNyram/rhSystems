<style>
  #datos-info-regresar_facturacion_exc_general{
    display: flex;
    justify-content: space-around;
  }
  #datos-info-regresar_facturacion_exc_general .badge{
    font-size: 1rem;
    padding: 1rem;

  }

  .highlight {
    background: #ff0000cc;
    font-size: 1.2rem;    
    }

</style>

<script>
  
    ///estas  funciones permiten TRABJAR a modo de PROPS entre las funciones de este archivo
    let EXC_ID_regresar_facturacion=0; 
    let CALLLBACK_regresar_facturacion=0; 
    let CALLLBACK_TABLA_VISTA_PRINCIPAL_regresar_facturacion=0; 
    let VAC_ID_regresar_facturacion=0; 

    function fnRegresarFacturacionExc(exc_id=0,vac_id=0,callback=0,callback_principal_vista=0){
        EXC_ID_regresar_facturacion=exc_id;
        VAC_ID_regresar_facturacion=vac_id;
        CALLLBACK_regresar_facturacion=callback;
        CALLLBACK_TABLA_VISTA_PRINCIPAL_regresar_facturacion=callback_principal_vista;

        $('#form_regresar_facturacion_exc_general')[0].reset(); // Reinicia el formulario
        fnGetDetalleExc(exc_id)
                          .then(function(res) {

                              let data=res.data;
                             
                                let mensaje = '';

                                const exc_id = data && data.exc_id ? data.exc_id : '';
                                const can_nombre = data && data.can_nombre ? data.can_nombre : '';
                                const cav_nombre = data && data.cav_nombre ? data.cav_nombre : '';
                                const emp_nombre = data && data.emp_nombre ? data.emp_nombre : '';
                                const exc_estatus = data && data.exc_estatus ? generateBadgeExcEstatusHTML(data.exc_estatus) : '';

                                mensaje = ` folio ${exc_id} - ${can_nombre} - ${cav_nombre} - ${emp_nombre} - ${exc_estatus}`;
                                $("#regresar_facturacion_exc_general-titulo").html(mensaje);
                                $("#exc_id-regresar_facturacion_exc_general").val(exc_id);
                                $("#vac_id-regresar_facturacion_exc_general").val(data.vac_id);

                                
                                

                           

                          })
                          .catch(function(error) {
                              alert(error.responseText);
                          });


              let url="<?php echo $this->url->get('vacante/ajax_get_detalle_vac_numero/') ?>";
              $.ajax({
                  type: "POST",
                  url: url+VAC_ID_regresar_facturacion,
                  success: function(res)
                  {
                    let analiticas=res.analiticas;

                    let data=res.data;
                    let mensaje_vac = data && data.cav_nombre ? data.cav_nombre : '';

                   $(`#datos-title-regresar_facturacion_exc_general`).html(`<h5 class="text-center">VACANTE: ${mensaje_vac}<h5>`);


                  // $('#nota-regresar_facturacion_exc_general').html(`Nota: No puedes maandar mas de un limite permitido de garantía ${data.vac_numero}`);

                    $('#datos-info-regresar_facturacion_exc_general').html(`
                    <span class="badge badge-info text-white">  
                      <i class="mdi mdi-nature-people mdi-18px btn-icon text-white"></i>
                      Disponibles:
                      ${data && data.vac_numero ? data.vac_numero : ''}
                      
                    </span>

                    <span class="badge badge-secondary text-white">  
                      <i class="mdi mdi-stop-circle-outline mdi-18px btn-icon text-white"></i>
                      Registrados:
                      ${analiticas && analiticas.vac_exc_general ? analiticas.vac_exc_general : '0'}

                    </span>
                   

                    <span class="badge badge-warning text-white" id="btn-fat-exc">
                      <i class="mdi mdi-auto-fix mdi-18px btn-icon analiticas text-white"></i>
                      Garantías:
                      ${analiticas && analiticas.vac_exc_gar ? analiticas.vac_exc_gar : '0'}

                    </span>

                    <span class="badge badge-success text-white" >
                        <i class="mdi mdi-cash-multiple mdi-18px btn-icon analiticas text-white"></i>
                        Facturados:
                        ${analiticas && analiticas.vac_exc_fat ? analiticas.vac_exc_fat : '0'}

                    </span>

                    `);
                    let progress_bar=`
                      <div class="progress" title="porcentaje de espacio cubiertos">
                          <div class="progress-bar bg-success" role="progressbar" style="width:  ${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : ''}%;" aria-valuenow="${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : 0}" aria-valuemin="0" aria-valuemax="100">${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : 0}% Facturados</div>
                          <div class="progress-bar bg-info" role="progressbar" style="width: ${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}%;" aria-valuenow="${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}" aria-valuemin="0" aria-valuemax="100">${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}% Por Falturar</div>
                      </div>

                      <div hidden class="progress mt-2" title="porcentaje de espacio cubiertos">
                          <div class="progress-bar bg-success" role="progressbar" style="width:${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : 0}%;" aria-valuenow="${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : 0}" aria-valuemin="0" aria-valuemax="100">${analiticas && analiticas.porcentaje_progreso ? analiticas.porcentaje_progreso : 0}% Facturados</div>
                          <div class="progress-bar bg-info" role="progressbar" style="width: ${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}%;" aria-valuenow="${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}" aria-valuemin="0" aria-valuemax="100">${analiticas && analiticas.porcentaje_progreso_faltante ? analiticas.porcentaje_progreso_faltante : 0}% Por Falturar</div>
                      </div>

                      <div class="progress mt-2" title="porcentaje de garantía permitidas utilizadas">
                          <div title="porcentaje de garantía permitidas utilizadas" class="progress-bar bg-warning" role="progressbar" style="width: ${analiticas && analiticas.porcentaje_garantia_permitidas ? analiticas.porcentaje_garantia_permitidas : 0}%;" aria-valuenow="${analiticas && analiticas.porcentaje_garantia_permitidas ? analiticas.porcentaje_garantia_permitidas : 0}" aria-valuemin="0" aria-valuemax="100">${analiticas && analiticas.porcentaje_garantia_permitidas ? analiticas.porcentaje_garantia_permitidas : 0}%</div>
                      </div>
                  `;


                    $("#progressbar-regresar_facturacion_exc_general").html(progress_bar);
              

                  },
                  error: function(data)
                  {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText);   
                  }
                });
        
       

    }
     $(document).ready(()=>{
   
		$("#form_regresar_facturacion_exc_general").submit(function(event) 
    {
            event.preventDefault();
		        let $form = $(this);  
            let urled="<?php echo $this->url->get('expedientecan/regresar_facturacion/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+EXC_ID_regresar_facturacion,
              data: $form.serialize(),
              success: function(res)
              { 
                switch (res['estado']) {
                      case 2:
                      swalalert('Éxito',res['mensaje'], "success", 0);
                        if(CALLLBACK_regresar_facturacion=="0"){
                          location.reload();  
                        }else{
                            CALLLBACK_regresar_facturacion(res["vac_id"]);
                            if(CALLLBACK_TABLA_VISTA_PRINCIPAL_regresar_facturacion!="0"){                             
                                if( res['estatus_callback_tabla_principal']=="2"){
                                  CALLLBACK_TABLA_VISTA_PRINCIPAL_regresar_facturacion();
                                }
                            } 
                        }
                        //fnCargarTablaCitas(res['vac_id'])
                        $("#regresar_facturacion_exc_general-modal").modal("hide");
                        $form.find("button").prop("disabled", false);
                        $form[0].reset();

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





{{  modal.crear("Regresar facturación  <span id='regresar_facturacion_exc_general-titulo'><span>", "form_regresar_facturacion_exc_general","regresar_facturacion_exc_general-modal",
[
{"value":"<div class='col-12 mt-1 mb-1' id='datos-title-regresar_facturacion_exc_general'></div>","tipo":"html"},
{"value":"<div class='col-12 mt-1 mb-1' id='progressbar-regresar_facturacion_exc_general'></div>","tipo":"html"},
{"value":"<div class='col-12 mt-1 mb-1' id='datos-info-regresar_facturacion_exc_general'></div>","tipo":"html"},
 {"tamanio":"0","leyenda":"","id":"vac_id-regresar_facturacion_exc_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_id-regresar_facturacion_exc_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"12","leyenda":"MOTIVO","id":"fat_comentario-regresar_facturacion_exc_general","name":"fat_comentario","tipo":"textarea","required":"","complemento":'style="min-height:100px"'},
 {"value":"<div class='col-12 mt-1 mb-1' id='nota-regresar_facturacion_exc_general'></div>","tipo":"html"}
 ],
[{"complementomodal":' tabindex="99999" style="z-index:9999;" '}]
)
}}