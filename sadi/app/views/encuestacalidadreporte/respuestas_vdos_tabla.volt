{% switch enc_version %}
    {% case "2024_enero" %}
    {% include "/encuestacalidadreporte/complementos/vdos/2024_enero/respuestas_tabla.volt" %}

    {% break %}
    {% default %}
    <?php echo "MENSAJE " . $enc_version; ?>
{% endswitch %}


