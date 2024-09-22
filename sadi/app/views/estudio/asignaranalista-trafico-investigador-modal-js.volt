{% include "/estudio/des-asignaranalista-trafico-investigador-modal-js.volt" %}

<script>

    function  fnAsignarAnalistaEnTrafico(id_ESE){

      var id_ese=document.getElementById('ese_id_asignar_analista_en_trafico');
      $('#ese_id_asignar_analista_en_trafico').val(id_ESE);
    
      id_ese.value=id_ESE;

      var url="<?php echo $this->url->get('usuario/ajax_getanalista_excluir_un_analista/') ?>"

      var $analista_Select = $('select[id="ana_id_asignar_analista_en_trafico"]');    
      $analista_Select.empty();
 
        $.ajax({
              type: "POST",
              url: url+id_ese.value,
              success: function(data)
              {

                // console.log(data);
                      if (data.length > 0) {
                             $analista_Select.append(
                             function () {
                                var options = '';
                           
                                options += '<option value="-1" disabled  selected>Seleccionar..</option>';
                            
                                $.each(data, function (key, analista) {                                                                                                      
                                          options += '<option value="'+analista.usu_id+'">'+analista.nombre+'</option>';                                               
                                });
                                return options;  
                               } ); 
                      }

              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              },
              
              complete: function() {
                let url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";
                $.ajax({
                    type: "POST",
                    url: url_enviar_ese_data+id_ESE,
                    success: function(res)
                    {
                      if(res[0].ese_estatus!='2' ){
                          Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                          .then((value) => {
                            location.reload();
                      
                          });
                      }  
                      if(res[0].ana_id!=null ){
                          Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO YA TIENE ASIGNADO UN ESTUDIO',type:"warning"})
                          .then((value) => {
                            location.reload();
                      
                          });
                      }  

                      if(res.length>0){

                        let primer_mensaje=`<i class="mdi mdi-share mdi-18px btn-icon" style="color:#0074BF"></i> Asignar analista a ESE con Folio: `;
                        let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                        $('#titulotraficoanalista_asignar_analista_en_trafico').html(primer_mensaje+id_ESE+mensaje_empresa_candidato);

                      
                      }
                      //alert();
                    
                    },
                    error: function(data)
                    {
                      alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
                  });
              }
             
          });
    }



        $(document).ready(()=>{

          $("#form_asignar_analista_estudio_en_trafico_investigador").submit(function(event) 
          {
         

            var $form = $(this);
            event.preventDefault();

            if($('#ana_id_asignar_analista_en_trafico').val()==null){
              Swal.fire({title:'FALTAN CAMPOS',html:`<strong class='text-danger'>El analista es requerido...</strong> `,type:"warning"})
                                        .then((value) => {
                                          $form.find("button").prop("disabled", false);

                                        });
                                        return false;
            }

            // if(validar_commentario($comentario_validar))
            // { 
              var urled="<?php echo $this->url->get('estudio/ajax_setasignaranalista_en_trafico_investigador/') ?>";
              $form.find("button").prop("disabled", true);
              $.ajax({
              type: "POST",
              url: urled,
              data: $("#form_asignar_analista_estudio_en_trafico_investigador").serialize(),
              success: function(res)
              {
            
                if(res[0]=='2')
                {
                  
          
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                        .then((value) => {
                                                                  location.reload();  

                                        });
                  

                }
                if(res[0]=='-1')
                {
                  
          
                   Swal.fire({title:res['titular'],html:`<strong class='text-danger'>${res['mensaje']}</strong> `,type:"warning"})
                                        .then((value) => {
                                          $form.find("button").prop("disabled", false);

                                        });
                  

                }
                if(res[0]=='-2')
                {
                  
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                          .then((value) => {
                                                                  location.reload();  

                                            });
                  
                  
                  
                }
              


              },
              error: function(res)
              { 
           
              
                   Swal.fire({title:"Error",text:"Errores al procesar tu petición",type:"error"})
                                                                 .then((value) => {
                                                                  location.reload();  

                                                                     });
                  
              }
              });

         
            // }
            // else
            // {
            //   alertify.alert('Error','Para poder asignar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');

            // }
            
            
          });



          ///reasignar analista

          
          $("#form_re_asignar_analista_estudio_en_trafico_investigador").submit(function(event) 
          {
         

            var $form = $(this);
            event.preventDefault();
           
            if($('#ana_id_re_asignar_analista_en_trafico').val()==null){
              Swal.fire({title:'FALTAN CAMPOS',html:`<strong class='text-danger'>El analista es requerido...</strong> `,type:"warning"})
                                        .then((value) => {
                                          $form.find("button").prop("disabled", false);

                                        });
                                        return false;
            }

            // if(validar_commentario($comentario_validar))
            // { 
              var urled="<?php echo $this->url->get('estudio/ajax_re_asignaranalista_en_trafico_investigador/') ?>";
              $form.find("button").prop("disabled", true);
              $.ajax({
              type: "POST",
              url: urled+esta_en_trafico_analista,
              data: $("#form_re_asignar_analista_estudio_en_trafico_investigador").serialize(),
              success: function(res)
              {
            
                if(res[0]=='2')
                {
                  
          
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                        .then((value) => {
                                                                  location.reload();  

                                        });
                  

                }
                if(res[0]=='-1')
                {
                  
          
                   Swal.fire({title:res['titular'],html:`<strong class='text-danger'>${res['mensaje']}</strong> `,type:"warning"})
                                        .then((value) => {
                                          $form.find("button").prop("disabled", false);

                                        });
                  

                }
                if(res[0]=='-2')
                {
                  
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                          .then((value) => {
                                                                  location.reload();  

                                            });
                  
                  
                  
                }
              


              },
              error: function(res)
              { 
           
              
                   Swal.fire({title:"Error",text:"Errores al procesar tu petición",type:"error"})
                                                                 .then((value) => {
                                                                  location.reload();  

                                                                     });
                  
              }
              });

         
            // }
            // else
            // {
            //   alertify.alert('Error','Para poder asignar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');

            // }
            
            
          });

        });

  </script>
  
  <div class="modal fade" id="asignar_analista_en_trafico-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="titulotraficoanalista_asignar_analista_en_trafico">

             <span id="titulo_ese_id_asignar_analista_en_trafico"> </span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_asignar_analista_estudio_en_trafico_investigador" class="form-vertical mt-1">
            <div class="form-group row">
              <div class="col-lg-10">
                <input type="hidden" id="ese_id_asignar_analista_en_trafico" name="ese_id" value="" >
                <div class="row ml-3">
                  <label class="col-form-label title-busq">Analista</label>
                  <select name="ana_id" id="ana_id_asignar_analista_en_trafico" class="form-control select2-single" data-toggle="select2" data-placeholder="Seleccionar ..." required>
                    <optgroup>
                    <option   value="1" >Seleccionar</option>
                    </optgroup>
                  </select>
                </div>
                <div class="row ml-3">
                  <label class="col-form-label title-busq" id="">Agregue un comentario </label>
                  <label class="col-form-label title-busq" id="label_com_comentario_asignar_analista_en_trafico"></label>
                  <textarea placeholder="Agrega tu comentario..." id="com_comentario_asignar_analista_en_trafico" name="com_comentario" class="form-control-textarea text_area_a"   minlength="4"  maxlength="300"  onkeyup="actualizaInfo(300,'com_comentario_asignar_analista_en_trafico', 'label_com_comentario_asignar_analista_en_trafico')" oninput="handleInput(event)"></textarea>
                </div>
              </div>
              
              <div class="row col-lg-12">
                <div class="col-sm-6 col-md-6 text-center mt-5">
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar </a>
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

  <script>

    


    function  fnReAsignarAnalistaEnTrafico(id_ESE,ana_id,boton_deasignaranalista_activo=0){


      var id_ese=document.getElementById('ese_id_re_asignar_analista_en_trafico');
      $('#ese_id_re_asignar_analista_en_trafico').val(id_ESE);
      $("#titulotraficoanalista_re_asignar_analista_en_trafico").html(`            
      <i class="mdi mdi-account-switch mdi-18px btn-icon" style="color:#0074BF"></i> 
      Re-Asignar analista a ESE con Folio: `+id_ESE);
      id_ese.value=id_ESE;
      esta_en_trafico_analista=0;
      if(boton_deasignaranalista_activo==0){//se encuentra en trafico investigador
        $('#container-des-asignar-analista').show('slow');

      }else{//se encuentra en trafico analista
        esta_en_trafico_analista=1;

        $('#container-des-asignar-analista').hide();

      }

      var url="<?php echo $this->url->get('usuario/ajax_getanalista_excluir_un_analista/') ?>"

      var $analista_Select = $('select[id="ana_id_re_asignar_analista_en_trafico"]');    
      $analista_Select.empty();

        $.ajax({
              type: "POST",
              url: url+id_ese.value,
              success: function(data)
              {

                // console.log(data);
                      if (data.length > 0) {
                             $analista_Select.append(
                             function () {
                                var options = '';
                           
                                // options += '<option value="-1" disabled  selected>Seleccionar..</option>';
                            
                                $.each(data, function (key, analista) {                                                                                                      
                                          options += '<option value="'+analista.usu_id+'">'+analista.nombre+'</option>';  
                                          
                                          if(ana_id===analista.usu_id){
                                            options += '<option selected value="'+analista.usu_id+'">'+analista.nombre+'</option>';  
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
          let url_detalle_analista_asignado ="<?php echo $this->url->get('estudio/ajax_get_detalles_analista_asignado/') ?>";

          $.ajax({
              type: "POST",
              url: url_detalle_analista_asignado+id_ESE,
              success: function(data)
              {

                if(data[0].ese_estatus=='-2' ){
                          Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                          .then((value) => {
                            location.reload();
                      
                          });
                      }  
                $('#previo_ana_asignado_re_asignar_analista_en_trafico').val(data['data'][0].analista);
                $('#fecha_asignado_re_asignar_analista_en_trafico').val(data['data'][0].ese_fechaasiganalista);

                 

              },
              error: function(res)
              {
                  // $("#btn_aprobar").prop("disabled", false);
              }
          });
    }


  </script>
  
  <div class="modal fade" id="re_asignar_analista_en_trafico-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="titulotraficoanalista_re_asignar_analista_en_trafico">

             <span id="titulo_ese_id_re_asignar_analista_en_trafico"> </span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_re_asignar_analista_estudio_en_trafico_investigador" class="form-vertical mt-1">
          
              <div class="row  ml-3">
                <div class="col-12 col-lg-6">
                  <label class="col-form-label title-busq">Analista</label>
                  <input  disabled id="previo_ana_asignado_re_asignar_analista_en_trafico" name="" type="text" class="form-control input-rounded-disabled" placeholder="Nombre analsta..." oninput="handleInput(event)" maxlength="150"/>
  
                </div>
                <div class="col-12 col-lg-4">
                  <label class="col-form-label title-busq">Fecha de asignación</label>
                  <input  disabled id="fecha_asignado_re_asignar_analista_en_trafico" name="" type="text" class="form-control input-rounded-disabled" placeholder="Fecha..." oninput="handleInput(event)" maxlength="150"/>
  
                </div>
              </div>
    
            

              <div class="col-lg-10">
                <input type="hidden" id="ese_id_re_asignar_analista_en_trafico" name="ese_id" value="" >
                <div class="row ml-3">
                  <label class="col-form-label title-busq">Analista</label>
                  <select name="ana_id" id="ana_id_re_asignar_analista_en_trafico" class="form-control select2-single" data-toggle="select2" data-placeholder="Seleccionar ..." required>
                    <optgroup>
                    <option   value="1" >Seleccionar</option>
                    </optgroup>
                  </select>
                </div>
                <div class="row ml-3">
                  <label class="col-form-label title-busq" id="">Agregue un comentario </label>
                  <label class="col-form-label title-busq" id="label_com_comentario_re_asignar_analista_en_trafico"></label>
                  <textarea placeholder="Agrega tu comentario..." id="com_comentario_re_asignar_analista_en_trafico" name="com_comentario" class="form-control-textarea text_area_a"   minlength="4" onkeyup="actualizaInfo(300,'com_comentario_asignar_analista_en_trafico', 'label_com_comentario_asignar_analista_en_trafico')" oninput="handleInput(event)"></textarea>
                </div>
              </div>
              
              <div class="row col-lg-12">
                <div class="col-sm-2 col-md-2 text-center mt-5">
                </div>
                <div class="col-sm-4 col-md-4 text-center mt-5" >
                  <div class="form-group" id="container-des-asignar-analista" style="display: none;">
                    <a class="btn-dark btn-rounded btn btn-limpiar bg-warning"
                      onclick="fnDesAsignarAnalistaEnTrafico();"
                      style="                 
                       border: 2px solid rgb(32 51 78 / 7%);
                      "
                    ><i class=" mdi mdi-account-alert white"></i> Desasignar  analista </a>
                  </div>
                </div>
                <div class="col-sm-3 col-md-3 text-center mt-5">
                    <div class="form-group">
                      <a class="btn-dark btn-rounded btn btn-limpiar" data-dismiss="modal"><i class=" mdi mdi-close white"></i>  Cancelar </a>
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