
<h5 class="text-center">Listado de respuestas por encuestas</h5>
<h6 class="text-center" style="margin-top:0;">
	<button type="button" class="btn ">
		 <span class="badge badge-light">{{ enc_contador_total }}</span> 
	
	</button>	
</h6>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
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
							<th>Empresa</th>

							<th>Investigador </th>
							<th>Analista </th>

							<th>Usuario </th>
							<th>Fecha entrega cliente </th>
							<th>Fecha realización </th>
							
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p1_0_v0')}}.{{ obj_enc.getPreguntaText('erl_p1_0_v0') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p1_1_v0')}}.{{obj_enc.getPreguntaText('erl_p1_1_v0') }} </th>

							<th>{{ obj_enc.getPreguntaNumeroText('erl_p2_0_v0')}}.{{obj_enc.getPreguntaText('erl_p2_0_v0') }} </th>
							
							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p3_0_v1')}}.{{obj_enc.getPreguntaText('erl_p3_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p3_0_v2')}}.{{obj_enc.getPreguntaText('erl_p3_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p3_0_v1')}}.{{obj_enc.getPreguntaText('erl_p3_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p3_0_v2')}}.{{obj_enc.getPreguntaText('erl_p3_0_v2') }} </th>
							{% endif %}
						

							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p4_0_v1')}}.{{obj_enc.getPreguntaText('erl_p4_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p4_0_v2')}}.{{obj_enc.getPreguntaText('erl_p4_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p4_0_v1')}}.{{obj_enc.getPreguntaText('erl_p4_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p4_0_v2')}}.{{obj_enc.getPreguntaText('erl_p4_0_v2') }} </th>
							{% endif %}

							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p5_0_v1')}}.{{obj_enc.getPreguntaText('erl_p5_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p5_0_v2')}}.{{obj_enc.getPreguntaText('erl_p5_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p5_0_v1')}}.{{obj_enc.getPreguntaText('erl_p5_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p5_0_v2')}}.{{obj_enc.getPreguntaText('erl_p5_0_v2') }} </th>
							{% endif %}


							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p6_0_v1')}}.{{obj_enc.getPreguntaText('erl_p6_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p6_0_v1')}}.{{obj_enc.getPreguntaText('erl_p6_0_v1') }} </th>
							{% endif %}

							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p7_0_v1')}}.{{obj_enc.getPreguntaText('erl_p7_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p7_0_v2')}}.{{obj_enc.getPreguntaText('erl_p7_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p7_0_v1')}}.{{obj_enc.getPreguntaText('erl_p7_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p7_0_v2')}}.{{obj_enc.getPreguntaText('erl_p7_0_v2') }} </th>
							{% endif %}



							<th>{{ obj_enc.getPreguntaNumeroText('erl_p7_1_v1')}}.{{obj_enc.getPreguntaText('erl_p7_1_v1') }} </th>

							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p8_0_v1')}}.{{obj_enc.getPreguntaText('erl_p8_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p8_0_v2')}}.{{obj_enc.getPreguntaText('erl_p8_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p8_0_v1')}}.{{obj_enc.getPreguntaText('erl_p8_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p8_0_v2')}}.{{obj_enc.getPreguntaText('erl_p8_0_v2') }} </th>
							{% endif %}

					
							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p9_0_v1')}}.{{obj_enc.getPreguntaText('erl_p9_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p9_0_v2')}}.{{obj_enc.getPreguntaText('erl_p9_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p9_0_v1')}}.{{obj_enc.getPreguntaText('erl_p9_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p9_0_v2')}}.{{obj_enc.getPreguntaText('erl_p9_0_v2') }} </th>
							{% endif %}


							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p10_0_v1')}}.{{obj_enc.getPreguntaText('erl_p10_0_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							<th> {{ obj_enc.getPreguntaNumeroText('erl_p10_0_v2')}}.{{obj_enc.getPreguntaText('erl_p10_0_v2') }} </th>
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p10_0_v1')}}.{{obj_enc.getPreguntaText('erl_p10_0_v1') }} </th>
							<th> {{ obj_enc.getPreguntaNumeroText('erl_p10_0_v2')}}.{{obj_enc.getPreguntaText('erl_p10_0_v2') }} </th>
							{% endif %}
						

					
							{% if enc_formato == "presencial" %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p11_0_v1')}}.{{obj_enc.getPreguntaText('erl_p11_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p12_0_v1')}}.{{obj_enc.getPreguntaText('erl_p12_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p12_1_v1')}}.{{obj_enc.getPreguntaText('erl_p12_1_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_0_v1')}}.{{obj_enc.getPreguntaText('erl_p13_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_1_v1')}}.{{obj_enc.getPreguntaText('erl_p13_1_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_2_v1')}}.{{obj_enc.getPreguntaText('erl_p13_2_v1') }} </th>
							{% elseif enc_formato == "telefonica" %}
							{% else %}
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p11_0_v1')}}.{{obj_enc.getPreguntaText('erl_p11_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p12_0_v1')}}.{{obj_enc.getPreguntaText('erl_p12_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p12_1_v1')}}.{{obj_enc.getPreguntaText('erl_p12_1_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_0_v1')}}.{{obj_enc.getPreguntaText('erl_p13_0_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_1_v1')}}.{{obj_enc.getPreguntaText('erl_p13_1_v1') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p13_2_v1')}}.{{obj_enc.getPreguntaText('erl_p13_2_v1') }} </th>
							{% endif %}

						
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p14_0_v0')}}.{{obj_enc.getPreguntaText('erl_p14_0_v0') }} </th>

							<th>{{ obj_enc.getPreguntaNumeroText('erl_p14_1_v0')}}.{{obj_enc.getPreguntaText('erl_p14_1_v0') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p15_0_v0')}}.{{obj_enc.getPreguntaText('erl_p15_0_v0') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p16_0_v0')}}.{{obj_enc.getPreguntaText('erl_p16_0_v0') }} </th>
							<th>{{ obj_enc.getPreguntaNumeroText('erl_p17_0_v0')}}.{{obj_enc.getPreguntaText('erl_p17_0_v0') }} </th>

						
			            </tr>
			        </thead>
			        <tbody>
	                {% endif %}						
                        <tr>
							<td>{{ reg.ese_id }}</td>
							<td>{{ reg.enc_id }} </td>
							<td>{{ reg.tip_nombre }}</td>
							<td>{{ reg.ese_nombre }}</td>
							<td>{{ reg.emp_nombre }}</td>

							<td>{{ reg.inv_nombre }}</td>
							<td>{{ reg.ana_nombre }}</td>

							<td>{{ reg.usu_nombre }}</td>

							{% if reg.enc_fechaentregacliente is defined %}
								<td data-order='{{ date("Y-m-d H:i:s", strtotime(reg.enc_fechaentregacliente)) }}'>
									{{ date("d-m-Y H:i:s", strtotime(reg.enc_fechaentregacliente)) }}
								</td>
							{% else %}
								<td></td>
							{% endif %}
							
							{% if reg.enc_fecharealizo is defined %}
								<td data-order='{{ date("Y-m-d H:i:s", strtotime(reg.enc_fecharealizo)) }}'>
									{{ date("d-m-Y H:i:s", strtotime(reg.enc_fecharealizo)) }}
								</td>
							{% else %}
								<td></td>
							{% endif %}
							

							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p1_0_v0',reg.erl_p1_0_v0) }}</td>

							<td>{{reg.erl_p1_1_v0 }}</td>

							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p2_0_v0',reg.erl_p2_0_v0) }}</td>

						

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p3_0_v1',reg.erl_p3_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p3_0_v2',reg.erl_p3_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p3_0_v1',reg.erl_p3_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p3_0_v2',reg.erl_p3_0_v2) }}</td>
							{% endif %}


							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p4_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p4_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p4_0_v1) }}</td>
							<td>{{obj_enc.getRespuestaYN(reg.erl_p4_0_v2) }}</td>
							{% endif %}

			



							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p5_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p5_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p5_0_v1) }}</td>
							<td>{{obj_enc.getRespuestaYN(reg.erl_p5_0_v2) }}</td>
							{% endif %}

							

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p6_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							{% else %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p6_0_v1) }}</td>
							{% endif %}


							<!-- esta tiene un error -->


						
							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p7_0_v1',reg.erl_p7_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p7_0_v2',reg.erl_p7_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p7_0_v1',reg.erl_p7_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p7_0_v2',reg.erl_p7_0_v2) }}</td>
							{% endif %}


							<td>
								{% if reg.erl_p7_1_v1 is not empty %}
								{{ reg.erl_p7_1_v1 }}
							{% else %}
								{{ reg.erl_p7_1_v2 }}
							{% endif %}
							</td>


	

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p8_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p8_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p8_0_v1) }}</td>
							<td>{{obj_enc.getRespuestaYN(reg.erl_p8_0_v2) }}</td>
							{% endif %}

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p9_0_v1',reg.erl_p9_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p9_0_v2',reg.erl_p9_0_v2) }} </td>
							{% else %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p9_0_v1',reg.erl_p9_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p9_0_v2',reg.erl_p9_0_v2) }} </td>
							{% endif %}

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p10_0_v1',reg.erl_p10_0_v1) }}</td>
							{% elseif enc_formato == "telefonica" %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p10_0_v2',reg.erl_p10_0_v2) }}</td>
							{% else %}
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p10_0_v1',reg.erl_p10_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p10_0_v2',reg.erl_p10_0_v2) }}</td>
							{% endif %}

							{% if enc_formato == "presencial" %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p11_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p12_0_v1',reg.erl_p12_0_v1) }}</td>
							<td>{{reg.erl_p12_1_v1 }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p13_0_v1',reg.erl_p13_0_v1) }} </td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p13_1_v1',reg.erl_p13_1_v1) }} </td>
							<td>{{reg.erl_p13_2_v1 }}</td>
							{% elseif enc_formato == "telefonica" %}
							{% else %}
							<td>{{obj_enc.getRespuestaYN(reg.erl_p11_0_v1) }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p12_0_v1',reg.erl_p12_0_v1) }}</td>
							<td>{{reg.erl_p12_1_v1 }}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p13_0_v1',reg.erl_p13_0_v1) }} </td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p13_1_v1',reg.erl_p13_1_v1) }} </td>
							<td>{{reg.erl_p13_2_v1 }}</td>
							{% endif %}
			

							<td>{{obj_enc.getRespuestaYN(reg.erl_p14_0_v0) }}</td>
							<td>{{reg.erl_p14_1_v0}}</td>
							<td>{{obj_enc.getTextoRespuestaByPregunta('erl_p15_0_v0',reg.erl_p15_0_v0) }}</td>
							<td>{{reg.erl_p16_0_v0 }}</td>
							<td>{{reg.erl_p17_0_v0}}</td>


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
{% include "/encuestacalidadreporte/complementos/vdos/2024_enero/script-graficas-respuestas-js.volt" %}

<script>
	$(document).ready(function(){
	consultar_estadisticas_respuestas('form_encuestas_respuestas');
   });
</script>
