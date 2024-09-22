<script type="text/javascript">
	function fneditarestudiosocioeconomico(id){
		// var empresa="<?php echo $this->url->get('empresa/ajax_empresas/') ?>";
		// var $subs = $('select[name="emp_ideditarese"]');
	  var urlfnediteses="<?php echo $this->url->get('estudio/detalleseditarsocioeconomico/') ?>";
	  // var emp_ideditarese='';
    $.ajax(
    {
    	type: "POST",
			url: urlfnediteses+id,
			success: function(res)
			{
				if(res[0]<=0)
			{
				$('#editarestudiosocioeconomico-modal').modal('hide');
				Swal.fire({title:'Error',text:res[1],type:"error"})
        			.then((value) => {
        				  location.reload();  
					 });
			}
			else
			{
				if(res[1].tip_id==1 || res[1].tip_id==3 || res[1].tip_id==5){
					$("#ese_ideditarese").val(res[1].ese_id);
					$("#ese_nombreeditarese").val(res[1].ese_nombre);
					$("#ese_primerapellidoeditarese").val(res[1].ese_primerapellido);
					$("#ese_segundoapellidoeditarese").val(res[1].ese_segundoapellido);

					//empresa formato campo extra fin 
					let empresasRecluta =__ESE_EMPRESA_IDS_RECLUTA_FORMATO_;
					if (empresasRecluta.includes(res[1].emp_id)) {
						$("#ese_empresarecluta-editarese").val(validarValorFormatoLimpio(res[1].ese_empresarecluta));
						$(".inputs-empresa-reculta-edit-ese-origi").show();
					}else{
						$(".inputs-empresa-reculta-edit-ese-origi").hide();

					}
					//empresa formato campo extra fin 


					//$("#ese_centrocostoeditarese").val(res[1].ese_centrocosto);
					cen_ideditarese=res[1].cen_id;
					emp_ideditarese=res[1].emp_id;
					cne_ideditarese=res[1].cne_id;
					tip_ideditarese=res[1].ese_tippersona;
					est_ideditarese=res[1].est_id;
					mun_ideditarese=res[1].mun_id;

					fnempresasese(emp_ideditarese,res[1].tif_id);
					
					fncontactoempese(emp_ideditarese, cne_ideditarese);
					if(typeof cen_ideditarese === 'undefined' || cen_ideditarese===null) {
						fnCentroCostoGetese(emp_ideditarese,0);

					}else{
						fnCentroCostoGetese(emp_ideditarese,cen_ideditarese);

					}
					
					fntipopersonaese(tip_ideditarese);
					fnestadosese(est_ideditarese);
					// fnmunicipiosese(est_ideditarese, mun_ideditarese);
					// fnestados_estados_adaptable(id_cargado_estado,$('#est_id_nombre_ver_completo'));
                    fnmunicipios_adaptable($('#mun_ideditarese'),est_ideditarese,mun_ideditarese);

				}else{
					$('#editarestudiosocioeconomico-modal').modal('hide');
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

									//$("#editarsupervivenciatext").html(`<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar supervivencia: ${id} ${mensaje_empresa_candidato}`);
									$("#editarsocioeconomicotext").html(`<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar socioeconómico: ${id} ${mensaje_empresa_candidato} `);


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
	function fnOcultarMostrarInputsEmpresaEditarEseOriginal(eventValue,classToCleanOrShow="inputs-empresa-reculta-edit-ese-origi") {
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


	function fnempresasese(pre,tif_id){//recibe id de empresa y el centro de costo
  	var ruta="<?php echo $this->url->get('empresa/ajax_empresas_con_formato/') ?>";
  	var $subs = $('select[name="emp_ideditarese"]');

  	$.ajax({
  		type: "POST",
  		url: ruta+tif_id+"/"+pre,
  		success: function(res)
  		{
			let data=res['data'];
			$subs.empty();
    		if (data.length > 0) {
      			$subs.append(function () {
        			var options = '';
        			if(pre==0){
          				options += '<option selected value="-1">Seleccionar...</option>';
        			}
					$.each(data, function (key, emp) {
						if(emp.emp_id==pre){
						options += '<option selected value="' + emp.emp_id + '">' +emp.emp_nombre +'</option>';
						}
						else{
						options += '<option value="' + emp.emp_id + '">' + emp.emp_nombre + '</option>';
						}
						
					});
        			return options;
      			});
    		}else{
					$subs.append(function () {
						var options = '';
						options += '<option selected value="-1">No aplica</option>';
						return options;
					});
			}
			},
			error: function(res)
			{
				console.error(res.responseText);
			}
	  });

  }

  	function fncontactoempese(empresasel, pre){//recibe id de empresa y el centro de costo 
    	var ruta="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>";
    	var $subs = $('select[name="cne_ideditarese"]');
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
	
	function fnCentroCostoGetese(empresasel, pre){//recibe id de empresa y el centro de costo 
    	var ruta="<?php echo $this->url->get('centrocosto/ajax_centros/') ?>";
    	var $subs = $('select[name="ese_centrocostoeditarese"]');
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

  	function fntipopersonaese(pre){
	    
	    var $subs = $('select[name="tip_personaeditarese"]');
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
			fnselecttipopersonaese(pre);
			return options;
	    });
	}

	function fnselecttipopersonaese(tipo=0){
	    if(tipo==0){
	    	var tipopersona = $("#tip_personaeditarese").val();
	    }
	    else{
	    	var tipopersona = tipo;
	    }
	    
	    if(tipopersona==1){
			document.getElementById('fisica1ese').style.display = 'block';
			document.getElementById('fisica2ese').style.display = 'block';
			var ese_primerapellido = document.getElementById("ese_primerapellidoeditarese");
			ese_primerapellido.setAttribute('required','required');
	    }else{
			document.getElementById('fisica1ese').style.display = 'none';
			document.getElementById('fisica2ese').style.display = 'none';
			var ese_primerapellido = document.getElementById("ese_primerapellidoeditarese");
			ese_primerapellido.removeAttribute('required');
	    }
	}

	function fnestadosese(pre){
	    var ruta="<?php echo $this->url->get('estado/ajax_estados/') ?>";
	    var $subs = $('select[name="est_ideditarese"]');
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

  	function fnmunicipiosese(estado, pre){//recibe id de empresa y el centro de costo 
	    var ruta="<?php echo $this->url->get('municipio/ajax_municipios/') ?>";
	    var $subs = $('select[name="mun_ideditarese"]');
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

  function fnchangeempresaese(){
    var empresaselect = $("#emp_ideditarese").val();
    fncontactoempese(empresaselect, 0);
	fnCentroCostoGetese(empresaselect,0)
	}

	function fnchangeestadoese(){
		var estadoselect = $("#est_ideditarese").val();
		// fnmunicipiosese(estadoselect, 0);
		fnmunicipios_adaptable($('#mun_ideditarese'),estadoselect,0);

	}

	$(function (){
		$("#frm_editarsocioeconomico").submit(function(event) 
      	{
	        if($("#cne_ideditarese").val()==-1){
				Swal.fire({title:"Faltan datos",text:"Debe seleccionar quien solicita.", type:"warning"})
				return false;
	        }
			if($("#ese_centrocostoeditarese").val()==-1){
				Swal.fire({title:"Error",text:"Debe seleccionar el centro de costo.", type:"warning"})
				return false;
	        }

	        var $form = $(this);
	        var urleditarver="<?php echo $this->url->get('estudio/editarsocioeconomico/') ?>";
	        a=$form.valid();
	        if(a==false){
	            return false;
	        }
			$form.find("button").prop("disabled", true);
			$.ajax({
				type: "POST",
				url: urleditarver,
				data: $("#frm_editarsocioeconomico").serialize(),
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
				
					  Swal.fire({title:'Éxito',text:"Estudio editado correctamente.",type:"success"})
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


<div class="modal fade" id="editarestudiosocioeconomico-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="editarsocioeconomicotext">Detalles Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarsocioeconomico" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="ese_ideditarese" name="ese_ideditarese" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Empresa</label>
              <select onchange="fnchangeempresaese(); fnOcultarMostrarInputsEmpresaEditarEseOriginal(event.target.value);" name="emp_ideditarese" id="emp_ideditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
			<div class="col-lg-4 inputs-empresa-reculta-edit-ese-origi "  style="display:none ;" >
				<label class="col-form-label title-busq">Empresa recluta</label>
				<input id="ese_empresarecluta-editarese" name="ese_empresarecluta" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Empresa recluta"  oninput="handleInput(event)" maxlength="50"/>

			</div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Solicita</label>
              <select name="cne_ideditarese" id="cne_ideditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Centro de costo</label>
              
			  <select name="ese_centrocostoeditarese" id="ese_centrocostoeditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >No aplica</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Persona Física/Moral</label>
              <select onchange="fnselecttipopersonaese();" name="tip_personaeditarese" id="tip_personaeditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre(s)</label>
              <input id="ese_nombreeditarese" name="ese_nombreeditarese" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre(s)" oninput="handleInput(event)" required maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica1ese" style="display: none;">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="ese_primerapellidoeditarese" name="ese_primerapellidoeditarese" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica2ese" style="display: none;">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="ese_segundoapellidoeditarese" name="ese_segundoapellidoeditarese" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Estado</label>
              <select onchange="fnchangeestadoese();" name="est_ideditarese" id="est_ideditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Municipio</label>
              <select name="mun_ideditarese" id="mun_ideditarese" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
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
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar   <i class="mdi mdi-pencil-outline btn-icon"  style="color:white ;"></i> </button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>