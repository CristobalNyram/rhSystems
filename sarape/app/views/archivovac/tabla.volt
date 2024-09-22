<!-- <div style="padding-top: 25px"> -->
{{ mensaje }}
{% for reg in page %}
    {% if loop.first %}
		    <table 
			id="td_archivos_vac" 
			class="col-12 table table-striped table-bordered dt-responsive nowrap" 
			style="border-collapse: collapse; border-spacing: 0; width: 100%;" 
			width="100%"
			>
		        <thead class="thead-light-crm" style="width: 100vw;" >
		            <tr>
		                <th>Folio</th>
		            	<th>Nombre</th>
		            	<th>Categoria</th>
						<th class="all">Acciones</th>

		            </tr>
		        </thead>
		        <tbody style="width: 100vw;" >
		        {% endif %}
		            <tr>
		                <td>
		                	{{ reg.arv_id }}
		               	</td>
						<td>
		                	{{ reg.arv_nombre }}
		               	</td>
						<td>
		                	{{ reg.ctv_nombre }}
		               	</td>
					
						<td>
							{% include "/archivovac/complementos/opciones_archivo.volt" %}

						</td>
		               
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}
<!-- </div> -->