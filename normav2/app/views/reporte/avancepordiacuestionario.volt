<!-- links start  -->
{{ javascript_include('plugins/datatables/datatables.min.js') }}
{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}

<!-- links end -->

<script>
$(document).ready(function(){
 
  $(document).ready(function() {

    function llenadoDeTabla(opcion,fecha_ini,fecha_fin,numeroDecuestionarios){
      if(numeroDecuestionarios){//comprobamos si hay cuestionarios contestados, si no hay no mostramos la tabla
            divListado = document.getElementById('listado');
            url="<?php echo $this->url->get('reporte/tablafolioporfecha/') ?>";
            var fechas =
            {
              "fecha_ini":fecha_ini,
              "fecha_fin":fecha_fin,
            };
              // console.log(fechas);            
            $.post(url+opcion, fechas , function(data)
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
  
  function GraficarDatos(Folios)
  {            
    $('#bar-dias-cuestionario').remove();
      $("#crear_div").append(function(n){
            	    return "    <div id='bar-dias-cuestionario'></div>";


      });
   
            
  var morrisGraficaDeBarras=new  Morris.Bar({
  element: 'bar-dias-cuestionario',
  xkey: 'y',
  ykeys: 'a',
  labels: 'Fechas de cuestionario'
});
var dataGraficado=[];
var datosGraficar=Folios.map(function(current,index,array)
{
  dataGraficado.push({y:array[index]['fecha'] ,a:array[index]['folio_contestados']})

});
morrisGraficaDeBarras.setData(dataGraficado);



   
}
      

  $('#reporteAvanzeConFechaForm').submit(()=>
  {
    
         event.preventDefault();
         var urlEnviar="<?php echo $this->url->get('reporte/consultaravancecuestionarioporfecha/') ?>";
         $.ajax(
           {
                url:urlEnviar,
                type:"POST",
                data:$("#reporteAvanzeConFechaForm").serialize(),
                success: function(res)
                {
                    if(res['folioSolicitado'])
                    {
                      
                         GraficarDatos(res['folios']);
                         llenadoDeTabla(res['peticion'],res['fecha_ini'],res['fecha_fin'],res['folioSolicitado']);

                    } 
                    else
                    {
                      alertify.alert("No hay datos","No hay datos con respecto al filtro seleccionado. ",function(){ location.reload();});
                    }   
                },
                error: function(res)
                {
                
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
                                            Avances por fechas de cuestionario 
                                      </span>
                           </div>
                 </div>
                      <hr class="line-down">
                      
                <form class="container" method="post" enctype="multipart/form-data" id="reporteAvanzeConFechaForm">
                      <div class="row">
                        <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                          <label class="col-form-label title-busq font-17 ">Selecciona un cuestionario:</label>
                        </div>
                        <div class="col-6 col-xs-6 col-sm-6 col-md-6">
                          <label class="col-form-label title-busq font-17 ">Selecciona el rango de fechas:</label>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-6 col-xs-4 col-sm-4 col-md-4">
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
                        <div class="col-6 col-xs-4 col-sm-4 col-md-4">
                             <div class="input-group" id="">
                                  <input type="date" id="fecha_ini" name="fecha_ini" class="form-control bar-left" value" placeholder="dd-mm-aaaa"  />
                                  <input type="date" id="fecha_fin" name="fecha_fin" class="form-control bar-right" placeholder="dd-mm-aaaa" value="" />
                            </div>
                        </div>
                        
                      </div>
                      <div class="d-flex justify-content-end mt-4">
                        <div class="col-lg-3 col-md-3 col-lx-3 col-sm-4  mt-2 padding-responsive">
                          <div class="form-group">                                         
                           <button class="btn-dark btn-rounded btn btn-buscar ">Consultar <i class="mdi mdi-book-search white"></i> </button>
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

              

          <div class=" ml-5 col-12 col-sm-12 col-md-4 col-lg-4" id="crear_div">
            <div id="bar-dias-cuestionario">

            </div>
            
          </div>
          
        
             
     </div>
    
</div>
























































