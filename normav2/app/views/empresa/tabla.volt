<div style="padding-top: 25px">
{% for emp in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="empresa" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
						<th>Nombre</th>
						<th>Razón social</th>
		                <th>RFC</th>
		                <th width="7%">Correo</th>
		                <th>Centros de trabajo</th>
		                <!-- <th>Rep. legal</th> -->
		                <!-- <th>Rep. de los trab.</th> -->
		                <th>Logo</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		            	<td class="uppercase">{{ emp.emp_nombre }}</td>
		               	<td class="uppercase">{{ emp.emp_razonsocial }}</td>
		                <td class="uppercase">{{ emp.emp_rfc }}</td>
		                <td>{{ emp.emp_correo }}</td>
		                <td>{{ emp.getCantidadCentros() }}</td>
		                <!-- <td>
		                	{% set leg = emp.getLegal() %}
		                	{% if leg=='' %}
			                	<a onclick="fncreaterep({{emp.emp_id}},1);" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearRepTra-modal"><i class="btn btn-btnempresa">+</i></a>
							{% else %}
								{{ leg }}
								<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarrepresentante-modal" onclick="fnedit('{{emp.rep_idlegal}}','{{ leg }}')">
		                      		<i class="fa fa-pencil"></i>
		                    	</a>
								<a type="button" class="btn" title='Eliminar' onclick="fnelimrep('{{emp.emp_id}}','1')"><i class="fa fa-trash-o"></i></a>
							{% endif %}

		                </td>
		                <td>
		                	{% set tra = emp.getRepTrabajador() %}
		                	{% if tra=='' %}
			                	<a onclick="fncreaterep({{emp.emp_id}},2);" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#crearRepTra-modal"><i class="btn btn-btnempresa">+</i></a>
							{% else %}
								{{ tra }}
								<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarrepresentante-modal" onclick="fnedit('{{emp.rep_idtra}}','{{ tra }}')">
		                      		<i class="fa fa-pencil"></i>
		                    	</a>
								<a type="button" class="btn" title='Eliminar' onclick="fnelimrep('{{emp.emp_id}}','2')"><i class="fa fa-trash-o"></i></a>
							{% endif %}
		                </td> -->
		                <td>{{ image("images/empresa/"~emp.emp_logo, "class": "img-responsive") }}</td>
		                <td>{{ emp.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("empresa/formulario/"~emp.emp_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{emp.emp_id}}')"><i class="fa fa-trash-o"></i></a>

		                 	<a onclick="fncambiarfoto('{{emp.emp_razonsocial}}','{{emp.emp_id}}');" class="btn"  data-toggle="modal" data-target="#mdlcambiarfoto" title='Cambiar imagen'><i class="fa fa-image" ></i></a>

		                 	{{ link_to("centrotrabajo/index/"~emp.emp_id, '<i class="fa fa-industry"></i>', "class": "btn","title":"Centro de trabajo") }}
		                 	
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
