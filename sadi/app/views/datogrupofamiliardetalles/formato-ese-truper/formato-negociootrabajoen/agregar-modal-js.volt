
<script>
  function fnCrearDatoGrupoFamiliarDetalles_negociootrabajoen_formato_negociootrabajoen_truper()
  {
      let form_ocupado=document.getElementById('frm_crear_datogrupofamiliardetalles_formato_negociootrabajoen_truper');
      form_ocupado.reset();

  

      fngetDataSelectsDinamicosParentescoFormatoTruper(0, $('#dgd_parentesco_crear_formato_negociootrabajoen_truper'));



     $('#dgd_dgf_id_formato_negociootrabajoen_truper').val($('#dgf_id-formato-truper').val());
     $('#dgd_ese_id_crear_formato_negociootrabajoen_truper').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#dgd_ese_nombre_crear_formato_negociootrabajoen_truper').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

  } 

  $(function(){
    $('#frm_crear_datogrupofamiliardetalles_formato_negociootrabajoen_truper').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
      event.preventDefault();
     

      
      let formulario=$("#frm_crear_datogrupofamiliardetalles_formato_negociootrabajoen_truper");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datogrupofamiliardetalles/crear_negociootrabajoen_formatotruper/') ?>";
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
                  $('#agregar-formato_negociootrabajoen_truper-modal').modal('hide');
                  fnCargarDatogrupofamiliardetallesNegociooTrabajoEnFormatoTruper(res['dgf_id']);
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
 

<div class="modal fade" id="agregar-formato_negociootrabajoen_truper-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_agregar_familiar_candidato_formato_negociootrabajoen_truper">
                <i class="mdi mdi-plus"></i>Agregar familiar del estudio No. <span id="dgd_ese_id_crear_formato_negociootrabajoen_truper"></span> "<span id="dgd_ese_nombre_crear_formato_negociootrabajoen_truper"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_datogrupofamiliardetalles_formato_negociootrabajoen_truper" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="dgd_dgf_id_formato_negociootrabajoen_truper" name="dgf_id" />

                  <div class="col-lg-5">
                    <label class="col-form-label title-busq">Nombre</label>
                    <input name="dgd_nombre" id="dgd_nombre_crear_formato_negociootrabajoen_truper" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del familiar del candidato..." maxlength="150" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Parentesco</label>
                    <select name="dgd_parentesco" id="dgd_parentesco_crear_formato_negociootrabajoen_truper" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ...">
                      <optgroup class="text-uppercase">
                     

                      </optgroup>
                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Puesto</label>
                    <input name="dgd_puesto" id="dgd_puesto_crear_formato_negociootrabajoen_truper" type="text"  class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Puesto del familiar..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre del negocio	
                    </label>
                    <input name="dgd_empresa" id="dgd_empresa_crear_formato_negociootrabajoen_truper" type="text"  class="form-control input-rounded data-not-lt-active" oninput="handleInput(event)"   placeholder="Nombre del negocio del familiar..."  maxlength="50"/>

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Teléfono</label>
                    <input name="dgd_telefono" id="dgd_telefono_crear_formato_negociootrabajoen_truper" type="text" required class="form-control input-rounded" oninput="handleInput(event)"   placeholder="Teléfono del familiar..."  maxlength="20"/>

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
