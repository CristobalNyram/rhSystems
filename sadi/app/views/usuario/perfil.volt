<script>
  campas="<?php echo $this->url->get('usuario/editarpassword') ?>";
</script>
{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}

<script>
  $(function (){
    $("#frm_subircurp").submit(function(event) 
    {
      if($('#archivo_curp').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u="<?php echo $this->url->get('documento/archivocurp/') ?>";
      $.ajax({
        url: u,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });
    $("#frm_subirnacimiento").submit(function(event) 
    {
      if($('#archivo_nacimiento').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u2="<?php echo $this->url->get('documento/archivonacimiento/') ?>";
      $.ajax({
        url: u2,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subirdomicilio").submit(function(event) 
    {
      if($('#archivo_domicilio').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivodomicilio/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subirestudios").submit(function(event) 
    {
      if($('#archivo_estudios').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivoestudios/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subirelector").submit(function(event) 
    {
      if($('#archivo_elector').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivoelector/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subirfotografia").submit(function(event) 
    {
      if($('#archivo_fotografia').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivofotografia/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subircaratula").submit(function(event) 
    {
      if($('#archivo_caratula').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivocaratula/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });

    $("#frm_subirfiscal").submit(function(event) 
    {
      if($('#archivo_fiscal').val()=='') 
      { 
            Swal.fire({title:'Error',text:"Debe seleccionar un archivo a subir.",type:"error"})
                    .then((value) => {
                    });
        return false; 
      }
      var u3="<?php echo $this->url->get('documento/archivofiscal/') ?>";
      $.ajax({
        url: u3,//Url a donde la enviaremos
        type:'POST', //Metodo que usaremos
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(res)
          {
            if(res[0]!='-2')
            {
              Swal.fire({title:'Éxito',text:'Se ha subido correctamente el archivo.',type:"success"})
                .then((value) => {
                  location.reload();
                });
            }
            else
            {
              // cargarlista();
              Swal.fire({title:'Error',html:res[3],type:"error"})
                .then((value) => {
                  location.reload();
                });
            }
            // $form.find("button").prop("disabled", false); 
          },
          error: function(res)
          {
            alert('Error en el servidor...');
            // $form.find("button").prop("disabled", false); 
          }
      });
      return false;
    });
  });
</script> 
<div class="mt-3">
  <div class="card card-crm">
    <div class="text-center col-md-12">
      <div class="mt-1"><span class="font-16 btn-link-crm">Mi Perfil</span>
      </div>
    </div>
    <!-- <div class="col-md-12 mt-3">
      <div class="avatar-xxl member-thumb mb-2 center-page mx-auto">
        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle img-thumbnail" alt="profile-image">
        <div class="icon-star2" >
          <button class="boton-camera"><i class="white mdi mdi-camera photo-change"></i></button>
        </div>
      </div>
    </div>  -->
    <div class="col-lg-12 mt-2">
      <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">DATOS PERSONALES</label>
      <hr class="mt-1">
    </div>
    <form class="form-vertical">
      <div class="form-group row">
        <div class="col-lg-4">
            <label class="col-form-label title-busq">Num. ID</label>
            <input type="text" class="form-control input-rounded input-rounded-disabled" disabled value="{{usuario.usu_id}}" >
        </div>
        <div class="col-lg-4">
            <label class="col-form-label title-busq">Contraseña</label>
            <input type="password" class="form-control input-rounded input-rounded-disabled" disabled value="●●●●●●●●●●" >
        </div>
        <div class="col-lg-4">
          <div class="form-group mt-5">
            <a href="#" data-toggle="modal" data-target="#cpassword" class="btn-dark btn-rounded btn btn-buscar">CAMBIAR CONTRASEÑA<i class="mdi mdi-key-change white"></i></a>
            <!-- <button class="btn-dark btn-rounded btn btn-buscar">Cambiar Contraseña <i class="mdi mdi-key-change white"></i> </button> -->
          </div>
        </div>
        <div class="col-lg-12 ">
          <label class="col-form-label title-busq font-10 font-weight-bolder title-yellow">PERFIL</label>
          <hr class="mt-1">
        </div>
        <div class="col-lg-4">
          <label class="col-form-label title-busq">Nombre (s)</label>
          <input type="text" class="form-control input-rounded-disabled" disabled value="{{usuario.usu_nombre}}" >
        </div>
        <div class="col-lg-4">
          <label class="col-form-label title-busq">Primer Apellido</label>
          <input type="text" class="form-control input-rounded-disabled" disabled value="{{usuario.usu_primerapellido}}" >
        </div>
        <div class="col-lg-4">
          <label class="col-form-label title-busq">Segundo Apellido</label>
          <input type="text" class="form-control input-rounded-disabled" disabled value="{{usuario.usu_segundoapellido}}" >
        </div>
        <div class="col-lg-4 mt-3">
          <label class="col-form-label title-busq">Correo Electrónico</label>
          <input type="mail" class="form-control input-rounded-disabled" disabled value="{{usuario.usu_correo}}" >
          <br>
        </div>
      </div>
    </form>
  </div>
</div>

{% if acceso.verificar(61,rol_id)==1 %}
<div class="">
  <div class="card card-crm">
    <div class="text-center col-md-12">
      <div class="mt-1"><span class="font-16 btn-link-crm">Documentación</span>
      </div>
    </div>
    <div class="form-group row">
      <form class="form-vertical col-lg-3" id="frm_subircurp" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">CURP</label>
        {% if curp==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if curp==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if curp==0 %}
          <input type="file" id="archivo_curp" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_curp[]" required />
          <div class="row col-lg-12">
            <div class="col-sm-6 col-md-6 text-center mt-5 ">
                <div class="form-group">
                  <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
                </div>
            </div>
          </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirnacimiento" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Acta de nacimiento</label>
        {% if nacimiento==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if nacimiento==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if nacimiento==0 %}
        <input type="file" id="archivo_nacimiento" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_nacimiento[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirdomicilio" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Comprobante de domicilio</label>
        {% if domicilio==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if domicilio==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if domicilio==0 %}
        <input type="file" id="archivo_domicilio" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_domicilio[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirestudios" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Comprobante de estudios</label>
        {% if estudios==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if estudios==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if estudios==0 %}
        <input type="file" id="archivo_estudios" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_estudios[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirelector" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Credencial de elector</label>
        {% if elector==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if elector==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if elector==0 %}
        <input type="file" id="archivo_elector" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_elector[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirfotografia" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Fotografía credencial</label>
        {% if fotografia==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if fotografia==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if fotografia==0 %}
        <input type="file" id="archivo_fotografia" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_fotografia[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subircaratula" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Carátula bancaria</label>
        {% if caratula==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if caratula==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if caratula==0 %}
        <input type="file" id="archivo_caratula" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_caratula[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
      <form class="form-vertical col-lg-3" id="frm_subirfiscal" enctype="multipart/form-data" class="form-vertical mt-1" novalidate>
        <label class="col-form-label title-busq">Constancia de situación fiscal</label>
        {% if fiscal==1 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-success" id="badge_modal_resument_tipoestudio_2">DOCUMENTO APROBADO</span></h5>
        {% endif %}
        {% if fiscal==3 %}
          <h5 class="" id="exampleModalLabel"><span class="pl-3 pr-3 pt-2 pb-2 badge badge-warning" id="badge_modal_resument_tipoestudio_2">PENDIENTE DE APROBAR</span></h5>
        {% endif %}
        {% if fiscal==0 %}
        <input type="file" id="archivo_fiscal" accept=".jpg, .jpeg, .png, .jfif, .pdf" name="archivo_fiscal[]" required />
        <div class="row col-lg-12">
          <div class="col-sm-6 col-md-6 text-center mt-5 ">
            <div class="form-group">
              <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Subir</button>
            </div>
          </div>
        </div>
        {% endif %}
      </form>
    </div>
  </div>
</div>
{% endif %}

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

                              <form method="post" target="_self" id="formcpassword" class="form-vertical mt-1">
                                          <div class="col-lg-12">
                                              <label class="col-form-label title-busq">Ingrese su contraseña actual</label>
                                              <input   name="password" type="password" class="form-control input-rounded" id="password" placeholder="Ingrese su contraseña actual" required />
                                  
                                            </div>
      
                                            <div class="col-lg-12">
                                                        <label class="col-form-label title-busq">Ingrese su nueva contraseña</label>
                                                        <input   name="password" type="password" class="form-control input-rounded" id="password1" placeholder="Ingrese su nueva contraseña" required />
                                              
                                            </div>
      
                                            <div class="col-lg-12">
                                                        <label class="col-form-label title-busq">Repita la contraseña</label>
                                                        <input   name="password" type="password" class="form-control input-rounded" id="password2" placeholder="Ingrese su nueva contraseña" required />
                                              
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


