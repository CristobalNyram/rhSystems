<script type="">
   function fnCrearPeriodoInactivo_formato_gabencognv(){
    // $('#agd_agf_id').val($('#agf_id').val());
     $('#per_ese_id_crear_formato_gabencognv').text($('#ese_id_ese_actual_formato_gabencognv').text());
     $('#per_ese_nombre_crear_formato_gabencognv').text($('#ese_nombrecompleto_actual_formato_gabencognv').text()); 

     $('#per_sel_id_formato_gabencognv').val($('#sel_id_formato_gabencognv').val());
     let form_ocupado=document.getElementById('frm_crear_periodoinactivo_formato_gabencognv');
                                          form_ocupado.reset();
    }
    
    $(function (){
      $('#frm_crear_periodoinactivo_formato_gabencognv').submit(function(event) {
        let $form = $(this);
        a=$form.valid();
        if(a==false){
            return false;
        }
        $form.find("button").prop("disabled", true);
        let url_enviar="<?php echo $this->url->get('periodoinactivo/crear/') ?>";
        $.ajax({
          type: "POST",
          url: url_enviar,
          data: $('#frm_crear_periodoinactivo_formato_gabencognv').serialize(),
          success: function(res)
          {
            if(res[0]==2)
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
                $form.find("button").prop("disabled", false);

              let form_ocupado=document.getElementById('frm_crear_periodoinactivo');
              form_ocupado.reset();
              
              $('#agregar-periodoinactivo_formato_gabencognv-modal').modal('hide');
              fnCargarTablaDatoPeriodoInactivo_formato_gabencognv(res['sel_id']);
              });
            }
          else
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
            .then((value) => {
              location.reload();  
            });
          }
          },
          error: function(res)
          { 
            alert('error en el servidor...');
          }
        });
        return false;
      });
    });
</script>

<div class="modal fade" id="agregar-periodoinactivo_formato_gabencognv-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar un periodo de inactividad al estudio No. <span id="per_ese_id_crear_formato_gabencognv"></span> "<span id="per_ese_nombre_crear_formato_gabencognv"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_periodoinactivo_formato_gabencognv" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="per_sel_id_formato_gabencognv" name="per_sel_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo</label>
                    <input name="per_motivo_crear" id="per_motivo_crear_formato_gabencognv" type="text" class="form-control input-rounded" required oninput="handleInput(event)" placeholder="Motivo..." maxlength="65" />
                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tiempo</label>
                    <input name="per_fecha_crear" id="per_fecha_crear_formato_gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
                  </div>
                  <div class="row col-lg-12">
                    <div class="col-sm-6 col-md-6 text-center mt-5">
                    </div>
                    <div class="col-sm-3 col-md-3 text-center mt-5">
                        <div class="form-group">
                          <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3  text-center mt-5 ">
                        <div class="form-group">
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar  <i class="mdi mdi-content-save white"></i></button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          <!-- </div>
        </div> -->
      </div>
    </div>
  </div>
  