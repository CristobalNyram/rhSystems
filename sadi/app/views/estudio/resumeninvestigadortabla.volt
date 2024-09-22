
{% include "/estudio/complementos/permisos/permisos_resumen_investigador.volt" %}

<script type="text/javascript">
    function principal(){
        var table=$('#td_empresa').DataTable({
            "pageLength": 100,
            "order": [2, 'desc'],
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
            ]
              
        });
        table.buttons().container().appendTo('#td_empresa_wrapper .col-md-6:eq(0)');
    }

    $(document).ready(function() {
        principal();
    });

</script>
{% for esc in estudio %}
{% if loop.first %}

<div class="mt-1 col-12 card card-crm  p-3">
    <table id="td_empresa" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light-crm">
            <tr>
                <th>Fecha alta</th>
                <th>Fecha asig. investigador</th>
                <th>Investigador</th>
                <th>Folio</th>
                <th>Empresa</th>
                <th>Centro costo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Tipo documento</th>
                <th>Estatus</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            {% endif %}
            <tr  >
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_registro)) }}'>{{ date("d-m-Y", strtotime(esc.ese_registro)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaasiginvestigador)) }}'>{{ date("d-m-Y", strtotime( esc.ese_fechaasiginvestigador )) }}</td>
                <td>{{ esc.investigador }}  </td>
                <td>{{esc.ese_id}}</td>
                <td>{{ esc.empresa_nombre }}</td>
                <td>{{ esc.cen_nombre }}</td>
                <td>{{ esc.ese_nombre }} {{esc.ese_primerapellido}}  {{esc.ese_segundoapellido}}</td>
                <td>{{ esc.est_nombre }}</td>
                <td>
                    {% if  esc.mun_nombre=='' or esc.mun_nombre== null %}
                           SIN MUNICIPIO     
                        {% else %}
                     {{ esc.mun_nombre }}</td>
                     {% endif %}
                <td>{{ esc.tip_clave }}</td>
                <td>
                    {{ estudiomodel.getEstatusDetail(esc.ese_estatus) }}
                </td>
                <td>

                  


                <!-- validacion autoestudio-->
                    {% include "/estudio/complementos/opcionestrafico.volt" %}
                </td>
            </tr>
            {% if loop.last %}
        </tbody>
    </table>
</div>
{% endif %}
{% else %}
No existen registros en este catálogo.
{% endfor %}

<!-- helper js inicio  -->
{% include "/calificacionfinalgrupo/script-ajax-get-todos-by-grupo.volt" %}
<!-- helper js inicio  -->

{% include "/empresa/ajax-get-alias.volt" %}
 
{% include "/transporte/archivo-js.volt" %}
{% include "/transporte/archivo-modales-js.volt" %}
{% include "/comentarioese/modales-js.volt" %}
{% include "/archivo/modal-js.volt" %}

{% include "/transporte/editar-modal-js.volt" %}
{% include "/transporte/asignar-transporte-modal-js.volt" %}
{% include "/transporte/solicitar-modal-js.volt" %}


{% include "/estudio/verdetalles.volt" %}
{% include "/estudio/cancelar.volt" %}

{% include "/estudio/regresar_estatus-modal-js.volt" %}
{% include "/estudio/trafico_modal-js.volt" %}
{% include "/estudio/editarverificacion.volt" %}
{% include "/estudio/vercompletoese-modal.volt" %}
{% include "/estudio/editarestudiosocioeconomico.volt" %}
{% include "/estudio/editarsupervivencia.volt" %}

{% include "/estudio/asignaranalista-trafico-investigador-modal-js.volt" %}
{% include "/estudio/asignaranalista-obtener-detalles-modal-js.volt" %}

<!-- diferentes formatos de ese -->
{% include "/formatoese/formato-gabtubos.volt" %}
{% include "/formatoese/formato-gabencognv.volt" %}
{% include "/formatoese/formato-truper.volt" %}

<!-- reasignar investigador -->
{% include "/estudio/acciones/re-asignar-investigador-modal-js.volt" %}

<!-- citas inciio -->
{% include "/cita/general/tabla-modal.volt" %}
<!-- citas fin -->