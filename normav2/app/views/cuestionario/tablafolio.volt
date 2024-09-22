<div class="mt-1 col-12">




{% for adm in page %}
    {% if loop.first %}
		<!-- <div class="card card-crm" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_datos" class="table table-striped table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> esta tabla tiene un color mas claro y tiene un scrool -->


			<div class="mt-3 col-12 ">

					<div class="card card-crm">
					<div id="listado">
							<table id="td_datos" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead class="thead-light-crm">
											<tr>
												<th></th>
												<th>Folio</th>
												<th>Matrícula</th>
												<th>Nombre</th>
												
												<th>Empresa</th>
												<th>Puesto</th>
												<th>Área</th>

												<th>Correo</th>

												{% if cuestionario[0]['estado']==1 %}
												<th>Fech. Cuestionario 1</th>
												{% else %}

												{% endif %}
												
												{% if cuestionario[1]['estado']==1 %}
												<th>Fech. Cuestionario 2</th>
												{% else %}

												{% endif %}

												{% if cuestionario[2]['estado']==1 %}
												<th>Fech. Cuestionario 3</th>
												{% else %}

												{% endif %}

												
												{% if cuestionario[3]['estado']==1 %}
												<th>Fech. Cuestionario clima laboral</th>
												{% else %}

												{% endif %}

												<th>
													Opciones
												</th>
											
											
											</tr>
										</thead>




												<tbody>
												{% endif %}
													<tr>
														<td>{{ adm.fol_id }}</td>
														<td>{{ adm.fol_id }}</td>
														<td>{{ adm.fol_matricula }}</td>

													

														<td class="uppercase">{{ adm.fol_nombre }} {{ adm.fol_primerapellido }} {{ adm.fol_segundoapellido }}</td>
														<td> 
														

														{% if adm.emp_nombre=='' %}
															SIN EMPRESA
														{% else %}
														{{ adm.emp_nombre }} 			
																	

														{% endif %}

															

														</td>
														<td>{{adm.fol_puesto}}</td>
														<td> {{ adm.fol_area }}</td>
														<td> {{ adm.fol_correo }} </td>





																		
														{% if cuestionario[0]['estado']==1 %}
																	{% set fechauno = foliouno.getFechaCueUno(adm.fol_id) %}
																	{% if fechauno=='Sin contestar' %}
																		<td>{{fechauno}}</td>
																	{% else %}
																		<td data-order='{{ date("Y-m-d",strtotime(fechauno)) }}'>{{ date("d-m-Y ", strtotime(fechauno)) }}</td>
																	{% endif %}
														{% else %}

														{% endif %}


														{% if cuestionario[1]['estado']==1 %}
																	{% set fechados = foliodos.getFechaCueDos(adm.fol_id) %}
																	{% if fechados=='Sin contestar' %}
																		<td>{{fechados}}</td>
																	{% else %}
																		<td data-order='{{ date("Y-m-d",strtotime(fechados)) }}'>{{ date("d-m-Y ", strtotime(fechados)) }}</td>
																	{% endif %}

														{% else %}

														{% endif %}


														{% if cuestionario[2]['estado']==1 %}
																		{% set fechatres = foliotres.getFechaCueTres(adm.fol_id) %}
																		{% if fechatres=='Sin contestar' %}
																			<td>{{fechatres}}</td>
																		{% else %}
																			<td data-order='{{ date("Y-m-d",strtotime(fechatres)) }}'>{{ date("d-m-Y ", strtotime(fechatres)) }}</td>
																		{% endif %}
														{% else %}

														{% endif %}

															
														{% if cuestionario[3]['estado']==1 %}
																			{% set fechaclima = folioclima.getFechaCueClima(adm.fol_id) %}
																			{% if fechaclima=='Sin contestar' %}
																			<td>{{fechaclima}}</td>
																		{% else %}
																			<td data-order='{{ date("Y-m-d",strtotime(fechaclima)) }}'>{{ date("d-m-Y ", strtotime(fechaclima)) }}</td>
																		{% endif %}
																		
																		


														{% else %}

														{% endif %}
														<td class="text-center">
														<a 
														onclick="fneditar(
															'{{ adm.fol_id }}')" type="button" type="button"> 
																<i class="mdi mdi-pencil mdi-45px btn-icon"></i></a>

															<a onclick="fnelim({{ adm.fol_id }})" title="Borrar participante." data-toggle="popover"><i class="mdi mdi-delete mdi-45px btn-icon"></i></a>
													
														</td>

													

														
														

												
																	
														
													</tr>
												{% if loop.last %}
												</tbody>

						</table>

					</div>
					</div>
			</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}
</div>
