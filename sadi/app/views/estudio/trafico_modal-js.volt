<script type="text/javascript">
	function fnmandarESEtrafico(id_ESE,id_TRA)
	  {
	    let id_ese=document.getElementById('ese_idmandar');
	    let id_tra=document.getElementById('tra_idmandar');
	    id_tra.value=id_TRA
	    id_ese.value=id_ESE;

      let url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+id_ESE,
            success: function(res)
            {
              if(res[0].ese_estatus!='2' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });
              }  

              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                $('#titulotrafico').html(`<i class="mdi mdi-send-check  mdi-24px btn-icon" style="color: green;"></i> Mandar ESE Folio `+id_ESE+mensaje_empresa_candidato);

               
              }
              //alert();
            
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              
            }
          });

	  }

	$(document).ready(function() {
		$("#form_mandar_trafico_estudio").submit(function(event) 
        {
          var $form = $(this);
          event.preventDefault();
          // var $comentario_validar= document.getElementById('com_comentariomandar').value;
          // if(validar_commentario($comentario_validar))
          // { 
            var urled="<?php echo $this->url->get('estudio/investigadormandarese/') ?>";
             $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled,
              data: $("#form_mandar_trafico_estudio").serialize(),
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
          // }
          // else
          // {
          //   alertify.alert('Error','Para poder asignar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');
          // }
        });
	});
</script>

<div class="modal fade" id="trafico_mandar-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id=""><span id="titulotrafico"> </span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_mandar_trafico_estudio" class="form-vertical mt-1">
            <div class="form-group row">
              <div class="col-lg-10">
                <input type="hidden" id="tra_idmandar" name="tra_idmandar" value="">            
                <input type="hidden" id="ese_idmandar" name="ese_idmandar" value="">            
                <div class="row ml-3">
                  <label class="col-form-label title-busq">Agregue un comentario</label>
                  <textarea maxlength="1500" placeholder="Agrega tu comentario..." id="com_comentariomandar" name="com_comentariomandar" class="form-control-textarea text_area_a" oninput="handleInput(event)" onkeyup="actualizaInfo(1500,'com_comentariomandar', 'com_comentariomandar-label')"></textarea>
                  <label  id="com_comentariomandar-label" for="com_comentariomandar" class="col-form-label title-busq ml-2"></label>

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