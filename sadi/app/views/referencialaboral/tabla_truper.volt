{% set cuarentayuno= acceso.verificar(41,rol_id) %}
{% set cuarentaycinco= acceso.verificar(45,rol_id) %}
{% set cincuentaycuatro  = acceso.verificar(54,rol_id) %}
{% set noventa  = acceso.verificar(90,rol_id) %}
{% set total_rel = page|length %}

    {% for rel in page %}

    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_referencialaboral_truper_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						
						
						
						<th>ID</th>
						<th>Orden</th>
		                <th>Empresa</th>
						<th>Giro de la empresa </th>

		                <th>Domicilio</th>
		                <th>Jefe directo inmediato</th>
		                <th>Teléfono</th>
		                <th>Puesto  </th>
		                <!-- <th>Puesto final -candidato</th> -->
						<th>Periodo</th>
		                <!-- <th>Salida</th> -->
		                <th>Sueldo</th>
		                <!-- <th>Sueldo final  -candidato</th> -->
		                <th>Motivo de separación </th>
						<th>Área </th>
						<!-- <th>Área final -candidato</th> -->
						<th>Demanda </th>
						<th>Recomendable </th>
						<th>Comentarios </th>
						<th>Desempeño  </th>
						<th>T. en equipo  </th>
						<th>T. de decisiones  </th>
						<th>Honradez en el trabajo  </th>
						<th>Adaptación </th>
						<th>Calidad en el trabajo  </th>
						<th>Iniciativa en el trabajo  </th>
						<th>Puntualidad en el trabajo  </th>
						<th>Responsabilidad en el trabajo</th>
						<th>Apego a normas   </th>
						<th>Relaciones con superiores </th>
						<th>Relaciones con compañeros   </th>

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">{{ rel.rel_id }}</td>
						<td class="uppercase">{{ rel.rel_orden }}</td>
						<td>{{ rel.rel_candidatoempresa }}</td>
						<td>{{ rel.rel_candidatoempresagiro }}</td>

		                <td class="uppercase">{{ rel.rel_candidatodomicilio }}	</td>
		                <td class="uppercase">{{ rel.rel_candidatojefe }}</td>
		                <td  class="uppercase">{{ rel.rel_candidatotelefono }}</td>
						<td  class="uppercase">{{ rel.rel_candidatopuestoinicial }}</td>
						<!-- <td  class="uppercase">{{ rel.rel_candidatopuestofinal }}</td> -->
						<td  class="uppercase">{{ rel.rel_candidatoingreso }}</td>
						<!-- <td  class="uppercase">{{ rel.rel_candidatosalida }}</td> -->
						<td  class="uppercase">{{ rel.rel_candidatosueldoinicial }}</td>
						<!-- <td  class="uppercase">{{ rel.rel_candidatosueldofinal }}</td> -->

						<td  class="uppercase">{{ rel.rel_candidatoseparacion }}</td>
						<td  class="uppercase">{{ rel.rel_candidatoareaincial }}</td>
						<!-- <td  class="uppercase">{{ rel.rel_candidatoareafinal }}</td> -->
						
						<td  class="uppercase">
							{{ objeRefLab.getDemanda_FormatoTruper(rel.rel_candidatodemanda) }}
						</td>
						<td  class="uppercase">
							{{ objeRefLab.getRecomendable_FormatoTruper(rel.rel_candidatorecomendable) }}
							
						</td>
						<td  class="uppercase">{{ rel.rel_notas }}</td>
						<!-- rel_desempenio -->
						<td  class="uppercase">{{ objeRefLab.getDesempenioFormatoTruper(rel.rel_desempenio) }}</td>
						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_trabajoenquipo) }}</td>
						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_decisiones) }}</td>
						<td  class="uppercase">{{ objeRefLab.getHonradezFormatoTruper(rel.rel_honradez) }}</td>

						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_adaptacion) }}</td>
						<td  class="uppercase">{{ objeRefLab.getCalidadFormatoTruper(rel.rel_calidad) }}</td>
						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_iniciativa) }}</td>

						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_puntualidad) }}</td>
						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_responsabilidad) }}</td>
						<td  class="uppercase">{{ objeRefLab.getSiONo(rel.rel_apegonormas) }}</td>
						<td  class="uppercase">{{ objeRefLab.getRelacionSuperioresFormatoTruper(rel.rel_relacionessuperiores) }}</td>
						<td  class="uppercase">{{ objeRefLab.getRelacionComapnierosFormatoTruper(rel.rel_relacionescompanieros) }}</td>


						<td>
						

			
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referencialaboral-truper-modal" onclick="fnEditarReferenciaLaboralFormatoTruper(
								'{{rel.rel_id}}','{{  cuarentayuno}}','{{ cuarentaycinco }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							{% if cincuentaycuatro==1 %}
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaLaboralGeneral('{{ rel.rel_id }}',fnCargarTablaDatoReferenciaLaboralFormatoTruper)">
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
								
								<a data-toggle="modal" title="Cambiar orden arriba" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnArribaOrdenCambiar('{{ rel_id }}', fnCargarTablaDatoReferenciaLaboralFormatoTruper)" style="display: {{ btn_arriba_display }};">
									<i class="mdi mdi-arrow-up-bold mdi-18px btn-icon"></i>
								</a>
								
								{% if rel_orden != total_rel %}
								<a data-toggle="modal" title="Cambiar orden abajo" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnAbajoOrdenCambiar('{{ rel_id }}', fnCargarTablaDatoReferenciaLaboralFormatoTruper)" style="display: {{ btn_abajo_display }};">
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