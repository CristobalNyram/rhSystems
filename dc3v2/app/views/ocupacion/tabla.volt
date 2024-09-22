<div style="padding-top: 25px">
{% for ocu in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="ocupacion" class="table table-striped table-bordered" cellspacing="0"  align="center">
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
		                <td class="uppercase">{{ ocu.ocu_clave }}</td>
		                <td class="uppercase">{{ ocu.ocu_denominacion }}</td>
		                <td class="uppercase">{{ ocu.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("ocupacion/formulario/"~ocu.ocu_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{ ocu.ocu_id }}','{{ocu.ocu_clave}}')"><i class="fa fa-trash-o"></i></a>
		                 	
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
