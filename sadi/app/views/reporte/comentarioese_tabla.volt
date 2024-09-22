
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>ID SADI</th>
                        <th>COMENTARIO</th>
                        <th>USUARIO QUE REGISTRÓ</th>
                        <th>TIPO ESTUDIO</th>
                        <th>FECHA</th>
		            </tr>
		        </thead>
		        <tbody>
                {% endif %}
              		<tr>
                        <td>{{ reg.ese_id }}</td>
                        <td>{{ reg.com_comentario }}</td>
                        <td>{{ reg.registra }}</td>
                        <td>{{ reg.tip_nombre }}</td>
                        <td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.fecharegistro)) }}'>{{ date("d/m/Y H:i", strtotime(reg.fecharegistro)) }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}

