<script type="text/javascript">
  function fnestadostransporte(pre=0){
    // console.log('entra');
    let ruta="<?php echo $this->url->get('estado/ajax_estados/') ?>";
    let $subs = $('select[name="est_idorigen"]');
    let $subs2 = $('select[name="est_iddestino"]');

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
            if(pre==0){
              options += '<option selected value="-1">Seleccionar...</option>';
            }
            $.each(data, function (key, est) {
                if(est.est_id==pre){
                  options += '<option selected value="' + est.est_id + '">' + est.est_nombre + '</option>';
                }
                else
                  options += '<option value="' + est.est_id + '">' + est.est_nombre + '</option>';
            });

            return options;
          });
          $subs2.append(function () {
            var options = '';
            if(pre==0){
              options += '<option selected value="-1">Seleccionar...</option>';
            }
            $.each(data, function (key, est) {
                if(est.est_id==pre){
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

  $(document).ready(()=>{
    $("#form_transporte_solicitar").submit(function(event){
      if($("#est_idorigen").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el estado origen.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#mun_idorigen").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el municipio origen.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#est_iddestino").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el estado destino.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      if($("#mun_iddestino").val()==-1){
        Swal.fire({title:"Error",text:"Debe seleccionar el municipio destino.",type:"error"})
                  .then((value) => {
        });
        return false;
      }
      let $form =$(this);
      event.preventDefault();     
      $form.find("button").prop("disabled", true);
      var urled="<?php echo $this->url->get('transporte/ajax_nuevo_comprobar_transporte_investigador/') ?>";

      $.ajax({
        type: "POST",
        url: urled,
        data: $("#form_transporte_solicitar").serialize(),
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
          }else if (res[0]=='-1') {
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
         alert('Error la conexión');
        }
      });
      }
    );
  });

  function fn_solicitar_transporte_llenar_modal(tra_id,tra_preaprobado,ese_id)
  { 
    let form=document.getElementById('form_transporte_solicitar');
    form.reset();
    // $('#tra_preaprobado__solicitar').val(tra_preaprobado);
        $('#tra_id__solicitar').val(tra_id);
        inputBoton=` <a data-toggle="modal" title="Ver archivos"  data-container="body" data-toggle="popover" role="button" class="bg-custom" data-target="#archivos-transporte-modal" onclick="fn_archivo_transporte_tabla_modal(${tra_id},${ese_id});">
        <i class=" mdi mdi-folder-open-outline mdi-36px " ></i>
        </a>`;
        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+ese_id,
            success: function(res)
            {
              // console.log(sres);
              if(res.length>0){
                let data=res[0];
                let ese_est_id = data.est_id;
                let ese_mun_id = data.mun_id;
                let inv_est_id = data.inv_est_id;
                let inv_mun_id = data.inv_mun_id;

                ese_est_id = validarVariableDeOptionSelect(ese_est_id) ? ese_est_id : "-1";
                ese_mun_id = validarVariableDeOptionSelect(ese_mun_id) ? ese_mun_id : "-1";
                inv_est_id = validarVariableDeOptionSelect(inv_est_id) ? inv_est_id : "-1";
                inv_mun_id = validarVariableDeOptionSelect(inv_mun_id) ? inv_mun_id : "-1";
                ///select estudio inicio 
                fnestados_estados_adaptable(ese_est_id,$('#est_iddestino'));
                fnmunicipios_adaptable($('#mun_iddestino'),ese_est_id,ese_mun_id,"Selecciona un estado");
                ///select estudiios fin 

                ///select inv fin 
                fnestados_estados_adaptable(inv_est_id,$('#est_idorigen'));
                fnmunicipios_adaptable($('#mun_idorigen'),inv_est_id,inv_mun_id,"Selecciona un estado");
                ///select inv fin

                // validarVariableDeOptionSelect
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                $('#tra_solicitar_titulo_ese_id').html(ese_id+mensaje_empresa_candidato);
              }else{

              }
              //alert();
            
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              
            }
          });




    $('#AquiBotonesDeSolicitarTranporte').empty();
    $('#AquiBotonesDeSolicitarTranporte').append(inputBoton);
    let url_enviar="<?php echo $this->url->get('transporte/ajax_get_detalle/') ?>";
    let tra_com_admin=document.getElementById('tra_comentario_admin');
    $.ajax({
      type: "POST",
      url: url_enviar+tra_id,
      success: function(res)
      {

        if(res[0]==2)
        {

            if(res['data'].tra_estatus!='1'){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'TRANSPORTE YA SE HA ENVIADO  PARA SOLICITUD',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });

            }  
            if(res['data'].tra_solicitado!=null){
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
          tra_com_admin.value=res['data'].tra_comentarioadmin;
          $('#tra_preaprobado__solicitar').val(res['data'].tra_preaprobado);
          //fnestadostransporte(0);

        }
        else
        {
          Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
          .then((value) => {
           location.reload();
        // console.log(res);  
          });
        }
      },
      error: function(res)
      { 
        alert('error en el servidor...');

      }
    });  
  }

  

  function fnmunicipios(estado, pre){//recibe id de empresa y el centro de costo 
    var ruta="<?php echo $this->url->get('municipio/ajax_municipios/') ?>";
    var $subs = $('select[name="mun_ideditarver"]');
    $.ajax({
      type: "POST",
      url: ruta+estado,
      success: function(data)
      {
        $subs.empty();
        if (data.length > 0) {
          $subs.append(function () {
            var options = '';
            if(pre==0){
              options += '<option selected value="-1">Seleccionar...</option>';
            }
            $.each(data, function (key, mun) {
                if(mun.mun_id==pre){
                  options += '<option selected value="' + mun.mun_id + '">' +mun.mun_nombre + '</option>';
                }
                else
                  options += '<option value="' + mun.mun_id + '">' + mun.mun_nombre + '</option>';
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
        }
      },
      error: function(res)
      {
      }
    });
  }
</script>

<script>   
  function fn_solicitar_transporte(traId){
    let titulo='<h5>Enviar solicitud de transporte </h5> ';
    let contenido_mensaje=`<center class="h6 text-color-sistema"> <i class="mdi mdi-file-send  mdi-48px white"></i><center><br> <center>¿Estás seguro de enviar solicitud de transporte? <br>NO PODRÁS CAMBIAR LOS DATOS DESPUÉS</center>`;
    let btn_solicitar="<b>Solicitar</b>"
    alertify.confirm(titulo, contenido_mensaje, 
      function(){
        alertify.alert('Cancelado','Solicitud cancelada')

      }, 
      function(){
                    //en caso de que si
        let url_enviar="<?php echo $this->url->get('transporte/ajax_solicitar_tranpsorte_investigador/') ?>";
                  // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: url_enviar,
          data: {tran_id:traId},
          success: function(res)
          {
            if(res[0]==2)
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
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
            alert('Error en el servidor...');
          }
        });

      }
      ).set('labels', {ok:'Cancelar', cancel:'<b> Enviar</b>'});
  }

  function fnchangeestadotransporte(tipo){
    if(tipo==1){
      var estadoselect = $("#est_idorigen").val();
      fnmunicipios_adaptable($('#mun_idorigen'),estadoselect,0);
    }
    if(tipo==2){
      var estadoselect = $("#est_iddestino").val();
      fnmunicipios_adaptable($('#mun_iddestino'),estadoselect,0);
    }
  }
</script>

<div class="modal fade" id="modal-tra_solicitar" tabindex="-1" aria-labelledby="modal-tra_solicitar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel"> <i class="mdi mdi-information blue"></i> Información de transporte <i class="mdi mdi-car"></i> <br> del estudio No. <span id="tra_solicitar_titulo_ese_id"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form_transporte_solicitar">
          <div class="form-group row mt-2">
            <div class="col-lg-2">
              <input type="hidden" name="tra_id__solicitar" id="tra_id__solicitar" >
              <label class="col-form-label title-busq" for="tra_preaprobado__solicitar">Monto pre aprobado</label>
              <input type="number" class="form-control  input-rounded-disabled" disabled name="tra_preaprobado__solicitar" id="tra_preaprobado__solicitar" placeholder="" />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="tra_solicitado__solicitar">Monto solicitado</label>
              <input type="number" class="form-control input-rounded" placeholder="$..."  required name="tra_solicitado__solicitar"  step="0.01" id="tra_solicitado__solicitar" min="0" oninput="limitDecimalPlaces(event,2)"/>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Estado origen</label>
              <select onchange="fnchangeestadotransporte(1);" name="est_idorigen" id="est_idorigen" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Municipio origen</label>
              <select name="mun_idorigen" id="mun_idorigen" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option value="-1" >Seleccione un estado</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Estado destino</label>
              <select onchange="fnchangeestadotransporte(2);" name="est_iddestino" id="est_iddestino" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq">Municipio destino</label>
              <select name="mun_iddestino" id="mun_iddestino" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Seleccione un estado</option>
              </select>
            </div>
            <!-- <div class="col-lg-4">
              <label class="col-form-label title-busq" for="tra_origen__solicitar">Origen <i class="mdi mdi-map"></i></label>
              <input type="text" class="form-control input-rounded" placeholder="Origen..." required name="tra_origen__solicitar" id="tra_origen__solicitar"  oninput="handleInput(event)" />
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq" for="tra_destino__solicitar">Destino <i class="mdi mdi-map-plus"></i></label>
              <input type="text" class="form-control input-rounded" placeholder="Destino..." required name="tra_destino__solicitar" id="tra_destino__solicitar"  oninput="handleInput(event)" />
            </div> -->
            <div class=" col-lg-12">
              <label class="col-form-label title-busq" for="tra_comentario__solicitar">Comentario <i class="mdi  mdi-comment-text" id="comenlabelsolicita"></i></label>
              <textarea type="text" class="form-control-textarea text_area_a" placeholder="Comentario/Nota..." required name="tra_comentario__solicitar" id="tra_comentario__solicitar"  oninput="handleInput(event)" onkeyup="actualizaInfo(300,'tra_comentario__solicitar', 'comenlabelsolicita')" maxlength="300"></textarea>
            </div>
            <div class=" col-lg-12">
              <label class="col-form-label title-busq" for="tra_comentario__solicitar">Comentario de administrador<i class="mdi  mdi-comment-text"></i></label>
              <textarea type="text" class="form-control-textarea text_area_a input-rounded-disabled" disabled placeholder="Comentario/Nota..." required name="tra_comentario_admin" id="tra_comentario_admin"  oninput="handleInput(event)"></textarea>
            </div>
          </div>
          <div class="container d-flex justify-content-end" id="AquiBotonesDeSolicitarTranporte">
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
                <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save  white"></i> </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>