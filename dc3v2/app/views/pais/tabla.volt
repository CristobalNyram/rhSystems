<div style="padding-top: 25px">
{% for pai in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_pais" class="table table-striped table-bordered" cellspacing="0"  align="center">
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
		                <td>{{ pai.pai_id }}</td>
		                <td>{{ pai.pai_nombre }}</td>
		                <td>{{ pai.getEstatusDetail() }}</td>
		                <td width="7%">
		                	{% if acceso.verificar(39)==1 %}
		                	{{ link_to("pais/editar/"~pai.pai_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	{% endif %}
		                	{% if acceso.verificar(40)==1 %}
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{pai.pai_id}}')"><i class="fa fa-trash-o"></i></a>
		                 	{% endif %}
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
