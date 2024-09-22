<!-- seccion de permis -->
{% if siete==1 %}
<a data-toggle="modal" type="button" title="Asignar investigador" class="" data-container="body" data-toggle="popover" role="button"  data-target="#asignarinvestigador-modal" onclick="fninvestigador('{{ esc.ese_id }}','{{ esc.tip_id }}');" >
    <i class="mdi mdi-worker mdi-18px btn-icon"></i>
</a>
{% endif %}


{% if treintaydos==1 %}
                <a data-toggle="modal" type="button" title="Cancelar" tool class="" data-container="body" data-toggle="popover" role="button"  data-target="#cancelar_estudio-modal" onclick="fnIdESECancelar('{{ esc.ese_id }}');">
        <i class="mdi mdi-cancel mdi-18px btn-icon"></i>
    </a>
{% endif %}
{% if dieciseis==1 %}
    <a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentariosese-modal" onclick="comentarioese('{{esc.ese_id}}')">
        <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
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

{% if esc.tip_id==1 %}
    {% if esc.tif_id==1 or  esc.tif_id==7 %}
        {% if treintaynueve==1 %}
        <a data-toggle="modal"   title="Ver ESE completo" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio-modal"  onclick="cargar_primer_seccion_ESE('{{ esc.ese_id }}');"> 
            <i class="mdi mdi-file-document mdi-18px btn-icon" ></i>
        </a>
        {% endif %}
    {% endif %}

    <!-- FORMATO TRUPER -->
    {% if esc.tif_id==9 %}
        {% if cuarentaytres==1 %}
            {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
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
{% endif %}

<!-- ese id -->
{% set ese_id = esc.ese_id %}
    <!-- tip id -->
{% set tip_id_validar = esc.tip_id %}
<!-- tif id -->
{% set tif_id_validar = esc.tif_id %}

<!-- permiso 39 -->
{% set permiso_ese_validar_39 = treintaynueve %}

    <!-- variables para pasar como paramentros en las validaciones inico-->
{% set permiso_editar_validar = treintayuno  %}
<!-- variables para pasar como paramentros en las validaciones fin-->


<!-- validacion de que modal se va mostrar -->
{% include "/estudio/complementos/opciones_validaciones/modal_ese_estudios.volt" %}


<!-- validacion de permiso editar -->
{% include "/estudio/complementos/opciones_validaciones/editar_estudio.volt" %}


<!-- variables para pasar como paramentros en las validaciones inico-->
{% set permiso_archivo = veinte %}
<!-- variables para pasar como paramentros en las validaciones fin-->


    <!-- validacion de permiso archivo-->
{% include "/estudio/complementos/opciones_validaciones/archivo.volt" %}

    
{% if ochentaycuatro==1 %}
    <a data-toggle="modal" type="button" title="Ver citas" class="" data-container="body" data-toggle="popover" role="button"  data-target="#cita-modal" onclick="fnCargarCitasESEModal('{{ esc.ese_id }}');" >
        <i class="mdi mdi-calendar-multiple mdi-18px btn-icon"></i>
    </a>
{% endif %}
                
            