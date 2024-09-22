
<script>
  function fnEditarDatoGrupoFamiliarDetalles_vivecon_formato_truper(dgd_id)
  {
    let form_ocupado=document.getElementById('frm_editar_datogrupofamiliardetalles_formato_truper');
    form_ocupado.reset();

    let url_enviar="<?php echo $this->url->get('datogrupofamiliardetalles/ajax_get_detalle/') ?>";
                                       
                 $.ajax({
                    type: "POST",
                    url: url_enviar+dgd_id,
                     success: function(res)
                       {   
                                                                                                 
                         if(res[0]==2)
                        {

                          $('#dgd_id_formato_truper').val(dgd_id);
                          $('#dgd_ese_id_editar_formato_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
                          $('#dgd_ese_nombre_editar_formato_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
                          
                          $('#dgd_nombre_editar_formato_truper').val(res['data'].dgd_nombre);

                          $('#dgd_nombre_editar_formato_truper').val(res['data'].dgd_nombre);

                          let dgd_parentesco= (is_number(res['data'].dgd_parentesco )==null ) ?-1:res['data'].dgd_parentesco;
                          // $('#dgd_parentesco_editar_formato_truper').val(dgd_parentesco);
                          // $('#dgd_parentesco_editar_formato_truper').trigger('change');

                          fngetDataSelectsDinamicosParentescoFormatoTruper(dgd_parentesco,$('#dgd_parentesco_editar_formato_truper'));


                          $('#dgd_edad_editar_formato_truper').val(res['data'].dgd_edad);

                          let dgd_ocupacion= (is_number(res['data'].dgd_ocupacion )==null ) ?-1:res['data'].dgd_ocupacion;
                         /* $('#dgd_ocupacion_editar_formato_truper').val(dgd_ocupacion);
                          $('#dgd_ocupacion_editar_formato_truper').trigger('change');*/


                          fngetDataSelectsDinamicoOcupacionFormatoTruper(dgd_ocupacion, $('#dgd_ocupacion_editar_formato_truper'));


                          $('#dgd_puesto_editar_formato_truper').val(res['data'].dgd_puesto);
                          $('#dgd_nombre_editar_formato_truper').val(res['data'].dgd_nombre);
                          // $('#dgd_estatucontacto_editar_formato_truper').val(res['data'].dgd_estatucontacto);
                          $('#dgd_telefono_editar_formato_truper').val(res['data'].dgd_telefono);
                          $('#dgd_empresa_editar_formato_truper').val(res['data'].dgd_empresa);



                            fnnivelestudios_adapatable($('#dgd_niv_id_editar_formato_truper'),res['data'].niv_id,1);
                            fngetDataSelectsEstatusContactoDatoGrupoFamiliar(res['data'].dgd_estatucontacto,$('#dgd_estatucontacto_editar_formato_truper'));
                            
                            $('#dgd_viveusted_editar_formato_truper').val(res['data'].dgd_viveusted);
                            $('#dgd_viveusted_editar_formato_truper').trigger('change');

                          
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
    $('#frm_editar_datogrupofamiliardetalles_formato_truper').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
      event.preventDefault();
     
      if($('#dgd_niv_id_editar_formato_truper').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar un nivel de estudio.")
        return false;
      }
      if($('#dgd_viveusted_editar_formato_truper').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar si vive con usted.")
        return false;
        
      }

     /* if($('#dgd_estatuscontacto_editar_formato_truper').val()==-1)
      {
        alertify.alert("Error","Debe seleccionar si vive con usted.")
        return false;
        
      }*/

      
      let formulario=$("#frm_editar_datogrupofamiliardetalles_formato_truper");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datogrupofamiliardetalles/actualizar_vivecon_formatotruper/') ?>";
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
                  $('#editar-familiarvivecon-formato_truper-modal').modal('hide');
                  fnCargarDatogrupofamiliardetallesVivenONoVivenFormatoTruper(res['dgf_id']);
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
 

<div class="modal fade" id="editar-familiarvivecon-formato_truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_editar_familiar_candidato_formato_truper">
                <i class="mdi mdi-plus"></i>Editar familiar del estudio No. <span id="dgd_ese_id_editar_formato_truper"></span> "<span id="dgd_ese_nombre_editar_formato_truper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_editar_datogrupofamiliardetalles_formato_truper" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="dgd_id_formato_truper" name="dgd_id" />

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="dgd_nombre" id="dgd_nombre_editar_formato_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del familiar del candidato..." maxlength="150" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Parentesco</label>
                    <select name="dgd_parentesco" id="dgd_parentesco_editar_formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup class="text-uppercase">
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">PADRE</option>
                        <option value="2">MADRE</option>
                        <option value="3">HERMANO(A)</option>
                        <option value="4">ESPOSA (O)</option>
                        <option value="5">CÓNYUGE </option>
                        <option value="6">HIJO (A)  </option>
                        <option value="7">HIJASTRO (A) </option>
                        <option value="8">SOBRINO (A) </option>
                        <option value="9"> PADRASTRO </option>
                        <option value="10">CUÑADO (A) </option>
                        <option value="11">SÓLO O C / AMIGOS </option>


                        <option value="12">TÍO (A) </option>
                        <option value="13">ABUELO (A) </option>
                        <option value="14">PRIMO (A)</option>
                        <option value="15">MADRASTRA</option>
                        <option value="16"> SUEGRO (A)</option>
                      </optgroup>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Edad</label>
                    <input   name="dgd_edad" id="dgd_edad_editar_formato_truper" type="text" required  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Edad que tiene el familiar..."  maxlength="20"/>

                  </div>

              
                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Nivel de estudios</label>
                    <select name="niv_id" id="dgd_niv_id_editar_formato_truper" required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                    </select>
                  </div>
  
                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Ocupación</label>
                    <select name="dgd_ocupacion" id="dgd_ocupacion_editar_formato_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup>
                        <option value="-1">Seleccionar ...</option>
                        <option value="1">TRABAJA</option>
                        <option value="2">DESEMPLEADO</option>
                        <option value="3">AMA DE CASA </option>
                        <option value="4">ESTUDIANTE </option>
                        <option value="5">PENSIONADO </option>
                        <option value="6">JUBILADO </option>
                        <option value="7">DISCAPACITADO </option>
                        <option value="8">NO APLICA </option>

                      </optgroup>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Puesto</label>
                    <input name="dgd_puesto" id="dgd_puesto_editar_formato_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto del familiar..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Empresa</label>
                    <input name="dgd_empresa" id="dgd_empresa_editar_formato_truper" type="text"  class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Empresa en la que trabaja..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="dgd_telefono" id="dgd_telefono_editar_formato_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono del familiar..."  maxlength="20"/>

                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Estatus contacto</label>
                    <select name="dgd_estatucontacto" id="dgd_estatucontacto_editar_formato_truper"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >

                    </select>
                  </div>

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Vive con usted</label>
                    <select name="dgd_viveusted" id="dgd_viveusted_editar_formato_truper"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                        <option value="-1">Seleccionar...</option>
                        <option value="0">NO</option>
                        <option value="1">SÍ</option>

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
