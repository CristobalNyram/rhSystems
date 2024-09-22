<script type="text/javascript">
  function cambiarestados() {
    divListado = document.getElementById('estado');
    pais=document.getElementById("pai_id").value;
        urlpais="<?php echo $this->url->get('estado/lista/') ?>";
        urlpais=urlpais+pais;
        $.post(urlpais, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
        }).done(function() { 
        }).fail(function() {
        })
    }
  function cambiarsubunidad() {
    divListado1 = document.getElementById('subunidad');
    unidad=document.getElementById("dep_id").value;
        url="<?php echo $this->url->get('subdepartamento/lista/') ?>";
        url=url+unidad;
        $.post(url, $(this).serialize() , function(data)
        {
            divListado1.innerHTML=data;
        }).done(function() { 
        }).fail(function() {
        })
    }
  function iniciarselect(){
    cambiarestados();
    cambiarsubunidad();
    
  }
</script>
<div class="tab-content">
  <div id="id-1" class="tab-pane fade in active">


    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          <div class="x_title">

             <div class="row">
             <div  style="margin:8px 0 0 15px;display:inline-block;width:100px;float:left;"> 
              {{ link_to("usuario/index/", 'Atrás', "class": "btn btn-back","title":"Atrás") }}
            </div>
            <div class="col-sm-9">
            <h3>Perfil de Usuario</h3>
          </div>
          </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Smart Wizard -->
            {{ form('usuario/nuevo', 'id': 'usuario_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate','onbeforesubmit': 'return false') }}
            <div id="wizard" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                <li>
                  <a href="#step-1">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                      Paso 1<br />
                      <small>Datos Personales</small>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="#step-2">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                      Paso 2<br />
                      <small>Datos Institucionales</small>
                    </span>
                  </a>
                </li>
              </ul>
              <div id="step-1">
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                    <div>
                      <div class="x_title">
                        <h4>Añadir Nuevo Usuario</h4>
                        <div class="clearfix"></div>
                      </div>
                      

                        <div class="row padder text-center">
                          <div class="col-sm-12 col-xs-12">
                            <div>
                              <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                  {{ form.label('usu_id') }}
                                  {{ form.render('usu_id', ['class': 'form-control','required': 'true','placeholder':'0000000']) }}
                                </div>
                              </div>
                              <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                  {{ form.label('usu_password') }}
                                  {{ form.render('usu_password', ['class': 'form-control','required': 'true','placeholder':'●●●●●●●']) }}
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
                              {{ form.label('usu_nombre') }}
                              {{ form.render('usu_nombre', ['class': 'form-control','required': 'true','placeholder':'Nombre(s)']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_apellidop') }}
                              {{ form.render('usu_apellidop', ['class': 'form-control','required': 'true','placeholder':'Apellido Paterno']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_apellidom') }}
                              {{ form.render('usu_apellidom', ['class': 'form-control','placeholder':'Apellido Materno']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_rfc') }}
                              {{ form.render('usu_rfc', ['class': 'form-control','required': 'true','placeholder':'RFC']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_curp') }}
                              {{ form.render('usu_curp', ['class': 'form-control','required': 'true','placeholder':'CURP']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_nss') }}
                              {{ form.render('usu_nss', ['class': 'form-control','required': 'true','placeholder':'NSS']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_correo_personal') }}
                              {{ form.render('usu_correo_personal', ['class': 'form-control','placeholder':'Correo personal']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_fechanacimiento') }}
                              {{ form.render('usu_fechanacimiento', ['class': 'form-control','required': 'true','placeholder':'Fecha de nacimiento']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_celular') }}
                              {{ form.render('usu_celular', ['class': 'form-control','required': 'true','placeholder':'Número móvil']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_sexo') }}
                              {{ form.render('usu_sexo', ['class': 'form-control','required':'true','placeholder':'Sexo']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_estcivil') }}
                              {{ form.render('usu_estcivil', ['class': 'form-control','required': 'true','placeholder':'Estado Civil']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_hijos') }}
                              {{ form.render('usu_hijos', ['class': 'form-control','required': 'true','placeholder':'Número de hijos']) }}
                            </div>
                          </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="row padder">
                          <div class="col-sm-4 col-xs-12">
                            <h5>Dirección</h5>
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_calle') }}
                              {{ form.render('usu_calle', ['class': 'form-control','required': 'true','placeholder':'Calle']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_exterior') }}
                              {{ form.render('usu_exterior', ['class': 'form-control','required': 'true','placeholder':'# Ext.']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_interior') }}
                              {{ form.render('usu_interior', ['class': 'form-control','required': 'true','placeholder':'# Int.']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_colonia') }}
                              {{ form.render('usu_colonia', ['class': 'form-control','required': 'true','placeholder':'Colonia']) }}
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_municipio') }}
                              {{ form.render('usu_municipio', ['class': 'form-control','required': 'true','placeholder':'Municipio']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row ">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('pai_id') }}
                              {{ form.render('pai_id', ['class': 'form-control','placeholder':'Pais','onchange':'cambiarestados()']) }}
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('est_id') }}
                              <div id='estado'>
                                {{ form.render('est_id', ['class': 'form-control','placeholder':'Estado','onclick':'cambiarestados()']) }}
                              </div>
                            </div>
                          </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div id="step-2">
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                      <div class="x_title">
                        <h4>Perfil Empresarial</h4>
                        <div class="clearfix"></div>
                      </div>
                      
                        <div class="row ">
                          <div class="col-sm-4 col-xs-12">
                            <h5>Datos de usuario empresa</h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12">
                            {{ form.label('soc_id', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('soc_id', ['class': 'form-control']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('tco_id') }}
                              {{ form.render('tco_id', ['class': 'form-control','placeholder':'Tipo de Contrato']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('tjo_id') }}
                              {{ form.render('tjo_id', ['class': 'form-control','placeholder':'Tipo de Jornada']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 col-xs-12">
                            {{ form.label('usu_estatus', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('usu_estatus', ['class': 'form-control']) }}
                            </div>
                          </div>
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_proxevaluacion') }}
                              {{ form.render('usu_proxevaluacion', ['class': 'form-control','required': 'true','placeholder':'']) }}
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_licenciatura') }}
                              {{ form.render('usu_licenciatura', ['class': 'form-control','placeholder':'Derecho']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_experiencia') }}
                              {{ form.render('usu_experiencia', ['class': 'form-control','placeholder':'Experiencia']) }}
                            </div>
                          </div>
                          <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_cuotahora') }}
                              {{ form.render('usu_cuotahora', ['class': 'form-control','placeholder':'$']) }}
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              <div class="form-group">
                                {{ form.label('dep_id') }}
                                {{ form.render('dep_id', ['class': 'form-control','placeholder':'Unidad de venta','onchange':'cambiarsubunidad()']) }}
                               </div>
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('sde_id') }}
                              <div id='subunidad'>
                                {{ form.render('sde_id', ['class': 'form-control','placeholder':'Sub Departamento']) }}
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_jefe') }}
                               {{ form.render('usu_jefe', ['class': 'form-control','placeholder':'Jefe']) }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-4 col-xs-12">
                          <div class="form-group">
                            {{ form.label('pue_id') }}
                              {{ form.render('pue_id', ['class': 'form-control','placeholder':'Puesto']) }}
                          </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                          <div class="form-group">
                            {{ form.label('usu_fechaingreso') }}
                            {{ form.render('usu_fechaingreso', ['class': 'form-control','required': 'true','placeholder':'']) }}
                          </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                          <div class="form-group">
                            {{ form.label('usu_vigenciavacaciones') }}
                            {{ form.render('usu_vigenciavacaciones', ['class': 'form-control','required': 'true','placeholder':'Vigencia']) }}
                          </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_correo') }}
                              {{ form.render('usu_correo', ['class': 'form-control','required': 'true','placeholder':'Correo corporativo']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_telefono') }}
                              {{ form.render('usu_telefono', ['class': 'form-control','required': 'true','placeholder':'Teléfono']) }}
                            </div>
                          </div>
                          <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                              {{ form.label('usu_extension') }}
                              {{ form.render('usu_extension', ['class': 'form-control','required': 'true','placeholder':'(222)']) }}
                            </div>
                          </div>
                        </div>


                      <div class="ln_solid"></div>

                      <div class="row ">
                        <div class="col-sm-4 col-xs-12">
                          <h5>Datos Bancarios</h5>
                        </div>
                      </div>
                      <div class="row ">
                        <div class="col-sm-6 col-xs-12">
                          <div class="form-group">
                            {{ form.label('usu_nocuenta') }}
                            {{ form.render('usu_nocuenta', ['class': 'form-control','required': 'true','placeholder':'(10 dígitos)']) }}
                          </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <div class="form-group">
                            {{ form.label('ban_id') }}
                            {{ form.render('ban_id', ['class': 'form-control','placeholder':'Banco']) }}
                          </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                    <!-- </form> -->
                  </div>
                </div>
              </div>

            </div>
            </form>
          </div>




        </div>
      </div>
    </div>
  </div>
</div>
{{ javascript_include('js/validaciones/usuario/validaciones.js') }}
{{ javascript_include('js/wizard/jquery.smartWizard.js') }}
<script type="text/javascript">
window.onload = iniciarselect();
$(document).ready(function() {
  // Smart Wizard
  // stepsWizard.steps("next");
  $('#wizard').smartWizard({onFinish:onFinishCallback,keyNavigation: false});
  

  function onFinishCallback() {
    $("#step-1").show();
    $("#usuario_nuevo").submit();
    $("#step-1").hide();
  }
});

$(document).ready(function() {
  // Smart Wizard
  $('#wizard_verticle').smartWizard({
    transitionEffect: 'slide'
  });
  
  
});
</script>
