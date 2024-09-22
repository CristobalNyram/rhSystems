{% set cincuentaycinco= acceso.verificar(55,rol_id) %}

<style>
#td_con_nom_can_wrapper {
  width: 100%;
}
#td_con_curp_can_wrapper {
  width: 100%;
}
</style>
<script>

///tablas inicio ---------------------------------------------------------------tablas inicio
function buscarPrincipalByNomCom() {
  let nombre = $("#can_nombre-crear_cit_general").val();
  let apellido_p = $("#can_primerapellido-crear_cit_general").val();
  let apellido_m = $("#can_segundoapellido-crear_cit_general").val(); // Asegúrate de usar el campo correcto para apellido_m
  let nombreCompleto = nombre + " " + apellido_p + " " + apellido_m;
  let div_mostrar_info=$("#can_data_concidencia-crear_cit_general");
  div_mostrar_info.empty();
  // Llama a la función con los valores de entrada

  
  fnGeConcincidenciaByNombreCompleto(nombre, apellido_p, apellido_m)
    .then(function(res) {
      // Maneja la respuesta exitosa aquí
      if(res.estado=="2"){
          let data=res.data;
          // Encabezados personalizados (a partir de un objeto o arreglo)
          const customHeaders = {
            vac_id: 'ID VACANTE',
            exc_id: 'ID EXPEDIENTE',
            can_nombre_completo: 'Nombre completo',    
          };

          // Campos personalizados (a partir de un objeto o arreglo)
          const customFields = [
            'vac_id',
            'exc_id',
            'can_nombre_completo'
          ];

          // Crea una tabla
          let table = $("<table>").appendTo(div_mostrar_info);
          table.addClass("table table-striped table-bordered dt-responsive nowrap");

          // Agregar atributos style a la tabla
          table.attr("style", "border-collapse: collapse; border-spacing: 0; width: 100%;");
          table.attr("id", "td_con_nom_can");

          let thead = $("<thead>").appendTo(table);
          let tbody = $("<tbody>").appendTo(table);

          // Crea la fila de encabezados personalizados
          let headerRow = $("<tr>").appendTo(thead);
          $.each(customFields, function(index, field) {
            $("<th>").text(customHeaders[field]).appendTo(headerRow);
          });

          {% if cincuentaycinco==1 %}
          $("<th>").text("Acciones").appendTo(headerRow);
          {% endif %}


          // Llena la tabla con datos
          $.each(data, function(index, item) {
            let row = $("<tr>").appendTo(tbody);
            $.each(customFields, function(index, field) {
              $("<td>").text(item[field]).appendTo(row);
            });

             {% if cincuentaycinco==1 %}
                  let customActionsHTML = `
                  <td>
                  <a data-toggle="modal" title="Resumen" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('${item.exc_id}',fnCargarTablaExcGeneral_cit)">
                    <i class="mdi mdi-file-presentation-box mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
                  </a>
                  </td>`;
                  $(customActionsHTML).appendTo(row);
             {% endif %}
        
          });
          table.DataTable({
          searching: true,  // Activa solo la búsqueda
          paging: false,     // Oculta la paginación
          lengthChange: false,  // Oculta la opción de cambiar la cantidad de registros mostrados
          info: false,       // Oculta la información de la cantidad de registros
          ordering: false,    // Desactiva la ordenación de columnas
          language: {
            "sEmptyTable": "No se encontraron registros",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": `Buscar entre coincidencias:`,
            "sZeroRecords": "No se encontraron registros",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna ascendente",
              "sSortDescending": ": Activar para ordenar la columna descendente"
            }
          }
        });

      }else{

        div_mostrar_info.html("NO HAY COINCIDENCIAS DE INFO POR EL NOMBRE COMPLETO ");

      }

    })
    .catch(function(error) {
      div_mostrar_info.html("");
    });
}

function buscarPrincipalByCURP() {
  let curp = $("#can_curp_crear").val();
  let div_mostrar_info=$("#can_data_concidencia_by_curp-crear_cit_general");
  div_mostrar_info.empty();
  // Llama a la función con los valores de entrada
  fnGeConcincidenciaByCURP(curp)
    .then(function(res) {
      // Maneja la respuesta exitosa aquí
      if(res.estado=="2"){
          let data=res.data;
          // Encabezados personalizados (a partir de un objeto o arreglo)
          const customHeaders = {
            vac_id: 'ID VACANTE',
            exc_id: 'ID EXPEDIENTE',
            can_nombre_completo: 'Nombre completo',    
          };

          // Campos personalizados (a partir de un objeto o arreglo)
          const customFields = [
            'vac_id',
            'exc_id',
            'can_nombre_completo'
          ];

          // Crea una tabla
          let table = $("<table>").appendTo(div_mostrar_info);
          table.addClass("table table-striped table-bordered dt-responsive nowrap");

          // Agregar atributos style a la tabla
          table.attr("style", "border-collapse: collapse; border-spacing: 0; width: 100%;");
          table.attr("id", "td_con_curp_can");

          let thead = $("<thead>").appendTo(table);
          let tbody = $("<tbody>").appendTo(table);

          // Crea la fila de encabezados personalizados
          let headerRow = $("<tr>").appendTo(thead);
          $.each(customFields, function(index, field) {
            $("<th>").text(customHeaders[field]).appendTo(headerRow);
          });

          {% if cincuentaycinco==1 %}
          $("<th>").text("Acciones").appendTo(headerRow);
          {% endif %}


          // Llena la tabla con datos
          $.each(data, function(index, item) {
            let row = $("<tr>").appendTo(tbody);
            $.each(customFields, function(index, field) {
              $("<td>").text(item[field]).appendTo(row);
            });

             {% if cincuentaycinco==1 %}
                  let customActionsHTML = `
                  <td>
                  <a data-toggle="modal" title="Resumen" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('${item.exc_id}',fnCargarTablaExcGeneral_cit)">
                    <i class="mdi mdi-file-presentation-box mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
                  </a>
                  </td>`;
                  $(customActionsHTML).appendTo(row);
             {% endif %}
        
          });
          table.DataTable({
          searching: true,  // Activa solo la búsqueda
          paging: false,     // Oculta la paginación
          lengthChange: false,  // Oculta la opción de cambiar la cantidad de registros mostrados
          info: false,       // Oculta la información de la cantidad de registros
          ordering: false,    // Desactiva la ordenación de columnas
          language: {
            "sEmptyTable": "No se encontraron registros",
            "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sLoadingRecords": "Cargando...",
            "sProcessing": "Procesando...",
            "sSearch": `Buscar entre coincidencias:`,
            "sZeroRecords": "No se encontraron registros",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna ascendente",
              "sSortDescending": ": Activar para ordenar la columna descendente"
            }
          }
        });

      }else{
        div_mostrar_info.html("NO HAY CONCIDENCIAS DE INFO POR EL CURP ");
      }

    })
    .catch(function(error) {  
      div_mostrar_info.html("");
    });
}
///tablas fin ---------------------------------------------------------------tablas fin
</script>

<script>
    __CALLBACK_RELOAD_CREAR_CITA_GENERAL=0;
    function fnCrearCita(vac_id=0,callback=0){
      __CALLBACK_RELOAD_CREAR_CITA_GENERAL=callback;
        $('#form_crear_cit_general')[0].reset(); // Reinicia el formulario
        $("#can_data_concidencia-crear_cit_general").empty();
        $("#can_data_concidencia_by_curp-crear_cit_general").empty();

        fnGetDetalleVac(vac_id)
                          .then(function(res) {
                            try {

                              let data=res.data;
                              $("#vac_id-crear_cit_general").val(vac_id);
                              let mensaje=` de la vacante ${data.cav_nombre} No. ${data.vac_id} - ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
                              $('#crear_cit_general-titulo').html(mensaje);

                              fntipocita_adaptable($("#tic_id-crear_cit_general"),-1);
                              fnmedio_adaptable($("#med_id-crear_cit_general"),-1);
                      
                            } catch (error) {
                            // Manejo de la excepción
                             swalalertErrorSoporte(error);
                          
                            }


                          })
                          .catch(function(error) {
                              alert(error);
                          });
        
        

    }
     $(document).ready(()=>{

    let inputElement = document.getElementById("cv-crear_cit_general");
   // inputElement.setAttribute("onchange", "fnValidateSizeFile(event, 'preview-crear_cit_general')");

    inputElement.dataset.fileLimit = "1";
    inputElement.dataset.sizeLimit = "3145728";
    //inputElement.accept = ".jpg, .jpeg, .png, .jfif, .pdf, .docx, .doc";
     $("#cv-crear_cit_general").removeAttr("oninput");

      $("#form_crear_cit_general").validate({
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        rules: {
          can_curp_crear : {required: false, pattern:/^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/},
          can_correo_crear_cit_general: {
              required: false,
              pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
          }

          },
        messages: {
           can_curp_crear:{
             pattern: "El CURP no cumple con la estructura."
           },
           can_correo_crear_cit_general:{
             pattern: "El Correo no cumple con la estructura."
           }
        },
        submitHandler: function(form){
       
          return true;
        }
      });

   
		$("#form_crear_cit_general").submit(function(event) 
        {
          event.preventDefault();
		    	let $form = $(this);
         
          let selectsAValidar = [
			    	{ id: "#tic_id-crear_cit_general", name: "tipo cita" },
            { id: "#med_id-crear_cit_general", name: " medio en el que llegó " },
          ];

          let valoresPosiblesNoAceptados = ["-1", "-2"];
      	  if (!$form.valid()) {
            return false;
          }
          let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
          if (!isValidSelects) {
            return false;
          }
        
          
            $("#preview-crear_cit_general").empty();
            let vac_id =$("#vac_id-crear_cit_general").val();
            let file = $("#cv-crear_cit_general")[0].files[0]; // Obtener el archivo seleccionado
            let formData = new FormData($form[0]); // Crear objeto FormData con los datos del formulario
            formData.append("arc", file); // Agregar el archivo al objeto FormData

            let urled="<?php echo $this->url->get('cita/crear_general/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+vac_id,
              data: formData, // Usar el objeto FormData en la solicitud AJAX
              dataType: 'json',
              contentType: false,
              cache: false,
              processData:false,
              success: function(res)
              {   
              switch (res['estado']) {
                    case 2:
                    if (res["can_id"]=="0") {
                          swalalert('Éxito',res['mensaje'], "success", 0);

                    }else{
                        let data_exc=res["data_con_exc"]; 
                        let exc_id_list = data_exc.map(item => item.exc_id).join(',');

                        let mensaje_resumen=
                        `
                        ${res['mensaje']}
                        <br>
                          El número de coincidencias son ${res["count_con_exc"]} y son los siguientes:
                        <br>
                         ${exc_id_list}.
                        `;

                        swalalertHTML('Éxito',mensaje_resumen, "success", 0);

                    }
                      if(__CALLBACK_RELOAD_CREAR_CITA_GENERAL==0){
                            fnCargarTablaCitas(res['vac_id'])

                      }else{

                              __CALLBACK_RELOAD_CREAR_CITA_GENERAL(res['vac_id']);
                      }
                      $("#crear_cit_general-modal").modal("hide");
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




{{  modal.crear("Nueva cita <span id='crear_cit_general-titulo'><span>", "form_crear_cit_general","crear_cit_general-modal",
[
  {"tamanio":"0","leyenda":"","id":"vac_id-crear_cit_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"4","leyenda":"FECHA DE LA CITA","id":"cit_fecha-crear_cit_general","name":"cit[cit_fecha]","tipo":"date","required":"required","funcion":'onchange=""'},
  {"tamanio":"4","leyenda":"HORA","id":"cit_hora-crear_cit_general","name":"cit[cit_hora]","tipo":"time","required":"required",'complemento':' list="listahorasdeseadascitas" '},
  {"tamanio":"4","leyenda":"TIPO DE CITA","id":"tic_id-crear_cit_general","name":"cit[tic_id]","tipo":"select","required":"required"},
  {"tamanio":"12","leyenda":"DATOS CANDIDATO","tipo":"seccion"},
  {"tamanio":"4","leyenda":"NOMBRE(S)","id":"can_nombre-crear_cit_general","name":"can[can_nombre]","tipo":"text","required":"required","complemento":'minlength="2" maxlength="155"',"funcion":'onchange=" buscarPrincipalByNomCom();"'},
  {"tamanio":"4","leyenda":"APELLIDO PATERNO","id":"can_primerapellido-crear_cit_general","name":"can[can_primerapellido]","tipo":"text","required":"required","complemento":'minlength="2" maxlength="155" ',"funcion":'onchange=" buscarPrincipalByNomCom();"'},
  {"tamanio":"4","leyenda":"APELLIDO MATERNO","id":"can_segundoapellido-crear_cit_general","name":"can[can_segundoapellido]","tipo":"text","required":"","complemento":'maxlength="155"',"funcion":'onchange=" buscarPrincipalByNomCom();"'},
  {"value":"<div class='col-12 mt-1 mb-1' style='display: flex;justify-content: center;padding-top: 15px;'id='can_data_concidencia-crear_cit_general'></div>","tipo":"html"},
  {"tamanio":"6","leyenda":"TELÉFONO ","id":"can_telefono-crear_cit_general","name":"can[can_telefono]","tipo":"text","required":"","complemento":' maxlength="20"'},
  {"tamanio":"6","leyenda":"TELÉFONO CELULAR ","id":"can_celular-crear_cit_general","name":"can[can_celular]","tipo":"text","required":"","complemento":' maxlength="20"'},
  {"tamanio":"6","leyenda":"CORREO ELECTRÓNICO","id":"can_correo_crear_cit_general","name":"can[can_correo]","tipo":"text","required":"","complemento":' maxlength="155"',"funcion":'onblur="validarCorreoInput(event);"'},
  {"tamanio":"6","leyenda":"CURP","placeholder":"CURP","clase":"validar-curp-crear","id":"can_curp_crear","name":"can_curp_crear","tipo":"text","required":"","complemento":' maxlength="19"',"funcion":"oninput='handleInput(event);buscarPrincipalByCURP();quitar_validarEspacios(event);'" },
  {"value":"<div class='col-12 mt-1 mb-1' style='display: flex;justify-content: center;padding-top: 15px;'id='can_data_concidencia_by_curp-crear_cit_general'></div>","tipo":"html"},

  {"tamanio":"6","leyenda":"NÚMERO DE SEGURO SOCIAL","placeholder":"NÚMERO DE SEGURO SOCIAL","clase":"","id":"can_nosegsocial-crear_cit_general","name":"can[can_nosegsocial]","tipo":"text","required":"","complemento":'step="1" min="10000000" maxlength="15"  inputmode="numeric"' },
  {"tamanio":"12","leyenda":"CV S","tipo":"seccion"},
  {"tamanio":"12","leyenda":"CV","id":"cv-crear_cit_general","name":"arc[cv]","tipo":"file","clase":"file-input-wrapper"},
   {"value":"<div class='col-12 mt-1 mb-1' style='display: flex;justify-content: center;padding-top: 15px;'id='preview-crear_cit_general'></div>","tipo":"html"},
   
   
  {"tamanio":"2 text-uppercase","leyenda":"¿POR QUÉ MEDIO LLEGÓ?","id":"med_id-crear_cit_general","name":"cit[med_id]","tipo":"select","required":""},
  {"tamanio":"12","leyenda":"OBSERVACIONES","tipo":"seccion"},
  {"tamanio":"12","leyenda":"OBSERVACIONES","id":"cit_observaciones-crear_cit_general","name":"cit[cit_observaciones]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'}
],
[{"complementomodal":' tabindex="99" '}]

)
}}

