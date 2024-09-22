{% set dieciseis = acceso.verificar(16,rol_id) %}
{% set veinte = acceso.verificar(20,rol_id) %}
{% set veintisiete = acceso.verificar(27,rol_id) %}
{% set treintaycuatro = acceso.verificar(34,rol_id) %}
{% set treintayuno = acceso.verificar(31,rol_id) %}
{% set cuarentaytres = acceso.verificar(43,rol_id) %}
{% set cincuentayocho = acceso.verificar(58,rol_id) %}
{% set setentaycinco = acceso.verificar(75,rol_id) %}
{% set setentaynueve = acceso.verificar(79,rol_id) %}
{% set noventaytres = acceso.verificar(93,rol_id) %}
{% set estatus_validados_para_mandar_gar = [3] %}


<input type="hidden" id="nombrearchivo" value='{{titulo}}'>

<div class="card card-crm">
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
			            	<th>Vacante No</th>
							<th>Estatus</th>
							<th>Estatus anterior</th>

							<th>Expedientes registrados</th>
							<th>Expedientes facturados</th>

						    <th>Vacante espacios</th>
							<th>Vacante espacios anterior</th>

							<th>Vacante</th>

							<th>Empresa</th>
			               	<th>Fecha de solicitud</th>
			                <th>Ejecutivo</th>
							
							<th>Centro de costos</th>
							<th>Contacto empresa</th>
							<th>Tel. contacto empresa</th>
							<th>Cel. contacto empresa</th>
							<th>Correo contacto empresa</th>
							<th>Puesto contacto empresa</th>
					
							<th>Estado</th>
							<th>Municipio</th>
							<th>Genero</th>
							<th>Tipo pago</th>
							<th>Estado civil</th>
							<th>Grado escolar</th>
							<th>Tipo empleo</th>
							<th>Prestación</th>
							<th>Tipo de vacante</th>
							<th>Edad min vacante</th>
							<th>Edad max vacante</th>

							<th>Horario de trabajo vacante</th>
							<th>Sueldo min vacante</th>
							<th>Sueldo max vacante</th>
	
							<th>Idioma vacante</th>
							<th>Nivel idioma vacante</th>

							<th>Privacidad de vacante</th>

							
							<!-- usuarios modificaron -->
							<th>Usuario alta </th>
							<th>F. de registro</th>
							<th>Usuario modificó </th>
							<th>F. de actualizo</th>

							<th>Usuario reactivo </th>
							<th>F. de reactivación </th>

							<th>Usuario cancelo </th>
							<th>F. de cancelación </th>

							<!-- usuarios vacante fin -->
							<th class="all">Acciones</th>

			            </tr>
			        </thead>
			        <tbody>
	{% endif %}						
			            <tr >
			            	<td>
								{{reg.vac_id}}
							</td>
							<td>
								<span class="badge 
								{{ vacante_obj.getEstatusBanderaColor(reg.vac_estatus) }}
										p-2
								">		
								{{vacante_obj.getEstatusTexto(reg.vac_estatus)}}
								</span>
							
							</td>
							<td>
								<span class="badge 
								{{ vacante_obj.getEstatusBanderaColor(reg.vac_estatusanterior) }}
										p-2">		
								{{vacante_obj.getEstatusTexto(reg.vac_estatusanterior)}}
								</span>
							</td>
							
							<td>{{vacante_obj.getExpedientesRelacionadosVacante(reg.vac_id)}}</td>

							<td>{{vacante_obj.getExpedientesRelacionadosVacanteFacturados(reg.vac_id)}}</td>
							<td>{{ reg.vac_numero }}</td>
							<td>{{ reg.vac_numeroanterior }}</td>

							<td>
								{{reg.cav_nombre}}
							</td>
							<td class="text-uppercase" title="{{ reg.emp_alias }}">
								<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
									{{ reg.emp_nombre }}

								</span>	
							</td>
							<td>
								{{reg.vac_fecharegistro}}
							</td>
							<td>
								{{reg.eje_nombre}}
							</td>
							
							<td>
								{{reg.cen_nombre}}
							</td>
							<!-- contacto empresa inii -->
							<td>
								{{reg.cne_nombre_completo}}
							</td>
							<td>
								{{reg.cne_tel}}
							</td>
							<td>
								{{reg.cne_celular}}
							</td>
							<td>
								{{reg.cne_correo}}
							</td>
							<td>
								{{reg.cne_puesto}}
							</td>	
							
							<!-- conctacto empresa fin  -->


							<td>
								{{reg.est_nombre}}
							</td>
							<td>
								{{reg.mun_nombre}}
							</td>
							<td>
								{{reg.sex_nombre}}
							</td>
							<td>
								{{reg.sex_nombre}}
							</td>
							<td>
								{{reg.esc_nombre}}
							</td>
							<td>
								{{reg.gra_nombre}}
							</td>
							<td>
								{{reg.tie_nombre}}
							</td>
							<td>
								{{reg.pre_nombre}}
							</td>
							<td>
								{{reg.tip_nombre}}
							</td>

							<td>{{reg.vac_horario}}</td>

							<!-- sueldo, edad -->
							<td>{{reg.vac_edadmin}}</td>
							<td>{{reg.vac_edadmax}}</td>
							<td>{{reg.vac_sueldomin}}</td>
							<td>{{reg.vac_sueldomax}}</td>
							<!-- sueldo, edad -->

							<td>{{reg.vac_idioma}}</td>
							<td>{{reg.vac_nivelidioma}}</td>

							<td>
								{{vacante_obj.getTextoPrivacidad(reg.vac_privacidad)}}
							</td>

							<!-- usuarios info actualizo -->
							<td>{{reg.usu_alta_nombre}}</td>
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fecharegistro)) }}'>{{ date("d-m-Y", strtotime(reg.vac_fecharegistro)) }}</td>

							<td>{{reg.usu_modifico_nombre}}</td>
							{% if reg.vac_actualizacion is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_actualizacion)) }}'>{{ date("d-m-Y", strtotime(reg.vac_actualizacion)) }}</td>
							{% else %}
								<td>Sin fecha</td>
							{% endif %}	
							<td>{{reg.usu_reactivo_nombre}}</td>
							{% if reg.vac_fechareactivoproceso is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fechareactivoproceso)) }}'>{{ date("d-m-Y", strtotime(reg.vac_fechareactivoproceso)) }}</td>
							{% else %}
								<td>Sin fecha</td>
							{% endif %}	

							<td>{{reg.vac_fechacancelacion}}</td>
							{% if reg.vac_fechacancelacion is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fechacancelacion)) }}'>{{ date("d-m-Y", strtotime(reg.vac_actualizacion)) }}</td>
							{% else %}
								<td>Sin fecha</td>
							{% endif %}	

							<!-- usuarios info actualizo -->

						
							<td width="7%">
									{% include "/consulta/complementosvac/opciones_vac.volt" %}
							</td>
			            </tr>
			        {% if loop.last %}
			        </tbody>
			    </table>
			<!-- </div> -->
		</div>
	{% endif %}
	{% else %}
	    <strong>No existen registros en este catálogo.</strong>
		<strong class="text-danger">{{mensaje_back}}</strong>

		
	</div>
{% endfor %}

