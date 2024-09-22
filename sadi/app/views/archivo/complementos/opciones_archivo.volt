{{ link_to("archivo/descargar/"~arc.arc_id, '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}
		                	
<a data-toggle="modal" title="Leer archivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo-modal" onclick="leerarchivo('{{arc.arc_id}}','{{arc.arc_nombre}}','archivos')">
    <i class="mdi mdi-eye mdi-18px btn-icon"></i>
</a>

{% if ocultaredicionarchivo is defined %}
{% else %}
    <a title="Eliminar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneliminarevidencia('{{arc.arc_id}}','{{ arc.ese_id }}')">
        <i class="mdi mdi-delete mdi-18px btn-icon"></i>
    </a>
{% endif %}