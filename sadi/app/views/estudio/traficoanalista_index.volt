{% set treintaycinco = acceso.verificar(35,rol_id) %}
{% if treintaycinco==1 %}
  <script type="text/javascript">
    var clictabla=0;
    function convertirtablaanalistadetalles(){
      if(clictabla==0){
        $('#analistadetalles').DataTable({
          'sDom':'t',
          order:[0,'asc'],
          "bPaginate": false,
        });
        clictabla=1;
      }      
    }
  </script>
{% endif %}
<script type="text/javascript">

  function principal(){
    document.getElementById("listadoprincipal").innerHTML="";
    urlreloadprincipal="<?php echo $this->url->get('estudio/traficoanalista_tabla/') ?>";
    $.post(urlreloadprincipal, $(this).serialize() , function(data)
    {
        $('#listadoprincipal').html(data);
          var table=$('#td_empresa').DataTable({
            "pageLength": 100,
            "order": [5, 'asc'],
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            columnDefs: [
              { "visible": false, "targets": 0 }
            ],
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
                },
                title: 'Tráfico analista'
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
            .appendTo('#td_empresa_wrapper .col-md-6:eq(0)');

        document.getElementById('busqueda').style.display = 'none';
        document.getElementById('otrabusqueda').style.display = 'block';
        // document.getElementById('listadoultimaspolizas').style.display = 'none';

    }).done(function() { 

    }).fail(function() {
    })
  }
  
  function validar_commentario(comentario)
  {
    var res;
    if(comentario.trim()=='' ||(comentario.length<6))
      {
        res=false;
      }
      else
      {
        res=true;
      }
    return res;
  }
  
        $(document).ready(function() {
          principal();
  
          $("#form_reasignar_analista_estudio").submit(function(event) 
            {
           
  
              var $form = $(this);
              event.preventDefault();
              var $comentario_validar= $form[0][2].value;
  
              if(validar_commentario($comentario_validar))
              { 
                var urled="<?php echo $this->url->get('estudio/ajax_setreasignaranalista/') ?>";
                $form.find("button").prop("disabled", true);
                $.ajax({
                type: "POST",
                url: urled,
                data: $("#form_reasignar_analista_estudio").serialize(),
                success: function(res)
                {
                  if(res[0]==2)
                  {  
                
                     Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                               .then((value) => {
                                  location.reload();  

                                });
  
                  }
                  else
                  {
                     Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                               .then((value) => {
                                    location.reload();  
                                });             
                  }
  
                },
                error: function(res)
                { 
                  alert('Error en el servidor...');
                
                }
                });
  
           
              }
              else
              {
                  Swal.fire({title:'ERROR',text:'Para poder reasignar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.',type:"error"})
                            .then((value) => {
                              location.reload();  
                             });        
              }
              
              
            });
        } );   
   
  </script>
    
    <div class="row">
      <div class="col-sm-7">
        <h4 class="header-title header-title-crm ">Tráfico analista</h4>
      </div>
      <div class="col-sm-5">        
      </div>
      <div class="col-sm-1">
      <div class="text-left">
      </div>
        </div>
    </div>
    
    
    <div class="mt-3">
        <div class="card card-crm">            
          <div id="listadoprincipal">
          </div>
        </div>
    </div>
    
  
   
  
  
    
    <!-- <div class="modal fade" id="asignar_analista_estudio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog detalle modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="" id="exampleModalLabel">Reasignar analista a ESE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_reasignar_analista_estudio" class="form-vertical mt-1">
              <div class="form-group row">
                
          
               
                <div class="col-lg-10">
               
                  <input type="number" id="ese_id" name="ese_id" value="" style="display:none;">
  
                  <div class="row ml-3">
                      <label class="col-form-label title-busq">Analista</label>
                      <select name="ana_id" id="ana_id" class="form-control select2-single" data-toggle="select2" data-placeholder="Seleccionar ...">
                          <optgroup>
                         
                          </optgroup>
                        </select>
                  </div>
               
  
                  <div class="row ml-3">
                      <label class="col-form-label title-busq">Agregue un comentario</label>
                      <textarea placeholder="Agrega tu comentario..." id="com_comentario" name="com_comentario" class="col-12 md-textarea form-control " style="min-height:90px" rows="3" ></textarea>
                    </div>
    
    
    
                </div>
                
                <div class="row col-lg-12">
                  <div class="col-sm-6 col-md-6 text-center mt-5">
                  </div>
                  <div class="col-sm-3 col-md-3 text-center mt-5">
                      <div class="form-group">
                        <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar </a>
                      </div>
                  </div>
                  <div class="col-sm-3 col-md-3  text-center mt-5 ">
                      <div class="form-group">
                        <button class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                      </div>
                  </div>
                </div>
              </div>
            </form>      
          </div>
        </div>
      </div>
    </div> -->

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

<!-- editar aes -->
{% include "/autoestudio/editar-modal-js.volt" %}



{% include "/estudio/asignaranalista-trafico-investigador-modal-js.volt" %}
