{% switch enc_version %}
    {% case "2024_enero" %}
    {% include "/encuestacalidadreporte/complementos/vdos/2024_enero/encuestas_tabla.volt" %}
    {% break %}
    {% default %}
{% endswitch %}


