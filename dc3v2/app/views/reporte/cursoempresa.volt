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
            <h3>Cursos por empresa</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('reporte/cursoempresa', 'id': 'estado_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate') }}
                  <!-- <form id="demo-form2" data-parsley-validate class="captura form-horizontal form-label-left"> -->

                    <div class="ln_solid"></div>
                    <div class="row ">
                      <div class="col-sm-12 col-xs-12">
                        <h5>Seleccione la empresa de la cual desea saber los cursos que se le han otorgado</h5>
                      </div>
                    </div>

                    <div class="row ">
                      
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('emp_id') }}
                          {{ form.render('emp_id', ['class': 'js-example-basic-multiple form-control','placeholder':'Empresa']) }}
                        </div>
                      </div>
                    </div>
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-xs-3 pull-right">
                          <button type="submit" class="btn-block btn-btnempresa submit ">Descargar reporte</button>
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
{{ javascript_include('js/validaciones/estado/validaciones.js') }}
