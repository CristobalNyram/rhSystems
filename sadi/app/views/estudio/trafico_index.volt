


<!-- permisos -->
{% set treintaycinco = acceso.verificar(35,rol_id) %}
{% set treintayseis = acceso.verificar(36,rol_id) %}
{% set treintaynueve= acceso.verificar(39,rol_id) %}
{% set cuarenta = acceso.verificar(40,rol_id) %}
{% set cincuentaynueve = acceso.verificar(59,rol_id) %}
{% set setenta  = acceso.verificar(70,rol_id) %}
{% set setentayseis  = acceso.verificar(76,rol_id) %}
{% set ochentaycuatro  = acceso.verificar(84,rol_id) %}

{% if treintayseis==1 %}
  <script type="text/javascript">
    var clictabla=0;
    function convertirtablainvesdetalles(){
      if(clictabla==0){
        $('#invesdetalles').DataTable({
          'sDom':'t',
          order:[0,'asc'],
          "bPaginate": false,
        });
        clictabla=1;
      }      
    }
  </script>
{% endif %}

<!-- permisos -->
<script type="text/javascript">
  function fnIdESE(id_ESE,tipo,inv_id)
  {
    var id_ese=document.getElementById('ese_id');
    id_ese.value=id_ESE;

    var url="<?php echo $this->url->get('usuario/ajax_getinvestigador/') ?>"

    var $analista_Select = $('select[name="inv_id"]');    
    $analista_Select.empty();

    $.ajax({
      type: "POST",
      url: url+tipo,
      success: function(data)
      {
        
        if (data.length > 0) {
          $analista_Select.append(
          function () {
            var options = '';
            options += '<option value="-1" selected >Seleccionar..</option>';
            $.each(data, function (key, analista) {
              if(analista.usu_id==inv_id){
                options += '<option selected value="'+analista.usu_id+'">'+analista.nombre+'</option>';
              }else{
                options += '<option value="'+analista.usu_id+'">'+analista.nombre+'</option>';
              }
            });
            return options;
            } );
        }
      },
      error: function(res)
      {
          // $("#btn_aprobar").prop("disabled", false);
      }
    });
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
    divListado = document.getElementById('listado');
    url="<?php echo $this->url->get('estudio/trafico_tabla/') ?>";
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
            title: 'Tráfico investigador'
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
  });
</script>
  
  <div class="row">
    <div class="col-sm-6">
      <h4 class="header-title header-title-crm ">Tráfico investigador
      </h4>
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

{% if setentayseis ==1 %}
  {% include "/transporte/archivo-js.volt" %}
  {% include "/transporte/archivo-modales-js.volt" %}
  {% include "/transporte/editar-modal-js.volt" %}
  {% include "/transporte/solicitar-modal-js.volt" %}
  {% include "/transporte/asignar-transporte-modal-js.volt" %}
{% endif %}


{% include "/estudio/verdetalles.volt" %}
{% include "/estudio/cancelar.volt" %}

{% include "/estudio/regresar_estatus-modal-js.volt" %}
{% include "/estudio/trafico_modal-js.volt" %}
{% include "/estudio/editarverificacion.volt" %}
{% include "/estudio/vercompletoese-modal.volt" %}
{% include "/estudio/editarestudiosocioeconomico.volt" %}
{% include "/estudio/editarsupervivencia.volt" %}
{% include "/estudio/asignaranalista-trafico-investigador-modal-js.volt" %}
{% include "/estudio/asignaranalista-obtener-detalles-modal-js.volt" %}

<!-- reasignar investigador -->
{% include "/estudio/acciones/re-asignar-investigador-modal-js.volt" %}



<!-- diferentes formatos de ese -->
{% include "/formatoese/formato-gabtubos.volt" %}
{% include "/formatoese/formato-gabencognv.volt" %}
{% include "/formatoese/formato-truper.volt" %}



<!-- editar aes -->
{% if setenta ==1 %}
  {% include "/autoestudio/editar-modal-js.volt" %}
{% endif %}

<!-- citas inciio -->
{% if ochentaycuatro ==1 %}
  {% include "/cita/general/tabla-modal.volt" %}
{% endif %}
<!-- citas fin -->