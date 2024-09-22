{% for emf in empresaformato %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="empresaformato_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		    
						<th>Tipo formato</th>
                        <th>Estatus</th>

						<th>Acciones</th>


		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ emf.tif_nombre }}</td>
                        <td>
							
							<span class="badge badge-pill {{ obj_empresaformato.getBadgeEstatus(emf.emf_estatus)  }}">{{ obj_empresaformato.getEstatus(emf.emf_estatus)  }}</span>

						</td>

		               


		                <td width="7%">
							<a  title="{{ obj_empresaformato.getNombreEstatusACambiar(emf.emf_estatus)  }}" type="button" class="" data-container="body" data-toggle="popover" role="button"  onclick="fnDesactivarEmpresaFormato('{{emf.emf_id}}',fnCargarFormatosAsignadosAEmpresas)">
								<i class="mdi mdi-checkbox-multiple-blank mdi-18px btn-icon" 
								></i>
								
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