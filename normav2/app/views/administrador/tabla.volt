<div style="padding-top: 25px">
{% for adm in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="administrador" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>RFC</th>
		                <th>Director</th>
		                <th width="7%">Logo</th>
		                <th width="7%">Firma</th>
		                <th>Estatus</th>
		                <th>Default</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ adm.adm_id }}</td>
		                <td class="uppercase">{{ adm.adm_nombre }}</td>
		                <td class="uppercase">{{ adm.adm_rfc }}</td>
		                <td class="uppercase">
		                	{% set dir = admindir.getDirector(adm.adr_id) %}
		                	{% if dir=='' %}
			                	<a onclick="fncreatedir( '{{adm.adm_id}}');" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearDir-modal"><i class="btn btn-btnempresa">+</i></a>
							{% else %}
								{{ dir }}
								<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editardirector-modal" onclick="fnedit('{{ adm.adr_id }}','{{ dir }}')">
		                      		<i class="fa fa-pencil"></i>
		                    	</a>
								<a type="button" class="btn" title='Eliminar' onclick="fnelimdir('{{adm.adm_id}}','{{ dir }}')"><i class="fa fa-trash-o"></i></a>
							{% endif %}
		                </td>
		                <td>{{ image("images/recursos/"~adm.adm_logo, "class": "img-responsive") }}</td>
		                <td>
		                	{% if dir!='' %}
		                		{% set firma = admindir.getFirma(adm.adr_id) %}
		                		{{ image("images/firmas/"~firma, "class": "img-responsive") }}
		                	{% endif %}
		                	
		                </td>
		                <td class="uppercase">{{ adm.getEstatusDetail() }}</td>
		                <td class="uppercase">{{ adm.getDefault() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("administrador/formulario/"~adm.adm_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{adm.adm_id}}')"><i class="fa fa-trash-o"></i></a>
		                 	
		                 	<a onclick="fncambiarfoto('{{adm.adm_nombre}}','{{adm.adm_id}}');" class="btn"  data-toggle="modal" data-target="#mdlcambiarfoto" title='Cambiar imagen'><i class="fa fa-image" ></i></a>
		                 	{% if dir!='' %}
		                 		<a onclick="fncambiarfirma('{{dir}}','{{adm.adm_id}}');" class="btn"  data-toggle="modal" data-target="#mdlcambiarfirma" title='Cambiar firma'><i class="fa fa-address-card" ></i></a>
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
</div>
