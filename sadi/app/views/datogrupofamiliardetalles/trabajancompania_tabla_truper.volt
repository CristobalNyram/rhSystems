<!-- tabla de familiares que viven o no viven con el candidato -->

<!-- <div style="padding-top: 25px"> -->
    {% for dgd in page %}
    {% if loop.first %}
	<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="datogrupofamiliardetalle_trabajancompania_formato_truper_table" class="table table-striped table-bordered dt-responsive" cellspacing="0"  align="center">
			<thead class="thead-light-crm">
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Parentesco</th>
					<th>Puesto</th>
					<th>Área</th>
					<th>Teléfono</th>
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
						{{ ObejectoDatoGrupoFamiliar.getParentesto_formatotruper(dgd.dgd_parentesco) }}		                

					</td>

					<td  class="uppercase">
						{{ dgd.dgd_puesto }}
					</td>

					<td class="uppercase">	
						{{ dgd.dgd_area}}

					</td>
					
				
					
					<td class="uppercase">		
						{{ dgd.dgd_telefono }}

					</td>

			
						
				
						
					<td>
						<a data-toggle="modal" title="Editar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-familiartrabacompania-formato_truper-modal" onclick="fnEditarDatoGrupoFamiliarDetalles_trabacompania_formato_truper('{{ dgd.dgd_id }}');" >
							<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
						</a>
						
					
						<a title="Eliminar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarDatoGrupoFamiliarDetalles_formato_truper('{{ dgd.dgd_id }}',fnCargarDatogrupofamiliardetallesTrabajanCompaniaFormatoTruper,' datos de grupo familiar que trabajan en la compañia ')">
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