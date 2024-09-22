<div style="padding-top: 25px">
{% for rol in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_rol" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
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
		                	{{ link_to("rol/editar/"~rol.rol_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	<!-- {% if acceso.verificar(43)==1 %}
		                	{{ link_to("rol/editar/"~rol.rol_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	{% endif %} -->
		                	<!-- {% if acceso.verificar(44)==1 %}
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim({{rol.rol_id}})"><i class="fa fa-trash-o"></i></a>
		                 	{% endif %} -->
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim({{rol.rol_id}})"><i class="fa fa-trash-o"></i></a>
		                 	<!-- {% if acceso.verificar(45)==1 %}
		                 	{{ link_to("rol/permiso/"~rol.rol_id, '<i class="fa fa-tasks"></i>', "class": "btn","title":"Permisos") }}
		                 	{% endif %} -->
		                 	{{ link_to("rol/permiso/"~rol.rol_id, '<i class="fa fa-tasks"></i>', "class": "btn","title":"Permisos") }}
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