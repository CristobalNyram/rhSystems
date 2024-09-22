<!-- tabla de familiares que viven o no viven con el candidato -->

<!-- <div style="padding-top: 25px"> -->
    {% for dgd in page %}
    {% if loop.first %}
	<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="datogrupofamiliardetalle_viven_formato_truper_table" class="table table-striped table-bordered dt-responsive" cellspacing="0"  align="center">
			<thead class="thead-light-crm">
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Parentesco</th>
					<th>Edad</th>
					<th>Nivel de estudios</th>
					<th>Ocupación</th>
					<th>Puesto</th>
					<th>Empresa</th>
					<th>Teléfono					</th>
					<th>Estatus	de contacto				</th>

					<th>Vive con el candidato</th>
					<th class="all">Opciones</th>
				</tr>
			</thead>
			<tbody>
			{% endif %}
				<tr 
				
				{% if  dgd.dgd_viveusted is  1 %} 
				class="text-info"
				{% endif %}
				>
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
						{{ dgd.dgd_edad }}
					</td>
					<td class="uppercase">
						{% if dgd.niv_id is defined %}
						{{ ObejectoNivelEstudio.getNombreNivelEstudio(dgd.niv_id) }}
						{% endif %}
					</td>
					<td class="uppercase">
						{{  ObejectoDatoGrupoFamiliar.getOcupacionFormatoTruper(dgd.dgd_ocupacion) }}

					</td>
					<td class="uppercase">
						{{ dgd.dgd_puesto }}

					</td>
					<td class="uppercase">
						{{ dgd.dgd_empresa }}

					</td>
					<td class="uppercase">
						{{ dgd.dgd_telefono }}

							
					</td>
					<td class="uppercase">

						{% if dgd.dgd_estatucontacto is defined %}
						{{ ObejectoDatoGrupoFamiliar.getNombreEstatusContacto(dgd.dgd_estatucontacto) }}
						{% endif %}

					</td>

					
				
					
					

					<td class="uppercase">
						

						{% if dgd.dgd_viveusted is defined %}
						{{ ObejectoDatoGrupoFamiliar.getSiNoViveConElCandidato(dgd.dgd_viveusted) }}
						{% endif %}


		
					</td>
						
				
						
					<td>
						<a data-toggle="modal" title="Editar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-familiarvivecon-formato_truper-modal" onclick="fnEditarDatoGrupoFamiliarDetalles_vivecon_formato_truper('{{ dgd.dgd_id }}');" >
							<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
						</a>
						
					
						<a title="Eliminar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarDatoGrupoFamiliarDetalles_formato_truper('{{ dgd.dgd_id }}',fnCargarDatogrupofamiliardetallesVivenONoVivenFormatoTruper,' datos de grupo familiar que vive o no viven con el candidato')">
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