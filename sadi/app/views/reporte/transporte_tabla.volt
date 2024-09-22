<span class"text-center">
{% if mensaje is defined and mensaje %}
{{mensaje}}
{% endif %}
</span>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
<h2 class="row col-12 text-center">
	Datos de consulta
</h2>
{% if page is defined and page %}
{% for reg in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
			<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead class="thead-light-crm">
					<tr>
						<th>ID transporte</th>
						<th>ID ESE</th>
						<th>Tipo estudio</th>
						<th>Empresa</th>
						<th>Contacto empresa</th>
						<th>Centro costo</th>
						<th>Investigador</th>
						<th>Analista</th>
						<th>Transporte solicitado  $</th>
						<th>Fecha de solicitud</th>
						<th>Transporte pre aprobado $</th>
						<th>Transporte aprobado</th>
						<th>Diferencia de transporte aprobado y pre aprobado</th>
						<th>Fecha de aprobación</th>
						<th>Estatus transporte</th>
						<th>Estatus estudio</th>
						<th>Comentario investigador</th>
						<th>Comentario admin</th>
						<th>Usuario aprobó</th>
						<th>Usuario asigna</th>
						<th>Estado origen</th>
						<th>Municipio origen</th>
						<th>Estado destino</th>
						<th>Municipio destino</th>
						
					</tr>
				</thead>
				<tbody>
					{% endif %}						
					<tr>
						<td>{{reg.tra_id}}</td>
						<td>{{reg.ese_id}}</td>
						<td>{{reg.tip_nombre}}</td>
						<td class="uppercase">{{reg.emp_nombre}}</td>
						<td class="uppercase">{{reg.cne_nombre}}</td>
						<td class="uppercase">{{reg.cen_nombre}}</td>
						<td class="uppercase">{{reg.inv_nombre}}</td>
						<td class="uppercase">{{reg.ana_nombre}}</td>
						<td>{{reg.tra_solicitado}}</td>
						{% if reg is defined and reg.tra_registro is defined %}
							<td data-order='{{ date("Y-m-d", strtotime(reg.tra_registro)) }}'>{{ date("d/m/Y", strtotime(reg.tra_registro)) }}</td>
						{% else %}
							<td></td>
						{% endif %}
						<td>{{reg.tra_preaprobado}}</td>
						<td>{{reg.tra_aprobado}}</td>
						<td>
							{% set tra_aprobado = reg.tra_aprobado is not defined ? 0 : reg.tra_aprobado %}
							{% set diferencia = reg.tra_preaprobado - tra_aprobado %}
							{% if reg.tra_aprobado is not defined %}
								-
							{% else %}
								{% if diferencia > 0 %}
									<i class="mdi mdi-arrow-up"></i>
								{% elseif diferencia < 0 %}
									<i class="mdi mdi-arrow-down"></i>
								{% endif %}
								{{ reg.tra_solicitado is not defined ? 'SIN SOLICITAR' : diferencia }}
							{% endif %}
						</td>
						{% if reg is defined and reg.tra_fechaaprobado is defined %}
							<td data-order='{{ date("Y-m-d", strtotime(reg.tra_fechaaprobado)) }}'>{{ date("d/m/Y", strtotime(reg.tra_fechaaprobado)) }}</td>
						{% else %}
							<td></td>
						{% endif %}
						<td>{{ tranporte_obj.getEstatus(reg.tra_estatus)}}</td>
						<td>{{ estudio_obj.getEstatusDetail(reg.ese_estatus)}}</td>
						<td>{{reg.tra_comentario}}</td>
						<td>{{reg.tra_comentarioadmin}}</td>
						<td>{{reg.usu_aprobado_nombre}}</td>
						<td>{{reg.tra_usu_asigna_nombre}}</td>
						<td>{{reg.est_nombre_ori}}</td>
						<td>{{reg.mun_nombre_ori}}</td>
						<td>{{reg.est_nombre_dest}}</td>
						<td>{{reg.mun_nombre_dest}}</td>
						
					</tr>
					{% if loop.last %}
				</tbody>
			</table>
		</div>
	{% endif %}
	{% else %}
		<br>
	    No existen registros en este catálogo.
{% endfor %}
{% endif %}
<span class="text-warning h6">
{% if mensaje_nota_filtro_inv is defined and mensaje_nota_filtro_inv %}
	{{ mensaje_nota_filtro_inv }}
{% endif %}
</span>
<h2 class="row col-12 text-center">
	Transportes aprobados por investigador
</h2>
{% if regs_inv_pagados_tra is defined and regs_inv_pagados_tra %}
	{% for reg_inv in regs_inv_pagados_tra %}
		{% if loop.first %}
			<div class="mt-1 col-12">
				<table id="datatable-inv_info" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead class="thead-light-crm">
						<tr>
							<th>ID INVESTIGADOR</th>
							<th>Tipo estudio</th>
							<th>Nombre investigador</th>
							<th>Cantidad de estudios realizados</th>
							<th>Monto total autorizado</th>
							<th>Promedio de pago</th>
						</tr>
					</thead>
					<tbody>
					{% endif %}
					<tr>
						<td>{{reg_inv.inv_id}}</td>
						<td>
							{% if tipo_estudio_filtro %}
								{{reg_inv.tip_nombre}}
							{% else %}
							GENERAL
							{% endif %}
						</td>
						<td>{{reg_inv.inv_nombre}}</td>
						<td>{{reg_inv.ese_autorizados_total }}</td>
						<td>{{reg_inv.inv_total_transporte_autorizado }}</td>
						<td>{{reg_inv.inv_promedio_transporte_autorizado }}</td>
					</tr>
					{% if loop.last %}
					</tbody>
				</table>
			</div>
		{% endif %}
	{% else %}
		<br>
		No existen registros  de investigadores con transporte autorizado.
	{% endfor %}
{% endif %}
<br>
{# graficas inicio #}
<style>
svg { overflow: visible !important; }
#grafica text.morris-x-labels {
    font-weight: bold; 
}
</style>
<h2 class="row col-12 text-center">
	Transportes aprobados
</h2>
<div class="card card-crm d-flex " id="listado-graficas-respuestas-container">
	<div class="row " id="listado-graficas-respuestas">
		<div class="col-12 col-md-12 mb-5 border-bottom">
			<div id="textos-grafica" class="text-center texto-graficas"></div>
			<div id="grafica" style=" height: 500px;" class="pie-chart-reporte-respuestas"></div>
		</div>
	</div>

<script>
$(document).ready(function() {
{% if regs_inv_pagados_tra is defined and regs_inv_pagados_tra %}
let datosInvestigadores = <?php echo json_encode($regs_inv_pagados_tra); ?>;
fnCargarGraficaTransporte(datosInvestigadores);
{% endif %}
});
</script>
{# graficas fin  #}