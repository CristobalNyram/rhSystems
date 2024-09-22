

{% if treintayuno==1 %}
	<a data-toggle="modal" type="button" title="Editar Vacante" class="" data-container="body" data-toggle="popover" role="button" onclick="fnEditarVac('{{ reg.vac_id }}',load_table_rel_vacOrder)" data-target="#editar_vac_general-modal">
		<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if veintisiete==1 %}
	<a data-toggle="modal" type="button" title="Cita" class="" data-container="body" data-toggle="popover" role="button" onclick="fnCargarTablaExcGeneral_cit('{{ reg.vac_id }}')"  data-target="#rel_vac_exc_tabla-modal">
	    <i class="mdi mdi-account-multiple mdi-18px btn-icon"></i>
	</a>
{% endif %}
{% if ochentaynueve==1 %}
	<a data-toggle="modal" title="Ver archivos de vacante" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos_vac-modal" onclick="fnCargarTablaArchivoVac('{{reg.vac_id}}','general')">
		<i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if setentaycinco==1 %}
	{{ link_to("reporte/reporte_requision_personal/"~(encriptarparametros.encriiptarId(reg.vac_id)), '<i class="mdi mdi-pdf-box  mdi-18px btn-icon" ></i>', "title":"Reporte - REQUISICIÓN DE PERSONAL ",'target':'_blank') }}
{% endif %}
{% if noventayseis==1 %}
	<a data-toggle="modal"  data-target="#compartir_vac_eje-modal" type="button" title="Compartir vacante" data-container="body" role="button" onclick="fnCompartirVacanteEje('{{ reg.vac_id }}',load_table_rel_vacOrder)"  >
	    <i class="mdi mdi-share-variant mdi-18px btn-icon"></i>
	</a>
{% endif %}

{% if ochenta==1 %}
	<a data-toggle="modal"  data-target="#cancelar_gen_vac-modal" type="button" title="Cancelar vacante" data-container="body" role="button" onclick="fnCancelarVacante('{{ reg.vac_id }}',load_table_rel_vacOrder)"  >
	    <i class="mdi mdi-delete mdi-18px btn-icon"></i>
	</a>
{% endif %}


