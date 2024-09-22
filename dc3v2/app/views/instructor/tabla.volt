<div style="padding-top: 25px">
{% for ins in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="instructor" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>RFC</th>
		                <th>Correo</th>
		                <th>Firma</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td>{{ ins.ins_id }}</td>
		                <td class="uppercase">{{ ins.ins_nombre }} {{ ins.ins_primerapellido }} {{ ins.ins_segundoapellido }}</td>
		                <td class="uppercase">{{ ins.ins_rfc }}</td>
		                <td>{{ ins.ins_correo }}</td>
		                <td>
		                	{% if ins.ins_firma!='-' %}
		                		{{ image("images/firmas/"~ins.ins_firma, "class": "img-responsive") }}
		                	{% endif %}
		                	
		                </td>
		                <td class="uppercase">{{ ins.getEstatusDetail() }}</td>
		                <td width="7%">
		                	
		                	{{ link_to("instructor/formulario/"~ins.ins_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{ins.ins_id}}','{{ins.ins_id}}')"><i class="fa fa-trash-o"></i></a>

		                 	<a onclick="fncambiarfirma('{{ ins.ins_nombre }} {{ ins.ins_primerapellido }} {{ ins.ins_segundoapellido }}','{{ins.ins_id}}');" class="btn"  data-toggle="modal" data-target="#mdlcambiarfirma" title='Cambiar firma'><i class="fa fa-address-card" ></i></a>
		                 	
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
