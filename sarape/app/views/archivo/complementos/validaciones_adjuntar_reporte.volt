<!-- validamos que tipo de formato es -->


        {% if objArchivo.getValidacionAdjuntar(arc.tif_id,arc)==1 and funciones.extensionvalida(arc.arc_nombre)==1%}         
                {% if objArchivo.getValidacionEstatusAdjuntar(arc.ese_estatus)==1%} 
                        <input type="checkbox" class="form-check-input"  {% if arc.arc_reporte == 1 %} checked  value="2"{% else %} {% endif %} onchange="fnAgregarONoAReporteArchivo('{{ arc.arc_id }}',event)">
                {% endif %}
        {% endif %}
