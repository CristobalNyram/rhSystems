<!-- <div style="padding-top: 25px"> -->
    {% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="archivotable_transporte" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio de evidencia</th>
		                <th>Nombre archivo</th>
		                <th>Nota</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ arc.art_id }}
		               	</td>
		                <td class="uppercase">
		                	{{ arc.art_nombre }}		                
		                </td>

						<td class="uppercase">
		                	{{ arc.art_nota }}		                
		                </td>
		                
		                <td>
		                
		                	
							{{ link_to("transporte/descargar/"~arc.art_id, '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}
		                	
		                	<a data-toggle="modal" title="Leer archivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo-modal" onclick="leerarchivo('{{arc.art_id}}','{{arc.art_nombre}}','transportes')">
			                	<i class="mdi mdi-eye mdi-18px btn-icon"></i>
			                </a>
			                
		                
			                <a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneliminarevidenciaTransporte('{{arc.art_id}}','{{ arc.tra_id }}')">
		                      	<i class="mdi mdi-delete mdi-18px btn-icon"></i>
		                    </a>
			                
		                
			             
		                    
		                </td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen archivos  en esta tabla de archivos.
{% endfor %}
<!-- </div> -->