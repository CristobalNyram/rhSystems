
<h5 class="text-center">Listado de encuestas
	
</h5>
<h6 class="text-center" style="margin-top:0;">
	<button type="button" class="btn {{ enc_helper_estatus['class_helper'] }}">
		{{ enc_helper_estatus['texto'] }} <span class="badge badge-light">{{ enc_contador_total }}</span>
	
	</button>	
</h6>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for enc in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			<!-- <div class="card card-crm"> -->
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
                            <th>ID</th>
                            <th>ESE ID</th>
							<th>Fecha entrega cliente</th>

							{% if enc_columnas_extra is 1 %}

							<th>Fecha realización</th>
							<th>Estatus</th>
						    {% endif %}

                            <th>Encuestado</th>
							<th>Investigador</th>

                            <th>Comentario</th>
                            <th>Usuario movimiento</th>

			            </tr>
			        </thead>
			        <tbody>
	                {% endif %}						
                        <tr>
                            <td>{{enc.enc_id}}</td>
                            <td>{{enc.ese_id}} </td>
							{% if enc.enc_fechaentregacliente is defined %}
										<td  data-order='{{ date("Y-m-d H:i:s",strtotime(enc.enc_fechaentregacliente)) }}' >
											{{ date("d-m-Y H:i:s", strtotime(enc.enc_fechaentregacliente)) }}

										</td>
									{% else %}
										<td></td>
						    {% endif %}
							{% if enc_columnas_extra is 1 %}


							
						    {% if enc.enc_fecharealizo is defined %}
										<td  data-order='{{ date("Y-m-d H:i:s",strtotime(enc.enc_fecharealizo)) }}' >
											{{ date("d-m-Y H:i:s", strtotime(enc.enc_fecharealizo)) }}

										</td>
									{% else %}
										<td></td>
						    {% endif %}

							

						

							<td> {{obj_enc.getEstatus(enc.enc_estatus)}} </td>
						    {% endif %}

                            <td class="text-uppercase">{{enc.ese_nombre}}</td>
							<td class="text-uppercase">{{enc.inv_nombre}}</td>

                            <td class="text-uppercase">{{enc.enc_comentario}}</td>
                        

                            <td class="text-uppercase">{{enc.usu_nombre}}</td>

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