{{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
{{ javascript_include("assets/libs/jspdf/jspdf.min.js") }}
{{ javascript_include("assets/libs/jspdf/jspdf.debug.js") }}
{{ javascript_include("assets/libs/html2canvas/html2canvas.min.js") }}
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<!-- helpers inicio -->
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}
{% include "/tipocatcancelado/script-ajax-todos-by-tip-id.volt" %}

<!-- helpers inicio -->

<script type="text/javascript">
function fnlimpiartablaCancelados(){
  $("#listadoprincipal").empty();
}

function limpiarInputs(container) {
    // Obtener todos los inputs dentro del contenedor
    var inputs = container.getElementsByTagName('input');

    // Iterar sobre los inputs y limpiar sus valores
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}

    $(document).ready(function(){
        fnestados_estados_adaptable(-1, $('#est_id'));
    });
 
    function principal(){
    
       let validacion=true;
  
       if(!validacion){
          swalalert('Aviso', "FALTAN DATOS POR LLENAR", "warning", 0);
       }
       let data_json = $('#form_reporte_ese_cancelacion').serialize();

              document.getElementById("listadoprincipal").innerHTML="";
              urlreloadprincipal="<?php echo $this->url->get('reporte/ese_cancelado_tabla/') ?>";
              $.post(urlreloadprincipal,data_json, function(data)
              {

                  
                  $('#listadoprincipal').html(data);
                    var table=$('#datatable-buttons').DataTable({
                      "pageLength": 100,
                      'columnDefs': [
                        {
                           'targets': 0
                        }
                        ],
                        'select': {
                          'style': 'multi'
                        },
                      "order": [1, 'asc'],
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
                          title: 'Reporte transporte'
                        
                      }, 
                      {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                      
                      },
                      'colvis'
                    ]
                    
                  });
                  table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                  document.getElementById('busqueda').style.display = 'none';
                  document.getElementById('otrabusqueda').style.display = 'block';
                  // document.getElementById('listadoultimaspolizas').style.display = 'none';
              }).done(function() { 

              }).fail(function() {
              })
        
    }

    function fnmostrarbusqueda(){
      document.getElementById('busqueda').style.display = 'block';
      document.getElementById('otrabusqueda').style.display = 'none';
    }
   
</script>