<script type="text/javascript">


  function principal(){

    let fecha_inicial= $('#ine_fechainicial').val();
    let fecha_final=$('#ine_fechafinal').val();
    let validacion=true;

    if((fecha_inicial!='' && fecha_final!=''))
    {
      let f_ini=new Date(fecha_inicial);
      let f_fin=new Date(fecha_final);
      if(f_ini<=f_fin)
      {
        validacion=true;
      }
      else
      {
        validacion=false;
        Swal.fire({title:'ERROR EN FECHA',text:'Hay un error en las fechas que usted ingresó.',type:"error"});
      }
    }  
    if(validacion)
    {
      document.getElementById("listadoprincipal").innerHTML="";

      urlreloadprincipal="<?php echo $this->url->get('incidencia/reporte_tabla/') ?>";
      $.post(urlreloadprincipal, $('form').serialize() , function(data)
      {        
        $('#listadoprincipal').html(data);
        var table=$('#datatable-buttons').DataTable({
          "pageLength": 100,
          "order": [0, 'asc'],
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
              title: 'Incidencias'
            }, 
            {
              extend: 'pdfHtml5',
              orientation: 'landscape',
              pageSize: 'LEGAL',
            },
            'colvis'
          ]
        });
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        document.getElementById('busqueda').style.display = 'none';
        document.getElementById('otrabusqueda').style.display = 'block';
      }).done(function() { 

      }).fail(function() {
      })
    }
  }

  function fnmostrarbusqueda(){
    document.getElementById('busqueda').style.display = 'block';
    document.getElementById('otrabusqueda').style.display = 'none';
  }

</script>
<div class="row">
  <div class="col-6">
          <h4 class="header-title header-title-crm">Incidencias</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
    </div>
  </div>
</div>
<div class="mt-3">
  <div class="card card-crm">
    <div id="busqueda" name="busqueda">
      {% if acceso.verificar(47,rol_id)==1 %}
        <form id="form_estatus_estudio"  class="form-vertical col-md-12 row">
          <div class="col-lg-12">
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-form-label  title-busq">Rango de Fecha</label>
                <div>
                  <div class="input-group" id="">
                    <label class="col-form-label  title-busq">Desde</label>
                    <input type="date" id="ine_fechainicial" name="ine_fechainicial" class="form-control bar-left" placeholder="Desde" />
                    <label class="col-form-label  title-busq">Hasta</label>
                    <input type="date" id="ine_fechafinal" name="ine_fechafinal" class="form-control bar-right" placeholder="Hasta" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
          </div>
          <div class="col-lg-3 col-9  text-right">
            <div class="form-group">
              <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button> 
            </div>
          </div>
          <div class="col-lg-1 col-3  text-right">
            <div class="form-group">
              {{ link_to('incidencia/reporte_index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
            </div>
          </div>
        </form>
      {% endif %}
    </div>
    <div id="listadoprincipal">
        <!-- <h5>Realice una búsqueda</h5> -->
    </div>
  </div>
</div>