{% set cincuentaycuatro= acceso.verificar(48,rol_id) %}
{% set cincuentayocho = acceso.verificar(58,rol_id) %}
<!-- NOTA ESTE EDITAR NO ES VIABLE PARA VACANTES ACTIVAS SI ES ES QUE SE
   REQUIERE PARA ELLO TENDRIA QUE CREARSE UNA FUNCION DIFERENTE YA QUE TIENE MUCHOS PROCESOS POR DETRAS
  -->
<script>
  $(document).ready(function() {
  // Seleccionar el elemento <select> por su ID
    $("#emp_id-editar_vac_general").on("change", function() {
      getContactoDetalleEditarVacante();
            $("#cne_correo-editar_vac_general").val("");
            $("#cne_telefono-editar_vac_general").val("");
            $("#cne_celular-editar_vac_general").val("");
            $("#cne_puesto-editar_vac_general").val("");
    });
  });

  function getContactoDetalleEditarVacante(id_cne=0){
      
      let url="<?php echo $this->url->get('contactoemp/ajax_get_detalle_uno/') ?>"+id_cne;
      $.ajax({
        type: "POST",
        url: url,
        success: function(res)
        {
          if(res.length==0){
            $("#cne_correo-editar_vac_general").val("");
            $("#cne_telefono-editar_vac_general").val("");
            $("#cne_celular-editar_vac_general").val("");
            $("#cne_puesto-editar_vac_general").val("");
          }else{
            let data = res[0];
            $("#cne_correo-editar_vac_general").val(data.cne_correo);
            $("#cne_telefono-editar_vac_general").val(data.cne_tel);
            $("#cne_celular-editar_vac_general").val(data.cne_celular);
            $("#cne_puesto-editar_vac_general").val(data.cne_puesto);

          }
      
        },
        error: function(res)
        {
          alert('Error en el servidor...');
        // $("#btn_aprobar").prop("disabled", false);
        }
      });

  }
  
  function callback_trigger_selects(){
  }
    // Llamada a la función con el límite de opciones, el ID del select y el valor seleccionado
    let _VAC_ID_EDITAR=0;
    let _CALLBACK_REOLAD_TABLE=0;
    let _VAC_NUMERO_vac_editar=0;
    let _VAC_NUMERO_EXC_FAT_vac_editar=0;
    let _VAC_ESTATUS_ACTUAL_vac_editar=0;
    function fnEditarVac(vac_id=0,callbak_table=0)
	  {
      $('#vac_estatus-editar_vac_general').parent().hide();
      _VAC_ID_EDITAR=vac_id;
      _VAC_NUMERO_vac_editar=0;
      _VAC_NUMERO_EXC_FAT_vac_editar=0;
      _VAC_ESTATUS_ACTUAL_vac_editar=0;

      _CALLBACK_REOLAD_TABLE=callbak_table;
      $('#form_editar_vac_general')[0].reset(); // Reinicia el formulario
      $('.campos_contacto_empresa-editar_vac_general').hide();
     
      //resetSelectValues('#form_editar_vac_general');
        let url="<?php echo $this->url->get('vacante/ajax_get_detalle/') ?>";
        $.ajax({
            type: "POST",
            url: url+_VAC_ID_EDITAR,
            success: function(res)
            {
              let data=res.data;


              let analiticas=res.analiticas;
              let mensaje=` ${data.vac_id} - empresa: ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
              _VAC_ESTATUS_ACTUAL_vac_editar=data.vac_estatus;
              $('#editar_vac_general-titulo').html(mensaje);
              let array_selects = {
                  emp: {
                    select_id: $('#emp_id-editar_vac_general'),
                    value: data.emp_id
                  },
                  cne: {
                    select_id: 'emp_id',
                    value: 0
                  },
                 /* eje: {
                    select_id: $('#eje_id-editar_vac_general'),
                    value: data.eje_id
                  },*/
                  sex: {
                    select_id: $('#sex_id-editar_vac_general'),
                    value: data.sex_id
                  },
                  esc: {
                    select_id: $('#esc_id-editar_vac_general'),
                    value: data.esc_id
                  },
                  gen: {
                    select_id: $('#gen_id-editar_vac_general'),
                    value: data.gen_id
                  },
                  est: {
                    select_id: $('#est_id-editar_vac_general'),
                    value: data.est_id
                  },
                  gra: {
                    select_id: $('#gra_id-editar_vac_general'),
                    value: data.gra_id
                  },
                  tip: {
                    select_id: $('#tip_id-editar_vac_general'),
                    value: data.tip_id
                  },
                  tie: {
                    select_id: $('#tie_id-editar_vac_general'),
                    value: data.tie_id
                  },
                  pre: {
                    select_id: $('#pre_id-editar_vac_general'),
                    value: data.pre_id
                  },
                  {% if cincuentaycuatro==1 %}
                  vac_estatus: {
                    select_id: $('#vac_estatus-editar_vac_general'),
                    value: data.vac_estatus
                  },
                  {% endif %}
                  
                  
              };
            $("#tie_id-editar_vac_general").attr("onchange", "tipoDeEmpleoInpust(event.currentTarget.value)");
             // $('#vac_garantia-editar_vac_general').val(data.vac_garantia);
             $('#vac_sueldomin-editar_vac_general').removeAttr('input');
             $('#vac_sueldomax-editar_vac_general').removeAttr('input');

             $("#vac_sueldomax-editar_vac_general").attr("oninput", `limitDecimalPlaces(event, 2)`);
             $("#vac_sueldomin-editar_vac_general").attr("oninput", `limitDecimalPlaces(event, 2)`);


              $('#vac_sueldomax-editar_vac_general').val(data.vac_sueldomax);
              $('#vac_sueldomin-editar_vac_general').val(data.vac_sueldomin);

              $('#vac_experiencia-editar_vac_general').val(data.vac_experiencia);
              $('#vac_observaciones-editar_vac_general').val(data.vac_observaciones);
              $('#vac_funcionprincipal-editar_vac_general').val(data.vac_funcionprincipal);
              $('#vac_habilidad-editar_vac_general').val(data.vac_habilidad);
              $('#vac_conceptotecnico-editar_vac_general').val(data.vac_conceptotecnico);
              $('#vac_horario-editar_vac_general').val(data.vac_horario);
              $('#vac_otroidioma-editar_vac_general').val(data.vac_otroidioma);
              $('#vac_nivelidioma-editar_vac_general').val(data.vac_nivelidioma);
              $('#vac_idioma-editar_vac_general').val(data.vac_idioma);
              $('#vac_escolaridadespecificar-editar_vac_general').val(data.vac_escolaridadespecificar);
              $('#vac_edadmax-editar_vac_general').val(data.vac_edadmax);
              $('#vac_edadmin-editar_vac_general').val(data.vac_edadmin);
              $('#cen_id-editar_vac_general').val(data.cen_id);
              $('#cne_id-editar_vac_general').val(data.cne_id);            
              $('#vac_tiempomeses-editar_vac_general').val(data.vac_tiempomeses);   
              
              $('#vac_privacidad-editar_vac_general').empty();
              $('#vac_privacidad-editar_vac_general').append($('<option>', {
                  value: '-1',
                  text: 'Seleccionar'
              }));

              $('#vac_privacidad-editar_vac_general').append($('<option>', {
                  value: '1',
                  text: 'PÚBLICA'
              }));

              // Agrega la opción "PRIVADO" con value 2
              $('#vac_privacidad-editar_vac_general').append($('<option>', {
                  value: '2',
                  text: 'PRIVADA'
              }));

            var valorASetear_vac_privacidad = "" ;
            if(data.vac_privacidad=="-1" ||data.vac_privacidad==""||data.vac_privacidad==null  ){
             valorASetear_vac_privacidad = -1;

            }else{
             valorASetear_vac_privacidad = data.vac_privacidad;
            
            }
              $('#vac_privacidad-editar_vac_general').val(valorASetear_vac_privacidad);
              $('#vac_privacidad-editar_vac_general').trigger('change');

              /*
              *Dependiendo del tipo de información depenede la ubicación del archivo de la función
              *ejemplo:fnmunicipios_adaptable trae informacion de la tabla municipio, por ende se encuentra el carpeta views/municipio/script-ajax-todos
              *en caso de que esa logica no se respeta se busca en los archivos de helpers
              */
              fntipopago_adaptable(`tpg_id-editar_vac_general`,data.tpg_id);
              fnmunicipios_adaptable($(`#mun_id-editar_vac_general`),data.est_id,data.mun_id);
              fncontactos_adaptable($(`#cne_id-editar_vac_general`),data.emp_id,data.cne_id);
              fnejecutivosNoCompartenVac_adaptable($(`#eje_id-editar_vac_general`),data.eje_id,_VAC_ID_EDITAR);

              

              if (data.cne_id !== "" || data.cne_id !== null || data.cne_id !="-1" || data.cne_id !="0" ) {
                 getContactoDetalleEditarVacante(data.cne_id);
                $('.campos_contacto_empresa-editar_vac_general').show();
              }else{
                $('.campos_contacto_empresa-editar_vac_general').hide();

              }

              fncentros_adaptable($(`#cen_id-editar_vac_general`),data.emp_id,data.cen_id); 
              fncatvacante_adaptable($(`#cav_id-editar_vac_general`),data.emp_id,data.cav_id);
              getSelectsVacLlenar(array_selects,callback_trigger_selects);//esta funcion se encuentra en el archivo vacante/acciones/rellenar-selects-vac-js.volt
              
              let datos_vac_gar = [
                { id: 15, nombre: '15' },
                { id: 30, nombre: '30' },
                { id: 45, nombre: '45' },
                { id: 60, nombre: '60' },
                { id: 75, nombre: '75' },
                { id: 90, nombre: '90' },

              ];
              let selectInput_vac_gar = $('#vac_garantia-editar_vac_general'); // Selecciona el elemento select por su ID
              let vac_gar_value=-1;
              if (data.vac_garantia !== null && data.vac_garantia !== undefined && data.vac_garantia != "0") {
                vac_gar_value = data.vac_garantia;
              }
              pintarSelect(datos_vac_gar, selectInput_vac_gar, 'id', 'nombre', vac_gar_value,1 , 0);


              {% if cincuentayocho==1 %}
                  $("#vac_nuumero-editar_vac_general").prop("readonly", false);
                  llenarSelectConOpcionesPorNumeroEditar(30, "#vac_nuumero-editar_vac_general", data.vac_numero);
                   _VAC_NUMERO_vac_editar=data.vac_numero;
                   _VAC_NUMERO_EXC_FAT_vac_editar=analiticas.vac_exc_fat;
                  $("#datos_info-editar_vac_general").html(`
                   <span class="badge badge-success text-white" id="btn_fat_exc-editar_vac_general" style="padding:.5rem;font-size:1rem;">
                        <i class="mdi mdi-cash-multiple mdi-18px btn-icon analiticas text-white"></i>
                        Expedientes facturados
                        <br>
                        ${analiticas.vac_exc_fat}
                    </span>
                  `);
                  $('#vac_nuumero-editar_vac_general').attr('onchange', `validarSeleccionVacNo(this, ${analiticas.vac_exc_fat},"#btn_fat_exc-editar_vac_general" );`);
              {% else %}
                  $("#vac_nuumero-editar_vac_general").prop("readonly", true);
                  $("#datos_info-editar_vac_general").html('');
                  llenarSelectConOpcionesPorNumeroEditar(30, "#vac_nuumero-editar_vac_general", data.vac_numero);
                  $('#vac_nuumero-editar_vac_general').prop('disabled', true);
                  $('#vac_nuumero-editar_vac_general').on('select2:opening', function() {
                          return false;
                  });

              {% endif %}
              {% if cincuentaycuatro==1 %}
                 /*if(data.vac_estatus!="5"){
                 }*/
                 $('#vac_estatus-editar_vac_general').parent().show();

              {% endif %}

            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText);               
            }
          });

	  }
  $(document).ready(()=>{
  
    $("#form_editar_vac_general").submit(async function(event) {
      event.preventDefault();
      var $form = $(this);


      {% if cincuentayocho==1 %}
        /*
        1. si la vac va de  garantia a stand by no se lanza la ventana de cambio de estatus
        1.1 si la vac va de  standt a garantia no se lanza la ventana de cambio de estatus
        */
       if (
            !(
              (_VAC_ESTATUS_ACTUAL_vac_editar == "5" && $("#vac_estatus-editar_vac_general").val() == "4") ||
              (_VAC_ESTATUS_ACTUAL_vac_editar == "2" && $("#vac_estatus-editar_vac_general").val() == "5") ||
              (_VAC_ESTATUS_ACTUAL_vac_editar == "5" && $("#vac_estatus-editar_vac_general").val() == "5") ||
              (_VAC_ESTATUS_ACTUAL_vac_editar == "4" && $("#vac_estatus-editar_vac_general").val() == "4") ||
              (_VAC_ESTATUS_ACTUAL_vac_editar == "2" && $("#vac_estatus-editar_vac_general").val() == "4")
            )
          ){
            if (_VAC_NUMERO_EXC_FAT_vac_editar >= $("#vac_nuumero-editar_vac_general").val()  ) {
              let vac_numero_actualizar = $("#vac_nuumero-editar_vac_general").val();
              let mensaje_preg_no_fat = `
                <h4>
                  ¿ESTÁ SEGURO DE CAMBIAR EL NÚMERO DE VACANTES?
                </h4>
              
                El número de vacantes a las que va a  <span class="text-danger"><b> actualizar  ${vac_numero_actualizar}</b></span> es mayor o igual que el número de  <span class="text-danger"><b> vacantes facturadas   ${_VAC_NUMERO_EXC_FAT_vac_editar}</b></span>. 
                <br>
                Por ende la vacante se irá  a estatus FIN.
              `;

              const result = await Swal.fire({
                html: mensaje_preg_no_fat,
                showCancelButton: true,
                confirmButtonText: 'Si, realizar acción',
                cancelButtonText: 'No, cancelar acción',
              });

              if (!result.value) {
            
                return false;
              }
            }

       }
       
      {% endif %}  

      let cantidadOpciones_cen_id = $("#cen_id-editar_vac_general option").length;
      if (cantidadOpciones_cen_id > 1) {
      
        let selectsAValidar = [
				  { id: "#cen_id-editar_vac_general", name: "CENTRO DE COSTO" },
			  ];
        let valoresPosiblesNoAceptados = ["0", "-2"];
        let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
          if (!isValidSelects) {
            return false;
          }

      }

      let urled = "<?php echo $this->url->get('vacante/actualizar/') ?>";
      $form.find("button").prop("disabled", true);

      try {
        const response = await $.ajax({
          type: "POST",
          url: urled + _VAC_ID_EDITAR,
          data: $form.serialize(),
        });

        switch (response.estado) {
          case 2:
            swalalert('Éxito', response.mensaje, "success", 0);

            if (_CALLBACK_REOLAD_TABLE != 0) {
              _CALLBACK_REOLAD_TABLE();
            } else {
              window.location.reload();
            }

            $('#editar_vac_general-modal').modal('hide');
            $form.find("button").prop("disabled", false);
            break;

          case -1:
            swalalert('Aviso', response.mensaje, "warning", 0);
            $form.find("button").prop("disabled", false);
            break;

          case -2:
            swalalertHTML('Error', `${response.mensaje} <br> <span class=></span> `, "error");
            $form.find("button").prop("disabled", false);
            break;

          default:
            // Realiza alguna acción por defecto si es necesario
            break;
        }
      } catch (error) {
        // Maneja el error de la petición AJAX si ocurre
        alert(error.responseText);
      }
    });


	
  });
    

</script>




{{  modal.crear("Editar vacante folio <span id='editar_vac_general-titulo'><span>", "form_editar_vac_general","editar_vac_general-modal",
[
  {"tamanio":"12","leyenda":"DATOS DE LA EMPRESA","tipo":"seccion"},
  {"tamanio":"4","leyenda":"EMPRESA","id":"emp_id-editar_vac_general","name":"emp_id","tipo":"select","required":"","funcion":'onchange="fncatvacante_adaptable($(`#cav_id-editar_vac_general`),event.currentTarget.value,-1);fncontactos_adaptable($(`#cne_id-editar_vac_general`),event.currentTarget.value,-1); fncentros_adaptable($(`#cen_id-editar_vac_general`),event.currentTarget.value,-1) "'},
  {"tamanio":"4","leyenda":"QUIEN SOLICITA","id":"cne_id-editar_vac_general","name":"cne_id","tipo":"select","required":"","funcion":'onchange="getContactoDetalleEditarVacante(event.currentTarget.value)"'},
  {"tamanio":"4","leyenda":"CENTRO DE COSTO","id":"cen_id-editar_vac_general","name":"cen_id","tipo":"select","required":""},

  {"tamanio":"4 campos_contacto_empresa-editar_vac_general","leyenda":"PUESTO DE CONTACTO","id":"cne_puesto-editar_vac_general","name":"cne_puesto","tipo":"text","required":"","complemento":'readonly  '},
  {"tamanio":"4 campos_contacto_empresa-editar_vac_general","leyenda":"CELULAR DE CONTACTO","id":"cne_celular-editar_vac_general","name":"cne_celular","tipo":"text","required":"","complemento":'readonly  '},
  {"tamanio":"4 campos_contacto_empresa-editar_vac_general","leyenda":"TELÉFONO CONTACTO EMPRESA","id":"cne_telefono-editar_vac_general","name":"cne_telefono","tipo":"text","required":"","complemento":'readonly  '},
  {"tamanio":"4 campos_contacto_empresa-editar_vac_general","leyenda":"CORREO CONTACTO EMPRESA","id":"cne_correo-editar_vac_general","name":"cne_correo","tipo":"text","required":"","complemento":'readonly  '},

  {"tamanio":"12","leyenda":"DATOS GENERAL DE LA REQUISICIÓN","tipo":"seccion"},
  {"tamanio":"4","leyenda":"TIPO DE VACANTE","id":"tip_id-editar_vac_general","name":"tip_id","tipo":"select","required":""},
  {"tamanio":"4","leyenda":"VACANTE","id":"cav_id-editar_vac_general","name":"cav_id","tipo":"select","required":""},
  {"value":"<div class='col-12 mt-1 mb-1' style='display: flex;justify-content: center;padding-top: 15px;'id='datos_info-editar_vac_general'></div>","tipo":"html"},

  {"tamanio":"4","leyenda":"NO. VACANTES","id":"vac_nuumero-editar_vac_general","name":"vac_numero","tipo":"select","required":"","complemento":'readonly step="1" min="1"   inputmode="numeric" '},
  {"tamanio":"4","leyenda":"TIPO DE EMPLEO","id":"tie_id-editar_vac_general","name":"tie_id","tipo":"select","required":""},
  {"tamanio":"4 tie_id-temporal","leyenda":"POR","id":"vac_tiempomeses-editar_vac_general","name":"vac_tiempomeses","tipo":"number","required":"","complemento":' maxlength="155"'},
  {"tamanio":"4","leyenda":"ESTADO","id":"est_id-editar_vac_general","name":"est_id","tipo":"select","required":"","funcion":'onchange="fnmunicipios_adaptable($(`#mun_id-editar_vac_general`),event.currentTarget.value,-1)"'},
  {"tamanio":"4","leyenda":"MUNICIPIO","id":"mun_id-editar_vac_general","name":"mun_id","tipo":"select","required":"","nombreprimeroption":"Selecciona un estado"},
  {"tamanio":"12","leyenda":"UNICAMENTE PARA PERSONAL SUBCONTRATADO","tipo":"seccion"},
  {"tamanio":"12","leyenda":"GENERACIÓN DE LA VACANTE POR","id":"gen_id-editar_vac_general","name":"gen_id","tipo":"select","required":""},
  {"tamanio":"12","leyenda":"REQUERIMIENTOS DEL PUESTO","tipo":"seccion"},
  {"tamanio":"3","leyenda":"ESTADO CIVIL","id":"esc_id-editar_vac_general","name":"esc_id","tipo":"select","required":""},
  {"tamanio":"3","leyenda":"EDAD MIN","id":"vac_edadmin-editar_vac_general","name":"vac_edadmin","tipo":"text","required":"",'funcion":"onkeydown="formatoEdad(event)"',"complemento":' maxlength="3"' },
  {"tamanio":"3","leyenda":"EDAD MAX","id":"vac_edadmax-editar_vac_general","name":"vac_edadmax","tipo":"text","required":"",'funcion":"onkeydown="formatoEdad(event)"',"complemento":' maxlength="3"'},
  {"tamanio":"3","leyenda":"SEXO","id":"sex_id-editar_vac_general","name":"sex_id","tipo":"select","required":""},
  {"tamanio":"3","leyenda":"ESCOLARIDAD DESEADA","id":"gra_id-editar_vac_general","name":"gra_id","tipo":"select","required":""},
  {"tamanio":"3","leyenda":"ESPECIFICAR ESCOLARIDAD","id":"vac_escolaridadespecificar-editar_vac_general","name":"vac_escolaridadespecificar","tipo":"text","required":"","complemento":' maxlength="255"'},
  {"tamanio":"3","leyenda":"IDIOMAS REQUERIDOS","id":"vac_idioma-editar_vac_general","name":"vac_idioma","tipo":"text","required":"","complemento":' maxlength="155"  '},
  {"tamanio":"3","leyenda":"NIVEL","id":"vac_nivelidioma-editar_vac_general","name":"vac_nivelidioma","tipo":"text","required":"","complemento":' maxlength="30" '},
  {"tamanio":"3","leyenda":"OTROS IDIOMAS","id":"vac_otroidioma-editar_vac_general","name":"vac_otroidioma","tipo":"text","required":"","complemento":' maxlength="155"  '},
  {"tamanio":"3","leyenda":"HORARIO DE TRABAJO","id":"vac_horario-editar_vac_general","name":"vac_horario","tipo":"text","required":"","complemento":' maxlength="90"'},
  {"tamanio":"12","leyenda":"CONCEPTO / DESCRIPCIÓN","tipo":"seccion"},
  {"tamanio":"6","leyenda":"CONCEPTOS TÉCNICOS","id":"vac_conceptotecnico-editar_vac_general","name":"vac_conceptotecnico","tipo":"textarea","required":"","complemento":'style="min-height:188px"'},
  {"tamanio":"6","leyenda":"HABILIDADES O COMPETENCIAS","id":"vac_habilidad-editar_vac_general","name":"vac_habilidad","tipo":"textarea","required":"","complemento":' style="min-height:188px"'},
  {"tamanio":"6","leyenda":"FUNCIONES PRINCIPALES","id":"vac_funcionprincipal-editar_vac_general","name":"vac_funcionprincipal","tipo":"textarea","required":"","complemento":'style="min-height:188px"'},
  {"tamanio":"6","leyenda":"EXPERIENCIA","id":"vac_experiencia-editar_vac_general","name":"vac_experiencia","tipo":"textarea","required":"","complemento":'style="min-height:188px"'},
  {"tamanio":"4","leyenda":"SUELDO MÍNIMO","id":"vac_sueldomin-editar_vac_general","name":"vac_sueldomin","tipo":"number","required":"","complemento":' maxlength="155"'},
  {"tamanio":"4","leyenda":"SUELDO MÁXIMO","id":"vac_sueldomax-editar_vac_general","name":"vac_sueldomax","tipo":"number","required":"","complemento":' maxlength="155"'},
  {"tamanio":"4 ","leyenda":"TIPO PAGO","id":"tpg_id-editar_vac_general","name":"tpg_id","tipo":"select","required":""},
  {"tamanio":"4","leyenda":"PRESTACIONES","id":"pre_id-editar_vac_general","name":"pre_id","tipo":"select","required":""},
  {"tamanio":"4","leyenda":"GARANTÍA POR MES","id":"vac_garantia-editar_vac_general","name":"vac_garantia","tipo":"select","required":""},

  {"tamanio":"12","leyenda":"OBSERVACIONES ","id":"vac_observaciones-editar_vac_general","name":"vac_observaciones","tipo":"textarea","required":"","complemento":'style="min-height:150px"'},
  {"tamanio":"6","leyenda":"EJECUTIVO","id":"eje_id-editar_vac_general","name":"eje_id","tipo":"select","required":""},
  {"tamanio":"6 div_vac_estatus-editar_vac_general","leyenda":"ESTATUS","id":"vac_estatus-editar_vac_general","name":"vac_estatus","tipo":"select","required":""},
  {"tamanio":"6","leyenda":"EL CLIENTE DESEA QUE LA VACANTE SEA","id":"vac_privacidad-editar_vac_general","name":"vac_privacidad","tipo":"select","required":""}
]

)
}}

