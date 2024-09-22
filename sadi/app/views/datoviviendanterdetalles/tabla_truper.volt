<!-- <div style="padding-top: 25px"> -->
    {% for dva in page %}
    {% if loop.first %}

	<div class="table-responsive m-3" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		<table id="datoviviendanterdetalles_truper_table" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead class="thead-light-crm">
	
		            <tr>
						
						<th>ID</th>
		                <th>Propietario	</th>
		                <th>Dirección</th>
						<th>Motivo del cambio</th>
		                <th>Antigüedad						</th>
		                <th>Zona						</th>
		                <th>Clase social						</th>
		                <th>Vivienda						</th>
		                <th>Inmueble						</th>
						<th>Niveles						</th>
		                <th>Monto de la renta o valor de inmueble						</th>
		                <th>Recámaras						</th>
		                <th>Baños						</th>
		                <th>Sala						</th>
		                <th>Cocina						</th>
		                <th>Comedor						</th>
						<th>Estudio						</th>
		                <th>S./ juegos						</th>
		                <th>Terraza						</th>
		                <th>C/lavado						</th>
		                <th>C/Servicio						</th>
		                <th>Garage						</th>
		                <th>Jardín						</th>
		                <th>Piscina						</th>
						<th class="all">Opciones</th>
		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
						<td class="uppercase">	{{ dva.dva_id }}</td>
						<td class="uppercase">{{ dva.dva_nombrepropietario }}</td>
						<td class="uppercase">	{{ object_datoviviendaanter.getDireccionFormatoCompleto(dva)  }}</td>
						<td class="uppercase">{{ dva.dva_motivocamb }}</td>
						<td class="uppercase">{{ object_datovivienda.getAntiguedad(dva.dva_antiguedad)  }}</td>
						<td class="uppercase">{{object_datovivienda.getZona(dva.dva_zona) }} </td>
						<td class="uppercase">{{object_datovivienda.getClaseSocial(dva.dva_clasesocial) }}</td>
						<td class="uppercase">{{object_datovivienda.getVivienda(dva.dva_vivienda) }}</td>
						<td class="uppercase">{{object_datovivienda.getInmueble(dva.dva_inmueble) }}</td>
						<td class="uppercase">{{object_datovivienda.getNiveles(dva.dva_nivel) }}</td>
						<td class="uppercase">{{ dva.dva_montorentaovalor }}</td>

						<td class="uppercase">{{object_datovivienda.getNumero(dva.dva_recamara) }}</td>
						<td class="uppercase">{{ object_datovivienda.getNumero(dva.dva_banio) }}</td>
				

						<td class="uppercase">	{{ object_datovivienda.getSioNo(dva.dva_sala) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_cocina) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_comedor) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_estudio) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_salajuego) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_terraza) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_cualavado) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_cuaservicio) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_garage) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_jardin) }}</td>
						<td class="uppercase">{{ object_datovivienda.getSioNo(dva.dva_piscina) }}</td>
						<td class="all">

							<a data-toggle="modal" title="Editar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar-datoviviendaanteriordetalles-modal" onclick="fnEditarrDatoViviendaanteriorDetalles('{{dva.dva_id }}');" >
								<i class="mdi mdi-pencil mdi-18px btn-icon"></i>
							</a>
							
						
							<a title="Eliminar familiar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEliminarDatoViviendaanteriorDetalles('{{dva.dva_id }}',fnCargarDatogViviendaAnteriorDetallesFormatoTruper)">
								  <i class="mdi mdi-delete mdi-18px btn-icon"></i>
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