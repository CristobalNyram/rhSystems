{% for hon in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="honorariotable" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio</th>
		                <th>Estudio</th>
		                <th>Honorario</th>
		                <th>Honorario 2</th>
		                <th>Honorario 3</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ hon.ute_id }}</td>
		                <td class="uppercase">
		                	{{ hon.tip_nombre }}		                
		                </td>
		                <td>{{ hon.ute_honorario }}</td>
		                <td>{{ hon.ute_honorario2 }}</td>
		                <td>{{ hon.ute_honorario3 }}</td>
		                <td>
		                	<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneliminarhonorario('{{hon.ute_id}}', '{{hon.usu_id}}')">
		                      	<i class="mdi mdi-delete mdi-18px btn-icon"></i>
		                    </a>
		                    
		                </td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen honorarios cargados para este usuario
{% endfor %}