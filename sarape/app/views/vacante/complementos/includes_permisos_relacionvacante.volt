<!-- funciones ayuda js -->
{% include "/tipocita/script-ajax-todos.volt" %}
{% include "/medio/script-ajax-todos.volt" %}
{% include "/ejecutivo/acciones/script-ajax-todos.volt" %}
{% include "/ejecutivo/acciones/script-ajax-todo-no-rel-vac-compartida.volt" %}
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/contactoemp/script-ajax-todos.volt" %}
{% include "/catvacante/script-ajax-todos.volt" %}
{% include "/centrocosto/script-ajax-todos.volt" %}
{% include "/vacante/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/get-detalles-uno-js.volt" %}
{% include "/archivo/acciones/cargar-tabla-js.volt" %}
{% include "/relvacanteejecutivo/acciones/rve-cargar-tabla-general.volt" %}
{% include "/seccionlaboral/acciones/get-detalles-uno-js.volt" %}
{% include "/psicometria/acciones/get-detalles-uno-js.volt" %}
{% include "/entrevista/acciones/get-detalles-uno-js.volt" %}
{% include "/facturacion/acciones/get-detalles-uno-js.volt" %}
{% include "/expedientecan/acciones/exc-scripts-llenar-selects-si-proceso.volt" %}
{% include "/helper/acciones/script-ajax-get-tipo-pago.volt" %}
{% include "/candidato/acciones/script-ajax-create-agradecimiento-correo-whats.volt" %}
{% include "/facturacion/acciones/exc-fac-mandar-correo-facturacion.volt" %}

<!-- funciones ayuda js fin -->
<!-- seccion de include -->
{% include "/vacante/acciones/rellenar-selects-vac-js.volt" %}
{% include "/vacante/acciones/recargar-tabla-rel-vac.volt" %}
{% include "/vacante/acciones/vac-gen-editar-modal-js.volt" %}
{% include "/cita/acciones/get-detalles-uno-js.volt" %}
{% include "/cita/acciones/cit-modal-tabla-js.volt" %}
{% include "/seccionlaboral/general/modal-js.volt" %}
{# modal resumen inicio #}
{% include "/expedientecan/acciones/exc-modal-resumen.volt" %}
{% include "/expedientecan/acciones/exc-script-resumen.volt" %}
{# modal resumen fin #}

<!-- includes para  vac no limite -->
{% include "/vacante/acciones/vac-gen-editar-vac-no-modal-js.volt" %}
<!-- includes para  vac no limite -->

{# modal mandar a garantia #}
{% include "/expedientecan/acciones/exc-modal-mandar-garantia.volt" %}
{# modal mandar a garantia #}

{# modal regresar facturacion #}
{% include "/expedientecan/acciones/exc-modal-regresar-facturacion.volt" %}
{# modal regresar facturacion #}

{# cancelar vacante inicio#}
{% include "/vacante/acciones/vac-cancelar-js.volt" %}
{# cancelar vacante fin #}

{# seccion de includes de tablas #}
{% include "/archivo/tabla-modal-js.volt" %}
{% include "/comentarioexc/tabla-modal-js.volt" %}
{% include "/expedientecan/acciones/exc-modal-cit-rel-vac-tabla-js.volt" %}
{# estadisticas de vacantes inicio #}
{% include "/vacante/acciones/vac-estadisticas-vac-modal-js.volt" %}
{# estadisticas de vacante fin #}

{# tablas modales incio #}
{% include "/referencialaboral/general/tabla-modal.volt" %}
{% include "/empleooculto/general/tabla-modal.volt" %}
{% include "/periodoinactivo/general/tabla-modal.volt" %}
{# tablas modales fin #}

{# candidato buscar incio #}
{% include "/candidato/acciones/script-ajax-get-obtener-concidencias-curp.volt" %}
{% include "/candidato/acciones/script-ajax-get-obtener-concidencias-nombre.volt" %}
{# candidato buscar fin #}

{# cambiar estatus incio #}
{% include "/expedientecan/acciones/exc-modal-cambiar-estatus.volt" %}
{# cambiar estatus incio #}

{# reactivar exp ini #}
{% include "/expedientecan/acciones/exc-reactivar-modal-js.volt" %}
{# reactivar exp fin #}

{# cambiar el eejecutivo propietario inicio #}
{% include "/expedientecan/acciones/exc-eje-cambiar-modal-js.volt" %}
{# cambiar el eejecutivo propietario fin #}

{# compartir vacante inicio #}
{% include "/vacante/acciones/vac-compartir-eje-modal-js.volt" %}
{# compartir vacante fin #}

<!-- seccion de include fin -->
{% include "/vacante/acciones/todos-script-resumen.volt" %}