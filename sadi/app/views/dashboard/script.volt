<script>

$(document).ready((event)=>{
                $('#ese_registro_fechafinal').val(moment().format('YYYY-MM-DD'));
                $('#ese_registro_fechainicial').val(moment().format('YYYY-MM-DD'));
                let formulario=$("#form_tablero_informativo");
                let $form = $(this);
                let data = formulario.serialize();
                getDataCuentaEntregeadosTipoEstudios(data);
                getDataCuentaAltasTipoEstudio(data);
                getDataCuentasEsesEntregadosAnalista(data);
                $('input#ese_registro_fechafinal').on('change', function() {

                    let fecha_actual=moment().format('YYYY-MM-DD');
                    let fecha_a_validar=$(this).val();

                

                    if(fecha_a_validar>fecha_actual){
                        Swal.fire({title:'Error',text:'No puedes colocar una fecha mayor a la actual..',type:"warning"});
                        let fecha_a_validar=$(this).val(moment().format('YYYY-MM-DD'));
                        return false;
                    }

                
                });

                $('input#ese_registro_fechainicial').on('change', function() {

                    let fecha_actual=moment().format('YYYY-MM-DD');
                    let fecha_a_validar=$(this).val();



                    if(fecha_a_validar>fecha_actual){
                        Swal.fire({title:'Error',text:'No puedes colocar una fecha mayor a la actual..',type:"warning"});
                        let fecha_a_validar=$(this).val(moment().format('YYYY-MM-DD'));
                        return false;
                    }


                });
        });

                
            
            function getDataCuentaEntregeadosTipoEstudios(data){
                let url_enviar ="<?php echo $this->url->get('dashboard/ajax_get_cuenta_estudios/') ?>";

                $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data:data,
                          success: function(res)
                          { 
                            let data= res['data'];
                            let total= res['total'];

                            // console.log(res);
                            $('#total_cuenta_entregados_tipo_estudios').text(total);

                        //   console.log(data);
                            let tabla= $('#tabla_cuenta_estudios').DataTable();
                            tabla.clear();
                            tabla.draw();
                            tabla.destroy();



                           tabla= $('#tabla_cuenta_estudios').DataTable({
                                     "pageLength": 10,
                                    scrollY:        "300px",
                                    scrollX:        true,
                                    scrollCollapse: true,
                                    data: data,
                                    columns: [
                          
                                    { data: 'tip_nombre' },
                                    { data: 'contador' },
                                

                                    ], "language": {
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
                                        buttons: [{
                                            extend: 'excelHtml5',
                                            exportOptions: {
                                                columns: ':visible'
                                            },
                                            title: 'ESTUDIOS ENTREGADOS'
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

                                }
                                
                                );

                                tabla.buttons().container().appendTo('#tabla_cuenta_estudios_wrapper .col-md-6:eq(0)');

                          },error:function(res){
                          }}).done(function(){
                           // getDataCuentaAnalista();
                          });

            }
            function getDataCuentaAltasTipoEstudio(data){
                let url_enviar ="<?php echo $this->url->get('dashboard/ajax_get_cuenta_alta/') ?>";

                $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data:data,

                          success: function(res)
                          { 
                            let data= res['data'];
                            let total= res['total'];

                            // console.log(res);
                            $('#total_cuenta_alta_tipo_estudios').text(total);
                                let tabla= $('#tabla_cuenta_alta_tipo_estudios').DataTable();
                                /*  tabla.clear();
                                    tabla.draw();*/
                                tabla.destroy();

                                tabla=$('#tabla_cuenta_alta_tipo_estudios').DataTable({
                                    data: data,
                                    columns: [
                                  
                                    { data: 'tip_nombre' },
                                    { data: 'contador' },
                               

                                    ]
                                    , "language": {
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
                                        buttons: [{
                                            extend: 'excelHtml5',
                                            exportOptions: {
                                                columns: ':visible'
                                            },
                                            title: 'ALTA  DE ESTUDIOS',
                                            customize: function (xlsx) {
                                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                $('author', sheet).text('SADI | SIPS'); // Reemplaza 'Nombre del autor' por el nombre que desees
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

                                }
                                
                                );
                                
                                tabla.buttons().container().appendTo('#tabla_cuenta_alta_tipo_estudios_wrapper .col-md-6:eq(0)');

                          },error:function(res){

                          }});

            }
            function getDataCuentasEsesEntregadosAnalista(data){
                let url_enviar ="<?php echo $this->url->get('dashboard/ajax_get_cuenta_analista_entregados/') ?>";

                $.ajax({
                          type: "POST",
                          url: url_enviar,
                          data:data,

                          success: function(res)
                          { 
                        
                            // console.log(res);
                            let data= res['data'];
                            let total= res['total'];

                        //   console.log(res);
                            // console.log(res);
                            $('#total_cuenta_analista_ese_entregados').text(total);
                                let tabla= $('#tabla_cuenta_analista_ese_entregados').DataTable();
                                /*  tabla.clear();
                                    tabla.draw();*/
                                tabla.destroy();

                            tabla=  $('#tabla_cuenta_analista_ese_entregados').DataTable({
                                    data: data,
                                    columns: [
                                 
                                    { data: 'usu_nombre' },
                                    { data: 'contador' },
                                   

                                    ]
                                    , "language": {
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
                                        buttons: [{
                                            extend: 'excelHtml5',
                                            exportOptions: {
                                                columns: ':visible'
                                            },
                                            title: 'REPORTE DE ANALISTAS '
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

                                }
                                
                                );
                                
                                tabla.buttons().container().appendTo('#tabla_cuenta_analista_ese_entregados_wrapper .col-md-6:eq(0)');


                          },error:function(res){
                            // console.log(res);

                }});

            }

             
            $('#tabla_cuenta_estudios').on('click', '.icon-pencil', function() {
                let dataset=$(this)[0].dataset;
               
            });

    
        $('#form_tablero_informativo').submit((event)=>{
            event.preventDefault();
            let formulario=$("#form_tablero_informativo");
            let $form = $(this);
            let data = formulario.serialize();
            // console.log(data);
            getDataCuentaEntregeadosTipoEstudios(data);
            getDataCuentaAltasTipoEstudio(data);
            getDataCuentasEsesEntregadosAnalista(data);
        });

</script>