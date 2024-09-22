{% include "/estudio/complementos/permisos/permisos_asignar_investigador.volt" %}


<div class="mx-auto" style="width: 550px;" id="accordion">
	<div class="card"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        	<div class="card-header" id="headingOne">
          <!-- <h3 class="mb-0"> -->
            Fecha: {{ fechahoy }} - Total de estudios dados de alta: {{ estudios }}
            <br>
            Total asignados: {{asignados}}
            <br>
            Total ESES: {{socioeconomico}} - Total VER: {{verificacion}} - Total SUP: {{supervivencia}}
          <!-- </h3> -->
        </div></button>
        
      </div>
    </div>
{% for esc in estudio %}
        {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_empresa" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            	<tr>
		            		<th>Fol. verificación</th>
										<th>Fecha alta</th>
										<th>Folio</th>
										<th>Empresa</th>
										<th>Centro costo</th>
										<th>Nombre</th>
										<th>Estado</th>
										<th>Municipio</th>
										<th>Tipo documento</th>
		                <th class="all">Opciones</th>
		            	</tr>
		        </thead>
		        <tbody>
       		{% endif %}
							<tr>
								<td>{{ esc.ese_folioverificacion}}</td>
								<td class="uppercase" data-order='{{ date("Y-m-d",strtotime(esc.ese_registro)) }}'>
							            	{{ date("d-m-Y", strtotime(esc.ese_registro)) }}
								</td>
								<td title="{{ esc.ese_folioverificacion}}">{{ esc.ese_id }}</td>
								<td>
									{% if  esc.empresa_nombre=='' %}
										SIN EMPRESA      
									{% else %}
								   		{{ esc.empresa_nombre}}
								   	{% endif %}
								</td>
								<td>{{ esc.cen_nombre }}</td>
								<td>{{ esc.ese_nombre }} {{esc.ese_primerapellido}} {{esc.ese_segundoapellido}}</td>
								<td>{{ esc.est_nombre }}</td>
								<td>
							
									{% if  esc.mun_nombre=='' or esc.mun_nombre== null %}
									SIN MUNICIPIO      
									{% else %}
									   {{ esc.mun_nombre}}
								  	 {% endif %}

								</td>
					                    	<td>{{ esc.tip_clave }}</td>
								<td width="7%">
									{% include "/estudio/complementos/opciones_asignar_investigador.volt" %}

					
					      		 </td>
	            	</tr>
            	{% if loop.last %}
		        </tbody>
		    </table>
		</div>
        {% endif %}
    	{% else %}
	   <strong>
		  No existen estudios que se encuentre en la etapa inicial.
	   </strong>
{% endfor %}