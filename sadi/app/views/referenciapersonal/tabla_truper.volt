<!-- <div style="padding-top: 25px"> -->
    {% for rep in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_referenciapersonal_truper_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Edad</th>
                        <th>Teléfono</th>
		                <th>Dirección									</th>
						<th>Ocupación								</th>
						<th>Empresa en la que trabaja									</th>

						<th>Tiempo de Conocerle			</th>
						<th>Como lo conoció									</th>
						<th>Conoce su domicilio									</th>
						<th>Conoce su estado civil									</th>
						<th>Sabe donde ha trabajado									</th>
						<th>Conoce sus pasatiempos									</th>
						<th>Su concepto como persona es						</th>
						<th>Lo recomienda								</th>
						<th>Notas</th>

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">
                            {{ rep.rep_id }}
						
						</td>
						<td>
							{{ rep.rep_nombre }}
						</td>
		                <td class="uppercase">
		                	{{ rep.rep_edad }}
		               	</td>
		                <td class="uppercase">
		                	{{ rep.rep_telefono }}		                
		                </td>
		                <td  class="uppercase">
							{{ rep.rep_direccioncompleta }}
						</td>
						<td  class="uppercase">
							{{ rep.rep_ocupacion }}
						</td>
						<td  class="uppercase">
							{{ rep.rep_empresatrabaja }}
						</td>

						<td class="uppercase">{{ rep.rep_tiempo }}</td>
						<td class="uppercase">{{ rep.rep_comoloconocio }}</td>
						<td class="uppercase">{{ rep.rep_conocesudomicilio }}</td>
						<td class="uppercase">{{ rep.rep_estadocivil }}</td>
						<td class="uppercase">{{ rep.rep_conocedonhatrabajado }}</td>
						<td class="uppercase">{{ rep.rep_pasatiempos }}</td>
						<td class="uppercase">{{ rep.rep_conceptocomopersona }}</td>
						<td class="uppercase">
							{{ obj_seccion_personal.getRecomienda_formatotruper( rep.rep_lorecomienda) }}
	
						</td>

						<td  class="uppercase">
							{{ rep.rep_notas }}
						</td>
						
					
							
					
		                	
                <td width="7%">                   
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referenciapersonal-truper-modal" onclick="fnEditarReferenciaPersonalFormatoTruper('{{rep.rep_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaPersonalGeneral('{{ rep.rep_id }}',fnCargarTablaDatoReferenciaPersonalFormatoTruper)">
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