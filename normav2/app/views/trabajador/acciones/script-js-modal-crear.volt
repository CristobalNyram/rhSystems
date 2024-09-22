<script>
  $(document).ready(function() {
    $('#cargaunsolorparticipante').on('show.bs.modal', function (e) {
      $('#frm_crearparticipante')[0].reset();
      fnempresas_adaptable(-1,$("#empresaid"));
    });

   
  });
</script>

<script>
  $(function () {
    /*-crear participante-------------------------------------------------------------------------------------------start crear participante*/
    $("#frm_crearparticipante").submit(function (event) {
      var empresaEvaluate = $("#empresaid").val();
      // alert(empresaEvaluate);

      if (empresaEvaluate != -1) {
        /* Act on the event */
        var $form = $(this);
        var urlcrear = "<?php echo $this->url->get('trabajador/crear/') ?>";
        // $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urlcrear,
          data: $("#frm_crearparticipante").serialize(),
          success: function (res) {
            if (res === "1") {
              alertify.error("ERROR, la matrícula esta repetida", function () {
                location.reload();
              });
            }
            if (res === "2") {
              alertify.error("ERROR, al guardar los datos");
            }

            if (res === "3") {
              alertify.alert("Éxito", "Participante guardado.", function () {
                location.reload();
              });
            }

          },
          error: function (res) {
            $form.find("button").prop("disabled", false);
          },
        });
        return false;
      } else {
        alertify.alert("AVISO","Debes seleccionar a la empresa a que le corresponde");
      }
    });
  });

  /*-crear participante-------------------------------------------------------------------------------------------end crear participante*/
</script>

<!-- CARGAR UN SOOLO PARATIPANTE START ------------------------------------------------------------------------------------------------------------------------START-->
<div class="modal fade" id="cargaunsolorparticipante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <form method="post" target="_self" id="frm_crearparticipante"  onsubmit="return false" class="form-vertical mt-1">
            <div class="modal-content" id="contentSession">
              <!--lo que esta entre esto cambia con ajax-->
             
             
              <div class="modal-header text-center">
                <h4 class="" id="exampleModalLabel"><br>Agregar un participante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
      
              <div class="modal-body">
                <form class="form-vertical mt-1">
                  <div class="form-group row">
       
      
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Matrícula</label>
                      <input type="text" name="fol_matricula" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Escribe tu número de matrícula aquí" min="0" max="9999" title="Matrícula."  />
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Nombre(s)</label>
                      <input type="text" name="fol_nombre" class="form-control input-rounded"  oninput="handleInput(event)" placeholder="Nombre(s)" required/>
                    </div>
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Primer Apellido</label>
                      <input type="text" name="fol_primerapellido" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Primer Apellido" required/>
                    </div>
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Segundo apellido</label>
                      <input type="text" name="fol_segundoapellido" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Segundo apellido"  required/>
                    </div>
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Correo</label>
                      <input type="email" name="fol_correo" class="form-control input-rounded" placeholder="correo@ejemplo.com"  />
                    </div>
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Puesto</label>
                      <input type="text" name="fol_puesto" class="form-control input-rounded" oninput="handleInput(event)" placeholder="Puesto"  />
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Área</label>
                      <input type="text" name="fol_area" class="form-control input-rounded" oninput="handleInput(event)"  placeholder="Área"  required/>
                    </div> 
      
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Empresa</label>
                      <select name="emp_id" id="empresaid" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                        <optgroup>
                            <option   value="-1" >Seleccionar..</option>
                           
                          
                        </optgroup>
                      </select>
                    </div>
      
                 
                 
              
                 
                    
              
                    <div class="col-lg-12    text-center d-flex justify-content-end ">
      
      
                      <div class="col-sm-3 col-md-3 text-center mt-5">
                          <div class="form-group">
                            <button  class="btn-dark btn-rounded btn btn-limpiar"  data-dismiss="modal"  ><i class=" mdi mdi-close white"></i>  Cancelar</button>
                          </div>
                      </div>
                      <div class="col-sm-3 col-md-3  text-center mt-5 ">
                          <div class="form-group">
                            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                          </div>
                      </div>
                    </div>
                  </div>
                </form>      
              </div>
      
          
            </div>
      
          </form>
      
     
      </div>
    </div>
            
  </div>
  
  <!-- --------------------------------------------------------------------------------------------------------------------------------------------- CARGAR UN SOLO PARTICANTE END -->
  
  