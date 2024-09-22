<script>
   function fnGuardarPreguntasVerificarEncuestaContestada(ese_id, enc_id) {
    return new Promise((resolve, reject) => {
      let url_enviar = "<?php echo $this->url->get('encuestacalidad/verificiar_encuesta_contestada/') ?>";

      $.ajax({
        type: "POST",
        url: url_enviar + ese_id + "/" + enc_id,
        success: function (res) {
          resolve(res);
        },
        error: function (data) {
          reject("No se pudieron cargar los datos, vuelve a intentar de nuevo." + data.responseText);
        },
      });
    });
  }

  function fnCambiarEstatusEncuestaContestada(ese_id, enc_id) {
    return new Promise((resolve, reject) => {
      let url_enviar = "<?php echo $this->url->get('encuestacalidad/cambiar_estatus_contestada_encuesta/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar + ese_id + "/" + enc_id,
        success: function (res) {
          resolve(res);
        },
        error: function (data) {
          reject("No se pudieron cargar los datos, vuelve a intentar de nuevo." + data.responseText);
        },
      });
    });
  }


</script>
