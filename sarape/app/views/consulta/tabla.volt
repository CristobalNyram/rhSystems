{% include "/consulta/complementos/permisos_exc.volt" %}

<input type="hidden" id="nombrearchivo" value='{{titulo}}'>
<div class="card card-crm">
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
			            	<th>Expediente No</th>
							{% if array_cabeceras_td_col is defined and array_cabeceras_td_col|length > 0 %}
									{% for th_text in array_cabeceras_th %}
									<th>{{ th_text }}</th>
									{% endfor %}
							{% endif %}
							<th>Estatus</th>
							<th>Empresa</th>
							{% if cav_nombre_mostrar_manualmente =="1" %}
							<th>Nombre de vacante</th>
							{% endif %}
							<th>Candidato</th>
			               	<th>Fecha de solicitud</th>
			                <th>Ejecutivo</th>
							<!-- info expedient can -->
							<!-- <th>Estatus anterior</th> -->

							<!-- info expedient can -->

							<!-- candidato info ini -->
							<th>CURP</th>
							<th>Correo</th>
							<th>Teléfono </th>
							<th>Celular</th>
							<th>No. seguro social</th>
							<!-- candidato info fin -->

							<th>Centro de costos</th>
							<th>Contacto empresa</th>
							<th>Estado</th>
							<th>Municipio</th>


							<!-- datos vacante ini -->
							<th>Folio vacante</th>
							<th>Edad min vacante</th>
							<th>Edad max vacante</th>

							<th>Sueldo min vacante</th>
							<th>Sueldo max vacante</th>
							<th>Idioma vacante</th>
							<th>Sexo vacante</th>
						
							<th>Tipo pago vacante </th>
							<th>Prestación vacante </th>
							<th>Generación vacante </th>

							<!-- datos vacante fin -->

							
							<th class="all">Acciones</th>

			            </tr>
			        </thead>
			        <tbody>
	{% endif %}						
			            <tr >
			            	<td>{{reg.exc_id}}</td>
							{# este campo es dinamico, de acorde a lo que se mande dese el controlador #}
							{% if array_cabeceras_td_col is defined and array_cabeceras_td_col|length > 0 %}
									{% for td in array_cabeceras_td_col %}
									<td>
											{% if reg[td] is defined %}
												<span>
												{{ reg[td] }}
												<span>

											{% endif %}
										</td>
									{% endfor %}
							{% endif %}

							<td>
								<span class="badge 
										{{ expediantecan.getEstatusBanderaColor(reg.exc_estatus) }}
										p-2">		
								{{expediantecan.getEstatusTexto(reg.exc_estatus)}}
								</span>
							</td>
							
							<td class="text-uppercase" title="{{ reg.emp_alias }}">
								<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
									{{ reg.emp_nombre }}

								</span>	
							</td>
							{% if cav_nombre_mostrar_manualmente =="1" %}
							<td>{{reg.cav_nombre}}</td>
							{% endif %}
							<td class="text-uppercase" title="{{ reg.emp_alias }}">
								<span class="candidato-funtion-get-info" style="cursor: pointer;" data-can-id="{{ reg.can_id }}" >
									{{ reg.nombre_completo_candidato }}

								</span>	
							</td>
							<td>{{reg.exc_registro}}</td>
							<td>{{reg.exc_eje_nombre}}</td>
					
							<!-- datos can inicio -->

							<td>{{reg.can_curp}}</td>
							<td>{{reg.can_correo}}</td>
							<td>{{reg.can_telefono}}</td>
							<td>{{reg.can_celular}}</td>
							<td>{{reg.can_nosegsocial}}</td>

							<!-- datos can fin -->

							<td>{{reg.cen_nombre}}</td>

							<!-- datos del contacto ini -->
							<td>{{reg.cne_nombre_completo}}</td>
						
							<!-- datos del contacto fin -->

							<td>{{reg['est_nombre']}}</td>
							<td>{{reg.mun_nombre}}</td>
							
							<!-- datos de la vacante inicio-->
							<td>{{reg.vac_id}}</td>
							<td>{{reg.vac_edadmin}}</td>
							<td>{{reg.vac_edadmax}}</td>
							<td>{{reg.vac_sueldomin}}</td>
							<td>{{reg.vac_sueldomax}}</td>
							<td>{{reg.vac_idioma}}</td>
							<td>{{reg.sex_nombre}}</td>
							
							<td>{{reg.tpg_nombre}}</td>
							<td>{{reg.pre_nombre}}</td>
							<td>{{reg.gen_nombre}}</td>
							<!-- datos de la vacante  fin-->

					

							
							<td width="7%">
							{% include "/consulta/complementos/opciones_exc.volt" %}
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

