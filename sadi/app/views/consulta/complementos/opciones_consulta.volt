
{% set usuario_valido_transporte = (ese.aprobadousu_id=='') ? usuario.getNombre( ese.aprobadousu_id) :  usuario.getNombre( ese.aprobadousu_id)  %}
{% set usuario_investigador = (ese.investigador=='') ? '' :  usuario.getNombre(ese.investigador)  %}
{% set usuario_analista = (ese.ana_id=='') ? '' :  usuario.getNombre( ese.ana_id)  %}
{% set usuario_valida_estudio = (ese.usu_idvalida=='') ? 'Nombre de la persona que valido' :  usuario.getNombre( ese.usu_idvalida)  %}
{% set usuario_cancelo_estudio = (ese.usu_idcancela=='') ? '' : usuario.getNombre(ese.usu_idcancela)  %}
<!-- fechas -->
{% set fecha_alta = (ese.ese_registro=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_registro))  %}
{% set fecha_entrega_cliente = (ese.ese_fechaentregacliente=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_fechaentregacliente))  %}
{% set fecha_cancelacion = (ese.ese_fechacancelacion=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_fechacancelacion))  %}
{% set fecha_asig_inv = (ese.ese_fechaasiginvestigador=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_fechaasiginvestigador))  %}
{% set fecha_entrega_inv = (ese.ese_fechaentregainvestigador=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_fechaentregainvestigador))  %}
{% set fecha_apro_trans = (ese.tra_fechaaprobado=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.tra_fechaaprobado))  %}
{% set fecha_asig_ana = (ese.ese_fechaasiganalista=='') ? '' :  date("d-m-Y H:i:s", strtotime(ese.ese_fechaasiganalista))  %}

{% set fecha_entrega_ana = (ese.ese_fechaentregaanalista=='') ? '' :  date("d-m-Y", strtotime(ese.ese_fechaentregaanalista))  %}



<a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" 
            onclick="resumen_estudio('{{ estudio.getEstatusBanderaColor(ese.ese_estatus) }}', '{{ ese.ese_estatus }}','	{{ estudio.getEstatusDetail(ese.ese_estatus) }}','{{ ese.ese_id }}', '{{ ese.ese_folioverificacion }}'
        
            );">

    <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
</a>

{% if treintaycuatro==1 %}
    {% if ese.ese_estatus ==-2 %}
        {% if  ese.ese_estatus == -2 %}
        {% set NombreEstatus = estudiomodel.getEstatusDetail(ese.ese_precancelar) %}
        {% else %}
        {% set NombreEstatus = estudiomodel.getEstatusDetail(ese.ese_estatus-1) %}
        {% endif %}


    
        <a data-toggle="modal" title="Regresar a estatus anterior. {{ NombreEstatus }}" class="" data-container="body" data-toggle="popover" role="button" data-target="#regresar_estatus-modal" onclick="fn_llenar_regresar_estatus_Modal('{{ese.ese_id}}','{{NombreEstatus}}')">
            <i class="mdi mdi-arrow-left-bold  mdi-18px btn-icon"></i>								
        </a>
    
    {% endif %}

{% endif %}

{% if setentaynueve==1 %}

    {% if ese.ese_estatus ==7 %}
    {% set NombreEstatus = estudiomodel.getEstatusDetail(ese.ese_estatus-1) %}

        <a data-toggle="modal" title="Regresar entregado. {{ NombreEstatus }}" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#regresar_estatus-modal" onclick="fn_llenar_regresar_estatus_Modal('{{ese.ese_id}}','{{NombreEstatus}}')">
            <i class="mdi mdi-arrow-left-bold  mdi-18px btn-icon"></i>								
        </a>
    
    {% endif %}

{% endif %}

{% if dieciseis==1 %}
    <a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentariosese-modal" onclick="comentarioese('{{ese.ese_id}}')">
        <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
    </a>
{% endif %}

{% if ese.tip_id==1 and ese.ese_estatus == 7 %} 
    {% if ese.tif_id==1 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoeses/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if ese.tif_id==7 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoargos/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
{% endif %}

{% if ese.tip_id==5 %}
    {% if ese.tif_id==5 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatogabtubos/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if ese.tif_id==6 or ese.tif_id==8 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoencognv/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
{% endif %}

        {% if ochentaynueve==1 %}
        <a data-toggle="modal"  type="button" class="" title="Consultar calificaciones del estudio" data-container="body" data-toggle="popover" role="button" data-target="#consultar-calf-ese-modal" onclick="fnConsultaCalificacionESE('{{ese.ese_id}}')">
            <i class="mdi mdi-playlist-check  mdi-18px btn-icon"></i>								
        </a>
        {% endif %}



            {% set permiso_archivo = veinte %}
            {% set permiso_43 = cuarentaytres %}
            {% set permiso_archivo = veinte %}

            {% set ese_id = ese.ese_id %}
            {% set tif_id_validar = ese.tif_id %}
            {% set tip_id_validar = ese.tip_id %}

            {% include "/consulta/complementos/opciones_validaciones/archivo.volt" %}
            {% include "/consulta/complementos/opciones_validaciones/reporte_ese.volt" %}

          

    
        