{% include "/vacante/alta-vacante/alta-js.volt" %}
<style>
.progress {
  position: fixed;
  top: 72px; /* Ajusta la altura del navbar */
  left: 0;
  width: 100%;
  z-index: 9999;
}

.progress-bar {
  height: auto;
}
</style>


</style>
<div class="mt-3">
	<div class="card card-crm">
		<div class="text-center col-md-12">
			<div class="mt-1"><span class="font-16 btn-link-crm">Añadir Nueva Vacante</span>
			</div>
		</div>
		<hr class="line-down">
        <form id="frm_crear_vac" class="form-vertical mt-1 p-3" >
			
			<div class="form-group row">
				<div class="col-lg-4" >
					<label class="col-form-label title-busq">EMPRESA</label>
					<select name="emp_id" id="emp_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fndatosempresa();">
					</select>
	            </div>
	            <div class="col-lg-4" >
					<label class="col-form-label title-busq">QUIEN SOLICITA</label>
					<select name="cne_id"  id="cne_id" class="form-control select2-single " data-toggle="select2" onchange="getContactoDetalleAltaVacante(event.currentTarget.value)" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione una empresa</option>
					</select>
	            </div>
	            <div class="col-lg-4" >
					<label class="col-form-label title-busq">CENTRO DE COSTO</label>
					<select name="cen_id" id="cen_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione una empresa</option>
					</select>
	            </div>
				
				<div class="col-lg-3 campos_contacto_empresa"  >
					<label class="col-form-label title-busq">PUESTO CONTACTO</label>
					<input id="cne_puesto" readonly name="cne_puesto" type="text" class="form-control input-rounded" placeholder="Nombre de contacto"  maxlength="155" />
	            </div>
				<div class="col-lg-3 campos_contacto_empresa"  >
					<label class="col-form-label title-busq">CELULAR CONTACTO</label>
					<input id="cne_celular" readonly name="cne_celular" type="text" class="form-control input-rounded" placeholder="Nombre de contacto"  maxlength="155" />
	            </div>
				<div class="col-lg-3 campos_contacto_empresa"  >
					<label class="col-form-label title-busq">TEL CONTACTO</label>
					<input id="cne_telefono"  readonly name="cne_telefono" type="text" class="form-control input-rounded" placeholder="Tel de contacto "  maxlength="155" />
	            </div>
				<div class="col-lg-3 campos_contacto_empresa"  >
					<label class="col-form-label title-busq">CORREO CONTACTO</label>
					<input id="cne_correo" readonly name="cne_correo" type="text" class="form-control input-rounded" placeholder="Correo de contacto "  maxlength="155" />
	            </div>

				<div class="col-lg-12 mt-4">
					<label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">DATOS GENERALES DE LA REQUISICIÓN</label>
                    <hr class="mt-1">
                </div>
				<div class="col-lg-2" >
					<label class="col-form-label title-busq">TIPO DE VACANTE</label>
					<select name="tip_id" id="tip_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione...</option>
					</select>
	            </div>
				<div class="col-lg-4" >
					<label class="col-form-label title-busq">VACANTE</label>
					<select name="cav_id" id="cav_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione una empresa</option>
					</select>
	            </div>
				<div class="col-lg-2" >
					<label class="col-form-label title-busq">NO. VACANTES</label>
					<select name="vac_numero" id="vac_numero" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione...</option>
							{% for i in 1..30 %}
								<option value="{{i}}">{{i}}</option>
							{% endfor %}
					</select>
	            </div>
				<div class="col-lg-4" >
					<label class="col-form-label title-busq">TIPO DE EMPLEO</label>
					<select name="tie_id" id="tie_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="tipoDeEmpleoInpust(event.currentTarget.value)">
					<option selected value="-1">Seleccione...</option>
					</select>
	            </div>
				<div class="col-lg-4 tipo-empleo-eventual" style="display:none;"  >
					<label class="col-form-label title-busq">POR</label>
					<input id="vac_tiempomeses" name="vac_tiempomeses" type="number" class="form-control input-rounded" placeholder="Tiempo en meses"  maxlength="155" />

	            </div>
                <div class="col-lg-4" >
					<label class="col-form-label title-busq">Estado</label>
					<select name="est_id" id="est_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios();">
					</select>
	            </div>
	            <div class="col-lg-4" >
					<label class="col-form-label title-busq">MUNICIPIO</label>
					<select name="mun_id" id="mun_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Selecciona el estado...">
					<option selected value="-1">Seleccione un estado</option>
					</select>
	            </div>
				<div class="col-lg-12 mt-4">
					<label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">ÚNICAMENTE PARA PERSONAL SUBCONTRATADO</label>
                    <hr class="mt-1">
                </div>
                <div class="col-lg-3" >
					<label class="col-form-label title-busq">GENERACIÓN DE LA VACANTE POR:</label>
					<select name="gen_id" id="gen_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					</select>
	            </div>
				<div class="col-lg-12 mt-4">
					<label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">REQUERIMIENTOS DEL PUESTO</label>
                    <hr class="mt-1">
                </div>
                <div class="col-lg-4" >
					<label class="col-form-label title-busq">ESTADO CIVIL:</label>
					<select name="esc_id" id="esc_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					</select>
	            </div>
				<div class="col-lg-2">
					<label class="col-form-label title-busq">EDAD MÍNIMA</label>
					<input id="vac_edadmin" name="vac_edadmin" type="text" class="form-control input-rounded" maxlength="2"  placeholder="Edad mínima" oninput="formatoEdad(event)" />
				</div>
				<div class="col-lg-2">
					<label class="col-form-label title-busq">EDAD MÁXIMA</label>
					<input id="vac_edadmax" name="vac_edadmax" type="text" class="form-control input-rounded" placeholder="Edad máxima" oninput="formatoEdad(event)" />
				</div>
				<div class="col-lg-4" >
					<label class="col-form-label title-busq">SEXO:</label>
					<select name="sex_id" id="sex_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					</select>
	            </div>
				<div class="col-lg-3" >
					<label class="col-form-label title-busq">ESCOLARIDAD DESEADA:</label>
					<select name="gra_id" id="gra_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					</select>
	            </div>
				<div class="col-lg-3">
					<label class="col-form-label title-busq">ESPECIFICAR ESCOLARIDAD:</label>
					<input id="vac_escolaridadespecificar" name="vac_escolaridadespecificar"   maxlength="255" type="text" class="form-control input-rounded" placeholder="Especificar escolaridad" oninput="handleInput(event)" />
				</div>
				<div class="col-lg-3">
					<label class="col-form-label title-busq">IDIOMAS REQUERIDOS:</label>
					<input id="vac_idioma" name="vac_idioma" type="text" maxlength="155" class="form-control input-rounded" placeholder="Idioma requerido" oninput="handleInput(event)" />
				</div>
				<div class="col-lg-3">
					<label class="col-form-label title-busq">NIVEL:</label>
					<input id="vac_nivelidioma" name="vac_nivelidioma" type="text" maxlength="30" class="form-control input-rounded" placeholder="Nivel de idioma" oninput="handleInput(event)" />
				</div>
				<div class="col-lg-6">
					<label class="col-form-label title-busq">OTROS IDIOMAS:</label>
					<input id="vac_otroidioma" name="vac_otroidioma" type="text" maxlength="155" class="form-control input-rounded" placeholder="Otros idiomas" oninput="handleInput(event)" />
				</div>
				<div class="col-lg-6 ">
					<label class="col-form-label title-busq">HORARIO DE TRABAJO:</label>
					<input id="vac_horario" name="vac_horario" type="text" maxlength="90" class="form-control input-rounded" placeholder="Horario" oninput="handleInput(event)" />
				</div>
				<div class="col-lg-12 mt-4">
					<label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">CONCEPTO / DESCRIPCIÓN</label>
                    <hr class="mt-1">
                </div>
				<div class="col-lg-6">
					<label class="col-form-label title-busq">CONCEPTOS TÉCNICOS:</label>
					<label class="col-form-label title-busq" id="vac_conceptotecnico-label"></label>
					<textarea rows="4" id="vac_conceptotecnico" name="vac_conceptotecnico" type="text" class="form-control-textarea text_area_a" style="min-height:188px" placeholder="Concepto técnico" onkeyup="actualizaInfo(3000,'vac_conceptotecnico', 'vac_conceptotecnico-label')"  oninput="handleInput(event)" maxlength="3000"></textarea>
				</div>
				<div class="col-lg-6">
					<label class="col-form-label title-busq">HABILIDADES O COMPETENCIAS:</label>
					<label class="col-form-label title-busq" id="vac_habilidad-label"></label>
					<textarea rows="4" id="vac_habilidad" name="vac_habilidad" type="text" class="form-control-textarea text_area_a" style="min-height:188px" placeholder="Habilidades o competencias" onkeyup="actualizaInfo(3000,'vac_habilidad', 'vac_habilidad-label')"  oninput="handleInput(event)" maxlength="3000"></textarea>
				</div>
				<div class="col-lg-6">
					<label class="col-form-label title-busq">FUNCIONES PRINCIPALES:</label>
					<label class="col-form-label title-busq" id="vac_funcionprincipal-label"></label>
					<textarea rows="4" id="vac_funcionprincipal" name="vac_funcionprincipal" type="text" class="form-control-textarea text_area_a" style="min-height:188px" placeholder="Función principal" onkeyup="actualizaInfo(3000,'vac_funcionprincipal', 'vac_funcionprincipal-label')"  oninput="handleInput(event)" maxlength="3000"></textarea>
				</div>
				<div class="col-lg-6">
					<label class="col-form-label title-busq">EXPERIENCIA:</label>
					<label class="col-form-label title-busq" id="vac_experiencia-label"></label>
					<textarea rows="4" id="vac_experiencia" name="vac_experiencia" type="text" class="form-control-textarea text_area_a" style="min-height:188px" placeholder="Experiencia" onkeyup="actualizaInfo(3000,'vac_experiencia', 'vac_experiencia-label')"  oninput="handleInput(event)" maxlength="3000"></textarea>
				</div>
				<div class="col-lg-3">
					<label class="col-form-label title-busq">SUELDO MÍNIMO:</label>
					<input id="vac_sueldomin" name="vac_sueldomin" type="number" class="form-control input-rounded" placeholder="Sueldo mínimo" oninput="limitDecimalPlaces(event,2)"/>
				</div>
				<div class="col-lg-3">
					<label class="col-form-label title-busq">SUELDO MÁXIMO:</label>
					<input id="vac_sueldomax" name="vac_sueldomax" type="number" class="form-control input-rounded" placeholder="Sueldo máximo" oninput="limitDecimalPlaces(event,2)" />
				</div>
				<div class="col-lg-3" >
					<label class="col-form-label title-busq">TIPO DE PAGO:</label>
					<select name="tpg_id" id="tpg_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					 
					</select>
				</div>
				<div class="col-lg-3" >
					<label class="col-form-label title-busq">PRESTACIONES:</label>
					<select name="pre_id" id="pre_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					</select>
	            </div>
				<div class="col-lg-2" >
					<label class="col-form-label title-busq">GARANTÍA</label>
					<select name="vac_garantia" id="vac_garantia" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccione...</option>	
					    {% for number in [15,30,45,60,75,90] %}
							<option value="{{ number }}">{{ number }}</option>
						{% endfor %}
					</select>
	            </div>
				<div class="col-lg-12">
					<label class="col-form-label title-busq text-uppercase">OBSERVACIONES:  </label><label for=""  id="vac_observaciones-label" class="col-form-label title-busq"></label>
					<label class="col-form-label title-busq" id="vac_experiencia-label"></label>
					<textarea  rows="4" id="vac_observaciones" name="vac_observaciones" type="text" class="form-control-textarea text_area_a" style="min-height:50px" placeholder="Observaciones" onkeyup="actualizaInfo(2000,'vac_observaciones', 'vac_observaciones-label')"  oninput="handleInput(event)" maxlength="2000"></textarea>
				</div>
				<div class="col-lg-12" >
					<label class="col-form-label title-busq">EJECUTIVO</label>
					<select name="eje_id" id="eje_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					<option selected value="-1">Seleccionar...</option>
					</select>
	            </div>
				<div class="col-lg-12" >
					<label class="col-form-label title-busq">EL CLIENTE DESEA QUE LA VACANTE SEA:</label>
					<select name="vac_privacidad" id="vac_privacidad" class="form-control select2-single "  data-toggle="select2" data-placeholder="Seleccionar ...">
						<option selected value="-1">Seleccionar...</option>	
					   	<option  value="1">PÚBLICA</option>	
						<option  value="2">PRIVADA</option>	

					</select>
	            </div>


				<div class="col-lg-12" >
					<label class="col-form-label title-busq">{{ arv.ctv_nombre}} :</label>
				    <input  onchange="fnValidateSizeFile(event,'preview-container-archivos-vac-cv');"
							id="arv_vac_cotizacion" 
							name="arv" 
							data-file-limit="{{ arv.ctv_numarc}}"
							data-size-limit="{{ arv.ctv_tamano}}" 
							accept="{{ arv.ctv_tipovalidacion}}" 
							type="file"  
							class="form-control input-rounded" 
					/>
                  

	            </div>
				<div id="preview-container-archivos-vac-cv" class="col-12"></div>

				<div class="col-lg-9">

				</div>
				
				<div class="col-lg-3 col-12  text-right mt-5 offset-lg-0">
						<div class="form-group">
							<button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                    </div>
				</div>
		    </div>
	    </form>
    </div>
</div>