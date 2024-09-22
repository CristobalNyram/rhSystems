{% set cuarenta = acceso.verificar(40,rol_id) %}
<script type="text/javascript">

function fnIdESE(id_ESE)
    {


      
      var id_ese=document.getElementById('ese_id');
      id_ese.value=id_ESE;

      var url="<?php echo $this->url->get('usuario/ajax_getanalista_excluir_un_analista/') ?>"

      var $analista_Select = $('select[name="ana_id"]');    
      $analista_Select.empty();
 
        $.ajax({
              type: "POST",
              url: url+id_ese.value,
              success: function(data)
              {

                // console.log(data);
                      if (data.length > 0) {
                             $analista_Select.append(
                             function () {
                                var options = '';
                           
                                options += '<option value="-1" disabled  selected>Seleccionar..</option>';
                            
                                $.each(data, function (key, analista) {                                                                                                      
                                          options += '<option value="'+analista.usu_id+'">'+analista.nombre+'</option>';                                               
                                });
                                return options;  
                               } ); 
                      }

              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              }
          }).done(function(){

            url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

						$.ajax({
								type: "POST",
								url: url_enviar_ese_data+id_ESE,
								success: function(res)
								{

                  if(res[0].ese_estatus=='-2' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
                  }  

                  if(res[0].ese_estatus!='4' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
                  }  
									if(res.length>0){
										let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;


                    $("#titulotraficoanalista").html("Asignar analista a ESE con Folio: "+id_ESE+mensaje_empresa_candidato);

										/*let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
										$("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);
										*/
									}
									//alert();
								
								},
								error: function(data)
								{
									alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
									
								}
							});

          });


    }


      $(document).ready(function() {







          divListado = document.getElementById('listado');
          url="<?php echo $this->url->get('estudio/asignaranalista_tabla/') ?>";
          $.post(url, $(this).serialize() , function(data)
          {
              divListado.innerHTML=data;
              var table=$('#td_empresa').DataTable({
                "pageLength": 100,
                scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
                columnDefs: [
                  { "visible": false, "targets": 0 }
                ],
                order:[4,'asc'],
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
                    },
                    title: 'Asignar analista'
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
          }).done(function() { 
          }).fail(function() {
          })
      } );
     
      
 

  </script>
  
  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm ">Asignar analista</h4>
    </div>
    <div class="col-sm-5">
      <!-- <div class="text-right curso" style="margin-top: 35px; font-weight: 600">
        <a href="#">NUEVO ESTUDIO SOCIOECONÓMICOS</a>
      </div> -->
    </div>
    <div class="col-sm-1">
    <div class="text-left">
      <!-- {{ link_to('', 'data-target':'#Modal_empresa', 'data-toggle':'modal', image("assets/images/small/boton.svg", 'class':'boton-plus', 'height':'60'))  }} -->
      <!-- <a href="#"><img src="assets/images/small/boton.svg" class="boton-plus" height="60"></a> -->
    </div>
      </div>
  </div>
  
  
  <div class="mt-3">
      <div class="card card-crm">
          <div id="listado">
          </div>
      </div>
  </div>
  

  
<!-- helper js inicio  -->
{% include "/calificacionfinalgrupo/script-ajax-get-todos-by-grupo.volt" %}
<!-- helper js inicio  -->

{% include "/comentarioese/modales-js.volt" %}
{% include "/archivo/modal-js.volt" %}
{% include "/empresa/ajax-get-alias.volt" %}

{% include "/estudio/verdetalles.volt" %}
{% include "/estudio/cancelar.volt" %}


{% include "/estudio/asignaranalista-modal-js.volt" %}

{% include "/estudio/regresar_estatus-modal-js.volt" %}
{% include "/estudio/editarverificacion.volt" %}
{% include "/estudio/editarestudiosocioeconomico.volt" %}
{% include "/estudio/editarsupervivencia.volt" %}
{% include "/estudio/vercompletoese-modal.volt" %}

<!-- diferentes formatos de ese -->
{% include "/formatoese/formato-gabtubos.volt" %}
{% include "/formatoese/formato-gabencognv.volt" %}
{% include "/formatoese/formato-truper.volt" %}
