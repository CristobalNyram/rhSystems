<script>
  function fnestadostransporteeditar(preorigen=0, predestino=0){
    let ruta="<?php echo $this->url->get('estado/ajax_estados/') ?>";
    let $subs = $('select[name="est_idorigen_editar"]');
    let $subs2 = $('select[name="est_iddestino_editar"]');

    $.ajax({
      type: "POST",
      url: ruta,
      success: function(data)
      {
        $subs.empty();
        $subs2.empty();
        if (data.length > 0) {
          $subs.append(function () {
            var options = '';
            if(preorigen==0){
              options += '<option selected value="-1">Seleccionar...</option>';
            }
            $.each(data, function (key, est) {
                if(est.est_id==preorigen){
                  options += '<option selected value="' + est.est_id + '">' + est.est_nombre + '</option>';
                }
                else
                  options += '<option value="' + est.est_id + '">' + est.est_nombre + '</option>';
            });

            return options;
          });
          $subs2.append(function () {
            var options = '';
            if(predestino==0){
              options += '<option selected value="-1">Seleccionar...</option>';
            }
            $.each(data, function (key, est) {
                if(est.est_id==predestino){
                  options += '<option selected value="' + est.est_id + '">' + est.est_nombre + '</option>';
                }
                else
                  options += '<option value="' + est.est_id + '">' + est.est_nombre + '</option>';
            });

            return options;
          });
        }
        else{
          $subs.append(function () {
            var options = '';
            options += '<option selected value="-1">No aplica</option>';
            return options;
          });
          $subs2.append(function () {
            var options = '';
            options += '<option selected value="-1">No aplica</option>';
            return options;
          });
        }
      },
      error: function(res)
      {
      }
    });
  }

  function fn_solicitar_editar(tra_id)
  {
    let tra_id__editar=document.getElementById('tra_id__editar');
    let tra_preaprobado__editar=document.getElementById('tra_preaprobado__editar');
    let tra_solicitado__editar=document.getElementById('tra_solicitado__editar');
    // let tra_origen__editar=document.getElementById('tra_origen__editar');
    // let tra_destino__editar=document.getElementById('tra_destino__editar');
    let tra_com__editar=document.getElementById('tra_comentario__editar');
    let tra_com_admin=document.getElementById('tra_comentario_admin');
    let url_enviar="<?php echo $this->url->get('transporte/ajax_get_detalle/') ?>";
    $.ajax({
      type: "POST",
      url: url_enviar+tra_id,
      success: function(res)
      {
        if(res[0]=='2')
        {
          if(res['data'].tra_estatus!='1' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'TRANSPORTE YA SE HA SOLICITADO ANTERIORMENTE',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });


            }

            if(res['data_ese'].ese_estatus!='2' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });
            }  

          tra_com__editar.value=res['data'].tra_comentario;
          tra_com_admin.value=res['data'].tra_comentarioadmin;
          tra_id__editar.value=res['data'].tra_id;
          tra_preaprobado__editar.value=res['data'].tra_preaprobado;
          tra_solicitado__editar.value=res['data'].tra_solicitado;
          // tra_origen__editar.value=res['data'].tra_origen;
          // tra_destino__editar.value=res['data'].tra_destino;
          fnestadostransporteeditar(res['data'].est_idorigen, res['data'].est_iddestino);
          fnmunicipios_adaptable($('#mun_idorigen_editar'), res['data'].est_idorigen, res['data'].mun_idorigen);
          fnmunicipios_adaptable($('#mun_iddestino_editar'), res['data'].est_iddestino, res['data'].mun_iddestino);
          inputBoton=` <a data-toggle="modal" title="Ver archivos"  data-container="body" data-toggle="popover" role="button" class="bg-custom" data-target="#archivos-transporte-modal" onclick="fn_archivo_transporte_tabla_modal(${res['data'].tra_id},${res['data'].ese_id});">
          <i class=" mdi mdi-folder-open-outline mdi-36px " ></i>

          </a>`;
          $('#AquiBotonesDeEditarTranporte').empty();
          $('#AquiBotonesDeEditarTranporte').append(inputBoton);
        }
        else
        {
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
          .then((value) => {
          //  location.reload();
          });
        }
      },
      error: function(res)
      { 
        alert('error en el servidor...');
      }
    }); 
  }

  $(document).ready(()=>{
    $("#form_transporte_solicitar__editar").submit(function(event){
      if($("#est_idorigen_editar").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el estado origen.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#mun_idorigen_editar").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el municipio origen.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#est_iddestino_editar").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el estado destino.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#mun_iddestino_editar").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el municipio destino.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      let $form =$(this);
      event.preventDefault();
      $form.find("button").prop("disabled", true);
      var urled="<?php echo $this->url->get('transporte/ajax_editar_comprobar_transporte_investigador/') ?>";
      $.ajax({
        type: "POST",
        url: urled,
        data: $("#form_transporte_solicitar__editar").serialize(),
        success: function(res)
        {
          if(res[0]=='2')
          {
            let recordatorio= `<br>
            <p class="font-weight-bold text-warning">
            Recuerda adjuntar tus evidencias de transporte para después enviar tu solicitud
            </p>`;
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success",html:recordatorio})
            .then((value) => {
            location.reload();
            });
          }
          else if(res[0]=='-1'){
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
            .then((value) => {
              location.reload();
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
          // alert('ERROR');
          alert('error en la conexión');
        }
      });
    });
  });

  function fnchangeestadotransporteeditar(tipo){
    if(tipo==1){
      var estadoselect = $("#est_idorigen_editar").val();
      fnmunicipios_adaptable($('#mun_idorigen_editar'),estadoselect,0);
    }
    if(tipo==2){
      var estadoselect = $("#est_iddestino_editar").val();
      fnmunicipios_adaptable($('#mun_iddestino_editar'),estadoselect,0);
    }
  }
</script>
<div class="modal fade" id="modal-tra_solicitar-editar" tabindex="-1" aria-labelledby="modal_tra_solicitar-editar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel"> <i class="mdi mdi-pencil-circle blue"></i> Editar información transporte <i class="mdi mdi-car"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form_transporte_solicitar__editar">
          <div class="form-group row mt-2">
            <div class="col-lg-2">
              <input type="hidden" name="tra_id__editar" id="tra_id__editar" >
              <label class="col-form-label title-busq" for="tipoestudio_nombre">Monto pre aprobado</label>
              <input type="number" class="form-control  input-rounded-disabled" disabled name="tra_preaprobado__editar" id="tra_preaprobado__editar" placeholder="" />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Monto solicitado</label>
              <input type="number" class="form-control input-rounded" placeholder="$..."  step="0.01"  required name="tra_solicitado__editar" id="tra_solicitado__editar"  oninput="limitDecimalPlaces(event,2)"/>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Estado origen</label>
              <select onchange="fnchangeestadotransporteeditar(1);" name="est_idorigen_editar" id="est_idorigen_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Municipio origen</label>
              <select name="mun_idorigen_editar" id="mun_idorigen_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option value="-1" >Seleccione un estado</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Estado destino</label>
              <select onchange="fnchangeestadotransporteeditar(2);" name="est_iddestino_editar" id="est_iddestino_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Municipio destino</label>
              <select name="mun_iddestino_editar" id="mun_iddestino_editar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Seleccione un estado</option>
              </select>
            </div>
            <!-- <div class="col-lg-4">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Origen <i class="mdi mdi-map"></i></label>
              <input type="text" class="form-control input-rounded" placeholder="Origen..." required name="tra_origen__editar" id="tra_origen__editar"  oninput="handleInput(event)" />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Destino <i class="mdi mdi-map-plus"></i></label>
              <input type="text" class="form-control input-rounded" placeholder="Destino..." required name="tra_destino__editar" id="tra_destino__editar"  oninput="handleInput(event)" />
            </div>   -->
            <div class="col-lg-12">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Comentario <i class="mdi  mdi-comment-text"></i></label>
              <textarea type="text" class="form-control-textarea text_area_a" placeholder="Comentario/Nota..." required name="tra_comentario__editar" id="tra_comentario__editar"  maxlength="1600"  onkeyup="actualizaInfo(1600,'tra_comentario__editar', 'tra_comentario__editar-label')"  oninput="handleInput(event)" ></textarea>
             
              <label  id="tra_comentario__editar-label" for="tra_comentario__editar" class="col-form-label title-busq ml-2"></label>

              
            </div>
            <div class="col-lg-12">
              <label class="col-form-label title-busq" for="tra_comentario_admin">Comentario admin.<i class="mdi  mdi-comment-text"></i></label>
              <textarea type="text" class="form-control-textarea text_area_a input-rounded-disabled" disabled placeholder="Comentario/Nota..." onkeyup="actualizaInfo(1500,'tra_comentario_admin', 'tra_comentario_admin-label')" required name="tra_comentario_admin" id="tra_comentario_admin"  oninput="handleInput(event)" ></textarea>
              <label  id="tra_comentario_admin-label" for="tra_comentario_admin" class="col-form-label title-busq ml-2"></label>

            </div>
          </div>
          <div class="container d-flex justify-content-end" id="AquiBotonesDeEditarTranporte">
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
                <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar cambios <i class="mdi mdi-pencil-box white"></i> </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>