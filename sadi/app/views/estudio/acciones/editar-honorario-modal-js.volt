<script type="">
    function fnGetInfoEditarHonorarioEse(ese_id){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_editar_honorario_ese');
      form_ocupado.reset();
      $('#ese_id-editar_honorario_ese').val(ese_id);

      let url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
        $.ajax({
            type: "POST",
            url: url_enviar_ese_data+ese_id,
            success: function(res)
            {
             
              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                $('#ese_detalles-editar_honorario_ese').html(`<i class="mdi mdi-pencil  mdi-24px btn-icon" style="color: green;"></i> Editar Honorario de ESE Folio `+ese_id+mensaje_empresa_candidato);
                $('#ese_honorario_actual-editar_honorario_ese').val(res[0].ese_honorario);
                $('#ese_honorario-editar_honorario_ese').val(res[0].ese_honorario);

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
           $('#frm_editar_honorario_ese').submit(function(event){
                         let $forms = $(this);
                         a=$forms.valid();
                         if(a==false){
                             return false;
                         }
                         
                         let ese_id = $('#ese_id-editar_honorario_ese').val();
                         let formulario=$("#frm_editar_honorario_ese");
                         let $form = $(this);
                         $form.find("button").prop("disabled", true);
                         let url_enviar="<?php echo $this->url->get('estudio/ajax_honorario_actualizar/') ?>";
                                        
                         $.ajax({
                                       type: "POST",
                                       url: url_enviar+ese_id,
                                       data: formulario.serialize(),
                                       success: function(res)
                                       {   
                                        //  console.log(res);
                                           if(res[0]==2)
                                           {
               
                                               Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                             .then((value) => {
                                                               $form.find("button").prop("disabled", false);
                                                                                                                      
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
                                        // console.log(res.responseText);
                                       }
                             });
                             return false;
 
                 
         });
 
 
 
   });
 </script>
 
 
 
 <div class="modal fade" id="editar-honorario-ese-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                <span id="ese_detalles-editar_honorario_ese"></span>
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_editar_honorario_ese" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                   <input type="hidden" name="ese_id" id="ese_id-editar_honorario_ese" />
 
                   <div class="col-lg-6">
                    <label class="col-form-label title-busq">Honorario actual</label>
                    <input  readonly name="ese_honorario_actual" id="ese_honorario_actual-editar_honorario_ese" type="text" required class="form-control input-rounded-disabled"   placeholder="Honorario actual..."  maxlength="45"/>

                  </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Honorario nuevo</label>
                     <input name="ese_honorario" id="ese_honorario-editar_honorario_ese" type="number" required class="form-control input-rounded" oninput=""   placeholder="Honorario.."  />
 
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
                           <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Actualizar  <i class="mdi mdi-content-save white"></i></button>
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
   