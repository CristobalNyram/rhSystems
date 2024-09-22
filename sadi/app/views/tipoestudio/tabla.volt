{% for tip in tips %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_empresa" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Nombre</th>
		                <th>Descripción</th>
		                <th>Honorario</th>
						<th>Máximo de transporte</th>
						<th>Mínimo de transporte</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ tip.tip_nombre }}</td>
		                <td>{{ tip.tip_descripcion }}</td>
						<td>{{ tip.tip_honorario }}</td>
						<td>{{ tip.tip_transportemin }}</td>
                        <td>{{ tip.tip_transportemax }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}