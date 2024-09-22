<!-- <div style="padding-top: 25px"> -->
    {% for sec in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_situacioneconomicacredito_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Institución</th>
		                <th>Tipo</th>
                        <th>Saldo</th>

		                <th>Pago mensual</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ sec.sec_id }}
						
						</td>
						<td>
							{{ sec.sec_institucion }}
						</td>
		                <td class="uppercase">
		                	{{ sec.sec_tipo }}
		               	</td>
		                <td class="uppercase">
		                	{{ sec.sec_saldo }}		                
		                </td>
		                <td  class="uppercase">
							{{ sec.sec_mensual }}
						</td>
						
					
							
					
		                	
						<td>
				
							
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-situacioneconomica-credito-modal" onclick="fnEditarSituacionEconomicaCreditos('{{sec.sec_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarSituacionEconomicaCreditoss('{{ sec.sec_id }}')">
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