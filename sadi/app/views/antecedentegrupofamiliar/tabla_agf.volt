<!-- <div style="padding-top: 25px"> -->
    {% for agd in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_antecedentesgrupofamiliardetalles_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Empresa</th>
		                <th>Puesto</th>
		                <th>Antigüedad</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
							{{ agd.agd_id }}
						</td>
		                <td class="uppercase">
		                	{{ agd.agd_nombre }}
		               	</td>
		                <td class="uppercase">
		                	{{ agd.agd_empresa }}		                
		                </td>
		                <td  class="uppercase">
							{{ agd.agd_puesto }}
						</td>
						
		                
		            
						
						<td class="uppercase">
                            {{ agd.agd_antiguedad }}
						
						</td>

					
							
					
		                	
						<td>
							<a data-toggle="modal" title="Editar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-familiar-antecedente-laboral-modal" onclick="fnEditarDatoAntecedentesLaboralesGrupoFamiliarDetalles('{{agd.agd_id }}')" >
			                	<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
			                </a>
			                
		                
			                <a title="Eliminar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarDatoAntecedentesLaboralesGrupoFamiliarDetalles('{{ agd.agd_id }}')">
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