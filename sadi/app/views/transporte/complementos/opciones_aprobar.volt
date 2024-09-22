<a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" 								
onclick="resumen_estudio('{{ estudio.getEstatusBanderaColor(tp_sol.ese_estatus) }}', '{{ tp_sol.ese_estatus }}','	{{ estudio.getEstatusDetail(tp_sol.ese_estatus) }}','{{ tp_sol.ese_id }}', '{{ tp_sol.ese_folioverificacion }}')">
<i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								


</a>




<!-- variables para pasar como paramentros en las validaciones inico-->
   {% set tif_id_validar = tp_sol.tif_id %}
   {% set tra_id = tp_sol.tra_id %}

   {% set ese_id = tp_sol.ese_id %}
   {% set permiso_archivo = veinte %}
       <!-- variables para pasar como paramentros en las validaciones fin-->

   {% include "/transporte/complementos/opciones_validaciones/archivo.volt" %}
<!-- archivos fin -->


<a data-toggle="modal" title="Enviar" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#aprobar-modal" onclick="fn_aprobar_transporte_modal_llenar('{{tp_sol.tra_id}}','{{tp_sol.tra_preaprobado}}')">
<i class="mdi mdi-send mdi-18px btn-icon"></i>
</a>
{% if dieciseis==1 %}
<a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentariosese-modal" onclick="comentarioese('{{tp_sol.ese_id}}')">
    <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
</a>
{% endif %}
{{ link_to("https://www.google.com.mx/maps/dir/"~tp_sol.tra_origen~"/"~tp_sol.tra_destino, '<i class="mdi mdi-google-maps mdi-18px btn-icon"></i>', FALSE,  "title":"MAPA",'target':'_blank') }}

{% if tp_sol.tip_id==1 %}
    {% if tp_sol.tif_id==1 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoeses/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if tp_sol.tif_id==7 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoargos/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if tp_sol.tif_id==9 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if tp_sol.tif_id==10 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatotruper_ventas/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
{% endif %}
{% if tp_sol.tip_id==5 %}
    {% if tp_sol.tif_id==5 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatogabtubos/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if tp_sol.tif_id==6 or tp_sol.tif_id==8 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoencognv/"~(encriptarparametros.encriiptarId(tp_sol.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
{% endif %}