  <script type="text/javascript">
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
      });
      var nextinput = 0;
      function AgregarCampos(){
      nextinput++;
      campo='<div id="centro'+nextinput+'"><label for="emp_razonsocial" class="control-label">CENTRO DE TRABAJO NÚM. '+nextinput+'</label><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Ubicación</label><input type="text" id="ubicacion'+nextinput+'" name="ubicacion[]" class="form-control" maxlength="150" placeholder="Ubicación" required="true" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Nombre de rep legal</label><input type="text" id="nomrep_legal'+nextinput+'" name="nomrep_legal[]" class="form-control" maxlength="150" placeholder="Nombre de rep legal" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Primer apellido de rep legal</label><input type="text" id="primrep_legal'+nextinput+'" name="primrep_legal[]" class="form-control" maxlength="150" placeholder="Primer apellido de rep legal" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Segundo apellido de rep legal</label><input type="text" id="segunrep_legal'+nextinput+'" name="segunrep_legal[]" class="form-control" maxlength="150" placeholder="Segundo apellido de rep legal" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Nombre de rep de trabajadores</label><input type="text" id="nomrep_trabaja'+nextinput+'" name="nomrep_trabaja[]" class="form-control" maxlength="150" placeholder="Nombre de rep de trabajadores" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Primer apellido de rep de trabajadores</label><input type="text" id="primrep_trabaja'+nextinput+'" name="primrep_trabaja[]" class="form-control" maxlength="150" placeholder="Primer apellido de rep de trabajadores" aria-required="true"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="emp_razonsocial" class="control-label">Segundo apellido de rep de trabajadores</label><input type="text" id="segunrep_trabaja'+nextinput+'" name="segunrep_trabaja[]" class="form-control" maxlength="150" placeholder="Segundo apellido de rep de trabajadores" aria-required="true"></div></div></div>';
      $("#campos").append(campo);
      document.getElementById('quitar').disabled = false;
      }

      function QuitarCampos(){
        remo="#centro"+nextinput;
        $(remo).remove();
        nextinput--;
        if(nextinput==0){
          document.getElementById('quitar').disabled = true;
        }
      }

  </script>
  <div class="tab-content">
    <div id="id-1" class="tab-pane fade in active">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="formulario-largo" class="x_panel margin-top shadow">
            <div class="x_title">
              <h3>Empresa</h3>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <!-- Smart Wizard -->
              <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                  <div>
                    {{ form('empresa/formulario/'~clave, 'id': 'registro', 'class': 'captura form-horizontal form-label-left','data-parsley-validate','enctype':'multipart/form-data') }}
                      <div class="ln_solid"></div>
                      <div class="row ">
                        <div class="col-sm-4 col-xs-12">
                          <h5>Datos Generales</h5>
                        </div>
                      </div>
                      <div class="row ">
                        {% for el in clases %}
                          {% if loop.last == false%}
                          <div class="{{el[1]}}">
                            <div class="form-group">
                              {{ form.label(el[0], ['class': el[2]]) }}
                              {{ form.render(el[0]) }}
                            </div>
                          </div>
                          {% else %}
                          {% if val == 1%}
                            <a href="#campos" class="btn btn-btnempresa" onclick="AgregarCampos();"><li class="fa fa-plus"></li>Agregar centro de trabajo</a>
                            <div id="campos">
                            </div>
                            <button href="#campos" type='button' disabled='disabled' id='quitar' class="btn cancelar" onclick="QuitarCampos();"><li class="fa fa-plus"></li>Eliminar centro de trabajo</button>
                          {% endif %}
                      </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-xs-3 pull-right">
                                {{ form.render(el[0]) }}
                              </div>
                              <div class="col-xs-3 pull-right">
                                <a href="{{ url('empresa/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                                  <li class="fa fa-times"></li> Cancelar
                                </a>
                                <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
                              </div>
                            </div>
                          </div>
                          {% endif %}
                        {% endfor%}
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{ javascript_include('js/validaciones/pais/validaciones.js') }}
