



<!-- funciones ayuda js -->
{% include "/tipocita/script-ajax-todos.volt" %}
{% include "/medio/script-ajax-todos.volt" %}
{% include "/catvacante/script-ajax-todos.volt" %}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{% include "/psicometria/acciones/get-detalles-uno-js.volt" %}
{% include "/entrevista/acciones/get-detalles-uno-js.volt" %}
{% include "/seccionlaboral/acciones/get-detalles-uno-js.volt" %}
{% include "/archivo/acciones/cargar-tabla-js.volt" %}
{% include "/archivovac/tabla-modal-js.volt" %}
{% include "/ejecutivo/acciones/script-ajax-todos.volt" %}

{% include "/facturacion/acciones/get-detalles-uno-js.volt" %}


{% include "/municipio/script-ajax-todos.volt" %}
{% include "/contactoemp/script-ajax-todos.volt" %}
{% include "/centrocosto/script-ajax-todos.volt" %}
{% include "/vacante/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/exc-scripts-llenar-selects-si-proceso.volt" %}
<!-- funciones ayuda js fin -->

<!-- seccion de include -->

{# includes psicometria  incio #}
{% include "/psicometria/acciones/psi-editar-modal-js.volt" %}
{% include "/psicometria/acciones/psi-script-llenar-select-val.volt" %}
{# includes psicometria fin  #}


{# includes cambiar estatus  #}
{% include "/expedientecan/acciones/exc-modal-cambiar-estatus.volt" %}
{# includes autorizar  #}
{% include "/expedientecan/acciones/exc-modal-autorizar.volt" %}

{# include citas #}
{% include "/cita/acciones/cit-script-llenar-select-val.volt" %}
{% include "/cita/acciones/cit-modal-editar-js.volt" %}
{% include "/cita/acciones/cit-modal-reprogramar-js.volt" %}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{# include citas #}



{# includes seccion laboral inciio  #}
{% include "/seccionlaboral/general/modal-js.volt" %}
{% include "/referencialaboral/general/tabla-modal.volt" %}
{% include "/empleooculto/general/tabla-modal.volt" %}
{% include "/periodoinactivo/general/tabla-modal.volt" %}
{# includes seccion laboral fin  #}


{# includes resumen inciio  #}

{% include "/expedientecan/acciones/exc-modal-resumen.volt" %}
{% include "/expedientecan/acciones/exc-script-resumen.volt" %}
{# includes resumen fin  #}


{# seccion de includes de tablas #}

{% include "/archivo/tabla-modal-js.volt" %}
{% include "/comentarioexc/tabla-modal-js.volt" %}



{# entrevista inicio #}
{% include "/entrevista/acciones/ent-modal-calificacion-js.volt" %}
{# entrevista fin #}

{# reactivar exp ini #}
{% include "/expedientecan/acciones/exc-reactivar-modal-js.volt" %}
{# reactivar exp fin #}


{# modal regresar facturacion #}
    {% include "/expedientecan/acciones/exc-modal-regresar-facturacion.volt" %}
{# modal regresar facturacion #}
{# cambiar el eejecutivo propietario inicio #}
{% include "/expedientecan/acciones/exc-eje-cambiar-modal-js.volt" %}
{# cambiar el eejecutivo propietario fin #}



<!-- tabla  -->


<!-- seccion de include fin -->

{% include "/vacante/acciones/todos-script-resumen.volt" %}
{% include "/candidato/acciones/script-ajax-create-agradecimiento-correo-whats.volt" %}
{% include "/facturacion/acciones/exc-fac-mandar-correo-facturacion.volt" %}
