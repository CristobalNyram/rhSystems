{{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}
{% include "/reporte/transporte_index_scripts_js.volt" %}
<div class="row">
	<div class="col-6">
		<h4 class="header-title header-title-crm">Transportes</h4>
	</div>
	<div class="col-6">
		<div class="text-right"></div>
	</div>
</div>
<div class="mt-3">
	<div class="card card-crm">
		<div id="busqueda" name="busqueda">
			{% if acceso.verificar(93,rol_id)==1 %}
				<form id="form_reporte_transporte" class="form-vertical col-md-12 row">
					<div class="col-lg-12">
						<div class="form-horizontal row">
							<div class="text-center col-md-12">
								<div class="mt-1">
									<span class="font-16 btn-link-crm">Información estudio</span>
								</div>
							</div>
							<div class="col-lg-6 " id="fecha_entrega_cliente_div">
								<label class="col-form-label  title-busq">Fecha entrega cliente ESE
									<i class="mdi mdi-account-multiple-minus-outline mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="ese_fechaentregacliente_f_inicial" name="ese_fechaentregacliente_f_inicial" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="ese_fechaentregacliente_f_final" name="ese_fechaentregacliente_f_final" class="form-control bar-right" placeholder="Hasta"/>
									</div>

								</div>
							</div>

							<div class="col-lg-6 " id="fecha_entrega_cliente_div">
								<label class="col-form-label  title-busq">Fecha comprobación de investigador
									<i class="mdi mdi-account-multiple-minus-outline mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="tra_fechainvestigador_f_inicial" name="tra_fechainvestigador_f_inicial" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="tra_fechainvestigador_f_final" name="tra_fechainvestigador_f_final" class="form-control bar-right" placeholder="Hasta"/>
									</div>
								</div>
							</div>
							<div class="col-lg-6 " id="fecha_entrega_cliente_div">
								<label class="col-form-label  title-busq">Fecha aprobación  de transporte<i class="mdi mdi-account-multiple-minus-outline mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="tra_fechaaprobado_f_inicial" name="tra_fechaaprobado_f_inicial" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="tra_fechaaprobado_f_final" name="tra_fechaaprobado_f_final" class="form-control bar-right" placeholder="Hasta"/>
									</div>
								</div>
							</div>
							<div class="col-lg-6 " id="fecha_entrega_cliente_div">

								<label class="col-form-label  title-busq">Fecha registro transporte
									<i class="mdi mdi-account-multiple-minus-outline mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="tra_registro_f_inicial" name="tra_registro_f_inicial" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="tra_registro_f_final" name="tra_registro_f_final" class="form-control bar-right" placeholder="Hasta"/>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Estatus estudio
									<i class="mdi mdi-checkbox-multiple-marked-circle mdi-18px btn-icon"></i>
								</label>
								<select name="ese_estatus" id="ese_estatus" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">Todos</option>
									<option value="7">Aprobados</option>
									<option value="-2">Cancelados</option>
									<option value="1">Inicial</option>
									<option value="2">En campo</option>
									<option value="3">En campo
									</option>
									<option value="4">En revisión
									</option>
									<option value="5">En revisión A</option>
									<option value="7">Validados</option>
									<option value="8">No aprobados</option>
								</select>
							</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Estudio ID
									<i class="mdi mdi-numeric mdi-18px btn-ico"></i>
								</label>
								<input id="ese_id" name="ese_id" oninput="soloNumeroPositivosV2(event)" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="ID"/>
							</div>
						<div class="col-lg-3 " id="tipo_estudio_div">
							<label class="col-form-label title-busq">Tipo de estudio <i class="mdi mdi-checkbox-intermediate"></i></label>
							<select name="tip_id" id="tip_id" data-toggle="select2" class="form-control select2-multiple">
								<option value="-1">Todos</option>
								{% for tipoEstudio in tipoEstudios %}
								<option value="{{tipoEstudio.tip_id}}" >{{tipoEstudio.tip_nombre}}</option>
								{% endfor %}
				
							</select>
						</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Empresa
									<i class="mdi mdi-office-building mdi-18px btn-icon"></i>
								</label>
								<select name="emp_id" id="emp_id" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">Todos</option>
									{% for emp in empresaselect %}
										<option value="{{emp.emp_id}}" {% if indexemp== emp.emp_id%} selected {% endif %}>{{emp.emp_nombre}}</option>
									{% endfor %}
								</select>
							</div>
							<hr>
							<div class="text-center col-md-12 mt-2">
								<div class="mt-1">
									<span class="font-16 btn-link-crm">Información transporte</span>
								</div>
							</div>

							<div class="col-lg-4">
								<label class="col-form-label title-busq">Usuario que aprobó
									<i class="mdi mdi-account-check mdi-18px btn-ico"></i>
								</label>
								<select name="aprobadousu_id" id="aprobadousu_id" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for inv in investigadorselect %}
										<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
										</option>
									{% endfor %}
								</select>
							</div>
							<div class="col-lg-4">
								<label class="col-form-label title-busq">Usuario  que asignó
									<i class="mdi mdi-account-convert mdi-18px btn-ico"></i>
								</label>
								<select name="asignausu_id" id="asignausu_id" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for inv in investigadorselect %}
										<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
										</option>
									{% endfor %}
								</select>
							</div>


							<div class="col-lg-4">
								<label class="col-form-label title-busq">Investigador
									<i class="mdi mdi-account mdi-18px btn-ico"></i>
								</label>
								<select name="investigadorusu_id" id="investigadorusu_id" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for inv in investigadorselect %}
										<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
										</option>
									{% endfor %}
								</select>
							</div>

							<div class="col-lg-3">
								<label class="col-form-label title-busq">Estado origen
									<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
								</label>
								<select name="tra_est_id_ori" id="tra_est_id_ori" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios_adaptable($('#tra_mun_id_ori'),event.target.value,0,'Seleccione un estado');"></select>
							</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Municipio  origen
									<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
								</label>
								<select name="tra_mun_id_ori" id="tra_mun_id_ori" class="form-control select2-single " data-toggle="select2" data-placeholder="Selecciona el estado...">
									<option selected value="-1">Seleccione un estado</option>
								</select>
							</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Estado destino
									<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
								</label>
								<select name="tra_est_id_dest" id="tra_est_id_dest" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios_adaptable($('#tra_mun_id_dest'),event.target.value,0,'Seleccione un estado');"></select>
							</div>
							<div class="col-lg-3">
								<label class="col-form-label title-busq">Municipio  destino
									<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
								</label>
								<select name="tra_mun_id_dest" id="tra_mun_id_dest" class="form-control select2-single  mdi-18px btn-icon " data-toggle="select2" data-placeholder="Selecciona el estado...">
									<option selected value="-1">Seleccione un estado</option>
								</select>
							</div>
							<div class="col-lg-6">
								<label class="col-form-label title-busq">Estatus transporte
									<i class="mdi mdi-car mdi-18px btn-icon"></i>
								</label>
								<select name="tra_estatus" id="tra_estatus" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">Todos</option>
									<option value="-2">Cancelados</option>
									<option value="1">Sin comprobar</option>
									<option value="2">Solicitado</option>
									<option value="3">Aprobado</option>

								</select>
							</div>
							<div class="col-lg-6">
								<label class="col-form-label title-busq">Transporte ID
									<i class="mdi mdi-numeric mdi-18px btn-icon"></i>
								</label>
								<input id="tra_id" oninput="soloNumeroPositivosV2(event)" name="tra_id" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="ID"/>
							</div>

							<div class="col-lg-12 text-center mt-2 mb-2" id="">
								<span class="font-16 btn-link-crm">Elija el filtro de los montos</span>
							</div>
							<div class="col-lg-12 text-center" id="">


								<div class="d-flex justify-content-center input-group">
									<button type="button" class="btn btn-dark btn-rounded filtro-ragos-1" onclick="fnSeleccionarFiltroCantidad('exacto','filtro-ragos-1','div-input-exacto','div-input-grupo-filtro-cantidad')">Cantidad exacta</button>
									<button type="button" class="btn btn-primary btn-rounded filtro-ragos-1" onclick="fnSeleccionarFiltroCantidad('rango','filtro-ragos-1','div-input-rango','div-input-grupo-filtro-cantidad')">Rango</button>
								</div>
							</div>

							<div class="col-lg-4 div-input-exacto div-input-grupo-filtro-cantidad" style="display:none;">
								<label class="col-form-label title-busq">Monto pre aprobado
									<i class="mdi mdi-cash-multiple mdi-18px btn-icon"></i>
								</label>
								<input id="tra_preaprobado" name="tra_preaprobado" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="$" oninput="limitDecimalPlaces(event,2)"/>
							</div>

							<div class="col-lg-4 div-input-exacto div-input-grupo-filtro-cantidad" style="display:none;">
								<label class="col-form-label title-busq">Monto solicitado
									<i class="mdi mdi-cash mdi-18px btn-icon"></i>
								</label>
								<input id="tra_solicitado" name="tra_solicitado" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="$" oninput="limitDecimalPlaces(event,2)"/>
							</div>

							<div class="col-lg-4  div-input-exacto div-input-grupo-filtro-cantidad" style="display:none;">
								<label class="col-form-label title-busq">Monto aprobado
									<i class="mdi mdi-human-greeting mdi-18px btn-icon"></i>
								</label>
								<input id="tra_aprobado" name="tra_aprobado" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="$" oninput="limitDecimalPlaces(event,2)"/>
							</div>

							{# inputs rangos inicio #}
							<div class="col-lg-4 div-input-rango div-input-grupo-filtro-cantidad">
								<label class="col-form-label title-busq">Monto pre aprobado
									<i class="mdi mdi-cash-multiple mdi-18px btn-icon"></i>
								</label>
								<div class="input-group" id="">
									<label class="col-form-label  title-busq">Desde</label>
									<input type="number" id="tra_preaprobado_inicio" name="tra_preaprobado_inicio" oninput="limitDecimalPlaces(event,2)" class="form-control bar-left" placeholder="$"/>
									<label class="col-form-label  title-busq">Hasta</label>
									<input type="number" id="tra_preaprobado_fin" name="tra_preaprobado_fin" oninput="limitDecimalPlaces(event,2)" class="form-control bar-right" placeholder="$"/>
								</div>
							</div>
							<div class="col-lg-4 div-input-rango div-input-grupo-filtro-cantidad">
								<label class="col-form-label title-busq">Monto solicitado
									<i class="mdi mdi-cash mdi-18px btn-icon"></i>
								</label>
								<div class="input-group" id="">
									<label class="col-form-label  title-busq">Desde</label>
									<input type="number" id="tra_solicitado_inicio" name="tra_solicitado_inicio" oninput="limitDecimalPlaces(event,2)" class="form-control bar-left" placeholder="$"/>
									<label class="col-form-label  title-busq">Hasta</label>
									<input type="number" id="tra_solicitado_fin" name="tra_solicitado_fin" oninput="limitDecimalPlaces(event,2)" class="form-control bar-right" placeholder="$"/>
								</div>
							</div>
							<div class="col-lg-4 div-input-rango div-input-grupo-filtro-cantidad">
								<label class="col-form-label title-busq">Monto aprobado
									<i class="mdi mdi-human-greeting mdi-18px btn-icon"></i>
								</label>
								<div class="input-group" id="">
									<label class="col-form-label  title-busq">Desde</label>
									<input type="number" id="tra_aprobado_inicio" name="tra_aprobado_inicio" oninput="limitDecimalPlaces(event,2)" class="form-control bar-left" placeholder="$"/>
									<label class="col-form-label  title-busq">Hasta</label>
									<input type="number" id="tra_aprobado_fin" name="tra_aprobado_fin" oninput="limitDecimalPlaces(event,2)" class="form-control bar-right" placeholder="$"/>
								</div>
							</div>
							{# inputs rangos fin  #}
						</div>
					</div>
					<div class="col-lg-8 mt-3"></div>
					<div class="col-lg-3 col-9  text-right mt-3">
						<div
							class="form-group mt-3">
							<!-- <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>  -->

							<button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar">
								<i class=" mdi mdi-magnify white"></i>
								Buscar</button>
						</div>
					</div>
					<div class="col-lg-1 col-3  text-right mt-3">
						<div class="form-group mt-3">
							<a type="button" id="reinciarform" name="buscar" title="Limpiar búsqueda" onclick="reiniciarFormulario('form_reporte_transporte',fnlimpiartablaTransporteReporte);" class="btn-dark btn-rounded btn btn-limpiar">
								<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>
							</a>

						</div>
					</div>


				</form>
			{% endif %}
		</div>
		<div
			id="listadoprincipal"><!-- <h5>Realice una búsqueda</h5> -->
		</div>

		<!-- end content -->

	</div>
	<!-- END content-page -->

</div>
<!-- END wrapper -->

