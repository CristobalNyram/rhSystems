<div class="modal fade" id="autorizar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="enviarautorizacion">Autorizar ESE </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_autorizar_estudio" class="form-vertical mt-1">
            <div class="form-group row">
              <div class="col-lg-3 ml-3" id="tip_estudio_supervivencia_visitas">
                <label class="col-form-label title-busq" for="estudio_genero">Indica el número de visitas realizadas  </label>
                <select name="ese_visita" id="ese_visita" class="form-control select2-single  " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
               
                </select>
              </div>

              <div class="row col-lg-12">
                <input type="hidden" id="ese_idautorizar" name="ese_idautorizar" value="">            
                <div class="row col-12 ml-3">
                  <label class="col-form-label title-busq">Agregue un comentario</label>
                  <label class="col-form-label title-busq" id="label_com_comentarioautorizar"></label>
                  <textarea placeholder="Agrega tu comentario..." id="com_comentarioautorizar" name="com_comentarioautorizar" class="form-control-textarea text_area_a" oninput="handleInput(event)" maxlength="2000" onkeyup="actualizaInfo(2000,'com_comentarioautorizar', 'label_com_comentarioautorizar')"></textarea>
                </div>
              </div>
              <div class="row col-lg-12">
                <div class="col-sm-6 col-md-6 text-center mt-5">
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar </a>
                  </div>
                </div>
                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                  <div class="form-group">
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                  </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>


<script>
     
  function fnautorizarESE(id_ESE,tip_id)
  {
    verificar_tipo_estudio_autorizar(tip_id);
    
    url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

      $.ajax({
          type: "POST",
          url: url_enviar_ese_data+id_ESE,
          success: function(res)
          {
            if(res[0].ese_estatus=='-2' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
              }  
             if(res[0].ese_estatus!='6' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
            }  

            if(res.length>0){
              let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

              $("#enviarautorizacion").html(`<i class="mdi mdi-send-check mdi-18px btn-icon" style="color:green;"></i>  Autorizar ESE el Folio: `+id_ESE+mensaje_empresa_candidato);

              /*let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
              $("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);
              */
            }
            //alert();
          
          },
          error: function(data)
          {
            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
            
          }
        });


    var id_ese=document.getElementById('ese_idautorizar');
    id_ese.value=id_ESE;
  }

  function enviarcorreo(id_ese, formato){
    Swal.fire({
        title: 'Enviar correo',
        text: "¿Desea enviar correo del estudio con folio "+id_ese+"?",
        type: 'warning',
        showCancelButton: true, 
        confirmButtonText: 'Si, deseo enviar el correo.',
        cancelButtonText: 'No, no deseo enviar el correo.',
      }).then((result) => {
      if(result.value)
      {

        var urlenviarese="<?php echo $this->url->get('correo/correoese/') ?>";
        $.ajax({
        type: "POST",
        url: urlenviarese+id_ese+'/'+formato,
        success: function(res)
        {
          // console.log(res);
          // console.log('hola');
          if(res[0]=="1")
          {
            Swal.fire({title:"Envio exitoso",html:'Correo enviado exitosamente',type:"success"})
              .then((value) => {
                location.reload();
              });
          }else{
            if(res[0]=='-1'){
              alertify.alert("Error",res[1]);
            }
            else
            {
              alertify.alert("Error","Ocurrio un error al enviar el correo");
            }
          }
        }
      });
      }
      else
      {
        Swal.fire({title:"La acción NO se realizó",html:'La acción NO se realizó',type:"alert"})
          .then((value) => {
            location.reload();
          });
      }
    })
  }

  function enviarcorreotruper(id_ese,formato){
    Swal.fire({
        title: 'Enviar correo',
        text: "¿Desea enviar correo del estudio con folio "+id_ese+"?",
        type: 'warning',
        showCancelButton: true, 
        confirmButtonText: 'Si, deseo enviar el correo.',
        cancelButtonText: 'No, no deseo enviar el correo.',
      }).then((result) => {
      if(result.value)
      {
         var urlenviarese="<?php echo $this->url->get('correo/correotruper/') ?>";
         $.ajax({
        type: "POST",
        url: urlenviarese+id_ese+'/'+formato,
        success: function(res)
        {
          // console.log(res);
          // console.log('hola');
          if(res[0]=="1")
          {
            Swal.fire({title:"Envio exitoso",html:'Correo enviado exitosamente',type:"success"})
              .then((value) => {
                location.reload();
              });
          }else{
            if(res[0]=='-1'){
              alertify.alert("Error",res[1]);
            }
            else
            {
              alertify.alert("Error","Ocurrio un error al enviar el correo");
            }
          }
        }
      });
      }
      else
      {
        Swal.fire({title:"La acción NO se realizó",html:'La acción NO se realizó',type:"alert"})
          .then((value) => {
            location.reload();
          });
      }
    })
  }

  $(document).ready(()=>{
    $("#form_autorizar_estudio").submit(function(event) 
    {
      var $form = $(this);
      event.preventDefault();
        var urled="<?php echo $this->url->get('estudio/autorizarese/') ?>";
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urled,
          data: $("#form_autorizar_estudio").serialize(),
          success: function(res)
          {
            if(res[0]==2)
            {
              Swal.fire({title:res['titular'],html:res['mensaje'],type:"success"})
                .then((value) => {
                  if(res['tif_id']==1 || res['tif_id']==5 || res['tif_id']==6 || res['tif_id']==7){
                    var id_ese=document.getElementById('ese_idautorizar').value;
                    enviarcorreo(id_ese, res['tif_id']);
                  }
                  else if(res['tif_id']==9 || res['tif_id']==11){
                    // if(res['tif_id']==9 || res['tif_id']==11){
                      var id_ese=document.getElementById('ese_idautorizar').value;
                      enviarcorreotruper(id_ese, res['tif_id']);
                    // }else{
                      
                    // } 
                  }
                  else{
                    location.reload();
                  }
                });
            }
            if(res[0]==-1)
            {
              Swal.fire({title:res['titular'],html:res['mensaje'], 
              imageUrl:'https://cdn-icons-png.flaticon.com/512/1048/1048339.png',
              imageWidth: 200,
              imageHeight: 200,
              imageAlt: res['titular'],
              })
                .then((value) => {
                  $form.find("button").prop("disabled", false);
                  $('#autorizar-modal').modal('hide');
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
          }
        });
    });
  });

    function verificar_tipo_estudio_autorizar(tip_id){
      switch (tip_id) {
        case '4':
          
            $('#tip_estudio_supervivencia_visitas').show();
          
          break;
      
        default:
            $('#tip_estudio_supervivencia_visitas').hide();

          break;
      }

    }



</script>