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
<a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','referencias',{imss_api: {{quince}} })">
	<i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{% endif %}
{% if treintaydos==1 %}
	<a data-toggle="modal" type="button" title="Referencias Laboral" class="" data-container="body" data-toggle="popover" role="button" onclick="fnCargarSeccionLaboralGeneral('{{ reg.exc_id }}',load_table_referencias,1)" data-target="#seccion_laboral_general-modal">
	    <i class="mdi mdi-account-network mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if cuarentayocho==1 %}
<a data-toggle="modal" title="Cambiar estatus" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#cambiar_estatus_exc_general-modal" onclick="fnCambiarEstatusExc('{{reg.exc_id}}','{{reg.exc_estatus}}',load_table_referencias)">
	<i class="mdi mdi-swap-horizontal-circle-outline mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
</a>
{% endif %}

{% if cincuentaytres==1 %}
	{{ link_to("reporte/reporte_referencias_candidato/"~(encriptarparametros.encriiptarId(reg.exc_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" ></i>', "title":"Reporte - REFERENCIAS DEL CANDIDATO",'target':'_blank') }}
{% endif %}

