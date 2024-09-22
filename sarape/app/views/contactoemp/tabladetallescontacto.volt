{% for con in page %}
    {% if loop.first %}
    	<h5>Contactos</h5>
		<div class="mt-1 col-12">
		    <table id="recibo" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Nombre</th>
		                <th>Puesto</th>
		                <th>Correo</th>
		                <th>Celular</th>
		                <th>Tel</th>
		                <th>Ext</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ con.cnc_nombre }} {{ con.cnc_primerapellido }} {{ con.cnc_segundoapellido }}</td>
		                <td>{{ con.cnc_puesto }}</td>
		                <td>{{ con.cnc_correo }}</td>
		                <td>{{ con.cnc_celular }}</td>
		                <td>{{ con.cnc_tel }}</td>
		                <td>{{ con.cnc_ext }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros de contactos.
{% endfor %}