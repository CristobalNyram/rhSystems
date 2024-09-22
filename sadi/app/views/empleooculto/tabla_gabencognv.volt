

<!-- <div style="padding-top: 25px"> -->
    {% for epl in page %}
    {% if loop.first %}

	<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="dato_empleo_oculto_gabencognv_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead class="thead-light-crm">
	
		            <tr>
						<th>ID</th>

						<th>Nombre de empresa</th>
						<th>Fecha ingreso</th>
						<th>Fecha salida</th>
						<th>Teléfono</th>

						<th>Recomendable</th>
						<th>Demanda</th>
						<th>Motivo de separación</th>

		              
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
                        <td class="text-uppercase"> 
                            {{ epl.epl_id }}
                        </td>

						<td class="text-uppercase"> 
                            {{ epl.epl_empresa }}
                        </td>
						<td class="text-uppercase"> 
                            {{ epl.epl_fechaingreso }}
                        </td>
						<td class="text-uppercase"> 
                            {{ epl.epl_fechasalida }}
                        </td>
						<td class="text-uppercase"> 
                            {{ epl.epl_telefono }}
                        </td>
						<td class="text-uppercase"> 
                            {{  epl.epl_recomendable }}
                        </td>
						<td class="text-uppercase"> 
                            {{ epl.epl_demanda}}
                        </td>
						<td class="text-uppercase"> 
                            {{ epl.epl_motivoseparacion }}
                        </td>
					
						<td>
											
							<a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-empleooculto-gabencognv-modal" onclick="fnEditarEmpleoOcultoGabencognv('{{epl.epl_id }}')" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnElimnaEmpleoOculto('{{epl.epl_id }}',fnCargarTablaDatoEmpleosOcultos_formato_gabencognv)">
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