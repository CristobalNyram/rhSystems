{{mensaje}}
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for exc in page %}
    {% if loop.first %}
		<div class="mt-1 col-12">
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">
                    <tr> 
                        <th>#</th>
                        <th># Exp.</th>
                        <th># Vacante</th>
                        <th>Estatus</th>
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Ejecutivo</th>
                        <th>Sueldo</th>
                        <th>Factor</th>
                        <th>A facturar</th>
                        <th>Factura</th>
                        <th>Fec. alta</th>
                        <th>Fec. ingreso</th>
                        <th>Fec. facturación</th>
                        <th>Fec. garantía</th>
                        <th>Candidato</th>
                    </tr>
                </thead>
                <tbody>
                {% endif %}						
                    <tr>
                        <td>{{loop.index}}</td>
                        <td>{{exc.exc_id}}</td>
                        <td>{{exc.vac_id}}</td>
                        <td>
                            <span class="badge {{ expedientecan.getEstatusBanderaColor(exc.exc_estatus) }} p-2">
								{{expedientecan.getEstatusTexto(exc.exc_estatus)}}
							</span>
                        </td>
                        <td>{{exc.emp_nombre}}</td>
                        <td>{{exc.cav_nombre}}</td>
                        <td>{{exc.exc_eje_nombre}}</td>
                        <td>{{exc.fat_sueldo}}</td>
                        <td>{{exc.fat_factor}}%</td>
                        <td>{{exc.fat_montofacturar}}</td>
                        <td>{{ facturacion.getEstatusTexto(exc.fat_reqfactura) }}</td>
                        <td data-order='{{ date("Y-m-d H:i:s",strtotime(exc.vac_fecharegistro)) }}'>{{ date("d/m/Y",strtotime(exc.vac_fecharegistro)) }}</td>
                        <td data-order='{{ date("Y-m-d H:i:s",strtotime(exc.fat_fechaingreso)) }}'>
                            {% if  exc.fat_fechaingreso is defined %}
                                {{ date("d/m/Y",strtotime(exc.fat_fechaingreso)) }}
                            {% endif %}
                        </td>
                        <td data-order='{{ date("Y-m-d H:i:s",strtotime(exc.exc_fechafacturacion)) }}'>
                            {% if  exc.exc_fechafacturacion is defined %}
                                {{ date("d/m/Y",strtotime(exc.exc_fechafacturacion)) }}
                            {% endif %}
                        </td>
                        <td data-order='{{ date("Y-m-d H:i:s",strtotime(exc.exc_fechagarantia)) }}'>
                            {% if  exc.exc_fechagarantia is defined %}
                                {{ date("d/m/Y",strtotime(exc.exc_fechagarantia)) }}
                            {% endif %}
                        </td>
                        <td>{{exc.candidato}}</td>

                        
                    </tr>
                {% if loop.last %}
                </tbody>
            </table>
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}

