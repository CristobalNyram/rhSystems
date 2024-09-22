<input type="hidden" name="fechainicio" id= "fechainicio" value="{{fechainicio}}">
<input type="hidden" name="fechafin" id= "fechafin" value="{{fechafin}}">

<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for ese in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			<!-- <div class="card card-crm"> -->
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
                            <th></th>
                            <th>ID investigador</th>
                            <th>Investigador</th>
                            <th>Pago honorario</th>
                            <th>Pago viático</th>
                            <th>Suma honorario-viático</th>

			            </tr>
			        </thead>
			        <tbody>
	                {% endif %}						
                        <tr>
                        	<td></td>
                            <td>{{ese.inv_id}}</td>
                            <td class="uppercase">{{ usuario.getNombre(ese.inv_id) }}</td>
                            <td>${{ese.honorario}}</td>
                            <td>${{ese.viatico}}</td>
                            <td>${{ese.honorario + ese.viatico}}</td>

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