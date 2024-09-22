{{ javascript_include('js/seguridad/sha256.js') }}
{{ javascript_include('js/seguridad/usuario.js') }}

<script type="text/javascript">
	function fnEditarAES(ese_id){

    $('#aes_correo-editar').val('');
    $('#aes_contrasenia-editar').val('');


		let url="<?php echo $this->url->get('autoestudio/ajax_detalle/') ?>";
		
        
            $.ajax(
            {
                type: "POST",
                    url: url+ese_id,
                    success: function(res)
                    {
                      if(res[0]=='2'){
                        let data=res.data;
                        $('#aes_correo-editar').val(data.aes_correo);
                        $('#aes_id-editar').val(data.aes_id);


                      }


                     
                        

                    }
            }).done(function(){
                


             

              url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

             $.ajax({
                  type: "POST",
                  url: url_enviar_ese_data+ese_id,
                  success: function(res)
                  {

                    if(res.length>0){
                      let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                      //$("#editarsupervivenciatext").html(`<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar supervivencia: ${id} ${mensaje_empresa_candidato}`);
                      $("#editar_autoestudio-titulo").html(`<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar autoestudio : ${ese_id} ${mensaje_empresa_candidato} `);


                      /*let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;
                      $("#msae_archivo").html("Archivos de estudio: "+id_ese+mensaje_empresa_candidato);
                      */
                    }
                    //alert();
                  
                  },
                  error: function(data)
                  {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                    
                }
						});
                                
                    
            });

    }


    $(function (){
    $("#form_editar_aes").submit(function(event) 
    {
      event.preventDefault();


      let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/;
		
			let p1=$("#aes_contrasenia-editar").val();
			let p2=$("#aes_contrasenia_confirmar-editar").val();

			let valido= regex.test(p1);
			let valido2= regex.test(p2);
			if(valido==false || valido2==false){
        Swal.fire({title:'Aviso',text:'La nueva contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@,*,_,# por ejemplo)',type:"warning"})
                      .then((value) => {

                      });

        return false;
      }
      // Hola1####

   
      let no_incripada_password_1=$('#aes_contrasenia-editar').val();
      let no_incripada_password_2=$('#aes_contrasenia_confirmar-editar').val();
  
      let encriptda_1=SHA256($('#aes_contrasenia-editar').val());
      $('#aes_contrasenia-editar').val(encriptda_1)
      let encriptda_2=SHA256($('#aes_contrasenia_confirmar-editar').val());
      $('#aes_contrasenia_confirmar-editar').val(encriptda_2)


      let $form = $(this);
      let urled="<?php echo $this->url->get('autoestudio/actualizar/') ?>";
      let aes_id = $('#aes_id-editar').val();
    //  $form.find("button").prop("disabled", true);

        $.ajax({
          type: "POST",
          url: urled+aes_id,
          data: $("#form_editar_aes").serialize(),
          success: function(res)
          {

            if(res['estado']=='2')
            {

     
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                      .then((value) => {
                        location.reload();  

                      });
            }
            if(res['estado']=='-1')
            {
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
                      .then((value) => {
                        $form.find("button").prop("disabled", false);

                        $('#aes_contrasenia-editar').val(no_incripada_password_1);
                        $('#aes_contrasenia_confirmar-editar').val(no_incripada_password_2);

                      });

            }
            if(res['estado']=='-2')
            {
                
              Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                        .then((value) => {
                          location.reload();  

                        });
            }
            


          },
          error: function(res)
          { 
           /* Swal.fire({title:'Error',text:'Error al procesar la info. #'+res.responseText,type:"error"})
                          .then((value) => {
                             location.reload();  

                          });*/

          }
        });       
      // }
      // else
      // {
      //   alertify.alert('Error','Para poder cancelar un ESE en necesario que ingrese un comentario con un minimo de 5 caracteres.');
      // }
    });
  });

  	


	
</script>


<div class="modal fade" id="editar_autoestudio-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="" id="exampleModalLabel">
            <div id="editar_autoestudio-titulo"></div></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_editar_aes" class="form-vertical mt-1">
            <div class=" row">
              <div class="col-lg-12">
                <input id="aes_id-editar" name="aes_id" hidden/>

                <label class="col-form-label title-busq">Correo electronico</label>
                <input id="aes_correo-editar" name="aes_correo" type="email" class="form-control input-rounded" oninput="convertirMinusculasSinEspacios(event.target)" autocomplete="off"  required placeholder="Correo electronico" maxlength="155"/>
              </div>
            </div>

            <div class=" row">
              <div class="col-lg-12">
                <label class="col-form-label title-busq">Nueva contraseña</label>
                <input id="aes_contrasenia-editar" name="aes_contrasenia" autocomplete="off" minlength="8" required type="password" class="form-control input-rounded" placeholder="Nueva contraseña..."  maxlength="155"/>
              </div>
            </div>

            <div class=" row">
              <div class="col-lg-12">
                <label class="col-form-label title-busq">Confirmar nueva contraseña</label>
                <input id="aes_contrasenia_confirmar-editar" name="aes_contrasenia_confirmar"  minlength="8" required autocomplete="off" type="password" class="form-control input-rounded" placeholder="Nueva contraseña..."  maxlength="155"/>
              </div>
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
                    <button class="btn-dark btn-rounded btn btn-buscar">Actualizar <i class="mdi mdi-update white"></i> </button>
                  </div>
              </div>
            </div>
            </div>
          </form>      
        </div>
      </div>
    </div>
  </div>