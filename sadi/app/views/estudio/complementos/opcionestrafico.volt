{% if dieciseis==1 %}
    <a data-toggle="modal" title="Ver comentarios" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#comentariosese-modal" onclick="comentarioese('{{esc.ese_id}}')">
        <i class="mdi mdi-comment-processing mdi-18px btn-icon"></i>
    </a>
{% endif %}

{% set tif_id_validar = esc.tif_id %}
{% set ese_id = esc.ese_id %}

{% set ese_estatus_validar = esc.ese_estatus  %}
{% set estudio_modelo_obj = estudiomodel  %}
{% set ese_autoestudio = esc.ese_autoestudio  %}
{% set ese_autoestudio_validar = esc.ese_autoestudio %}

{% set permiso_70_editar_aes_validar = setenta %}
{% set autoestudio_estatus = esc.aes_estatus %}

{% set cen_id_validar = esc.cen_nombre %}
{% set alias_validar = esc.empresa_nombre %}


{% if veinte==1 %}


    <!-- archivos inicio  -->
       
                    <!-- variables para pasar como paramentros en las validaciones inico-->
                 
                        <!-- variables para pasar como paramentros en las validaciones fin-->

                    {% include "/estudio/complementos/opciones_validaciones/archivo.volt" %}


    <!-- archivos fin -->
    
   
{% endif %}    

<!-- regresar inicio -->
{% include "/estudio/complementos/opciones_validaciones/regresar.volt" %}
<!-- regresar fin -->

 <!-- validacion autoestudio-->
 {% include "/estudio/complementos/opciones_validaciones/editar_aes.volt" %}

{% if esc.ese_transporte==2 %}
    {% if esc.tra_solicitado is defined%}
        <a data-toggle="modal" title="Editar monto solicitado" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#modal-tra_solicitar-editar" onclick="fn_solicitar_editar('{{esc.tra_id}}')">
            <i class="mdi mdi-car-connected mdi-18px btn-icon"></i>
        </a>
        <a data-toggle="modal" type="button" title="Enviar" class="" data-container="body" data-toggle="popover" role="button"  data-target="#trafico_mandar-modal" onclick="fnmandarESEtrafico('{{ esc.ese_id }}','{{esc.tra_id}}')" >
            <i class="mdi mdi-send-check mdi-18px btn-icon"></i> 
        </a> 
    {% else %}
        <a data-toggle="modal"  title="Solicitar monto tranporte" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#modal-tra_solicitar" onclick="fn_solicitar_transporte_llenar_modal('{{esc.tra_id}}','0','{{esc.ese_id}}')"> 
            <i class="mdi mdi-car mdi-18px btn-icon"></i>
        </a>
    {% endif %}
{% else %}
    {% if siete==1 %}

        {% if esc.ese_autoestudio == 1 %}
        {% else  %}

        <a data-toggle="modal"  title="Asignar transporte a el investigador" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#asignar_solo_el_transporte-modal" onclick="asignarTransporteAInvesigador('{{esc.ese_id}}','{{esc.inv_id}}','{{ esc.investigador }}')"> 
            <i class="mdi mdi mdi-account-cash-outline  mdi-18px btn-icon"></i>
        </a>

        {% endif %}
    {% endif %}        
{% endif %}

{% if esc.ese_transporte==1 %} 
    <a data-toggle="modal" type="button" title="Enviar" class="" data-container="body" data-toggle="popover" role="button"  data-target="#trafico_mandar-modal" onclick="fnmandarESEtrafico('{{ esc.ese_id }}','{{esc.tra_id}}')" >
        <i class="mdi mdi-send-check mdi-18px btn-icon"></i> 
    </a>
{% endif %}

{% if esc.tip_id==1 %} 

    {% if esc.tif_id==1 or  esc.tif_id==7 %}
        {% if treintaynueve==1 %}
            <a data-toggle="modal"  title="Ver ESE completo" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio-modal"  onclick="cargar_primer_seccion_ESE('{{ esc.ese_id }}');"> 
                <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
            </a>
        {% endif %}
    {% endif %}
    
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
    {% if esc.tif_id==1 %}
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


{% if esc.tip_id==1 or esc.tip_id==3 or esc.tip_id==5%}
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
{% if once==1 %}
    {% if  esc.ana_id is not defined %}
    <a data-toggle="modal"   type="button" title="Asignar analista" class="" data-container="body" data-toggle="popover" role="button"  data-target="#asignar_analista_en_trafico-modal" onclick="fnAsignarAnalistaEnTrafico('{{ esc.ese_id }}')" >
        <i class="mdi mdi-share mdi-18px btn-icon" style="color:#0074BF"></i> 
    </a>
    {% else  %}
    <a data-toggle="modal"   type="button" title="Re-asignar analista" class="" data-container="body" data-toggle="popover" role="button"  data-target="#re_asignar_analista_en_trafico-modal" onclick="fnReAsignarAnalistaEnTrafico('{{ esc.ese_id }}','{{ esc.ana_id}}')" >
        <i class="mdi mdi-account-switch mdi-18px btn-icon" style="color:#0074BF"></i> 
    </a>
    {% endif %}
{% endif %}

{% if ochentaycuatro==1 %}
    <a data-toggle="modal" type="button" title="Ver citas" class="" data-container="body" data-toggle="popover" role="button"  data-target="#cita-modal" onclick="fnCargarCitasESEModal('{{ esc.ese_id }}');" >
        <i class="mdi mdi-calendar-multiple mdi-18px btn-icon"></i>
    </a>
{% endif %}

{% if siete==1 %}
<a data-toggle="modal" type="button" title="Re asignar investigador" class="" data-container="body" data-toggle="popover" role="button"  data-target="#re_asignarinvestigador-modal" onclick="fnReAsignarInvestigador('{{ esc.ese_id }}');" >
    <i class="mdi mdi-backup-restore mdi-18px  btn-icon"></i>
</a>
{% endif %}



