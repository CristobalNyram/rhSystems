<!-- links start  -->
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
<!-- links end -->


{% include "/empresa/acciones/ajax-js-select-dinamicos-empresas.volt" %}
{% include "/trabajador/acciones/script-js-eliminar.volt" %}
{% include "/trabajador/acciones/script-js-modal-crear.volt" %}
{% include "/trabajador/acciones/script-js-modal-editar.volt" %}
{% include "/trabajador/acciones/script-form-carga-masiva-excel.volt" %}

<!-- START SCRIPTS-----------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------------START SCRIPTS---->
<script type="text/javascript">
   $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
});

    $(document).ready(function() {
        divListado = document.getElementById('listado');
        url="<?php echo $this->url->get('cuestionario/tablafolio/') ?>";
        $.post(url, $(this).serialize() , function(data)
        {
            divListado.innerHTML=data;
            var table=$('#td_datos').DataTable
            ({
              "pageLength": 50,
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
              
              buttons: [{
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

            table.buttons().container()
                .appendTo('#td_datos_wrapper .col-md-6:eq(0)');
                

            get_seleccionados= function()
            {
                
              // var rows_selected = tabla.column(0).checkboxes.selected();
              var rows_selected =table.rows( { selected: true }).data();
              var count = table.rows( { selected: true } ).count();
              var arreglo="";
              for (var i = 0; i < count; i++) {
                if(i==0){
                  var arreglo=rows_selected[i][0];
                }else{
                  var arreglo=arreglo+=","+rows_selected[i][0];
                }
                
              }
              // var celda= tabla.cells( rows_selected ).data();
              // console.log(rows_selected[1][0]);
              // var arreglo=rows_selected.join(",");
              // console.log(arreglo.split(','));
              // return;
              return arreglo.split(',');
            }
        }).done(function() { 
        }).fail(function() {
        })
    } ); 

  
    
  
    function fncargar(){
        // var field = document.getElementById('id_cuo');
        // var field2 = document.getElementById('id_emp');
        // field.value = id_curso;
        // field2.value = id_emp''resa;
    }

    
    {
      var urlempresas="<?php echo $this->url->get('empresa/ajax_empresa/') ?>";

      var $empresaSelect = $('select[name="emp_id"]');    
      $empresaSelect.empty();

      $.ajax({
              type: "POST",
              url: urlempresas,
              success: function(data)
              {
                // console.log(data);
                  
                      if (data.length > 0) {

                      
                        $empresaSelect.append(
                            function () {
                              var options = '';
                            
                            
                              options += '<option value="-1" disabled >Seleccionar..</option>';
                                     $.each(data, function (key, emp) {
                                      
                                 
                                      
                                       
                                       
                                      
                                          options += '<option value="' +emp.emp_id+'">'+emp.emp_nombre+'</option>';

                                  
                                       
                                      
                                  
                                      
                                });
                                return options;
                             
                              
                               } );

                            

                            /*
                            $select.append(function () {
                             

                                $.each(data, function (key, emp) {
                                      options += '<option value="' + emp.emp_id + '">'+emp_nombre+'</option>';
                                });
                               
                              
                                //  return options;
                            });
                            */
                      }
                 
              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              }
          });


      
       

      
      
    }
  
</script>
{% include "/trabajador/acciones/script-js-envio-masivo-correos.volt" %}
<!-- END SCRIPTS-----------------------------------------------------------------------------------------------
  -------------------------------------------------------------------------------------------------------------
  --------------------------------------------------------------------------------------------------------END SCRIPTS---->
<div class="container-fluid">

         <!-- start  row-----------------------------------------------------------------------------------------
        ---------------------------------------------------------------------------------------------------------
        --------------------------------------------------------------------------------------------------start row-->
                    <div class="row">
                      <div class="col-sm-6">
                              <h4 class="header-title header-title-crm">Folios permitidos para contestar encuesta</h4>
                      </div>
                                                    <div class="col-sm-6">


                                                                                  
                                                                        <div class="text-right">

                                                                          

                                                                          <a hidden onclick="GetSelectedEnviarCorreo();" data-toggle="tooltip" title="Invitar participantes seleccionado">
                                                                            {{image('assets/images/small/mail.svg','class':'subir_2 boton-plus','height':'50')}}
                                                                            <!-- <img src="assets/images/small/pila.svg" class="subir_2 boton-plus" height="50"> -->
                                                                          </a>


                                                                          <a onclick="fncargar();" data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#cargarparticipante" title="Carga masiva de participantes.">
                                                                            {{image('assets/images/small/botonUsers.svg','class':'subir boton-plus','height':'50')}}
                                                                          
                                                                          </a>

                                                                       
                                                                          <a  data-toggle="modal" type="button" data-container="body" data-toggle="popover" role="button" data-target="#cargaunsolorparticipante" title="Agregar un participante.">
                                                                            {{image('assets/images/small/boton.svg','class':'subir boton-plus','height':'50')}}

                                                                          </a>

                                                                          
                                                                       
                                                                        </div>
                                                      </div>
                    </div>



                          <span class="font-14 btn-link-crm btn-link btn text-left">Resultados</span>
       <!-- end  row-----------------------------------------------------------------------------------------
        ---------------------------------------------------------------------------------------------------------
        --------------------------------------------------------------------------------------------------end row-->



        <!-- TABLE START------------------------------------------------------------------------------------------------START TABLE--->
        <div id="listado">
        </div>
        <!--TABLE END--------------------------------------------------------------------------------------------------------------END TABLE-->

        
</div>








