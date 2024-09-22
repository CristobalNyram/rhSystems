<div class="tab-content">
  <div id="id-1" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          <div class="x_title">
            <h3>Crear País</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('pais/nuevo', 'id': 'pais_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
                    <div class="ln_solid"></div>
                    <div class="row ">
                      <div class="col-sm-4 col-xs-12">
                        <h5>Datos Generales</h5>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('pai_nombre') }}
                          {{ form.render('pai_nombre', ['class': 'form-control','required': 'true','placeholder':'Nombre del País']) }}
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('pai_estatus', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('pai_estatus', ['class': 'form-control']) }}
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-3 pull-right">
                          <button type="submit" class="btn-block btn-btnempresa submit ">Crear</button>
                        </div>
                        <div class="col-xs-3 pull-right">
                          <a href="{{ url('pais/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                            <li class="fa fa-times"></li> Cancelar
                          </a>
                          <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
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
    </div>
  </div>
</div>
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
