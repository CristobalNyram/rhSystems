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
    <h3>Bitácora</h3>
    <div class="col-xs-12">
        {{ form('', 'id': 'index','data-parsley-validate') }}
            <div class="container">
                
                <div>
                    

                    
                <!-- </div>
                <div class="container"> -->
                    <div class="col-xs-3 col-sm-3">
                        <select name="usu_id" id="usu_id" class="js-example-basic-multiple form-control">
                            <option value="-1">Seleccionar</option>
                            {% for usu in usuario %}
                            <option value="{{usu.usu_id}}" {% if indexusu== usu.usu_id%} selected {% endif %}>{{usu.usu_nombre}}</option>
                            {% endfor %}
                        </select>
                        <span class="text-center">Usuario</span>
                    </div>
                    
                </div>
                <div class="col-xs-2 col-sm-2">
                    <input class="form-control" type="date" id="fecha_ini" name="fecha_ini" value="{{fechaini}}"></input>
                    <span>Desde</span>
                </div>
                <div class="col-xs-2 col-sm-2">
                    <input class="form-control" type="date" id="fecha_fin" name="fecha_fin" value="{{fechafin}}"></input>
                    <span>Hasta</span>
                </div>

                
                <button type="submit" class="btn btn-btnempresa" onclick=this.form.action="{{ url('bitacora/index') }}"><i class="fa fa-search"></i> Buscar</button>

                <!-- <button type="submit" class="btn btn-btnempresa" onclick=this.form.action="{{ url('reporte/descargar') }}"><i class="fa fa-download"></i> Descargar</button> -->
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
                        
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Fecha/Hora</th>

                    </tr>
                </thead>
                <tbody>
                {% endif %}
                    <tr>
                        
                        <td>{{ dat.bit_id }}</td>
                        <td>{{ dat.bit_descripcion }}</td>
                        <td>{{ dat.usu_nombre }} {{ dat.usu_primerapellido }} {{ dat.usu_segundoapellido }}</td>
                        <td>{{ dat.bit_fecharegistro }}</td>
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
