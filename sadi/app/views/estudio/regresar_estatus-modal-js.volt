
<script>
   
   function fn_llenar_regresar_estatus_Modal(ese_id,ese_estatus)
          {
          let titulo_modal=$('#estatus__regresar_estatus_titulo');
          let ese_id_modal=$('#ese_id_regresar_estatus');
          
          ese_id_modal.val(ese_id);
          titulo_modal.html('');
       
          url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

          $.ajax({
              type: "POST",
              url: url_enviar_ese_data+ese_id,
              success: function(res)
              {

                let ese_data=res[0];
                if(ese_data.ese_estatus=='6'){
                $('#com_comentario__regresar_estatus').prop('required', true);

                }else{
                  $('#com_comentario__regresar_estatus').prop('required', false);

                }

                if(res.length>0){
                  let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                  titulo_modal.html(`<i class="mdi mdi-comment-arrow-left  mdi-24px btn-icon"></i>Regresar a estatus ${ese_estatus} el estudio: #${ese_id} ${mensaje_empresa_candidato}`);

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
  $(document).ready(()=>{
        

        $('#form_estatus__regresar_estatus').submit((event)=>{

          let $form=$('#form_estatus__regresar_estatus');

          event.preventDefault();
          $form.find("button").prop("disabled", true);
          let url="<?php echo $this->url->get('estudio/regresar_estatus/') ?>";

            
                  $.ajax({
                    type: "POST",
                    url: url,
                    data: $form.serialize(),
                    success: function(res)
                    {
                    //  console.log(res);
                     if(res[0]=='2')
                      {
                 

                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                  .then((value) => {
                                     location.reload();  

                                 });
                      }
                      else if(res[0]=='1')
                      {
                 

                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
                                  .then((value) => {
                                    $form.find("button").prop("disabled", false); 

                                 });
                      }
                      //errores
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
                      alert('ERROR');
                      // console.log(res.responseText);
                      $form.find("button").prop("disabled", false); 
                    }
                  });
               
            
          });
  });
 




</script>

<div class="modal fade" id="regresar_estatus-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="estatus__regresar_estatus_titulo">
          
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_estatus__regresar_estatus" class="form-vertical mt-1">
            <div class="col-12 ">
              <div class="col-lg-12">
                <input type="hidden" id="ese_id_regresar_estatus" name="ese_id_regresar_estatus" value="">            
                <div class="row">
                  <label class="col-form-label title-busq">Agregue un comentario</label>
                  <textarea placeholder="Agregar un comentario que explique por qué está regresando este estudio..." maxlength="300" onkeyup="actualizaInfo(300,'com_comentario__regresar_estatus', 'label_com_comentario_regresar_estatus')" oninput="handleInput(event)" id="com_comentario__regresar_estatus" name="com_comentario__regresar_estatus" class="form-control-textarea text_area_a" style="min-height:90px" rows="3" ></textarea>
                  <label id="label_com_comentario_regresar_estatus" class="col-form-label title-busq"></label>

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
                      <button class="btn-dark btn-rounded btn btn-buscar">Aceptar <i class="mdi mdi-chevron-right white"></i> </button>
                    </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>