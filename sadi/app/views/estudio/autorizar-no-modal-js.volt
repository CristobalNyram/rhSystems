<script >

    function fnnoaprobarESE(id_ESE)
    {
      var id_ese=document.getElementById('ese_idnoaprobar');
      id_ese.value=id_ESE;

      url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+id_ESE,
            success: function(res)
            {

              if(res[0].ese_estatus=='-2' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS (CANCELADO)',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
              }  
             if(res[0].ese_estatus!='6' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS #estatus_6 ',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
            }  

              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                $('#noaprobar_titulo_ese_id').html(`<i class="mdi mdi-close-box-outline mdi-24px btn-icon" style="color: red;"></i> No aprobar ESE  con folio `+id_ESE+mensaje_empresa_candidato);

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
        $("#form_noaprobar_estudio").submit(function(event) 
                {
                var $form = $(this);
                event.preventDefault();
                var $comentario_validar= document.getElementById('com_comentarionoaprobar').value;
                if(validar_commentario($comentario_validar))
                { 
                    var urled="<?php echo $this->url->get('estudio/noaprobarese/') ?>";
                    $form.find("button").prop("disabled", true);
                    $.ajax({
                    type: "POST",
                    url: urled,
                    data: $("#form_noaprobar_estudio").serialize(),
                    success: function(res)
                    {        
                        if(res[0]==2)
                        {
                     
                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                .then((value) => {
                                     location.reload();  

                                });
                        }
                        else
                        {
    
                          Swal.fire({title:res['Error'],text:res['mensaje'],type:"error"})
                                  .then((value) => {
                                      location.reload();  

                                  });
                        }
                    },
                    error: function(res)
                    { 
                    
                    }
                    });
                }
                else
                {
                    alertify.alert('Error','Para poder no aprobar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');
                }
                });
    });

</script>

<div class="modal fade" id="noaprobar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel"> 
        <div id="noaprobar_titulo_ese_id"></div> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_noaprobar_estudio" class="form-vertical mt-1">
            <div class="form-group row">

          
              <div class="row col-lg-12">
                <input type="hidden" id="ese_idnoaprobar" name="ese_idnoaprobar" value="">            
                <div class="row  col-12  ml-3">
                  <label class="col-form-label title-busq">Agregue un comentario  </label>
                  <label class="col-form-label title-busq" id="label_com_comentarionoaprobar"></label>

                  <textarea placeholder="Agrega tu comentario..." id="com_comentarionoaprobar" name="com_comentarionoaprobar" class="col-12 md-textarea form-control " style="min-height:100px" rows="3" maxlength="2000" oninput="handleInput(event)" onkeyup="actualizaInfo(2000,'com_comentarionoaprobar', 'label_com_comentarionoaprobar')"></textarea>
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

