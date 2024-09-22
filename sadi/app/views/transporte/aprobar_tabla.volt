{% set dieciseis = acceso.verificar(16,rol_id) %}
{% set cuarentaytres = acceso.verificar(43,rol_id) %}
{% set veinte = acceso.verificar(20,rol_id) %}

{% for tp_sol in transporte_solicitados %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_transporte" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>ID</th>
						<th>Núm. de estudio</th>
		                <th title="Columna que indica el monto que se a solicitado..." data-toggle="tooltip" data-placement="top">Monto solicitado</th>
		                <th data-toggle="tooltip" data-placement="top">Nombre del solicitante</th>
		                <th data-toggle="tooltip" data-placement="top">Nota</th>
						<th  title="Columna que indica la fecha de entrega del investigador..." data-toggle="tooltip" data-placement="top">Fecha de asignación de investigador</th>

						<th data-toggle="tooltip" data-placement="top">Fecha entrega cliente</th>
						<th title="Columna que indica el ORIGEN de donde partirá o partió tu transporte." data-toggle="tooltip" data-placement="top">Origen </th>
						<th title="Columna que indica el DESTINO de donde partirá o partió tu transporte." data-toggle="tooltip" data-placement="top">Destino</th>
						<th title="" data-toggle="tooltip" data-placement="top">Tipo documento</th>
                        <th class="all">Opciones</th>



		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td>{{tp_sol.tra_id}}</td>
						<td>{{tp_sol.ese_id}}</td>
						<td>${{tp_sol.tra_solicitado}}</td>
						<td>{{tp_sol.inv_nombre}} {{tp_sol.inv_apellido}} {{tp_sol.inv_segundoApellido}}</td>
						<td width="10%">{{tp_sol.tra_comentario}}</td>
						{% if tp_sol.ese_fechaentregainvestigador is defined %}
						<td data-order='{{ date("Y-m-d",strtotime(tp_sol.ese_fechaentregainvestigador)) }}'>{{ date("d-m-Y", strtotime(tp_sol.ese_fechaentregainvestigador )) }}</td>
						{% else %}
							<td></td>
						{% endif %}

						{% if tp_sol.ese_fechaentregacliente is defined %}
                            <td data-order='{{ date("Y-m-d",strtotime(tp_sol.ese_fechaentregacliente)) }}'>{{ date("d-m-Y", strtotime(tp_sol.ese_fechaentregacliente )) }}</td>
                        {% else %}
                            <td data-order="0"></td>
                        {% endif %}
						
						<td>{{tp_sol.tra_origen}}</td>
						<td>{{tp_sol.tra_destino}}</td>
						<td>{{tp_sol.tip_clave}}</td>
		                <td width="7%">

							{% include "/transporte/complementos/opciones_aprobar.volt" %}


						</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    Aún no hay transportes solicitados, en esta sección se mostrará los transportes solicitados.
	{% endfor %}

	