<!-- <div style="padding-top: 25px"> -->
{% set ciencuentayseis = acceso.verificar(56,rol_id) %}

{% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="archivotable" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio</th>
		                <th>Archivo</th>
		                <th>Categoría</th>
						{% if ciencuentayseis==1 %}
						<th>Adjuntar archivos a reporte</th>
						{% endif %}

						<th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ arc.arc_id }}
		               	</td>
		                <td class="uppercase">
		                	{{ arc.arc_nombre }}		                
		                </td>
		                <td>{{ arc.cat_nombre }}</td>

						{% if ciencuentayseis==1 %}
						<td class=" d-flex justify-content-center align-content-center">
							<div>
								
								{% include "/archivo/complementos/vaidaciones_adjuntar_reporte.volt" %}


							</div>

						</td>
						{% endif %}
		                
		                <td>
		                	
							{% include "/archivo/complementos/opciones_archivo.volt" %}

			                
		                    
		                </td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}
<!-- </div> -->