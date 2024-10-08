{% for dat in datostabla %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		            	<th>Clave</th>
		                <th>Estado</th>
		                <th>Estatus</th>
		               	<th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		            	<td>{{ dat.est_clave }}</td>
		                <td>{{ dat.est_nombre }}</td>
		                <td>
			                {{ dat.getEstatusDetail() }}
		                </td>
		                <td width="7%">
		                	<a data-toggle="modal" type="button" title="Editar" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_trabajador-modal" onclick="fneditar('{{ dat.est_id }}','{{dat.est_nombre}}')"><i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
				            </a>
				            <a type="button" title="Eliminar" onclick="fneliminar('{{ dat.est_id }}','{{dat.est_nombre}}')"><i class="mdi mdi-trash-can-outline mdi-18px btn-icon"></i>
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