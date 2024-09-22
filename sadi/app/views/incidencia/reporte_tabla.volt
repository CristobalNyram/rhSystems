
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>#</th>
                        <th>ID SADI</th>
                        <th>NOMBRE CANDIDATO</th>
                        <th>NOMBRE DE LA EMPRESA</th>
                        <th>INCIDENCIA</th>
                        <th>ACTUALIZACIÓN</th>
                        <th>INVESTIGADOR</th>
                        <th>ANALISTA QUE REGISTRA</th>
		            </tr>
		        </thead>
		        <tbody>
                {% endif %}
              		<tr>
                        <td>{{loop.index}}</td>
                        <td>{{ reg.ese_id }}</td>
                        <td>{{ reg.candidato }}</td>
                        <td>{{ reg.emp_nombre }}</td>
                        <td>{{ reg.inc_texto }}</td>
                        <td data-order='{{ date("Y-m-d",strtotime(reg.fecharegistro)) }}'>{{ date("d-m-Y", strtotime(reg.fecharegistro)) }}</td>
                        <td>{{ reg.investigador }}</td>
                        <td>{{ reg.analista }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}

