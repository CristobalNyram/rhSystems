<div style="padding-top: 25px">
{% for con in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="contacto" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio</th>
		                <th>Nombre</th>
		                <th>Puesto</th>
		                <th>Correo</th>
						<th>Copias</th>
		                <th>Celular</th>
		                <th>Tel</th>
		                <th>Ext</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ con.cne_id }}</td>
		                <td>{{ con.cne_nombre }} {{ con.cne_primerapellido }} {{ con.cne_segundoapellido }}</td>
		                <td>{{ con.cne_puesto }}</td>
		                <td>{{ con.cne_correo }}</td>
						<td>{{ con.cne_copiaenvio }}</td>
		                <td>{{ con.cne_celular }}</td>
		                <td>{{ con.cne_tel }}</td>
		                <td>{{ con.cne_ext }}</td>
		                <td>
		                	<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#contactoeditar-modal" onclick="fneditcontacto('{{con.cne_id}}','{{ con.cne_nombre }} {{ con.cne_primerapellido }} {{ con.cne_segundoapellido }}')">
		                      	<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
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
</div>