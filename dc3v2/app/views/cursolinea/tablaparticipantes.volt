<div style="padding-top: 25px">
	{% set dc3 = acceso.verificar(6) %}
	{% set diploma = acceso.verificar(7) %}
	{% set editarparticipante = acceso.verificar(4) %}
	{% set eliminarparticipante = acceso.verificar(5) %}
	{% for par in page %}
	{% if loop.first %}
	<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="participantes" class="display table table-striped table-bordered" cellspacing="0"  align="center">
			<thead>
				<tr>
					<th></th>
					<th>Folio</th>
					<th>Nombre</th>
					<th>Empresa</th>
					<th>Centro de trabajo</th>
					<th>Folio DC3</th>
					<th>Fec. DC3</th>
					<th>Folio Dip.</th>
					<th>Fec. Dip.</th>
					<th>Fec. examen</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				{% endif %}
				<tr>
					<td></td>
					<td>{{ par.par_id }}</td>
					<td class="uppercase">
						{% set nombre=par.getNombreparti() %}
						{{ nombre }}
					</td>
					<td class="uppercase">
						{% set emp = par.getEmpresa() %}
	                	{% if emp=='' %}
		                	<a onclick="fnasigemp('{{par.par_id}}');" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#asigEmp-modal"><i class="btn btn-btnempresa">+</i></a>
						{% else %}
							{{ emp }}
						{% endif %}
					</td>
					
					<td class="uppercase">
						{% set centro = par.getCentrotrabajo() %}
						{% if centro=='' %}
		                	<a onclick="fnasigcentro('{{par.par_id}}','{{ par.emp_id }}');" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#asigCen-modal"><i class="btn btn-btnempresa">+</i></a>
						{% else %}
							{{ centro }}
						{% endif %}
					</td>
					<td>{{ par.par_foliodc3 }}</td>
					<td>
						{% if par.par_fechadc3!=null %}
							{{ date("d-m-Y",strtotime(par.par_fechadc3)) }}
						{% else %}
							{{ par.par_fechadc3 }}
						{% endif %}
					</td>
					<td>{{ par.par_foliodip }}</td>
					<td>
						{% if par.par_fechadip!=null %}
							{{ date("d-m-Y",strtotime(par.par_fechadip)) }}
						{% else %}
							{{ par.par_fechadip }}
						{% endif %}
					</td>
					<td>
						{% if par.par_fechaexamen!=null %}
							{{ date("d-m-Y",strtotime(par.par_fechaexamen)) }}
						{% else %}
							<a onclick="fnasigfechaexamen('{{par.par_id}}');" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#asigfechaexamen-modal"><i class="btn btn-btnempresa">+</i></a>
						{% endif %}
					</td>
					<td width="7%">
						{% if admindirector!=null %}
							{% if par.par_fechaexamen!=null %}
								{% if dc3==1 and centro!=""%}
									{{ link_to("cursolinea/reportedc3/"~par.par_id, '<i class="fa fa-file"></i>', "class": "btn","title":"Descargar DC3",'target':'_blank') }}
								{% endif %}
								{% if diploma==1 %}
									{{ link_to("cursolinea/reportediploma/"~par.par_id, '<i class="fa fa-trophy"></i>', "class": "btn","title":"Descargar Diploma",'target':'_blank') }}
									
								{% endif %}
							{% endif %}
						{% endif %}
						{% if editarparticipante==1 %}
							<a data-toggle="modal" title="Editar" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#editarparticipante-modal" onclick="fnedit('{{par.tra_id}}','{{ par.getNombreparti() }}','{{ par.par_id }}')">
							<i class="fa fa-pencil"></i>
							</a>
						{% endif %}
						{% if eliminarparticipante==1 %}
						<a type="button" class="btn" title='Eliminar' onclick="fnelim('{{par.par_id}}','{{ par.getNombreparti()}}')"><i class="fa fa-trash-o"></i></a>
						{% endif %}
						<a data-toggle="modal" title="Ver historial" type="button" class="btn" data-container="body" data-toggle="popover" role="button" data-target="#historialdescarga-modal" onclick="historialdescarga('{{par.par_id}}','{{ nombre }}')">
		                      	<i class="fa fa-book"></i>
		                </a>
					</td> 
				</tr>
				{% if loop.last %}
			</tbody>
			{% if admindirector!=null %}
				{% if dc3==1 %}
				<a onclick="GetSelected();"  type="button" role="button"><i class="btn btn-btnempresa">Descargar DC3 de seleccionados</i></a>
				{% endif %}
				{% if diploma==1 %}
				<a onclick="GetSelectedDiploma();"  type="button" role="button"><i class="btn btn-btnempresa">Descargar Diplomas de seleccionados</i></a>
				{% endif %}
			{% endif %}
			{% if eliminarparticipante==1 %}
			<a onclick="GetSelectedEliminar();"  type="button" role="button"><i class="btn btn-btnempresa">Eliminar participantes seleccionados</i></a>
			{% endif %}
			<!-- <input type="button" class="btn" value="Get Selected" target="_blank" onclick="GetSelected()" /> -->
		</table>
	</div>
	{% endif %}
	{% else %}
	No existen registros en este catálogo.
	{% endfor %}
</div>
