<!-- <div style="padding-top: 25px"> -->
{% set ciencuentayseis = acceso.verificar(56,rol_id) %}

{% for arc in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="archivotablecliente" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead class="thead-light-crm">
		            <tr>
		                <th>Archivo</th>
						<th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		              
		                <td class="uppercase">
		                	{{ arc.arc_nombre }}		                
		                </td>

					
		                
		                <td>
							{{ link_to("archivo/descenc/"~encriptarparametros.encriiptarId(arc.arc_id), '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}

		                	<a data-toggle="modal" title="Leer archivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo-modal" onclick="leerarchivocliente('{{encriptarparametros.encriiptarId(arc.arc_id)}}','{{arc.arc_nombre}}','archivos')">
								<i class="mdi mdi-eye mdi-18px btn-icon"></i>
							</a>

			                
		                    
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