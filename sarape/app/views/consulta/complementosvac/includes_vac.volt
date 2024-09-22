



<!-- funciones ayuda js -->
{% include "/tipocita/script-ajax-todos.volt" %}
{% include "/medio/script-ajax-todos.volt" %}
{% include "/catvacante/script-ajax-todos.volt" %}
{% include "/ejecutivo/acciones/script-ajax-todo-no-rel-vac-compartida.volt" %}
{% include "/ejecutivo/acciones/script-ajax-todos.volt" %}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{% include "/psicometria/acciones/get-detalles-uno-js.volt" %}
{% include "/entrevista/acciones/get-detalles-uno-js.volt" %}
{% include "/seccionlaboral/acciones/get-detalles-uno-js.volt" %}
{% include "/archivo/acciones/cargar-tabla-js.volt" %}
{% include "/helper/acciones/script-ajax-get-tipo-pago.volt" %}
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


<!-- includes para  vac no limite -->
{% include "/vacante/acciones/vac-gen-editar-vac-no-modal-js.volt" %}


{# editar vacante #}
{% include "/vacante/acciones/rellenar-selects-vac-js.volt" %}
{% include "/vacante/acciones/recargar-tabla-rel-vac.volt" %}
{% include "/vacante/acciones/vac-gen-editar-modal-js.volt" %}

{# editar vacante fin  #}

{# cita #}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{% include "/cita/acciones/cit-modal-tabla-js.volt" %}
{#  cita fin #}

{# tabla rel exc cit #}
{% include "/expedientecan/acciones/exc-modal-cit-rel-vac-tabla-js.volt" %}
{# tabla rel exc cit fin #}

{# mandar a garantía vac ini #}
{% include "/vacante/acciones/vac-mandar-garantia-modal-js.volt" %}
{# mandar a garantía vac fin #}
{# cambiar estatus vac ini #}
{% include "/vacante/acciones/vac-mandar-regresar-modal-js.volt" %}
{#  cambiar estatus vac fin #}

{% include "/vacante/acciones/vac-estadisticas-vac-modal-js.volt" %}
{% include "/vacante/acciones/todos-script-resumen.volt" %}

