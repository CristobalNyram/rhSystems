{% if veinte ==1 %}
    {% switch tif_id_validar %}
        {% case 9 %}
            {% set categoria_archivos = 'truper' %}
            {% break %}
        {% case 10 %}
            {% set categoria_archivos = 'truperVentas' %}
            {% break %}
        {% case 11 %}
            {% set categoria_archivos = 'truper' %}
            {% break %}
        {% case 6 %}
            {% set categoria_archivos = 'gabinete' %}
        {% break %}
        {% default %}
            {% set categoria_archivos= 'ese' %}
    {% endswitch %}

    {% set imss = 0 %}
    {% if cincuentayocho==1 %}
        {% switch tif_id_validar %}
            {% case 1 %}
                {% set imss = 1 %}
                {% break %}
            {% case 5 %}
                {% set imss = 1 %}
                {% break %}
            {% case 6 %}
                {% set imss = 1 %}
                {% break %}
            {% case 7 %}
                {% set imss = 1 %}
                {% break %}
            {% case 8 %}
                {% set imss = 1 %}
                {% break %}
            {% case 9 %}
                {% set imss = 1 %}
                {% break %}
            {% case 10 %}
                {% set imss = 1 %}
                {% break %}
            {% case 11 %}
                {% set imss = 1 %}
                {% break %}
            {% default %}
                {% set imss = 0 %}
        {% endswitch %}
    {% endif %}

    {% set curp = 0 %}
    {% if sesentaycinco==1 %}
        {% switch tif_id_validar %}
            {% case 10 %}
                {% set curp = 1 %}
                {% break %}
            {% default %}
                {% set curp = 0 %}
        {% endswitch %}
    {% endif %}

    {% set poderjudicial = 0 %}
    {% if sesentaynueve==1 %}
        {% if cen_id_validar=="VISOR" %}
            {% set poderjudicial = 1 %}
        {% elseif alias_validar == "CITELIS" %}
            {% set poderjudicial = 1 %}
        {% endif %}
    {% endif %}

    <a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="archivo('{{ese_id}}',0,'{{categoria_archivos}}','{{imss}}','{{curp}}','{{poderjudicial}}')">
        <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
    </a>

{% endif %}
