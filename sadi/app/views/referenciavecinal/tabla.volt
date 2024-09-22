<!-- <div style="padding-top: 25px"> -->
    {% for rev in page %}
    {% if loop.first %}

		       
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
			<table id="dato_referenciavecinal_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">			
				<thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Tiempo de conocerlo</th>
                        <th>Domicilio</th>
						<th>Teléfono</th>
						<th>Concepto de candidato</th>
						<th>Concepto de familia</th>
						<th>Tiene hijos</th>
						<th>Trabaja</th>
						<th>Estado civil</th>

						<th>Notas</th>


						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ rev.rev_id }}
						
						</td>
						<td class="uppercase">
                            {{ rev.rev_nombre }}
						
						</td>
						<td>
							{{ rev.rev_tiempo }}
						</td>
		                <td class="uppercase">
		                	{{ rev.rev_domicilio }}
		               	</td>
						
						<td class="uppercase">
		                	{{ rev.rev_telefono }}
		               	</td>
		   
						<td class="uppercase">
		                	{{ rev.rev_conceptocandidato }}
		               	</td>
						
						<td class="uppercase">
		                	{{ rev.rev_conceptofamilia }}
		               	</td>

						
						<td class="uppercase">
							
							{{  objectReferenciavecinal.getSiNo(rev.rev_hijos) }}

		               	</td>
					
						
						<td class="uppercase">
		                	{{  objectReferenciavecinal.getSiNo(rev.rev_trabaja) }}
		               	</td>

						<td class="uppercase">
		                	{{ objectEstadoCivil.getNombreEstadoCivil(rev.esc_id) }}
		               	</td>
						<td class="uppercase">
		                	{{ rev.rev_notas }}
		               	</td>
							
					
		                	
						<td>
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referenciavecinal-modal" onclick="fnEditarReferenciaVecinal('{{rev.rev_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaVecinal('{{ rev.rev_id }}')">
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