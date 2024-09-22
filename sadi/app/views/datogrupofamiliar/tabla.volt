<!-- <div style="padding-top: 25px"> -->
    {% for dgd in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="datogrupofamiliardetalles_table" class="table table-striped table-bordered dt-responsive" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Parentesco</th>
		                <th>Edad</th>
		                <th>Estado civil</th>
		                <th>Nivel de estudios</th>
		                <th>Vive con el candidato</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
							{{ dgd.dgd_id }}
						</td>
		                <td class="uppercase">
		                	{{ dgd.dgd_nombre }}
		               	</td>
		                <td class="uppercase">
		                	{{ dgd.dgd_parentesco }}		                
		                </td>
		                <td  class="uppercase">
							{{ dgd.dgd_edad }}
						</td>
						<td class="uppercase">
							{% if dgd.esc_id is defined %}
							{{ ObejectoEstadoCivil.getNombreEstadoCivil(dgd.esc_id) }}
							{% endif %}
							
						</td>
		                
		            
						
						<td class="uppercase">
							{% if dgd.niv_id is defined %}
							{{ ObejectoNivelEstudio.getNombreNivelEstudio(dgd.niv_id) }}
							{% endif %}
						</td>

						<td class="uppercase">
							
							{% if dgd.dgd_viveusted==1 %}
							SI
							{% endif %}
							{% if dgd.dgd_viveusted==0 %}
							NO
							{% endif %}
						</td>
							
					
		                	
						<td>
		                	<a data-toggle="modal" title="Editar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-familiar-candidato-modal" onclick="fnEditarDatoGrupoFamiliarDetalles('{{ dgd.dgd_id }}');" >
			                	<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
			                </a>
			                
		                
			                <a title="Eliminar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarDatoGrupoFamiliarDetalles('{{ dgd.dgd_id }}')">
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