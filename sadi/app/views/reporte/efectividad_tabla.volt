
<h6 class="text-center" style="margin-top:0;">
	<button type="button" >
		SIN ENTREGAR <span class="badge badge-light">{{ noentregados }}</span>
	</button>	
</h6>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for reg in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>ID SADI</th>
                        <th>FECHA ALTA</th>
						<th>ENTREGA CLIENTE</th>
						<th>EFECTIVIDAD</th>
		            </tr>
		        </thead>
		        <tbody>
                {% endif %}
              		<tr>
                        <td>{{ reg.ese_id }}</td>
						<td>{{ reg.ese_registro }}</td>
						<td>{{ reg.ese_fechaentregacliente }}</td>
						<td>{{ reg.diferencia }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}


{% for reg in datosgrupo %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="datatable-buttonsgrupo" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">
		            <tr>
                        <th>0 DÍAS</th>
                        <th>1 DÍA</th>
						<th>2 DÍAS</th>
						<th>3 DÍAS</th>
						<th>4 DÍAS</th>
						<th>5 DÍAS</th>
						<th>6 DÍAS ó MÁS</th>
		            </tr>
		        </thead>
		        <tbody>
                {% endif %}
              		<tr>
                        <td id="grupo0">{{ reg.grupo0 }}</td>
						<td id="grupo1">{{ reg.grupo1 }}</td>
						<td id="grupo2">{{ reg.grupo2 }}</td>
						<td id="grupo3">{{ reg.grupo3 }}</td>
						<td id="grupo4">{{ reg.grupo4 }}</td>
						<td id="grupo5">{{ reg.grupo5 }}</td>
						<td id="grupo6">{{ reg.grupo6 }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}

<div class="card card-crm d-flex " id="listado-graficas-respuestas-container" >
	<div class="row" id="listado-graficas-respuestas" >
        <div class="col-12 col-md-12 mb-5 border-bottom">
			
        	<div id="textos-reporte-respuestas-pregunta-1" class="text-center texto-graficas" >

            </div>
        <div id="grafica" class="pie-chart-reporte-respuestas">

		</div>
	</div>
</div>

<input type="hidden" id="texto" name="texto" value="{{descripcion}}">