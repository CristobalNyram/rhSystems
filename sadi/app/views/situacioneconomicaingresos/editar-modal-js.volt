<script type="">
    function fnEditarSituacionEconomicaIngresos(sei_id){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_editar_situacioneconomicaingresos');
      form_ocupado.reset();

      let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/ajax_get_detalle/') ?>";
                                       
                                       $.ajax({
                                          type: "POST",
                                          url: url_enviar+sei_id,
                                           success: function(res)
                                             {   
                                                                                                                       
                                               if(res[0]==2)
                                                {
                                                    $('#sei_ese_id_editar').text($('#ese_id_ese_actual').text());
                                                    $('#sei_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text()); 

                                                    $('#sei_id_editar').val(res['data'].sei_id);
                                                    $('#sei_nombre_editar').val(res['data'].sei_nombre);
                                                    $('#sei_parentesco_editar').val(res['data'].sei_parentesco);
                                                    $('#sei_sueldo_editar').val(res['data'].sei_sueldo);
                                                    $('#sei_aportacion_editar').val(res['data'].sei_aportacion);                    
                                                 
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
                                                                      alert('error en el servidor...');
                                                                                          
                                             }
                                       });

  
    }

     
    $(function (){
          $('#frm_editar_situacioneconomicaingresos').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                        if($('#sei_nombre_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el nombre.")
                            return false;
                          }
                          if($('#sei_parentesco_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el parentesco.")
                            return false;
                          }
                          if($('#sei_aportacion_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el sueldo.")
                            return false;
                          }
                          if($('#sei_aportacion_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar la aportación.")
                            return false;
                          }
                     
                     
                          
                        let formulario=$("#frm_editar_situacioneconomicaingresos");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/actualizar/') ?>";
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
                                                                                        let form_ocupado=document.getElementById('frm_editar_situacioneconomicaingresos');
                                                                                        form_ocupado.reset();
                                                                                        $('#editar-situacioneconomica-ingreso-modal').modal('hide');
                                                                                        fnRe_CargarTablaDatoSituacioneEconomicaIngresos(res['sie_id']);
                                                                                        $('#sie_totalingresos').val(res['sie_totalingresos']);
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
                                      alert('ERROR EN EL SERVIDOR');
                                      }
                            });
                            return false;

                
        });



  });
 </script>
 
 
 
 <div class="modal fade" id="editar-situacioneconomica-ingreso-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                 <i class="mdi mdi-pencil-circle"></i>Editar referencia de ingreso del estudio No. <span id="sei_ese_id_editar"></span> "<span id="sei_ese_nombre_editar"></span>"
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_editar_situacioneconomicaingresos" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                  
                  <input type="hidden" name="sei_id_editar" id="sei_id_editar">
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Nombre</label>
                     <input name="sei_nombre_editar" id="sei_nombre_editar" type="text" re class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo del familiar..." maxlength="45" />
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Parentesco</label>
                     <input name="sei_parentesco_editar" id="sei_parentesco_editar" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parentesco..."  maxlength="45"/>
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Sueldo</label>
                     <input   name="sei_sueldo_editar" id="sei_sueldo_editar" type="number" required  class="form-control input-rounded" oninput="limitDecimalPlaces(event,2)" placeholder="Sueldo ($)..."  max="999999999"/>
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Aportación</label>
                     <input   name="sei_aportacion_editar" id="sei_aportacion_editar" type="number" required  class="form-control input-rounded" oninput="limitDecimalPlaces(event,2)"  placeholder="Aportación ($)..."  max="999999999"/>
 
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
   