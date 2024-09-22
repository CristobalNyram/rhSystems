{% for reg in registros %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_rve_general" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Nombre ejecutivo</th>

						<th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td class="text-uppercase">{{ reg.rve_id }}</td>
						<td class="text-uppercase">{{ reg.eje_nombre }}</td>
		              

		                <td width="7%">
							<a data-toggle="modal" type="button" title="Quitar de compartir" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnEliminarRVE_general('{{ reg.rve_id }}','{{ reg.vac_id }}',fnCompartirVacanteEje,load_table_rel_vacOrder)">
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