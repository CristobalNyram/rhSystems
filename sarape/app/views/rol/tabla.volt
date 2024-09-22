{% for rol in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_rol" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ rol.rol_id }}</td>
		                <td>{{ rol.rol_nombre }}</td>
		                <td>{{ rol.getEstatusDetail() }}</td>
		                <td width="12%">
		                	{{ link_to("rol/editar/"~rol.rol_id, '<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>', "class": "","title":"Editar") }}
		                 	<a type="button" class="" title='Eliminar' onclick="fnelim({{rol.rol_id}})"><i class="mdi mdi-delete mdi-18px btn-icon"></i></a>
		                 	{{ link_to("rol/permiso/"~rol.rol_id, '<i class="mdi mdi-format-list-checks mdi-18px btn-icon"></i>', "class": "","title":"Permisos") }}
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
<?php echo session_save_path() ?>