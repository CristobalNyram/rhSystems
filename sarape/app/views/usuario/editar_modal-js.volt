

<script>
     $(function (){
    $("#frm_editarusuario").submit(function(event) 
        {
          /* Act on the event */
          var $form = $(this);
          a=$form.valid();
            if(a==false){
                return false;
            }
          var urledtra="<?php echo $this->url->get('usuario/editar/') ?>";
          $form.find("button").prop("disabled", true);
          $.ajax({
            type: "POST",
            url: urledtra+$edusuario,
            data: $("#frm_editarusuario").serialize(),
            success: function(res)
            {
             
            
              if(res[0]<=0)
              {

                Swal.fire({title:'ERROR',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    // location.reload();  
                                                                     });
              }
              else
              {
                // cargarlista();
   
                Swal.fire({title:'Éxito',text:'Usuario editado correctamente.',type:"success"})
                                                                 .then((value) => {
                                                                  location.reload();

                                                                    // location.reload();  
                                                                     });

              }
              $form.find("button").prop("disabled", false); 
            },
            error: function(res)
            { 
              alert('Error en el servidor.');
              $form.find("button").prop("disabled", false); 
            }
          });
          return false;
        });
  });
  /*
  Funcion para editar un usuario
  */

  function fneditusuario(id,nombre)
    {
    
    var urlfned="<?php echo $this->url->get('usuario/buseditar/') ?>"; //trabajador
    
    $("#exampleModalLabelCabecera").html("Editar usuario: "+nombre); 
    $edusuario=id;
    $rolasignado='';
    $empasignado='';
    $.ajax(
    {
      type: "POST",
      url: urlfned+id,
      success: function(res)
      {
        if(res[0]<=0)
        {
          // $('#detallespoliza-modal').modal('hide');
          Swal.fire({title:'ERROR',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    // location.reload();  
                                                                     });
          
        }
        else
        {
            // console.log(res);
            $("#usu_nombreeditar").val(res[1].usu_nombre);
            $("#usu_primerapellidoeditar").val(res[1].usu_primerapellido);
            $("#usu_segundoapellidoeditar").val(res[1].usu_segundoapellido);
            $("#usu_correoeditar").val(res[1].usu_correo);
            $("#usu_telefonoeditar").val(res[1].usu_telefono);
            $("#usu_celulareditar").val(res[1].usu_celular);
            $('#usu_rfceditar').val(res[1].usu_rfc);
           // console.log(res[1].rol_id);
            getRolesSetOrShow(res[1].rol_id,$('#rol_ideditar'));
            getEmpresasSetOrShow(res[1].emp_id,$('#emp_ideditar'));
            getEstatusShowOrSet(res[1].usu_estatus,$('#usu_estatuseditar'));
    
            
        }
      }
    });
    
   

      
  }
</script>

<!-- inicio modal html -->

<div class="modal fade" id="editar_usuario-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabelCabecera">Editar usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_editarusuario" class="form-vertical mt-1">
            <div class="form-group row">
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Nombre</label>
                <input id="usu_nombreeditar" name="usu_nombreeditar" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Primer apellido</label>
                <input id="usu_primerapellidoeditar" name="usu_primerapellidoeditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" maxlength="255" minlength="1" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Segundo apellido</label>
                <input id="usu_segundoapellidoeditar" name="usu_segundoapellidoeditar" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" maxlength="255" oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Correo</label>
                <input id="usu_correoeditar" name="usu_correoeditar" type="email" class="form-control input-rounded" maxlength="255" placeholder="Correo" required />
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Estatus</label>
                <select name="usu_estatuseditar" id="usu_estatuseditar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                </select>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Rol</label>
                <select name="rol_ideditar" id="rol_ideditar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <option selected value="-1">Seleccione un Rol</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Empresa (si aplica)</label>
                <select name="emp_ideditar" id="emp_ideditar" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <option selected value="-1">Seleccione una empresa</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Teléfono</label>
                <input id="usu_telefonoeditar" name="usu_telefonoeditar" type="text" class="form-control input-rounded" placeholder="Teléfono" minlength="2" maxlength="20"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Celular</label>
                <input id="usu_celulareditar" name="usu_celulareditar" type="text" class="form-control input-rounded" placeholder="Celular" minlength="2" maxlength="20" />
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">RFC</label>
                <input id="usu_rfceditar" name="usu_rfceditar" type="text" class="form-control input-rounded"  placeholder="RFC" minlength="12" required  maxlength="13" oninput="handleInput(event)"/>
              </div>
          
              
              <div class="row col-lg-12">
                <div class="col-sm-6 col-md-6 text-center mt-5">
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3  text-center mt-5 ">
                    <div class="form-group">
                      <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-pencil white"></i> </button>
                    </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
       
      </div>
    </div>
            
  </div>
