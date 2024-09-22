
<script>
  function fnCrearDatoGrupoFamiliarDetalles()
  {
    let form_ocupado=document.getElementById('frm_crear_datogrupofamiliardetalles');
    form_ocupado.reset();

    $('#dgd_viveusted_crear').val('-1');
    $('#dgd_viveusted_crear').trigger('change');

    $('#dgd_niv_id_crear').val('-1');
    $('#dgd_niv_id_crear').trigger('change');

    $('#dgd_esc_id_crear').val('-1');
    $('#dgd_esc_id_crear').trigger('change');

 
    fnestadocivils_adaptable($('#dgd_esc_id_crear'));
    fnnivelestudios_adapatable($('#dgd_niv_id_crear'));
    

     $('#dgd_dgf_id').val($('#gfd_id_titulo_gfd').text());
     $('#dgd_ese_id_crear').text($('#ese_id_ese_actual').text());
     $('#dgd_ese_nombre_crear').text($('#ese_nombrecompleto_actual').text()); 

  } 

  $(function(){
    $('#frm_crear_datogrupofamiliardetalles').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
      event.preventDefault();
      if($('#dgd_esc_id_crear').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar un estado civil.")
        return false;
      }
      if($('#dgd_niv_id_crear').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar un nivel de estudio.")
        return false;
      }
      if($('#dgd_viveusted_crear').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar si vive con usted.")
        return false;
      }
      let formulario=$("#frm_crear_datogrupofamiliardetalles");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datogrupofamiliar/crear_dgd/') ?>";
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
               
                  $('#agregar-familiar-candidato-modal').modal('hide');
                  // fnRecargarCargarDatogrupofamiliardetalles(res['dgf_id']);  
                  fnCargarDatosDelFormularioE($('#ese_id_ese_actual').text());   
              }).then((value)=>{
              
              Swal.fire({
                title: '¿Quieres agregar este registro de manera automática en las demás tablas?',
                text: "Se crearán en las tablas de antecedentes laborales, situación económica y demás...",
                type: 'warning',
                showCancelButton: true, 
                confirmButtonText: 'Si, crearlo de manera automática.',
                cancelButtonText: 'No, no deseo agregar registros automáticos.',
              }).then((result) => {
              if(result.value)
              {
                fnRegistroAutomaticoGrupoFamiliarDemasTablas(formulario.serialize(),$('#ese_id_ese_actual').text());
                    let form_ocupado=document.getElementById('frm_crear_datogrupofamiliardetalles');
                   form_ocupado.reset();
              }
              else
              {
                Swal.fire({ 
                  title: 'La acción NO se realizó', 
                  // text: "Your file has been deleted.", 
                  timer: 2000, 
                  showCancelButton: false, 
                  showConfirmButton: false 
                }) 
              }
            })                
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
 

<div class="modal fade" id="agregar-familiar-candidato-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_agregar_familiar_candidato">
                <i class="mdi mdi-plus"></i>Agregar familiar del estudio No. <span id="dgd_ese_id_crear"></span> "<span id="dgd_ese_nombre_crear"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_datogrupofamiliardetalles" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="dgd_dgf_id" name="dgd_dgf_id" />

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="dgd_nombre_crear" id="dgd_nombre_crear" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del familiar del candidato..." maxlength="150" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Parentesco</label>
                    <input name="dgd_parentesco_crear" id="dgd_parentesco_crear" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parestesco que tiene con el candidato..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Edad</label>
                    <input   name="dgd_edad_crear" id="dgd_edad_crear" type="text" required  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad que tiene el familiar..."  maxlength="20"/>

                  </div>

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Estado civil</label>
                    <select name="dgd_esc_id_crear" id="dgd_esc_id_crear" required class="form-control select2-single "  oninput="handleInput(event)"  data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Nivel de estudio</label>
                    <select name="dgd_niv_id_crear" id="dgd_niv_id_crear" required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Vive con usted</label>
                    <select name="dgd_viveusted_crear" id="dgd_viveusted_crear"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
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