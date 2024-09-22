<!-- <div style="padding-top: 25px"> -->
{% for cop in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="comentariotableese" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                
		                <th>Comentario</th>
		                
		                <th>Autor</th>
		                <th>Fecha</th>
		               
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                
		                <td class="uppercase">
		                	{{ cop.com_comentario }}		                
		                </td>
		                
		                <td>{{ user.getNombre(cop.usu_id) }}</td>
		                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s", strtotime(cop.com_fecharegistro)) }}'>{{ date("d-m-Y", strtotime(cop.com_fecharegistro)) }}</td>
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