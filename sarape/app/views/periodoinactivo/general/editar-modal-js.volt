{# permisos para mostrar lista de registros inicio  #}
{% set ochentaycinco_per_lis= acceso.verificar(85,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}

<script type="">
  function fnEditarPeriodoInactivo(per_id){
    let form_ocupado=document.getElementById('frm_editar_periodoinactivo');
    form_ocupado.reset();
    let url_enviar="<?php echo $this->url->get('periodoinactivo/ajax_get_detalle/') ?>";
                                     
    $.ajax({
      type: "POST",
      url: url_enviar+per_id,
      success: function(res)
      {
        if(res[0]==2)
        {
          $('#per_ese_id_editar').text($('#ese_id_ese_actual').text());
          $('#per_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text());

          $('#per_id_editar').val(res['data'].per_id);
          $('#per_motivo_editar').val(res['data'].per_motivo);
          $('#per_fecha_editar').val(res['data'].per_fecha);
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
           alert('error en el servidor...'+res.responseText);
      }
    });
  }

  $(function (){
    $('#frm_editar_periodoinactivo').submit(function(event) {
      let $form = $(this);
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('periodoinactivo/actualizar/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: $('#frm_editar_periodoinactivo').serialize(),
        success: function(res)
        {
      
           switch (res["estado"]) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                     // fnCargarTablaCitas(res['vac_id'])
                      //$("#crear_cit_general-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                       $('#editar-periodoinactivo-modal').modal('hide');
                     {% if ochentaycinco_per_lis==1 %}
                          fnCargarTablaDatoPeriodoInactivo(res['sel_id'])
                      {% endif %}
                      break;
                  
                    case -2:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    break;
                    case -1:
                    swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning");
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
      return false;
    });
  });
 </script>

<div class="modal fade" id="editar-periodoinactivo-modal" tabindex="9999" style="z-index:99999;" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog detalle modal-dialog-scrollable" style="z-index:99999;">
    <div class="modal-content" style="z-index:99999;">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
 -->        <div class="modal-header">
            <h5><div id="">
              <i class="mdi mdi-pencil-circle"></i>Editar un periodo de inactividad del expediente No. <span id="per_ese_id_editar"></span> "<span id="per_ese_nombre_editar"></span>"
            </div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- //contenido -->
            <form id="frm_editar_periodoinactivo" class="form-vertical mt-1" novalidate method="post">
              <div class="form-group row">
                <input type="hidden" id="per_id_editar" name="per_id_editar" />

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Motivo</label>
                  <input name="per_motivo_editar" id="per_motivo_editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Motivo..." maxlength="65" />
                </div>
                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha o tiempo</label>
                  <input name="per_fecha_editar" id="per_fecha_editar" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
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
                        <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar  <i class="mdi mdi-pencil-box -save white"></i></button>
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
