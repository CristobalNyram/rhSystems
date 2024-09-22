
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
		<a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','entrevista',{imss_api: {{quince}} })">
			<i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
		</a>
	{% endif %}
	{% if cuarentayocho==1 %}
	<a data-toggle="modal" title="Cambiar estatus" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#cambiar_estatus_exc_general-modal" onclick="fnCambiarEstatusExc('{{reg.exc_id}}','{{reg.exc_estatus}}',reload_tabla_ent)">
			 <i class="mdi mdi-swap-horizontal-circle-outline mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
		</a>
	{% endif %}
	{% if cuarentayocho==1 %}
	<a data-toggle="modal" title="Entrevista" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_ent_general-modal" onclick="fnEditarEnt('{{reg.exc_id}}',reload_tabla_ent)">
			<i class="mdi mdi-wechat mdi-18px btn-icon"></i>
		</a>
	{% endif %}