<script>

function fnGetDataEmpresa(emp_id=0) {
  const url_enviar_data = "<?php echo $this->url->get('empresa/ajax_empresa_detalle/') ?>";
  return $.ajax({
    type: "POST",
    url: url_enviar_data + emp_id
  });
}

function obtenerDatosEmpresa(emp_id, elementId) {
  fnGetDataEmpresa(emp_id)
    .done(function(res) {
      let data = res.data;
      let mensaje_empresa = ` - <span class="text-warning"> ${data.emp_alias} </span> - <span class="text-warning"> ${data.emp_nombre}</span> `;
      $('#' + elementId).html(`<i class="mdi mdi-information mdi-24px btn-icon"></i> Datos de empresa ` + mensaje_empresa);
    })
    .fail(function(error) {
      alertify.alert('ERROR', 'No se pudieron cargar los datos, vuelve a intentar de nuevo.'+error.reponseText);
    });
}


</script>