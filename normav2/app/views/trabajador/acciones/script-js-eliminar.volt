<script>
  /*eliminar partipante---------------------------------------------------------------------------------------------------start eliminar participante-------------*/
  function fnelim(clave) {
    var urleliminarare =
      "<?php echo $this->url->get('trabajador/eliminar/') ?>";
    mensaje =
      "¿Está seguro que desea eliminar el participante con folio: " +
      clave +
      "?";
    alertify
      .confirm(
        "Eliminar registro",
        mensaje,
        function () {
          $.ajax({
            type: "POST",
            url: urleliminarare + clave,
            success: function (res) {
              alertify.alert("Éxito", "Registro borrado con éxito", () => {
                location.reload();
              });
            },
            error: function (res) {
              console.log("error");
            },
          });
        },
        function () {}
      )
      .set("labels", { ok: "Eliminar", cancel: "Cancelar" });
  }

  /*eliminar partipante---------------------------------------------------------------------------------------------------end eliminar participante-------------*/
</script>
