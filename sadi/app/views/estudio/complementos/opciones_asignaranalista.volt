{% if once==1 %}

<a data-toggle="modal" type="button" title="Asignar analista" class="" data-container="body" data-toggle="popover" role="button"  data-target="#asignar_analista_estudio-modal" onclick="fnIdESE('{{ esc.ese_id }}')" >
    <i class="mdi mdi-share mdi-18px btn-icon"></i> 
</a>
{% endif %}

{% if dieciseis==1 %}
    <a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentariosese-modal" onclick="comentarioese('{{esc.ese_id}}')">
        <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
    </a>
{% endif %}
{% if veinte==1 %}
    <!-- archivos inicio  -->
    
            <!-- variables para pasar como paramentros en las validaciones inico-->
            {% set tif_id_validar = esc.tif_id %}
            {% set ese_id= esc.ese_id %}
            {% set permiso_archivo = veinte %}
                <!-- variables para pasar como paramentros en las validaciones fin-->

            {% include "/estudio/complementos/opciones_validaciones/archivo.volt" %}

    <!-- archivos fin -->

    
{% endif %}
{% if treintaydos==1 %}
    <a data-toggle="modal" type="button" title="Cancelar" tool class="" data-container="body" data-toggle="popover" role="button"  data-target="#cancelar_estudio-modal" onclick="fnIdESECancelar('{{ esc.ese_id }}');">
        <i class="mdi mdi-cancel mdi-18px btn-icon"></i>
    </a>
{% endif %}
<!-- sección detalles -->
{% if esc.tip_id==2 %}
    {% if treintaytres==1 %}
        <a data-toggle="modal" title="Ver detalles" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fndetallesestudio('{{ esc.ese_id }}')" data-target="#detallesver-modal">
            <i class="mdi mdi-eye mdi-18px btn-icon"></i>
        </a>
    {% endif %}
{% endif %}

{% if treintaycuatro==1 %}
    {% if  esc.ese_estatus == -2 %}
    {% set NombreEstatus = estudiomodel.getEstatusDetail(esc.ese_precancelar) %}
    {% endif %}
    {% if  esc.ese_estatus == 2 or esc.ese_estatus == 3 %}
    {% set NombreEstatus = 'INICIAL' %}
    {% else %}
    {% set NombreEstatus = estudiomodel.getEstatusDetail(esc.ese_estatus-1) %}
    {% endif %}                   
    <a data-toggle="modal" title="Regresar a estatus anterior." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#regresar_estatus-modal"
    onclick="fn_llenar_regresar_estatus_Modal('{{esc.ese_id}}','{{NombreEstatus}}')">
        <i class="mdi mdi-arrow-left-bold  mdi-18px btn-icon"></i>								
    </a>
{% endif %}
{% if esc.tip_id==1 or esc.tip_id==3 or esc.tip_id==5 %}
    {% if treintayuno==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarestudiosocioeconomico('{{ esc.ese_id }}')" data-target="#editarestudiosocioeconomico-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}
{% endif %}
{% if esc.tip_id==2 %}
    {% if treintayuno==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarverificacion('{{ esc.ese_id }}')" data-target="#editarver-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}
{% endif %}
{% if esc.tip_id==4 %}
    {% if treintayuno==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarestudiosupervivencia('{{ esc.ese_id }}')" data-target="#editarestudiosupervivencia-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}
{% endif %}
{% if esc.tip_id==1 %} 


    <!-- FORMATO TRUPER -->
    {% if esc.tif_id==9 %}
        
                
            {% if cuarentaytres==1 %}
                {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
                {{ link_to("reporte/formatogabtruper/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato Gabinete Truper",'target':'_blank') }}
            {% endif %}



                {% if cincuentaynueve==1 %}
                <a data-toggle="modal"  title="Ver ESE completo -TRUPER" type="button" class="" style="color:#FF6600 ;" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_ese_truper-modal"  onclick="cargar_primer_seccion_ESE_formato_ese_truper('{{ esc.ese_id }}');"> 
                    <i class="mdi mdi-file-document mdi-18px btn-icon" style="color:#FF6600 ;"></i>
                </a>
                {% endif %}

    {% endif %}

      <!-- formato ventas truper -->
        {% if esc.tif_id==10 %}
                        
            
                                {% if cuarentaytres==1 %}
                                    {{ link_to("reporte/formatotruper_ventas/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-file-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER VENTAS",'target':'_blank') }}
                                {% endif %}
                    


                                {% if cincuentaynueve==1 %}
                                <a data-toggle="modal"  title="Ver ESE completo -TRUPER VENTAS " type="button" class="" style="color:#FF6600 ;" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_ese_truper-modal"  onclick="cargar_primer_seccion_ESE_formato_ese_truper('{{ esc.ese_id }}');"> 
                                    <i class="mdi mdi-file-document mdi-18px btn-icon" style="color:#FF6600 ;"></i>
                                </a>
                                {% endif %}

        {% endif %}       
<!-- FORMATO TRUPER FIN -->
     {% if esc.tif_id==1 or  esc.tif_id==7 %}
        {% if treintaynueve==1 %}
            <a data-toggle="modal"  title="Ver ESE completo" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio-modal"  onclick="cargar_primer_seccion_ESE('{{ esc.ese_id }}');"> 
                <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
            </a>
        {% endif %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoeses/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if esc.tif_id==7 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoargos/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
            {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
        {% endif %}
    {% endif %}
{% endif %}
{% if esc.tip_id==5 %}
    {% if esc.tif_id==5 %}
        {% if treintaynueve==1 %}
        <a data-toggle="modal"  title="Ver ESE completo -GABINETE TUBOS" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_gabtubos-modal"  onclick="cargar_primer_seccion_ESE_formato_gabtubos('{{ esc.ese_id }}');"> 
            <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
        </a>
        {% endif %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatogabtubos/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if esc.tif_id==6 or esc.tif_id==8 %}
        {% if treintaynueve==1 %}
            <a data-toggle="modal"  title="Ver ESE completo -GABINETE ENCOGNV" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_gabencognv-modal"  onclick="cargar_primer_seccion_ESE_formato_gabencognv('{{ esc.ese_id }}');"> 
            <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
        </a>
        {% endif %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatoencognv/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
        {% endif %}
    {% endif %}
    {% if esc.tif_id==11 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
        {% endif %}
        {% if cincuentaynueve==1 %}
        <a data-toggle="modal"  title="Ver ESE completo -TRUPER" type="button" class="" style="color:#FF6600 ;" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_ese_truper-modal"  onclick="cargar_primer_seccion_ESE_formato_ese_truper('{{ esc.ese_id }}');"> 
            <i class="mdi mdi-file-document mdi-18px btn-icon" style="color:#FF6600 ;"></i>
        </a>
        {% endif %}
    {% endif %}
 {% endif %}