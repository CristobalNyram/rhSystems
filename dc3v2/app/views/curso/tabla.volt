<div style="padding-top: 25px">
{% for cur in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_curso" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>Horas</th>
		                <th>Tipo</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td class="uppercase">{{ cur.cur_clave }}</td>
		                <td class="uppercase">{{ cur.cur_nombre }}</td>
		                <td>{{ cur.cur_horas }}</td>
		                <td class="uppercase">{{ cur.getTipo() }}</td>
		                <td class="uppercase">{{ cur.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("curso/formulario/"~cur.cur_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{cur.cur_id}}','{{cur.cur_clave}}')"><i class="fa fa-trash-o"></i></a>
		                 	
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
