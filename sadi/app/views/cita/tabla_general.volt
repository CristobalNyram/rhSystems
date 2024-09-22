<style>
#cita_table td:nth-child(4) {
  word-wrap: break-word;
  white-space: normal;
}

</style>
{% set veinticuatro = acceso.verificar(24,rol_id) %}
{% for cit in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="cita_table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
						<th class="">ID</th>
						<th class="all">Estatus</th>

		                <th class="all">Fecha y hora</th>
						
		                <th class="">Comentario</th>
						<th>Usuario que agendo</th>

						<th class="all">Opciones</th>


		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>{{ cit.cit_id }}</td>
						<td>
							{% set estatus = 0 %}
							{% if hoy > date("Y-m-d",strtotime(cit.cit_fecha)) %}
								{% set estatus=4 %}
							{% else %}
								{% set estatus = cit.cit_estatus %}
							{% endif %}
							<span class="badge  {{ obj_cita.getEstatusBandera(estatus) }} p-2">
								{{ obj_cita.getEstatusTexto(estatus) }}
								
							</span>
						</td>
		                <td>{{ cit.cit_fecha }} {{ cit.cit_hora }}</td>
		                <td>{{ cit.cit_comentario }}</td>
						<td>{{ cit.usu_nombre }}</td>


					
						
		                <td width="7%">
							
							{% if cit.cit_estatus==1 %}
							<a data-toggle="modal" title="Reagendar cita" class="" data-container="body" data-toggle="popover" role="button" data-target="#re-agendar-cita-modal" onclick="fnReAgendarCitaDetalle('{{ cit.cit_id }}')">
								<i class="mdi mdi-calendar-plus  mdi-18px btn-icon"></i>								
							</a>
							<a data-toggle="modal" title="Agregar comentario" class="" data-container="body" data-toggle="popover" role="button" data-target="#agregar-comentario-cita-modal" onclick="fnAgregarComentariosCita('{{ cit.cit_id }}','{{ cit.ese_id }}')">
								<i class="mdi mdi-comment-processing  mdi-18px btn-icon"></i>								
							</a>
							{% endif %}
						
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