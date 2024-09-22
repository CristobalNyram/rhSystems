<div style="padding-top: 25px">
{% for are in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="areatematica" class="table table-striped table-bordered" cellspacing="0"  align="center">
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
		                <td>{{ are.are_clave }}</td>
		                <td class="uppercase">{{ are.are_denominacion }}</td>
		                <td class="uppercase">{{ are.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("areatematica/formulario/"~are.are_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{are.are_id}}','{{are.are_clave}}')"><i class="fa fa-trash-o"></i></a>
		                 	
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
