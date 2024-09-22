{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
<script>
  function fnConsultarReporteEfectividadPDF(){
    let url_data="<?php echo $this->url->get('reporte/reporte_efectividad/') ?>";
    url_data+=$dato0+"/"+$dato1+"/"+$dato2+"/"+$dato3+"/"+$dato4+"/"+$dato5+"/"+$dato6+"/"+$texto;
    window.open(url_data, "_blank");

  }
  function creargraficatotal(){
    let grupo0= Number(document.getElementById("grupo0").textContent);
    let grupo1= Number(document.getElementById("grupo1").textContent);
    let grupo2= Number(document.getElementById("grupo2").textContent);
    let grupo3= Number(document.getElementById("grupo3").textContent);
    let grupo4= Number(document.getElementById("grupo4").textContent);
    let grupo5= Number(document.getElementById("grupo5").textContent);
    let grupo6= Number(document.getElementById("grupo6").textContent);
    let texto=$('#texto').val();

    $dato0= grupo0;
    $dato1= grupo1;
    $dato2= grupo2;
    $dato3= grupo3;
    $dato4= grupo4;
    $dato5= grupo5;
    $dato6= grupo6;
    $texto= texto;

    total= grupo0+ grupo1+ grupo2+ grupo3+  grupo4+ grupo5 + grupo6;
    grupo0=grupo0*100/total;
    grupo1=grupo1*100/total;
    grupo2=grupo2*100/total;
    grupo3=grupo3*100/total;
    grupo4=grupo4*100/total;
    grupo5=grupo5*100/total;
    grupo6=grupo6*100/total;

    Morris.Donut({
      element: 'grafica',
      data: [
          { label: '0 DÍAS' , value: Number(grupo0).toFixed(2) },
          { label: '1 DÍA' , value: Number(grupo1).toFixed(2) },
          { label: '2 DÍAS' , value: Number(grupo2).toFixed(2) },
          { label: '3 DÍAS' , value: Number(grupo3).toFixed(2) },
          { label: '4 DÍAS' , value: Number(grupo4).toFixed(2) },
          { label: '5 DÍAS' , value: Number(grupo5).toFixed(2) },
          { label: '6 DÍAS ó MÁS' , value: Number(grupo6).toFixed(2) },
      ]
      ,formatter: function (value, data) {
        return value + '%';
      }
      , colors: ['#16345E', '#00739D', '#00B7C2', '#71FACA']
    });
  }
</script>
<script type="text/javascript">
    $(document).ready((event)=>{
        $('#ese_fechainicial').val(moment().format('YYYY-MM-DD'));
        $('#ese_fechafinal').val(moment().format('YYYY-MM-DD'));
    });

  function principal(){

    let fecha_inicial= $('#ese_fechainicial').val();
    let fecha_final=$('#ese_fechafinal').val();
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

      urlreloadprincipal="<?php echo $this->url->get('reporte/efectividad_tabla/') ?>";
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
            {
              text: "Reporte",
              action: function ( e, dt, node, config ) {
                fnConsultarReporteEfectividadPDF();
                }
            },
            'colvis'
          ]
        });
        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        document.getElementById('busqueda').style.display = 'none';
        document.getElementById('otrabusqueda').style.display = 'block';

      }).done(function() { 
        creargraficatotal();
      }).fail(function() {
      })

      // creargraficatotal();
    }
    // creargraficatotal();
  }

  function fnmostrarbusqueda(){
    document.getElementById('busqueda').style.display = 'block';
    document.getElementById('otrabusqueda').style.display = 'none';
  }

  

</script>
<div class="row">
  <div class="col-6">
          <h4 class="header-title header-title-crm">Efectividad</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
    </div>
  </div>
</div>
<div class="mt-3">
  <div class="card card-crm">
    <div id="busqueda" name="busqueda">
      <form id="form_estatus_estudio"  class="form-vertical col-md-12 row">
          <div class="col-lg-3">
              <label class="col-form-label title-busq">Tipo de estudio <i class="mdi mdi-checkbox-intermediate"></i></label>
              <select name="tip_id" id="tip_id" data-toggle="select2" class="form-control select2-multiple">
                  <option value="-1">Todos</option>
                  {% for tipoEstudio in tipoEstudios %}
                  <option value="{{tipoEstudio.tip_id}}" >{{tipoEstudio.tip_nombre}}</option>
                  {% endfor %}
              </select>
          </div>
          <div class="col-lg-3">
            <label class="col-form-label title-busq">Grupo de negocio <i class="mdi mdi-checkbox-intermediate"></i></label>
            <select name="neg_id" id="neg_id" data-toggle="select2" class="form-control select2-multiple">
              <option value="-1">Todos</option>
              {% for dat in negocioSelect %}
                <option value="{{dat.neg_id}}" >{{dat.neg_nombre}}</option>
              {% endfor %}
            </select>
          </div>
          <div class="col-lg-3">
            <label class="col-form-label title-busq">Empresa <i class="mdi mdi-checkbox-intermediate"></i></label>
            <select name="emp_id" id="emp_id" data-toggle="select2" class="form-control select2-multiple">
              <option value="-1">Todos</option>
              {% for dat in empresaSelect %}
                <option value="{{dat.emp_id}}" >{{dat.emp_nombre}}</option>
              {% endfor %}
            </select>
          </div>
          <div class="col-lg-3">
              <label class="col-form-label title-busq">Estado <i class="mdi mdi-checkbox-intermediate"></i></label>
              <select name="est_id" id="est_id" data-toggle="select2" class="form-control select2-multiple">
                  <option value="-1">Todos</option>
                  {% for dat in estadoSelect %}
                  <option value="{{dat.est_id}}" >{{dat.est_nombre}}</option>
                  {% endfor %}
              </select>
          </div>
          <div class="col-lg-6 " id="fecha_alta_div">
              <label class="col-form-label  title-busq">Fecha de asignación (alta)<i class="mdi mdi-upload"></i></label>
              <div>
                  <div class="input-group" id="">
                      <label class="col-form-label  title-busq">Desde</label>
                      <input type="date" id="ese_fechainicial" name="ese_fechainicial" class="form-control bar-left" placeholder="Desde" />
                      <label class="col-form-label  title-busq">Hasta</label>
                      <input type="date" id="ese_fechafinal" name="ese_fechafinal" class="form-control bar-right" placeholder="Hasta" />
                  </div>
              
              </div>
          </div>
        <div class="col-lg-8 mt-4">
        </div>
        <div class="col-lg-3 col-9  text-right mt-4">
          <div class="form-group">
            <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button> 
          </div>
        </div>
        <div class="col-lg-1 col-3  text-right mt-4">
          <div class="form-group">
            {{ link_to('reporte/efectividad_index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
          </div>
        </div>
      </form>
    </div>
    <div id="listadoprincipal">
        <!-- <h5>Realice una búsqueda</h5> -->
    </div>
  </div>
</div>