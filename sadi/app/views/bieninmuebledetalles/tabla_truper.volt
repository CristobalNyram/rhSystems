<!-- <div style="padding-top: 25px"> -->
    {% for bid in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_bieninmuebledetalles_truper_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Bien</th>
		                <th>Antigüedad						</th>
                        <th>Valor</th>

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ bid.bid_id }}
						
						</td>
						<td class="uppercase">
                            {{ obj_bieninmueble.getNombreBienInmueble_FormatoTruper(bid.bid_nombre) }}
						
						</td>
						<td>
							{{ bid.bid_antiguedad }}
						</td>
		                <td class="uppercase">
		                	{{ bid.bid_valor }}
		               	</td>
		   
						
					
							
					
		                	
						<td>
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-bieninmuebledetalles-formato_truper-modal" onclick="fnEditarBienInmuebleDetallesFormatoTruper('{{bid.bid_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarBienInmuebleDetallesGeneral('{{ bid.bid_id }}',fnCargarTablaDatoBienInmuebleDetallesFormatoTruper)">
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