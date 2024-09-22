<script type="">
  function fnCrearEmpleoOculto_formato_gabencognv(){
    let form_ocupado=document.getElementById('frm_crear_empleooculto_gabencognv');
    form_ocupado.reset();
   
    let sel_id=$('#sel_id_formato_gabencognv').val();
    $('#epl_sel_id-gabencognv').val(sel_id);
    $('#epl_ese_id_crear-gabencognv').text($('#ese_id_ese_actual_formato_gabencognv').text());
    $('#epl_ese_nombre_crear-gabencognv').text($('#ese_nombrecompleto_actual_formato_gabencognv').text()); 

    
  
                              
   }
   
   $(function (){
     $('#frm_crear_empleooculto_gabencognv').submit(function(event) {
        event.preventDefault();
      
       let $form = $(this);
       a=$form.valid();
       if(a==false){
           return false;
       }
       $form.find("button").prop("disabled", true);
       let url_enviar="<?php echo $this->url->get('empleooculto/crear_general/') ?>";
       $.ajax({
         type: "POST",
         url: url_enviar,
         data: $('#frm_crear_empleooculto_gabencognv').serialize(),
         success: function(res)
         {
          if(res[0]==2)
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
              .then((value) => {
                $form.find("button").prop("disabled", false);

                let form_ocupado=document.getElementById('frm_crear_empleooculto_gabencognv');
                form_ocupado.reset();
              
                $('#agregar-empleooculto-gabencognv-modal').modal('hide');
                fnCargarTablaDatoEmpleosOcultos_formato_gabencognv(res['sel_id']);
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

<div class="modal fade" id="agregar-empleooculto-gabencognv-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog detalle modal-dialog-scrollable">
     <div class="modal-content">
       <!-- <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
  -->        <div class="modal-header">
             <h5><div id="">
               <i class="mdi mdi-plus"></i>Agregar un empleo oculto al estudio No. <span id="epl_ese_id_crear-gabencognv"></span> "<span id="epl_ese_nombre_crear-gabencognv"></span>"
             </div></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <!-- //contenido -->
             <form id="frm_crear_empleooculto_gabencognv" class="form-vertical mt-1" novalidate method="post">
               <div class="form-group row">
                 <input type="hidden" id="epl_sel_id-gabencognv" name="sel_id" />

                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre de empresa</label>
                  <input required name="epl_empresa" id="epl_empresa_crear-gabencognv" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)" placeholder="Nombre de empresa" maxlength="55"/>
                </div>
                 <div class="col-lg-6">
                   <label class="col-form-label title-busq">Teléfono</label>
                   <input name="epl_telefono" id="epl_telefono_crear-gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Teléfono" maxlength="20"/>
                 </div>

                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de ingreso</label>
                  <input name="epl_fechaingreso" id="epl_fechaingreso_crear-gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
                </div>
                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de salida</label>
                  <input name="epl_fechasalida" id="epl_fechasalida_crear-gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
                </div>

                

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Demanda</label>
       
                  <input name="epl_demanda" id="epl_demanda_crear-gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Demanda..." maxlength="155"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Recomendable</label>

                  <input name="epl_recomendable" id="epl_recomendable_crear-gabencognv" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Recomendable..." maxlength="155"/>

                </div>
                 <div class="col-lg-12">
                  <label class="col-form-label title-busq">Motivo de separación</label>
                  <input name="epl_motivoseparacion" id="epl_motivo_crear-gabencognv" type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Motivo de separación..." maxlength="800" />
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
 