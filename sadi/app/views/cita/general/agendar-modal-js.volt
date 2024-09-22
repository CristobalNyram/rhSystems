
<script>
  function fnCrearCita(ese_id=0)
  {

    let form_ocupado=document.getElementById('form_crear_cita');
    form_ocupado.reset();


    url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
    let titulo_modal=$('#mensaje-crear-cita');
       $.ajax({
            type: "POST",
            url: url_enviar_ese_data+ese_id,
            success: function(res)
            {

              if(res.length>0){
                let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                titulo_modal.html(` <i class="mdi mdi-plus mdi-18px btn-icon" style="color:green;"></i> Agregar cita al estudio No. ${ese_id} ${mensaje_empresa_candidato}`);
                $('#ese_id-crear-cita').val(ese_id);

              }
             
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
              
            }
          });

  } 

  $(function(){
    $('#form_crear_cita').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
      return false;
      }
      event.preventDefault();
      let formulario=$("#form_crear_cita");
      let $form = $(this);
      // $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('cita/agendar/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: formulario.serialize(),
        success: function(res)
        {

          if(res[0]==2)
          {
            $('#btnAgregarCita').hide();

            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
             .then((value) => {
                  $form.find("button").prop("disabled", false);               
                  $('#agregar-cita-modal').modal('hide');
                  fnCargarDatosTablaCitaESE(res['ese_id']);
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
        alert('ERROR EN EL SERVIDOR');
        }
      });
      return false;
    });
  });
      
 </script>
 
 <div class="modal fade" id="agregar-cita-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">
          <div id="mensaje-crear-cita"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_crear_cita" class="form-vertical mt-1">

          <div class="form-group row">
            <div class="col-lg-2">
              <input type="hidden" id="ese_id-crear-cita" name="ese_id" >

              <label class="col-form-label title-busq" for="ese_nombre">Fecha</label>
              <input type="date" class="form-control input-rounded" placeholder="Fecha..." id="cit_fecha-crear-cita" name="cit_fecha"  required />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="ese_primerapellido">Hora</label>
              <input type="time" class="form-control input-rounded timeInput" placeholder="Hora..."  name="cit_hora" id="cit_hora-crear-cita" required />

            </div>
            <div class="col-lg-8">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Comentario</label>
              <input type="text" class="form-control input-rounded" placeholder="Comentario..."  name="cit_comentario" id="cit_comentario-crear-cita" maxlength="150" oninput="handleInput(event)" required />

        

          </div>


          <div class="row col-lg-12">
            <div class="col-sm-6 col-md-6 text-center mt-5">
            </div>
            <div class="col-sm-3 col-md-3 text-center mt-5">
                <div class="form-group">
                  <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar</a>
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
</div>