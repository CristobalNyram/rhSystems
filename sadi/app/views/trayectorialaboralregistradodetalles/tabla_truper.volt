{% for trd in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_trayectorialaboralregistradodetalles_truper_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Empresa</th>
		                <th>Informada</th>
                        <th>Observaciones</th>
		                

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ trd.trd_id }}
						
						</td>
						<td>
							{{ trd.trd_empresa }}
						</td>
		                <td class="uppercase">
		                	{{ objt_trd.get_informada( trd.trd_informada )}}
		               	</td>
		                <td class="uppercase">
		                	{{ trd.trd_observaciones }}		                
		                </td>
		        
					
						
					
							
					
		                	
                <td width="7%">                   
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-trayectorialaboralregistradodetalles-formato-truper-modal" onclick="fnEditarTrayectorialaboralRegistradoDetallesFormatoTruper('{{trd.trd_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaTrayectoriaLaboralRegistradoDetallesGeneral('{{ trd.trd_id }}',fnCargarTablaDatoTrayectorialaboralregistradodetallesFormatoTruper)">
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