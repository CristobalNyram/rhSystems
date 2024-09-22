<script type="text/javascript">
    $(document).ready(function() {
        $('.select2-single').select2();
    });
</script>
<!-- <div class="tab-content"> -->
  <!-- <div id="id-1" class="tab-pane fade in active"> -->
    <div class="mt-3">
      <div class="card card-crm">
        <!-- <div id="formulario-largo" class="x_panel margin-top shadow"> -->
          <div class="text-center col-md-12">
            <div class="mt-1"><span class="font-16 btn-link-crm">Usuario</span>
            </div>
          </div>
          <hr class="line-down">
          
          <!-- <div class="x_content"> -->
            <!-- Smart Wizard -->
            <!-- <div class="row"> -->
              <!-- <div class="col-sm-10 col-sm-offset-1 col-xs-12"> -->
                <!-- <div> -->
                  {{ form('usuario/formulario/'~clave, 'id': 'registro', 'class': 'form-vertical mt-1') }}
                    <div class="form-group row">
                      {% for el in clases %}
                        {% if loop.last == false%}
                        <div class="{{el[1]}}">
                          <!-- <div class="form-group"> -->
                            {{ form.label(el[0], ['class': el[2]]) }}
                            {{ form.render(el[0], ['required': 'true']) }}
                          <!-- </div> -->
                        </div>
                        {% else %}

                        <div class="col-lg-3 col-9  text-right mt-5 offset-lg-6">
                          <div class="form-group">
                            <a href="{{ url('usuario/index') }}" id="href_cancelar" class="btn-dark btn-rounded btn btn-limpiar">
                                Cancelar
                            </a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-9  text-right mt-5 offset-lg-0">
                          <div class="form-group">
                            {{ form.render(el[0]) }}
                          </div>
                        </div>
                      
                      {#
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-xs-3 pull-right">
                              {{ form.render(el[0]) }}
                            </div>
                            <div class="col-xs-3 pull-right">
                              <a href="{{ url('usuario/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                                <li class="fa fa-times"></li> Cancelar
                              </a>
                              <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
                            </div>
                          </div>
                        </div>
                      #}
                        {% endif %}
                      {% endfor%}
                      </div>
                  </form>
                <!-- </div> -->
              <!-- </div> -->
            <!-- </div> -->
          <!-- </div> -->
        <!-- </div> -->
      </div>
    </div>
  <!-- </div> -->
<!-- </div> -->
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
