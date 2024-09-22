<script>
/**
 * Obtiene el detalle de una vacante mediante una solicitud AJAX.
 * @param {number} vac_id - El ID de la vacante a obtener el detalle.
 * @return {Promise} Una Promesa que se resuelve con el resultado de la solicitud AJAX o se rechaza con el error.
 */
function fnGetDetalleVac(vac_id=0) {
 if (vac_id <= 0) {
    return Promise.reject("vac_id no válido");
  }
  return new Promise(function(resolve, reject) {
    let url = "<?php echo $this->url->get('vacante/ajax_get_detalle/') ?>";
    $.ajax({
      type: "POST",
      url: url + vac_id,
      success: function(res) {
        resolve(res); // Resuelve la Promesa con el valor de res
      },
      error: function(data) {
        reject(data); // Rechaza la Promesa con el valor de data
      }
    });
  });
}


</script>
 