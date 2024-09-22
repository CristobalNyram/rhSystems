<script>
  campas="<?php echo $this->url->get('usuario/editarpassword') ?>";
</script>
{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}
<div id="backcolor" class="container-fluid text-center">
  <div class="text-left border-left"><h3>Mi Perfil</h3>
  </div>
  <br>

  <div id="perfil_content" class="container">
    <div id="historial" class="col-sm-12">
      <div class="text-right">
        <!--<a id="btn_editpassword" class="btn btn-info btn-sm">CAMBIAR CONTRASEÑA <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#cpassword" class="btn btn-info btn-sm">CAMBIAR CONTRASEÑA</a>
        <!-- <a id="btn_edit" class="btn btn-primary btn-sm">EDITAR INFORMACIÓN <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --> 
      </div>

      <div class="x_content">


            <!-- Smart Wizard -->
            {{ form('', 'id': 'perfil', 'class': 'captura form-horizontal form-label-left','data-parsley-validate','onbeforesubmit': 'return false') }}
            <div id="wizard" class="form_wizard wizard_horizontal">
              <div id="step-1">
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                    <div>
                      <div class="x_title">
                        <h4>Datos Personales</h4>
                        <div class="clearfix"></div>
                      </div>
                      

                        <div class="row padder text-center">
                          <div class="col-sm-12 col-xs-12">
                            <div>
                              <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>ID</label>
                                  <input value='{{usuario.usu_id}}' class='form-control' disabled readonly></input>
                                  
                                </div>
                              </div>
                              <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>Contraseña</label>
                                  <input value='●●●●●●●' class='form-control' disabled readonly></input>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row ">
                          <div class="col-sm-4 col-xs-12">
                            <h5>Perfil</h5>
                          </div>
                        </div>

                        <div class="row ">
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              <label>Nombre(s)</label>
                              <input value='{{usuario.usu_nombre}}' class='form-control' disabled readonly></input>
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              <label>Primer apellido</label>
                              <input value='{{usuario.usu_primerapellido}}' class='form-control' disabled readonly></input>
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              <label>Segundo apellido</label>
                              <input value='{{usuario.usu_segundoapellido}}' class='form-control' disabled readonly></input>
                            </div>
                          </div>
                          <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                              <label>Correo electrónico</label>
                              <input value='{{usuario.usu_correo}}' class='form-control' disabled readonly></input>
                            </div>
                          </div>
                        </div>
                        <div class="ln_solid"></div>                       
                    </div>
                  </div>
                </div>
              </div>
              

            </div>
            </form>
          </div>
    </div>
  </div>
</div>
<div id="cpassword" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <form method="post" target="_self" id="formcpassword">
      <div class="modal-content" id="contentSession">
        <!--lo que esta entre esto cambia con ajax-->

        <div class="modal-header">
          <h5 class="modal-title">CAMBIAR CONTRASEÑA</h5>
          <!--begin::Close-->
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
            <span class="svg-icon svg-icon-2x">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                  <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                  <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                </g>
              </svg>
            </span>
            <!--end::Svg Icon-->
          </div>
          <!--end::Close-->
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <input name="password" type="password" class="form-control" id="password" placeholder="Ingrese su contraseña actual" required/><br>
            <input name="password1" type="password" class="form-control" id="password1" placeholder="Ingrese su nueva contraseña" required/><br>
            <input name="password2" type="password" class="form-control" id="password2" placeholder="Repita la contraseña" required/><br>
            <button type="submit" class="btn btn-primary btn-block" >Cambiar contraseña</button>

          </fieldset>
        </div>
      </div>

    </form>
  </div>
</div>
