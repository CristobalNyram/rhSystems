
{% include "/transporte/archivo-js.volt" %}

{% include "/transporte/archivo-modales-js.volt" %}

<script type="text/javascript">
    $(document).ready(function() {

      divListado = document.getElementById('listado');
      url="<?php echo $this->url->get('transporte/aprobar_tabla/') ?>";
      $.post(url, $(this).serialize() , function(data)
      {
          divListado.innerHTML=data;
          var table=$('#td_transporte').DataTable({
            "pageLength": 100,
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            stateSave: true,
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
                  title: 'Transporte'
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
              .appendTo('#td_transporte_wrapper .col-md-6:eq(0)');
      }).done(function() { 
      }).fail(function() {
      })
    }
  
  );

</script>



<script>
  function fn_aprobar_transporte_modal_llenar(tra_id)
  {
    $('#aprobar-mensaje-modal').html(``);

    let form=document.getElementById('form_transporte_aprobar');
    form.reset();
    let url_enviar="<?php echo $this->url->get('transporte/ajax_get_detalle/') ?>";
    $.ajax({
      type: "POST",
      url: url_enviar+tra_id,
      success: function(res)
      {
        if(res[0]==2)
        {

          if(res['data_ese'].ese_estatus=='-2' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });
          }  

          if(res['data'].tra_estatus!='2' ){
                  Swal.fire({title:'CAMBIO DE ESTATUS',text:'TRABSPORTE CAMBIO DE ESTATUS',type:"warning"})
                  .then((value) => {
                    location.reload();
              
                  });
          }  
          $('#tra_id__aprobar').val(res['data'].tra_id);
          $('#tra_preaprobado__aprobar').val(res['data'].tra_preaprobado);
          $('#tra_solicitado__aprobar').val(res['data'].tra_solicitado);
          $('#tra_origen__aprobar').val(res['data'].tra_origen);
          $('#tra_destino__aprobar').val(res['data'].tra_destino);
          $('#tra_comentario__aprobar').val(res['data'].tra_comentario);
          $('#tra_comentario_admin').val(res['data'].tra_comentarioadmin);

          $('#aprobar-mensaje-modal').html(`No. ${res['data'].tra_id} relacionado con el estudio No. ${res['data_ese'].ese_id}`);
        }
        else
        {
         Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
         .then((value) => {
          //  location.reload();
          // console.log(res);
          });
        }

      },
       error: function(res)
       { 
        alert('error en el servidor...');

      }
    });


  }

  $(document).ready(()=>{
    $('#form_transporte_aprobar').submit(()=>{
      let $form =$(this);
      event.preventDefault();
      $form.find("button").prop("disabled", true);
      var urled="<?php echo $this->url->get('transporte/ajax_aprobar/') ?>";
      
      $.ajax({
        type: "POST",
        url: urled,
        data: $("#form_transporte_aprobar").serialize(),
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
            // alertify.alert(res['titular'],res['mensaje'], function(){
            //   location.reload();  

            // });
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
            .then((value) => {
              // location.reload();  
            });
          }


        },
        error: function(res)
        { 
          console.log('error la conexión');
        }
      });
    }
    );






  });
  

</script>



<div class="row">
<div class="col-sm-6">
  <h4 class="header-title header-title-crm">Desglose de transportes solicitados</h4>
</div>
</div>
<div class="mt-3">
  <div class="card card-crm">
      <div id="listado">
      </div>
  </div>
</div>

<div class="modal fade" id="aprobar-modal" tabindex="-1" aria-labelledby="modal_tra_solicitar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel"> 
          <i class="mdi mdi-check-bold mdi-24px btn-icon"></i>
          Aprobar transporte <span id="aprobar-mensaje-modal"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form_transporte_aprobar">
          <div class="form-group row mt-2">
            <div class="col-lg-2">
              <input type="hidden" name="tra_id__aprobar" id="tra_id__aprobar" >
              <label class="col-form-label title-busq" for="tipoestudio_nombre">Monto pre aprobado</label>
              <input type="number" class="form-control  input-rounded-disabled" disabled name="tra_preaprobado__aprobar" id="tra_preaprobado__aprobar" placeholder="" />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="tipoestudio_nombre">Monto  solicitado</label>
              <input type="number" class="form-control  input-rounded-disabled" disabled name="tra_solicitado__aprobar" id="tra_solicitado__aprobar" placeholder="" />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Monto aprobado</label>
              <input type="number" class="form-control input-rounded" placeholder="$..."  required name="tra_aprobado__aprobar" id="tra_aprobado__aprobar"  step="0.01"  oninput="limitDecimalPlaces(event,2)"/>
            </div>      
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Origen <i class="mdi mdi-map"></i></label>
              <input type="text" class="form-control  input-rounded-disabled" disabled placeholder="Origen..." required name="tra_origen__aprobar" id="tra_origen__aprobar"  oninput="handleInput(event)" />
            </div>
            <div class="col-lg-3">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Destino <i class="mdi mdi-map-plus"></i></label>
              <input type="text" class="form-control input-rounded-disabled" disabled  placeholder="Destino..." required name="tra_destino__aprobar" id="tra_destino__aprobar"  oninput="handleInput(event)" />
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="tipoestudio_descripcion">Comentario de solicitud<i class="mdi mdi-map-plus"></i></label>
              <textarea type="text" class="form-control-textarea text_area_a input-rounded-disabled"  placeholder="Comentario/Nota..." disabled name="tra_comentario__aprobar" id="tra_comentario__aprobar"  oninput="handleInput(event)" ></textarea>
            </div>
            <div class="col-lg-6">
              <label class="col-form-label title-busq" for="tra_comentario_admin">Comentario de admin<i class="mdi mdi-map-plus"></i></label>
              <label class="col-form-label title-busq" id="label_com_comentario_tra__comentario_admin"></label>

              <textarea type="text" class="form-control-textarea text_area_a" maxlength="2000" placeholder="Comentario/Nota..." required name="tra_comentario_admin" id="tra_comentario_admin"  oninput="handleInput(event)" onkeyup="actualizaInfo(2000,'tra_comentario_admin', 'label_com_comentario_tra__comentario_admin')"  ></textarea>
            </div>    
          </div>
          <div class="row col-lg-12">
            <div class="col-sm-6 col-md-6 text-center mt-5">
            </div>
            <div class="col-sm-3 col-md-3 text-center mt-5">
              <div class="form-group">
                <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
              </div>
            </div>
            <div class="col-sm-3 col-md-3  text-center mt-5 ">
              <div class="form-group">
                <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Aprobar <i class="mdi mdi-check-bold white"></i> </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



{% include "/archivo/modal-js.volt" %}
{% include "/archivo/leer-archivo.volt" %}
{% include "/comentarioese/modales-js.volt" %}
{% include "/consulta/resumen-visualizar-modal-js.volt" %}



