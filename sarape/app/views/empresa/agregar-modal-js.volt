<script>

      $(function (){
      $("#frm_crearempresa").submit(function(event) 
      {
        //  let select = document.getElementById("emp_tipoformato");
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
                <input id="emp_nombre" name="emp_nombre" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre" maxlength="155" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Alias</label>
                <input id="emp_alias" name="emp_alias" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Alias" maxlength="25" minlength="1" required oninput="handleInput(event)"/>
              </div>
  
              <div class="col-lg-4">
                <label class="col-form-label title-busq">RFC</label>
                <input id="emp_rfc" name="emp_rfc" type="text" class="form-control input-rounded data-not-lt-active" placeholder="RFC" minlength="12" maxlength="13" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">GRUPO DE NEGOCIO</label>
                  <select name="neg_id" id="neg_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  </select>
              </div>
              {# DIRRECION INICIO #}
               <div class="col-lg-12 mt-4">
                <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">EMPRESA - DIRECCIÓN</label>
              </div>
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">CALLE</label>
                  <input id="emp_calle" name="emp_calle" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Calle"  maxlength="155"  oninput="handleInput(event)"/>

              </div>
             <div class="col-lg-4" >
                  <label class="col-form-label title-busq">NÚMERO</label>
                  <input id="emp_numero" name="emp_numero" type="text" class="form-control input-rounded data-not-lt-active" placeholder="#"  maxlength="25"  oninput="handleInput(event)"/>

              </div>
               <div class="col-lg-4" >
                  <label class="col-form-label title-busq">COLONIA</label>
                  <input id="emp_colonia" name="emp_colonia" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Colonia"  maxlength="155"  oninput="handleInput(event)"/>

              </div>

         
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">ESTADO</label>
                  <select name="est_id" id="est_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="fnmunicipios_adaptable($(`#mun_id`),event.currentTarget.value,-1)">
                  </select>
              </div>
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">MUNICIPIO</label>
                  <select name="mun_id" id="mun_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  </select>
              </div>
              <div class="col-lg-4" >
                  <label class="col-form-label title-busq">CÓDIGO POSTAL</label>
                  <input id="emp_cp" name="emp_cp" type="text" class="form-control input-rounded data-not-lt-active" placeholder="CP" maxlength="13"  oninput="handleInput(event)"/>

              </div>
              <hr>
              {# DIRRECION FIN #}

              <div class="col-lg-12 mt-4">
                <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">CONTACTO</label>
                <hr class="mt-1">
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Nombre(s)</label>
                <input id="cne_nombreempresa" name="cne_nombreempresa" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Primer apellido</label>
                <input id="cne_primerapellidoempresa" name="cne_primerapellidoempresa" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-4">
                <label class="col-form-label title-busq">Segundo apellido</label>
                <input id="cne_segundoapellidoempresa" name="cne_segundoapellidoempresa" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido"  oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Puesto</label>
                <input id="cne_puestoempresa" name="cne_puestoempresa" type="text" class="form-control input-rounded" placeholder="Puesto" required oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Celular</label>
                <input id="cne_celularempresa" name="cne_celularempresa" type="text" class="form-control input-rounded" placeholder="Celular" oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Teléfono</label>
                <input id="cne_telempresa" name="cne_telempresa" type="text" class="form-control input-rounded" placeholder="Teléfono" oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Extensión</label>
                <input id="cne_extempresa" name="cne_extempresa" type="text" class="form-control input-rounded" placeholder="Extensión"  oninput="handleInput(event)"/>
              </div>
              <div class="col-lg-3">
                <label class="col-form-label title-busq">Correo</label>
                <input id="cne_correoempresa" name="cne_correoempresa" type="email" class="form-control input-rounded" placeholder="Correo" maxlength="90"/>
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
  