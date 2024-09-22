
<script type="">
//$(document).ready(function() {

//  $(function (){
    _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN=0;
    function fnArribaOrdenCambiar(rel_id=0, callback_tabla=0)
    {
        _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN=0;
        _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN=callback_tabla;

        let url_enviar="<?php echo $this->url->get('referencialaboral/ajax_set_orden_arriba/') ?>";
        $.ajax({
            type: "POST",
            url: url_enviar + rel_id,
            success: function(response)
            {
               switch(response.estado) {
                        case 2:
                            swalalert('Éxito', response.mensaje, "success", 0);
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }

                            break;

                        case -1:
                            swalalert('Aviso', response.mensaje, "warning", 0);
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }

                            break;

                        case -2:
                            swalalertHTML('Error', `${response.mensaje} <br> <span class=></span> `, "error");
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }
                            break;

                        default:
                            // Realiza alguna acción por defecto si es necesario
                            break;
                        }

            },
            error: function(data)
            {
                alert('error en el servidor...' + data.responseText);
            }
        });
    }

    function fnAbajoOrdenCambiar(rel_id=0, callback_tabla=0)
    {
        _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN=0;
        _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN=callback_tabla;
        let url_enviar="<?php echo $this->url->get('referencialaboral/ajax_set_orden_abajo/') ?>";
        $.ajax({
            type: "POST",
            url: url_enviar + rel_id,
            success: function(response)
            {
                switch (response.estado) {
                        case 2:
                            swalalert('Éxito', response.mensaje, "success", 0);
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }

                            break;

                        case -1:
                            swalalert('Aviso', response.mensaje, "warning", 0);
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }

                            break;

                        case -2:
                            swalalertHTML('Error', `${response.mensaje} <br> <span class=></span> `, "error");
                            if (_CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN !== 0 && response && response.sel_id !== null && response.sel_id !== "") {
                            _CALLBACK_REOLAD_TABLE_REF_LAB_ORDEN(response.sel_id);
                            } else {
                            window.location.reload();
                            }
                            break;

                        default:
                            // Realiza alguna acción por defecto si es necesario
                            break;
                        }
            },
            error: function(data)
            {
                alert('error en el servidor...' + data.responseText);
            }
        });
    }
// });
//});

 </script>
 