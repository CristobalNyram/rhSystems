<script type="">
    function fnCrearTrayectorialaboralRegistradoDetallesFormatoTruper(){
     // $('#agd_agf_id').val($('#agf_id').val());
      let form_ocupado=document.getElementById('frm_crear_trayectorialaboralregistradodetalles_formato_truper');
       form_ocupado.reset();
      $('#trd_ese_id_crear-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
      $('#trd_ese_nombre_crear-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
      $('#trd_tlr_id-formato_truper').val($('#tlr_id-formato_truper').val());


      $('#trd_informada_crear-formato_truper').val(-1);
      $('#trd_informada_crea-formato_truper').trigger('change');
    //  
    //   fngetDataTipotrdo(0,$('#trd_tipo_crear_formatotruper'));
     }
     $(function (){
           $('#frm_crear_trayectorialaboralregistradodetalles_formato_truper').submit(function(event){
                         let $forms = $(this);
                         a=$forms.valid();
                         if(a==false){
                             return false;
                         }
                         event.preventDefault();
   
                  
                          
                      
                           
                         let formulario=$("#frm_crear_trayectorialaboralregistradodetalles_formato_truper");
                         let $form = $(this);
                         $form.find("button").prop("disabled", true);
                         let url_enviar="<?php echo $this->url->get('trayectorialaboralregistradodetalles/crear_formato_truper/') ?>";
                                        
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
                                                               let form_ocupado=document.getElementById('frm_crear_trayectorialaboralregistradodetalles_formato_truper');
                                                               form_ocupado.reset();
 
                                                               $('#agregar-trayectorialaboralregistradodetalles-formato-truper-modal').modal('hide');
                                                               fnCargarTablaDatoTrayectorialaboralregistradodetallesFormatoTruper(res['tlr_id']);                                                          
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
 
 
 
 <div class="modal fade" id="agregar-trayectorialaboralregistradodetalles-formato-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                 <i class="mdi mdi-plus"></i>Agregar una trayectoria laboral registrada al estudio No. <span id="trd_ese_id_crear-formato_truper"></span> "<span id="trd_ese_nombre_crear-formato_truper"></span>"
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_crear_trayectorialaboralregistradodetalles_formato_truper" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                   <input type="hidden" id="trd_tlr_id-formato_truper" name="tlr_id" />
 
               
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Empresa</label>
                     <input name="trd_empresa" id="trd_empresa_crear-formato_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Empresa..."  maxlength="55"/>
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Informada</label>
                     <select  name="trd_informada" id="trd_informada_crear-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">SÍ</option>
                        <option value="0">NO</option>
                      </optgroup>
                    </select>
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Observaciones</label>
                     <input   name="trd_observaciones" id="trd_observaciones_crear-formato_truper" type="text" required  class="form-control input-rounded"  oninput="handleInput(event)"   placeholder="Observaciones..."  maxlength="155"/>
 
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
   