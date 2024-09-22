
{# permisos para mostrar lista de registros inicio  #}
{% set ochentaycinco_per_lis= acceso.verificar(85,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}


<script type="">
   function fnCrearPeriodoInactivo(sel_id=0){
    // $('#agd_agf_id').val($('#agf_id').val());
     $('#per_sel_id-titulo').text(sel_id);
     $('#per_sel_id_crear').val(sel_id);
     $('#frm_crear_periodoinactivo')[0].reset(); 


    }
    
    $(function (){
      $('#frm_crear_periodoinactivo').submit(function(event) {
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
          data: $form.serialize(),
          success: function(res)
          {
               switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                      {% if ochentaycinco_per_lis==1 %}
                          fnCargarTablaDatoPeriodoInactivo(res['sel_id'])
                      {% endif %} 
                     $("#agregar-periodoinactivo-modal").modal("hide");
                      $form.find("button").prop("disabled", false);
                     
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
            alert('error en el servidor...'+res.responseText);
          }
        });
        return false;
      });
    });
</script>

<div class="modal fade" id="agregar-periodoinactivo-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="">
                <i class="mdi mdi-plus"></i>Agregar un periodo de inactividad al expediente relacioando con sección laboral No. <span id="per_sel_id-titulo"></span>
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_periodoinactivo" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="per_sel_id_crear" name="sel_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Motivo</label>
                    <input name="per_motivo" id="per_motivo_crear" type="text" class="form-control input-rounded" required oninput="handleInput(event)" placeholder="Motivo..." maxlength="65" />
                  </div>
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Tiempo</label>
                    <input name="per_fecha" id="per_fecha_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
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
  