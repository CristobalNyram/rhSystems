<script>
        function enviarCorreoAgradecimiento_General_PREGUNTA(canId, vacId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres enviar el correo de agradecimiento?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                // Lógica para enviar el correo de agradecimiento aquí
                enviarCorreoAgradecimiento_General(canId, vacId);
            }
        });
    }

    function enviarCorreoAgradecimiento_General(can_id = 0,vac_id=0) {
        Swal.fire({
            html: `
            <h2 class="enviando-animacion">Enviado el correo...</h2>
              {{ image("assets/images/sistema/email-enviando.gif", "alt": " ", "height": "200") }}
              `,
            showConfirmButton: false,
            allowOutsideClick: false,
        });
        let url = "<?php echo $this->url->get('candidato/enviar_agradecimiento_correo/') ?>";
        $.ajax({
            type: "POST",
            url: url + can_id + `/${vac_id}`,
            success: function (res) {
                Swal.close();
                   switch (res['estado']) {
                      case 2:
                          Swal.fire({
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
                console.error(res.responseText);
                Swal.close();
                alert(res.responseText);
            }
        });
    }
    function enviarWhatsAppAgradecimiento_General(can_id = 0, vac_id = 0) {
      let url = "<?php echo $this->url->get('candidato/enviar_agradecimiento_whats/') ?>";
      Swal.fire({
          title: 'Generando mensaje',
          showConfirmButton: false,
          allowOutsideClick: false,
      });

      $.ajax({
          type: "POST",
          url: url + can_id + `/${vac_id}`,
          success: function (res) {
              Swal.close();
              let numeroTelefono = res.numero_telefono;
              let mensaje = encodeURIComponent(res.mensaje_link);
              let mensajeCopy = (res.mensaje_link);

              Swal.fire({
                  title: 'Éxito',
                  icon: 'success',
                  html: `
                      <p>Se generó un link de WhatsApp</p>
                      <p>El número es: <span id="numero_link_whatsapp_general" >${res.numero_telefono}</span></p>
                      <span id="mensaje_link_whatsapp_general" hidden >${mensajeCopy}</span>
                      <span id="numero_mensaje_link_whatsapp_general" hidden >${res.numero_telefono} \n  \n  \n   ${mensajeCopy}</span>
                      <button class="btn btn-info" onclick="fnCopiarPortapapeles('numero_link_whatsapp_general','número celular/teléfono')">Copiar número</button>
                      <button class="btn btn-info" onclick="fnCopiarPortapapeles('mensaje_link_whatsapp_general','mensaje candidato')">Copiar mensaje</button>
                    <br>
                      <button class="btn btn-info mt-2" onclick="fnCopiarPortapapeles('numero_mensaje_link_whatsapp_general','Copiar ambos')">Copiar número y mensaje</button>

                `,
                  showConfirmButton: true,
              });

           
              let url = "https://api.whatsapp.com/send?phone=" + numeroTelefono + "&text=" + mensaje;
              window.open(url, "_blank");
          },
          error: function (res) {
              Swal.close();
              alert(res.responseText);
              console.error(res);
          }
      });
    }

    function fnPreguntarEnviarAgradecimiento(can_id,vac_id){
        let tempalte_no_cotinua=`
                    
                      <div class="container">
                        <div class="row mt-3">
                          <div class="col-md-6">
                            <button type="button" class="btn btn-success btn-block" title="Enviar WhatsApp de agradecimiento" onclick="enviarWhatsAppAgradecimiento_General(${can_id},${vac_id})">Enviar WhatsApp de agradecimiento</button>
                          </div>
                          <div class="col-md-6">
                            <button type="button" class="btn btn-info btn-block" title="Enviar correo de agradecimiento" onclick="enviarCorreoAgradecimiento_General_PREGUNTA(${can_id},${vac_id})">Enviar Correo de agradecimiento</button>
                          </div>
                        </div>
                      </div>
                      `;
        swalalertHTML('Enviar mensaje de agradecimiento',tempalte_no_cotinua, 0);

    }
</script>