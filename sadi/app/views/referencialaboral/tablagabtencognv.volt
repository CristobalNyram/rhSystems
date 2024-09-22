<!-- <div style="padding-top: 25px"> -->
{% set cuarentayuno= acceso.verificar(41,rol_id) %}
{% set cuarentaycinco= acceso.verificar(45,rol_id) %}
{% set cincuentaycuatro  = acceso.verificar(54,rol_id) %}
{% set noventa  = acceso.verificar(90,rol_id) %}
{% set total_rel = page|length %}

    {% for rel in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_referencialaboral_table_gabencognv" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
						<th>Orden</th>
		                <th>Empresa </th>
		                <th>Domicilio </th>
		                <th>Jefe directo inmediato </th>
		                <th>Teléfono </th>
		                <th>Puesto inicial  </th>
		                <th>Puesto final </th>
						<th>Entrada  </th>
		                <th>Salida </th>
		                <th>Sueldo incial </th>
		                <th>Sueldo final  </th>
		                <th>Motivo de separación </th>
						<th>Incapacidad </th>
						<th>Demanda </th>
						<th>Recomendable </th>
						{% if cuarentayuno==1 %}
						<th>Empresa -RH</th>
		                <th>Domicilio -RH</th>
		                <th>Jefe directo inmediato -RH</th>
		                <th>Teléfono -RH</th>
		                <th>Puesto inicial -RH</th>
		                <th>Puesto final -RH</th>
						<th>Entrada   -RH</th>
		                <th>Salida -RH</th>
		                <th>Sueldo incial -RH</th>
		                <th>Sueldo de final por RH</th>
		                <th>Motivo de separación  -RH</th>
						<th>Incapacidad -RH</th>
						<th>Demanda  -RH</th>
						<th>Recomendable -RH</th>
                   		 {% endif %}
						
						<th>Notas</th>
						{% if cuarentaycinco==1 %}
						<th>Calidad</th>
						<th>Responsabilidad</th>
						<th>Relaciones</th>
						<th>Honradez</th>
						<th>Asistencia</th>
						<th>Puntualidad</th>
						<th>Iniciativa</th>
						<th>Adicciones</th>
						{% endif %}

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>






						<td class="uppercase">{{ rel.rel_id }}</td>
						<td class="uppercase">{{ rel.rel_orden }}</td>
						<td>{{ rel.rel_candidatoempresa }}</td>
		                <td class="uppercase">{{ rel.rel_candidatodomicilio }}	</td>
		                <td class="uppercase">{{ rel.rel_candidatojefe }}</td>
		                <td  class="uppercase">{{ rel.rel_candidatotelefono }}</td>
						<td  class="uppercase">{{ rel.rel_candidatopuestoinicial }}</td>
						<td  class="uppercase">{{ rel.rel_candidatopuestofinal }}</td>
						<td  class="uppercase">{{ rel.rel_candidatoingreso }}</td>
						<td  class="uppercase">{{ rel.rel_candidatosalida }}</td>
						<td  class="uppercase">{{ rel.rel_candidatosueldoinicial }}</td>
						<td  class="uppercase">{{ rel.rel_candidatosueldofinal }}</td>

						<td  class="uppercase">{{ rel.rel_candidatoseparacion }}</td>
						<td  class="uppercase">{{ rel.rel_candidatoincapacidad }}</td>
						<td  class="uppercase">{{ rel.rel_candidatodemanda }}</td>
						<td  class="uppercase">{{ rel.rel_candidatorecomendable }}</td>

						{% if cuarentayuno==1 %}

						<td  class="uppercase">{{ rel.rel_rhempresa }}</td>
						<td  class="uppercase">{{ rel.rel_rhdomicilio }}</td>
						<td  class="uppercase">{{ rel.rel_rhjefe }}</td>
						<td  class="uppercase">{{ rel.rel_rhtelefono }}						</td>
						<td  class="uppercase">	{{ rel.rel_rhpuestoinicial }}</td>
						<td  class="uppercase">{{ rel.rel_rhpuestofinal }}</td>
						<td  class="uppercase">{{ rel.rel_rhingreso }}</td>
						<td  class="uppercase">{{ rel.rel_rhsalida }}</td>
						<td  class="uppercase">{{ rel.rel_rhsueldoinicial }}</td>
						<td  class="uppercase">{{ rel.rel_rhsueldofinal }}</td>
						<td  class="uppercase">{{ rel.rel_rhseparacion }}	</td>
						<td  class="uppercase">{{ rel.rel_rhincapacidad }}</td>
						<td  class="uppercase">{{ rel.rel_rhdemanda }}</td>
						<td  class="uppercase">{{ rel.rel_rhrecomendable }}</td>
						{% endif %}

						<td  class="uppercase">{{ rel.rel_notas }}</td>

						{% if cuarentaycinco==1 %}

						<td  class="uppercase"> {{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_calidad) }}</td>
						<td  class="uppercase">{{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_responsabilidad)  }}</td>
						<td  class="uppercase">{{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_relaciones)  }}</td>
						<td  class="uppercase">{{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_honradez) }}</td>
						<td  class="uppercase">{{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_asistencia) }}</td>
						<td  class="uppercase">{{ escalaDesempenoObject.get_escalaDesempeno(rel.rel_puntualidad) }}</td>
						<td  class="uppercase">{{  escalaDesempenoObject.get_escalaDesempeno(rel.rel_iniciativa) }}</td>
						<td>
							{{  getSiNoObject.getSiNo(rel.rel_adicciones)}}
					
		                </td>
						{% endif %}

						<td>
						

			
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referencialaboral_formato_gabencognv-modal" onclick="fnEditarReferenciaLaboral_formato_gabencognv(
								'{{rel.rel_id}}','{{  cuarentayuno}}','{{ cuarentaycinco }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
						
							{% if cincuentaycuatro==1 %}
				
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaLaboral_formato_gabencognv('{{ rel.rel_id }}')">
								<i class="mdi mdi-delete mdi-18px btn-icon"></i>
							</a>
							{% endif %}
							{% if noventa==1 %}

								{% set rel_id = rel.rel_id %}
								{% set rel_orden = rel.rel_orden %}
								{% set btn_arriba_disabled = rel_orden == 1 ? 'disabled' : '' %}
								{% set btn_abajo_disabled = rel_orden == total_rel ? 'disabled' : '' %}
								{% set btn_arriba_display = rel_orden == 1 ? 'none' : 'inline-block' %}
								{% set btn_abajo_display = rel_orden == total_rel ? 'none' : 'inline-block' %}

									<a data-toggle="modal" title="Cambiar orden arriba" type="button" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnArribaOrdenCambiar('{{rel.rel_id}}',fnCargarTablaDatoReferenciaLaboral_formato_gabencognv)" style="display: {{ btn_arriba_display }};">
										<i class="mdi mdi-arrow-up-bold mdi-18px btn-icon"></i>
									</a>	

									{% if rel_orden != total_rel %}
									<a data-toggle="modal" title="Cambiar orden abajo" type="button" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnAbajoOrdenCambiar('{{rel.rel_id}}',fnCargarTablaDatoReferenciaLaboral_formato_gabencognv)" style="display: {{ btn_abajo_display }};">
										<i class="mdi mdi-arrow-down-bold mdi-18px btn-icon"></i>
									</a>
									{% endif %}
								
							
							{% endif %}
							
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