{% if diez==1 %}
<a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','general')">
    <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{% endif %}

{% if siete==1 %}
<a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentarioexc-modal" onclick="comentarioexc('{{reg.exc_id}}')">
    <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
</a>
{% endif %}



{% if veintiocho==1 %}
	<a data-toggle="modal" type="button" title="Editar Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEditarCita('{{ reg.cit_id }}')" data-target="#editar_cit_general-modal">
        	<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
	</a>
{% endif %}