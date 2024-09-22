<!-- <div style="padding-top: 25px"> -->
    {% for rep in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_referenciapersonal_table"  class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Nombre</th>
		                <th>Tiempo</th>
                        <th>Número de calle</th>
		                <th>Colonia</th>
						<th>Código postal</th>
						<th>Télefono</th>
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
		                	{{ rep.rep_tiempo }}
		               	</td>
		                <td class="uppercase">
		                	{{ rep.rep_callenumero }}		                
		                </td>
		                <td  class="uppercase">
							{{ rep.rep_colonia }}
						</td>
						<td  class="uppercase">
							{{ rep.rep_codpostal }}
						</td>
						<td  class="uppercase">
							{{ rep.rep_telefono }}
						</td>
						<td  class="uppercase">
							{{ rep.rep_notas }}
						</td>
						
					
							
					
		                	
                <td width="7%">                   
				
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-referenciapersonal-modal" onclick="fnEditarReferenciaPersonal('{{rep.rep_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaReferenciaPersonal('{{ rep.rep_id }}')">
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