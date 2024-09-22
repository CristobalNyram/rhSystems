<!-- <div style="padding-top: 50px"> -->
<script type="text/javascript">
    $(document).ready(function() 
    {
        var tabla=$('#td_dat').DataTable(
            {
                "pageLength": 100,
                'columnDefs': [
                    {
                       'targets': 0,
                       'checkboxes': {
                          'selectRow': true
                       }
                    }
                ],
                'select': {
                'style': 'multi'
                },
                        'order': [0, 'desc'],
                        scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
                "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sSearch":         "Buscar:",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Personalizar",
                    "excel":"Excel",
                    "pdf":"PDF",
                    "print":"PDF"

                }
                },
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                  {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ":visible"
                    }
                  },
                  'colvis'
                  ,
                ]
            });
        tabla.buttons().container()
                .appendTo('#td_dat_wrapper .col-md-6:eq(0)');
        $('.select2-multiple').select2();
        
    } );
</script>
<div class="row">
  <div class="col-6">
          <h4 class="header-title header-title-crm">Bitácora</h4>
  </div>
</div>

<div class="mt-4">
  <div class="card card-crm">
    <div id="busqueda" name="busqueda">
        {{ form('', 'id': 'index','class':'form-vertical col-md-12 row') }}
            <div class="col-lg-3">
                <label class="col-form-label title-busq">Usuario</label>
                <select name="usu_id" id="usu_id" class="form-control select2-multiple">
                    <option value="-1">Seleccionar</option>
                    {% for usu in usuario %}
                    <option value="{{usu.usu_id}}" {% if indexusu== usu.usu_id%} selected {% endif %}>{{usu.usu_nombre}} {{ usu.usu_primerapellido }} {{ usu.usu_segundoapellido }}</option>
                    {% endfor %}
                </select>
            </div>
            <div class="col-lg-5">
                <label class="col-form-label  title-busq">Fecha</label>
                <div>
                    <div class="input-group" id="">
                        <input type="date" id="fecha_ini" name="fecha_ini" class="form-control bar-left" value="{{fechaini}}" placeholder="Desde" />
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control bar-right" placeholder="Hasta" value="{{fechafin}}" />
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-9  text-right mt-5">
                <div class="form-group">
                    <button type="submit" id='buscar' name='buscar' class="btn-dark btn-rounded btn btn-buscar" onclick=this.form.action="{{ url('bitacora/index') }}"><i class=" mdi mdi-magnify white"></i>  Buscar</button>
                </div>
            </div>
            <div class="col-lg-1 col-3  text-right mt-5">
                <div class="form-group">   
                    {{ link_to('bitacora/index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
                    <!-- <input type="hidden" name="datosiniciales" id="datosiniciales" value='{{datosiniciales}}'> -->
                </div>
            </div>
        </form>
    </div>
    
<!-- </div> -->
{% for dat in datos %}
    {% if loop.first %}
        <div class="mt-1 col-12">
            <table id="td_dat" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light-crm">
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Fecha/Hora</th>
                        <th>Módulo</th>
                    </tr>
                </thead>
                <tbody>
                {% endif %}
                    <tr>
                        <td>{{ dat.bit_id }}</td>
                        <td>{{ dat.bit_descripcion }}</td>
                        <td>{{ dat.usu_nombre }} {{ dat.usu_primerapellido }} {{ dat.usu_segundoapellido }}</td>
                        <td>{{ dat.bit_fecharegistro }}</td>
                        <td>{{ dat.bit_modulo }}</td>
                    </tr>
                {% if loop.last %}
                </tbody>
            </table>
        </div>
    {% endif %}
    {% else %}
        No existen registros en este catálogo.
{% endfor %}
    </div>
</div>
<!-- </div> -->
