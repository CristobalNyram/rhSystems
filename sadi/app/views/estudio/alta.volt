{% include "/estudio/alta-estudio/alta-js.volt" %}



<div class="mt-3">
	<div class="card card-crm">
		<div class="text-center col-md-12">
			<div class="mt-1"><span class="font-16 btn-link-crm">Añadir Nuevo Estudio</span>
			</div>
		</div>
		<hr class="line-down">
        <form id="frm_crearese" class="form-vertical mt-1 p-3">
			<div class="form-group row">
				<div class="col-lg-4" >
	              <label class="col-form-label title-busq">EMPRESA</label>
	              <select name="emp_id" id="emp_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fndatosempresa(); fnOcultarMostrarInputsEmpresaCrearEse(event.target.value);">
	              </select>
	            </div>
				<div class="col-lg-4 inputs-empresa-reculta-crear-ese "  style="display:none ;" >
					<label class="col-form-label title-busq">EMPRESA RECLUTA</label>
					<input id="ese_empresarecluta" name="ese_empresarecluta" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Empresa recluta"  oninput="handleInput(event)" maxlength="50"/>

				</div>
	            <div class="col-lg-4" >
	              <label class="col-form-label title-busq">QUIEN SOLICITA</label>
	              <select name="cne_id" id="cne_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
	              	<option selected value="-1">Seleccione una empresa</option>
	              </select>
	            </div>
	            <div class="col-lg-4" >
	              <label class="col-form-label title-busq">CENTRO DE COSTO</label>
	              <select name="cen_id" id="cen_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
	              	<option selected value="-1">Seleccione una empresa</option>
	              </select>
	            </div>
	            <div class="col-lg-4" >
	              <label class="col-form-label title-busq">Formato</label>
	              <select name="tif_id" id="tif_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
					<option selected value="-1">Seleccione una empresa</option>
 
				</select>
	            </div>
	            <input type="hidden" id="tip_id" name="tip_id">
	            <!-- <div class="col-lg-4" >
	              <label class="col-form-label title-busq">TIPO DE ESTUDIO</label>
	              <select name="tip_id" id="tip_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnselecttipo();">
	              </select>
	            </div> -->
	            <div class="col-lg-4" id="verdiv" style="display: none;">
	              <label class="col-form-label title-busq">TIPO DE VERIFICACIÓN</label>
	              <select name="ver_id" id="ver_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
	              </select>
	            </div>
	            <div class="col-lg-4" >
	              <label class="col-form-label title-busq">PERSONA FÍSICA/MORAL</label>
	              <select name="ese_tippersona" id="ese_tippersona" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnselecttipopersona();">
	              	<option selected value="-1">Seleccione...</option>
	              	<option value="1">Física</option>
	              	<option value="2">Moral</option>
	              </select>
	            </div>                
                <div class="col-lg-12 mt-4">
					<label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">DATOS GENERALES</label>
                    <hr class="mt-1">
                </div>
                
                <div class="col-lg-4">
					<label class="col-form-label title-busq">NOMBRE(S)</label>
                    <input id="ese_nombre" name="ese_nombre" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre(s)"  oninput="handleInput(event)" maxlength="150"/>
                </div>
                <div class="col-lg-4" id="fisica1" style="display: none;">
					<label class="col-form-label title-busq">PRIMER APELLIDO</label>
                    <input id="ese_primerapellido" name="ese_primerapellido" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" oninput="handleInput(event)" maxlength="150"/>
                </div>
                <div class="col-lg-4" id="fisica2" style="display: none;">
					<label class="col-form-label title-busq">SEGUNDO APELLIDO</label>
                    <input id="ese_segundoapellido" name="ese_segundoapellido" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" oninput="handleInput(event)" maxlength="150"/>
                </div>
                <div class="col-lg-3" >
	              <label class="col-form-label title-busq">ESTADO</label>
	              <select name="est_id" id="est_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios();">
	              </select>
	            </div>
	            <div class="col-lg-3" >
	              <label class="col-form-label title-busq">MUNICIPIO</label>
	              <select name="mun_id" id="mun_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Selecciona el estado...">
	              	<option selected value="-1">Seleccione un estado</option>
	              </select>
	            </div>
	            <div id="divtipover" style="display: none;" class="col-12 row">
	            	<div class="col-lg-4">
						<label class="col-form-label title-busq">FOLIO DE VERIFICACIÓN</label>
	                    <input id="ese_folioverificacion" name="ese_folioverificacion" maxlength="45" type="text" class="form-control input-rounded" placeholder="Folio de verificación" oninput="handleInput(event)" />
	                </div>
	            </div>
	            <div id="divnumcontrol" style="display: none;" class="col-12 row">
	            	<div class="col-lg-4">
						<label class="col-form-label title-busq">Número control</label>
	                    <input id="ese_numerocontrol" name="ese_numerocontrol" maxlength="45" type="text" class="form-control input-rounded" placeholder="Número control" oninput="handleInput(event)" />
	                </div>
	            </div>
                <div id="divtipoese" style="display: none;" class="col-12 row">
                	<div class="col-lg-4">
						<label class="col-form-label title-busq">PUESTO DEL CANDIDATO</label>
	                    <input id="ese_puesto" name="ese_puesto" type="text" class="form-control input-rounded" placeholder="Puesto" oninput="handleInput(event)" maxlength="150"/>
	                </div>
	                <div class="col-lg-4">
		              <label class="col-form-label title-busq">FECHA DE NAC.</label>
		              <div class="input-group">
		                <input type="date" class="form-control input-rounded-right" placeholder="dd/mm/yyyy" id="ese_fechanacimiento" name="ese_fechanacimiento">
		                <div class="input-group-append">
		                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
		                </div>
		              </div>
		            </div>
		            <div class="col-lg-4">
						<label class="col-form-label title-busq">CURP</label>
	                    <input id="ese_curp" name="ese_curp" type="text" class="form-control input-rounded" placeholder="CURP"  oninput="handleInput(event)" maxlength="45"/>
	                </div>
	                <div class="col-lg-4">
						<label class="col-form-label title-busq">IMSS</label>
	                    <input id="ese_nss" name="ese_nss" type="text" class="form-control input-rounded" placeholder="IMSS"  oninput="handleInput(event)" maxlength="15"/>
	                </div>
					<div class="col-lg-3">
						<label class="col-form-label title-busq">CALLE</label>
	                    <input id="ese_calle" name="ese_calle" type="text" class="form-control input-rounded" placeholder="Calle"  oninput="handleInput(event)" maxlength="150"/>
	                </div>
	                <div class="col-lg-2">
						<label class="col-form-label title-busq">NÚM. EXT.</label>
	                    <input id="ese_numext" name="ese_numext" type="text" class="form-control input-rounded" placeholder="Núm. ext."  oninput="handleInput(event)" maxlength="45"/>
	                </div>
	                <div class="col-lg-2">
						<label class="col-form-label title-busq">NÚM. INT.</label>
	                    <input id="ese_numint" name="ese_numint" type="text" class="form-control input-rounded" placeholder="Núm. int."  oninput="handleInput(event)" maxlength="45"/>
	                </div>
	                <div class="col-lg-3">
						<label class="col-form-label title-busq">COLONIA</label>
	                    <input id="ese_colonia" name="ese_colonia" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Colonia"  oninput="handleInput(event)" maxlength="45"/>
	                </div>
	                <div class="col-lg-2">
						<label class="col-form-label title-busq">CÓDIGO POSTAL</label>
	                    <input id="ese_codpostal" name="ese_codpostal" type="text" class="form-control input-rounded" placeholder="Código postal"  oninput="handleInput(event)" maxlength="10"/>
	                </div>
	                
		            <div class="col-lg-2">
						<label class="col-form-label title-busq">TELÉFONO</label>
	                    <input id="ese_telefono" name="ese_telefono" type="text" class="form-control input-rounded" placeholder="Teléfono"  oninput="handleInput(event)" maxlength="20"/>
	                </div>
	                <div class="col-lg-2">
						<label class="col-form-label title-busq">CELULAR</label>
	                    <input id="ese_celular" name="ese_celular" type="text" class="form-control input-rounded" placeholder="Celular"  oninput="handleInput(event)" maxlength="20"/>
	                </div>
		            <div class="col-lg-4">
		              <label class="col-form-label title-busq">AÑO DE TÉRMINO DE ESTUDIOS</label>
		              <div class="input-group">
		                <input type="date" class="form-control input-rounded-right" placeholder="mm/dd/yyyy" id="ese_finestudios" name="ese_finestudios">
		                <div class="input-group-append">
		                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
		                </div>
		              </div>
		            </div>

					<div class="col-lg-2">
						<label class="col-form-label title-busq text-uppercase">referencia numérica</label>
	                    <input id="ese_folioverificacion_eses" name="ese_folioverificacion_eses" maxlength="45" type="text" class="form-control input-rounded"  placeholder="Referencia numérica" oninput="handleInput(event)" />
	                </div>
		        </div>
			

				<div class="col-12 row mt-4" style="display: none; " id="contenedor_modulo_autoestudios" >
					{% include "/estudio/alta-estudio/alta-ese-inputs-autoestudio.volt" %}

				
					

				</div>
	
				<!-- include de inicio ref laborales y ref personales INCIO -->
				<div class="col-12" style="display:none ;" id="contenedor_modulo_referencias_alta_estudio" >
					{% include "/estudio/alta-estudio/alta-eses-botones-referencias.volt" %}
		



				</div>
				<!-- include de inicio ref laborales y ref personales FIN -->

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