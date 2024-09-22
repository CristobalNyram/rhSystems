{% include "/tipocatcancelado/script-ajax-todos-by-tip-id.volt" %}

<script type="text/javascript">
  function fnIdESECancelar(id_ESE)
  {
    var id_ese=document.getElementById('ese_idcancelar');
    let titulo_modal=$('#ese_id_cancelar_titulo');
    $("#preview-container-ese_cancelar").empty();
    document.getElementById("form_cancelar_estudio").reset();

    id_ese.value=id_ESE;
    url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+id_ESE,
            success: function(res)
            {
              // console.log(res);
              let data=res[0] ;
              fnGetTipoCatCanceladoByTipId(0,data.tip_id,"cac_id_ese_cancelar");

              if(res[0].ese_estatus=='-2' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });
              }  
              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                titulo_modal.html(` <i class="mdi mdi-cancel mdi-18px btn-icon" style="color: red;"></i> Cancelar el estudio No. ${id_ESE} ${mensaje_empresa_candidato}`);

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




  }
  $(function (){
    $("#form_cancelar_estudio").submit(function(event) 
    {
      event.preventDefault();
      let $form = $(this);
      let $comentario_validar= $form[0][0].value;
      let urled="<?php echo $this->url->get('estudio/cancelar/') ?>";
      let archivos = $form.find('input[type="file"]')[0].files;
      let formData = new FormData(this); // Inicializamos formData

      // console.log(archivos);
      if (archivos.length > 0) {
          // console.log(archivos);

          for (let i = 0; i < archivos.length; i++) {
              formData.append('eca_evidencia[]', archivos[i]);
          }
      } 
      // console.log(formData);

        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urled,
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData:false,
          success: function(res)
          {
            // console.log(res);
            if(res[0]=='2')
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                      .then((value) => {
                        location.reload();  
                      });
            }
            if(res[0]=='1' || res[0]=='-1')
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
                      .then((value) => {
                        $form.find("button").prop("disabled", false);
                      });

            }
            if(res[0]=='-2')
            {  
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                        .then((value) => {
                          location.reload();  
                        });
            }

          },
          error: function(res)
          { 
            Swal.fire({title:'Error',text:'Error al procesar la info.',type:"error"})
                          .then((value) => {
                             location.reload();  
                          });
          }
        });       
      // }
      // else
      // {
      //   alertify.alert('Error','Para poder cancelar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');
      // }
    });
  });

</script>

<div class="modal fade" id="cancelar_estudio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">
            <div id="ese_id_cancelar_titulo"></div></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_cancelar_estudio" class="form-vertical mt-1">
      

            <div class="row">
              <div class="col-12 col-lg-6">
                <label class="col-form-label title-busq">Motivo</label>
                <select name="cac_id" id="cac_id_ese_cancelar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                </select>
              </div>

              <div class="col-12 col-lg-6">
                <label class="col-form-label title-busq" for="eca_evidencia_ese_cancelar">Evidencia</label>
                <input 
                type="file"  
                class="form-control input-rounded" 
                id="eca_evidencia_ese_cancelar" 
                name="eca_evidencia" 
                placeholder="Evidencia." 
                accept=".jpeg, .jpg, .png, .tiff, .pdf"
                data-size-limit="1081080"
                data-file-limit="5"
                multiple
                onchange="fnValidateSizeFile(event,'preview-container-ese_cancelar');"
                />
              </div>
              <div id="preview-container-ese_cancelar" class="col-12"></div>

            </div>

            <div class="row">
              <div class="col-12">
                <label class="col-form-label title-busq ml-4 h6" for="ese_idcancelar" >Agregue un comentario</label>

                <textarea placeholder="Agrega tu comentario..." id="com_comentario-cancelar" name="com_comentario-cancelar"  class="form-control-textarea text_area_a" required  lestyle="min-height:90px" rows="3" maxlength="300" onkeyup="actualizaInfo(300,'com_comentario-cancelar', 'label_com_comentario_ese_cancelar')" oninput="handleInput(event)" ></textarea>
                <input type="hidden" id="ese_idcancelar" name="ese_idcancelar" value="" style="display:none;">
              </div>
         
            </div>
            <div class=" row">
              <div class="col-lg-12">
                <label class="col-form-label title-busq" id="label_com_comentario_ese_cancelar"></label>

              </div>
            </div>

            <div class="row col-lg-12">
              <div class="col-sm-6 col-md-6 text-center mt-5">
              </div>
              <div class="col-sm-3 col-md-3 text-center mt-5">
                  <div class="form-group">
                    <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
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