<div style="padding-top: 25px">
{% for cen in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="empresa_table" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
						<th>ID</th>
						<th>Ubicacion</th>
		                <th>Rep. legal</th>
		                <th>Rep. de los trab.</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		            	<td>{{ cen.cen_id }}</td>
		               	<td>{{ cen.cen_ubicacion }}</td>
		                <td>
		                	{% set leg = cen.getLegal() %}
		                	{% if leg=='' %}
			                	<a onclick="fncreaterep({{cen.cen_id}},1);" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearRepTra-modal"><i class="btn btn-btnempresa">+</i></a>
							{% else %}
								{{ leg }}
								<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarrepresentante-modal" onclick="fnedit('{{cen.rep_idlegal}}','{{ leg }}')">
		                      		<i class="fa fa-pencil"></i>
		                    	</a>
								<a type="button" class="btn" title='Eliminar' onclick="fnelimrep('{{cen.cen_id}}','1')"><i class="fa fa-trash-o"></i></a>
							{% endif %}

		                </td>
		                <td>
		                	{% set tra = cen.getRepTrabajador() %}
		                	{% if tra=='' %}
			                	<a onclick="fncreaterep({{cen.cen_id}},2);" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearRepTra-modal"><i class="btn btn-btnempresa">+</i></a>
							{% else %}
								{{ tra }}
								<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarrepresentante-modal" onclick="fnedit('{{cen.rep_idtra}}','{{ tra }}')">
		                      		<i class="fa fa-pencil"></i>
		                    	</a>
								<a type="button" class="btn" title='Eliminar' onclick="fnelimrep('{{cen.cen_id}}','2')"><i class="fa fa-trash-o"></i></a>
							{% endif %}
		                </td>
		                
		                <td>{{ cen.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarcentro-modal" onclick="fneditcentro('{{cen.cen_id}}','{{ cen.cen_ubicacion }}')">
		                      	<i class="fa fa-pencil"></i>
		                    </a>
		                	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{cen.cen_id}}')"><i class="fa fa-trash-o"></i></a>
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
