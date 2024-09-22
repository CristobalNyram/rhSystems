<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
<div class="tab-content">
  <div id="id-1" class="tab-pane fade in active">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="formulario-largo" class="x_panel margin-top shadow">
          <div class="x_title">
            <h3>Crear Curso</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('curso/nuevo', 'id': 'curso_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
                    <div class="ln_solid"></div>
                    <div class="row ">
                      <div class="col-sm-4 col-xs-12">
                        <h5>Datos Generales</h5>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-sm-9 col-xs-12">
                        <div class="form-group">
                          {{ form.label('cur_nombre') }}
                          {{ form.render('cur_nombre', ['class': 'form-control','required': 'true','placeholder':'Nombre del curso']) }}
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-12">
                        <div class="form-group">
                          {{ form.label('cur_horas') }}
                          {{ form.render('cur_horas', ['class': 'form-control','required': 'true','placeholder':'Horas del curso']) }}
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                          {{ form.label('are_id', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('are_id', ['class': 'js-example-basic-multiple form-control']) }}
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                          {{ form.label('cur_tipo', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('cur_tipo', ['class': 'form-control']) }}
                            </div>
                        </div>
                      </div>
                      <div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                          {{ form.label('cur_estatus', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('cur_estatus', ['class': 'form-control']) }}
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
                          <a href="{{ url('curso/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
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
