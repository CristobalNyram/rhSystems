{% if permiso_70_editar_aes_validar==1 %}

        <!-- validamos si un autoestudio -->
        {% if ese_autoestudio_validar==1 %}

        <!-- validamos el estatus -->
        {% if autoestudio_estatus==2  %}

                <a data-toggle="modal"  title="Editar autoestudio " type="button" class="" style="color:#FF6600 ;" data-container="body"  data-toggle="tooltip"  role="button" data-target="#editar_autoestudio-modal"  onclick="fnEditarAES('{{ ese_id }}');"> 
                    <i class="mdi mdi-pen-plus mdi-18px btn-icon" style="color:#270278 ;"></i>
                </a>
        {% endif %}


        {% endif %}
{% endif %}