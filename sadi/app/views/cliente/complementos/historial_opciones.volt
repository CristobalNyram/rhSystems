<a data-toggle="modal" title="Ver archivos" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#archivos-modal" onclick="fnCargarTablaGeneralCliente('{{(encriptarparametros.encriiptarId(esc.ese_id))}}')">
	<i class="mdi mdi-folder-open-outline mdi-18px btn-icon"></i>
</a>
{# opciones de formatos ini#}
{% if esc.tip_id==1 %}
	{% if esc.tif_id==1 %}
		{{ link_to("reporte/formatoeses/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
	{% endif %}
	{% if esc.tif_id==7 %}
    {{ link_to("reporte/formatogabsips/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon"></i>', "title":"Descargar Formato Gabinete SIPS",'target':'_blank') }}
	{{ link_to("reporte/formatoargos/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
	{% endif %}
{% endif %}
{% if esc.tip_id==5 %}
    {% if esc.tif_id==6 or esc.tif_id==8 %}
		{{ link_to("reporte/formatoencognv/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
	{% endif %}
{% endif %}
{% if esc.tif_id==5 %}
    {{ link_to("reporte/formatogabtubos/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon"></i>', "title":"Descargar Formato",'target':'_blank') }}
{% endif %}
{# formato truper ini #}
{% if esc.tif_id==9 or esc.tif_id==11 %}          
    {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
{% endif %}
{% if esc.tif_id==10 %}     
    {{ link_to("reporte/formatotruper_ventas/"~(encriptarparametros.encriiptarId(esc.ese_id)), '<i class="mdi mdi-file-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER VENTAS",'target':'_blank') }}
{% endif %}
{# formato truper fin #}
{# opciones de formatos fin #}
