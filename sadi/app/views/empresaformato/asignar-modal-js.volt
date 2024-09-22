<script>
      function fnGetFormatosDisponiblesParaEmpresa()
        {
            let emp_id=$('#emp_id-empresaformato-modal').val();
            $select_id=$('#tif_id-asignar_empresaformato');
            $select_id.empty();
            $('#emp_id-asignar_empresaformato').val(emp_id);
            let url_enviar="<?php echo $this->url->get('empresaformato/ajax_formatos_disponibles_para_empresa/') ?>";
                // let $nivel_estudios =ese_id
    
                $.ajax({
                    type: "POST",
                    url: url_enviar+emp_id,
                    
                    success: function(res)
                    {
                    //console.log(res); 
                        if(res.estatus=='2'){
                            let data=res.data;
                            if (data.length > 0) {
                            $select_id.append(function () {
                                var options = '';
                            
                                
                                $.each(data, function (key, dat) {                       
                                        options += '<option   value="' + dat.tif_id + '">' +dat.tif_nombre+'</option>'; 

                                });

                                return options;
                                });
                            }else{
                            $select_id.append(function () {
                                var options = '';
                                options += '<option selected value="-1">No aplica</option>';
                                return options;
                            });
                            }


                        }else{
                        

                        }
                    },
                    error: function(res)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                    
                    }
                });
        }

        $(function (){

          $("#frm_asignar_empresaformato").submit(function(event) 
         {
          let emp_id =$('#emp_id-asignar_empresaformato').val();
            /* Act on the event */
            let select = document.getElementById("tif_id-asignar_empresaformato");

            if (select.selectedIndex === -1) {
              Swal.fire({title:'SIN DATOS',text:'Debes seleccionar al menos un formato',type:"warning"})
                          .then((value) => {
                       });     

            return false;
            }

            var $form = $(this);
            var urled="<?php echo $this->url->get('empresaformato/asignar_a_empresa/') ?>";
            a=$form.valid();
            if(a==false){
                return false;
            }
              $form.find("button").prop("disabled", true);
              $.ajax({
              type: "POST",
              url: urled+emp_id,
              data: $("#frm_asignar_empresaformato").serialize(),
              success: function(res)
              {
                if(res[0]=='2')
                {
                Swal.fire({title:res['titular'],text:res['mensaje'],
                type:"success"
                })
                .then((value) => {
                  fnCargarFormatosAsignadosAEmpresas(res['emp_id']);            
                  $('#asignar_empresaformato-modal').modal('hide');                                  
                });

                                                                        
                 }
                 else
                {
                     Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                          .then((value) => {
                           location.reload();  
                       });                                               
                }
                
                $form.find("button").prop("disabled", false); 
              },
              error: function(res)
              { 
                $form.find("button").prop("disabled", false); 
              }
          });
          return false;
      });


        });
      

</script>


<div class="modal fade" id="asignar_empresaformato-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">Asignar formato</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="frm_asignar_empresaformato" class="form-vertical mt-1">
            <div class="form-group row">
  
            <input id="emp_id-asignar_empresaformato" name="emp_id" type="hidden" class="form-control input-rounded" minlength="2" placeholder="Nombre/Alias" required oninput="handleInput(event)"/>
            
            <div class="col-lg-12">
                <label class="col-form-label title-busq">Tipo de formato</label>
  
                <select multiple name="emp_tipoformato[]" id="tif_id-asignar_empresaformato" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                  <optgroup>
                    
  
                  </optgroup>
                </select>
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
                      <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-chevron-right white"></i> </button>
                    </div>
                </div>
              </div>
            </div>
          </form>      
        </div>
       
      </div>
    </div>
            
  </div>