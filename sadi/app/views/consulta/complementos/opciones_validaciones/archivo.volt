{% if permiso_archivo==1 %}

        {% switch tif_id_validar %}
        {% case 9 %}

            {% set categoria_archivos = 'truper' %}

        {% break %}

        {% case 10 %}
            {% set categoria_archivos = 'truperVentas' %}

        {% break %}

        {% default %}
            {% set categoria_archivos= 'ese' %}

        {% endswitch %}




        <a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="archivo('{{ese_id}}',1,'{{categoria_archivos}}')">
            <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
        </a>
       

{% endif %}
