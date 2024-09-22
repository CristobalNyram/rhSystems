
<h5 class="text-center">Listado de respuestas por encuestas</h5>
<h6 class="text-center" style="margin-top:0;">
	<button type="button" class="btn {{ enc_helper_estatus['class_helper'] }}">
		{{ enc_helper_estatus['texto'] }} <span class="badge badge-light">{{ enc_contador_total }}</span>
	
	</button>	
</h6>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for res in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			<!-- <div class="card card-crm"> -->
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
							<th>ESE ID</th>
							<th>Encuesta ID</th>
							<th>Tipo estudio</th>
							<th>Candidato</th>
							<th>Investigador </th>

							<th>Usuario </th>
							<th>Fecha entrega cliente </th>
							<th>Fecha realización </th>
							<th>{{ obj_preg.getPreguntaEspecifica(1) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(2) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(3) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(4) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(5) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(6) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(7) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(8) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(9) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(10) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(11) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(12) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(13) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(14) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(15) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(16) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(17) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(18) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(19) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(20) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(21) }} </th>

							<th>{{ obj_preg.getPreguntaEspecifica(22) }} </th>
							<th>{{ obj_preg.getPreguntaEspecifica(23) }} </th>

						
				



			            </tr>
			        </thead>
			        <tbody>
	                {% endif %}						
                        <tr>
							<td>{{ res['ese_id'] }}</td>
							<td>{{ res['enc_id'] }}</td>
							<td>{{ res['tip_clave'] }}</td>
							<td>{{ res['ese_nombre'] }}</td>
							<td>{{ res['inv_nombre'] }}</td>

							<td>{{ res['usu_nombre'] }}</td>

							<td  data-order='{{ date("Y-m-d H:i:s",strtotime(res['enc_fechaentregacliente'])) }}' >
								{{ date("d-m-Y H:i:s", strtotime(res['enc_fechaentregacliente'])) }}

							</td>
					
					
							<td  data-order='{{ date("Y-m-d H:i:s",strtotime(res['enc_fecharealizo'])) }}' >
								{{ date("d-m-Y H:i:s", strtotime(res['enc_fecharealizo'])) }}

							</td>
							<!-- <td>{{ res['preg_1'] }}</td> -->
							<td>{{ obj_enc_calidad.getRespuesta_preg1(res['preg_1']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg2(res['preg_2']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg3(res['preg_3']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg4(res['preg_4']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg5(res['preg_5']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg6(res['preg_6']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg7(res['preg_7']) }}</td>
							<td>{{ res['preg_7_1']  }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg8(res['preg_8']) }}</td>
							<td>{{res['preg_8_1'] }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg9(res['preg_9']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg10(res['preg_10']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg11(res['preg_11']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg12(res['preg_12']) }}</td>
						
							<td>{{ res['preg_12_1'] }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg13(res['preg_13']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg14(res['preg_14']) }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg15(res['preg_15']) }}</td>

							<td>{{ res['preg_15_1'] }}</td>
							<td>{{ obj_enc_calidad.getRespuesta_preg16(res['preg_16']) }}</td>

							<td>{{ obj_enc_calidad.getRespuesta_preg17(res['preg_17']) }}</td>
							<td>{{ res['preg_17_1'] }}</td>

							<td>{{ res['preg_18'] }}</td>
						

			            </tr>
			        {% if loop.last %}
			        </tbody>
			    </table>
			<!-- </div> -->
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}