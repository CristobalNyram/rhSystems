<script type="">
    function fnCrearTrayectorialaboralFormatoTruper(){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_crear_trayectorialaboral_formato_truper');
       form_ocupado.reset();
      $('#tyl_ese_id_crear-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
      $('#tyl_ese_nombre_crear-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
      $('#tyl_sel_id-formato_truper').val($('#sel_id-formato_truper').val());
    //  
    //   fngetDataTipotylo(0,$('#tyl_tipo_crear_formatotruper'));
     }
     $(function (){
           $('#frm_crear_trayectorialaboral_formato_truper').submit(function(event){
                         let $forms = $(this);
                         a=$forms.valid();
                         if(a==false){
                             return false;
                         }
                         event.preventDefault();
   
                  
                          
                      
                           
                         let formulario=$("#frm_crear_trayectorialaboral_formato_truper");
                         let $form = $(this);
                         $form.find("button").prop("disabled", true);
                         let url_enviar="<?php echo $this->url->get('trayectorialaboral/crear_formato_truper/') ?>";
                                        
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
                                                               let form_ocupado=document.getElementById('frm_crear_trayectorialaboral_formato_truper');
                                                               form_ocupado.reset();
 
                                                               $('#agregar-trayectorialaboral-formato-truper-modal').modal('hide');
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
 
 
 
 <div class="modal fade" id="agregar-trayectorialaboral-formato-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                 <i class="mdi mdi-plus"></i>Agregar una trayectoria laboral al estudio No. <span id="tyl_ese_id_crear-formato_truper"></span> "<span id="tyl_ese_nombre_crear-formato_truper"></span>"
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_crear_trayectorialaboral_formato_truper" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                   <input type="hidden" id="tyl_sel_id-formato_truper" name="sel_id" />
 
               
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Empresa (MARCA)</label>
                     <input name="tyl_empresamarca" id="tyl_empresamarca_crear-formato_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Empresa..."  maxlength="55"/>
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Empresa (CONTRATANTE)</label>
                     <input   name="tyl_empresacontratante" id="tyl_empresacontratante_crear-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Empresa..."  maxlength="155"/>
 
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Periodo</label>
                     <input   name="tyl_periodo" id="tyl_periodo_crear-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Periodo..."  maxlength="155"/>
 
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Observaciones</label>
                     <input   name="tyl_comentario" id="tyl_comentario-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Observaciones..." />
 
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
   