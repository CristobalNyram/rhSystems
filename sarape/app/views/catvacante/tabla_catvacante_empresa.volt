
{% for cav in catvacante_empresa %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="catvacante_empresa_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th>ID</th>
		                <th>NOMBRE</th>
		                <th class="text-uppercase">Ocupación</th>
		            
						<th>Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
							{{ cav.cav_id }}
						</td>
		               
		                <td>
			                {{ cav.cav_nombre }}
		                </td>

						<td>
							{{ cav.ocu_nombre }}
						</td>



		                <td width="7%">
							<a data-toggle="modal" type="button" title="Editar" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-catvacante-modal" onclick="fnEditarCatVacantesModal('{{ cav.cav_id }}')">
		                		<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
		                	</a>
							<a data-toggle="modal" type="button" title="Eliminar" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnEliminarCategoriaVacanteEmpresa('{{ cav.cav_id }}',fnCargarTablaCatVacantes,'{{ cav.emp_id }}')">
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