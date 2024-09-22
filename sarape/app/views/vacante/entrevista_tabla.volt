{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set doce= acceso.verificar(12,rol_id) %}
{% set quince= acceso.verificar(15,rol_id) %}
{% set veintisiete= acceso.verificar(27,rol_id) %}
{% set veintiocho= acceso.verificar(28,rol_id) %}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}
<style>
	.recorte{}
</style>
{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_entrevista" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						
						<th> Entrevista</th>
						<th> Vacante</th>
						<th> Candidato </th>
						<th title="">Empresa</th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ejecutivo</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
						{{ reg.exc_id }}
						</td>
						<td>
						{% if reg.ent_fecha is defined %}
							{{ date("d-m-Y", strtotime(reg.ent_fecha)) }}
						{% else %}
							Sin fecha
						{% endif %}
						{% if reg.ent_hora is defined %}
						{{ date("H:i", strtotime(reg.ent_hora)) }}
						{% else %}
							Sin hora	
						{% endif %}	
						</td>
						<td>
						{{ reg.cav_nombre }}
						</td>
						<td class="text-uppercase">
							<span class="candidato-funtion-get-info" style="cursor: pointer;" data-can-id="{{ reg.can_id }}" >
								{{ reg.can_nombre }}
							</span>
						</td>
						<td class="text-uppercase" title="{{ reg.emp_nombre }}">
							<span class="emp-vac-funtion-get-info" style="cursor: pointer;" data-emp-id="{{ reg.emp_id }}" >
								{{ reg.emp_alias }}
							</span>	
						</td>
						<td>
						{{ reg.est_nombre }}
						</td>

						<td>
						{{ reg.mun_nombre }}
						</td>
						<td class="text-uppercase">
								<div class="recorte">{{ reg.exc_eje_nombre }}</div>
						
						</td>
						<td class="text-uppercase" width="7%">
							{% include "/vacante/complementos/opciones_entrevista.volt" %}		
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