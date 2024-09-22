<style>
  .select2-readonly {
    pointer-events: none;
    cursor:normal;
}

.select2-readonly .select2-search {
    display: none;
}

.img-svg-btn-arc{
  width: 9rem;
  height: 9rem;
}
.img-svg-btn-arc-vac{
  width: 9rem;
  height: 9rem;

}
</style>

<script>
    function fnmultiplicarCosto(e) {
      let value = parseFloat(e.target.value);
        let factor = $("#fat_factor-cambiar_estatus_exc_general").val();

        if (factor !== "-1") {
            if (factor.indexOf('.') === -1) {
                factor = parseFloat(factor) / 100;
            } else {
                factor = parseFloat(factor);
            }
            let valor_total = (value * factor).toFixed(2); // Fijar el resultado a dos decimales
            $("#fat_montofacturar-cambiar_estatus_exc_general").val(valor_total);
        } 
    }

    function mostraListaCambioEstatusDeAcordeEstatus(exc_id=0,continua=0,estatus_en_vista=0){
    let url = "<?php echo $this->url->get('expedientecan/ajax_get_detalle_estatus_cambio/') ?>";
    let select = $("#exc_estatus-cambiar_estatus_exc_general");
    select.empty();
    $.ajax({
      type: "POST",
      url: url + exc_id,
      success: function(res) {

        $(".row-continua-cambiar_estatus_exc_general").hide();

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
              $("#exc_estatus-cambiar_estatus_exc_general").append($('<option>', {
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
    function ocultarMoldalExcEstatusCambiar(){
        $("#cambiar_estatus_exc_general-modal").modal("hide");
    }
     
  //variables globales para actualizar la tabla
    let exc_id_cambiar_estatus=0; 
    let vac_id_cambiar_estatus=0;
    let VAC_ESTATUS_cambiar_estatus=0;
    let exc_estatus_cambiar_estatus=0;
    let callback_cambiar_estatus=0; 
    let CONFIG_cambiar_estatus={};
    let CALLBACK_MAIN_TABLA_cambiar_estatus=0;
    let EXC_ESTATUS_ACTUAL_cambiar_estatus_general=0;

    function fnCambiarEstatusExc(exc_id=0,exc_estatus=0,callback=0,config={},callback_main_tabla=0){
        CONFIG_cambiar_estatus=config;
        EXC_ESTATUS_ACTUAL_cambiar_estatus_general=0;
        CALLBACK_MAIN_TABLA_cambiar_estatus=callback_main_tabla;///sirve para recargar la tabla principal de la vista la cual requiere un vac_id
        $("#exc_pregunta-cambiar_estatus_exc_general").attr("onchange", "");
        $('#form_cambiar_estatus_exc_general')[0].reset(); // Reinicia el formulario
        $("#exc_estatus-cambiar_estatus_exc_general").empty();
        $("#fat_sueldo-cambiar_estatus_exc_general").removeAttr("oninput");
        $("#fat_sueldo-cambiar_estatus_exc_general").removeAttr("onchange");
        $("#fat_sueldo-cambiar_estatus_exc_general").removeAttr("step");
        $("#fat_sueldo-cambiar_estatus_exc_general").attr("step", ".01");

        
        $("#fat_montofacturar-cambiar_estatus_exc_general").removeAttr("oninput");
        $("#fat_montofacturar-cambiar_estatus_exc_general").attr("oninput", " limitDecimalPlaces(event,2)");
        $("#fat_sueldo-cambiar_estatus_exc_general").attr("oninput", " limitDecimalPlaces(event,2);fnmultiplicarCosto(event);");
        $(".row-continua-cambiar_estatus_exc_general").hide();

        fnGetDetalleExc(exc_id)
                          .then(function(res) {
                            exc_id_cambiar_estatus=exc_id;
                            callback_cambiar_estatus=callback;
                            VAC_ESTATUS_cambiar_estatus=0;
                            
                              try {
                                let data=res.data;
                                VAC_ESTATUS_cambiar_estatus=data.vac_estatus;

                                vac_id_cambiar_estatus=data.vac_id;
                                exc_estatus_cambiar_estatus=data.exc_estatus;
                                EXC_ESTATUS_ACTUAL_cambiar_estatus_general=data.exc_estatus;

                                  //VALIDACION DE ESTATUS DESDE FRONT-------------------------------------INICIO
                                if(exc_estatus!=data.exc_estatus){
                                  if(callback_cambiar_estatus!=0){
                                      callback_cambiar_estatus();
                                  }else{
                                      location.reload(); 
                                  }
                                  swalalert('AVISO','El expediente ha sido cambiado previamente de estatus', "warning", 0,ocultarMoldalExcEstatusCambiar);

                                }
                                //VALIDACION DE ESTATUS DESDE FRONT-------------------------------------FIN 


                                ///VALIDAMOS SI ES LA RUTA DE FATURAR INICIO------------------------------------INICIO
                                let inputBoton='';
                          
                                $("#btn_fat-crear_cit_general").html(inputBoton);

                                if(data.exc_estatus=="4"){
                                 $("#btn_fat-crear_cit_general").show();

                                }else{
                                  $("#btn_fat-crear_cit_general").empty();
 
                                }
                              
                                ///VALIDAMOS SI ES LA RUTA DE FACTURA FIN--------------------------------------------FIN
                                llenarSelectValoracionContinuaSiNo("exc_pregunta-cambiar_estatus_exc_general");
                                let mensaje=` del expediente folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -` +generateBadgeExcEstatusHTML(data.exc_estatus)+` - vacante  ${generateBadgeVacEstatusHTML(data.vac_estatus)}` ;
                     	          $("#exc_estatus_actual-cambiar_estatus_exc_general").val(exc_estatus);
                                $("#exc_id-cambiar_estatus_exc_general").val(exc_id);
                                $("#vac_id-cambiar_estatus_exc_general").val(data.vac_id);
                                $("#vac_estatus-cambiar_estatus_exc_general").val(data.vac_estatus);
                                $("#cambiar_estatus_exc_general-titulo").html(mensaje);
                                let onChangeExc = `mostraListaCambioEstatusDeAcordeEstatus( ${exc_id},event.currentTarget.value)`;
                                $("#exc_pregunta-cambiar_estatus_exc_general").attr("onchange", onChangeExc);
                                //$("#exc_estatus-cambiar_estatus_exc_general option:first-child").text(`Seleccione una opción ¿Continúa en el proceso? `);
                                  $("#exc_estatus-cambiar_estatus_exc_general").append($('<option>', {
                                    value: -1,
                                    text: "Seleccione una opción ¿Continúa en el proceso? "
                                  }));
                                $("#exc_estatus-cambiar_estatus_exc_general").select2();
                                
                                if (config.hasOwnProperty('continuavalor')) {
                                  $("#exc_pregunta-cambiar_estatus_exc_general").val(config.continuavalor !== null && config.continuavalor !== -1 ? config.continuavalor : -1);
                                  $('#exc_pregunta-cambiar_estatus_exc_general').trigger('change');
                                  $('#exc_pregunta-cambiar_estatus_exc_general').addClass('select2-readonly');
                                  $('#exc_pregunta-cambiar_estatus_exc_general').on('select2:opening', function(e) {
                                      e.preventDefault();
                                });
                                  
                                  }
                              } catch (error) {
                                // Manejo de la excepción
                                swalalertErrorSoporte(error);
                                // Realizar acciones adicionales en caso de error
                              }

                          })
                          .catch(function(error) {
                              alert(error.responseText);
                              console.log(error);
                          });
        
       

    }

     $(document).ready(()=>{1

      let selectElementEstatus = $('#exc_estatus-cambiar_estatus_exc_general');
      selectElementEstatus.on('change', function() {
          
          var selectedValue = $(this).val(); // Obtener el valor seleccionado
          exc_estatus_cambiar_estatus=selectedValue;
          $("#fat_sueldo-cambiar_estatus_exc_general").prop("required", false);
          $("#fat_montofacturar-cambiar_estatus_exc_general").prop("required", false);
          $("#fat_fechaingreso-cambiar_estatus_exc_general").prop("required", false);
          $("#fat_motivo-cambiar_estatus_exc_general").prop("required", false);
          $("#fat_montofacturar-cambiar_estatus_exc_general").attr("readonly", false);

          if(selectedValue=="6"){
                  
               
                $("#fat_montofacturar-cambiar_estatus_exc_general").val("");
                $("#fat_fechaingreso-cambiar_estatus_exc_general").val("");
                $("#fat_motivo-cambiar_estatus_exc_general").val("");
                $("#fat_sueldo-cambiar_estatus_exc_general").val("");

                $("#fat_sueldo-cambiar_estatus_exc_general").prop("required", true);
                $("#fat_montofacturar-cambiar_estatus_exc_general").prop("required", true);
                $("#fat_fechaingreso-cambiar_estatus_exc_general").prop("required", true);
                $("#fat_motivo-cambiar_estatus_exc_general").prop("required", true);
                $(".row-continua-cambiar_estatus_exc_general").show();
                

                fnGetDetalleFac(exc_id_cambiar_estatus)
                              .then(function(res) {
                                  try { 
                                    let datos=[];
                                    let data =res.data.facturacion;                       
                                    $("#fat_factor-cambiar_estatus_exc_general").empty();
                                    $("#fat_montofacturar-cambiar_estatus_exc_general").attr("readonly", false);


                                    //FACTOR --INICIO
                                    let selectInput = $("#fat_factor-cambiar_estatus_exc_general"); // Obtener el elemento <select> por su id
                                    let idField = "id"; // El nombre del campo 'id' en tus datos
                                    let nombreField = "nombre"; // El nombre del campo 'nombre' en tus datos

                                    let selectedValue_factor=0;
                                    if(VAC_ESTATUS_cambiar_estatus=="5"){
                                       datos = [
                                        { id: 0, nombre: " 0%" },
                                      ];
                                 
                                      selectedValue_factor = 0; // El valor seleccionado por defecto (opcional)
                                    }else{
                                       datos = [
                                        { id: 65, nombre: "65%" },
                                        { id: 50, nombre: " 50%" },
                                        { id: 75, nombre: "75%" },
                                        { id: 85, nombre: " 85%" },
                                        { id: 100, nombre: " 100%" },
                                      ];
                                      selectedValue_factor = 85; // El valor seleccionado por defecto (opcional)
                                    }

                                 
				                            if (res.estado=="2" ) {
                                        if(data.fat_factor!=null || data.fat_factor!="-1" || data.fat_factor!=""){
                                          selectedValue_factor=data.fat_factor;
                                        }
                                    }
                                    pintarSelect(datos, selectInput, idField, nombreField, selectedValue_factor,1,sin_primer_opcion=1);
                                    //FACTOR --FIN


                                    // REQ FACTURA INICIO
                                    let selectInput_reqfac = $("#fat_reqfactura-cambiar_estatus_exc_general"); // Obtener el elemento <select> por su id
                                    $("#fat_reqfactura-cambiar_estatus_exc_general").empty();

                                    let idField_reqfac = "id"; // El nombre del campo 'id' en tus datos
                                    let nombreField_reqfac = "nombre"; // El nombre del campo 'nombre' en tus datos
                                    let selectedValue_reqfac = 0; // El valor seleccionado por defecto (opcional)
                                    let datos_reqfac =[];
                                    if(VAC_ESTATUS_cambiar_estatus=="5"){
                                        datos_reqfac = [
                                            { id: 0, nombre: "NO" },
                                          ];
                                     
                                       selectedValue_reqfac = 0; // El valor seleccionado por defecto (opcional)

                                       pintarSelect(datos_reqfac, selectInput_reqfac, idField_reqfac, nombreField_reqfac, selectedValue_reqfac,0,1);

                                    }else{
                                       
                                       datos_reqfac = [
                                          { id: 0, nombre: "NO" },
                                          { id: 1, nombre: "SI" },
                                        ];
                                
                                      selectedValue_reqfac = 1; // El valor seleccionado por defecto (opcional)
                                        if (res.estado == "2") {
                                          if(data.fat_reqfactura !=null || data.fat_reqfactura!="-1" || data.fat_reqfactura!=""){
                                            selectedValue_reqfac=data.fat_reqfactura;
                                          }
                                        }
                                        pintarSelect(datos_reqfac, selectInput_reqfac, idField_reqfac, nombreField_reqfac, selectedValue_reqfac,0,0);

                                    }
                                    // REQ FACTURA FIN



                                    ///MONTO A FACTURA INICIO 

                                    if(VAC_ESTATUS_cambiar_estatus=="5"){
                                      $("#fat_montofacturar-cambiar_estatus_exc_general").val("00.00");
                                      $("#fat_montofacturar-cambiar_estatus_exc_general").attr("readonly", true);
                                      $("#fat_montofacturar-cambiar_estatus_exc_general").prop("required", false);


                                     }else{
                                      if (res.estado == "2") {
                                          if(data.fat_montofacturar !=null || data.fat_montofacturar!="-1" || data.fat_montofacturar!=null){
                                            $("#fat_montofacturar-cambiar_estatus_exc_general").val(data.fat_montofacturar);
                                          }
                                        }
                                      $("#fat_montofacturar-cambiar_estatus_exc_general").attr("readonly", false);
                                      $("#fat_montofacturar-cambiar_estatus_exc_general").prop("required", true);


                                     }
                                    ///MONTO A FACTURAR FIN



                                  
                                    // Llamar a la función pintarSelect para llenar el select
                                    if(res.estado=="2"){  
                                     $("#fat_sueldo-cambiar_estatus_exc_general").val(data.fat_sueldo);
                                     $("#fat_fechaingreso-cambiar_estatus_exc_general").val(data.fat_fechaingreso);
                                     $("#fat_motivo-cambiar_estatus_exc_general").val(data.fat_motivo);
                                    }

                                  } catch (error) {
                                    // Manejo de la excepción
                                    swalalertErrorSoporte(error);
                                    console.log(error);
                                    // Realizar acciones adicionales en caso de error
                                  }

                              })
                              .catch(function(error) {
                                  alert(error.responseText);
                              })
                              .finally(function() {  
                                    let url="<?php echo $this->url->get('vacante/ajax_get_detalle_arc_cot/') ?>";
                                     $.ajax({
                                      type: "POST",
                                      url: url+vac_id_cambiar_estatus,
                                      success: function(res)
                                      { 
                                          let data=res.data;
                                          if(res.estado=="2"){
                                              $("#vac_arc-cambiar_estatus_exc_general").hide();
                                          }else{
                                              $("#vac_arc-cambiar_estatus_exc_general").show();
                                          }
                                      },
                                      error: function(res)
                                      { 
                                        alert(res.responseText);      
                                        console.error(res);
                                      }
                                      });       
                               });
          }else{
               $(".row-continua-cambiar_estatus_exc_general").hide();
          }

      });



      let selectElementfat_factor = $("#fat_factor-cambiar_estatus_exc_general");
      let inputElement_fat_sueldo = $("#fat_sueldo-cambiar_estatus_exc_general");
      
      // Agrega un evento 'change' al elemento select
      selectElementfat_factor.on('change', function() {
        // Cuando cambie el select, ejecuta esta función
        // Establece el valor del input con el valor seleccionado del select
        inputElement_fat_sueldo.val(inputElement_fat_sueldo.val());

        // Dispara un evento 'input' en el input para simular la entrada del usuario
        inputElement_fat_sueldo.trigger('input');
      });
   
		$("#form_cambiar_estatus_exc_general").submit(function(event) 
        {
            event.preventDefault();
		        let $form = $(this);  
            let selectsAValidar = [
			    	{ id: "#exc_pregunta-cambiar_estatus_exc_general", name: " ¿Continúa en el proceso? " },
            { id: "#exc_estatus-cambiar_estatus_exc_general", name: " Proceso " },
          ];

           
            //valida input de dif estatus ------------inicio
            
            //estatus faacturacion inicio
            if(exc_estatus_cambiar_estatus=="6"){
            			
              selectsAValidar.push(
                	{ id: "#fat_factor-cambiar_estatus_exc_general", name: " factor " },
                  { id: "#fat_reqfactura-cambiar_estatus_exc_general", name: " Requiere factura " },
              );

              
            }

            //estatus faacturacion fin

            //valida input de dif estatus -----------fin

            let valoresPosiblesNoAceptados = ["-1", "-2"];

            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);

            if (!isValidSelects) {
              return false;
            }
            

            //file inciio
            let file = $("#vac_arc-cambiar_estatus_exc_general")[0].files[0]; // Obtener el archivo seleccionado
            let formData = new FormData($form[0]); // Crear objeto FormData con los datos del formulario
            formData.append("arv", file); // Agregar el archivo al objeto FormData
            //file fin
            let urled="<?php echo $this->url->get('expedientecan/cambiar_estatus/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+exc_id_cambiar_estatus,
              data: formData, // Usar el objeto FormData en la solicitud AJAX
              dataType: 'json',
              contentType: false,
              cache: false,
              processData:false,
              success: function(res)
              { 
                // console.log(res);
              switch (res['estado']) {
                    case 2:
                    //para validar si continua con el proceso el candidato 
                    if(res["no_cotinua_mostrar_agradecimiento"]==false  && EXC_ESTATUS_ACTUAL_cambiar_estatus_general=="4"){ 

                        let tempalte_no_cotinua=`
                        ${res['mensaje']}
                        <br>
                        <div class="container">
                          <div class="row mt-3">
                            <div class="col-md-6">
                              <button type="button" class="btn btn-success btn-block" title="Enviar WhatsApp de agradecimiento" onclick="enviarWhatsAppAgradecimiento_General(${res["candidato"].can_id},${res["vac_id"]})">Enviar WhatsApp de agradecimiento</button>
                            </div>
                            <div class="col-md-6">
                              <button type="button" class="btn btn-info btn-block" title="Enviar correo de agradecimiento" onclick="enviarCorreoAgradecimiento_General_PREGUNTA(${res["candidato"].can_id},${res["vac_id"]})">Enviar Correo de agradecimiento</button>
                            </div>
                          </div>
                        </div>
                        `;
                        swalalertHTML('Cambio de estatus',tempalte_no_cotinua, 0);
                      //para validar si continua con el proceso el candidato  fin 

                    }else{
                        if (res['exc_estatus']=="6") {
                          let tempalte_cotinua_facturacion=`
                          ${res['mensaje']}
                          <br>
                          <div class="container">
                            <div class="row mt-3">
                              <div class="col-md-12">
                                <button type="button" class="btn btn-info btn-block" title="Enviar correo de facturación" onclick="enviarCorreoFacturacion_General_PREGUNTA(${res["candidato"].can_id},${exc_id_cambiar_estatus},${res["vac_id"]})">Enviar Correo de facturación</button>
                              </div>
                            </div>
                          </div>

                          `;
                          swalalertHTML('Cambio de estatus',tempalte_cotinua_facturacion, 0);
                        } else{
                          swalalert('Éxito',res['mensaje'], "success", 0);

                        }
                    }

                    if(callback_cambiar_estatus!=0){

                      if (CONFIG_cambiar_estatus.hasOwnProperty('callbackConVacId')) {//callback con id de vacante
                        callback_cambiar_estatus(res["vac_id"]);

                      }else{
                        callback_cambiar_estatus();

                      }
                      if(CALLBACK_MAIN_TABLA_cambiar_estatus!=0){
                        CALLBACK_MAIN_TABLA_cambiar_estatus();
                      }
                    }else{
                        location.reload();  

                    }
                      //fnCargarTablaCitas(res['vac_id'])
                    $("#cambiar_estatus_exc_general-modal").modal("hide");
                    $form.find("button").prop("disabled", false);
                     
                      break;
                  
                    case -2:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    break;
                    case -1:     
                    if(callback_cambiar_estatus!=0){
                        if (CONFIG_cambiar_estatus.hasOwnProperty('callbackConVacId')) {//callback con id de vacante
                          callback_cambiar_estatus(res["vac_id"]);

                        }else{
                          callback_cambiar_estatus();
                          $form.find("button").prop("disabled", false);
                        }
                     

                    }else{
                        location.reload();  
                    }
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning",0,ocultarMoldalExcEstatusCambiar);
                    $form.find("button").prop("disabled", false);
                    break;
                
                    default:
                    
                      break;
                  }
                
           
                
              },
              error: function(res)
              { 
                alert(res.responseText);
                console.error(res);
               
              }
            });
          
        });
    });
    
</script>




{{  modal.crear("Cambiar  estatus  <span id='cambiar_estatus_exc_general-titulo'><span>", "form_cambiar_estatus_exc_general","cambiar_estatus_exc_general-modal",
[
 {"tamanio":"0","leyenda":"","id":"vac_id-cambiar_estatus_exc_general","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_id-cambiar_estatus_exc_general","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"exc_estatus_actual-cambiar_estatus_exc_general","name":"exc_estatus_actual","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
 {"tamanio":"0","leyenda":"","id":"vac_estatus-cambiar_estatus_exc_general","name":"fat[vac_estatus]","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},

 {"tamanio":"6","leyenda":"¿CONTINÚA EN EL PROCESO?","id":"exc_pregunta-cambiar_estatus_exc_general","name":"exc_pregunta","tipo":"select","required":""  },
 {"tamanio":"6","leyenda":"PROCESO","id":"exc_estatus-cambiar_estatus_exc_general","name":"exc_estatus","tipo":"select","required":""  },

 {"tamanio":"12 row-continua-cambiar_estatus_exc_general","leyenda":"FACTURACIÓN","tipo":"seccion","clase":"seleccionado_candidato-editar_ent_general"},
 {"tamanio":"4 row-continua-cambiar_estatus_exc_general","leyenda":"SUELDO","id":"fat_sueldo-cambiar_estatus_exc_general","name":"fat[fat_sueldo]","tipo":"number","clase":"seleccionado_candidato-editar_ent_general","required":"","complemento":'step=".01"  onchange="limitDecimalPlaces(event,2)" inputmode="numeric"'},
 {"tamanio":"2 row-continua-cambiar_estatus_exc_general","leyenda":"FACTOR","id":"fat_factor-cambiar_estatus_exc_general","name":"fat[fat_factor]","tipo":"select","clase":"seleccionado_candidato-editar_ent_general","required":"","funcion":'onchange=""'},
 {"tamanio":"4 row-continua-cambiar_estatus_exc_general","leyenda":"MONTO FACTURAR","id":"fat_montofacturar-cambiar_estatus_exc_general","name":"fat[fat_montofacturar]","tipo":"number","clase":"seleccionado_candidato-editar_ent_general","required":"","funcion":'onchange=""',"complemento":'step=".01"  onchange="limitDecimalPlaces(event,2)" inputmode="numeric"'},
 {"tamanio":"2 row-continua-cambiar_estatus_exc_general","leyenda":"¿REQUIERE FACTURA?","id":"fat_reqfactura-cambiar_estatus_exc_general","name":"fat[fat_reqfactura]","tipo":"select","clase":"seleccionado_candidato-editar_ent_general","required":"","funcion":'onchange=""',"complemento":''},
 {"tamanio":"12 row-continua-cambiar_estatus_exc_general","leyenda":"FECHA DE INGRESO","id":"fat_fechaingreso-cambiar_estatus_exc_general","name":"fat[fat_fechaingreso]","tipo":"date","clase":"seleccionado_candidato-editar_ent_general","required":"","funcion":'onchange=""'},
 {"tamanio":"12 row-continua-cambiar_estatus_exc_general","leyenda":"COTIZACIÓN","id":"vac_arc-cambiar_estatus_exc_general","name":"arv","tipo":"file","clase":"file-input-wrapper","clase":"seleccionado_candidato-editar_ent_general"},
 {"tamanio":"12 row-continua-cambiar_estatus_exc_general","leyenda":"MOTIVO","id":"fat_observacion-crear_cit_general","name":"fat[fat_observacion]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'},
 
 {"tamanio":"12","leyenda":"COMENTARIO DE SEGUIMIENTO","tipo":"seccion"},
 {"tamanio":"12","leyenda":"COMENTARIO DE SEGUIMIENTO","id":"com_comentario-crear_cit_general","name":"com[com_comentario]","tipo":"textarea","required":"","complemento":'style="min-height:100px"'},
 {"value":"<div class='col-12 mt-5 mb-1 container d-flex justify-content-end seleccionado_candidato-editar_ent_general' id='btn_fat-crear_cit_general'></div>","tipo":"html"}

]
,[{"complementomodal":' tabindex="9"  '}]

)
}}