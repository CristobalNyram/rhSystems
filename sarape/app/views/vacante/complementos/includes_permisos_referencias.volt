



<!-- funciones ayuda js -->
{% include "/tipocita/script-ajax-todos.volt" %}
{% include "/medio/script-ajax-todos.volt" %}
{% include "/catvacante/script-ajax-todos.volt" %}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{% include "/psicometria/acciones/get-detalles-uno-js.volt" %}
{% include "/entrevista/acciones/get-detalles-uno-js.volt" %}
{% include "/seccionlaboral/acciones/get-detalles-uno-js.volt" %}
{% include "/archivo/acciones/cargar-tabla-js.volt" %}
{% include "/usuario/acciones/auxiliares/script-ajax-get-uno.volt" %}
{% include "/facturacion/acciones/get-detalles-uno-js.volt" %}



{% include "/municipio/script-ajax-todos.volt" %}
{% include "/contactoemp/script-ajax-todos.volt" %}
{% include "/centrocosto/script-ajax-todos.volt" %}
{% include "/vacante/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/exc-scripts-llenar-selects-si-proceso.volt" %}
{% include "/candidato/acciones/script-ajax-create-agradecimiento-correo-whats.volt" %}
{% include "/facturacion/acciones/exc-fac-mandar-correo-facturacion.volt" %}

<!-- funciones ayuda js fin -->

<!-- seccion de include -->
{% include "/vacante/acciones/rellenar-selects-vac-js.volt" %}
{% include "/vacante/acciones/recargar-tabla-referencias.volt" %}

{% include "/seccionlaboral/general/modal-js.volt" %}
{% include "/referencialaboral/general/tabla-modal.volt" %}
{% include "/empleooculto/general/tabla-modal.volt" %}
{% include "/periodoinactivo/general/tabla-modal.volt" %}



{% include "/expedientecan/acciones/exc-modal-cambiar-estatus.volt" %}

{# modal resumen inicio #}
{% include "/expedientecan/acciones/exc-modal-resumen.volt" %}
{% include "/expedientecan/acciones/exc-script-resumen.volt" %}
{# modal resumen fin #}


{# seccion de includes de tablas #}
{% include "/archivo/tabla-modal-js.volt" %}
{% include "/comentarioexc/tabla-modal-js.volt" %}






<!-- seccion de include fin -->

{% include "/vacante/acciones/todos-script-resumen.volt" %}