<script type="">
    function fnEditarTrayectorialaboralFormatoTruper(tyl_id){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_editar_trayectorialaboral_formato_truper');
      form_ocupado.reset();
      $('#tyl_ese_id_editar-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
      $('#tyl_ese_nombre_editar-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
      $('#tyl_sel_id-formato_truper').val($('#sel_id-formato_truper').val());



        let url_enviar="<?php echo $this->url->get('trayectorialaboral/ajax_get_detalle/') ?>";

            $.ajax({
              type: "POST",
              url: url_enviar+tyl_id,
              success: function(res)
              {

                if(res['estado']=='2'){

                    let data=res.data;
                  $('#tyl_id_editar-formato_truper').val(data.tyl_id);
                  $('#tyl_empresamarca_editar-formato_truper').val(data.tyl_empresamarca);
                  $('#tyl_empresacontratante_editar-formato_truper').val(data.tyl_empresacontratante);
                  $('#tyl_periodo_editar-formato_truper').val(data.tyl_periodo);
                  $('#tyl_comentario_editar-formato_truper').val(data.tyl_comentario);

                  
                }
                else{
                  alert('El registro no esta disponible...');
                }
                
              
              },
              error: function(data)
              {
                alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              }
            });
     }



     $(function (){
           $('#frm_editar_trayectorialaboral_formato_truper').submit(function(event){
                         let $forms = $(this);
                         a=$forms.valid();
                         if(a==false){
                             return false;
                         }
                         event.preventDefault();
   
                  
                          
                      
                           
                         let formulario=$("#frm_editar_trayectorialaboral_formato_truper");
                         let $form = $(this);
                         $form.find("button").prop("disabled", true);
                         let url_enviar="<?php echo $this->url->get('trayectorialaboral/actualizar_formato_truper/') ?>";
                                        
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
                                                               let form_ocupado=document.getElementById('frm_editar_trayectorialaboral_formato_truper');
                                                               form_ocupado.reset();
 
                                                               $('#editar-trayectorialaboral-formato-truper-modal').modal('hide');
                                                               fnCargarTablaDatoTrayectorialaboralFormatoTruper(res['sel_id']);                                                          
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
                             return false;
 
                 
         });
 
 
 
   });
 </script>
 
 
 
 <div class="modal fade" id="editar-trayectorialaboral-formato-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                 <i class="mdi mdi-plus"></i>Editar una trayectoria laboral al estudio No. <span id="tyl_ese_id_editar-formato_truper"></span> "<span id="tyl_ese_nombre_editar-formato_truper"></span>"
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_editar_trayectorialaboral_formato_truper" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                   <input type="hidden" id="tyl_id_editar-formato_truper" name="tyl_id" />
 
               
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Empresa (MARCA)</label>
                     <input name="tyl_empresamarca" id="tyl_empresamarca_editar-formato_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Empresa..."  maxlength="55"/>
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Empresa (CONTRATANTE)</label>
                     <input   name="tyl_empresacontratante" id="tyl_empresacontratante_editar-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Empresa..."  maxlength="155"/>
 
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Periodo</label>
                     <input   name="tyl_periodo" id="tyl_periodo_editar-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Periodo..."  maxlength="155"/>
 
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Observaciones</label>
                     <input   name="tyl_comentario" id="tyl_comentario_editar-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Observaciones..." />
 
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
   