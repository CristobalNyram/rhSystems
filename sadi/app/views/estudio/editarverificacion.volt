<script type="text/javascript">
  $(function (){
      $("#frm_editarverificacion").submit(function(event) 
      {
        if($("#cne_ideditarver").val()==-1){
          Swal.fire({title:"Faltan datos",text:"Debe seleccionar quien solicita.", type:"warning"})
          return false;
        }
        if($("#ese_centrocostoeditarver").val()==-1){
				Swal.fire({title:"Faltan datos",text:"Debe seleccionar el centro de costo.", type:"warning"})
				return false;
	        }
        var $form = $(this);
        var urleditarver="<?php echo $this->url->get('estudio/editarverificacion/') ?>";
        a=$form.valid();
        if(a==false){
            return false;
        }
        $form.find("button").prop("disabled", true);
        $.ajax({
          type: "POST",
          url: urleditarver,
          data: $("#frm_editarverificacion").serialize(),
          success: function(res)
          {
            if(res[0]<=0)
            {
              Swal.fire({title:"Error",text:res[1],type:"error"})
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
  
  	function fnOcultarMostrarInputsEmpresaEditarEseVer(eventValue,classToCleanOrShow="inputs-empresa-reculta-edit-ese-ver") {
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
  function fnchangeempresa(){
    var empresaselect = $("#emp_ideditarver").val();
    fncontactoemp(empresaselect, 0);
    fnCentroCostoGetver(empresaselect,0);
  }
  function fnchangeempresaonlycentrodecosto(emp_id){
  
    fnCentroCostoGetver(emp_id,0);
  }

  function fnchangeestado(){
    var estadoselect = $("#est_ideditarver").val();
    // fnmunicipios(estadoselect, 0);
    fnmunicipios_adaptable($('#mun_ideditarver'),estadoselect,0);

  }

  function fneditarverificacion(id){
		var empresa="<?php echo $this->url->get('empresa/ajax_empresas_con_formato/') ?>";
		var $subs = $('select[name="emp_ideditarver"]');
    
    var urlfnedit="<?php echo $this->url->get('estudio/detalleseditarverificacion/') ?>";
    $.ajax(
    {
      type: "POST",
      url: urlfnedit+id,
      success: function(res)
      {
        if(res[0]<=0)
        {
          $('#detallesver-modal').modal('hide');

            Swal.fire({title:"Error",text:res[1],type:"error"})
                .then((value) => {

                  });
        }
        else
        {
          if(res[1].tip_id==2){
            $("#ese_ideditarver").val(res[1].ese_id);
            $("#ese_nombreeditarver").val(res[1].ese_nombre);
            $("#ese_primerapellidoeditarver").val(res[1].ese_primerapellido);
            $("#ese_segundoapellidoeditarver").val(res[1].ese_segundoapellido);
            $("#ese_folioverificacioneditarver").val(res[1].ese_folioverificacion);
            //$("#ese_centrocostoeditarver").val(res[1].ese_centrocosto);
            emp_ideditarver=res[1].emp_id;
            cne_ideditarver=res[1].cne_id;
            ver_ideditarver=res[1].ver_id;
            tip_ideditarver=res[1].ese_tippersona;
            est_ideditarver=res[1].est_id;
            mun_ideditarver=res[1].mun_id;
            cen_ideditarver=res[1].cen_id;

            let empresasRecluta =__ESE_EMPRESA_IDS_RECLUTA_FORMATO_;
							if (empresasRecluta.includes(res[1].emp_id)) {
								$("#ese_empresarecluta-editarver").val(validarValorFormatoLimpio(res[1].ese_empresarecluta));
								$(".inputs-empresa-reculta-edit-ese-ver").show();
							}else{
								$(".inputs-empresa-reculta-edit-ese-ver").hide();

							}
							// if(typeof cen_ideditarver === 'undefined') {
							// 	fnCentroCostoGetver(emp_ideditarver,0);
                
							// }
              // if(cen_ideditarver==null){
							// 	fnCentroCostoGetver(emp_ideditarver,0);

              // }else{
							// 	fnCentroCostoGetver(emp_ideditarver,cen_ideditarver);
              //   alert();
							// }

               tif_id=res[1].tif_id;
              if(cen_ideditarver!=null){
                fnCentroCostoGetver(emp_ideditarver,cen_ideditarver);
              }else{
                fnchangeempresaonlycentrodecosto(emp_ideditarver);

              }
            fncontactoemp(emp_ideditarver, cne_ideditarver);
            fnverificaciones(ver_ideditarver);
            fntipopersona(tip_ideditarver);
            fnestados(est_ideditarver);
            // fnmunicipios(est_ideditarver, mun_ideditarver);
            // fnselecttipopersona(tip_ideditarver);
            fnmunicipios_adaptable($('#mun_ideditarver'),est_ideditarver,mun_ideditarver);

          }else{
            $('#detallesver-modal').modal('hide');
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
                    $("#editarverificaciontext").html( `<i class="mdi mdi-pencil-outline mdi-18px btn-icon"></i> Editar verificacion: ${id} ${mensaje_empresa_candidato}` );


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
              url: empresa+tif_id+"/"+emp_ideditarver,
              success: function(res)
              {
                let data=res['data'];
                // console.log(data);
                $subs.empty();
                if (data.length > 0) {
                  $subs.append(function () {
                    var options = '';
                    $.each(data, function (key, emp) {
                        if(emp.emp_id==emp_ideditarver){
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
		
    


    });



  }

  function fnCentroCostoGetver(empresasel, pre){//recibe id de empresa y el centro de costo 
    	var ruta="<?php echo $this->url->get('centrocosto/ajax_centros/') ?>";
    	var $subs = $('select[name="ese_centrocostoeditarver"]');
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


  function fncontactoemp(empresa, pre){//recibe id de empresa y el centro de costo 
    var ruta="<?php echo $this->url->get('contactoemp/ajax_contactos/') ?>";
    var $subs = $('select[name="cne_ideditarver"]');
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

  function fnverificaciones(pre){ 
    var ruta="<?php echo $this->url->get('verificaciones/ajax_verificaciones/') ?>";
    var $subs = $('select[name="ver_ideditarver"]');
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
            $.each(data, function (key, ver) {
                if(ver.ver_id==pre){
                  options += '<option selected value="' + ver.ver_id + '">(' + ver.ver_alias+ ") " + ver.ver_nombre + '</option>';
                }
                else
                  options += '<option value="' + ver.ver_id + '">(' + ver.ver_alias+ ") " + ver.ver_nombre + '</option>';
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

  function fnestados(pre){
    var ruta="<?php echo $this->url->get('estado/ajax_estados/') ?>";
    var $subs = $('select[name="est_ideditarver"]');
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

  function fnmunicipios(estado, pre){//recibe id de empresa y el centro de costo 
    var ruta="<?php echo $this->url->get('municipio/ajax_municipios/') ?>";
    var $subs = $('select[name="mun_ideditarver"]');
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

  function fntipopersona(pre){
    // var ruta="<?php echo $this->url->get('verificaciones/ajax_verificaciones/') ?>";
    var $subs = $('select[name="tip_personaeditarver"]');
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
      fnselecttipopersona(pre);
      return options;
    });
        
      
    
  }

  function fnselecttipopersona(tipo=0){
    if(tipo==0){
      var tipopersona = $("#tip_personaeditarver").val();
    }
    else{
      var tipopersona = tipo;
    }
    
    if(tipopersona==1){
      document.getElementById('fisica1').style.display = 'block';
      document.getElementById('fisica2').style.display = 'block';
      var ese_primerapellido = document.getElementById("ese_primerapellidoeditarver");
      ese_primerapellido.setAttribute('required','required');
    }else{
      document.getElementById('fisica1').style.display = 'none';
      document.getElementById('fisica2').style.display = 'none';
      var ese_primerapellido = document.getElementById("ese_primerapellidoeditarver");
      ese_primerapellido.removeAttribute('required');
    }
  }

</script>

<div class="modal fade" id="editarver-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="" id="editarverificaciontext">Detalles Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frm_editarverificacion" class="form-vertical mt-1">
          <div class="form-group row">
            <input type="hidden" id="ese_ideditarver" name="ese_ideditarver" />
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Empresa</label>
              <select onchange="fnchangeempresa(); fnOcultarMostrarInputsEmpresaEditarEseVer(event.target.value);" name="emp_ideditarver" id="emp_ideditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4 inputs-empresa-reculta-edit-ese-ver "  style="display:none ;" >
              <label class="col-form-label title-busq">Empresa recluta</label>
              <input id="ese_empresarecluta-editarver" name="ese_empresarecluta" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Empresa recluta"  oninput="handleInput(event)" maxlength="50"/>
      
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Solicita</label>
              <select name="cne_ideditarver" id="cne_ideditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Centro de costo</label>
              <select name="ese_centrocostoeditarver" id="ese_centrocostoeditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >No aplica</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Tipo de verificación</label>
              <select name="ver_ideditarver" id="ver_ideditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Persona Física/Moral</label>
              <select onchange="fnselecttipopersona();" name="tip_personaeditarver" id="tip_personaeditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Nombre(s)</label>
              <input id="ese_nombreeditarver" name="ese_nombreeditarver" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Nombre(s)" oninput="handleInput(event)" required maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica1" style="display: none;">
              <label class="col-form-label title-busq">Primer apellido</label>
              <input id="ese_primerapellidoeditarver" name="ese_primerapellidoeditarver" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Primer apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4" id="fisica2" style="display: none;">
              <label class="col-form-label title-busq">Segundo apellido</label>
              <input id="ese_segundoapellidoeditarver" name="ese_segundoapellidoeditarver" type="text" class="form-control input-rounded data-not-lt-active" placeholder="Segundo apellido" oninput="handleInput(event)" maxlength="150"/>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Estado</label>
              <select onchange="fnchangeestado();" name="est_ideditarver" id="est_ideditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Municipio</label>
              <select name="mun_ideditarver" id="mun_ideditarver" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <option   value="-1" >Reintentar</option>
              </select>
            </div>
            <div class="col-lg-4">
              <label class="col-form-label title-busq">Folio de verificación</label>
              <input id="ese_folioverificacioneditarver" name="ese_folioverificacioneditarver" type="text" class="form-control input-rounded" placeholder="Folio de verificacion" oninput="handleInput(event)" maxlength="45"/>
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
                    <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Editar<i class="mdi mdi-pencil-outline  btn-icon"  style="color:white ;"></i></button>
                  </div>
              </div>
            </div>
          </div>
        </form>      
      </div>
    </div>
  </div>
</div>

