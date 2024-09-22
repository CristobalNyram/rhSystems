<script type="text/javascript">
	$(document).ready(function() {

  $('.js-example-basic-multiple').select2();
  });
	function reporte()
	{
		usuario=$("#usu_id").val();
		departamento=$("#dep_id").val();
		url="<?php echo $this->url->get('usuario/genpdf/') ?>";
		url=url+usuario+"/"+departamento;
		window.open(url, '_blank');
	}
</script>
<section class="content-header">
	<h1>
		Reportes
		<small>
			Estatus de personal
		</small>
	</h1>
</section>
<section class="content">
	{{ form('usuario/reporte', 'id': 'usuariorep', 'class': 'tab-pane fade in active','data-parsley-validate') }}
		<div class="row x_panel margin-top shadow">
			<br>
			<div class="col-xs-12 col-sm-3">
				<select name="usu_id" id="usu_id" class="js-example-basic-multiple form-control">
					<option value="-1">Seleccionar (opcional)</option>
					{% if acceso.verificar(105,pue_id)==1 %}
					{% for usu in usuario %}
					<option value="{{usu.usu_id}}" {% if indexusu== usu.usu_id%} selected {% endif %}>{{usu.usu_nombre}} {{usu.usu_apellidop}} {{usu.usu_apellidom}}</option>
					{% endfor %}
					{% endif %}
				</select>
				<span class="text-center">Colaborador</span>
			</div>
			<div class="col-xs-6 col-sm-3">
				<select name="dep_id" id="dep_id" class="js-example-basic-multiple form-control">
					<option value="-1">Seleccionar (opcional)</option>
					{% if acceso.verificar(105,pue_id)==1 %}
					{% for dep in departamento %}
					<option value="{{dep.dep_id}}" {% if indexdep== dep.dep_id%} selected {% endif %}>{{dep.dep_nombre}}</option>
					{% endfor %}
					{% endif %}
				</select>
				<span class="text-center">Unidad de venta</span>
			</div>
			<div class="col-xs-6 col-sm-3">
				<select name="pue_id" id="pue_id" class="js-example-basic-multiple form-control">
					<option value="-1">Seleccionar (opcional)</option>
					{% if acceso.verificar(105,pue_id)==1 %}
					{% for pue in apuesto %}
					<option value="{{pue.pue_id}}" {% if indexpue== pue.pue_id%} selected {% endif %}>{{pue.pue_nombre}}</option>
					{% endfor %}
					{% endif %}
				</select>
				<span class="text-center">Puesto</span>
			</div>

			<div class="col-xs-12 col-sm-2">
				<button type="submit" class="btn btn-btnempresa"><i class="glyphicon glyphicon-search" title ="Buscar"></i> Buscar</button>
			</div>
			<div class="col-xs-12 col-sm-1">
			<!--	<a id="btn_descargar" class="btn btn-btnempresa" onclick="reporte()"><i class="fa fa-cloud-download" title ="Descargar"></i></a>-->
			</div>
		</div>
	</form>
	<div id="contenido" data-spy="scroll" style="overflow-y: scroll; max-height: 500px">
		{%for index,inf in info %}
		<div class="tab-pane fade in active">
			<div class="x_panel margin-top shadow">
				<div class="row">
					<div class="col-xs-2">
						{{ image("images/fotos/" ~ inf.usu_foto,"alt":"" ,"class": "profile_pic") }}
						
					</div>
					<div class="col-xs-5">
						<h4>{{inf.usu_nombre}} {{inf.usu_apellidop}} {{inf.usu_apellidom}} <small>{{inf.pue_nombre}}</small></h4>
						<h5>{{inf.dep_nombre}}</h5>
						<h5>{{inf.usu_correo}} <small>(Ext. {{inf.usu_extension}})</small></h5>
					</div>
					<div class="col-xs-5">
						<h4>Estatus: {%if inf.usu_estatus==2 %} 
														Alta
													{% else %}
														Baja
													{% endif %}
						</h5>
					</div>
				</div>
				<br>
			</div>
		</div>
		{% endfor %}
	</div>

</section>