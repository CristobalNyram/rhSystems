{% if treintaycuatro ==1 %}
    {% if  estudio_modelo_obj.ValidarSiEsAutoEstudioConEstatusValidoParaRegresar_Vista(ese_autoestudio,ese_estatus_validar) %}
    

        {% if  ese_estatus_validar == -2 %}
        {% set NombreEstatus = estudio_modelo_obj.getEstatusDetail(esc.ese_precancelar) %}
        {% endif %}
        {% if  ese_estatus_validar == 2 or esc.ese_estatus == 3 %}
        {% set NombreEstatus = 'INICIAL' %}
        {% else %}
        {% set NombreEstatus = estudio_modelo_obj.getEstatusDetail(esc.ese_estatus) %}
        {% endif %}                   
        <a data-toggle="modal" title="Regresar a estatus anterior." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#regresar_estatus-modal"
        onclick="fn_llenar_regresar_estatus_Modal('{{ese_id}}','{{NombreEstatus}}')">
            <i class="mdi mdi-arrow-left-bold  mdi-18px btn-icon"></i>								
    </a>
    {% endif %}                   


{% endif %}