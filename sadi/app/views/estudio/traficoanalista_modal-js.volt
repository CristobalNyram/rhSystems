<script type="text/javascript">
	$(function (){
    	$("#form_enviaraautorizacion").submit(function(event) 
    	{
			var $form = $(this);
			var urled="<?php echo $this->url->get('estudio/enviaraautorizacion/') ?>";
			a=$form.valid();
			if(a==false){
			  return false;
			}
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urled,
				data: $("#form_enviaraautorizacion").serialize(),
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
			

            Swal.fire({title:res['Error'],text:res['mensaje'],type:"error"})
                     .then((value) => {
                        location.reload();  
                       });  
					}
				},
				error: function(res)
				{ 
          alert('Error en el servidor');
				  $form.find("button").prop("disabled", false); 
				}
			});
      		return false;
      	});
    });
    
    function fnIdESE(id_ESE,id_ANAlISTA)
    {
        var id_ese=document.getElementById('ese_id');
        var id_analista_select=id_ANAlISTA;
        id_ese.value=id_ESE;
        
        var url="<?php echo $this->url->get('usuario/ajax_getanalista/') ?>"
  
        var $analista_Select = $('select[name="ana_id"]');    
        $analista_Select.empty();
   
        $.ajax({
            type: "POST",
            url: url,
            success: function(data)
            {
                if (data.length > 0) {
                    $analista_Select.append(
                	function () {
                    	var options = '';
						$.each(data, function (key, analista) {   
                            if(id_analista_select==analista.usu_id)
                            {
                            	options += `<option value="${analista.usu_id}"  selected >${analista.nombre}</option>`;
                            }
                            else
                            {
                              options += `<option value="${analista.usu_id}">${analista.nombre}</option>`;        
                            }
                        });
                        return options;
                    });
                }
            },
            error: function(res)
            {
                // $("#btn_aprobar").prop("disabled", false);
            }
        });
    }

    function fnenviaraautorizacionESE(id_ESE)
    {
    	var id_ese=document.getElementById('ese_idenviaraautorizacion');
      	id_ese.value=id_ESE;
        url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

						$.ajax({
								type: "POST",
								url: url_enviar_ese_data+id_ESE,
								success: function(res)
								{
                  if(res[0].ese_estatus=='-2' ){
                      Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
                  }  
                  if(res[0].ese_estatus=='5' || res[0].ese_estatus=='8'){
                      
                  }else{
                    Swal.fire({title:'CAMBIO DE ESTATUS',text:'ESTUDIO NO DISPONIBLE CAMBIO DE ESTATUS',type:"warning"})
                      .then((value) => {
                        location.reload();
                  
                      });
                  }  

                
              
									if(res.length>0){
										let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

                    $('#enviarparaautorizacion').html(`<i class="mdi mdi-send-check mdi-18px btn-icon" style="color:green;"></i> Enviar para autorización el Folio: `+id_ESE+mensaje_empresa_candidato);


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
   
      }

  
</script>

<div class="modal fade" id="enviaraautorizacion-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog detalle modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="" id="enviarparaautorizacion">Enviar para autorización</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_enviaraautorizacion" class="form-vertical mt-1">
              <div class="form-group row">
                
          
               
                <!-- <div class="col-lg-10"> -->
               
                  <input type="hidden" id="ese_idenviaraautorizacion" name="ese_idenviaraautorizacion" value="">
  
                  <div class="col-lg-12">
                      <label class="col-form-label title-busq">Agregue un comentario</label>
                      <!-- <div class="col-xs-12"> -->
                      <textarea placeholder="Agrega tu comentario..." id="com_comentarioenviaraautorizacion" name="com_comentarioenviaraautorizacion" class="form-control-textarea text_area_a" maxlength="1500"   onkeyup="actualizaInfo(1500,'com_comentarioenviaraautorizacion', 'com_comentarioenviaraautorizacion-label')" oninput="handleInput(event)"></textarea>
                      <label  id="com_comentarioenviaraautorizacion-label" for="com_comentarioenviaraautorizacion" class="col-form-label title-busq ml-2"></label>

                      <!-- </div> -->
                  </div>
    
    
    
                <!-- </div> -->
                
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