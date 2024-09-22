<!-- <div style="padding-top: 25px"> -->
    {% for per in page %}
    {% if loop.first %}
		<div class="table-responsive m-3 col-12" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_periodoinactivo_table"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Motivo</th>
						<th>Fecha</th>

						<th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ per.per_id }}
						
						</td>
						<td>
							{{ per.per_motivo }}
						</td>
		                <td class="uppercase">
							{% if  per.per_fecha is defined %}
							{{ per.per_fecha }}

							{% else %}
							{% endif %}
		               	</td>

		               
						
					
							
					
		                	
						<td>
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-periodoinactivo-modal" onclick="fnEditarPeriodoInactivo('{{per.per_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaPeriodoInactivo('{{per.per_id }}')">
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
	    No existen registros en este catálogo.
{% endfor %}
<!-- </div> -->