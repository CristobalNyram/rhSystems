<!-- <div style="padding-top: 25px"> -->
    {% for sei in page %}
    {% if loop.first %}

	<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="dato_situacioneconomicaingresos_candidato__truper_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead class="thead-light-crm">
	
		            <tr>
						<th>ID</th>
		                <th>Concepto</th>
		           

		                <th>Aportación</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
							{{ sei.sei_id }}
						</td>
		      
		                <td class="uppercase">
		                	{{ sei.sei_concepto }}		                
		                </td>
		        
						
						<td class="uppercase">
                            {{ sei.sei_aportacion }}
						
						</td>

					
							
					
		                	
						<td>
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-situacioneconomica-candidato-ingreso-truper-modal" onclick="fnEditarSituacionEconomicaIngresosCandidatoFormatoTruper('{{sei.sei_id }}')" >
			                	<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
			                </a>
			                
		                
			                <a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarSituacionEconomicaIngresosCandidato('{{ sei.sei_id }}',fnCargarTablaDatoSituacioneEconomicaIngresosCandidato_FormatoTruper)">
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