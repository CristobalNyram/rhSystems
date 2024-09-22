{# permisos #}
{% set veinte = acceso.verificar(20,rol_id) %}
{# permisos #}

{% for tp_asig in transporte_asignados %}
	{% if loop.first %}
		<div class="mt-1 col-12">
			<table id="td_transporte" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead class="thead-light-crm">
					<tr>
						<th>ID</th>
						<th title="Columna que indica el monto que se ha pre aprobado por un administrador..." data-toggle="tooltip" data-placement="top">Monto preaprobado</th>
						<th title="Columna que indica el monto que has solicitado a un administrador..." data-toggle="tooltip" data-placement="top">Monto solicitado</th>
						<th title="Columna que indica el ORIGEN de donde partirá o partió tu transporte." data-toggle="tooltip" data-placement="top">Origen
						</th>
						<th title="Columna que indica el DESTINO de donde partirá o partió tu transporte." data-toggle="tooltip" data-placement="top">Destino</th>
						<th title="Columna que indica el comentario tu transporte." data-toggle="tooltip" data-placement="top">Comentario/Nota</th>
						<th class="all">Opciones</th>
					</tr>
				</thead>
				<tbody>
				{% endif %}
				<tr>
					<td>{{ tp_asig.tra_id }}</td>
					<td>${{ tp_asig.tra_preaprobado }}</td>
					<td class="uppercase">
						{% if tp_asig.tra_solicitado=='' %}
							No lo has solicitado
						{% endif %}
						{% if tp_asig.tra_solicitado==!'' %}
							${{ tp_asig.tra_solicitado }}
						{% endif %}
					</td>
					<td>
						{% if tp_asig.tra_origen=='' %}
							SIN ASIGNAR
						{% endif %}
						{{tp_asig.tra_origen}}
					</td>
					<td>
						{% if tp_asig.tra_destino=='' %}
							SIN ASIGNAR
						{% endif %}
						{{tp_asig.tra_destino}}
					</td>
					<td>
						{% if tp_asig.tra_comentario=='' %}
							SIN ASIGNAR
						{% endif %}
						{{tp_asig.tra_comentario}}
					</td>
					<td width="7%">
						{% include "/transporte/complementos/opciones_asignados.volt" %}
					</td>
				</tr>
				{% if loop.last %}
				</tbody>
			</table>
		</div>
	{% endif %}
{% else %}
	Aún no tiene transportes asignados, en esta sección se mostrará los transportes asignados a los
	<strong>
		investigadores</strong>
	.
{% endfor %}
