{% include "/estudio/complementos/permisos/permisos_trafico_analista.volt" %}

{% if treintaycinco==1 %}
    <div class="mx-auto" style="width: 550px;" id="accordion">
      <div class="card"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="convertirtablaanalistadetalles()">
        <div class="card-header" id="headingOne">
          <!-- <h3 class="mb-0"> -->
            Total de estudios en revisión {{totalestudios}}
            <br>
            Total ESES {{socioeconomico}} - Total VER {{verificacion}} - Total SUP: {{supervivencia}}
          <!-- </h3> -->
        </div></button>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            {% for ana in analistas %}
                {% if loop.first %}
                    <table id="analistadetalles" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light-crm">
                            <tr>
                                <th style="text-align: center;">Analista</th>
                                <th style="text-align: center;">Asignaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                {% endif %}
                       <tr 
                        >
                                <td style="text-align: center;">{{ link_To(['estudio/resumenanalistatabla/'~ana.ana_id, ""~ana.analista ,'target': '_blank']) }}

                                    </td>
                                <td style="text-align: center;">{{ana.cantidad}}</td>
                                
                            </tr>
                {% if loop.last %}
                        </tbody>
                    </table>
                {% endif %}
                {% else %}
                    <strong>No existen analistas asignados.</strong>
            {% endfor %}
          </div>
        </div>
      </div>
    </div>
{% endif %}
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
                <th class="all">Opciones</th>


            </tr>
        </thead>
        <tbody>
            {% endif %}

            <tr 
            {% if  esc.ese_estatus is 2 or esc.ese_estatus is 3 %} 
                class="texto-color-verde"
            {% else %}
                {% if esc.tip_id==1 or esc.tip_id==3 or esc.tip_id==5 %}
                    {% if cuatrodias >= date("Y-m-d",strtotime(esc.ese_registro)) %} 
                        
                        {% if cincodias >= date("Y-m-d",strtotime(esc.ese_registro)) %} 
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
                <td width="7%">
                    {% include "/estudio/complementos/opcionestraficoanalista.volt" %}
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