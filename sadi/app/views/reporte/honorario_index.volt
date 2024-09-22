{{ stylesheet_link('plugins/datatables/datatables.min.css') }}
{{ javascript_include('plugins/datatables/datatables.min.js') }}

{{ stylesheet_link('css/datatables/css/dataTables.checkboxes.css') }}
{{ javascript_include('js/datatables/dataTables.checkboxes.min.js') }}
<script type="text/javascript">
    function GetSelectedHonorario() {
        let fecha_inicial= $('#fechainicio').val();
        let fecha_final= $('#fechafin').val();
        //Reference the Table.
        var grid = document.getElementById("datatable-buttons");
 
        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");
        var message = '';
        var arreglo=[];
        var longitud=0;
        var jsondatos = {};

        //Loop through the CheckBoxes.
        for (var i = 1; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
              longitud++;
                var row = checkBoxes[i].parentNode.parentNode;
                message += row.cells[1].innerHTML;
                arreglo.push({ 
                    "valor" : row.cells[1].innerHTML
                });
                message += ",";

            }
        }
        if(longitud==0){
          // alertify.alert('ERROR','No se ha seleccionado ningún registro, reintente');
          Swal.fire({title:'ERROR ',text:'No se ha seleccionado ningún registro, reintente',type:"error"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
          
          return false;

        }
        if($('#fechainicio').val()=='')
        {
          // alertify.alert('ERROR','No se ha seleccionado ninguna fecha inicial, por favor indica la fecha inicial para enviar el correo correctamente.');
          Swal.fire({title:'ERROR ',text:'No se ha seleccionado ninguna fecha inicial, por favor indica la fecha inicial para enviar el correo correctamente.',type:"error"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
          return false;
        }

        jsondatos.arreglo=arreglo;
        jsondatos.fechaini=fecha_inicial;
        jsondatos.fechafin=fecha_final;
        // console.log(jsondatos);
        // return;
        var urlmasa="<?php echo $this->url->get('reporte/enviarhonorario/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlmasa,
          data: jsondatos,
          success: function(res)
          {
            if(res[2]!=2)
            {
              // alertify.alert("Error",res[1]);
              Swal.fire({title:'ERROR ',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
            }
            else
            {
              if(res[2]==-1)
              {
                // alertify.alert("Error",res[1]);
                Swal.fire({title:'ERROR ',text:res[1],type:"error"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
              }
              else{
                // alertify.alert("Éxito",res[1], function(){ 
                //   // location.reload();
                // });
                Swal.fire({title:'Éxito ',text:res[1],type:"success"})
                                                                 .then((value) => {
                                                                    //  location.reload();  
                                                                     });
              }
              
            }

          },
          error: function(res)
          { 
            alert('Error en el servidor...');
          }
        });
        return false;
    }

    function cambiafecha(){
        let btnbuscar = document.getElementById('buscar');
        btnbuscar.disabled=false;
        // alert("cambió");
        let fecha_inicial= $('#ese_fechainicial').val();
        let fecha_final= $('#ese_fechafinal').val();
        var fecha = moment(fecha_inicial);
        // alert(moment(fecha_inicial,'YYYY-MM-DD',true).format());
        // alert(fecha.day());
        // return
        if(moment(fecha_inicial,'YYYY-MM-DD',true).format()=='Invalid date'){
          alertify.alert('ERROR','Seleccione una fecha válida');
            btnbuscar.disabled=true;
            return;
        }
        if(fecha.day()!=1){
          alertify.alert('ERROR','Debe seleccionar un lunes para iniciar la semana');

            btnbuscar.disabled=true;
            return;
        }
        $('#ese_fechafinal').val(moment(fecha_inicial).add(6,'day').format('YYYY-MM-DD'));
        

    }

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
                  alertify.alert('ERROR EN FECHA','Hay un error en las fechas que usted ingresó.');
                }
        }
          
       if(validacion)
       {

              document.getElementById("listadoprincipal").innerHTML="";

              urlreloadprincipal="<?php echo $this->url->get('reporte/honorario_tabla/') ?>";
              $.post(urlreloadprincipal, $('form').serialize() , function(data)
              {

                  
                  $('#listadoprincipal').html(data);
                    var table=$('#datatable-buttons').DataTable({
                      "pageLength": 100,
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
                      "order": [1, 'asc'],
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
                          title: 'Honorario / Viático'
                        
                      }, 
                      {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                      
                      },
                      'colvis',
                      {
                        text: "Enviar a investigador",
                        action: function ( e, dt, node, config ) {
                              GetSelectedHonorario();
                          }
                      }
                    ]
                    
                  });
                  table.buttons().container()
                      .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

                  document.getElementById('busqueda').style.display = 'none';
                  document.getElementById('otrabusqueda').style.display = 'block';
                  // document.getElementById('listadoultimaspolizas').style.display = 'none';

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
          <h4 class="header-title header-title-crm">Honorarios/Viáticos</h4>
  </div>
  <div class="col-6">
    <div class="text-right">
    </div>
  </div>
</div>
<div class="mt-3">
  <div class="card card-crm">
    <div id="busqueda" name="busqueda">
      {% if acceso.verificar(27,rol_id)==1 %}
    
    <form id="form_estatus_estudio"  class="form-vertical col-md-12 row">
            <div class="col-lg-12">
                    <div class="form-horizontal">
                        <div class="form-group">
                             <label class="col-form-label  title-busq">Rango de Fecha</label>
                                <div>
                                    <div class="input-group" id="">
                                        <label class="col-form-label  title-busq">Desde</label>
                                        <input onchange="cambiafecha();" type="date" id="ese_fechainicial" name="ese_fechainicial" class="form-control bar-left" placeholder="Desde" />
                                        <label class="col-form-label  title-busq">Hasta</label>
                                        <input readonly type="date" id="ese_fechafinal" name="ese_fechafinal" class="form-control bar-right"  placeholder="Hasta" />
                                    </div>
                                </div>
                        </div>
                    </div>

            </div>

    
            <div class="col-lg-8">
                    
                    </div>
                    <div class="col-lg-3 col-9  text-right">
                    <div class="form-group">
                        <!-- <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>  -->

                        <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar" disabled><i class=" mdi mdi-magnify white"></i>  Buscar</button> 
                       </div>
                    </div>
                    <div class="col-lg-1 col-3  text-right">
                        <div class="form-group">
                        {{ link_to('reporte/honorario_index', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
                        </div>
            </div>
        
  
    </form>
      {% endif %}
    </div>
    <div id="listadoprincipal">
        <!-- <h5>Realice una búsqueda</h5> -->
    </div>
    
        <!-- end content -->

  </div>
    <!-- END content-page -->

</div>
        <!-- END wrapper -->