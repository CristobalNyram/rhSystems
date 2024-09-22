<div style="padding-top: 25px">
	{% set editarcurso = acceso.verificar(2) %}
	{% set verparticipante = acceso.verificar(3) %}
{% for cuo in page %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="cursootorgado" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		                <th>Clave</th>
		                <th>Nombre</th>
		                <th>Empresa</th>
		                <th>Centro de trabajo</th>
		                <th>Fecha inicio</th>
		                <th>Fecha final</th>
		                <th>Partici pantes</th>
		                <th>Horas</th>
		                <th>Estatus</th>
		                <th>Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		                <td class="uppercase">{{ cuo.cuo_clave }}</td>
		                <td class="uppercase">{{ cuo.getCurso() }}</td>
		                <td class="uppercase">{{ cuo.getEmpresa() }}</td>
		                <td class="uppercase">{{ cuo.getCentrotrabajo() }}</td>
		                <td><span style="display:none;">{{ date("Y-m-d",strtotime(cuo.cuo_fechainicio)) }}</span>{{ date("d-m-Y",strtotime(cuo.cuo_fechainicio)) }}</td>
		                <td>{{ date("d-m-Y",strtotime(cuo.cuo_fechafinal)) }}</td>
		                <td>{{ cuo.getCantidadParticipantes() }}</td>
		                <td>{{ cuo.cuo_horas }}</td>
		                <td>{{ cuo.getEstatusDetail() }}</td>
		                <td>
		                	{% if editarcurso==1 %}
		                	{{ link_to("cursootorgado/formulario/"~cuo.cuo_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	{% endif %}
		                	<!-- {{ link_to("cursootorgado/formulario/"~cuo.cuo_id, '<i class="fa fa-pencil"></i>', "class": "btn","title":"Editar") }}
		                	
		                	
		                 	<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{cuo.cuo_id}}','{{cuo.cuo_clave}}')"><i class="fa fa-trash-o"></i></a> -->
		                 	{% if verparticipante==1 %}
		                 	{{ link_to("cursootorgado/participantes/"~cuo.cuo_id, '<i class="fa fa-users"></i>', "class": "btn","title":"Participantes") }}
		                 	{% endif %}
		                 	{% if verparticipante==1 %}
		                 		{{ link_to("cursootorgado/diplomainstructor/"~cuo.cuo_id, '<i class="fa fa-trophy"></i>', "class": "btn","title":"Descargar Diploma de instructor",'target':'_blank') }}
		                 	{% endif %}
		                 	<a type="button" class="" title='Actualizar representantes' onclick="fnactualizar('{{cuo.cuo_id}}','{{ cuo.cuo_clave }}')"><i class="fa fa-refresh"></i></a>
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
