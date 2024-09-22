<div style="padding-top: 25px">
	<!-- {% set peditar = acceso.verificar(64) %}
	{% set pchfoto = acceso.verificar(67) %}
	{% set peliminar = acceso.verificar(65) %}
	{% set ppassword = acceso.verificar(66) %} -->
	{% set peditar = 1 %}
	{% set pchfoto = 1 %}
	{% set peliminar = 1 %}
	{% set ppassword = 1 %}
{% for usu in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_usuario" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <!-- <th>Puesto</th> -->
		                <th>Nombre</th>
		                <th>Correo electrónico</th>
		                <!-- <th>Antigüedad</th> -->
		                <!-- <th>Área</th> -->
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                
		                <td>{{ usu.usu_nombre }} {{usu.usu_primerapellido}} {{usu.usu_segundoapellido}}</td>
		                <td>{{ usu.usu_correo }}</td> 
		                
		                
		                <td width="7%">
		                	{% if peditar==1 %}
		                	{{ link_to("usuario/formulario/"~usu.usu_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	{% endif %}
		                	
		                	{% if peliminar==1 %}
		                <a type="button" class="btn" title='Eliminar' onclick="fnelim({{usu.usu_id}})"><i class="fa fa-trash-o"></i></a>
		                {% endif %}
		                {% if ppassword==1 %}
		                <a onclick="fncambiarcontra('{{usu.usu_id}}')" href="#" data-bs-toggle="modal" data-bs-target="#cpassword" class="btn" title='Cambiar Contraseña'><i class="fa fa-key" ></i></a>
		                </td>
		                {% endif %}
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