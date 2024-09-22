<script>

      $(function (){
      $("#frm_crearempresa").submit(function(event) 
      {
         let select = document.getElementById("emp_tipoformato");

            if (select.selectedIndex === -1) {
              Swal.fire({title:'SIN DATOS',text:'Debes seleccionar al menos un formato',type:"warning"})
                          .then((value) => {
                       });     

            return false;
            }
        /* Act on the event */
        var $form = $(this);
        var urled="<?php echo $this->url->get('empresa/nuevo/') ?>";
        a=$form.valid();
        if(a==false){
            return false;
        }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crearempresa").serialize(),
      success: function(res)
      {

      
        if(res[0]<=0)
          {
            alertify.alert("Error",res[1]);
          }
          else
          {
          // cargarlista();
            alertify.alert("Éxito","Empresa creada correctamente.", function(){
            
            location.reload();
          });

        }
        
        $form.find("button").prop("disabled", false); 
      },
      error: function(res)
      { 
        $form.find("button").prop("disabled", false); 
      }
      });
      return false;
    });
  });

</script>


<div class="modal fade" id="Modal_empresa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">Crear Empresa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_crearempresa" class="form-vertical mt-1">
            <div class="form-group row">
              
              <div class="col-lg-5">
                <label class="col-form-label title-busq">Nombre de la empresa</label>
                <input id="emp_nombre" name="emp_nombre" maxlength="45" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Alias</label>
                <input id="emp_alias" name="emp_alias" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Alias" maxlength="10" minlength="1" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">RFC</label>
                <input id="emp_rfc" name="emp_rfc" type="text" class="form-control input-rounded data-not-lt-active" placeholder="RFC" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-8">
                <label class="col-form-label title-busq">Tipo de formato</label>
  
                <select multiple name="emp_tipoformato[]" id="emp_tipoformato" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <optgroup>
                    
  
                  </optgroup>
                </select>
              </div>
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">GRUPO DE NEGOCIO</label>
                  <select name="neg_id" id="neg_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  </select>
              </div>
              <div class="col-lg-12 mt-4">
                <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">CONTACTO</label>
                <hr class="mt-1">
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Nombre(s)</label>
                <input id="cne_nombreempresa" maxlength="45" name="cne_nombreempresa" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Primer apellido</label>
                <input id="cne_primerapellidoempresa" maxlength="45" name="cne_primerapellidoempresa" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Segundo apellido</label>
                <input id="cne_segundoapellidoempresa" name="cne_segundoapellidoempresa" maxlength="45" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Puesto</label>
                <input id="cne_puestoempresa" maxlength="45" name="cne_puestoempresa" type="text" class="form-control input-rounded" placeholder="Puesto" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Celular</label>
                <input id="cne_celularempresa" maxlength="20" name="cne_celularempresa" type="text" class="form-control input-rounded" placeholder="Celular" oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Teléfono</label>
                <input id="cne_telempresa"  maxlength="20" name="cne_telempresa" type="text" class="form-control input-rounded" placeholder="Teléfono" oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Extensión</label>
                <input id="cne_extempresa" maxlength="20" name="cne_extempresa" type="text" class="form-control input-rounded" placeholder="Extensión"  oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Correo</label>
                <input id="cne_correoempresa"  name="cne_correoempresa" type="email" class="form-control input-rounded" placeholder="Correo" maxlength="90"/>
              </div>

              <div class="col-lg-9">
                <label class="col-form-label title-busq">Correos para enviar copias (separar por punto y coma ";")</label>
                <input id="cne_copiaenvio" name="cne_copiaenvio"   type="text" class="form-control input-rounded" placeholder="Copias para envío de correo"  maxlength="300"/>
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
                      <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                    </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>
  