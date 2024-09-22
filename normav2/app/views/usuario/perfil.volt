<script>
  campas="<?php echo $this->url->get('usuario/editarpassword') ?>";
</script>
{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}
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
<!-- inicio de modal -->



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
