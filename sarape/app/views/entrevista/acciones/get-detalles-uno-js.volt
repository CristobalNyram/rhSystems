<script>

function fnGetDetalleEnt(exc_id=0) {
 if (exc_id <= 0) {
    return Promise.reject("exc_id no válido");
  }
  return new Promise(function(resolve, reject) {
    let url = "<?php echo $this->url->get('entrevista/ajax_get_detalle/') ?>";
    $.ajax({
      type: "POST",
      url: url + exc_id,
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
 