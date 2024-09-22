{% for tyl in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_trayectorialaboral_truper_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Empresa (MARCA)</th>
		                <th>Empresa contratante</th>
                        <th>Periodo</th>
                        <th>Observaciones</th>
		                

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ tyl.tyl_id }}
						
						</td>
						<td>
							{{ tyl.tyl_empresamarca }}
						</td>
		                <td class="uppercase">
		                	{{ tyl.tyl_empresacontratante }}
		               	</td>
                           <td class="uppercase">
		                	{{ tyl.tyl_periodo }}		                
		                </td>
                        <td class="uppercase">
		                	{{ tyl.tyl_comentario }}		                
		                </td>
		        
					
						
					
							
					
		                	
                <td width="7%">                   
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-trayectorialaboral-formato-truper-modal" onclick="fnEditarTrayectorialaboralFormatoTruper('{{tyl.tyl_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaTrayectoriaLaboralGeneral('{{ tyl.tyl_id }}',fnCargarTablaDatoTrayectorialaboralFormatoTruper)">
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