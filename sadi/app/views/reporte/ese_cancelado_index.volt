
{% include "/reporte/ese_cancelado_index_scripts_js.volt" %}
{% include "/archivocancelacion/tabla-modal-js.volt" %}

<div class="row">
	<div class="col-6">
		<h4 class="header-title header-title-crm">Cancelados 	
			<i class="mdi mdi-playlist-remove mdi-36px btn-ico"></i>	
			</h4>
	</div>
	<div class="col-6">
		<div class="text-right"></div>
	</div>
</div>
<div class="mt-3">
	<div class="card card-crm">
		<div id="busqueda" name="busqueda">
			{% if acceso.verificar(97,rol_id)==1 %}
				<form id="form_reporte_ese_cancelacion" class="form-vertical col-md-12 row">
					<div class="col-lg-12">
						<div class="form-horizontal row">
							<div class="text-center col-md-12">
								<div class="mt-1">
									<span class="font-16 btn-link-crm">Información estudio</span>
								</div>
							</div>
					

				
							<div class="col-lg-4">
								<label class="col-form-label title-busq">Estudio ID
									<i class="mdi mdi-numeric mdi-18px btn-ico"></i>
								</label>
								<input id="ese_id" name="ese_id" oninput="soloNumeroPositivosV2(event)" type="number" class="form-control input-rounded data-not-lt-active" maxlength="25" placeholder="ID"/>
							</div>
							<div class="col-lg-8 " id="fecha_ese_registro__div">
								<label class="col-form-label  title-busq">Fecha de alta de estudio
									<i class="mdi mdi-upload-network mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="ese_registro_inicio" name="ese_registro_inicio" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="ese_registro_fin" name="ese_registro_fin" class="form-control bar-right" placeholder="Hasta"/>
									</div>

								</div>
							</div>

						
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Estado 
								<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
							</label>
							<select name="est_id" id="est_id" class="form-control select2-single "  onchange="fnmunicipios_adaptable($('#mun_id'),$('#est_id').val(),-1)"  data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios_adaptable($('#tra_mun_id_ori'),event.target.value,0,'Seleccione un estado');"></select>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq">Municipio 
								<i class="mdi mdi-fireplace-off mdi-18px btn-ico"></i>
							</label>
							<select name="mun_id" id="mun_id" class="form-control select2-single "data-toggle="select2" data-placeholder="Selecciona el estado...">
								<option selected value="-1">Seleccione un estado</option>
							</select>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq" for="investigadorusu_id">Investigador
								<i class="mdi mdi-nature-people mdi-18px btn-ico"></i>
							</label>
							<select name="investigadorusu_id" id="investigadorusu_id" data-toggle="select2" class="form-control select2-multiple">
								<option value="-1">TODOS</option>
								{% for inv in investigadorselect %}
									<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
									</option>
								{% endfor %}
							</select>
						</div>
						<div class="col-lg-4">
							<label class="col-form-label title-busq"  for="analistausu_id">Analista
								<i class="mdi mdi-account mdi-18px btn-ico"></i>
							</label>
							<select name="analistausu_id" id="analistausu_id" data-toggle="select2" class="form-control select2-multiple">
								<option value="-1">TODOS</option>
								{% for inv in investigadorselect %}
									<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
									</option>
								{% endfor %}
							</select>
						</div>

				
							
							<hr>
							<div class="text-center col-md-12 mt-2">
								<div class="mt-1">
									<span class="font-16 btn-link-crm">Información de cancelación</span>
								</div>
							</div>
							<div class="col-lg-4 " id="tipo_estudio_div">
								<label class="col-form-label title-busq" for="tip_id">Tipo de estudio <i class="mdi mdi-checkbox-intermediate"></i></label>
								<select name="tip_id" id="tip_id" data-toggle="select2" onchange='fnGetTipoCatCanceladoByTipId(0,event.target.value,"cac_id","Seleccionar");' class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for tipoEstudio in tipoEstudios %}
									<option value="{{tipoEstudio.tip_id}}" >{{tipoEstudio.tip_nombre}}</option>
									{% endfor %}
					
								</select>
							</div>
							<div class="col-lg-4 " id="motivo_div">
								<label class="col-form-label title-busq" for="cac_id">Motivo <i class="mdi mdi-checkbox-intermediate"></i></label>
								<select name="cac_id" id="cac_id" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">Selecciona un tipo de estudio</option>

					
								</select>
							</div>

							<div class="col-lg-4">
								<label class="col-form-label title-busq"  for="cancelousu_id">Usuario que canceló
									<i class="mdi mdi-account-check mdi-18px btn-ico"></i>
								</label>
								<select name="usu_idcancela" id="usu_idcancela" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for usu in investigadorselect %}
										<option value="{{usu.usu_id}}"  >{{usu.nombre}}
										</option>
									{% endfor %}
								</select>
							</div>
							<div class="col-lg-8 " id="fecha_entrega_cliente_div">
								<label class="col-form-label  title-busq">Fecha de cancelación 
									<i class="mdi mdi-alert mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="eca_fecharegistro_inicio" name="eca_fecharegistro_inicio" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="eca_fecharegistro_fin" name="eca_fecharegistro_fin" class="form-control bar-right" placeholder="Hasta"/>
									</div>

								</div>
							</div>

						
							<div class="col-lg-4">
								<label class="col-form-label title-busq" for="eca_estatus">Estatus cancelación
									<i class="mdi mdi-information mdi-18px btn-icon"></i>
								</label>
								<select name="eca_estatus" id="eca_estatus" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									<option value="2">CANCELADOS</option>
									<option value="1">REACTIVADOS</option>
								</select>
							</div>
						
							<div class="col-lg-4">
								<label class="col-form-label title-busq">Usuario que cambió estatus
									<i class="mdi mdi-arrow-collapse mdi-18px btn-ico"></i>
								</label>
								<select name="eca_usu_idcambio" id="eca_usu_idcambio" data-toggle="select2" class="form-control select2-multiple">
									<option value="-1">TODOS</option>
									{% for inv in investigadorselect %}
										<option value="{{inv.usu_id}}" {% if indexinv== inv.usu_id%} selected {% endif %}>{{inv.nombre}}
										</option>
									{% endfor %}
								</select>
							</div>
						

							<div class="col-lg-8 " id="fecha_entrega_cliente_div">
								<label class="col-form-label  title-busq">Fecha de cambio de estatus (reactivadas)
									<i class="mdi mdi-alert mdi-18px btn-icon"></i>
								</label>
								<div>
									<div class="input-group" id="">
										<label class="col-form-label  title-busq">Desde</label>
										<input type="date" id="eca_fechacambio_inicio" name="eca_fechacambio_inicio" class="form-control bar-left" placeholder="Desde"/>
										<label class="col-form-label  title-busq">Hasta</label>
										<input type="date" id="eca_fechacambio_fin" name="eca_fechacambio_fin" class="form-control bar-right" placeholder="Hasta"/>
									</div>

								</div>
							</div>


					

	
						</div>
					</div>
					<div class="col-lg-12 mt-3"></div>

					<div class="row col-12 ">
						<div class="col-lg-6 mt-3"></div>
						<div class="col-lg-3 col-12 text-right mt-3">
							<div class="form-group mt-3">
								<button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar">
									<i class="mdi mdi-magnify white"></i> Buscar
								</button>
							</div>
						</div>
						<div class="col-lg-3 col-12 text-right mt-3">
							<div class="form-group mt-3">
								<a type="button" id="reinciarform" name="buscar" title="Limpiar búsqueda" onclick="reiniciarFormulario('form_reporte_ese_cancelacion',fnlimpiartablaCancelados);" class="btn-dark btn-rounded btn btn-limpiar">
									<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>
								</a>
							</div>
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

