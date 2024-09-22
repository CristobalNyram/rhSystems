<div style="padding-top: 25px">
{% for doc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_documento" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Clave</th>
		                <th>Usuario</th>
		                <th>Tipo de documento</th>
		                <th>Comentario</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ doc.doc_id }}</td>
		                <td>{{ doc.usu_nombre }} {{ doc.usu_apellidop }}</td>
		                <td>{{ doc.doc_tipo }}</td>
		                <td>{{ doc.doc_comentario }}</td>
		                <td width="7%">
		                	<a type="button" class="btn" title='Eliminar' onclick="fnelim({{doc.doc_id}})"><i class="fa fa-trash-o"></i></a>
		                	{% if doc.doc_archivo !='-' %}
		                		{{ link_to("documento/descargar/"~doc.doc_id, '<i class="fa fa-download"></i>', "class": "btn",'title':'Descargar documento') }}
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