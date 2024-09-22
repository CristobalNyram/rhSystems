<!-- links start  -->
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}

<!-- links end -->


<script>
$(document).ready(function(){
 
  $(document).ready(function() {

    function llenadoDeTabla(opcion,numeroDecuestionarios){
      if(numeroDecuestionarios){//comprobamos si hay cuestionarios contestados, si no hay no mostramos la tabla
            divListado = document.getElementById('listado');
            url="<?php echo $this->url->get('reporte/tablafolio/') ?>";
            $.post(url+opcion, $(this).serialize() , function(data)
            {
                divListado.innerHTML=data;
                var table=$('#td_datos').DataTable
                ({
                  "pageLength": 50,
    
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
            
                  return arreglo.split(',');
                }
            }).done(function() { 
            }).fail(function() {
            })
      }

      }
  
  let myChart;
  function GraficarDatos(FolioNoContestados,FolioContestados)
  {
    if(FolioContestados)
    {
      
      $('#graficaDeRespuestasSiSeccion1').remove();
      $("#crear_div").append(function(n){
            	    return "<div id='graficaDeRespuestasSiSeccion1'  class='mt-5'></div>";
      });

    Morris.Donut({
        element: 'graficaDeRespuestasSiSeccion1',
        data: [
          {label:"Folios que aún no son contestados.", value: FolioNoContestados },
          {label: "Folios contestados.", value:FolioContestados},
         
        ],
        colors:['#FF336B','#00B946']
      });



            
    }
    else
    {
      alertify.errorAlert('No hay avance en los cuestionarios.');
    }
    }
      

  $('#reporteAvanzeForm').submit(()=>
  {
        event.preventDefault();

         var consultaIdCuestionario = $('#idCuestionarioConsulta').val();
         var urlEnviar="<?php echo $this->url->get('reporte/consultaravancecuestionario/') ?>";

         $.ajax(
           {
            url:urlEnviar,
            type:"POST",
            data: {consultaIdCuestionario},
            success: function(res)
            {
              GraficarDatos(res[0],res[1]);
              llenadoDeTabla(consultaIdCuestionario,res[1]);
                               
            },
            error: function(res)
            {
              alertify.alert('Error','Error al actualizar los datos.',function(){ 
                    location.reload();
                  });
            }
           }
         );


  });
});
} );      

</script>


<div class="mb-2">

       <div class="card card-crm ">
         
               <div class="text-center col-md-12 ">
                           <div class="mt-1">
                                      <span class="font-16 btn-link-crm">
                                            Avances de cuestionario
                                      </span>
                           </div>
                 </div>
                      <hr class="line-down">

        <form class="form-vertical mt-1" method="post" enctype="multipart/form-data" id="reporteAvanzeForm">
                <div class="form-group  mr-5 ml-5">
                    
                  <div class="row">
                    <div class="col-3">
                    
                    </div>  
                      <div class="col-lg-2  col-xl-2 col-md-3 col-sm-3">
                        <label class="col-form-label title-busq font-17 ">Selecciona un cuestionario:</label>
                      </div>

                      <div class="col-3">
                      </div>  
                    </div>

                    <div class="row">
                      <div class="col-3">
                      </div>  
                      <div class="col-lg-3 col-xl-3 col-md-3 col-sm-5">
                        <select class="" data-toggle="select2" id="idCuestionarioConsulta"  name="idCuestionarioConsulta" data-placeholder="Seleccionar ...">
                              <optgroup>
                                {% for cuestionario in estadoCuestionariosDescarga %}
                                        {% if (cuestionario['estado'])%}
                                          <option value="{{cuestionario['value']}}">{{cuestionario['nombre']}}</option>
                                        {% endif %}

                                {% endfor %}
                               </optgroup>
                            </select>
                     </div>
                     <div class="col-3">
                    
                    </div>  
                    </div>

                      <div class="row d-flex justify-content-end mt-2 "">
                        <div class="col-2">
                    
                        </div>  
                              <div class="col-lg-3 col-md-3 col-lx-3 col-sm-4  mt-2  padding-responsive">
                                    <div class="form-group ">                                         
                                    <button class="btn-dark btn-rounded btn btn-buscar ">Consultar <i class="mdi mdi-book-search white"></i> </button>
                                    </div>
                              </div>
                          <div class="col-2">
                    
                          </div>  
                      </div>


             
                </div>
        </form>       

        </div>  

</div>

<div class="container  p-5 bg-white rounded ">
    <div class="row  mt-4 col-12 pb-3  ">
           <span class="font-16 btn-link-crm">
                 Resultados de reporte:
           </span>
     </div>
     
     <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-7">
                  <div id="listado">

                 </div>
          </div>

              

      
          <div class="col-12 col-sm-4 col-md-4 col-lg-5 "  id="crear_div">
            <div id="graficaDeRespuestasSiSeccion1"  ></div>

          </div>

        
      

          
        
             
     </div>
    
</div>
























































