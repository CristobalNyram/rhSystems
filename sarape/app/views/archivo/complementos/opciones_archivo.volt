{{ link_to("archivo/descargar/"~arc.arc_id, '<i class="mdi mdi-download mdi-18px btn-icon"></i>', "class": "","title":"Descargar", 'target':'_blank') }}
		                	
<a data-toggle="modal" title="Leer archivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#leerarchivo-modal" onclick="leerarchivo('{{arc.arc_id}}','{{arc.arc_nombre}}','archivosexc','{{arc.exc_id}}')">
    <i class="mdi mdi-eye mdi-18px btn-icon"></i>
</a>

{% if mostrar_borrar==1 %}
<a title="Eliminar" type="button" class="btn-eliminar-archivos-exc" data-container="body" data-toggle="popover" role="button" onclick="fneliminararchivo('{{arc.arc_id}}','{{ arc.exc_id }}')">
    <i class="mdi mdi-delete mdi-18px btn-icon"></i>
</a>
{% endif %}
