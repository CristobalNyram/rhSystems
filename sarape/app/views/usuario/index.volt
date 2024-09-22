{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}

<script type="text/javascript">
  $(function (){
    $("#frm_crearusuario").submit(function(event) 
    {
      //validacion de password inicio
      let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/;
			let p1=$("#usu_contrasena").val();
      let valido= regex.test(p1);
      if(!valido){
        alertify.alert("Error","La nueva contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@,*,_,# por ejemplo)");
				return false;
      }
      //validacion de password fin

      if($("#usu_estatus").val()==-1){
        Swal.fire({title:'ERROR',text:'Debe seleccionar el estatus.',type:"error"})
        .then((value) => {
        });
        return false;
      }
      if($("#rol_id").val()==-1){
        Swal.fire({title:'ERROR',text:'Debe seleccionar el rol.',type:"error"})
        .then((value) => {
        });
        return false;
      }
      /* Act on the event */
      var $form = $(this);
      var urled="<?php echo $this->url->get('usuario/nuevo/') ?>";
      a=$form.valid();
      if(a==false){
          return false;
      }
      $form.find("button").prop("disabled", true);
      $.ajax({
      type: "POST",
      url: urled,
      data: $("#frm_crearusuario").serialize(),
      success: function(res)
      {
        if(res[0]<=0)
          {
            Swal.fire({title:'Error',text:res[1],type:"error"})
            .then((value) => {
              location.reload();
                });
          }
          if(res[0]=='1')
          {
            Swal.fire({title:'Aviso',text:res[1],type:"warning"})
            .then((value) => {
            });
          }
          if(res[0]=='2')
          {
            Swal.fire({title:'Éxito',text:'Usuario creado correctamente.',type:"success"})
            .then((value) => {
              location.reload();
                });
          }
        $form.find("button").prop("disabled", false); 
      },
      error: function(res)
      { 
        alert('Error en el servidor');
        $form.find("button").prop("disabled", false);
      }
      });
      return false;
    });
  });

  $(document).ready(function() {
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('usuario/tabla/') ?>";
    $.post(url, $(this).serialize() , function(data)
    {
      divListado.innerHTML=data;
      pintartabla("#td_usuario");
    }).done(function() {
    }).fail(function() {
    })
  });

  function fndetails(code){
    url="<?php echo $this->url->get('usuario/detalle/') ?>";
    url=url+code;
    $.ajax({
        type: "POST",
        url: url,
        success: function(res)
        {
            $('#contenido').html(res);
        },
        error: function(res)
        {
        }
    });
  }

  function fncambiarfoto(name,code){
      $("#usu_nombre").text(name);
      document.getElementById("usu_id").value = code;
  }
  function fncambiarcontra(code){
      contraadmin="<?php echo $this->url->get('usuario/cambiarcontraadmin/') ?>";
      $("#usu_nombre").text(name);
      document.getElementById("usu_id_contra").value = code;
  }
  function fnelim(usu)
  {
    var urleliminarusu="<?php echo $this->url->get('usuario/eliminar/') ?>";
    var urlindexusu="<?php echo $this->url->get('usuario/index/') ?>";
    mensaje="¿Está seguro que desea eliminar el usuario con clave "+usu+"?";
    alertify.confirm("Eliminar registro",mensaje, function()
    { 
      $.ajax({
        type: "POST",
        url: urleliminarusu+usu,
        success: function(res)
        {
          if(res[0]=='1')
          {
            Swal.fire({title:'Ok',text:'Registro eliminado correctamente.',type:"success"})
            .then((value) => {
              window.location=urlindexusu;
            });
          }
          else
          {
            Swal.fire({title:'Error',text:'Ocurrio un error al eliminar el registro.',type:"error"})
            .then((value) => {
            });
          }
        }
      });
      }, function()
      { 
      }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); 
    }
    function fncatalogos(){
        fnroles();
        fnempresas();
    }

    function fnroles()
    {
      var url_ajax="<?php echo $this->url->get('rol/ajax_roles/') ?>";
      var $subs_name = $('select[name="rol_id"]');
      $subs_name.empty();
      $.ajax({
        type: "POST",
        url: url_ajax,
        success: function(data)
        {
          if (data.length > 0) {
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">Seleccionar</option>';
              $.each(data, function (key, dat) {
                  options += '<option value="' + dat.rol_id + '">' +dat.rol_nombre+'</option>';
              });
              return options;
            });
          }else{
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">No aplica</option>';
              return options;
            });
          }
        },
        error: function(res)
        {
          alert('Error en el servidor...');
        }
      });
    }

    function fnempresas()
    {
      var url_ajax="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
      var $subs_name = $('select[name="emp_id"]');
      $subs_name.empty();
      $.ajax({
        type: "POST",
        url: url_ajax,
        success: function(data)
        {
          if (data.length > 0) {
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">Seleccionar</option>';
              $.each(data, function (key, dat) {
                options += '<option value="' + dat.emp_id + '">' +dat.emp_nombre+'</option>';
              });
              return options;
            });
          }else{
            $subs_name.append(function () {
              var options = '';
              options += '<option selected value="-1">No aplica</option>';
              return options;
            });
          }
        },
        error: function(res)
        {
        }
      });
    }
</script>
<div class="row">
    <div class="col-6">
        <h4 class="header-title header-title-crm">Usuarios</h4>
    </div>
    <div class="col-6">
        <div class="text-right">
            {{ link_to('', 'data-target':'#modal_usuario', "onclick":"fncatalogos()", 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }}
       </div>
    </div>
</div>
<div class="mt-3">
    <div class="card card-crm">
        <div id="listado">
        </div>
    </div>
</div>

<div class="modal fade" id="cpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content" id="contentSession"> 
      <div class="modal-header text-center">
        <h5 class="" id="exampleModalLabel"><br>CAMBIAR CONTRASEÑA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" target="_self" id="formcpasswordadmin" class="form-vertical mt-1">
          <div class="col-lg-12">
            <label class="col-form-label title-busq">Ingrese su nueva contraseña</label>
            <input name="password1" type="password" class="form-control input-rounded" id="password1" autocomplete="off" placeholder="Ingrese su nueva contraseña" required />
            <input type='hidden' id='usu_id_contra' name='usu_id_contra'>
          </div>
          <div class="col-lg-12">
            <label class="col-form-label title-busq">Repita la contraseña</label>
            <input   name="password2" type="password" class="form-control input-rounded" id="password2" autocomplete="off" placeholder="Ingrese su nueva contraseña" required />
          </div>
          <div class="col-lg-12 m-5">
          </div>
          <div class="col-lg-12    text-center d-flex justify-content-end ">
            <div class="form-group col-lg-3 ">
              <button class="btn-dark btn-rounded btn btn-limpiar"  data-dismiss="modal"  ><i class=" mdi mdi-close white"></i>  Cancelar</button>
          </div> 
            <div class="form-group col-lg-3">
              <button class="btn-dark btn-rounded btn btn-buscar">Cambiar  <i class="mdi mdi-key-change white"></i> </button>
            </div>
          </div>           
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_crearusuario" class="form-vertical mt-1">
          <div class="form-group row">
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre</label>
              <input id="usu_nombre" name="usu_nombre" type="text" class="form-control input-rounded data-not-lt-active" minlength="2" placeholder="Nombre(s)" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="usu_primerapellido" name="usu_primerapellido" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" maxlength="255" minlength="1" required oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="usu_segundoapellido" name="usu_segundoapellido" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" maxlength="255" oninput="handleInput(event)"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Correo</label>
              <input id="usu_correo" name="usu_correo" type="email" class="form-control input-rounded" maxlength="255" placeholder="Correo" required />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Contraseña</label>
              <input id="usu_contrasena" name="usu_contrasena" type="password" class="form-control input-rounded" maxlength="255" autocomplete="off"  placeholder="Contraseña" required/>
            </div>
            <div class="col-lg-2">
                <label class="col-form-label title-busq">Estatus</label>
                <select name="usu_estatus" id="usu_estatus" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione</option>
                <option value="1">Baja</option>
                <option value="2">Alta</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Rol</label>
              <select name="rol_id" id="rol_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione un Rol</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Empresa (si aplica)</label>
              <select name="emp_id" id="emp_id" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option selected value="-1">Seleccione una empresa</option>
              </select>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Teléfono</label>
              <input id="usu_telefono" name="usu_telefono" type="text" class="form-control input-rounded" placeholder="Teléfono" minlength="2" maxlength="20"/>
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">Celular</label>
              <input id="usu_celular" name="usu_celular" type="text" class="form-control input-rounded" placeholder="Celular" minlength="2" maxlength="20" />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq">RFC</label>
              <input id="usu_rfc" name="usu_rfc" type="text" class="form-control input-rounded"  required placeholder="RFC" minlength="12" maxlength="13" oninput="handleInput(event)" />
            </div>
            <!-- input para mandar al back los tipos de estudios -->
            <input type="hidden" name="ute"  value="">
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
                    <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

{% include "/usuario/ajax-get-roles.volt" %}
{% include "/usuario/ajax-get-empresas.volt" %}
{% include "/usuario/ajax-get-estatus.volt" %}
{% include "/usuario/editar_modal-js.volt" %}