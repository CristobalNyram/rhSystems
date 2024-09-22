{% if tip_id_validar ==2 %}

    {% if permiso_editar_validar ==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarverificacion('{{ ese_id }}')" data-target="#editarver-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}
    
{% endif %}

{% if tip_id_validar ==4 %}

    {% if permiso_editar_validar==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarestudiosupervivencia('{{ ese_id }}')" data-target="#editarestudiosupervivencia-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}

{% endif %}

{% if tip_id_validar==3 or tip_id_validar==5 %}

    {% if permiso_editar_validar==1 %}
        <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarestudiosocioeconomico('{{ ese_id }}')" data-target="#editarestudiosocioeconomico-modal">
            <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
        </a>
    {% endif %}

{% endif %}


{% if tip_id_validar==1 %}

        {% if permiso_editar_validar==1 %}
                <a data-toggle="modal" title="Editar" type="button" class="" data-container="body" data-toggle="popover" role="button" onclick="fneditarestudiosocioeconomico('{{ ese_id }}')" data-target="#editarestudiosocioeconomico-modal">
                    <i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i>
                </a>
        {% endif %}

{% endif %}
