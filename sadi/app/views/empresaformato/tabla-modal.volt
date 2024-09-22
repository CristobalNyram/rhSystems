<script>
function fnGetEmpresaformatos(emp_id=0)
{
       let url_enviar="<?php echo $this->url->get('empresa/ajax_empresa_detalle/') ?>";
        // let $nivel_estudios =ese_id
        $.ajax({
            type: "POST",
            url: url_enviar+emp_id,   
            success: function(res)
            {
             // console.log(res.data);
              if(res.estatus=='2'){
                $('#msae_empresaformato').text('Formatos de estudios asignados a '+res.data.emp_alias);   
                fnCargarFormatosAsignadosAEmpresas(emp_id);
                $('#emp_id-empresaformato-modal').val(emp_id);
              
              }
              

            },
            error: function(res)
            {
                alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              
            }
        });
}
</script>


<script>


  function fnCargarFormatosAsignadosAEmpresas(emp_id=0)
  {             

         
      
                url="<?php echo $this->url->get('empresaformato/tabla/') ?>";
                url+=emp_id;
                $.post(url, $(this).serialize() , function(data)
                  {      
                                     
                             $('#listado_empresaformato').empty();
                              $('#listado_empresaformato').html(data);

                              $('#empresaformato_table').DataTable(
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


  
  </script>


<div class="modal fade" id="empresaformato-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <!-- <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel"> -->
          <div class="modal-header">
            <h5><div id="msae_empresaformato"></div></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-2">
            <div class="text-left">
              {{ link_to('#', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'50'),"data-toggle":"modal","data-target":"#asignar_empresaformato-modal","title":"Asignar formato",'onclick':'fnGetFormatosDisponiblesParaEmpresa()') }}
            </div>
          </div>
          <input type="hidden" id="emp_id-empresaformato-modal">
          <div class="modal-body">
            <!-- <br /> -->
            <!-- <h2><div id="cliente_recibo"></div></h2> -->
            <!-- <h2><div id="descripcion_recibo"></div></h2> -->
            
            <div id="listado_empresaformato">
            </div>
          </div>
        <!-- </div>
      </div> -->
    </div>
  </div>
</div>

{% include "/empresaformato/deactivar-js.volt" %}
{% include "/empresaformato/asignar-modal-js.volt" %}
