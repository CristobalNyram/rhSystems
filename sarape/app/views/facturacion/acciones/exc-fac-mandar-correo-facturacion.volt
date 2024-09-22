<script>
    function enviarCorreoFacturacion_General_PREGUNTA(can_id = 0,exc_id=0,vac_id=0){
        // console.log(can_id,exc_id,vac_id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres enviar el correo de facturación?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                // Lógica para enviar el correo de agradecimiento aquí
                enviarCorreoFacturacion_General(can_id,exc_id,vac_id);
            }
        });    
    }

    function enviarCorreoFacturacion_General(can_id = 0,exc_id=0,vac_id=0) {
        Swal.fire({
            // title: '',
            showConfirmButton: false,
            html: `
            <h2 class="enviando-animacion">Enviado el correo...</h2>
              {{ image("assets/images/sistema/email-enviando.gif", "alt": " ", "height": "200") }}
              `,
            allowOutsideClick: false,
        });
        // debugger;
        let url = "<?php echo $this->url->get('facturacion/enviar_correo_fatu_auto/') ?>";
        $.ajax({
            type: "POST",
            url: url +`${can_id}/${exc_id}/${vac_id}`,
            success: function (res) {
                 Swal.close();
                   switch (res['estado']) {
                      case 2:
                          Swal.fire({
                            //  title: 'Correo enviado',
                            //    icon: 'success',
                            html: `
                            <h2 >Correo enviado</h2>

                            {{ image("assets/images/sistema/email-enviado.gif", "alt": " ", "height": "200") }}
                            `,
                              showConfirmButton: true,
                          });
                          break;
                      case -1:
                             swalalert('Aviso',res['mensaje'], "warning", 0);
                          break;
                      case -2:
                            swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                      break;
                      default:  
                      break;
                }
            },
            error: function (res) {
                // console.error(res.responseText);
                Swal.close();
                alert(res.responseText);
            }
        });
    }
</script>
