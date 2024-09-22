{# permisos para mostrar lista de registros inicio  #}
{% set ochentayseis_emc_lis= acceso.verificar(86,rol_id) %}
{# permisos para mostrar lista de registros inicio  #}


<script type="">
  function fnCrearEmpleoOcultos(sel_id=0){
   
    $('#frm_crear_empleooculto')[0].reset(); // Reinicia el formulario
    $('#epl_sel_id').val(sel_id);
    $('#epl_sel_id_crear').text(sel_id);
   }
   
   $(function (){
     $('#frm_crear_empleooculto').submit(function(event) {
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
         data: $form.serialize(),
         success: function(res)
         {                                                                                                                                                                                                                                                            
  
             switch (res['estado']) {
                    case 2:
                      swalalert('Éxito',res['mensaje'], "success", 0);
                      $('#agregar-empleooculto-modal').modal('hide');
                      {% if ochentayseis_emc_lis==1 %}
                        fnCargarTablaDatoEmpleosOcultos(res['sel_id']);
                      {% endif %}
                      $form.find("button").prop("disabled", false);
                      break;
                  
                    case -2:
                      swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "error",1);
                    break;

                    case -1:
                      swalalertHTML(res["titular"],`${res['mensaje']} <br> <span class=></span> `, "warning");
                    $form.find("button").prop("disabled", false);
                    break;
                
                    default:
                    
                    break;
              }
         },
         error: function(res)
         { 
           alert('error en el servidor...'+res.responseText);
         }
       });
       return false;
     });
   });
</script>

<div class="modal fade" id="agregar-empleooculto-modal" tabindex="9999" style="z-index:99999;"  aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog detalle modal-dialog-scrollable">
     <div class="modal-content">
       <!-- <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
  -->        <div class="modal-header">
             <h5><div id="">
               <i class="mdi mdi-plus"></i>Agregar un empleo oculto a la sección laboral   No. <span id="epl_sel_id_crear"></span>
             </div></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <!-- //contenido -->
             <form id="frm_crear_empleooculto" class="form-vertical mt-1" novalidate method="post">
               <div class="form-group row">
                 <input type="hidden" id="epl_sel_id" name="sel_id" />

                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Nombre de empresa</label>
                  <input required name="epl_empresa" id="epl_empresa_crear" type="text" class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)" placeholder="Nombre de empresa" maxlength="55"/>
                </div>
                 <div class="col-lg-6">
                   <label class="col-form-label title-busq">Teléfono</label>
                   <input name="epl_telefono" id="epl_telefono_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Teléfono" maxlength="20"/>
                 </div>

                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de ingreso</label>
                  <input name="epl_fechaingreso" id="epl_fechaingreso_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
                </div>
                 <div class="col-lg-6">
                  <label class="col-form-label title-busq">Fecha de salida</label>
                  <input name="epl_fechasalida" id="epl_fechasalida_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="dd/mm/aa A dd/mm/aa" maxlength="35"/>
                </div>

                

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Demanda</label>
       
                  <input name="epl_demanda" id="epl_demanda_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Demanda..." maxlength="155"/>

                </div>

                <div class="col-lg-6">
                  <label class="col-form-label title-busq">Recomendable</label>

                  <input name="epl_recomendable" id="epl_recomendable_crear" type="text" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Recomendable..." maxlength="155"/>

                </div>
                 <div class="col-lg-12">
                  <label class="col-form-label title-busq">Motivo de separación</label>
                  <input name="epl_motivoseparacion" id="epl_motivo_crear" type="text" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Motivo de separación..." maxlength="800" />
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
 