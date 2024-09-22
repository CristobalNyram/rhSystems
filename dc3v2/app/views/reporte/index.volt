<!-- <div style="padding-top: 50px"> -->
<script type="text/javascript">
    $(document).ready(function() 
    {
    	$('#td_dat').DataTable(
    		{
              "pageLength": 50,
              // "order": [[ 4, "desc" ]],
              scrollY:        "300px",
              scrollX:        true,
              scrollCollapse: true
            }
    		);
    	$('.js-example-basic-multiple').select2();
        
    } );
</script>

<div class="row">
	<h1>Reporte general de cursos</h1>
	<div class="col-xs-12">
		{{ form('', 'id': 'index','data-parsley-validate') }}
			<div class="container">
				
				<div>
					

					
				<!-- </div>
				<div class="container"> -->
					<div class="col-xs-3 col-sm-3">
						<select name="cur_id" id="cur_id" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							{% for cur in curso %}
							<option value="{{cur.cur_id}}" {% if indexcur== cur.cur_id%} selected {% endif %}>{{cur.cur_nombre}}</option>
							{% endfor %}
						</select>
						<span class="text-center">Curso</span>
					</div>
					<div class="col-xs-2 col-sm-2">
						<select name="cuo_tipo" id="cuo_tipo" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							<option value="1" {% if indextipo== 1 %} selected {% endif %}>Cerrado</option>
							<option value="2"{% if indextipo== 2 %} selected {% endif %}>Abierto</option>
							<option value="3"{% if indextipo== 3 %} selected {% endif %}>En línea</option>
						</select>
						<span class="text-center">Tipo de curso</span>
					</div>
					<div class="col-xs-2 col-sm-2">
						<select name="participantes" id="participantes" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							<option value="1" {% if indexparti== 1 %} selected {% endif %}>SI</option>
						</select>
						<span class="text-center">Ver participantes</span>
					</div>
					<div class="col-xs-3 col-sm-3">
						<select name="emp_id" id="emp_id" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							{% for emp in empresa %}
							<option value="{{emp.emp_id}}" {% if indexemp== emp.emp_id%} selected {% endif %}>{{emp.emp_razonsocial}}</option>
							{% endfor %}
						</select>
						<span class="text-center">Empresa</span>
					</div>
				</div>
				<div>	
					<div class="col-xs-2 col-sm-2">
						<select name="are_id" id="are_id" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							{% for are in area %}
							<option value="{{are.are_id}}" {% if indexare== are.are_id%} selected {% endif %}>{{are.are_denominacion}}</option>
							{% endfor %}
						</select>
						<span class="text-center">Área temática</span>
					</div>
					
					<div class="col-xs-3 col-sm-3">
						<select name="adm_id" id="adm_id" class="js-example-basic-multiple form-control">
							<option value="-1">Seleccionar</option>
							{% for adm in admin %}
							<option value="{{adm.adm_id}}" {% if indexadm== adm.adm_id%} selected {% endif %}>{{adm.adm_nombre}}</option>
							{% endfor %}
						</select>
						<span class="text-center">Administrador</span>
					</div>

				<div class="col-xs-3 col-sm-3">
					<select name="ins_id" id="ins_id" class="js-example-basic-multiple form-control">
						<option value="-1">Seleccionar</option>
						{% for ins in instructor %}
						<option value="{{ins.ins_id}}" {% if indexins== ins.ins_id%} selected {% endif %}>{{ins.ins_nombre}} {{ins.ins_primerapellido}} {{ ins.ins_segundoapellido }}</option>
						{% endfor %}
					</select>
					<span class="text-center">Instructor</span>
				</div>
				</div>
				<div class="col-xs-2 col-sm-2">
					<input class="form-control" type="date" id="fecha_ini" name="fecha_ini" value="{{fechaini}}"></input>
					<span>Fecha inicio</span>
				</div>
				<div class="col-xs-2 col-sm-2">
					<input class="form-control" type="date" id="fecha_fin" name="fecha_fin" value="{{fechafin}}"></input>
					<span>Fecha fin</span>
				</div>

				
                <button type="submit" class="btn btn-btnempresa" onclick=this.form.action="{{ url('reporte/index') }}"><i class="fa fa-search"></i> Buscar</button>

                <button type="submit" class="btn btn-btnempresa" onclick=this.form.action="{{ url('reporte/descargar') }}"><i class="fa fa-download"></i> Descargar</button>
			</div>
		</form>
	</div>
	
</div>
<br>
{% for dat in datos %}
    {% if loop.first %}
		<div class="table-responsive" id="lista-agrupada" style="padding-right: 20px; padding-left: 20px;">
		    <table id="td_dat" class="table table-striped table-bordered" cellspacing="0"  align="center">
		        <thead>
		            <tr>
		            	{% if indexparti== 1 %}
		            		<th>Participante</th>
		            	{% endif %}
		            	<th>Clave del curso realizado</th>
		                <th>Curso</th>
		                <th>Empresa</th>
		                <th>Área temática</th>
		                <th>Fecha inicial</th>
		                <th>Fecha final</th>
		                <th>Administrador</th>
		                <th>Instructor</th>

		            </tr>
		        </thead>
		        <tbody>
		        {% endif %}
		            <tr>
		            	{% if indexparti== 1 %}
		            		<td>{{ dat.tra_nombre }} {{ dat.tra_primerapellido }} {{ dat.tra_segundoapellido }}</td>
		            	{% endif %}
		            	<td>{{ dat.cuo_clave }}</td>
		            	<td>{{ dat.cur_nombre }}</td>
		                <td>{{ dat.emp_razonsocial }}</td>
		                <td>{{ dat.are_denominacion }}</td>
		                <td>{{ dat.cuo_fechainicio }}</td>
		                <td>{{ dat.cuo_fechafinal }}</td>
		                <td>{{ dat.adm_nombre }}</td>
		                <td>{{ dat.ins_nombre }} {{ dat.ins_primerapellido }} {{ dat.ins_segundoapellido }}</td>
		            </tr>
		        {% if loop.last %}
		        </tbody>
		    </table>
		</div>
	{% endif %}
	{% else %}
	    No existen registros en este catálogo.
{% endfor %}
<!-- </div> -->
