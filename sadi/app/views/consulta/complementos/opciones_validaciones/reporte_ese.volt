<!-- truper normal -->
{% if permiso_43==1 %}
        {% if tif_id_validar==9 or tif_id_validar==11 %}          
                {{ link_to("reporte/formatotruper/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
                {{ link_to("reporte/formatogabtruper/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-briefcase-check mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato Gabinete Truper",'target':'_blank') }}
        {% endif %}

        <!-- formato ventas truper -->
        {% if tif_id_validar==10 %}     
                {{ link_to("reporte/formatotruper_ventas/"~(encriptarparametros.encriiptarId(ese.ese_id)), '<i class="mdi mdi-file-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER VENTAS",'target':'_blank') }}
        {% endif %}
{% endif %}
