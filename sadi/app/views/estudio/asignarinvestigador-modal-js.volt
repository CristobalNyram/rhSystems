
 
<script>
function construirURLIframeGoogleMaps() {
    $("#obteniendoRutaDiv_asignar_investigador").remove();
    $("#click_obtener_ruta_asignar_investigador").remove();

    $("#mapaIframeRutaAsignarInvestigador").empty().append(`
        <div id="obteniendoRutaDiv_asignar_investigador" class="row col-12 d-flex justify-content-center text-center h6 text-warning">
            Obteniendo ruta 
            <br>
            <span class="mdi mdi-loading mdi-spin" style="font-size:12px;"></span>
        </div>`
    );
    $(".inv-info-transporte-asigar").show();  
    $("#asignarinv_info_ubicacion_ese").empty();
    $("#asignarinv_info_ubicacion_inv").empty();
    let selectUsuario = document.getElementById("inv_id");
    let opcionSeleccionada = selectUsuario.options[selectUsuario.selectedIndex];
    let munNombreDest = opcionSeleccionada.dataset.municipio_dest ?? '';
    let estNombreDest = opcionSeleccionada.dataset.estado_dest ?? '';
    let estNombreOri = opcionSeleccionada.dataset.estado_ori ?? '';
    let munNombreOri = opcionSeleccionada.dataset.municipio_ori ?? '';
    let usu_adicional = opcionSeleccionada.dataset.usu_adicional ?? '';
    let usu_telefono = opcionSeleccionada.dataset.usu_telefono ?? '';
    let usu_correo = opcionSeleccionada.dataset.usu_correo ?? '';
    let usu_celular = opcionSeleccionada.dataset.usu_celular ?? '';

    $("#asignarinv_info_inv_cel").text(usu_celular !== "" ? usu_celular : "Sin asignar");
    $("#asignarinv_info_inv_tel").text(usu_telefono !== "" ? usu_telefono : "Sin asignar");
    $("#asignarinv_info_inv_correo").text(usu_correo !== "" ? usu_correo : "Sin asignar");
    $("#asignarinv_info_inv_est").text(estNombreOri !== "" ? estNombreOri : "Sin asignar");
    $("#asignarinv_info_inv_mun").text(munNombreOri !== "" ? munNombreOri : "Sin asignar");
    $("#asignarinv_info_inv_adicional").text(usu_adicional !== "" ? usu_adicional : "Sin asignar");

    if (estNombreDest !== "") {
        let urlUbicacionDest = 'https://www.google.com/maps/dir/' + (estNombreDest ?? '') + (munNombreDest ? ',' + munNombreDest : '') + '/';
        let clickBtnUbicacionDest = `
            '<button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open(\'${urlUbicacionDest}\', \'_blank\')">Ubicación estudio</button>'
        `;
        $("#asignarinv_info_ubicacion_ese").html(clickBtnUbicacionDest);
    }

    if (estNombreOri !== "") {
        let urlUbicacionOri = 'https://www.google.com/maps/dir/' + (estNombreOri ?? '') + (munNombreOri ? ',' + munNombreOri : '') + '/';
        let clickBtnUbicacionOri = `
            '<button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open(\'${urlUbicacionOri}\', \'_blank\')">Ubicación investigador</button>'
        `;
        $("#asignarinv_info_ubicacion_inv").html(clickBtnUbicacionOri);
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

        $("#mapaIframeRutaAsignarInvestigador").empty().append(newMapIframe);

        $("#mapaIframeRutaAsignarInvestigador").after(`
            <button type="button" id="click_obtener_ruta_asignar_investigador" class="btn btn-primary mt-3" onclick="window.open('${urlClick}', '_blank')">Ir a la ruta</button>
        `);

        newMapIframe.onerror = function() {
            $("#mapaIframeRutaAsignarInvestigador").empty().html('<h1>Error al cargar el mapa</h1>');
        };
        newMapIframe.onload = function() {
            $("#obteniendoRutaDiv_asignar_investigador").remove();
            $("#mapaIframeRutaAsignarInvestigador").show();
        };
        $("#obteniendoRutaDiv_asignar_investigador").remove();
    } else {    
        // #$("#obteniendoRutaDiv_asignar_investigador").remove();
        // $("#click_obtener_ruta_asignar_investigador").remove();
        $("#obteniendoRutaDiv_asignar_investigador").remove();
    }
}

  function fninvestigador(ese_id,tipo_estudio){
    $("#ese_idasignar").val(ese_id);
    //resetear el formulario inicio
    $('#frm_asignarinvestigador')[0].reset();
    $("#obteniendoRutaDiv_asignar_investigador").remove();
    $("#click_obtener_ruta_asignar_investigador").remove();
    $("#asignarinv_info_ubicacion_ese").empty();
    $("#asignarinv_info_ubicacion_inv").empty();
    $("#asignarinv_info_inv_cel").text("");
    $("#asignarinv_info_inv_tel").text("");
    $("#asignarinv_info_inv_correo").text("");
    $("#asignarinv_info_inv_est").text("");
    $("#asignarinv_info_inv_mun").text("");
    $("#asignarinv_info_inv_adicional").text("");
    let mapaIframe = document.getElementById("mapaIframeRutaAsignarInvestigador");
    $("#mapaIframeRutaAsignarInvestigador").hide();

    mapaIframe.src ="";
    mapaIframe.width = null;
    mapaIframe.height = null;
    $('#ese_transporte_estatus').prop("checked",false);
    $('#input_tranporte_min_row').hide();
    //resetear el formulario fin

        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

						$.ajax({
								type: "POST",
								url: url_enviar_ese_data+ese_id,
								success: function(res)
								{
                  if(res[0].ese_estatus=='-2' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
                  }  
                  if(res[0].ese_estatus!='1' ){

                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                      });
                  }  
                  //console.log(res);
                  fngetinvestigadores(tipo_estudio,res[0].est_id,res[0].mun_id,res[0].est_nombre,res[0].mun_nombre);
                  $("#asignar_inv_est_id").val(res[0].est_nombre);
                  $("#asignar_inv_mun_id").val(res[0].mun_nombre);

              
									if(res.length>0){
										let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                    $('#asignarinvestigador_titulo_ese_id').html(ese_id+mensaje_empresa_candidato);
									}
									//alert();
								
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

  function fngetinvestigadores(tipo_estudio,est_id=0,mun_id=0,est_nombre_dest="",mun_nombre_dest="")
  {
      $(".inv-info-transporte-asigar").hide();
      est_id = est_id || 0;
      mun_id = mun_id || 0;
      let negocio="<?php echo $this->url->get('investigador/ajax_getall_cercanos_ruta/') ?>";
      let $subsnegocio = $('select[name="inv_id"]');
      $subsnegocio.empty();
      $.ajax({
          type: "POST",
          url: negocio+tipo_estudio+"/"+est_id+"/"+mun_id,
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
 

$(document).ready(()=>{


    //document.getElementById("inv_id").addEventListener("change", construirURLIframeGoogleMaps);


   $('#inv_id').on("change",function(){
    let transporte=$(this).find(':selected').data('transporte');
    $('#ese_transporte_estatus').prop("checked",false);
    $('#input_tranporte_min_row').hide();
    ese_transporte_estatus_val.value=1;

    if(transporte==1){
      $('#activar_transporte').show();
    }else{
      $('#activar_transporte').hide();
    }
  });

    $("#frm_asignarinvestigador").submit(function(event) 
    {
      if($("#inv_id").val()==-1){
        alertify.alert("Error","Debe seleccionar el investigador.")
        return false;
      }
      var $form = $(this);
      var urled="<?php echo $this->url->get('estudio/ajax_setasignarinvestigador/') ?>";
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      $.ajax({
        type: "POST",
        url: urled,
        data: $("#frm_asignarinvestigador").serialize(),
        success: function(res)
        {


        
          if(res[0]<=0)
          {  
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                            .then((value) => {               
                                location.reload();  

                             });

          }
          else
          { 
         
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                 .then((value) => {
                                    location.reload();  

                                  });
          }
        
        },
        error: function(res)
        { 
          $form.find("button").prop("disabled", false); 
        }
      });
      return false;
      });


  
    //funciones para validar si se a selecionado algun option del select
    
    //funciones para poder validar el check de que si tendra transporte asignado
    let check_ese_transporte=document.getElementById('ese_transporte_estatus');
    
    check_ese_transporte.addEventListener("change", validaCheckbox, false);
    function validaCheckbox()
    {
      
      let investigador_id_selecionado = $('select[name="inv_id"]').val();
      var checked = check_ese_transporte.checked;
      let  ese_transporte_estatus_val =document.getElementById('ese_transporte_estatus_val');
      let tra_preaprobado_value =document.getElementById('tra_preaprobado');

      if(investigador_id_selecionado!=-1)
      {
                if(checked)
                { 
                document.getElementById('tra_preaprobado').value=20;


                $('#input_tranporte_min_row').show();
                ese_transporte_estatus_val.value=2;
                
                }
                if(checked==false)
                {
                $('#ese_transporte_estatus').prop("checked",false);
                $('#input_tranporte_min_row').hide();
                ese_transporte_estatus_val.value=1;

                }

      }
        //en caso de que no este seleccionado ningun investigador el check no cambia de estado y cambia un mensaje de error
        if(investigador_id_selecionado==-1)
        {
            alertify.alert('FALTAN DATOS','Para poder asignar un honorario de transporte debe seleccionar a que investigador al que le va asignar el transporte.');
            $('#ese_transporte_estatus').prop("checked",false);
            $('#input_tranporte_min_row').hide();
            ese_transporte_estatus_val.value=1;
        }


    }

      });
    
     }

</script>

<div class="modal fade" id="asignarinvestigador-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
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
						Asignar investigador al estudio con folio
						<span id="asignarinvestigador_titulo_ese_id"></span>
					</div>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div
				class="modal-body">
				<!-- //contenido -->
				<form id="frm_asignarinvestigador" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
					<div class="form-group row">
						<div class=" col-md-12">
							<div class="mt-1">
								<span class="font-16 btn-link-crm">Ubicación del estudio</span>
							</div>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Estado</label>
							<input type="text" readonly class="form-control input-rounded" id="asignar_inv_est_id" placeholder="Estado del estudio."/>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Municipio</label>
							<input type="text" readonly class="form-control input-rounded" id="asignar_inv_mun_id" placeholder="Municipio del estudio."/>
						</div>
						<div class="mt-3 col-md-12">
							<div class="mt-1">
								<span class="font-16 btn-link-crm">Datos investigador </span>
							</div>
						</div>
						<hr>
						<input type="hidden" id="ese_idasignar" name="ese_idasignar"/>
						<div class="col-lg-8">
							<label class="col-form-label title-busq">Investigador</label>
							<select name="inv_id" id="inv_id" class="form-control select2-single " onchange="construirURLIframeGoogleMaps()" data-toggle="select2" data-placeholder="Seleccionar ..."></select>
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
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="asignarinv_info_inv_tel" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;">
							<label class="col-form-label title-busq">Cel.</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="asignarinv_info_inv_cel" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;">
							<label class="col-form-label title-busq">Correo</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="asignarinv_info_inv_correo" ></label>

						</div>
            <div class="col-lg-3 inv-info-transporte-asigar" style="display:none;" >
							<label class="col-form-label title-busq">Contacto adicional</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="asignarinv_info_inv_adicional" ></label>

						</div>
						
            <div class="col-lg-6 inv-info-transporte-asigar" style="display:none;" >
              <label class="col-form-label title-busq " id="">Estado</label>
              <br>
							<label class="col-form-label title-busq font-weight-bold text-dark" style="font-size:14px;" id="asignarinv_info_inv_est"></label>

						</div>
            <div class="col-lg-6 inv-info-transporte-asigar" style="display:none;" >
							<label class="col-form-label title-busq ">Municipio</label>
              <br>
              <label class="col-form-label title-busq font-weight-bold text-dark"   style="font-size:14px;" id="asignarinv_info_inv_mun" >Municipio</label>
						</div>
						
           
            {# datos investigador fin  #}


						<div class="col-lg-12" style="display:none ;" id="input_tranporte_min_row">
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

								<textarea maxlength="2000" style="height: 100px;" type="text" class="form-control-textarea text_area_a" placeholder="Comentario/Nota..." name="tra_comentario_admin" id="tra_comentario_admin" onkeyup="actualizaInfo(2000,'tra_comentario_admin', 'label_com_tra_comentario_admin')" oninput="handleInput(event)"></textarea>
							</div>

						</div>
					</div>

					<div class="form-group row" id="mapaIframeRutaAsignarInvestigador">
					</div>


          <div class="form-group row col-12 d-flex justify-content-center">
                <div id="asignarinv_info_ubicacion_inv">
                </div>

                <div id="asignarinv_info_ubicacion_ese">
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

  
  
  