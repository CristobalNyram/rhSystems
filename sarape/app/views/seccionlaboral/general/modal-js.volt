{% include "/seccionlaboral/general/script-get-set.volt" %}
{# periodo inactivo #}
{% set treintaytres= acceso.verificar(33,rol_id) %}

{# Empleos ocultos #}
{% set treintaycuatro= acceso.verificar(34,rol_id) %}

{# Rerencias lab #}
{% set treintaycinco= acceso.verificar(35,rol_id) %}

{# cambiar estatus inicio #}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{# cambiar estatus fin #}

{# permisos para mostrar lista de registros inicio  #}
{% set ochentaycinco_per_lis= acceso.verificar(85,rol_id) %}
{% set ochentayseis_emc_lis= acceso.verificar(86,rol_id) %}
{% set ochentaysiete_rl_lis= acceso.verificar(87,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}


{# permisos para solicitar una auxiliar inicio #}
{% set ochentayocho= acceso.verificar(88,rol_id) %}
{# permisos para solicitar un  auxiliar fin  #}




<script>
    let _CALLBACK_REOLAD_TABLE_REF=0;
    let _CAMBIAR_ESTATUS =0;
    let __USU_ID_AUXILIAR=0;
    function fnOcultarEpl(value){
          if(value==1){
            $("#container-empleos-ocultos").slideDown("slow");
          }else{
            $("#container-empleos-ocultos").hide("slow");
          }
    }
    function fnCargarSeccionLaboralGeneral(exc_id=0,callback=0,cambiar_estatus=0) {
      _CALLBACK_REOLAD_TABLE_REF=callback;
      _CAMBIAR_ESTATUS=cambiar_estatus;
      __USU_ID_AUXILIAR=0;

      fnGetDetalleSel(exc_id)
                .then(function(res) {  
                
                  let onChangeExc = `fnOcultarEpl(event.currentTarget.value); `;
                  $("#usu_idauxiliar-general").empty();
                   $("#sel_empleosocultos-general").attr("onchange", onChangeExc);
                        fnGetDetalleExc(exc_id)//esta funcion se encuentra en el archivo expedientecan/acciones/get-detalles-uno-js.volt
                          .then(function(res_exc) {
                            let data_exc=res_exc.data;
                            let mensaje=`Sección laboral del expediente folio ${data_exc.exc_id} - ${data_exc.can_nombre} - ${data_exc.cav_nombre} - ${data_exc.emp_nombre} -`+generateBadgeExcEstatusHTML(data_exc.exc_estatus);
                            $("#mensaje-seccion_laboral_general").html(mensaje);

                            })
                            .catch(function(error) {
                                console.error(error);
                                alert(error.responseText);
                            });
        
                      let data=res.data;
                      $('#form_seccionlaboral-general')[0].reset(); // Reinicia el formulario
                    
                      let onclickValuePeriodo = "fnCrearPeriodoInactivo(" + data.sel_id + ")";
                      $("#agregar-periodo_inactividad-general").attr("onclick", onclickValuePeriodo);

                      let onclickValueRef = "fnCrearReferenciaLaboral(" + data.sel_id + ")";
                      $("#agregar-referencialaboral-general").attr("onclick", onclickValueRef);

                      let onclickValueEmple = "fnCrearEmpleoOcultos(" + data.sel_id + ")";
                      $("#agregar-empleooculto-general").attr("onclick", onclickValueEmple);
                      $("#sel_notas-general").val(data.sel_notas);
                      $("#sel_calificacion-general").val(data.sel_calificacion !== null ? data.sel_calificacion : -1).change();
                      $("#sel_necesitoauxiliar-general").val(data.sel_necesitoauxiliar !== null ? data.sel_necesitoauxiliar : -1).change();
                      $("#sel_empleosocultos-general").val(data.sel_empleosocultos !== null ? data.sel_empleosocultos : -1).change();
                      $("#sel_id-general").val(data.sel_id);
                      {% if ochentaysiete_rl_lis==1 %}
                      $("#dato_referencialaboral_listado_mensaje").show();
                      fnCargarTablaDatoReferenciaLaboral(data.sel_id);;//se encuentra en el archiov empleooculto/acciones/tabla-modal
                      {% endif %}
                      {% if ochentayseis_emc_lis==1 %}
                      $("#dato_empleo_oculto_general_mensaje").show();
                      fnCargarTablaDatoEmpleosOcultos(data.sel_id);//se encuentra en el archiov empleooculto/acciones/tabla-modal
                      {% endif %}

                      {% if ochentaycinco_per_lis==1 %}
                      $("#dato_periodoinactivo_mensaje").show();
                      fnCargarTablaDatoPeriodoInactivo(data.sel_id);//se encuentra en el archiov periodoincativo/acciones/tabla-modal
                      {% endif %} 

                  if(data.usu_idauxiliar!=""||data.usu_idauxiliar!=null || data.usu_idauxiliar!="-1"){
                      __USU_ID_AUXILIAR=data.usu_idauxiliar;

                  }

                  {% if ochentayocho==1 %}
                        fnusuariosAuxiliares_adaptable($("#usu_idauxiliar-general"), __USU_ID_AUXILIAR);
                  {% endif %} 

                  


                     

                })  
                .catch(function(error) {
                   alert("Error: " + error.message);      
                });
    }

  $(document).ready(()=>{
    {% if ochentayocho==1 %}
      //escucuchar el evento de cmbio en necesita ayuda
      let selectElementNecesitaAyuda = $("#sel_necesitoauxiliar-general");
      // Agregamos un evento onchange
      selectElementNecesitaAyuda.on("change", function() {
        if ($(this).val() === "1") {
          $("#row_input_auxiliar").slideDown();
          $("#usu_idauxiliar-general").val(__USU_ID_AUXILIAR).change();


        }else{
          $("#row_input_auxiliar").slideUp();
          $("#usu_idauxiliar-general").val("-1").change();

        }
      });
    //
    {% endif %} 
  
   
		$("#form_seccionlaboral-general").submit(function(event) 
    {
        event.preventDefault();
		    let $form = $(this);
            let sel_id =$("#sel_id-general").val();
            console.log(sel_id);
            let url="<?php echo $this->url->get('seccionlaboral/ajax_set_update/') ?>";
            $form.find("button").prop("disabled", true);
             $.ajax({
                type: "POST",
                url: url+sel_id,
                data: $form.serialize(),

                success: function(res)
                {
           
                
                switch (res['estado']) {
                      case 2:
                      swalalert('Éxito',res['mensaje'], "success", 0);
                        if(_CALLBACK_REOLAD_TABLE_REF!=0){
                          _CALLBACK_REOLAD_TABLE_REF();
                        }
                    
                        $("#seccion_laboral_general-modal").modal("hide");
                        $form.find("button").prop("disabled", false);
                        if(_CAMBIAR_ESTATUS!=0){
                        {% if cuarentayocho==1 %}
                          fnCambiarEstatusExc(exc_id=res["exc_id"],exc_estatus=2,_CALLBACK_REOLAD_TABLE_REF);
                          $("#cambiar_estatus_exc_general-modal").modal("show");
                        {% endif %}
                       

                        }
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


<div class="modal fade" id="seccion_laboral_general-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-grande modal-dialog-scrollable" >
      <div class="modal-content">
      <div class="modal-header">
              <h5>
                <div id="mensaje-seccion_laboral_general">
             
                </div>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="">
              <!-- //contenido -->
                {% include "/seccionlaboral/general/form.volt" %}

            </div>

      </div>
    </div>
  </div>
  
