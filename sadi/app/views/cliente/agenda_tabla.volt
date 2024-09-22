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
                <th>Comentario</th>
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
                <td>{{ esc.cit_comentario }}</td>
            </tr>
            {% if loop.last %}
        </tbody>
    </table>
</div>
{% endif %}
{% else %}
No existen registros en este catálogo.
{% endfor %}