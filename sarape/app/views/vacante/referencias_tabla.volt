{# PERMISOS INCIOS #}
{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set doce= acceso.verificar(12,rol_id) %}
{% set quince= acceso.verificar(15,rol_id) %}
{% set treintayuno= acceso.verificar(31,rol_id) %}
{% set treintaydos= acceso.verificar(32,rol_id) %}
{% set treintaycuatro= acceso.verificar(34,rol_id) %}
{% set treintaycinco= acceso.verificar(35,rol_id) %}
{% set treintayseis= acceso.verificar(36,rol_id) %}
{% set treintaysiete= acceso.verificar(37,rol_id) %}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{% set cincuentaytres= acceso.verificar(53,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}
{# PERMISO FIN #}
{% for reg in registros %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_referencias" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Fecha registro</th>
						<th>Última actualización</th>
						<th>Empresa</th>
		                <th>Vacante</th>
		                <th>Candidato</th>
						<th>Estado</th>
		                <th>Municipio</th>
						<th>Ejecutivo</th>
						<th>Apoyo</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>{{ reg.exc_id }}</td>
						<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fecharegistro)) }}'>{{ date("d-m-Y", strtotime(reg.vac_fecharegistro)) }}</td>
						{% if reg.vac_actualizacion is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_actualizacion)) }}'>{{ date("d-m-Y", strtotime(reg.vac_actualizacion)) }}</td>
						{% else %}
							<td>Sin fecha</td>
						{% endif %}
						<td class="text-uppercase" title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>	
						</td>
		                <td class="text-uppercase">{{ reg.cav_nombre }}</td>
		                <td class="text-uppercase">
							<span class="candidato-funtion-get-info" style="cursor: pointer;" data-can-id="{{ reg.can_id }}" >
								{{ reg.can_nombre }}
							</span>
						</td>
						<td class="text-uppercase">{{ reg.est_nombre }}</td>
		                <td class="text-uppercase">{{ reg.mun_nombre }}</td>
						<td class="text-uppercase">{{ reg.exc_eje_nombre }}</td>
						<td class="text-uppercase">
						<span title="FOLIO DE USUARIO: {{ reg.aux_id }}">
							{{ reg.aux_nombre }}
						</span>
						</td>
						<td width="7%">
							{% include "/vacante/complementos/opciones_referencias.volt" %}
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
