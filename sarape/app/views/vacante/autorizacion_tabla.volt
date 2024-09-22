{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set doce= acceso.verificar(12,rol_id) %}
{% set quince= acceso.verificar(15,rol_id) %}
{% set veintisiete= acceso.verificar(27,rol_id) %}
{% set veintiocho= acceso.verificar(28,rol_id) %}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{% set cincuentaydos= acceso.verificar(52,rol_id) %}
{% set cincuentaytres= acceso.verificar(53,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}
{% set cincuentaysies= acceso.verificar(56,rol_id) %}
{% set setentaycinco= acceso.verificar(75,rol_id) %}
{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_autorizacion" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Fecha alta</th>
						<th>Fecha autorización</th>
						<th>Vacante</th>
						<th>Empresa</th>
						<th>Candidato</th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ejecutivo</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr 
						{% if reg.exc_autorizado=="1" %}
							class="text-success"
						{% elseif reg.exc_autorizado=="0" %}
							class="text-danger"
						{% else %}
						{% endif %}	
					>
						<td>
							{{ reg.exc_id }}
						</td>
						<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fecharegistro)) }}'>
							{{ date("d-m-Y",strtotime(reg.vac_fecharegistro)) }}
						</td>
						<td data-order='{{ date("Y-m-d H:i:s",strtotime(reg.exc_fechaautorizo)) }}'>
							{% if  reg.exc_fechaautorizo is defined %}
								{{ date("d-m-Y  H:i",strtotime(reg.exc_fechaautorizo)) }}
							{% endif %}
						</td>
						<td>
							{{ reg.cav_nombre }}
						</td>
						<td class="text-uppercase" title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>	
						</td>
						<td class="text-uppercase">
							<span class="candidato-funtion-get-info" style="cursor: pointer;" data-can-id="{{ reg.can_id }}" >
								{{ reg.can_nombre }}
							</span>
						</td>
						<td>
							{{ reg.est_nombre }}
						</td>
						<td>
							{{ reg.mun_nombre }}
						</td>
						<td>
							{{ reg.exc_eje_nombre }}
						</td>
						<td class="text-uppercase" width="7%">
							{% include "/vacante/complementos/opciones_autorizacion.volt" %}		
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