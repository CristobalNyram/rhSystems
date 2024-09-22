{{mensaje}}



<a id="otrabusqueda" name="otrabusqueda" href="#busqueda" onclick="fnmostrarbusqueda();" class="font-14 btn-link-crm btn-link btn text-left"><i class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
{% for ese in page %}
    {% if loop.first %}
    	
		<div class="mt-1 col-12">
			<!-- <div class="card card-crm"> -->
			    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			        <thead class="thead-light-crm">
			            <tr>
                            
                            <th>#</th>
                            <th>ID SADI</th>
                            <th>Tipo estudio</th>
                            <th>Empresa</th>

                            <th>Solicita</th>
                            <th>Facturación</th>
                            
                            <th>Nombre candidato</th>
                            <th>Apellido paterno candidato</th>
                            <th>Apellido materno candidato</th>
                            
                            <th>Fecha de alta de SADI</th>
                            <th>Fecha investigación asignada</th>
                            <th>Fecha entrega investigador</th>
                            <th>Fecha asignación analista</th>
                            <th>Fecha entrega cliente</th>


                            <th>Estado</th>
                            <th>Municipio</th>
                            <th>Folio</th>
                            <th>Tipo de verificación</th>
                            <th>Investigador</th>
                            <th>Analista</th>

                            <th>Estatus</th>
                            <th>Pago honorario</th>
                            
                            <th>Pago transporte</th>
                            
                            <th>Fecha pago investigador</th>

                            <th>Derechos verificaciones</th>
                            <th>Gasto autorizado por cliente</th>
                            <th>Costo</th>
                            <th>Núm. factura</th>

                            <th>Cancelado</th>
                            <th>Notas</th>
			            </tr>
			        </thead>
			        <tbody>
	                {% endif %}						
                    <tr {% if ese.ese_estatus==-2%}   class="polvencida" {% endif %}>
                            <td>{{loop.index}}</td>
                            <td>{{ese.ese_id}}</td>
                            <td>{{ ese.tip_clave }}</td>
                            {% if ese.emp_id is defined %}
                                <td>{{ese.emp_nombre}}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                           {% if ese.cne_id is defined %}
                                <td class="uppercase"> {{ese.cne_nombre_completo}}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            <td>{{ ese.cen_nombre }}</td>
                            <td>{{ese.ese_nombre}}</td>
                            <td>{{ese.ese_primerapellido}}</td>
                            <td>{{ese.ese_segundoapellido}}</td>
                            <td data-order='{{ date("Y-m-d",strtotime(ese.ese_registro)) }}'>{{ date("d/m/Y", strtotime(ese.ese_registro)) }}</td>
                            
                            {% if ese.ese_fechaasiginvestigador  != null %}
                            <td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaasiginvestigador)) }}'>{{ date("d/m/Y", strtotime(ese.ese_fechaasiginvestigador)) }}</td>
                            {% else %}
                            <td></td>
                            {% endif %}

                            {% if ese.ese_fechaentregainvestigador !=null%}
                                <td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaentregainvestigador)) }}'>{{ date("d/m/Y", strtotime(ese.ese_fechaentregainvestigador)) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            {% if ese.ese_fechaasiganalista !=null %}
                                <td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaasiganalista)) }}'>{{ date("d/m/Y", strtotime(ese.ese_fechaasiganalista)) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            
                            {% if ese.ese_fechaentregacliente is defined %}
                                <td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechaentregacliente)) }}'>{{ date("d/m/Y", strtotime(ese.ese_fechaentregacliente)) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            {% if ese.est_id is defined %}
                                <td>{{ese.est_nombre}}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            {% if ese.mun_id is defined %}
                                <td>{{ese.mun_nombre}}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            {% if ese.ese_folioverificacion is defined%}
                                <td>{{ese.ese_folioverificacion}}</td>
                            {% else %}
                                <td></td>
                            {% endif %}                             
                            {% if ese.ver_id is defined %}
                                <td> ({{ese.ver_alias}}) {{ese.ver_nombre}} </<td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            {% if ese.inv_id is defined %}
                                <td class="uppercase">{{ usuario.getNombre(ese.inv_id) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            
                            {% if ese.ana_id is defined %}
                                <td class="uppercase">{{ usuario.getNombre(ese.ana_id) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}

                            {% if ese.ese_estatus==7%}
                            <td  >
                                <span class="badge badge-success p-2">
                                    {{ estudiomodel.getEstatusDetail(ese.ese_estatus) }}

                                </span>

                            </td>
                            {% else %}
                            <td >
                                <span class="badge badge-danger p-2">
                                    {{ estudiomodel.getEstatusDetail(ese.ese_estatus) }}

                                </span>
                            </td>
                            {% endif %}

                            {% if ese.honorario_asignado is defined %}
                                <td>
                                    {% if ese.ese_fechaentregainvestigador is defined%}
                                         {% if ese.ese_estatus != -2 %}
                                            {% if ese.tip_id == 4 %}
                                            ${{ese.honorario_asignado * ese.ese_visita}}
                                            {% else %}
                                            ${{ese.honorario_asignado}}
                                            {% endif %}
                                        {% else %}
                                       
                                        {% endif %}


                                    {% endif %}

                                </td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            

                            {% if ese.tra_aprobado is defined %}
                                <td>
                                    {% if ese.ese_fechaentregainvestigador is defined%}
                                        {% if ese.ese_estatus != -2 %}
                                         ${{ese.tra_aprobado}}
                                        {% else %}
                                        
                                        {% endif %}
                                            
                                    {% endif %}
                                </td>
                            {% else %}
                                <td></td>
                            {% endif %}

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            {% if ese.ese_fechacancelacion is defined %}
                                <td data-order='{{ date("Y-m-d H:i:s",strtotime(ese.ese_fechacancelacion)) }}'>{{ date("d/m/Y", strtotime(ese.ese_fechacancelacion)) }}</td>
                            {% else %}
                                <td></td>
                            {% endif %}
                            <td></td>
			            </tr>
			        {% if loop.last %}
			        </tbody>
			    </table>
			<!-- </div> -->
		</div>
	{% endif %}
    
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}

