<script>
  function asignarAutorizadoTransporteAInvesigador(ese_id,inv_id,nombre_investigador)
  {
    $('#asignar_transporte_modal_ese_id').text('');
    $('#asignar_transporte_modal_ese_id').text(ese_id);
    $('#asignar_transporte_nombre_investigador').text('');
    $('#asignar_transporte_nombre_investigador').text(nombre_investigador);

    $('#asignar_transporte_ese_id').val(ese_id);
    $('#asignar_transporte_inv_id').val(inv_id);
  } 
  
  $(function (){
    $('#frm_asignar_solo_el_transporte').submit(function (event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
          return false;
      }
      event.preventDefault();

      let formulario=$("#frm_asignar_solo_el_transporte");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('transporte/ajax_asignarautorizado_transporte/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: formulario.serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {

                $form.find("button").prop("disabled", false);
                location.reload();
            })
          }
          if(res[0]==-1)
          {
            Swal.fire({title:res['titular'],html:`<span class='text-warning'>${res['mensaje']}</span>`,
            imageUrl:'https://cdn-icons-png.flaticon.com/512/1048/1048339.png',
            imageWidth: 200,
            imageHeight: 200,
            imageAlt: res['titular'],
          })
            .then((value) => {
                location.reload();  
                });
          }
          if(res[0]==-2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
            .then((value) => {
                location.reload();  
                });
          }
        },
        error: function(res)
        {
          alert(  'ERROR EN SERVIDOR');
        }
      });
      return false;
    });
  });
        
</script>
  
<div class="modal fade" id="asignarautorizado_transporte-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog detalle modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5><div id="msae_agregar_familiar_candidato">
          <i class="mdi mdi-account-cash-outline" style="color:green;"></i> Asignar transporte al estudio No. <span id="asignar_transporte_modal_ese_id"></span> 
        </div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_asignar_solo_el_transporte" class="form-vertical mt-1"  method="post">
          <input type="hidden" id="asignar_transporte_inv_id" name="asignar_transporte[inv_id]" >
          <input type="hidden" id="asignar_transporte_ese_id" name="asignar_transporte[ese_id]" >
          <div class="col-lg-12">
            <label class="col-form-label title-busq" for="tra_preaprobado__solicitar">Monto autorizado que desea asignar al investigador  <u><span id="asignar_transporte_nombre_investigador" class="underline " > </span></u></label>
            <input type="number" class="form-control  input-rounded"  name="asignar_transporte[pre_aprobado]" id="asignar_transporte_pre_aprobado" placeholder="$00.000"  oninput="limitDecimalPlaces(event,2)" required/>
          </div>
          <div class="col-lg-12">
            <label class="col-form-label title-busq" id="label_tra_comentarioadmin" for="tra_comentarioadmin">Comentario<u><span id="asignar_transporte_nombre_investigador" class="underline " > </span></u></label>
            <input type="text" class="form-control  input-rounded" id="tra_comentarioadmin" name="asignar_transporte[tra_comentarioadmin]" placeholder="Comentario" required oninput="handleInput(event)" onkeyup="actualizaInfo(500,'tra_comentarioadmin', 'label_tra_comentarioadmin')" maxlength="500"/>
          </div>
          <div class="row col-lg-12">
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="tra_preaprobado__solicitar">Origen<u><span id="asignar_transporte_nombre_investigador" class="underline " > </span></u></label>
              <input type="text" class="form-control  input-rounded"  name="asignar_transporte[tra_origen]" placeholder="Origen" required oninput="handleInput(event)" maxlength="155"/>
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="tra_preaprobado__solicitar">Destino<u><span id="asignar_transporte_nombre_investigador" class="underline " > </span></u></label>
              <input type="text" class="form-control  input-rounded"  name="asignar_transporte[tra_destino]" placeholder="Destino" required oninput="handleInput(event)" maxlength="155"/>
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="col-sm-6 col-md-6 text-center mt-5">
            </div>
            <div class="col-sm-3 col-md-3 text-center mt-5">
                <div class="form-group">
                  <button class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                </div>
            </div>
            <div class="col-sm-3 col-md-3  text-center mt-5 ">
              <div class="form-group">
                <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Asignar <i class="mdi mdi-content-save  white"></i> </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    