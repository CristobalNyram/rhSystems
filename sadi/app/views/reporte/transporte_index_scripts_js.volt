{{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
 {{ javascript_include("assets/libs/jspdf/jspdf.min.js") }}
{{ javascript_include("assets/libs/jspdf/jspdf.debug.js") }}
{{ javascript_include("assets/libs/html2canvas/html2canvas.min.js") }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
{% include "/municipio/script-ajax-todos.volt" %}
{% include "/estado/script-ajax-todos.volt" %}

<script type="text/javascript">
function fnlimpiartablaTransporteReporte(){
  $("#listadoprincipal").empty();
}

function fnGererarGraficaTrasporteAutorizado(data_json){
    let url="<?php echo $this->url->get('reporte/transporte_autorizado/') ?>";
    let form = $('<form action="' + url + '" method="post" target="_self"></form>');
    $.each(data_json, function (index, item) {
        form.append('<input type="hidden" name="label[' + index + ']" value="' + item.label + '">');
        form.append('<input type="hidden" name="value[' + index + ']" value="' + item.value + '">');
        form.append('<input type="hidden" name="nombre[' + index + ']" value="' + item.inv_nombre + '">');

    });
    $('body').append(form);
    form.submit();
    form.remove();
}
function fnCargarGraficaTransporte(data_json={}){
  
  if (!(data_json.length > 0)) {
    $("#textos-grafica").text("No hay información al respecto...");
    return false;
  }

  let data_graficas = data_json.map(function(item) {
     let inv_nombre_recortado = item.inv_nombre.length > 13 ? item.inv_nombre.substring(0, 12) + '...' : item.inv_nombre;

    return {
        label: inv_nombre_recortado,
        value: Number(item.inv_promedio_transporte_autorizado).toFixed(2),
        inv_nombre: item.inv_nombre,
    };
  });
  let coloresBarras = ['#00739D', '#00B7C2', '#71FACA', '#16345E', '#FF5733'];
  Morris.Bar({
      element: 'grafica',
      data: data_graficas,
      xkey: 'label',
      ykeys: ['value'],
      labels: ['Monto total de transportes autorizados $'],
      barColors: coloresBarras,
      xLabelAngle: 30, 
      onXLabelClick: function (event, index, xLabel) {
        $('#grafica svg g.x.labels text').eq(index).css('font-size', '12px');
    }
  });

  let nombre_tabla="#datatable-inv_info";
  pintartabla(nombre_tabla);
  let printButton = $('<button>', {
    class: 'btn btn-primary',
    text: 'Imprimir gráfica',
    click: function () {
        printButton.prop('disabled', true);

        fnGererarGraficaTrasporteAutorizado(data_graficas);

        setTimeout(function () {
            printButton.prop('disabled', false);
        }, 6000);
    }
});      
  $('#listado-graficas-respuestas-container').after(printButton);

}

function fnSeleccionarFiltroCantidad(palabra, grupoBotones, grupoInputMostrar, grupoInputOcultar) {
    
    var botones = document.getElementsByClassName(grupoBotones);

    for (var i = 0; i < botones.length; i++) {
        botones[i].classList.remove('active', 'btn-primary');
         if (botones[i] === event.currentTarget) {
            botones[i].classList.remove('btn-dark');
        }
        else{
            botones[i].classList.add('btn-dark');
        }
    }

    event.currentTarget.classList.add('active', 'btn-primary');

    var grupoInputsOcultar = document.getElementsByClassName(grupoInputOcultar);
    for (var i = 0; i < grupoInputsOcultar.length; i++) {
        grupoInputsOcultar[i].style.display = 'none';
        limpiarInputs(grupoInputsOcultar[i]);

    }

    var grupoInputsMostrar = document.getElementsByClassName(grupoInputMostrar);
    for (var i = 0; i < grupoInputsMostrar.length; i++) {
        grupoInputsMostrar[i].style.display = 'block';
    }
}
function limpiarInputs(container) {
    // Obtener todos los inputs dentro del contenedor
    var inputs = container.getElementsByTagName('input');

    // Iterar sobre los inputs y limpiar sus valores
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
		   fnestados_estados_adaptable(select_est_id=0,$("#tra_est_id_ori"),$("#tra_mun_id_ori"),0);
       fnestados_estados_adaptable(select_est_id=0,$("#tra_est_id_dest"),$("#tra_mun_id_dest"),0);

	  });

    
    function principal(){
    
       let validacion=true;
  
       if(!validacion){
          swalalert('Aviso', "FALTAN DATOS POR LLENAR", "warning", 0);
       }
       let data_json = $('#form_reporte_transporte').serialize();

              document.getElementById("listadoprincipal").innerHTML="";
              urlreloadprincipal="<?php echo $this->url->get('reporte/transporte_tabla/') ?>";
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