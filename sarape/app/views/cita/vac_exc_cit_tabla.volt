{% set siete= acceso.verificar(7,rol_id) %}
{% set diez= acceso.verificar(10,rol_id) %}
{% set veintisiete= acceso.verificar(27,rol_id) %}
{% set veintiocho= acceso.verificar(28,rol_id) %}

{% for reg in registros %}
    {% if loop.first %}
		<div class="col-12">
		    <table id="td_vac_cit_tabla" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
					<th>ID</th>
					<th>Fecha registro</th>
					<th>Fecha y hora</th>
					<th>Tipo de cita</th>
					<th>Nombre completo</th>
					<th>Correo</th>
					<th>Celular</th>
					<th>Teléfono</th>
					<th>Medio en el que llegó</th>
					<th>Observaciones</th>
					<th class="all">Acciones</th>


		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>
							{{ reg.exc_id }}
						</td>
						<td>
							{{ reg.cit_registro }}
						</td>
						<td>
							{{ reg.cit_fecha }} {{ reg.cit_hora }}
						</td>

						<td>
							{{ reg.tic_nombre}}
						</td>
						<td>
							{{ reg.can_nombre }}
						</td>

						<td>
							{{ reg.can_correo }}
						</td>
						<td>
							{% if reg.can_celular is defined %}
								<i class="fas fa-mobile-alt"></i> {{ reg.can_celular }}
								
							{% endif %}
							
						</td>
						<td>
							{% if reg.can_telefono is defined %}
								<i class="fas fa-phone"></i> {{ reg.can_telefono }}
							{% endif %}
						</td>
						<td>
							 {{ reg.med_nombre}}
						</td>
						
						<td>
							{{ reg.cit_observaciones}}
						</td>
						<td class="text-uppercase">
						{% include "/cita/complementos/opciones_vac_exc_cit.volt" %}
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
