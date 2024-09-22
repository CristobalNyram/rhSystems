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
            <h3>Registrar documento</h3>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Smart Wizard -->
            <div class="row">
              <div class="col-sm-10 col-sm-offset-1 col-xs-12">
                <div>
                  {{ form('documento/nuevo', 'id': 'documento_nuevo', 'class': 'captura form-horizontal form-label-left','data-parsley-validate','enctype':'multipart/form-data') }}
                    <div class="ln_solid"></div>
                    <div class="row ">
                      <div class="col-sm-4 col-xs-12">
                        <h5>Datos Generales</h5>
                      </div>
                    </div>

                    <div class="row ">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('usu_id') }}
                          {{ form.render('usu_id', ['class': 'form-control js-example-basic-multiple','required': 'true']) }}
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('doc_tipo') }}
                          {{ form.render('doc_tipo', ['class': 'form-control','required': 'true','placeholder':'Tipo']) }}
                        </div>
                      </div>
                    </div>
                    <div class="row ">
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('doc_comentario') }}
                          {{ form.render('doc_comentario', ['class': 'form-control','required': 'true','placeholder':'Comentario']) }}
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                          {{ form.label('doc_archivo', ['class': 'control-label']) }}
                            <div class="controls">
                            {{ form.render('doc_archivo', ['class': 'form-control']) }}
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
                          <a href="{{ url('documento/index') }}" id="href_cancelar" class="btn btn-block btn cancelar ">
                            <li class="fa fa-times"></li> Cancelar
                          </a>
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
