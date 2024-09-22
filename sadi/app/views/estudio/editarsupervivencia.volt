<script type="text/javascript">
	function fnOcultarMostrarInputsEmpresaEditarEseSup(eventValue,classToCleanOrShow="inputs-empresa-reculta-edit-ese-sup") {
				let selectedValue = eventValue;
				let empresasRecluta =__ESE_EMPRESA_IDS_RECLUTA_FORMATO_;
				if (selectedValue == null || selectedValue == "-1" || selectedValue.trim() == "") {
					selectedValue = "0"; 
				} else {
					selectedValue = selectedValue;
				}
				let elementos = document.querySelectorAll('.' + classToCleanOrShow);
				if (empresasRecluta.includes(selectedValue)) {
					elementos.forEach(function(elemento) {
						elemento.style.display = 'block';

						let inputs = elemento.getElementsByTagName('input');
						for (var i = 0; i < inputs.length; i++) {
							inputs[i].value = '';
							inputs[i].required = false;
						}
					});
				} else {
					elementos.forEach(function(elemento) {
						elemento.style.display = 'none';

						let inputs = elemento.getElementsByTagName('input');
						for (var i = 0; i < inputs.length; i++) {
							inputs[i].value = '';
							inputs[i].required = false;
						}
					});
				}
    }
	function fneditarestudiosupervivencia(id){
		var empresa="<?php echo $this->url->get('empresa/ajax_empresas_con_formato/') ?>";
		var $subs = $('select[name="emp_ideditarsup"]');
	    var urlfneditsup="<?php echo $this->url->get('estudio/detalleseditarsupervivencia/') ?>";
	    $.ajax(
	    {
	    	type: "POST",
				url: urlfneditsup+id,
				success: function(res)
				{
					if(res[0]<=0)
					{
						$('#editarestudiosupervivencia-modal').modal('hide');
						Swal.fire({title:'Error',text:res[1],type:"error"})
            			.then((value) => {
							});
					}
					else
					{
						if(res[1].tip_id==4){
							$("#ese_ideditarsup").val(res[1].ese_id);
							$("#ese_nombreeditarsup").val(res[1].ese_nombre);
							$("#ese_primerapellidoeditarsup").val(res[1].ese_primerapellido);
							$("#ese_segundoapellidoeditarsup").val(res[1].ese_segundoapellido);
							$("#ese_folioverificacioneditarsup").val(res[1].ese_folioverificacion);
							let empresasRecluta =__ESE_EMPRESA_IDS_RECLUTA_FORMATO_;
							if (empresasRecluta.includes(res[1].emp_id)) {
								$("#ese_empresarecluta-editarsup").val(validarValorFormatoLimpio(res[1].ese_empresarecluta));
								$(".inputs-empresa-reculta-edit-ese-sup").show();
							}else{
								$(".inputs-empresa-reculta-edit-ese-sup").hide();

							}
							//$("#ese_centrocostoeditarsup").val(res[1].ese_centrocosto);
							tif_id=res[1].tif_id;

							emp_ideditarsup=res[1].emp_id;
							cen_ideditarsup=res[1].cen_id;
							if(typeof cen_ideditarsup === 'undefined' || cen_ideditarsup===null) {
								fnCentroCostoGetsup(emp_ideditarsup,0);
							}else{
								fnCentroCostoGetsup(emp_ideditarsup,cen_ideditarsup);

							}
							cne_ideditarsup=res[1].cne_id;
							tip_ideditarsup=res[1].ese_tippersona;
							est_ideditarsup=res[1].est_id;
							mun_ideditarsup=res[1].mun_id;
							fncontactoempsup(emp_ideditarsup, cne_ideditarsup);
							fntipopersonasup(tip_ideditarsup);
							fnestadossup(est_ideditarsup);
							// fnmunicipiossup(est_ideditarsup, mun_ideditarsup);
							fnmunicipios_adaptable($('#mun_ideditarsup'),est_ideditarsup,mun_ideditarsup);

						}else{
							$('#editarestudiosupervivencia-modal').modal('hide');
						}
					}
				}
	    }).done(function(){
			url_enviar_ese_data="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_empresa_especifico/') ?>";

						$.ajax({
								type: "POST",
								url: url_enviar_ese_data+id,
								success: function(res)
								{

									if(res.length>0){
										let mensaje_empresa_candidato =` - <span class="text-warning"> ${res[0].ese_nombre} </span> - <span class="text-warning"> ${res[0].emp_alias}</span> `;

										$("#editarsupervivenciatext").html(`<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar supervivencia: ${id} ${mensaje_empresa_candidato}`);


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


				$.ajax({
					type: "POST",
					url: empresa+tif_id+"/"+emp_ideditarsup,
					success: function(res)
					{
						// console.log(res);
						let data=res['data'];
						$subs.empty();
						if (data.length > 0) {
							$subs.append(function () {
							var options = '';
							$.each(data, function (key, emp) {
								if(emp.emp_id==emp_ideditarsup){
								options += '<option selected value="' + emp.emp_id + '">' +emp.emp_nombre +'</option>';
								}
								else
								options += '<option value="' + emp.emp_id + '">' +emp.emp_nombre + '</option>';
							});
							return options;
							});
						}
					},
					error: function(res)
					{
					}
				});  
		}) ;

				
	}

  	function fncontactoempsup(empresa, pre){//recibe id de empresa y el centro de costo 
    	var ruta="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>";
    	var $subs = $('select[name="cne_ideditarsup"]');
    	$.ajax({
      		type: "POST",
      		url: ruta+empresa,
      		success: function(data)
      		{
        		$subs.empty();
        		if (data.length > 0) {
          			$subs.append(function () {
            			var options = '';
            			if(pre==0){
              				options += '<option selected value="-1">Seleccionar...</option>';
            			}
				        $.each(data, function (key, cne) {
				            if(cne.cne_id==pre){
				              options += '<option selected value="' + cne.cne_id + '">' +cne.cne_nombre + " " + cne.cne_primerapellido + " " + cne.cne_segundoapellido + '</option>';
				            }
				            else
				              options += '<option value="' + cne.cne_id + '">' + cne.cne_nombre + " " +cne.cne_primerapellido +" "+ cne.cne_segundoapellido+ '</option>';
				        });
            			return options;
          			});
        		}
				else{
					$subs.append(function () {
						var options = '';
						options += '<option selected value="-1">No aplica</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
			}
    	});
  	}
	
	  function fnCentroCostoGetsup(empresasel, pre){//recibe id de empresa y el centro de costo 
    	var ruta="<?php echo $this->url->get('centrocosto/ajax_centros/') ?>";
    	var $subs = $('select[name="ese_centrocostoeditarsup"]');
    	$.ajax({
      		type: "POST",
      		url: ruta+empresasel,
      		success: function(data)
      		{
        		$subs.empty();
        		if (data.length > 0) {
          			$subs.append(function () {
            			var options = '';
            			if(pre==0){
              				options += '<option selected value="-1">Seleccionar...</option>';
            			}
				        $.each(data, function (key, cen) {
						
				            if(cen.cen_id==pre){
				              options += '<option selected value="' + cen.cen_id + '">' +cen.cen_nombre + '</option>';
				            }
				            else
				              options += '<option value="' + cen.cen_id + '">' + cen.cen_nombre+ '</option>';
				        });
            			return options;
          			});
        		}
				else{
					$subs.append(function () {
						var options = '';
						options += '<option selected value="-2">No aplica</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
			}
    	});
  	}


  	function fntipopersonasup(pre){
	    
	    var $subs = $('select[name="tip_personaeditarsup"]');
	    $subs.empty();
	    $subs.append(function () {
			var options = '';

			if(pre==1){
				options += '<option selected value="1">Física</option>';
				options += '<option value="2">Moral</option>';
			}else{
				options += '<option value="1">Física</option>';
				options += '<option selected value="2">Moral</option>';
			}
			fnselecttipopersonasup(pre);
			return options;
	    });
	}

	function fnselecttipopersonasup(tipo=0){
	    if(tipo==0){
	    	var tipopersona = $("#tip_personaeditarsup").val();
	    }
	    else{
	    	var tipopersona = tipo;
	    }
	    
	    if(tipopersona==1){
			document.getElementById('fisica1sup').style.display = 'block';
			document.getElementById('fisica2sup').style.display = 'block';
			var ese_primerapellido = document.getElementById("ese_primerapellidoeditarsup");
			ese_primerapellido.setAttribute('required','required');
	    }else{
			document.getElementById('fisica1sup').style.display = 'none';
			document.getElementById('fisica2sup').style.display = 'none';
			var ese_primerapellido = document.getElementById("ese_primerapellidoeditarsup");
			ese_primerapellido.removeAttribute('required');
	    }
	}

	function fnestadossup(pre){
	    var ruta="<?php echo $this->url->get('estado/ajax_estados/') ?>";
	    var $subs = $('select[name="est_ideditarsup"]');
	    $.ajax({
			type: "POST",
			url: ruta,
			success: function(data)
			{
				$subs.empty();
				if (data.length > 0) {
					$subs.append(function () {
				    	var options = '';
				    	if(pre==0){
				      		options += '<option selected value="-1">Seleccionar...</option>';
				    	}
				    	$.each(data, function (key, est) {
				        	if(est.est_id==pre){
				          		options += '<option selected value="' + est.est_id + '">' + est.est_nombre + '</option>';
				        	}
				        	else
				          		options += '<option value="' + est.est_id + '">' + est.est_nombre + '</option>';
				    	});
				    	return options;
				  	});
				}
				else{
					$subs.append(function () {
						var options = '';
						options += '<option selected value="-1">No aplica</option>';
						return options;
					});
				}
			},
			error: function(res)
			{
			}
	    });
	}

  	function fnmunicipiossup(estado, pre){//recibe id de empresa y el centro de costo 
	    var ruta="<?php echo $this->url->get('municipio/ajax_municipios/') ?>";
	    var $subs = $('select[name="mun_ideditarsup"]');
	    $.ajax({
			type: "POST",
			url: ruta+estado,
			success: function(data)
			{
		        $subs.empty();
		        if (data.length > 0) {
		        	$subs.append(function () {
		        		var options = '';
		            	if(pre==0){
		            		options += '<option selected value="-1">Seleccionar...</option>';
		            	}
		            	$.each(data, function (key, mun) {
		                	if(mun.mun_id==pre){
		                  		options += '<option selected value="' + mun.mun_id + '">' +mun.mun_nombre + '</option>';
		                	}
		                	else
		                  		options += '<option value="' + mun.mun_id + '">' + mun.mun_nombre + '</option>';
		            	});
		            	return options;
		          	});
		        }
		        else{
					$subs.append(function () {
						var options = '';
						options += '<option selected value="-1">No aplica</option>';
						return options;
					});
		        }
			},
      		error: function(res)
			{
			}
    	});
  	}

  	function fnchangeempresasup(){
	    var empresaselect = $("#emp_ideditarsup").val();
	    fncontactoempsup(empresaselect, 0);
		fnCentroCostoGetsup(empresaselect,0);
	}

	function fnchangeestadosup(){
		var estadoselect = $("#est_ideditarsup").val();
		// fnmunicipiossup(estadoselect, 0);
		fnmunicipios_adaptable($('#mun_ideditarsup'),estadoselect,0);

	}

	$(function (){
		$("#frm_editarsupervivencia").submit(function(event) 
      	{
	        if($("#cne_ideditarsup").val()==-1){
						Swal.fire({title:'Faltan datos',text:"Debe seleccionar quien solicita.",type:"warning"})
		          .then((value) => {
							});
						return false;
	        }
			if($("#ese_centrocostoeditarsup").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el centro de costo.", type:"warning"})
				return false;
	        }
			
	     
	        var $form = $(this);
	        var urleditarsup="<?php echo $this->url->get('estudio/editarsupervivencia/') ?>";
	        a=$form.valid();
	        if(a==false){
	            return false;
	        }
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urleditarsup,
				data: $("#frm_editarsupervivencia").serialize(),
				success: function(res)
				{
					if(res[0]<=0)
					{
					  Swal.fire({title:'Error',text:res[1],type:"error"})
                                                                  .then((value) => {

                                                                      });
					  
					}
					else
					{
					
					  Swal.fire({title:"Éxito",text:"Estudio editado correctamente.",type:"success"})
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


<div class="modal fade" id="editarestudiosupervivencia-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="editarsupervivenciatext">Detalles Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarsupervivencia" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="ese_ideditarsup" name="ese_ideditarsup" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Empresa</label>
              <select onchange="fnchangeempresasup();fnOcultarMostrarInputsEmpresaEditarEseSup(event.target.value);" name="emp_ideditarsup" id="emp_ideditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
			<div class="col-lg-4 inputs-empresa-reculta-edit-ese-sup "  style="display:none ;" >
				<label class="col-form-label title-busq">Empresa recluta</label>
				<input id="ese_empresarecluta-editarsup" name="ese_empresarecluta" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Empresa recluta"  oninput="handleInput(event)" maxlength="50"/>

			</div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Solicita</label>
              <select name="cne_ideditarsup" id="cne_ideditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Centro de costo</label>
			  <select name="ese_centrocostoeditarsup" id="ese_centrocostoeditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >No aplica</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Persona Física/Moral</label>
              <select onchange="fnselecttipopersonasup();" name="tip_personaeditarsup" id="tip_personaeditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre(s)</label>
              <input id="ese_nombreeditarsup" name="ese_nombreeditarsup" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre(s)" required oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica1sup" style="display: none;">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="ese_primerapellidoeditarsup" name="ese_primerapellidoeditarsup" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica2sup" style="display: none;">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="ese_segundoapellidoeditarsup" name="ese_segundoapellidoeditarsup" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Estado</label>
              <select onchange="fnchangeestadosup();" name="est_ideditarsup" id="est_ideditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Municipio</label>
              <select name="mun_ideditarsup" id="mun_ideditarsup" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Número de control</label>
              <input id="ese_folioverificacioneditarsup" name="ese_folioverificacioneditarsup" type="text" class="form-control input-rounded " placeholder="Número de control" oninput="handleInput(event)" maxlength="45"/>
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
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar <i class="mdi mdi-pencil-outline btn-icon" style="color:white ;"></i></button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>