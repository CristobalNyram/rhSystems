{% include "/psicometria/complementos/permisos_general.volt" %}
{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_psicometria_general" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Fec. alta</th>
						<th>Calificación </th>
						<th>Observaciones</th>
						<th>Vacante</th>
						<th>Empresa</th>
						<th>Candidato</th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ejecutivo</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>{{ reg.exc_id }}</td>
						<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fecharegistro)) }}'>
							{{ date("d-m-Y",strtotime(reg.vac_fecharegistro)) }}
						</td>
						{% if reg.psi_calificacion is defined %}
							<td class="uppercase"> {{reg.psi_calificacion}}</td>
						{% else %}
							<td>Sin calificación</td>
						{% endif %}

						{% if reg.psi_observacion is defined %}
							<td class="uppercase">
								{{ reg.psi_observacion }}
							</td>
						{% else %}
							<td>Sin observaciones</td>
						{% endif %}
						<td>
							{{ reg.cav_nombre }}
						</td>
						<td class="text-uppercase" title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>	
						</td>
						<td class="text-uppercase">
							<span class="candidato-funtion-get-info" style="cursor: pointer;" data-can-id="{{ reg.can_id }}" >
								{{ reg.can_nombre }}
							</span>
						</td>
						<td>
							{{ reg.est_nombre }}
						</td>
						<td>
							{{ reg.mun_nombre }}
						</td>
						<td>
							{{ reg.exc_eje_nombre }}
						</td>
						<td class="text-uppercase">
							{% include "/psicometria/complementos/opciones_general.volt" %}
						</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}