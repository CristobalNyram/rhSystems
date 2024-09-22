




<!-- variables para pasar como paramentros en las validaciones inico-->
{% set tif_id_validar = tp_asig.tif_id %}
{% set ese_id_archivo = tp_asig.ese_id %}
{% set permiso_archivo = veinte %}
    <!-- variables para pasar como paramentros en las validaciones fin-->

{% include "/estudio/complementos/opciones_validaciones/archivo.volt" %}
<!-- archivos fin -->


{% if tp_asig.tra_solicitado=='' %}
    <a data-toggle="modal" title="Solictar monto de transporte" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#modal-tra_solicitar" onclick="fn_solicitar_transporte_llenar_modal('{{tp_asig.tra_id}}','{{tp_asig.tra_preaprobado }}')">
        <i class="mdi mdi-hand mdi-18px btn-icon pink"></i>
    </a>
{% endif %}
{% if tp_asig.tra_solicitado==!'' %}
    <a data-toggle="modal" title="Editar monto solicitado" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#modal-tra_solicitar-editar" onclick="fn_solicitar_editar('{{tp_asig.tra_id}}','{{tp_asig.tra_preaprobado}}','{{tp_asig.tra_solicitado}}','{{tp_asig.tra_origen}}','{{tp_asig.tra_destino}}','{{tp_asig.tra_comentario}}')">
        <i class=" mdi mdi-pen-plus mdi-18px btn-icon"></i>
    </a>
{% endif %}
{% if tp_asig.tra_solicitado==!'' %}
    <a data-toggle="modal" title="Enviar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="" onclick="fn_solicitar_transporte('{{tp_asig.tra_id}}','{{tp_asig.tra_solicitado}}')" >
        <i class="mdi mdi-send mdi-18px btn-icon"></i>
    </a>
{% endif %}