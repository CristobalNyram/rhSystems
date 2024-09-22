{# PERMISOS INCIOS #}

{% set veintisiete= acceso.verificar(27,rol_id) %}

{% set treintayuno= acceso.verificar(31,rol_id) %}
{% set treintaydos= acceso.verificar(32,rol_id) %}
{% set treintaycuatro= acceso.verificar(34,rol_id) %}
{% set treintaycinco= acceso.verificar(35,rol_id) %}
{% set treintayseis= acceso.verificar(36,rol_id) %}
{% set treintaysiete= acceso.verificar(37,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}
{% set cincuentayocho= acceso.verificar(58,rol_id) %}
{% set setentaycinco= acceso.verificar(75,rol_id) %}
{% set ochenta= acceso.verificar(80,rol_id) %}
{% set ochentaynueve= acceso.verificar(89,rol_id) %}
{% set noventayseis= acceso.verificar(96,rol_id) %}

{% include "/vacante/relacionvacante_contador.volt" %}
{% for reg in registros %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_vac_relacionvacante" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Estatus</th>
						<th>#</th>
						<th>Vacantes</th>

						<th>Fecha registro</th>
						<th>Empresa</th>
		                <th>Vacante</th>
		                <th>Estado</th>
		                <th>Municipio</th>
						<th>Ejecutivo principal</th>
						<th>Ejecutivos compartidos</th>

						<th>Fecha última actualización</th>

						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>{{ reg.vac_id }}</td>
						<td>
							<span class="badge {{ vac_obj.getEstatusBanderaColor(reg.vac_estatus) }} p-2">
								{{ vac_obj.getEstatusTexto(reg.vac_estatus) }}
							</span>
						</td>
						<td>{{vac_obj.getExpedientesRelacionadosVacante(reg.vac_id)}}</td>
						<td>{{ reg.vac_numero }}</td>

						<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_fecharegistro)) }}'>{{ date("d-m-Y", strtotime(reg.vac_fecharegistro)) }}</td>
						<td class="text-uppercase" title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>
						</td>
		                <td class="text-uppercase">{{ reg.cav_nombre }}</td>
		                <td class="text-uppercase">{{ reg.est_nombre }}</td>
		                <td class="text-uppercase">{{ reg.mun_nombre }}</td>
						<td class="text-uppercase">{{ reg.eje_nombre }}</td>
						<td class="text-uppercase">
								{{ rel_vac_eje_obj.getNombresEjecutivosCompartidos(reg.vac_id) }}

						</td>

						{% if reg.vac_actualizacion is defined %}
							<td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(reg.vac_actualizacion)) }}'>{{ date("d-m-Y", strtotime(reg.vac_actualizacion)) }}</td>
						{% else %}
							<td>Sin fecha</td>
						{% endif %}		
						<td width="7%">
							{% include "/vacante/complementos/opciones_relacionvacante.volt" %}
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
