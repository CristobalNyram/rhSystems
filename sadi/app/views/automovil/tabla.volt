<!-- <div style="padding-top: 25px"> -->
    {% for aut in page %}
    {% if loop.first %}
		<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="dato_automovil_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>Tipo</th>
		                <th>Marca</th>
                        <th>Modelo</th>
						<th>Año</th>
						<th>Valor</th>

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}

					<tr>
						<td>

							{{ aut.aut_id }}
						</td>
						<td class="uppercase">
							{{ objectoAutomovil.get_nombre_tipo_automovil(aut.aut_tipo) }}
						</td>
						<td class="uppercase">
							{{ aut.aut_marca }}
						</td>
						<td class="uppercase">
							{{ aut.aut_modelo }}
						</td>
						<td class="uppercase">
							{{ aut.aut_anio }}
						</td>
						<td class="uppercase">
							{{ aut.aut_valor }}
						</td>
						<td>
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-automovil-modal" onclick="fnEditarAutomovilDetalles('{{aut.aut_id  }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnarAutomovil('{{ aut.aut_id  }}')">
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