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
            <div class="mt-1"><span class="font-16 btn-link-crm">Crear rol</span>
            </div>
          </div>
          <hr class="line-down">
          <!-- <div class="x_title">
            <h3>Crear rol</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content"> -->


            <!-- Smart Wizard -->
            <!-- <div class="row"> -->
              <!-- <div class="col-sm-10 col-sm-offset-1 col-xs-12"> -->
                <!-- <div> -->
                  {{ form('rol/nuevo', 'id': 'rol_nuevo', 'class': 'form-vertical mt-1') }}
                  <!-- <form id="demo-form2" data-parsley-validate class="captura form-horizontal form-label-left"> -->
                    <div class="form-group row">
                      <div class="col-lg-3">
                        {{ form.label('rol_nombre',['class':'col-form-label title-busq']) }}
                        {{ form.render('rol_nombre', ['class': 'form-control input-rounded data-not-lt-active','required': 'true','placeholder':'Nombre del rol','onkeyup':'javascript:this.value=this.value.toUpperCase();']) }}
                      </div>
                      <div class="col-lg-4">
                        {{ form.label('rol_descripcion',['class':'col-form-label title-busq']) }}
                        {{ form.render('rol_descripcion', 
                        ['class': 'form-control input-rounded', 'placeholder':'Descripción del rol','onkeyup':'javascript:this.value=this.value.toUpperCase();']
                        ) }}
                      </div>
                    
                      <div class="col-lg-2">
                          {{ form.label('rol_estatus', ['class': 'col-form-label title-busq']) }}
                          {{ form.render('rol_estatus', ['class': 'form-control select2-single bar-right']) }}
                      </div>
                      <div class="col-lg-2">
                        {{ form.label('rol_nivel', ['class': 'col-form-label title-busq']) }}
                        {{ form.render('rol_nivel', ['class': 'form-control select2-single bar-right']) }}
                     </div>
                     <div class="col-lg-6">
                        {{ form.label('rol_trasolicitar', ['class': 'col-form-label title-busq']) }}
                        {{ form.render('rol_trasolicitar', ['class': 'form-control input-rounded']) }}
                     </div>
                     <div class="col-lg-6">
                        {{ form.label('rol_traaprobar', ['class': 'col-form-label title-busq']) }}
                        {{ form.render('rol_traaprobar', ['class': 'form-control input-rounded']) }}
                     </div>
                      <div class="col-lg-3 col-9  text-right mt-5 offset-lg-6">
                        <div class="form-group">
                          <a href="{{ url('rol/index') }}" id="href_cancelar" class="btn-dark btn-rounded btn btn-limpiar">
                              Cancelar
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-9  text-right mt-5 offset-lg-0">
                        <div class="form-group">
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar submit ">Guardar</button>
                        </div>
                      </div>
                      
                    </div>
                    {#
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-3 pull-right">
                          <button type="submit" class="btn-block btn-btnempresa submit ">Crear</button>
                        </div>
                        <div class="col-xs-3 pull-right">
                          <a href="{{ url('rol/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                            <li class="fa fa-times"></li> Cancelar
                          </a>
                          <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
                        </div>
                      </div>
                    </div>
                    #}
                  </form>
                <!-- </div>
              </div>

            </div>

          </div>
        </div> -->
      </div>
    </div>
  <!-- </div>
</div> -->
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
