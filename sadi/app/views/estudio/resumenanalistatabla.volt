{% set once = acceso.verificar(11,rol_id) %}
{% set dieciseis = acceso.verificar(16,rol_id) %}
{% set veinte = acceso.verificar(20,rol_id) %}
{% include "/estudio/complementos/permisos/permisos_trafico_analista.volt" %}

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
                <th>Fecha asig. invest.</th>
                <th>Fecha entrega invest.</th>
                <th>Fecha asig. analista</th>
                <th>Folio</th>
                <th>Empresa</th>
                <th>Centro costo</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Tipo estudio</th>
                <th>Estatus</th>
                <th>Investigador</th>
                <th>Analista</th>
                <th class="all">Opciones</th>
            </tr>
        </thead>
        <tbody>
            {% endif %}

            <tr 
            {% if  esc.ese_estatus is 2 or esc.ese_estatus is 3 %} 
                class="texto-color-verde"
            {% else %}
    
            {% endif %}>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_registro)) }}'>{{ date("d-m-Y", strtotime(esc.ese_registro)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaasiginvestigador)) }}'>{{ date("d-m-Y", strtotime(esc.ese_fechaasiginvestigador)) }}</td>
                <td class="uppercase" data-order='{{ date("Y-m-d H:i:s",strtotime(esc.ese_fechaentregainvestigador)) }}'>
                    {% if  esc.ese_fechaentregainvestigador is defined %}
                        {{ date("d-m-Y H:i:s", strtotime(esc.ese_fechaentregainvestigador)) }}
                    {% else  %}
                        SIN ENTREGAR
                    {% endif %}
                </td>
                <td class="uppercase" data-order='{{ date("Y-m-d",strtotime(esc.ese_fechaasiganalista)) }}'>{{ date("d-m-Y", strtotime(esc.ese_fechaasiganalista)) }}</td>
                <td>{{esc.ese_id}}</td>
                <td>
                    {% if  esc.empresa_nombre=='' %}
                    SIN EMPRESA      
                    {% endif %}

                   {{ esc.empresa_nombre}}
                </td>
                <td>{{ esc.cen_nombre }}</td>
                <td>{{ esc.ese_nombre }} {{esc.ese_primerapellido}} {{esc.ese_segundoapellido}}</td>
                <td>{{ esc.est_nombre }}</td>
                <td>
                    {% if  esc.mun_nombre=='' or esc.mun_nombre== null %}
                         SIN MUNICIPIO     
                     {% else %}
                          {{ esc.mun_nombre }}
                      {% endif %}
                 </td>
                <td>{{ esc.tip_clave }}</td>
                <td>{{ estudiomodel.getEstatusDetail(esc.ese_estatus) }}</td>
                <td>{{esc.investigador_nombre}} {{esc.investigador_apellidoP}} {{esc.investigador_apellidoM}}</td>
                <td>{{esc.analista_nombre}} {{esc.analista_apellidoP}} {{esc.analista_apellidoM}}</td>
                <td width="7%">
                    {% include "/estudio/complementos/opcionestraficoanalista.volt" %}
                </td>
            </tr>
            {% if loop.last %}
        </tbody>
    </table>
</div>
{% endif %}
{% else %}
<strong>No existen registros en este catálogo.</strong>
{% endfor %}

<!-- helper js inicio  -->
{% include "/calificacionfinalgrupo/script-ajax-get-todos-by-grupo.volt" %}
<!-- helper js inicio  -->

{% include "/comentarioese/modales-js.volt" %}
{% include "/archivo/modal-js.volt" %}
{% include "/empresa/ajax-get-alias.volt" %}

{% include "/estudio/verdetalles.volt" %}
{% include "/estudio/cancelar.volt" %}

{% include "/estudio/regresar_estatus-modal-js.volt" %}
{% include "/estudio/editarverificacion.volt" %}
{% include "/estudio/editarestudiosocioeconomico.volt" %}

{% include "/estudio/vercompletoese-modal.volt" %}
{% include "/estudio/traficoanalista_modal-js.volt" %}

<!-- diferentes formatos de ese -->
{% include "/formatoese/formato-gabtubos.volt" %}
{% include "/formatoese/formato-gabencognv.volt" %}
{% include "/formatoese/formato-truper.volt" %}


{% include "/estudio/asignaranalista-trafico-investigador-modal-js.volt" %}
