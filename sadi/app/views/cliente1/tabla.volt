{% for dat in estudios %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_cliente" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>ID</th>
		                <th>Candidato</th>
		                <th>Estado</th>
                        <th>Municipio</th>
                        <th>Fecha solicitud</th>
                        <th>Fecha entrega</th>
                        <th>Estatus</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
                        <td>{{ dat.ese_id }}</td>
		                <td>{{ dat.nombre }}</td>
		                <td>{{ dat.est_nombre }}</td>
                        <td>{{ dat.mun_nombre }}</td>
                        <td data-order='{{ date("Y-m-d",strtotime(dat.ese_registro)) }}'>{{ date("d-m-Y", strtotime(dat.ese_registro)) }}</td>
                        <td data-order='{{ date("Y-m-d",strtotime(dat.ese_fechaentregacliente)) }}'>
							{% if dat.ese_fechaentregacliente is defined %}
								{{ date("d-m-Y", strtotime(dat.ese_fechaentregacliente)) }}
							{% else  %}
								PENDIENTE POR ENTREGAR
							{% endif %}
						</td>
							
							
                        <td>{{ estudio.getEstatusDetailCliente(dat.ese_estatus) }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}