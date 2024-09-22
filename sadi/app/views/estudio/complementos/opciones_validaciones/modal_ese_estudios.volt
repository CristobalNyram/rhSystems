    
                  {% if tip_id_validar==5 %}


                        {% if tif_id_validar ==5 %}
                                    {% if permiso_ese_validar_39==1 %}
                                    <a data-toggle="modal"  title="Ver ESE completo -GABINETE TUBOS" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_gabtubos-modal"  onclick="cargar_primer_seccion_ESE_formato_gabtubos('{{ ese_id }}');"> 
                                        <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
                                    </a>
                                    {% endif %}
                        {% endif %}


                        {% if tif_id_validar==6 or tif_id_validar ==8 %}
                                    {% if permiso_ese_validar_39==1 %}
                                    <a data-toggle="modal"  title="Ver ESE completo -GABINETE ENCOGNV" type="button" class="" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_gabencognv-modal"  onclick="cargar_primer_seccion_ESE_formato_gabencognv('{{ ese_id }}');"> 
                                    <i class="mdi mdi-file-document mdi-18px btn-icon"></i>
                                </a>
                                {% endif %}
                        {% endif %}
                        {% if esc.tif_id==11 %}
                            {% if cuarentaytres==1 %}
                                {{ link_to("reporte/formatotruper/"~esc.ese_id, '<i class="mdi mdi-pdf-box mdi-18px btn-icon" style="color:#FF6600 ;"></i>', "title":"Descargar Formato TRUPER",'target':'_blank') }}
                            {% endif %}
                            {% if cincuentaynueve==1 %}
                            <a data-toggle="modal"  title="Ver ESE completo -TRUPER" type="button" class="" style="color:#FF6600 ;" data-container="body"  data-toggle="tooltip"  role="button" data-target="#ver_completo_estudio_formato_ese_truper-modal"  onclick="cargar_primer_seccion_ESE_formato_ese_truper('{{ esc.ese_id }}');"> 
                                <i class="mdi mdi-file-document mdi-18px btn-icon" style="color:#FF6600 ;"></i>
                            </a>
                            {% endif %}
                        {% endif %}

                  {% endif %}