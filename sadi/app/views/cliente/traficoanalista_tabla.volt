{% for esc in estudio %}
{% if loop.first %}

<div class="mt-1 col-12">
    <table id="td_empresa" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light-crm">
            <tr>
                <th>Fol. verificación</th>
                <th>Fecha alta</th>
                <th>Fecha asig. invest.</th>
                <th>Fecha entrega invest.</th>
                <th>Fecha asig. analista</th>
                <th>Folio</th>
                <th>Empresa</th>
                <th>Centro costo</th>
                <th>Nombre</th>
                <th>Tipo estudio</th>
                <th>Estatus</th>
                <th>Investigador</th>
                <th>Analista</th>
            </tr>
        </thead>
        <tbody>
            {% endif %}

            <tr 
            {% if  esc.ese_estatus is 2 or esc.ese_estatus is 3 %} 
                class="texto-color-verde"
            {% else %}
                {% if esc.tip_id==1 or esc.tip_id==3 or esc.tip_id==5 %}
                    {% if undia >= date("Y-m-d",strtotime(esc.ese_fechaasiganalista)) %} 
                        
                        {% if dosdias >= date("Y-m-d",strtotime(esc.ese_fechaasiganalista)) %} 
                            class="polvencida6" 
                        {% else %}
                            class="polvencida" 
                        {% endif %}
                    {% endif %}
                {% endif %}
            {% endif %}
            >
                <td>{{ esc.ese_folioverificacion}}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_registro)) }}'>{{ date("d-m-Y", strtotime(esc.ese_registro)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaasiginvestigador)) }}'>{{ date("d-m-Y", strtotime(esc.ese_fechaasiginvestigador)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaentregainvestigador)) }}'>
                    {% if  esc.ese_fechaentregainvestigador is defined %}
                        {{ date("d-m-Y H:i:s", strtotime(esc.ese_fechaentregainvestigador)) }}
                    {% else  %}
                        SIN ENTREGAR
                    {% endif %}
                </td>
                <td class="uppercase" data-order='{{ date("Y-m-d",strtotime(esc.ese_fechaasiganalista)) }}'>{{ date("d-m-Y", strtotime(esc.ese_fechaasiganalista)) }}</td>
                <td title="{{ esc.ese_folioverificacion}}">{{esc.ese_id}}</td>
                <td>
                    {% if  esc.empresa_nombre=='' %}
                    SIN EMPRESA      
                    {% endif %}
                    {{ esc.empresa_nombre}}
                </td>
                <td>{{ esc.cen_nombre }}</td>
                <td>{{ esc.ese_nombre }} {{esc.ese_primerapellido}}  {{esc.ese_segundoapellido}}</td>
                <td>{{ esc.tip_clave }}</td>
                <td>{{ estudiomodel.getEstatusDetail(esc.ese_estatus) }}</td>
                <td>
                    {{esc.investigador_nombre}}  {{esc.investigador_apellidoP}}   {{esc.investigador_apellidoM}} 
                </td>
                <td>
                    {{esc.analista_nombre}}  {{esc.analista_apellidoP}}   {{esc.analista_apellidoM}} 
                </td>
            </tr>
            {% if loop.last %}
        </tbody>
    </table>
</div>
{% endif %}
{% else %}
<strong>No existen registros en este catálogo.</strong>
{% endfor %}