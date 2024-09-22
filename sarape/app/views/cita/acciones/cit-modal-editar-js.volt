<script>


    __CALLLBACK_RELOAD_TABLE_EDIT_CIT=0;
    function fnEditarCita(cit_id=0,callback=0){
        $('#form_editar_cit_general')[0].reset(); // Reinicia el formulario
        __CALLLBACK_RELOAD_TABLE_EDIT_CIT=callback;
        fnGetDetalleCit(cit_id)
                          .then(function(res) {
                            try {
                              let data=res.data;
                              $("#vac_id-editar_cit_general").val(data.vac_id);
                              $("#cit_id-editar_cit_general").val(cit_id);
                              $("#exc_id-editar_cit_general").val(data.exc_id);
                              let mensaje=` del expediende folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} - `+generateBadgeExcEstatusHTML(data.exc_estatus);
                              $('#editar_cit_general-titulo').html(mensaje);
                              fntipocita_adaptable($("#tic_id-editar_cit_general"),data.tic_id);
                              fnmedio_adaptable($("#med_id-editar_cit_general"),data.med_id);
                              $("#can_nombre-editar_cit_general").val(data.can_nombre);
                              $("#can_id-editar_cit_general").val(data.can_id);
                              $("#can_nosegsocial-editar_cit_general").val(data.can_nosegsocial);
                              $("#can_primerapellido-editar_cit_general").val(data.can_primerapellido);
                              $("#can_segundoapellido-editar_cit_general").val(data.can_segundoapellido);
                              $("#can_telefono-editar_cit_general").val(data.can_telefono);
                              $("#can_celular-editar_cit_general").val(data.can_celular);
                              $("#can_correo_editar_cit_general").val(data.can_correo);
                              $("#can_curp_edit").val(data.can_curp);
                              $("#cit_observaciones-editar_cit_general").val(data.cit_observaciones);
                              $("#cit_fecha-editar_cit_general").val(data.cit_fecha);
                              $("#cit_hora-editar_cit_general").val(data.cit_hora);
                              llenarSelectValoracionCita("cit_puestosimilar-editar_cit_general",data.cit_puestosimilar);
                              llenarSelectValoracionCita("cit_estabilidalaboral-editar_cit_general",data.cit_estabilidalaboral);
                              llenarSelectValoracionCita("cit_responsabilidad-editar_cit_general",data.cit_responsabilidad);
                              llenarSelectValoracionCita("cit_concimientostec-editar_cit_general",data.cit_concimientostec);
                              llenarSelectValoracionCita("cit_acordeasueldoofrecido-editar_cit_general",data.cit_acordeasueldoofrecido);
                              llenarSelectValoracionCita("cit_presentacionapariencia-editar_cit_general",data.cit_presentacionapariencia);
                              llenarSelectValoracionCita("cit_disponibilidad-editar_cit_general",data.cit_disponibilidad);
                              llenarSelectValoracionCita("cit_proactivo-editar_cit_general",data.cit_proactivo);
                              llenarSelectValoracionCita("cit_puntualidad-editar_cit_general",data.cit_puntualidad);
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
      $("#form_editar_cit_general").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
          can_curp_edit : {required: false, pattern:/^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/},
          can_correo_editar_cit_general: {
              required: false,
              pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
          }
          },
        messages: {
           can_curp_edit:{
             pattern: "El CURP no cumple con la estructura."
           },
           can_correo_editar_cit_general:{
             pattern: "El Correo no cumple con la estructura."
           }
        },
        submitHandler: function(form){
      
          return true;
        }
      });


		$("#form_editar_cit_general").submit(function(event) 
        {
            event.preventDefault();
		    	  let $form = $(this);

         
            let selectsAValidar = [
              { id: "#tic_id-editar_cit_general", name: "tipo cita" },
              { id: "#med_id-editar_cit_general", name: " medio en el que llego " },
            ];

          let valoresPosiblesNoAceptados = ["-1", "-2"];
      	  if (!$form.valid()) {
            return false;
          }
            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
            if (!isValidSelects) {
              return false;
            }
          

            let cit_id =$("#cit_id-editar_cit_general").val();
            let can_id =$("#can_id-editar_cit_general").val();
            let exc_id =$("#exc_id-editar_cit_general").val();
            let vac_id =$("#vac_id-editar_cit_general").val();

          
            let urled="<?php echo $this->url->get('cita/editar_general/') ?>";
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
                      
                      if(__CALLLBACK_RELOAD_TABLE_EDIT_CIT=="0"){
                        fnCargarTablaCitas(res['vac_id'])
                      }else{
                        __CALLLBACK_RELOAD_TABLE_EDIT_CIT(res['vac_id']);
                      }

                      $("#editar_cit_general-modal").modal("hide");
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




{{  modal.crear("Editar  cita <span id='editar_cit_general-titulo'><span>", "form_editar_cit_general","editar_cit_general-modal",
[


  {"tamanio":"0","leyenda":"","id":"vac_id-editar_cit_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"0","leyenda":"","id":"cit_id-editar_cit_general","name":"cit_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"0","leyenda":"","id":"exc_id-editar_cit_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"0","leyenda":"","id":"can_id-editar_cit_general","name":"can_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},

  {"tamanio":"4","leyenda":"FECHA DE LA CITA","id":"cit_fecha-editar_cit_general","name":"cit[cit_fecha]","tipo":"date","required":"required","funcion":'onchange=""'},
  {"tamanio":"4","leyenda":"HORA","id":"cit_hora-editar_cit_general","name":"cit[cit_hora]","tipo":"time","required":"required",'complemento':' list="listahorasdeseadascitas" '},
  {"tamanio":"4","leyenda":"TIPO DE CITA","id":"tic_id-editar_cit_general","name":"cit[tic_id]","tipo":"select","required":"required"},
  {"tamanio":"12","leyenda":"DATOS CANDIDATO","tipo":"seccion"},
  {"tamanio":"4","leyenda":"NOMBRE(S)","id":"can_nombre-editar_cit_general","name":"can[can_nombre]","tipo":"text","required":"required","complemento":'minlength="2" maxlength="155"'},
  {"tamanio":"4","leyenda":"APELLIDO PATERNO","id":"can_primerapellido-editar_cit_general","name":"can[can_primerapellido]","tipo":"text","required":"required","complemento":'minlength="2" maxlength="155" '},
  {"tamanio":"4","leyenda":"APELLIDO MATERNO","id":"can_segundoapellido-editar_cit_general","name":"can[can_segundoapellido]","tipo":"text","required":"","complemento":'maxlength="155"'},
  {"tamanio":"6","leyenda":"TELÉFONO ","id":"can_telefono-editar_cit_general","name":"can[can_telefono]","tipo":"text","required":"","complemento":' maxlength="25"'},
  {"tamanio":"6","leyenda":"TELÉFONO CELULAR ","id":"can_celular-editar_cit_general","name":"can[can_celular]","tipo":"text","required":"","complemento":' maxlength="25"'},
  {"tamanio":"6","leyenda":"CORREO ELECTRÓNICO","id":"can_correo_editar_cit_general","name":"can[can_correo]","tipo":"text","required":"","complemento":' maxlength="155"',"funcion":'onblur="validarCorreoInput(event);"'},
  {"tamanio":"6","leyenda":"CURP","placeholder":"CURP","clase":"validar-curp-edit","id":"can_curp_edit","name":"can_curp_edit","tipo":"text","required":"","complemento":' maxlength="18" pattern="/^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/"',"funcion":"oninput='handleInput(event);quitar_validarEspacios(event);'" },
  {"tamanio":"6","leyenda":"NÚMERO DE SEGURO SOCIAL","placeholder":"NÚMERO DE SEGURO SOCIAL","clase":"","id":"can_nosegsocial-editar_cit_general","name":"can[can_nosegsocial]","tipo":"text","required":"","complemento":'step="1" min="10000000"   maxlength="15 inputmode="numeric"' },
  {"tamanio":"12","leyenda":"EXTRA","tipo":"seccion"},
  {"tamanio":"2","leyenda":"¿POR QUÉ MEDIO LLEGÓ?","id":"med_id-editar_cit_general","name":"cit[med_id]","tipo":"select","required":""},
  {"tamanio":"12","leyenda":"OBSERVACIONES","tipo":"seccion"},
  {"tamanio":"12","leyenda":"OBSERVACIONES","id":"cit_observaciones-editar_cit_general","name":"cit[cit_observaciones]","tipo":"textarea","required":"required","complemento":'style="min-height:100px"'},
  {"tamanio":"12","leyenda":"VALORACIÓN - EXPERIENCIA LABORAL","tipo":"seccion"},
  {"tamanio":"3","leyenda":"EXPERIENCIA EN PUESTO SIMILAR","id":"cit_puestosimilar-editar_cit_general","name":"cit[cit_puestosimilar]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_1-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-1-editar" ', "clase":"selects-valoracion-1-editar"  },
  {"tamanio":"2","leyenda":"ESTABILIDAD LABORAL","id":"cit_estabilidalaboral-editar_cit_general","name":"cit[cit_estabilidalaboral]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_1-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-1-editar" ', "clase":"selects-valoracion-1-editar"  },
  {"tamanio":"2","leyenda":"RESPONSABILIDAD","id":"cit_responsabilidad-editar_cit_general","name":"cit[cit_responsabilidad]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_1-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-1-editar" ', "clase":"selects-valoracion-1-editar"  },
  {"tamanio":"2","leyenda":"CONOCIMIENTOS TÉCNICOS","id":"cit_concimientostec-editar_cit_general","name":"cit[cit_concimientostec]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_1-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-1-editar" ', "clase":"selects-valoracion-1-editar"  },
  {"tamanio":"3","leyenda":"ACORDE AL SUELDO OFRECIDO","id":"cit_acordeasueldoofrecido-editar_cit_general","name":"cit[cit_acordeasueldoofrecido]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_1-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-1-editar" ', "clase":"selects-valoracion-1-editar"  },
  {"tamanio":"12","leyenda":"VALORACIÓN MEDIA","id":"cit_valoracionmedia_1-editar_cit_general","name":"","tipo":"text","required":"","complemento":'readonly'},
  {"tamanio":"12","leyenda":"","tipo":"seccion"},
  {"tamanio":"12","leyenda":"VALORACIÓN - ENTREVISTA","tipo":"seccion"},
  {"tamanio":"3","leyenda":"PRESENTACIÓN, APARIENCIA","id":"cit_presentacionapariencia-editar_cit_general","name":"cit[cit_presentacionapariencia]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_2-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-2-editar" ', "clase":"selects-valoracion-2-editar"  },
  {"tamanio":"3","leyenda":"PUNTUALIDAD","id":"cit_puntualidad-editar_cit_general","name":"cit[cit_puntualidad]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_2-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-2-editar" ', "clase":"selects-valoracion-2-editar"  },
  {"tamanio":"3","leyenda":"DISPONIBILIDAD","id":"cit_disponibilidad-editar_cit_general","name":"cit[cit_disponibilidad]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_2-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-2-editar" ', "clase":"selects-valoracion-2-editar"  },
  {"tamanio":"3","leyenda":"PROACTIVO","id":"cit_proactivo-editar_cit_general","name":"cit[cit_proactivo]","tipo":"select","required":"","funcion":"onchange='calcularSumaYPromedioMedianteSelects(event);'  ","complemento":'data-valor-no-considerado="[-1,N/A,n/a]" data-id-input-mostrar-valor="cit_valoracionmedia_2-editar_cit_general" data-clase-grupo-inputs="selects-valoracion-2-editar" ', "clase":"selects-valoracion-2-editar"  },
  {"tamanio":"12","leyenda":"VALORACIÓN MEDIA","id":"cit_valoracionmedia_2-editar_cit_general","name":"","tipo":"text","required":"","complemento":'readonly'},
  {"tamanio":"12","leyenda":"COMENTARIO","tipo":"seccion"},
  {"tamanio":"12","leyenda":"COMENTARIO","id":"com_comentario-editar_cit_general","name":"com[com_comentario]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'}

],
[{"complementomodal":' tabindex="99"  '}]
)
}}
