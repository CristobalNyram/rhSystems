<!-- <div style="padding-top: 25px"> -->

{% for reg in page %}
{% if loop.first %}
<div class="table-responsive" id="lista-agrupada"
	style="padding-right: 20px; padding-left: 20px;">
	<table id="archivotable" class="table table-striped table-bordered"
		cellspacing="0" align="center">
		<thead class="thead-light-crm">
			<tr>
				<th>Folio</th>
				<th>Archivo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			{% endif %}
			<tr>
				<td>
					{{ reg.acc_id }}
				</td>
				<td class="uppercase">
					{{ reg.acc_nombre }}
				</td>

				<td>
					<a data-toggle="modal" title="Leer archivo" type="button" class
						data-container="body" data-toggle="popover" role="button"
						data-target="#leerarchivo-modal"
						onclick="leerarchivo('{{ reg.acc_id }}', '{{ reg.acc_nombre }}', 'cancelacion')">
						<i class="mdi mdi-eye mdi-18px btn-icon"></i>
					</a>
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
<!-- </div> -->