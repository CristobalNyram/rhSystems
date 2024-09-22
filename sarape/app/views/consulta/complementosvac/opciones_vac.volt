{% if treintayuno==1 %}
	<a data-toggle="modal" type="button" title="Información de vacante" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEditarVac('{{ reg.vac_id }}')" data-target="#editar_vac_general-modal">
		<i class="mdi mdi-information mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if veintisiete==1 %}
	<script>
		var config_tabla_exc_gen = {
			mostrarCrearCita: 0,
		};
	</script>
	<a data-toggle="modal" type="button" title="Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnCargarTablaExcGeneral_cit('{{ reg.vac_id }}',config_tabla_exc_gen)"  data-target="#rel_vac_exc_tabla-modal">
	    <i class="mdi mdi-calendar mdi-18px btn-icon"></i>
	</a>
{% endif %}


{% if setentaycinco==1 %}
	{{ link_to("reporte/reporte_requision_personal/"~(encriptarparametros.encriiptarId(reg.vac_id)), '<i class="mdi mdi-pdf-box  mdi-18px btn-icon" ></i>', "title":"Reporte - REQUISICIÓN DE PERSONAL ",'target':'_blank') }}
{% endif %}


<!-- MADNAR GAR VAC INICIO-->
{% if reg.vac_estatus in estatus_validados_para_mandar_gar %}
	{% if noventaytres==1 %}
		<a data-toggle="modal" type="button" title="Regresar vacante" class="" data-container="body" data-toggle="popover" role="button" onclick="fnRegresarVacanteGeneral('{{ reg.vac_id }}',principal)"  data-target="#regresar_vac_general-modal">
			<i class="mdi mdi-keyboard-backspace mdi-18px btn-icon"></i>
		</a>
	{% endif %}
{% endif %}
<!-- MANDAR GAR VAC FIN -->