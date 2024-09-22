<script>
function fnGeConcincidenciaByCURP (input_curp="") {
  if (input_curp.length <= 0) {
    return Promise.reject("input_curp no válido");
  }
  const curpRegExp = /^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/;
  if (!curpRegExp.test(input_curp)) {
    return Promise.reject("input_curp no válido o no tiene el formato de una CURP válida");
  }
  // Crea un objeto con los datos que deseas enviar
 const data = {
  can_curp: input_curp.trim()
  };
  return new Promise(function(resolve, reject) {
    let url = "<?php echo $this->url->get('candidato/ajax_get_coincidencias_by_curp/') ?>";
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
