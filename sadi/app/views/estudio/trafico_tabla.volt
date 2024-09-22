{% include "/estudio/complementos/permisos/permisos_trafico.volt" %}


{% if treintayseis==1 %}
    <div class="mx-auto" style="width: 550px;" id="accordion">
      <div class="card"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="convertirtablainvesdetalles()">
        <div class="card-header" id="headingOne">
          <!-- <h3 class="mb-0"> -->
            Total de estudios en Tráfico {{totalestudios}}
            <br>
            Total ESES {{socioeconomico}} - Total VER {{verificacion}} - Total SUP: {{supervivencia}}
          <!-- </h3> -->
        </div></button>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
            {% for inv in investigadores %}
                {% if loop.first %}
                    <table id="invesdetalles" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="thead-light-crm">
                            <tr>
                                <th style="text-align: center;">Analista</th>
                                <th style="text-align: center;">Asignaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                {% endif %}
                            <tr>
                                <td style="text-align: center;">{{ link_To(['estudio/resumeninvestigadortabla/'~inv.inv_id, ""~inv.investigador ,'target': '_blank']) }}

                                    </td>
                                <td style="text-align: center;">{{inv.cantidad}}</td>
                                
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
                <th>Fecha asig. investigador</th>
                <th>Investigador</th>
                <th>Folio</th>
                <th>Empresa</th>
                <th>Centro costo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Tipo documento</th>
                <th class="all">Opciones</th>

            </tr>
        </thead>
        <tbody>
            {% endif %}
            <tr 
                {% if esc.tip_id==1 or esc.tip_id==3 or esc.tip_id==5 %}
                    {% if tresdias >= date("Y-m-d",strtotime(esc.ese_registro)) %} 
                        
                        {% if seisdias >= date("Y-m-d",strtotime(esc.ese_registro)) %} 
                            class="polvencida6" 
                        {% else %}
                            class="polvencida" 
                        {% endif %}
                    {% endif %}
                {% endif %}
            
            >
                <td>{{ esc.ese_folioverificacion}}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_registro)) }}'>{{ date("d-m-Y", strtotime(esc.ese_registro)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaasiginvestigador)) }}'>{{ date("d-m-Y", strtotime( esc.ese_fechaasiginvestigador )) }}</td>
                <td>{{ esc.investigador }}  </td>
                <td title="{{ esc.ese_folioverificacion}}">{{esc.ese_id}}</td>
                <td>{{ esc.empresa_nombre }}</td>
                <td>{{ esc.cen_nombre }}</td>
                <td>{{ esc.ese_nombre }} {{esc.ese_primerapellido}}  {{esc.ese_segundoapellido}}</td>
                <td>{{ esc.est_nombre }}</td>
                <td>
                    {% if  esc.mun_nombre=='' or esc.mun_nombre== null %}
                        SIN MUNICIPIO      {{ esc.mun_id  }} 
                    {% else %}
                         {{ esc.mun_nombre }}</td>
                    {% endif %}
                <td>{{ esc.tip_clave }}</td>
                <td width="7%">                   
                    {% include "/estudio/complementos/opcionestrafico.volt" %}

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