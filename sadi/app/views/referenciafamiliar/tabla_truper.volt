<!-- <div style="padding-top: 25px"> -->
    {% for ref in page %}
    {% if loop.first %}

		       
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
			<table id="dato_referenciafamiliar_truper_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">			
				<thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Edad</th>
                        <th>Teléfono                        </th>
						<th>Parentesco</th>
						<th>Ocupación                        </th>
						<th>Dirección                        </th>
						<th>Conoce su empleo</th>
						<th>Lo recomiendad</th>

						<th>Notas</th>


						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ ref.ref_id }}
						
						</td>
						<td class="uppercase">
                            {{ ref.ref_nombre }}
						
						</td>
						<td>
							{{ ref.ref_edad }}
						</td>
		                <td class="uppercase">
		                	{{ ref.ref_telefono }}
		               	</td>
						
						<td class="uppercase">
		                	{{ ref.ref_parentesco }}
		               	</td>
		   
						<td class="uppercase">
		                	{{ ref.ref_ocupacion }}
		               	</td>
						
						<td class="uppercase">
		                	{{ ref.ref_direccion }}
		               	</td>

						
						<td class="uppercase">
							
		                	{{ ref.ref_conocesuempleo }}

		               	</td>
					
						
						<td class="uppercase">
		                	{{ obj_seccion_personal.getRecomienda_formatotruper( ref.ref_lorecomienda) }}
		               	</td>

				
						<td class="uppercase">
		                	{{ ref.ref_comentario }}
		               	</td>
							
					
		                	
						<td>
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referenciafamiliar-truper-modal" onclick="fnEditarReferenciaFamiliarFormatoTruper('{{ref.ref_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaFamiliarlGeneral('{{ ref.ref_id }}',fnCargarTablaDatoReferenciaFamiliarFormatoTruper)">
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