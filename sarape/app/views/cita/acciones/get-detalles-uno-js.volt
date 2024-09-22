<script>
/**
 * Obtiene el detalle de una vacante mediante una solicitud AJAX.
 * @param {number} cit_id - El ID de la vacante a obtener el detalle.
 * @return {Promise} Una Promesa que se resuelve con el resultado de la solicitud AJAX o se rechaza con el error.
 */
function fnGetDetalleCit(cit_id=0) {
 if (cit_id <= 0) {
    return Promise.reject("cit_id no válido");
  }
  return new Promise(function(resolve, reject) {
    let url = "<?php echo $this->url->get('cita/ajax_get_detalle_cit_exc_can/') ?>";
    $.ajax({
      type: "POST",
      url: url + cit_id,
      success: function(res) {
        resolve(res); // Resuelve la Promesa con el valor de res
      },
      error: function(data) {
        console.error(data);
        reject(data); // Rechaza la Promesa con el valor de data
      }
    });
  });
}


</script>
 