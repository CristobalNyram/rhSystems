{% if diez==1 %}
	<script>
			config_arc_exp = {};
			{% if quince==1%}
			config_arc_exp.imss_api=1;
			{% else %}
			config_arc_exp.imss_api=0;
			{% endif %}
	</script>
	
<a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaArchivo('{{reg.exc_id}}','general',config_arc_exp)">
    <i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{% endif %}

{% if siete==1 %}
	<a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentarioexc-modal" onclick="comentarioexc('{{reg.exc_id}}')">
		<i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if cincuentaycinco==1 %}
	<a data-toggle="modal" title="Resumen" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#resumen_exc-modal" onclick="fnGetResumeExcIncio('{{reg.exc_id}}',fnCargarTablaExcGeneral_cit)" >
            <i class="mdi mdi-file-presentation-box mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
	</a>
{% endif %}

{% if reg.exc_estatus==1 %}
	{% if veintiocho==1 %}
		<a data-toggle="modal" type="button" title="Editar Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEditarCita('{{ reg.cit_id }}')" data-target="#editar_cit_general-modal">
				<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
		</a>
	{% endif %}
{% endif %}

{% if reg.exc_estatus==6 %}
	{% if cincuentaysiete==1 %}
		<a data-toggle="modal" type="button" title="Mandar a garantía" class="" data-container="body" data-toggle="popover" role="button" onclick="fnMandarAGarantiaExc('{{ reg.exc_id }}','{{ reg.vac_id }}',fnCargarTablaExcGeneral_cit,load_table_rel_vacOrder)"  data-target="#mandar_garantia_exc_general-modal">
			<i class="mdi mdi-keyboard-backspace mdi-18px btn-icon"></i>
		</a>
	{% endif %}
	{% if noventaydos==1 %}
		<a data-toggle="modal" type="button" title="Regresar facturación "class=" data-container="body" data-toggle="popover" role="button" onclick="fnRegresarFacturacionExc('{{ reg.exc_id }}','{{ reg.vac_id }}',fnCargarTablaExcGeneral_cit,load_table_rel_vacOrder)"  data-target="#regresar_facturacion_exc_general-modal">
			<i class="mdi mdi-backburger mdi-18px btn-icon"></i>
		</a>
	{% endif %}

{% endif %}

<!-- cambiar de estatus inicio -->

{% if cuarentayocho==1 %}

	{% if reg.exc_estatus in estatusValidosExc_para_cambiar_estatus_exc %}
		{% if reg.vac_estatus in estatusValidosVac_para_cambiar_estatus_exc %}
			<script>
			config_rel_vac_cambiar_estatus = {
				callbackConVacId: true
				};
			</script>
			<a data-toggle="modal" title="Cambiar estatus" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#cambiar_estatus_exc_general-modal" onclick="fnCambiarEstatusExc('{{reg.exc_id}}','{{reg.exc_estatus}}',fnCargarTablaExcGeneral_cit,config_rel_vac_cambiar_estatus,load_table_rel_vacOrder)">
				<i class="mdi mdi-swap-horizontal-circle-outline mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
			</a>
		{% endif %}

	{% endif %}
	

{% endif %}
<!-- cambiar de estatus fin -->


{# reactivar exp #}
{% if ochentaytres==1 %}
        {% if reg.exc_estatus in estatusValidosExc_para_reactivar_exc %}
                {% if reg.vac_estatus in estatusValidosVac_para_reactivar_exc %}
                    <a data-toggle="modal" title="Reactivar expediente" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#reactivar_exc_gen-modal" onclick="fnGetInfoExpReactivar('{{reg.exc_id}}',load_table_rel_vacOrder,fnCargarTablaExcGeneral_cit)" >
                            <i class="mdi mdi-arrow-left-bold mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
                    </a>
				
                {% endif %}
        {% endif %}
		
{% endif %}
{# reactivar exp #}


{# cambiar ejecutivo propietario #}
{% if noventaycinco==1 %}
<a data-toggle="modal" title="Cambiar ejecutivo" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#editar_eje_propietario-modal" onclick="fnEditarEjeIdPerteneciente('{{reg.exc_id}}',fnCargarTablaExcGeneral_cit)">
		<i class="mdi mdi-account-switch mdi-18px btn-icon" style="transform: rotate(-11deg);"></i>
</a>
{% endif %}

{# cambiar ejecutivo propietario #}
