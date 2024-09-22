
{% for reg in page %}
{% set fileExtensionLength = 4 %} {# Longitud de la extensión del archivo, en este caso, ".pdf" tiene 4 caracteres #}
{% set nombreArchivo = reg.arc_nombre %} {# Suponiendo que reg.arc_nombre contiene el nombre del archivo #}
{% set extension = nombreArchivo|slice(0 - fileExtensionLength, fileExtensionLength) %}
{% set ruta_img = 'archivosexc/' ~ exc_id ~ '/' ~ nombreArchivo %}
{% set existe_archivo= acceso.verificar_existencia_archivo(ruta_img) %}

{% if existe_archivo %}
<div class="card m-2 col-sm-12 col-12 d-flex justify-content-center" style="width: 18rem;">
{% else %}
<div class="card m-2 col-sm-3 col-12 d-flex justify-content-center" style="width: 18rem;">
{% endif %}
    

        {% if extension == ".pdf" %}
                {% if existe_archivo %}
                    <embed src="{{ url("archivosexc/" ~ exc_id ~ "/" ~ nombreArchivo) }}" type="application/pdf" width="100%" height="600px" class="card-img-top img-custom-height"/>
                {% else %}
                    {{ image("assets/images/sistema/archiv-no-encontrado.jpg", "alt": "NO EXISTE ARCHIVO " ~ exc_id, "class": "card-img-top img-custom-height images-links") }}
                {% endif %}
         {% else %}
                {% if existe_archivo %}
                    {{ image(ruta_img, "alt": "IMAGEN DEL EXPEDIENTE CANDIDATO " ~ exc_id, "class": "card-img-top img-custom-height images-links") }}
                {% else %}
                    {{ image("assets/images/sistema/archiv-no-encontrado.jpg", "alt": "NO EXISTE ARCHIVO " ~ exc_id, "class": "card-img-top img-custom-height images-links") }}
                {% endif %}
        {% endif %}
        

         <div class="card-body-title-custom">
                <p class="card-text card-title-main">
                    {{ reg.cat_nombre }}
                </p>
        </div>
        <div class="card-body-extra-text-custom">
            <p class="card-text ">
                Folio de archivo: {{ reg.arc_id }}
            </p>
        </div>
        <div class="card-body card-body-buttons">
            {% if existe_archivo %}
                {% if extension == ".pdf" %}
                <!-- <a href="#" class="btn btn-primary" title="Visualizar PDF más de cerca el archivo">
                    <i class="mdi mdi-eye mdi-18px btn-icon white" style="color:white;"></i>
                    Visualizar
                </a> -->
                {% else %}
                <!-- <a href="{{ url("archivosexc/" ~ exc_id ~ "/" ~ nombreArchivo) }}" class="btn btn-primary image-link" title="Visualizar más de cerca el archivo">
                    <i class="mdi mdi-eye mdi-18px btn-icon white" style="color:white;"></i>
                    Visualizar
                </a> -->
                {% endif %}
                
            
                {{ link_to("archivo/descargar/"~reg.arc_id, '<i class="mdi mdi-download mdi-18px btn-icon white" style="color:white;"></i> Descargar', "class": "btn btn-primary","title":"Descargar archivo folio "~reg.arc_id~" del expediente "~reg.exc_id~" ", 'target':'_blank') }}
            {% else %}

            <!-- sin archivo opciones -->
            {% endif %}
          
        </div>
</div>
{% endfor %}
<script>
$(document).ready(function() {
    $('.image-link').magnificPopup({
        type: 'image',
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = 'mfp-zoom-in';
                this.container.css('z-index', '999999');
            }
        }
    });
});


</script>



