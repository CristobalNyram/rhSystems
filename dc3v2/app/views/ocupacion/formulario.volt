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
            <h3>Ocupación</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('ocupacion/formulario/'~clave, 'id': 'registro', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
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
                            {{ form.render(el[0], ['required': 'true']) }}
                          </div>
                        </div>
                        {% else %}
                    </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-3 pull-right">
                              {{ form.render(el[0]) }}
                            </div>
                            <div class="col-xs-3 pull-right">
                              <a href="{{ url('ocupacion/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
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
