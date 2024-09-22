{{mensaje}}
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>ID SADI</th>
						<th>INVESTIGADOR</th>
                        <th>ENTREGA CLIENTE</th>

                        <th>MONTO HONORARIO</th>
						<th>OPCIONES</td>
		            </tr>
		        </thead>
		        <tbody>
                {% endif %}
              		<tr>
                        <td>{{ reg.ese_id }}</td>
						<td>{{ reg.investigador }}</td>
                        <td>{{ reg.ese_fechaentregacliente }}</td>
                        <td>{{ reg.investigador }}</td>
						<td>
							<a data-toggle="modal"  title="Editar Honorario" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#editar-honorario-ese-modal" onclick="fnGetInfoEditarHonorarioEse('{{reg.ese_id}}')"> 
								<i class="mdi mdi mdi-pencil-lock-outline  mdi-18px btn-icon"></i>
							</a>
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