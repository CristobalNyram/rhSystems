
	
	{% set peditar = 1 %}
	{% set pchfoto = 1 %}
	{% set peliminar = 1 %}
	{% set ppassword = 1 %}
	{% set veintiuno = acceso.verificar(21,rol_id) %}
	{% set sesentaydos = acceso.verificar(62,rol_id) %}
	{% set usuario_session_nivel = usuario_sesion['rol_nivel'] %}
{% for usu in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
		    <table id="td_usuario" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		        <thead class="thead-light-crm">

		            <tr>
		                <th>Nombre</th>
		                <th>Correo electrónico</th>
		                <th>Rol</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}

				{% if usu.getRolNivel(usu.rol_id) > usuario_session_nivel  %}							

								<tr>
									<td>{{ usu.usu_nombre }} {{usu.usu_primerapellido}} {{usu.usu_segundoapellido}}</td>
									<td>{{ usu.usu_correo }}</td>
									<td>
										{{usu.getRol()}}
									</td>
									<td>
										{{usu.getEstatusDetail()}}
									</td>
									<td>
										{% if peditar==1 %}
										<a data-toggle="modal" type="button" title="Editar" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_usuario-modal" onclick="fneditusuario('{{ usu.usu_id }}','{{ usu.usu_nombre }} {{ usu.usu_primerapellido }} {{usu.usu_segundoapellido}}')">
											<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
										</a>
										{% endif %}
										
										{% if peliminar==1 %}
									<a type="button" class="" title='Eliminar' onclick="fnelim({{usu.usu_id}})"><i class="mdi mdi-delete mdi-18px btn-icon"></i></a>
									{% endif %}
									{% if ppassword==1 %}
										<a onclick="fncambiarcontra('{{usu.usu_id}}')" href="#" data-toggle="modal" data-target="#cpassword" class="" title='Cambiar Contraseña'><i class="mdi mdi-key-change mdi-18px btn-icon" ></i></a>
									{% endif %}
							
									</td>
									

								</tr>
					{% endif %}
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}