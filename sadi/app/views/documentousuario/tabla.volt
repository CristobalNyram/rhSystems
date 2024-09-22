{% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="documentotable" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Folio</th>
		                <th>Archivo</th>
		                <th>Categoría</th>
						<th>Estatus</th>
						<th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>
		                	{{ arc.dou_id }}
		               	</td>
		                <td class="uppercase">
		                	{{ arc.dou_nombre }}		                
		                </td>
		                <td>{{ arc.doc_nombre }}</td>
						<td>{{ documento.getEstatusDetail(arc.dou_estatus) }}</td>
		                <td>
		                	
	                		{{ link_to("documentousuario/descargar/"~arc.dou_id, '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}
		                	
		                	<a data-toggle="modal" title="Leer archivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo-modal" onclick="leerarchivo('{{arc.dou_id}}','{{arc.dou_nombre}}','documentos')">
			                	<i class="mdi mdi-eye mdi-18px btn-icon"></i>
			                </a>
                            <a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneliminarevidencia('{{arc.dou_id}}','{{ arc.usu_id }}')">
                                <i class="mdi mdi-delete mdi-18px btn-icon"></i>
                            </a>
							{% if arc.dou_estatus==3 %}
								<a title="Aprobar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnautorizardocumento('{{arc.dou_id}}','{{ arc.usu_id }}')">
                                	<i class="mdi mdi-check-bold mdi-18px btn-icon"></i>
                            	</a>
							{% endif %}
							{% if arc.dou_estatus==1 %}
								<a title="Marcar como desactualizado" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fndesactualizadodocumento('{{arc.dou_id}}','{{ arc.usu_id }}')">
                                	<i class="mdi mdi-shield-alert mdi-18px btn-icon"></i>
                            	</a>
							{% endif %}
			                
		                    
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