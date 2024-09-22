{% include "/expedientecan/complementos/permisos_rel_vac.volt" %}
{% for reg in registros %}
{% if loop.first %}
<table id="td_rel_vac_tabla" class="table table-striped table-bordered dt-responsive"
	style="border-collapse: collapse; border-spacing: 0; width: 100%;">
	<thead class="thead-light-crm">
		<tr style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<th>ID</th>
			<th>Candidato </th>
			<th>Fecha alta</th>
			<th>Fecha cita</th>
			<th>Estatus</th>
			<th>Fecha referencia</th>
			<th>Fecha psicometría</th>
			<th>Fecha autorización</th>
			<th>Fecha entrevista</th>
			<th>Fecha facturación</th>
			{% if sesentaycuatro==1 %}
			<th>Ejecutivo</th>
			{% endif %}
			<th class="all">Acciones</th>
		</tr>
	</thead>
	<tbody>
		{% endif %}
		<tr>
			<td>
				{{ reg.exc_id }}
			</td>
			<td>
				{{ reg.can_nombre }}
			</td>
			{% if reg.exc_registro is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.exc_registro)) }}'>{{ date("d-m-Y",
				strtotime(reg.exc_registro)) }}</td>
			{% else %}
			<td></td>
			{% endif %}
			{% if reg.cit_fecha is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.cit_fecha)) }}'>{{ date("d-m-Y",
				strtotime(reg.cit_fecha)) }}</td>
			{% else %}
			<td></td>
			{% endif %}
			<td data-order="{{reg.exc_estatus}}">
				<span {% if reg.exc_estatus==6 %}
					title="EL EXPEDIENTE SE FACTURÓ EN EL ESTATUS VACANTE: {{ obj_vac.getEstatusTexto(reg.fat_vac_esatus) }} FOLIO  {{reg.fat_id}}"
					{% endif %} class="badge 
										{{ obj_exc.getEstatusBanderaColor(reg.exc_estatus) }}
										p-2">
					{{ obj_exc.getEstatusTexto(reg.exc_estatus) }}
				</span>
			</td>
			{% if reg.sel_registro is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.sel_registro)) }}'>{{ date("d-m-Y",
				strtotime(reg.sel_registro)) }}</td>
			{% else %}
			<td></td>
			{% endif %}

			{% if reg.psi_fecharegistro is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.psi_fecharegistro)) }}'>{{ date("d-m-Y",
				strtotime(reg.psi_fecharegistro)) }}</td>
			{% else %}
			<td></td>
			{% endif %}


			{% if reg.exc_fechaautorizo is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.exc_fechaautorizo)) }}'>{{ date("d-m-Y",
				strtotime(reg.exc_fechaautorizo)) }}</td>
			{% else %}
			<td></td>
			{% endif %}

			{% if reg.ent_fecha is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.ent_fecha)) }}'>{{ date("d-m-Y",
				strtotime(reg.ent_fecha)) }}</td>
			{% else %}
			<td></td>
			{% endif %}

			{% if reg.exc_fechafacturacion is defined %}
			<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.exc_fechafacturacion)) }}'>{{ date("d-m-Y",
				strtotime(reg.exc_fechafacturacion)) }}</td>
			{% else %}
			<td></td>
			{% endif %}
			{% if sesentaycuatro==1 %}
			<td>
				{{ reg.exc_eje_nombre }}
			</td>
			{% endif %}
			<td>
				{% include "/expedientecan/complementos/opciones_rel_vac.volt" %}
			</td>
		</tr>
		{% if loop.last %}
	</tbody>
</table>
{% endif %}
{% else %}
No existen registros en este catálogo.
{% endfor %}