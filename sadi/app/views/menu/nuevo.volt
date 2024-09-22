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
            <div class="mt-1"><span class="font-16 btn-link-crm">Crear Menú</span>
            </div>
          </div>
          <hr class="line-down">
          
          <!-- <div class="x_content"> -->


            <!-- Smart Wizard -->
            <!-- <div class="row"> -->
              <!-- <div class="col-sm-10 col-sm-offset-1 col-xs-12"> -->
                <!-- <div> -->
                  {{ form('menu/nuevo', 'id': 'menu_nuevo', 'class': 'form-vertical mt-1') }}
                  <!-- <form id="demo-form2" data-parsley-validate class="captura form-horizontal form-label-left"> -->
                    <div class="form-group row">
                      

                    <!-- <div class="row "> -->
                      <div class="col-lg-3">
                        {{ form.label('men_titulo',['class':'col-form-label title-busq']) }}
                        {{ form.render('men_titulo', ['class': 'form-control input-rounded','required': 'true','placeholder':'Nombre del menú']) }}
                      </div>
                      <div class="col-lg-3">
                        {{ form.label('men_padre',['class':'col-form-label title-busq']) }}
                        {{ form.render('men_padre', ['class': 'form-control input-rounded', 'placeholder':'Menú padre']) }}
                      </div>
                    <!-- </div> -->
                    <!-- <div class="row"> -->
                      <div class="col-lg-3">
                        {{ form.label('men_estatus', ['class':'col-form-label title-busq']) }}
                        {{ form.render('men_estatus', ['class': 'form-control select2-single bar-rightl']) }}
                      </div>
                      <div class="col-lg-3">
                        {{ form.label('men_orden',['class':'col-form-label title-busq']) }}
                        {{ form.render('men_orden', ['class': 'form-control input-rounded','required': 'true','placeholder':'Orden del menú']) }}
                      </div>

                      <div class="col-lg-3 col-9  text-right mt-5 offset-lg-6">
                          <div class="form-group">
                            <a href="{{ url('menu/index') }}" id="href_cancelar" class="btn-dark btn-rounded btn btn-limpiar">
                                Cancelar
                            </a>
                          </div>
                        </div>
                        <div class="col-lg-3 col-9  text-right mt-5 offset-lg-0">
                          <div class="form-group">
                            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Crear</button>
                          </div>
                        </div>
                      
                    <!-- </div> -->
                    {#
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-xs-3 pull-right">
                            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Crear</button>
                          </div>
                          <div class="col-xs-3 pull-right">
                            <a href="{{ url('menu/index') }}" id="href_cancelar" class="btn-dark btn-rounded btn btn-limpiar">
                              <li class="fa fa-times"></li> Cancelar
                            </a>
                            <!--<button type="submit" class="btn btn-block btn cancelar ">Cancelar</button> -->
                          </div>
                        </div>
                      </div>
                    #}
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

