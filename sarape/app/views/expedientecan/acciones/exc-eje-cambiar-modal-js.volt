
<script>
  let __EXC_ID_EJE_EDITAR=0;
  let __CALLBACK_REOLAD_TABLE_EJE_ID_EDITAR_EXC=0;
   function fnEditarEjeIdPerteneciente(exc_id = 0, callback_table = 0) {
    __EXC_ID_EJE_EDITAR = exc_id;
    __CALLBACK_REOLAD_TABLE_EJE_ID_EDITAR_EXC = callback_table;
    $('#form_editar_eje_propietario')[0].reset(); // Reinicia el formulario
    fnGetDetalleExc(exc_id)
        .then(function (res) {
            try {
                let data = res.data;
                let input_select_eje=$('#eje_id-editar_eje_propietario');
                let mensaje=` del expediente folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);
                $("#editar_eje_propietario-titulo").html(mensaje);
                $("#eje_id_actual-editar_eje_propietario").val(data.eje_exc_nombre);
                
                fnejecutivos_adaptable(input_select_eje, eje_select_id = data.eje_idprincipal,excluir=1);
                             
                // Aquí puedes realizar las operaciones adicionales con los datos obtenidos.
            } catch (error) {
                console.log(error);
            }
        })
        .catch(function (error) {
            alert(error.responseText);
            console.log(error);
        });
    }

  $(document).ready(()=>{
		$("#form_editar_eje_propietario").submit(function(event) 
        {
            event.preventDefault();
            let $form = $(this);
            let selectsAValidar = [
              { id: "#eje_id-editar_eje_propietario", name: "EJECUTIVO" },
            ];
            let valoresPosiblesNoAceptados = ["0",'-1', "-2"];
            let isValidSelects = validarSelects(selectsAValidar, valoresPosiblesNoAceptados);
            if (!isValidSelects) {
                return false;
            }
            let urled="<?php echo $this->url->get('expedientecan/cambiar_ejecutivo/') ?>";
             $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+__EXC_ID_EJE_EDITAR,
              data: $form.serialize(),
              success: function(res)
              {   

                switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                  
                      if (__CALLBACK_REOLAD_TABLE_EJE_ID_EDITAR_EXC !== 0 && res && res['vac_id'] !== undefined && res['vac_id'] !== null && res['vac_id'].trim() !== '') {
                        __CALLBACK_REOLAD_TABLE_EJE_ID_EDITAR_EXC(res['vac_id']);
                      }else{
                        window.location.reload();
                      }
                      $('#editar_eje_propietario-modal').modal('hide');
                      $form.find("button").prop("disabled", false);
                    break;
                    case -1:
                      swalalert('Aviso',res['mensaje'], "warning", 0);
                      $form.find("button").prop("disabled", false);
                    break;
                    case -2:
                    swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                    $form.find("button").prop("disabled", false);
                    break;
                    default:
                    break;
                  }

              },
              error: function(res)
              { 
                alert(res.responseText);
              }
            });
          
        });
  });
</script>

{{  modal.crear("Cambiar ejecutivo del expediente <span id='editar_eje_propietario-titulo'><span>", "form_editar_eje_propietario","editar_eje_propietario-modal",
[
  {"tamanio":"6","leyenda":"EJECUTIVO ACTUAL","id":"eje_id_actual-editar_eje_propietario","name":"eje_id_actual","tipo":"text","required":"required","complemento":'readonly' },
  {"tamanio":"6","leyenda":"EJECUTIVO","id":"eje_id-editar_eje_propietario","name":"eje_id","tipo":"select","required":"required"},
  {"tamanio":"12","leyenda":"COMENTARIO","id":"com_comentario-editar_eje_propietario","name":"com_comentario","tipo":"textarea","required":"required","complemento":'style="min-height:100px"'}
]
)
}}