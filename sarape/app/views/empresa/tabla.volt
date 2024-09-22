{% set doce = acceso.verificar(12,rol_id) %}
{% for emp in empresas %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_empresa" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Nombre</th>
		                <th>RFC</th>
		                <th>Alias</th>
						<th>Acciones</th>


		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ emp.emp_nombre }}</td>
		               
		                <td>
			                {{ emp.emp_rfc }}
		                </td>

						<td>{{ emp.emp_alias }}</td>

				


		                <td width="7%">
							

							<a data-toggle="modal" type="button" title="Ver logo..." class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_logo_empresa-modal" onclick="fnVerLogo('{{ emp.emp_id }}')">
		                		<i class="mdi mdi-eye mdi-18px btn-icon"></i>
		                	</a>

		                	<a data-toggle="modal" type="button" title="Editar" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_empresa-modal" onclick="fneditempresa('{{ emp.emp_id }}','{{ emp.emp_nombre }}','{{ emp.neg_id }}')">
		                		<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
		                	</a>
							<a data-toggle="modal" type="button" title="Eliminar" class="" data-container="body" data-toggle="popover" role="button"  onclick="fneliempresa('{{ emp.emp_id }}','{{ emp.emp_nombre }}','{{ emp.emp_rfc }}' )">
		                		<i class="mdi mdi-delete mdi-18px btn-icon"></i>
		                	</a>
							<a data-toggle="modal" title="Ver contactos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#contactos-modal" onclick="contactos('{{emp.emp_id}}','{{emp.emp_nombre}}')">
		                      	<i class="mdi mdi-folder-account-outline mdi-18px btn-icon"></i>
		                	</a>

							<a data-toggle="modal" title="Ver vacantes" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#catvacante-empresa-modal" onclick="fnCargarTablaCatVacantes('{{emp.emp_id}}')">
								<i class="mdi mdi-counter mdi-18px btn-icon"></i>
						 	 </a>
		                	{% if doce==1 %}
		                		<a data-toggle="modal" title="Ver centros de costo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#centrocosto-modal" onclick="centrocosto('{{emp.emp_id}}','{{emp.emp_nombre}}')"><i class="mdi mdi-home-group mdi-18px btn-icon"></i>
		                		</a>
		                	{% endif %}
		                	<a onclick="fncambiarfoto('{{emp.emp_nombre}}','{{emp.emp_id}}');" class=""  data-toggle="modal" data-target="#mdlcambiarfoto" title='Cambiar imagen'><i class="mdi mdi-image-plus mdi-18px btn-icon" ></i></a>
							{# <a data-toggle="modal" title="Ver formatos asignados" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#empresaformato-modal" onclick="fnGetEmpresaformatos('{{emp.emp_id}}')">
								<i class="mdi mdi-file-settings-variant mdi-18px btn-icon"></i>
						  	</a> #}
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