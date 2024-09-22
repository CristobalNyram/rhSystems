
<!-- validamos que tipo de formato es -->
{% if arc.tif_id==9 or arc.tif_id==11 %}

        {% if funciones.excluirCategoriasParaAdjuntar_FormatoTruper(arc.cat_id)!=1  and funciones.extensionvalida(arc.arc_nombre)==1%} 

            <input type="checkbox" class="form-check-input"  {% if arc.arc_reporte == 1 %} checked  value="2"{% else %} {% endif %} onchange="fnAgregarONoAReporteArchivo('{{ arc.arc_id }}',event)">

        {% endif %}

{% else %}

        {% if funciones.excluirCategoriasParaAdjuntar(arc.cat_id)!=1  and funciones.extensionvalida(arc.arc_nombre)==1%} 

        <input type="checkbox" class="form-check-input"  {% if arc.arc_reporte == 1 %} checked  value="2"{% else %} {% endif %} onchange="fnAgregarONoAReporteArchivo('{{ arc.arc_id }}',event)">

        {% endif %}

{% endif %}