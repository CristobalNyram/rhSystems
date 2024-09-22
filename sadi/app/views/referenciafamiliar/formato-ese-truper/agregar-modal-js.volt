<script type="">
    function fnCrearreferenciaFamiliarFormatoTruper(){
     let form_ocupado=document.getElementById('frm_crear_truper_referenciafamiliar');
     form_ocupado.reset();
      $('#ref_ese_id_crear-formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
      $('#ref_ese_nombre_crear-formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
 
      $('#ref_sep_id-formato_truper').val($('#sep_id-formato_truper').val());
      $('#ref_lorecomienda_crear-formato_truper').val('-1');
      $('#ref_lorecomienda_crear-formato_truper').trigger('change');

      
 
      
    
 
     }
     $(function (){
       $('#frm_crear_truper_referenciafamiliar').submit(function(event) {
       let $form = $(this);
       a=$form.valid();
       if(a==false){
           return false;
       }
       $form.find("button").prop("disabled", true);
       let url_enviar="<?php echo $this->url->get('referenciafamiliar/crear_formato_truper/') ?>";
                      
       $.ajax({
         type: "POST",
         url: url_enviar,
         data: $("#frm_crear_truper_referenciafamiliar").serialize(),
         success: function(res)
         {   
           // console.log(res);
           if(res[0]==2)
           {
      
           Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
             .then((value) => {
             $form.find("button").prop("disabled", false);
             let form_ocupado=document.getElementById('frm_crear_truper_referenciafamiliar');
             form_ocupado.reset();
 
             $('#agregar-referenciafamiliar-truper-modal').modal('hide');
             fnCargarTablaDatoReferenciaFamiliarFormatoTruper(res['sep_id']);
 
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
           alert('error en el servidor...');
         
         }
       });
       return false;
     });
 
 
 
   });
 </script>
 
 
 
 <div class="modal fade" id="agregar-referenciafamiliar-truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog detalle modal-dialog-scrollable">
       <div class="modal-content">
         <!-- <div class="col-md-12 col-sm-12 col-xs-12">
           <div class="x_panel">
    -->        <div class="modal-header">
               <h5><div id="">
                 <i class="mdi mdi-plus"></i>Agregar una referencia familiar al estudio No. <span id="ref_ese_id_crear-formato_truper"></span>  "<span id="ref_ese_nombre_crear-formato_truper"></span>"
               </div></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <!-- //contenido -->
               <form id="frm_crear_truper_referenciafamiliar" class="form-vertical mt-1" novalidate method="post">
                 <div class="form-group row">
                   <input type="hidden" id="ref_sep_id-formato_truper" name="sep_id" />
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Nombre completo</label>
                     <input name="ref_nombre" id="ref_nombre_crear-formato_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo..." maxlength="150" />
 
                   </div>
 
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Edad</label>
                     <input name="ref_edad" id="ref_edad_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad..."  maxlength="10"/>
 
                   </div>
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Teléfono</label>
                     <input name="ref_telefono" id="ref_telefono_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono..."  maxlength="20"/>
 
                   </div>
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Dirección                    </label>
                     <input name="ref_direccion" id="ref_direccion_crear-formato_truper" type="text" class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Dirección..."  maxlength="45"/>
 
                   </div>
 
                   <div class="col-lg-6">
                    <label class="col-form-label title-busq">Ocupación                    </label>
                    <input name="ref_ocupacion" id="ref_ocupacion_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Ocupación..."  maxlength="45"/>

                  </div>
      
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Parentesco                    </label>
                    <input name="ref_parentesco" id="ref_parentesco_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parentesco..."  maxlength="45"/>

                  </div>
      
 
              
             
 
 
 
                      
 
                  
 
 
         
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Conoce su empleo                    </label>
                     <input name="ref_conocesuempleo" id="ref_conocesuempleo_crear-formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Conoce su empleo..."  maxlength="45"/>
 
 
                   </div>
 
 
               
                   <div class="col-lg-6">
                     <label class="col-form-label title-busq">Lo recomienda</label>
                     <select name="ref_lorecomienda"  id="ref_lorecomienda_crear-formato_truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup class="text-uppercase">
                        <option value="-1">Seleccionar...</option>
                        <option value="1">RECOMENDABLE</option>
                        <option value="2">RECOMENDABLE C / RESERVAS			</option>
                        <option value="3"> --  NO -- RECOMENDABLE			
                        </option>
                      </optgroup>
                    </select>
 
                   </div>
 
                   <div class="col-lg-12">
                     <label class="col-form-label title-busq">Comentarios                    </label>
                     <textarea name="ref_comentario" id="ref_comentario_crear-formato_truper" oninput="handleInput(event)" class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400" placeholder="Comentarios..."></textarea>
 
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
   