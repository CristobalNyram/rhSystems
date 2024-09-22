
<script>
  function fnEditarDatoAntecedentesLaboralesGrupoFamiliarDetalles (agd_id=0)
  {
    let form_ocupado=document.getElementById('frm_editar_datoantecedentegrupofamiliardetalles');
    form_ocupado.reset();
    let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliardetalles/ajax_get_detalle/') ?>";
    $('#agd_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text()); 
                                 
                                       $.ajax({
                                          type: "POST",
                                          url: url_enviar+agd_id,
                                           success: function(res)
                                             {   
                                                                                                                       
                                               if(res[0]==2)
                                                {
                                                                        
                                                  $('#agd_id_editar').val(agd_id);
                                                  $('#agd_nombre_editar').val(res['data'].agd_nombre);
                                                  $('#agd_empresa_editar').val(res['data'].agd_empresa);
                                                  $('#agd_puesto_editar').val(res['data'].agd_puesto);
                                                  $('#agd_antiguedad_editar').val(res['data'].agd_antiguedad);
                                                  $('#agd_ese_id_editar').text($('#ese_id_ese_actual').text());
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
          $('#frm_editar_datoantecedentegrupofamiliardetalles').submit(function(event){
                        let $forms = $(this);
                        a=$forms.valid();
                        if(a==false){
                            return false;
                        }
                        event.preventDefault();
                        if($('#agd_nombre_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el nombre.")
                            return false;
                          }
                          if($('#agd_empresa_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el campo empresa.")
                            return false;
                          }
                          if($('#agd_puesto_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar el campo puesto.")
                            return false;
                          }
                          if($('#agd_antiguedad_editar').val()=='')
                          {
                            alertify.alert("Error","Debe llenar en campo antiguedad.")
                            return false;
                          }
                          
                        let formulario=$("#frm_editar_datoantecedentegrupofamiliardetalles");
                        let $form = $(this);
                        $form.find("button").prop("disabled", true);
                        let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliardetalles/actualizar/') ?>";
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
                                                                    let form_ocupado=document.getElementById('frm_editar_datoantecedentegrupofamiliardetalles');
                                                                    form_ocupado.reset();
                                                                    $('#editar-familiar-antecedente-laboral-modal').modal('hide');
                                                                    fnRe_cargarTablaDatoAntecedentesgrupofamiliardetalles(res['agf_id']);
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

<div class="modal fade" id="editar-familiar-antecedente-laboral-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_agregar_familiar_candidato">
                <i class="mdi mdi-pencil"></i>Editar  antecedente laboral al estudio No. <span id="agd_ese_id_editar"> </span> "<span id="agd_ese_nombre_editar"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_editar_datoantecedentegrupofamiliardetalles" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="agd_id_editar" name="agd_id_editar" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="agd_nombre_editar" id="agd_nombre_editar" type="text" re class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre completo del familiar..." maxlength="100" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Empresa</label>
                    <input name="agd_empresa_editar" id="agd_empresa_editar" type="text" required class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre de la empresa..."  maxlength="100"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Puesto</label>
                    <input   name="agd_puesto_editar" id="agd_puesto_editar" type="text" required  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto..."  maxlength="45"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Antigüedad</label>
                    <input   name="agd_antiguedad_editar" id="agd_antiguedad_editar" type="text" required  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Tiempo en la empresa..."  maxlength="45"/>

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
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Actualizar  <i class="mdi mdi-pencil-box-outline white"></i></button>
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
  