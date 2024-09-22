<!-- <div style="padding-top: 25px"> -->
{{ mensaje }}
{% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive col-12" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_archivos" class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio</th>
		            	<th>Nombre</th>
		            	<th>Categoria</th>
						<th>Expediente ID</th>
						<th class="all">Acciones</th>

		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ arc.arc_id }}
		               	</td>
						<td>
		                	{{ arc.arc_nombre }}
		               	</td>
						<td>
		                	{{ arc.cat_nombre }}
		               	</td>
						<td>
		                	{{ arc.exc_id }}
		               	</td>
						<td>
							{% include "/archivo/complementos/opciones_archivo.volt" %}

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