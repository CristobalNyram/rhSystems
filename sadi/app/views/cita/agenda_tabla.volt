{% for esc in estudio %}
{% if loop.first %}

<div class="mt-1 col-12">
    <table id="td_empresa" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light-crm">
            <tr>
                <th>Fecha de cita</th>
                <th>Investigador</th>
                <th>Folio</th>
                <th>Empresa</th>
                <th>Centro costo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Estatus</th>
                <th>Tipo documento</th>
                <th class="all">Opciones</th>
            </tr>
        </thead>
        <tbody>
            {% endif %}
            <tr>
                <td data-order='{{ date("Y-m-d H:i:s", strtotime(esc.cit_fecha ~ esc.cit_hora)) }}'>{{  date("d-m-Y", strtotime(esc.cit_fecha)) }} {{ esc.cit_hora }}</td>
                <td>{{ esc.investigador }}  </td>
                <td>{{esc.ese_id}}</td>
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
                <td>
                    {% set estatus = 0 %}
                    {% if hoy > date("Y-m-d",strtotime(esc.cit_fecha)) %}
                        {% set estatus=4 %}
                    {% else %}
                        {% set estatus = esc.cit_estatus %}
                    {% endif %}
                    <span class="badge  {{ obj_cita.getEstatusBandera(estatus) }} p-2">
                        {{ obj_cita.getEstatusTexto(estatus) }}
                        
                    </span>
                </td>
                <td>{{ esc.tip_clave }}</td>
                <td>
                    {% if esc.cit_estatus==1 %}
                        <a data-toggle="modal" title="Reagendar cita" class="" data-container="body" data-toggle="popover" role="button" data-target="#re-agendar-cita-modal" onclick="fnReAgendarCitaDetalle('{{ esc.cit_id }}')">
                            <i class="mdi mdi-calendar-plus  mdi-18px btn-icon"></i>								
                        </a>
                        <a data-toggle="modal" title="Agregar comentario" class="" data-container="body" data-toggle="popover" role="button" data-target="#agregar-comentario-cita-modal" onclick="fnAgregarComentariosCita('{{ esc.cit_id }}','{{ esc.ese_id }}')">
                            <i class="mdi mdi-comment-processing  mdi-18px btn-icon"></i>								
                        </a>
                    {% endif %}
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