<script>
 function fnEditarDatoGrupoFamiliarDetalles(dgd_id=0)
 {
    let form_ocupado=document.getElementById('frm_editar_datogrupofamiliardetalles');
    form_ocupado.reset();

    let url_enviar="<?php echo $this->url->get('datogrupofamiliardetalles/ajax_get_detalle/') ?>";
                                       
                 $.ajax({
                    type: "POST",
                    url: url_enviar+dgd_id,
                     success: function(res)
                       {   
                                                                                                 
                         if(res[0]==2)
                        {
                             $('#dgd_viveusted_editar').val('-1');
                            $('#dgd_viveusted_editar').trigger('change');

                            $('#dgd_niv_id_editar').val('-1');
                            $('#dgd_niv_id_editar').trigger('change');

                            $('#dgd_esc_id_editar').val('-1');
                            $('#dgd_esc_id_editar').trigger('change');


                            fnestadocivils_adaptable($('#dgd_esc_id_editar'),res['data'].esc_id);
                            fnnivelestudios_adapatable($('#dgd_niv_id_editar'),res['data'].niv_id);
                            $('#dgd_viveusted_editar').val(res['data'].dgd_viveusted);
                            $('#dgd_viveusted_editar').trigger('change');

                            $('#dgd_nombre_editar').val(res['data'].dgd_nombre);
                            $('#dgd_parentesco_editar').val(res['data'].dgd_parentesco);
                            $('#dgd_edad_editar').val(res['data'].dgd_edad);

                        


                            $('#dgd_dgd_id_editar').val(res['data'].dgd_id);
                            $('#dgd_ese_id_editar').text($('#ese_id_ese_actual').text());
                            $('#dgd_ese_nombre_editar').text($('#ese_nombrecompleto_actual').text()); 

                          
                         }
                         else
                         {
                          /*
                          Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                            .then((value) => {
                              location.reload();  
                                 });*/
                         }
                          //  console.log();                                                                                  
                       },
                      error: function(res)
                       { 
                                                alert('error en el servidor...');
                       }
                   });
 }

  $(function(){
    $('#frm_editar_datogrupofamiliardetalles').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
                          
      event.preventDefault();
      if($('#dgd_esc_id_editar').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar un estado civil.")
        return false;
      }
      if($('#dgd_niv_id_editar').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar un nivel de estudio.")
        return false;
      }
      if($('#dgd_viveusted_editar').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar si vive con usted.")
        return false;
      }
      let formulario=$("#frm_editar_datogrupofamiliardetalles");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datogrupofamiliar/actualizar_dgd/') ?>";
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
            let form_ocupado=document.getElementById('frm_editar_datogrupofamiliardetalles');
            form_ocupado.reset();
            $('#editar-familiar-candidato-modal').modal('hide');
            fnRecargarCargarDatogrupofamiliardetalles(res['dgf_id']);               
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

<div class="modal fade" id="editar-familiar-candidato-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_agregar_familiar_candidato">
                <i class="mdi mdi-pencil-outline"></i> Editar  familiar del estudio No. <span id="dgd_ese_id_editar"></span> "<span id="dgd_ese_nombre_editar"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_editar_datogrupofamiliardetalles" enctype="multipart/form-data" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="dgd_dgd_id_editar" name="dgd_dgd_id_editar" />

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="dgd_nombre_editar" id="dgd_nombre_editar" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del familiar del candidato..."  maxlength="150" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Parentesco</label>
                    <input name="dgd_parentesco_editar" id="dgd_parentesco_editar" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Parestesco que tiene con el candidato..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Edad</label>
                    <input   name="dgd_edad_editar" id="dgd_edad_editar" type="text" required  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad que tiene el familiar..."  maxlength="20"/>

                  </div>

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Estado civil</label>
                    <select name="dgd_esc_id_editar" id="dgd_esc_id_editar" required class="form-control select2-single "  oninput="handleInput(event)"  data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Nivel de estudio</label>
                    <select name="dgd_niv_id_editar" id="dgd_niv_id_editar" required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Vive con usted</label>
                    <select name="dgd_viveusted_editar" id="dgd_viveusted_editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
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
  