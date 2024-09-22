{% include "/cita/complementos/permisos_general.volt" %}

{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_cit_tabla_general" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Fecha cita</th>
						<th>Tipo cita</th>
						<th>Vacante</th>
						<th>Empresa</th>
						<th>Candidato </th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ejecutivo</th>
						<th class="all">Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
						{{ reg.exc_id }}
						</td>
						{% if reg.cit_fecha is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.cit_fecha ~ reg.cit_hora )) }}'>{{ date("d-m-Y H:i", strtotime(reg.cit_fecha ~ reg.cit_hora)) }}</td>
						{% else %}
							<td>Sin fecha</td>
						{% endif %}
						<td>{{ reg.tic_nombre }}</td>
						<td width="100px">
							{{ reg.cav_nombre }}
						</td>
						<td title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>
							
						</td>

						<td>
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
						

						<td class="text-uppercase" width="7%">
						{% include "/cita/complementos/opciones_general.volt" %}
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
