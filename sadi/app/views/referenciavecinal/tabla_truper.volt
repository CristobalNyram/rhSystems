<!-- <div style="padding-top: 25px"> -->
    {% for rev in page %}
    {% if loop.first %}

		       
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
			<table id="dato_referenciavecinal_truper_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">			
				<thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Edad</th>
                        <th>Teléfono						</th>
						<th>Dirección						</th>
						<th>Tiempo de conocerle						</th>
						<th>Como lo conoció						</th>
						<th>Conoce su domicilio						</th>
						<th>Conoce su estado civil						</th>
						<th>Conoce su empleo						</th>

						<th>Sabe sus pasatiempos						</th>
						<th>Concepto de él o ella						</th>
						<th>Lo recomienda						</th>

						<th>Comentarios						</th>


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
							{{ rev.rev_edad}}
						</td>
		                <td class="uppercase">
		                	{{ rev.rev_telefono }}
		               	</td>
						
						<td class="uppercase">
		                	{{ rev.rev_domicilio }}
		               	</td>
		   
						<td class="uppercase">
		                	{{ rev.rev_tiempo }}
		               	</td>
						
						<td class="uppercase">
		                	{{ rev.rev_comoloconocio }}
		               	</td>

						
						<td class="uppercase">
							
		                	{{ rev.rev_conocesudomicilio }}

		               	</td>
					
						
						<td class="uppercase">
							{{ rev.rev_conocesuestadocivil }}

		               	</td>

						<td class="uppercase">
							{{ rev.rev_conocesuempleo }}

		               	</td>
						<td class="uppercase">
							{{ rev.rev_conocesupasatiempos }}

		               	</td>

						<td>
							{{ rev.rev_conceptodeelella }}

						</td>
						<td>
					
							{{ obj_seccion_personal.getRecomienda_formatotruper( rev.rev_lorecomienda) }}

						</td>
						<td>{{ rev.rev_notas }}</td>
							
					
		                	
						<td>
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referenciavecinal-truper-modal" onclick="fnEditarReferenciaVecinalFormatoTruper('{{rev.rev_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaVecinalGeneral('{{ rev.rev_id }}',fnCargarTablaDatoReferenciaVecinalFormatoTruper)">
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