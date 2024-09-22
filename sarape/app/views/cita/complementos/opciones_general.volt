{% if cincuentaycinco==1 %}
		<a data-toggle="modal" title="Resumen" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('{{reg.exc_id}}')" >
				<i class="mdi mdi-file-presentation-box mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
		</a>
{% endif %}
{% if siete==1 %}
<a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentarioexc-modal" onclick="comentarioexc('{{reg.exc_id}}')">
    <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
</a>
{% endif %}


{% if diez==1 %}
<a data-toggle="modal" title="Ver archivos Cita" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','cita',{imss_api: {{quince}} })">
    <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{% endif %}




{% if veintiocho==1 %}
	<a data-toggle="modal" type="button" title="Reprogramar Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnReprogramarCita('{{ reg.cit_id }}')" data-target="#reprogramar_cit_general-modal">
        	<i class="mdi mdi-update mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if cuarentayocho==1 %}
        <a data-toggle="modal"  title="Cambiar estatus" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#cambiar_estatus_exc_general-modal" onclick="fnCambiarEstatusExc('{{reg.exc_id}}','{{reg.exc_estatus}}',fnCargarTablaCitas)">
			 <i class="mdi mdi-swap-horizontal-circle-outline mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
        </a>
{% endif %}

{% if veintiocho==1 %}
	<a data-toggle="modal" type="button" title="Editar Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEditarCita('{{ reg.cit_id }}')" data-target="#editar_cit_general-modal">
        	<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
	</a>
{% endif %}
