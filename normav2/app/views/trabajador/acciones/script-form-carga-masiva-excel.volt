
<script>
    $(document).ready(function() {
    $('#participantesform').submit(function(event) {
        event.preventDefault();

        // Validar si hay un archivo cargado
        var archivoCargado = $('#participan').prop('files')[0];
        if (!archivoCargado) {
            alertify.alert("AVISO",'Por favor, seleccione un archivo para cargar.', function () {
              });
        return;
        }
        this.submit();

    });
});
</script>

<div id="cargarparticipante" class="modal fade" role="dialog">
    <div class="modal-dialog">
      {{ form('cuestionario/folionuevo', 'id': 'participantesform', 'enctype': 'multipart/form-data') }}
        <div class="modal-content" id="contentSession">
          <!--lo que esta entre esto cambia con ajax-->
         
         
  
          <div class="modal-header text-center">
            <h4 class="" id="exampleModalLabel"><br>Cargar archivo de participantes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
  
  
          <div class="modal-body">
            <fieldset class="form-group">
              <div class="col-sm-12">
                <span>Descarga el formato de plantilla 
                  {{ link_to("public/assets/documents/plantilla-carga-usuarios.xlsx", "aquí", "download" : "plantilla") }}

                </span>
              </div>
              <div class="col-sm-10">
                <div class="form-group">
                  <label class="col-form-label title-busq " style="font-size: 1rem;">Cargar archivo </label>
                    <div class="form-group mb-0">
                  <!-- <input type='hidden' id='id_cuo' name='id_cuo' value=""> -->
                  <!-- <input type='hidden' id='id_emp' name='id_emp' value=""> -->
                  <input type="file" id="participan" name='participan'  accept=".xlsx" class="filestyle col-lg-12" data-btnClass="btn filestyle-rounded">
                  </div>
  
                </div>
                
              </div>
              
           
  
              <div class="form-group col-lg-12 mt-5">
                <center><button class="btn-dark btn-rounded btn btn-buscar " type="submit">Enviar </button></center>
              </div>
  
            </fieldset>
          </div>
        </div>
  
      </form>
    </div>
  </div>
  