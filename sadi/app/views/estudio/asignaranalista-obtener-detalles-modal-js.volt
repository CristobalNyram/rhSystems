<script>
    function fnDetallesDeAnalistaAsignado(ese_id){
      $("#titulo_obtener_detalles_analista_asignado").html(`            
      <i class="mdi mdi-worker mdi-18px btn-icon" style="color:#0074BF"></i> 
        Detalles de analista asignado al estudio : `+ese_id);

        let url ="<?php echo $this->url->get('estudio/ajax_get_detalles_analista_asignado/') ?>";
        $.ajax({
              type: "POST",
              url: url+ese_id,
              success: function(data)
              {

                $('#ese_analista_obtener_detalles_asignar_analista').val(data['data'][0].analista);
                $('#ese_analista_fecha_asignacion_obtener_detalles_asignar_analista').val(data['data'][0].ese_fechaasiganalista);
                 

              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              }
          });


    }
</script>


  
<div class="modal fade" id="obtener_detalles_asignar_analista-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-semi-chico modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="titulo_obtener_detalles_analista_asignado">

             <span id="titulo_ese_id_obtener_detalles_analista_asignado"> </span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-lg-12">
            <label class="col-form-label title-busq">Analista</label>
            <input  disabled id="ese_analista_obtener_detalles_asignar_analista" name="ese_analista_obtener_detalles_asignar_analista" type="text" class="form-control input-rounded-disabled" placeholder="Nombre analsta..." oninput="handleInput(event)" maxlength="150"/>
          </div>
          <div class="col-lg-12" >
            <label class="col-form-label title-busq">Fecha de asignación</label>
            <input  disabled id="ese_analista_fecha_asignacion_obtener_detalles_asignar_analista" name="ese_analista_fecha_asignacion_obtener_detalles_asignar_analista" type="text" class="form-control input-rounded-disabled" placeholder="Fecha asignación analista..." oninput="handleInput(event)" maxlength="150"/>
          </div>
        </div>
      </div>
    </div>
  </div>

