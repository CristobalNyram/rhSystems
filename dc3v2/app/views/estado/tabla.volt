<div style="padding-top: 25px">
{% for est in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_estado" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Nombre</th>
		                <th>País</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ est.est_nombre }}</td>
		                <td>{{ est.pai_nombre }}</td>
		                <td>
			                {% if est.est_estatus ==2 %}
			                	Alta
			                {% endif %}
			                {% if est.est_estatus ==1 %}
			                	Baja
			                {% endif %}
		                </td>
		                <td width="7%">
		                	{% if acceso.verificar(12)==1 %}
		                	{{ link_to("estado/editar/"~est.est_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	{% endif %}
		                	{% if acceso.verificar(13)==1 %}
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{est.est_id}}')"><i class="fa fa-trash-o"></i></a>
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
