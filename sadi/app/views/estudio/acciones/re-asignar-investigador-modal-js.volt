
 
<script>
function construirURLIframeGoogleMaps_ReAsignarInvestigador() {
    $("#obteniendoRutaDiv_asignar_investigador").remove();
    $("#click_obtener_ruta_asignar_investigador").remove();
    $("#mapaIframeRutaReAsignarInvestigador").hide();

    $("#mapaIframeRutaReAsignarInvestigador").before(`
        <div id="obteniendoRutaDiv_asignar_investigador" class="row col-12 d-flex justify-content-center text-center h6 text-warning">
            Obteniendo ruta 
            <br>
            <span class="mdi mdi-loading mdi-spin" style="font-size:12px;"></span>
        </div>`
    );
    $(".inv-info-transporte-asigar").show();  
    $("#re_asignarinv_info_ubicacion_ese").empty();
    $("#re_asignarinv_info_ubicacion_inv").empty();
    let selectUsuario = document.getElementById("re_asignarinv_inv_id");
    let mapaIframe = document.getElementById("mapaIframeRutaReAsignarInvestigador");
    mapaIframe.src = "";
    mapaIframe.width = null;
    mapaIframe.height = null;
    let opcionSeleccionada = selectUsuario.options[selectUsuario.selectedIndex];
    let munNombreDest = opcionSeleccionada.dataset.municipio_dest ?? '';
    let estNombreDest = opcionSeleccionada.dataset.estado_dest ?? '';
    let estNombreOri = opcionSeleccionada.dataset.estado_ori ?? '';
    let munNombreOri = opcionSeleccionada.dataset.municipio_ori ?? '';
    let usu_adicional = opcionSeleccionada.dataset.usu_adicional ?? '';
    let usu_telefono = opcionSeleccionada.dataset.usu_telefono ?? '';
    let usu_correo = opcionSeleccionada.dataset.usu_correo ?? '';
    let usu_celular = opcionSeleccionada.dataset.usu_celular ?? '';

    $("#re_asignarinv_info_inv_cel").text(usu_celular !== "" ? usu_celular : "Sin asignar");
    $("#re_asignarinv_info_inv_tel").text(usu_telefono !== "" ? usu_telefono : "Sin asignar");
    $("#re_asignarinv_info_inv_correo").text(usu_correo !== "" ? usu_correo : "Sin asignar");
    $("#re_asignarinv_info_inv_est").text(estNombreOri !== "" ? estNombreOri : "Sin asignar");
    $("#re_asignarinv_info_inv_mun").text(munNombreOri !== "" ? munNombreOri : "Sin asignar");
    $("#re_asignarinv_info_inv_adicional").text(usu_adicional !== "" ? usu_adicional : "Sin asignar");

    if (estNombreDest !== "") {
        let urlUbicacionDest = 'https://www.google.com/maps/dir/' + (estNombreDest ?? '') + (munNombreDest ? ',' + munNombreDest : '') + '/';
        let clickBtnUbicacionDest = `
            <button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open('${urlUbicacionDest}', '_blank')">Ubicación estudio</button>
        `;
        $("#re_asignarinv_info_ubicacion_ese").html(clickBtnUbicacionDest);
    }

    if (estNombreOri !== "") {
        let urlUbicacionOri = 'https://www.google.com/maps/dir/' + (estNombreOri ?? '') + (munNombreOri ? ',' + munNombreOri : '') + '/';
        let clickBtnUbicacionOri = `
            <button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open('${urlUbicacionOri}', '_blank')">Ubicación investigador</button>
        `;
        $("#re_asignarinv_info_ubicacion_inv").html(clickBtnUbicacionOri);
    }

    if (estNombreOri && estNombreDest) {
        let urlClick = 'https://www.google.com/maps/dir/' + estNombreOri + (munNombreOri ? ',' + munNombreOri : '') + '/' + estNombreDest + (munNombreDest ? ',' + munNombreDest : '');
        let url = 'https://www.google.com/maps/embed/v1/directions?key=AIzaSyBq-hes4CKM-bd4EV-Y60zmUPUa9hlTHFk&origin=' + estNombreOri + (munNombreOri ? ',' + munNombreOri : '') + '&destination=' + estNombreDest + (munNombreDest ? ',' + munNombreDest : '');

        let newMapIframe = document.createElement('iframe');
        newMapIframe.src = url;
        newMapIframe.width = "100%";
        newMapIframe.height = "300px";
        newMapIframe.setAttribute('frameborder', '0');
        newMapIframe.setAttribute('allowfullscreen', '');

        $("#mapaIframeRutaReAsignarInvestigador").empty().append(newMapIframe);

        $("#mapaIframeRutaReAsignarInvestigador").after(`
            <button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open('${urlClick}', '_blank')">Ir a la ruta</button>
        `);

        newMapIframe.onerror = function() {
            $("#mapaIframeRutaReAsignarInvestigador").empty().html('<h1>Error al cargar el mapa</h1>');
        };

        newMapIframe.onload = function() {
            $("#obteniendoRutaDiv_asignar_investigador").remove();
            $("#mapaIframeRutaReAsignarInvestigador").show();
        };

    } else {    
        $("#obteniendoRutaDiv_asignar_investigador").remove();
    }
}

  function fnReAsignarInvestigador(ese_id,tipo_estudio){
    // console.log(ese_id);
    
    $("#ese_id_re_asignar").val(ese_id);
    //resetear el formulario inicio
    $('#frm_re_asignarinvestigador')[0].reset();
    $("#obteniendoRutaDiv_re_asignar_investigador").remove();
    $("#click_obtener_ruta_re_asignar_investigador").remove();
    $("#re_asignarinv_info_ubicacion_ese").empty();
    $("#re_asignarinv_info_ubicacion_inv").empty();
    $("#re_asignarinv_info_inv_cel").text("");
    $("#re_asignarinv_info_inv_tel").text("");
    $("#re_asignarinv_info_inv_correo").text("");
    $("#re_asignarinv_info_inv_est").text("");
    $("#re_asignarinv_info_inv_mun").text("");
    $("#re_asignarinv_info_inv_adicional").text("");
    let mapaIframe = document.getElementById("mapaIframeRutaReAsignarInvestigador");
    $("#mapaIframeRutaReAsignarInvestigador").hide();
    // mapaIframe.src ="";
    // mapaIframe.width = null;
    // mapaIframe.height = null;
    $('#ese_transporte_estatus').prop("checked",false);
    $('#input_tranporte_min_row-re_asignar_investigador').hide();
    
    //resetear el formulario fin
        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

						$.ajax({
								type: "POST",
								url: url_enviar_ese_data+ese_id,
								success: function(res)
								{
                  // console.log(res);
                  // datos investigador asignado INICIO
                  $("#re_asignar_inv_nombre_actual").val(res[0].inv_nombre);
                  $("#re_asignar_inv_correo_actual").val(res[0].inv_correo);
                  // datos investigador asignado FIN
                  let tipo_estudio=res[0].tip_id;
                  // console.log(tipo_estudio);

                  fngetinvestigadores_ReasignarInvestigador(tipo_estudio,res[0].est_id,res[0].mun_id,res[0].est_nombre,res[0].mun_nombre,res[0].inv_id);

                  // datos de estudio INICIO
                  $("#re_asignar_inv_est_id").val(res[0].est_nombre);
                  $("#re_asignar_inv_mun_id").val(res[0].mun_nombre);
                  // datos de estudio FIN

                  
									if(res.length>0){
										let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                    $('#re_asignarinvestigador_titulo_ese_id').html(ese_id+mensaje_empresa_candidato);
									}
								
								},
								error: function(data)
								{
									alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
									
								}
							});


  }

function esValido(value) {
    return typeof value !== "undefined" && parseInt(value) > 0;
}
function ordenamientoPorEstadoMunicipio(estId, munId) {
    return function (a, b) {
        function esValido(value) {
            return typeof value !== "undefined" && parseInt(value) > 0;
        }

        if (esValido(estId) && a.est_id === estId && b.est_id !== estId) {
            return -1;
        } else if (esValido(estId) && a.est_id !== estId && b.est_id === estId) {
            return 1;
        }

        if (esValido(estId) && esValido(munId) && a.est_id === estId && b.est_id === estId && a.mun_id === munId && b.mun_id !== munId) {
            return -1;
        } else if (esValido(estId) && esValido(munId) && a.est_id === estId && b.est_id === estId && a.mun_id !== munId && b.mun_id === munId) {
            return 1;
        }

        return 0;
    };
}

  function fngetinvestigadores_ReasignarInvestigador(tipo_estudio,est_id=0,mun_id=0,est_nombre_dest="",mun_nombre_dest="",inv_id_actual=0)
  {
      $(".inv-info-transporte-asigar").hide();
      est_id = est_id || 0;
      mun_id = mun_id || 0;
      let negocio="<?php echo $this->url->get('investigador/ajax_getall_cercanos_ruta/') ?>";
      let url=negocio+tipo_estudio+"/"+est_id+"/"+mun_id+"/"+inv_id_actual;
      // console.log(url);
      let $subsnegocio = $('select[id="re_asignarinv_inv_id"]');
      $subsnegocio.empty();
      $.ajax({
          type: "POST",
          url: url,
          success: function(res)
          {
           
            let data=res.data;
            if (data.length > 0) {
            
              let dataOrdenada=data.sort(ordenamientoPorEstadoMunicipio(est_id, mun_id));
              
              let init_opcion = '<option selected value="-1">Seleccionar</option>';
              $subsnegocio.append(init_opcion);
              $.each(dataOrdenada, function (index, dat) {
                    let optionText = dat.nombre;
                    let mun_nombre="";
                    let est_nombre="";
                    let usu_correo="";
                    let usu_telefono="";
                    let usu_adicional="";
                    let usu_celular="";

                      if (dat.est_nombre && dat.est_nombre.trim) {
                          optionText += ' - ' + dat.est_nombre.trim();
                          est_nombre = dat.est_nombre.trim();
                      }

                      if (dat.mun_nombre && dat.mun_nombre.trim) {
                          optionText += ' - ' + dat.mun_nombre.trim();
                          mun_nombre = dat.mun_nombre.trim();
                      }

                      if (dat.usu_telefono && dat.usu_telefono.trim) {
                          usu_telefono = dat.usu_telefono.trim();
                      }
                      if (dat.usu_celular && dat.usu_celular.trim) {
                          usu_celular = dat.usu_celular.trim();
                      }

                      if (dat.usu_correo && dat.usu_correo.trim) {
                          usu_correo = dat.usu_correo.trim();
                      }

                      if (dat.usu_adicional && dat.usu_adicional.trim) {
                          usu_adicional = dat.usu_adicional.trim();
                      }
                
                      let option = `
                          <option
                              data-estado_dest="${est_nombre_dest}"
                              data-municipio_dest="${mun_nombre_dest}"
                              data-municipio_ori="${mun_nombre}"
                              data-estado_ori="${est_nombre}"
                              data-usu_correo="${usu_correo}"
                              data-usu_adicional="${usu_adicional}"
                              data-usu_celular="${usu_celular}"
                              data-usu_telefono="${usu_telefono}"
                              data-transporte="${dat.usu_transporte}"
                              value="${dat.usu_id}"
                          >
                              ${optionText}
                          </option>
                      `;
                    $subsnegocio.append(option);
              });

            }else{
              $subsnegocio.append(function () {
                  var options = '';
                  options += '<option selected value="-1">No aplica</option>';
                  return options;
              });
            }
          },
          error: function(res)
          {
              // $("#btn_aprobar").prop("disabled", false);
          }
          
      }
    
);

}



// CHEBOXK INICIO 
$(document).ready(() => {
  // Variables de elementos del DOM
  const invIdSelect = $('#re_asignarinv_inv_id');
  const transporteEstatus = $('#ese_transporte_estatus');
  const transporteEstatusVal = $('#ese_transporte_estatus_val');
  const transporteMinRow = $('#input_tranporte_min_row-re_asignar_investigador');
  const activarTransporte = $('#activar_transporte');
  const formAsignarInvestigador = $("#frm_re_asignarinvestigador");

  invIdSelect.on("change", function() {
    let transporte = $(this).find(':selected').data('transporte');
    transporteEstatus.prop("checked", false);
    transporteMinRow.hide();
    transporteEstatusVal.val(1);

    if (transporte == 1) {
      activarTransporte.show();
    } else {
      activarTransporte.hide();
    }
  });

  formAsignarInvestigador.submit(function(event) {
    // console.log("subbmit");
    event.preventDefault();
    if (invIdSelect.val() == -1) {
      alertify.alert("Error", "Debe seleccionar el investigador.");
      return false;
    }
    let $form = $(this);
    let url = "<?php echo $this->url->get('estudio/ajax_setreasignarinvestigador/') ?>";
    let isValid = $form.valid();
    if (!isValid) {
      return false;
    }
    // console.log(url);
    $form.find("button").prop("disabled", true);
    $.ajax({
      type: "POST",
      url: url,
      data: $form.serialize(),
      success: function(res) {
        switch (res.estatus) {
            case 2:
            case "2":
                swalalert(res['titular'], res['mensaje'], "success", 1  );
                $form.find("button").prop("disabled", true);
                break; 
            case -2:
            case "-2":
                swalalertHTML(res["titular"], `${res['mensaje']} <br> <span class=></span> `, "error", 1);
                break;
            case -1:
                swalalertHTML(res["titular"], `${res['mensaje']} <br> <span class=></span> `, "warning");
                $form.find("button").prop("disabled", false);
                break; 
            default:
                break;
        }

      },
      error: function(res) {
        // console.log(res.responseText);
        $form.find("button").prop("disabled", true);
      }
    });
    return false;
  });

  // Función para validar el checkbox de transporte
  transporteEstatus.on("change", validaCheckbox);

  function validaCheckbox() {
    let investigadorIdSeleccionado = invIdSelect.val();
    let checked = transporteEstatus.prop("checked");

    if (investigadorIdSeleccionado != -1) {
      if (checked) {
        $('#tra_preaprobado').val(20);
        transporteMinRow.show();
        transporteEstatusVal.val(2);
      } else {
        transporteEstatus.prop("checked", false);
        transporteMinRow.hide();
        transporteEstatusVal.val(1);
      }
    } else {
      alertify.alert('FALTAN DATOS', 'Para poder asignar un honorario de transporte debe seleccionar a qué investigador se le asignará.');
      transporteEstatus.prop("checked", false);
      transporteMinRow.hide();
      transporteEstatusVal.val(1);
    }
  }
});
// CHECKBOX FIN
</script>

<div class="modal fade" id="re_asignarinvestigador-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog detalle modal-dialog-scrollable">
		<div
			class="modal-content">
			<!-- <div class="col-md-12 col-sm-12 col-xs-12">
			          <div class="x_panel">
			   -->
			<div class="modal-header">
				<h5>
					<div id="msae_recibo">
						<i class="mdi mdi-worker"></i>
						Reasignar investigador al estudio con folio
						<span id="re_asignarinvestigador_titulo_ese_id"></span>
					</div>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div
				class="modal-body">
				<!-- //contenido -->
				<form id="frm_re_asignarinvestigador" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
          

          
					<div class="form-group row">
            <div class=" col-md-12">
							<div class="mt-1">
								<span class="font-16 btn-link-crm">Investigador actual asignado</span>
							</div>
						</div>
						<div class="col-lg-6">
							<label class="col-form-label title-busq">Nombre</label>
							<input type="text" readonly class="form-control input-rounded" id="re_asignar_inv_nombre_actual" placeholder="Nombre investigador."/>
						</div>
            <div class="col-lg-6">
							<label class="col-form-label title-busq">Correo</label>
							<input type="text" readonly class="form-control input-rounded" id="re_asignar_inv_correo_actual" placeholder="Nombre investigador."/>
						</div>
			

						<div class=" col-md-12">
							<div class="mt-5">
								<span class="font-16 btn-link-crm">Ubicación del estudio</span>
							</div>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Estado</label>
							<input type="text" readonly class="form-control input-rounded" id="re_asignar_inv_est_id" placeholder="Estado del estudio."/>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Municipio</label>
							<input type="text" readonly class="form-control input-rounded" id="re_asignar_inv_mun_id" placeholder="Municipio del estudio."/>
						</div>
						<div class="mt-3 col-md-12">
							<div class="mt-1">
								<span class="font-16 btn-link-crm">Datos investigador </span>
							</div>
						</div>
						<hr>
						<input type="hidden" id="ese_id_re_asignar" name="ese_id"/>
						<div class="col-lg-8">
							<label class="col-form-label title-busq">Investigador</label>
							<select name="inv_id" id="re_asignarinv_inv_id" class="form-control select2-single " onchange="construirURLIframeGoogleMaps_ReAsignarInvestigador()" data-toggle="select2" data-placeholder="Seleccionar ..."></select>
						</div>


						<div class="col-3">
							<label class="col-form-label title-busq" title="Puedes activar o desactivar el estatus, solo necesitas hacer clic en el botón." data-toggle="tooltip">Asignar transporte</label>
							<!-- Checkbox -->
							<!-- Botón -->
							<br>
							<div class="switch-button" id="activar_transporte">
								<input type="checkbox" name="ese_transporte_estatus" id="ese_transporte_estatus" class="switch-button__checkbox" title="Puedes activar o desactivar el estatus, solo necesitas hacer clic en el botón." data-toggle="tooltip">
								<label for="ese_transporte_estatus" class="switch-button__label" title="Puedes activar o desactivar el estatus, solo necesitas hacer clic en el botón." data-toggle="tooltip"></label>
								<input type="hidden" name="ese_transporte_estatus_val" id="ese_transporte_estatus_val" value="1" title="Puedes activar o desactivar el estatus." data-toggle="tooltip">
							</div>
						</div>

            {# datos investigador inicio #}
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;">
							<label class="col-form-label title-busq">Tel.</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="re_asignarinv_info_inv_tel" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;">
							<label class="col-form-label title-busq">Cel.</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="re_asignarinv_info_inv_cel" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;">
							<label class="col-form-label title-busq">Correo</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="re_asignarinv_info_inv_correo" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;" >
							<label class="col-form-label title-busq">Contacto adicional</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="re_asignarinv_info_inv_adicional" ></label>

						</div>
						
            <div class="col-lg-6 inv-info-transporte-asigar" style="display:none;" >
              <label class="col-form-label title-busq " id="">Estado</label>
              <br>
							<label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="re_asignarinv_info_inv_est"></label>

						</div>
            <div class="col-lg-6 inv-info-transporte-asigar" style="display:none;" >
							<label class="col-form-label title-busq ">Municipio</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark"   style="font-size:14px;" id="re_asignarinv_info_inv_mun" >Municipio</label>
						</div>
						
           
            {# datos investigador fin  #}


						<div class="col-lg-12" style="display:none ;" id="input_tranporte_min_row-re_asignar_investigador">
							<div class="col-lg-4">
								<label class="col-form-label title-busq">Transporte
									<i class="mdi mdi-car"></i>
								</label>
								<input type="number" class="form-control input-rounded" oninput="limitDecimalPlaces(event, 2)" name="tra_preaprobado" id="tra_preaprobado" placeholder="($)..."/>
							</div>
							<div class="col-lg-12">
								<label class="col-form-label title-busq" for="tra_comentario_admin">Comentario del transporte<i class="mdi mdi-map-plus"></i>
								</label>
								<label class="col-form-label title-busq" id="label_com_tra_comentario_admin"></label>

								<textarea maxlength="2000" style="height: 100px;" type="text" class="form-control-textarea text_area_a" placeholder="Comentario/Nota..." name="tra_comentario_admin" id="tra_comentario_admin-re_asignarinv" onkeyup="actualizaInfo(2000,'tra_comentario_admin-re_asignarinv', 'label_com_tra_comentario_admin')" oninput="handleInput(event)"></textarea>
							</div>

						</div>
					</div>

					<div class="form-group row"  id="mapaIframeRutaReAsignarInvestigador" >
					</div>


          <div class="form-group row col-12 d-flex justify-content-center">
                <div id="re_asignarinv_info_ubicacion_inv">
                </div>

                <div id="re_asignarinv_info_ubicacion_ese">
                </div>

					</div>


					<div class="row col-lg-12">
						<div class="col-sm-6 col-md-6 text-center mt-5"></div>
						<div class="col-sm-3 col-md-3 text-center mt-5">
							<div class="form-group">
								<button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
							</div>
						</div>


						<div class="col-sm-3 col-md-3  text-center mt-5 ">
							<div class="form-group">
								<button type="submit" class="btn-dark btn-rounded btn btn-buscar">Aceptar
									<i class="mdi mdi-check-bold"></i>
								</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

  
  
  