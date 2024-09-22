<!-- scripts inciio -->

<script>
  function fnCargarDatogrupofamiliardetalles(id=0,ese_id_cargar=0)
  {             
                $('#ese_id_titulo_gfd').empty();
                $('#ese_id_titulo_gfd').text(ese_id_cargar);
                $('#gfd_id_titulo_gfd').text(id);

      
                url="<?php echo $this->url->get('datogrupofamiliar/tabla/') ?>";
                url+=id;
                $.post(url, $(this).serialize() , function(data)
                  {      
                                     
                             $('#datogrupofamiliardetalleslistado').empty();
                              $('#datogrupofamiliardetalleslistado').html(data);

                              $('#datogrupofamiliardetalles_table').DataTable(
                              {
                                "pageLength": 100,
                            
                                order:[0,'asc'],
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
                               
                                },
                                
                                            });
                  }).done(function() { 
                  }).fail(function() {
                  });
                
           


  
  }

  function fnRecargarCargarDatogrupofamiliardetalles(id=0)
  {             
           

      
                url="<?php echo $this->url->get('datogrupofamiliar/tabla/') ?>";
                url+=id;
                $.post(url, $(this).serialize() , function(data)
                  {   
                              $('#datogrupofamiliardetalleslistado').empty();
                              $('#datogrupofamiliardetalleslistado').html(data);

                              $('#datogrupofamiliardetalles_table').DataTable(
                              {
                                "pageLength": 100,
                             
                       
                             
                                order:[0,'asc'],
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
                               
                                },
                                
                              });
                  }).done(function() { 
                  }).fail(function() {
                  })
                
           


  
  }
  
  
  </script>



<!-- scripts fin-->
<!-- 
<div class="modal fade" id="datogrupofamiliardetalles-tabla-modal" tabindex="-1" aria-labelledby="datogrupofamiliardetalles-tabla-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel"> 
            <i class="mdi mdi-worker mdi-24px btn-icon"></i>
            Detalles de grupo familiar del estudio No. <span id="ese_id_titulo_gfd"></span> y la clave interna de la referencía familiar es <span id="gfd_id_titulo_gfd"></span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="form_transporte_aprobar">
                    <div class="text-left">
                      {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus','onclick':'fnCrearDatoGrupoFamiliarDetalles()', 'height':'50'),"data-toggle":"modal","data-target":"#agregar-familiar-candidato-modal","title":"Agregar familiar del candidato." ,'id':'' ) }}

                    </div>
                    <div class="modal-body">
               
                      
                      <div id="datogrupofamiliardetalleslistado">
                      </div>
                      
                    </div>
                      
  
                  
       </form>
  
    
  
                    
        
        </div>
      </div>
    </div>
  </div>
 -->
 {% include "/datogrupofamiliar/registro-automatico-js.volt" %}

  {% include "/datogrupofamiliar/agregar-modal-js.volt" %}
  {% include "/datogrupofamiliar/editar-modal-js.volt" %}
  {% include "/datogrupofamiliar/eliminar-js.volt" %}


