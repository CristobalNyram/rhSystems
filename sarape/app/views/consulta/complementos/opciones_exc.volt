
{% if cincuentaycinco==1 %}

		<a data-toggle="modal" title="Resumen" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('{{reg.exc_id}}')" >
				<i class="mdi mdi-file-presentation-box mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
		</a>
{% endif %}

{% if siete==1 %}
<script>
    var config_tabla_com = {
        mostrarCrear: 0,
    };
</script>
<a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentarioexc-modal" onclick="comentarioexc('{{reg.exc_id}}',config_tabla_com)">
    <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
</a>
{% endif %}


{% if diez==1 %}
<script>
    var config_tabla_arc= {
        mostrarCrear: 0,
        mostrarBorrar: 0,

    };
</script>
<a data-toggle="modal" title="Ver archivos " type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','general',config_tabla_arc)">
    <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{% endif %}





{# seccion laboral inicio  #}
{% if cincuentaytres==1 %}
 {% if reg.sel_id is defined %}
    {{ link_to("reporte/reporte_referencias_candidato/"~(encriptarparametros.encriiptarId(reg.exc_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" ></i>', "title":"Reporte - REFERENCIAS DEL CANDIDATO",'target':'_blank') }}
 {% endif %}    
{% endif %}
{# seccion laboral fin  #}



{# autorizacion inicio  #}
	{% if cincuentaydos==1 %}
		{{ link_to("reporte/reporte_evaluacion_candidato/"~(encriptarparametros.encriiptarId(reg.exc_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" ></i>', "title":"Reporte - EVALUACIÓN DEL CANDIDATO",'target':'_blank') }}
	{% endif %}
{# psicometria fin  #}




{# reactivar exp #}
{% if ochentaytres==1 %}
        {% if reg.exc_estatus in estatusValidos %}
                {% if reg.vac_estatus in estatusValidosVac %}
                    <a data-toggle="modal" title="Reactivar expediente" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#reactivar_exc_gen-modal" onclick="fnGetInfoExpReactivar('{{reg.exc_id}}',principal)" >
                            <i class="mdi mdi-arrow-left-bold mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
                    </a>
                {% endif %}
        {% endif %}
		
{% endif %}
{# reactivar exp #}


{% if reg.exc_estatus==6 %}
	
	{% if noventaydos==1 %}
		<a data-toggle="modal" type="button" title="Regresar facturación "class=" data-container="body" data-toggle="popover" role="button" onclick="fnRegresarFacturacionExc('{{ reg.exc_id }}','{{ reg.vac_id }}',principal,0)"  data-target="#regresar_facturacion_exc_general-modal">
			<i class="mdi mdi-backburger mdi-18px btn-icon"></i>
		</a>
	{% endif %}

{% endif %}

{# cambiar ejecutivo propietario #}
{% if noventaycinco==1 %}
    <a data-toggle="modal" title="Cambiar ejecutivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_eje_propietario-modal" onclick="fnEditarEjeIdPerteneciente('{{reg.exc_id}}',principal)">
            <i class="mdi mdi-account-switch mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
    </a>
{% endif %}
{# cambiar ejecutivo propietario #}


{% if reg.exc_estatus in estatusNoContinuoProceso_entrevista %}
<a data-toggle="modal" type="button" title="Enviar mensaje de agradecimiento" class=" data-container="body" onclick="fnPreguntarEnviarAgradecimiento('{{ reg.can_id }}','{{ reg.vac_id }}')" data-toggle="popover" role="button"   >
    <i class="mdi mdi-email mdi-18px btn-icon"></i>
</a>
{% endif %}


{% if reg.exc_estatus in estatusFacturadosExpedienteCorreoFacturacion %}
<a data-toggle="modal" type="button" title="Enviar correo de facturación " class=" data-container="body" onclick="enviarCorreoFacturacion_General_PREGUNTA('{{ reg.can_id }}','{{ reg.exc_id }}','{{ reg.vac_id }}')" data-toggle="popover" role="button"   >
    <i class="mdi mdi-email mdi-18px btn-icon"></i>
</a>
{% endif %}



