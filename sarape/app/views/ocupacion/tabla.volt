{% for reg in registro %}
    {% if loop.first %}
		<div class="table-responsive mt-1 col-12">
		    <table id="td_ocupacion" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Nombre</th>
						<th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ reg.ocu_nombre }}</td>
		                <td width="7%">
		                	<a data-toggle="modal" type="button" title="Editar" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_negocio-modal" onclick="fneditnegocio('{{ reg.ocu_id }}','{{ reg.ocu_nombre }}')">
		                		<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
		                	</a>
							<a data-toggle="modal" type="button" title="Eliminar" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnelinegocio('{{ reg.ocu_id }}','{{ reg.ocu_nombre }}')">
		                		<i class="mdi mdi-delete mdi-18px btn-icon"></i>
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