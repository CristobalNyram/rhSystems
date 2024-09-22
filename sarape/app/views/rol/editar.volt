<script type="text/javascript">
  $(document).ready(function() {
    $('.select2-single').select2();
  });
</script>
<div class="mt-3">
  <div class="card card-crm">
    <div class="text-center col-md-12">
      <div class="mt-1"><span class="font-16 btn-link-crm">Editar rol</span>
      </div>
    </div>
    <hr class="line-down">
    {{ form('rol/editar/', 'id': 'puesto_editar', 'class': 'form-vertical mt-1') }}
      <div class="form-group row">
        <div class="col-lg-1">
            {{ form.label('rol_id',['class':'col-form-label title-busq']) }}
            {{ form.render('rol_id', ['class': 'form-control input-rounded-disabled data-not-lt-active','required': 'true','placeholder':'ID del rol','readonly': 'true','style':'cursor: not-allowed;']) }}
        </div>
        <div class="col-lg-2">
            {{ form.label('rol_nombre',['class':'col-form-label title-busq']) }}
            {{ form.render('rol_nombre', ['class': 'form-control input-rounded','required': 'true','placeholder':'Nombre del rol','onkeyup':'javascript:this.value=this.value.toUpperCase();']) }}
        </div>      
        <div class="col-lg-2">
            {{ form.label('rol_estatus',['class':'col-form-label title-busq']) }}
            {{ form.render('rol_estatus', ['class': 'form-control select2-single bar-right']) }}
        </div>
        <div class="col-lg-4">
            {{ form.label('rol_descripcion',['class':'col-form-label title-busq']) }}
            {{ form.render('rol_descripcion', ['class': 'form-control input-rounded','required': 'true','placeholder':'Descripción del rol','onkeyup':'javascript:this.value=this.value.toUpperCase();']) }}                        
        </div>
        <div class="col-lg-2">
          {{ form.label('rol_nivel', ['class': 'col-form-label title-busq']) }}
          {{ form.render('rol_nivel', ['class': 'form-control select2-single bar-right']) }}
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
    </form>
  </div>
</div>
{{ javascript_include('js/validaciones/pais/validaciones.js') }}
