<script>
function fnGeConcincidenciaByNombreCompleto(input_name, input_apellido_mp, input_apellido_m) {
  if (input_name.length <= 0) {
    return Promise.reject("input_name no válido");
  }
  if (input_apellido_mp.length <= 0) {
    return Promise.reject("input_apellido_mp no válido");
  }
  if (input_apellido_m.length <= 0) {
    return Promise.reject("input_apellido_m no válido");
  }
  
  // Crea un objeto con los datos que deseas enviar
 const data = {
  can_nombre: input_name.trim(),
  can_primerapellido: input_apellido_mp.trim(),
  can_segundoapellido: input_apellido_m.trim()
};
  return new Promise(function(resolve, reject) {
    let url = "<?php echo $this->url->get('candidato/ajax_get_coincidencias_by_nombre_completo/') ?>";
    $.ajax({
      type: "POST",
      url: url,
      data: data, // Pasa los datos como parámetros
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
