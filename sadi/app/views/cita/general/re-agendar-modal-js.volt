<script>
 function fnReAgendarCitaDetalle(cit_id=0)
 {
    let form_ocupado=document.getElementById('form_re_agendar_cita');
    form_ocupado.reset();
   
    let url_enviar="<?php echo $this->url->get('cita/ajax_get_detalle/') ?>";
                                       
                 $.ajax({
                    type: "POST",
                    url: url_enviar+cit_id,
                     success: function(res)
                       {   
                          //console.log(res);
                          $('#mensaje-re_agendar-cita').html(
                          `
                          <i class="mdi mdi-calendar-plus mdi-18px btn-icon" style="color:orange;"></i> Reagendar cita del estudio estudio No. ${res.ese_id}
                          `                          
                         );
                                     
                         $('#cit_fecha-re_agendar-cita').val(res.cit_fecha);
                         $('#cit_hora-re_agendar-cita').val(res.cit_hora);
                         $('#cit_id-re_agendar-cita').val(cit_id);
                         $('#ese_id-re_agendar-cita').val(res.ese_id);


                         
                         
                         
                       },
                      error: function(res)
                       { 
                                                alert('error en el servidor...'+res.responseText);
                       }
                   });
 }

  $(function(){
    $('#form_re_agendar_cita').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
      let cit_id=$('#cit_id-re_agendar-cita').val();                    
      event.preventDefault();
     
      let formulario=$("#form_re_agendar_cita");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('cita/re_agendar/') ?>";
      url_enviar+=cit_id;
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: formulario.serialize(),
        success: function(res)
        {
          if(res[0]==2)
          {

          Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
            .then((value) => {
             // console.log(window.location.pathname);
              if(window.location.pathname=="/sadi/cita/agenda_index"){
                location.reload();
              }else{
                $form.find("button").prop("disabled", false);
                $('#re-agendar-cita-modal').modal('hide');
                fnCargarDatosTablaCitaESE(res['ese_id']);
              }
              

            });
          }
          else
          {
            let type_alert="";
            if(res[0]=='-2'){
               type_alert="error";

            }
            if(res[0]=='-1'){
               type_alert="warning";
            }
            Swal.fire({title:res['titular'],text:res['mensaje'],type:type_alert})
              .then((value) => {
              location.reload();
              });
          }
        },
        error: function(res)
        { 
          console.error(res.responseText);
        
        }
      });
      return false;
    });
  });
</script>

 
<div class="modal fade" id="re-agendar-cita-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="exampleModalLabel">
          <div id="mensaje-re_agendar-cita"></div></h5>
        <button type="button" class="close" onclick="$('#re-agendar-cita-modal').modal('hide');" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_re_agendar_cita" class="form-vertical mt-1">

          <div class="form-group row">
            <div class="col-lg-12">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Motivó por el cual reagenda la cita</label>
              <input type="text" class="form-control input-rounded" placeholder="Motivó..."  name="data_cita_anterior[cit_comentario]" id="cit_comentario_motivo-re_agendar-cita" maxlength="150" oninput="handleInput(event)" required />

        

            </div>
            <div class="col-lg-2">
              <input type="hidden" id="ese_id-re_agendar-cita" name="ese_id" >
              <input type="hidden" id="cit_id-re_agendar-cita" name="cit_id" >

              <label class="col-form-label title-busq" for="ese_nombre">Fecha nueva</label>
              <input type="date" class="form-control input-rounded" placeholder="Fecha..." id="cit_fecha-re_agendar-cita" name="cit_fecha"  required />
            </div>
            <div class="col-lg-2">
              <label class="col-form-label title-busq" for="ese_primerapellido">Hora nueva</label>
              <input type="time" class="form-control input-rounded timeInput" placeholder="Hora..."  name="cit_hora" id="cit_hora-re_agendar-cita" required />

            </div>
            <div class="col-lg-8">
              <label class="col-form-label title-busq" for="ese_segundoapellido">Comentario nuevo</label>
              <input type="text" class="form-control input-rounded" placeholder="Comentario..."  name="cit_comentario" id="cit_comentario-re_agendar-cita" maxlength="150" oninput="handleInput(event)" required />

        

            </div>


          <div class="row col-lg-12">
            <div class="col-sm-6 col-md-6 text-center mt-5">
            </div>
            <div class="col-sm-3 col-md-3 text-center mt-5">
                <div class="form-group">
                  <a class="btn-dark btn-rounded btn btn-limpiar" onclick="$('#re-agendar-cita-modal').modal('hide');"><i class=" mdi mdi-close white"></i>  Cancelar</a>
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