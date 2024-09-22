<!-- <div style="padding-top: 25px"> -->
{% for con in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="centro" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>Correo</th>
		                <th>Tel</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ con.cen_clave }}</td>
		                <td>{{ con.cen_nombre }}</td>
		                <td>{{ con.cen_correo }}</td>
		                <td>{{ con.cen_tel }}</td>
		                <td>
		                	<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#centroeditar-modal" onclick="fneditcentro('{{con.cen_id}}','{{ con.cen_nombre }}')">
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
<!-- </div> -->