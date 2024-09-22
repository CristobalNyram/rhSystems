<script  >
    /**
     * Carga dinámicamente las ocupaciones y las muestra en un elemento <select>.
     * @param {jQuery} $select_input - El elemento <select> donde se mostrarán las ocupaciones.
     * @param {number} select_value - El valor seleccionado actualmente en el elemento <select>.
     */
     function fnocupacionesAdaptable($select_input, select_value) {
        let url_enviar = "<?php echo $this->url->get('ocupacion/ajax_ocupaciones/') ?>";
        $select_input.empty();

        $.ajax({
            type: "POST",
            url: url_enviar,
            success: function(data) {
                let options = '';

                if (data.length > 0) {
                    options += '<option value="-1">Seleccionar</option>';

                    $.each(data, function(key, dat) {
                        options += '<option value="' + dat.ocu_id + '"';
                        if (select_value == dat.ocu_id) {
                            options += ' selected';
                        }
                        options += '>' + dat.ocu_nombre + '</option>';
                    });
                } else {
                    options += '<option value="-1" selected>No aplica</option>';
                }

                $select_input.html(options);
            },
            error: function(res) {
                // Manejar el error en caso de fallo de la petición AJAX.
            }
    });
}
   </script>