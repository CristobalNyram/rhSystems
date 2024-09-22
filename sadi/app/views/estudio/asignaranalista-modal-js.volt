  <script>

    
  $(document).ready(function(){
    function validar_commentario(comentario)
        {
          var res;
          if(comentario.trim()=='' ||(comentario.length<6))
            {
              res=false;
            }
            else
            {
              res=true;
            }
          return res;
        }


        

        $("#form_asignar_analista_estudio").submit(function(event) 
          {
         

            var $form = $(this);
            event.preventDefault();
            // var $comentario_validar= $form[0][2].value;

            // if(validar_commentario($comentario_validar))
            // { 
              var urled="<?php echo $this->url->get('estudio/ajax_setasignaranalista/') ?>";
              $form.find("button").prop("disabled", true);
              $.ajax({
              type: "POST",
              url: urled,
              data: $("#form_asignar_analista_estudio").serialize(),
              success: function(res)
              {

             
                if(res[0]=='2')
                {
                  
          
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                        .then((value) => {
                                                                  location.reload();  

                                        });
                  

                }
                if(res[0]=='-1')
                {
                  
          
                   Swal.fire({title:res['titular'],html:`<strong class='text-danger'>${res['mensaje']}</strong> `,type:"warning"})
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
                // console.log(res);
            


              },
              error: function(res)
              { 
           
              
                   Swal.fire({title:"Error",text:"Errores al procesar tu petición",type:"error"})
                                                                 .then((value) => {
                                                                  location.reload();  

                                                                     });
                  
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
  
  <div class="modal fade" id="asignar_analista_estudio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="titulotraficoanalista">Asignar analista a ESE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_asignar_analista_estudio" class="form-vertical mt-1">
            <div class="form-group row">
              <div class="col-lg-10">
                <input type="number" id="ese_id" name="ese_id" value="" style="display:none;">
                <div class="row ml-3">
                  <label class="col-form-label title-busq">Analista</label>
                  <select name="ana_id" id="ana_id" class="form-control select2-single" data-toggle="select2" data-placeholder="Seleccionar ...">
                    <optgroup>
                    <option   value="1" >Formato 1</option>
                    </optgroup>
                  </select>
                </div>
                <div class="row ml-3">
                  <label class="col-form-label title-busq">Agregue un comentario</label>
                  <label  id="com_comentario-label" for="com_comentario" class="col-form-label title-busq ml-2"></label>

                  <textarea placeholder="Agrega tu comentario..." id="com_comentario" name="com_comentario" class="form-control-textarea text_area_a" maxlength="1500"  onkeyup="actualizaInfo(1500,'com_comentario', 'com_comentario-label')"  oninput="handleInput(event)"></textarea>
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