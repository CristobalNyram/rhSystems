<div style="padding-top: 25px">
{% for his in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="historialtable" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Descarga folio</th>
		                <th>Tipo de documento</th>
		                <th>Fecha de descarga</th>
		                <th>Usuario</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ his.his_id }}
		               	</td>
		                <td class="uppercase">
		                	{{ his.getTipo() }}		                
		                </td>
		                <td><span style="display:none;">{{ date("Y-m-d",strtotime(his.his_fecharegistro)) }}</span>{{ date("d-m-Y",strtotime(his.his_fecharegistro)) }}</td>
		                <td>{{user.getNombre(his.usu_id)}}</td>
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