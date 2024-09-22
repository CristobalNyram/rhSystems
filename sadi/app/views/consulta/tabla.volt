{% set dieciseis = acceso.verificar(16,rol_id) %}
{% set veinte = acceso.verificar(20,rol_id) %}
{% set treintaycuatro = acceso.verificar(34,rol_id) %}
{% set cuarentaytres = acceso.verificar(43,rol_id) %}
{% set setentaynueve = acceso.verificar(79,rol_id) %}
{% set ochentaynueve = acceso.verificar(89,rol_id) %}
{% set noventaycuatro = acceso.verificar(94,rol_id) %}

<input type="hidden" id="nombrearchivo" value='{{titulo}}'>

<div class="card card-crm">
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for ese in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			<!-- <div class="card card-crm"> -->
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
			            	<th>Folio</th>
							<th>Tipo de estudio</th>
			            	<th>Empresa</th>
							{% if noventaycuatro ==1 %}
								{% if columna_ese_empresarecluta ==1 %}
								<th>Empresa recluta</th>
								{% endif %}
							{% endif %}

			                <th>Fecha de solicitud</th>
			                <th>Estatus</th>
							<th>Investigador</th>
							<th>Fecha asignación investigador</th>
							<th>Fecha entrega investigador</th>
			                <th>Analista</th>
							<th>Fecha asignación analista</th>
							<th>Fecha entrega analista</th>
							<th>Fecha entrega cliente</th>
							<th>Folio de verificación o núm. control</th>
							<th>Fecha cancelación</th>
							<th>Tipo de persona</th>
							<th>Nombre</th>
							<th>CURP</th>
							<th>Fecha nacimiento</th>
							<th>Correo</th>
							<th>Teléfono o Celular</th>
							<th>Dirección</th>
							<th>Centro de costos</th>
							<th>Contacto empresa</th>
							<th>Tipo de verificación</th>
							<th>Estado</th>
							<th>Municipio</th>
							{% if columna_cal ==1 %}

									{% if ochentaynueve ==1 %}
									<th>Calificación </th>
									{% endif %}
									
							{% endif %}

							<th class="all">Opciones</th>
			            </tr>
			        </thead>
			        <tbody>
	{% endif %}						

			            <tr {% if ese.ese_estatus==-2%}   class="polvencida" {% endif %}>
			            	<td>{{ ese.ese_id }}</td>
							<td class="uppercase">{{ ese.tip_clave}}</td>

							<td class="uppercase">{{ ese.emp_nombre }}</td>
							
								{% if noventaycuatro ==1 %}
								{% if columna_ese_empresarecluta ==1 %}
								<td class="uppercase">
									{{ ese.ese_empresarecluta }}
								</td>
								
								{% endif %}
								{% endif %}
							

			               	<td class="uppercase" data-order='{{ date("Y-m-d",strtotime(ese.ese_registro)) }}'>{{ date("d-m-Y", strtotime(ese.ese_registro)) }}</td>
			               	<td class="uppercase">
								<span class="badge 
								{{ estudio.getEstatusBanderaColor(ese.ese_estatus) }}
								 p-2">
								 
								
										{{ estudio.getEstatusDetail(ese.ese_estatus) }}
								
								</span>

						
							
							</td>

									{% if ese.investigador is defined %}
										<td class="uppercase">{{ usuario.getNombre(ese.investigador) }}</td>
									{% else %}
										<td>Sin asignar</td>
									{% endif %}

	
									<td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaasiginvestigador)) }}'>
										{% if ese.ese_fechaasiginvestigador is defined %}
											{{ date("d-m-Y H:i:s" , strtotime(ese.ese_fechaasiginvestigador)) }}
										{% endif %}
		
		
									</td>
									<td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaentregainvestigador)) }}'>
										{% if ese.ese_fechaentregainvestigador is defined %}
											{{ date("d-m-Y H:i:s", strtotime(ese.ese_fechaentregainvestigador)) }}
										{% endif %}
		
		
									</td>

							<td class="uppercase">
								{% if ese.ana_id is defined   %}
									{{ usuario.getNombre(ese.ana_id) }}
								{% else  %}
								{% endif  %}
							</td>
							<td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaasiganalista)) }}'>
								
								{% if ese.ese_fechaasiganalista is defined %}
									{{ date("d-m-Y H:i:s", strtotime(ese.ese_fechaasiganalista)) }}
								{% endif %}

							</td>
							<td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaentregaanalista)) }}'>
								{% if ese.ese_fechaentregaanalista is defined %}
									{{ date("d-m-Y H:i:s", strtotime(ese.ese_fechaentregaanalista)) }}
								{% endif %}
							</td>
						
									{% if ese.ese_fechaentregacliente is defined %}
										<td  data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaentregacliente)) }}' >
											{{ date("d-m-Y H:i:s", strtotime(ese.ese_fechaentregacliente)) }}

										</td>
									{% else %}
										<td>Sin entregar</td>
									{% endif %}
							
							<td>
							
								
								{% if ese.ese_folioverificacion is defined %}
							    {{ ese.ese_folioverificacion }} 
								{% endif %}	
							</td>
	
									{% if ese.ese_fechacancelacion is defined  and  ese.ese_estatus ==-2%}
										<td  data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechacancelacion)) }}' >
											{{ date("d-m-Y H:i:s", strtotime(ese.ese_fechacancelacion)) }}

										</td>
									{% else %}
										<td></td>
									{% endif %}
							<td class="uppercase">
								{% if ese.ese_tippersona is defined %}
								{{ estudio.getTipoPersona(ese.ese_tippersona) }}
								{% endif %}	
							</td>
							<td class="uppercase">
								
								{% if ese.ese_nombre is defined %}
							    {{ ese.ese_nombre }}  {{ ese.ese_primerapellido }} {{ ese.ese_segundoapellido }}
								{% endif %}	
							</td>
							<td class="uppercase">
								{% if ese.ese_curp is defined %}
							    {{ ese.ese_curp }} 
								{% endif %}	
							</td>
							<td data-order='{{ date("Y-m-d",strtotime(ese.ese_fechanacimiento)) }}'>
								{% if ese.ese_fechanacimiento is defined %}
								{{ date("d-m-Y", strtotime(ese.ese_fechanacimiento)) }}
								{% endif %}	
							</td>

							<td>
								{% if ese.ese_correo is defined %}
							    {{ ese.ese_correo }} 
								{% endif %}	
							</td>
							<td>
								{% if ese.ese_telefono is defined %}
							    Teléfono:{{ ese.ese_telefono }} ,
								{% endif %}	
								{% if ese.ese_celular is defined %}
							    Celular:{{ ese.ese_celular }} ,
								{% endif %}	
								
							</td>
							<td>	
								{% if ese.ese_numext is defined %}
							    	No. externo : {{ ese.ese_numext }} ,
								{% endif %}
								{% if ese.ese_numint is defined %}
							    	No. interno : {{ ese.ese_numint }} ,
								{% endif %}
								{% if ese.ese_calle is defined %}
							    	Calle: {{ ese.ese_calle }} ,
								{% endif %}
								{% if ese.ese_colonia is defined %}
								Colonia: {{ ese.ese_colonia }} ,
								{% endif %}
								{% if ese.ese_codpostal is defined %}
								Código postal: {{ ese.ese_codpostal }},
								{% endif %}	
								
							</td>
							
							<td class="text-uppercase">
							    {{ ese.cen_nombre }}
							</td>
							<td class="text-uppercase">
								{% if ese.cne_id is defined %}
							    {{ ese.cne_nombre }}  {{ ese.cne_primerapellido }}
								{% endif %}
							</td>
							<td></td>
							<td>
								{% if ese.est_id is defined %}
							    {{ ese.est_nombre }} 
								{% endif %}
							</td>
							<td>
								
								{% if ese.mun_id is defined %}
							    {{ ese.mun_nombre }} 
								{% endif %}
							</td>

							{% if ochentaynueve ==1 %}
								{% if columna_cal ==1 %}
									<td>
									{% if ese.daf_calificacion is defined and ese.daf_calificacion is not null and ese.daf_calificacion >= 0 %}
										<span style="{{ datofinalmodel.getEstatusBanderaColorGeneral(ese.cal_id,ese) }}" class="badge  p-2">
											{{ datofinalmodel.getCalificacionGeneral(ese.cal_id,ese) }}
										</span>
									{% else %}
										SIN REGISTRO
									{% endif %}
									</td>
								{% endif %}
							{% endif %}
		                	<td width="7%">
								{% include "/consulta/complementos/opciones_consulta.volt" %}
							</td>
			            </tr>
			        {% if loop.last %}
			        </tbody>
			    </table>
			<!-- </div> -->
		</div>
	{% endif %}
	{% else %}
	    <strong>No existen registros en este catálogo.</strong>
	</div>
{% endfor %}

