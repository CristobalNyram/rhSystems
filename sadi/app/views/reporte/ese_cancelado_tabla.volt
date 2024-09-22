<span class"text-center">
    {% if mensaje is defined and mensaje %}
    {{mensaje}}
    {% endif %}
</span>
<a id="otrabusqueda" name="otrabusqueda" href="#busqueda"
    onclick="fnmostrarbusqueda();"
    class="font-14 btn-link-crm btn-link btn text-left"><i
        class="mdi mdi-chevron-up mdi-24p"></i> Realizar otra búsqueda</a>
<h2 class="row col-12 text-center">
    Datos de consulta
</h2>
{% if page is defined and page %}
{% for reg in page %}
{% if loop.first %}
<div class="mt-1 col-12">
    <table id="datatable-buttons"
        class="table table-striped table-bordered dt-responsive"
        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light-crm">
            <tr>
                <th>ID ESE</th>
                <th>ID Cancelación</th>

                <th>Tipo estudio</th>
                <th>Empresa</th>
                <th>Contacto empresa</th>
                <th>Centro costo</th>
                <th>Investigador</th>
                <th>Fecha asignación investigador</th>
                <th>Fecha entrega investigador</th>
                <th>Analista</th>
                <th>Fecha asignación analista</th>
                <th>Fecha entrega analista</th>

                <th>Estado </th>
                <th>Municipio </th>

                <th>Estatus estudio</th>
                <th>Estatus cancelación</th>

                <th>Fecha cancelación</th>

                <th>Fecha cambio</th>
                <th>Motivo</th>
                <th>Comentario</th>
                <th>Usuario alta</th>
                <th>Usuario canceló</th>

                <th>Usuario cambio estatus</th>
                <th class="all">Opciones</th>

            </tr>
        </thead>
        <tbody>
            {% endif %}
            <tr>
                <td>{{reg.ese_id}}</td>
                <td>{{reg.eca_id}}</td>
                <td>{{reg.tip_nombre}}</td>

                <td class="uppercase">{{reg.emp_nombre}}</td>
                <td class="uppercase">{{reg.cne_nombre}}</td>
                <td class="uppercase">{{reg.cen_nombre}}</td>
                <td class="uppercase">{{reg.inv_nombre}} </td>
                {% if reg is defined and reg.ese_fechaasiginvestigador is
                defined %}
                <td
                    data-order='{{ date("Y-m-d", strtotime(reg.ese_fechaasiginvestigador)) }}'>{{
                    date("d/m/Y", strtotime(reg.ese_fechaasiginvestigador))
                    }}</td>
                {% else %}
                <td></td>
                {% endif %}

                {% if reg is defined and reg.ese_fechaentregainvestigador is
                defined %}
                <td
                    data-order='{{ date("Y-m-d", strtotime(reg.ese_fechaentregainvestigador)) }}'>{{
                    date("d/m/Y", strtotime(reg.ese_fechaentregainvestigador))
                    }}</td>
                {% else %}
                <td></td>
                {% endif %}

                <td class="uppercase">{{reg.ana_nombre}} </td>
                {% if reg is defined and reg.ese_fechaasiganalista is defined %}
                <td
                    data-order='{{ date("Y-m-d", strtotime(reg.ese_fechaasiganalista)) }}'>{{
                    date("d/m/Y", strtotime(reg.ese_fechaasiganalista)) }}</td>
                {% else %}
                <td></td>
                {% endif %}
                {% if reg is defined and reg.ese_fechaentregaanalista is defined
                %}
                <td
                    data-order='{{ date("Y-m-d", strtotime(reg.ese_fechaentregaanalista)) }}'>{{
                    date("d/m/Y", strtotime(reg.ese_fechaentregaanalista))
                    }}</td>
                {% else %}
                <td></td>
                {% endif %}

                <td>{{reg.est_nombre}}</td>
                <td>{{reg.mun_nombre}}</td>

                <td>
                    <span class="badge 
								{{ estudio_obj.getEstatusBanderaColor(reg.ese_estatus) }}
								 p-2">

                        {{ estudio_obj.getEstatusDetail(reg.ese_estatus)}}
                    </span>
                </td>
                <td>
                    {{estcancelacion_obj.getEstatusNombre(reg.eca_estatus)}}
                </td>
          

               


              
                {% if reg is defined and reg.eca_fecharegistro is defined %}
                <td data-order='{{ date("Y-m-d", strtotime(reg.eca_fecharegistro)) }}'>{{ date("d/m/Y", strtotime(reg.eca_fecharegistro)) }}</td>
                {% else %}
                    {% if reg is defined and reg.ese_fechacancelacion is defined %}
                    <td data-order='{{ date("Y-m-d", strtotime(reg.ese_fechacancelacion)) }}'>{{ date("d/m/Y", strtotime(reg.ese_fechacancelacion)) }}</td>
                    {% else %}
                    <td></td>
                    {% endif %}
                {% endif %}
                

                {% if reg is defined and reg.eca_fechacambio is defined %}
                <td
                    data-order='{{ date("Y-m-d", strtotime(reg.eca_fechacambio)) }}'>{{
                    date("d/m/Y", strtotime(reg.eca_fechacambio)) }}</td>
                {% else %}
                <td></td>
                {% endif %}
                <td>{{reg.eca_cac_nombre}} </td>

                <td>{{reg.eca_motivo}} </td>
                <td>{{reg.ese_usu_alta_nombre}} </td>
                <td>
                    {% if reg is defined and reg.eca_usu_regitro_nombre is defined and reg.eca_usu_regitro_nombre|trim != "" %}
                    {% set eca_nombre = reg.eca_usu_regitro_nombre|trim %}
                        {% if eca_nombre is not empty %}
                            {{ eca_nombre }}
                       
                        {% endif %}
                    {% else %}
                        {% if reg is defined and reg.ese_usu_cancela_nombre is defined %}
                            {% set ese_nombre = reg.ese_usu_cancela_nombre|trim %}
                            {% if ese_nombre is not empty %}
                                {{ ese_nombre }}
                            {% endif %}
                        {% endif %}
                    {% endif %}
                </td>

                <td>{{reg.eca_usu_cambio_nombre}}</td>
                <td width="7%">

                    <a data-toggle="modal" title="Ver archivos" type="button"
                        class data-container="body" data-toggle="popover"
                        role="button" data-target="#archivos_cancelacion-modal"
                        onclick="fnTablaArchivosCancelacionEseEca('{{reg.ese_id}}','{{reg.eca_id}}')">
                        <i class="mdi mdi-folder mdi-18px btn-icon"></i>
                    </a>
                </td>

            </tr>
            {% if loop.last %}
        </tbody>
    </table>
</div>
{% endif %}
{% else %}
<br>
No existen registros en este catálogo.
{% endfor %}
{% endif %}
