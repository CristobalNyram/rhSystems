<!-- <div style="padding-top: 25px"> -->
{{ mensaje }}
{% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_comentariosseguimiento" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
		            	<th>Comentario</th>
		            	<th>Usuario</th>
						<th>Fecha registro</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ arc.com_id }}
		               	</td>
						<td>
		                	{{ arc.com_comentario }}
		               	</td>
						<td>
		                	{{ arc.nombre }}
		               	</td>
						<td data-order='{{ date("Y-m-d H:i:s", strtotime(arc.com_fecharegistro)) }}'>
                            {{ date("d-m-Y H:i", strtotime(arc.com_fecharegistro)) }}
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