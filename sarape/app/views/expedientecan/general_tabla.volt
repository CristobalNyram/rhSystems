{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set veintiysiete= acceso.verificar(27,rol_id) %}
{% set veintiyocho= acceso.verificar(28,rol_id) %}
{% set cuarentayocho= acceso.verificar(48,rol_id) %}
{% set cincuentaycinco= acceso.verificar(55,rol_id) %}

{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_psicometria_general" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						{# <th> No. Psicometría</th> #}
						<th> Psicometría calificación </th>

						<th>Psicometría observaciones  </th>
						<th> Vacante</th>
						<th> Empresa</th>
						<th> Candidato </th>
						<th>Estado</th>
						<th>Municipio</th>
						<th>Ejecutivo</th>


						<th class="all">Acciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>

						<td>
						{{ reg.exc_id }}
						</td>
						{# <td>
						 {{ reg.psi_id }}
						</td> #}
					
						{% if reg.psi_calificacion is defined %}
							<td class="uppercase"> {{reg.psi_calificacion}}</td>
						{% else %}
							<td>Sin calificación</td>
						{% endif %}

						{% if reg.psi_observacion is defined %}
								<td class="uppercase" >
									{{ reg.psi_observacion }}
								</td>
						{% else %}
								<td>Sin observaciones</td>
						{% endif %}

					
						<td>
						{{ reg.cav_nombre }}

						</td>

						<td>
						{{ reg.emp_nombre }}

						</td>

						<td>
						{{ reg.can_nombre }}

						</td>
						
						<td>
						{{ reg.est_nombre }}

						</td>

						<td>
						{{ reg.mun_nombre }}

						</td>

						<td>
						{{ reg.eje_nombre }}

						</td>
						



						<td class="text-uppercase">
											{% include "/psicometria/complementos/opciones_general.volt" %}		
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