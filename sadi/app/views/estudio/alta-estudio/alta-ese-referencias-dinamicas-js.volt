<script>

	///SCRIPTS PARA REFERENCIA PERSONAL
	var contador_de_insersion_de_campos_dinamicos_de_ref_personales=0;
	  function fnCrearReferenciasPersonales_alta_estudio(){
		let form= document.getElementById('frm_crear_referencia_personal_alta_estudio_alta_estudio_formato_completo');
		form.reset();
	  }
	  $(function(){
	  $('#frm_crear_referencia_personal_alta_estudio_alta_estudio_formato_completo').submit(function(event){
  
			event.preventDefault();
  
			let $forms = $(this);
			a=$forms.valid();
			if(a==false){
			  return false;
			}
  
  
			contador_de_insersion_de_campos_dinamicos_de_ref_personales+=1;
  
			$forms.find("button").prop("disabled", true);
  
			let formulario=$("#frm_crear_referencia_personal_alta_estudio_alta_estudio_formato_completo");
  
			let datos_formulario= formulario.serialize();
			let lugar_de_insercion_html=document.getElementById('aqui_insertar_referencias_personales');
			// console.log(formulario);
  
			// // console.log()
			// console.log(lugar_de_insercion_html);
  
			let input_row_insertar=`
			<div class="container   mt-1 mb-1 mt-2 mb-1" id='row_ref_personal_no_${contador_de_insersion_de_campos_dinamicos_de_ref_personales}' style='display:none;'>
					<div class="row col-12 mt-2 border-top brder-primary" >
								<div class="row  col-12 mt-1 mb-1 justify-content-end">
									<button type="button" class="btn btn-danger" onclick="borrar_esta_row_crear_referencia(event)">Borrar referencia personal No. ${contador_de_insersion_de_campos_dinamicos_de_ref_personales}</button>
								</div>
								<div class="col-12 col-lg-1 mt-1 mb-1">
									<input  type="text" value="${contador_de_insersion_de_campos_dinamicos_de_ref_personales}" class="form-control input-rounded-disabled" readonly oninput="handleInput(event)" />
						
								</div>
								<div class="col-12 col-lg-11  mt-1 mb-1">
									<input   name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_nombre_crear]" type="text" class="form-control input-rounded-disabled" readonly value="${formulario[0]['rep_nombre_crear'].value}"  placeholder="Nombre completo..." oninput="handleInput(event)" />
								</div>
								<div class="col-12 col-lg-4  mt-1 mb-1">
									<input  name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_tiempo_crear]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_tiempo_crear'].value}"   placeholder="Tiempo de conocer al candadidato..." oninput="handleInput(event)" />
								</div>
								<div class="col-12 col-lg-8  mt-1 mb-1">
									<input  name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_callenumero_crear]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_callenumero_crear'].value}"  placeholder="Número de calle..." oninput="handleInput(event)" />
								</div>
								
								<div class="col-12 col-lg-6  mt-1 mb-1">
									<input    name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_colonia_crear]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_colonia_crear'].value}"  placeholder="Nombre de colonia" oninput="handleInput(event)" />
								</div>
								<div class="col-12 col-lg-3  mt-1 mb-1">
									<input   name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_codpostal_crear]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_codpostal_crear'].value}"  placeholder="Código postal..." oninput="handleInput(event)" />
								</div>
								
								<div class="col-12 col-lg-3  mt-1 mb-1">
									<input  type="text"   name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_telefono_crear]" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_telefono_crear'].value}"   placeholder="Teléfono..." oninput="handleInput(event)" />
								</div>
								<div class="col-12 col-lg-12  mt-1 mb-1">
									<input type="text"  name="referencia_personal[${contador_de_insersion_de_campos_dinamicos_de_ref_personales}][rep_notas_crear]"  class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rep_notas_crear'].value}"  placeholder="Comentario..." oninput="handleInput(event)" />
								</div>
					</div>
				
				
  
				</div>
			`;
			
			lugar_de_insercion_html.insertAdjacentHTML("afterend", input_row_insertar);
  
			Swal.fire({title:'Agregado',text:'Se ha agregado una referencia ...',type:"success"})
			  .then((value) => {
				$('#agregar-referenciapersonal-alta-estudio-modal').modal('hide');          
				$forms.find("button").prop("disabled", false);
				$(`#row_ref_personal_no_${contador_de_insersion_de_campos_dinamicos_de_ref_personales}`).show('slow');
						  
			  });
  
	  });

	///SCRIPTS PARA REFERENCIA PERSONAL FIN




	///SCRIPTS PARA REF LABORAL INICIO

        
    $('#frm_ref_lab_alta_ese_comp').submit(function(event){
        
              
                  event.preventDefault();

                  let $forms = $(this);
                  a=$forms.valid();
                  if(a==false){
                    return false;
                  }
                  contador_de_insersion_de_campos_dinamicos_de_ref_laborales+=1;

                  $forms.find("button").prop("disabled", true);

                  let formulario=$("#frm_ref_lab_alta_ese_comp");
                  
                //   console.log(formulario);
                //   debugger;
                  let datos_formulario= formulario.serialize();


                  let lugar_de_insercion_html=document.getElementById('aqui_insertar_referencias_laborales');
         ;

                  let input_row_insertar=`
                    <div class="container   mt-1 mb-1 mt-2 mb-1" id='row_ref_laborales_no_${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}' style='display:none;'>  
                    
					<div class="row col-12 mt-2 border-top border-primary" >

                                    <div class="row  col-12 mt-1 mb-1 justify-content-end">
                                        <button type="button" class="btn btn-danger" onclick="borrar_esta_row_crear_referencia(event)">Borrar referencia laboral No. ${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}</button>
                                    </div>
                                    <div class="col-1 col-lg-1  mt-1 mb-1">
                                        <input   type="text" class="form-control input-rounded-disabled" readonly  value="${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}"   placeholder="Nombre de la empresa..." oninput="handleInput(event)" />
                                    </div>

                                    <div class="col-11 col-lg-11  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatoempresa]" type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatoempresa_crear_formato_completo'].value}"   placeholder="Nombre de la empresa..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatodomicilio]" type="text" class="form-control input-rounded-disabled" value="${formulario[0]['rel_candidatodomicilio_crear_formato_completo'].value}"  readonly placeholder="Domicilio..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-6  mt-1 mb-1">
                                        <input   name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatojefe]" type="text" class="form-control input-rounded-disabled"  value="${formulario[0]['rel_candidatojefe_crear_formato_completo'].value}" readonly placeholder="Nombre de jefe inmediato..." oninput="handleInput(event)" />
                                    </div>
                                    
                                    <div class="col-12 col-lg-6  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatotelefono]" type="text" class="form-control input-rounded-disabled" value="${formulario[0]['rel_candidatotelefono_crear_formato_completo'].value}"  readonly placeholder="Teléfono..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-6  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatopuestoinicial]" type="text" class="form-control input-rounded-disabled" value="${formulario[0]['rel_candidatopuestoinicial_crear_formato_completo'].value}"  readonly placeholder="Puesto incial..." oninput="handleInput(event)" />
                                    </div>
                                    
                                    <div class="col-12 col-lg-6 mt-1 mb-1">
                                        <input name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatopuestofinal]" type="text" class="form-control input-rounded-disabled"  value="${formulario[0]['rel_candidatopuestofinal_crear_formato_completo'].value}" readonly placeholder="Puesto final..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-6  mt-1 mb-1">
                                        <input   name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatoingreso]" type="text" class="form-control input-rounded-disabled" value="${formulario[0]['rel_candidatoingreso_crear_formato_completo'].value}"  readonly placeholder="Fecha de ingreso..." oninput="handleInput(event)" />
                                    </div>
                            
                                    <div class="col-12 col-lg-6 mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatosalida]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatosalida_crear_formato_completo'].value}" placeholder="Fecha de salida..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-6  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatosueldoinicial]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatosueldoinicial_crear_formato_completo'].value}" placeholder="Sueldo incial..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mb-1">
                                        <input name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatosueldofinal]"  type="text" class="form-control input-rounded-disabled" readonly value="${formulario[0]['rel_candidatosueldofinal_crear_formato_completo'].value}"  placeholder="Sueldo final..." oninput="handleInput(event)" />
                                    </div>
                                    
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <input  name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatoseparacion]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatoseparacion_crear_formato_completo'].value}" placeholder="Motivo de separación..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <input name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatoincapacidad]"  type="text" class="form-control input-rounded-disabled" readonly value="${formulario[0]['rel_candidatoincapacidad_crear_formato_completo'].value}" placeholder="Incapacidadd o accidentes..." oninput="handleInput(event)" />
                                    </div>
                                    
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <input name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatodemanda]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatodemanda_crear_formato_completo'].value}" placeholder="Demandas..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <input name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_candidatorecomendable]"  type="text" class="form-control input-rounded-disabled" readonly  value="${formulario[0]['rel_candidatorecomendable_crear_formato_completo'].value}" placeholder="Recomendable..." oninput="handleInput(event)" />
                                    </div>
                                    <div class="col-12 col-lg-12  mt-1 mb-1">
                                        <textarea placeholder="Comentario..."  readonly name="referencia_laboral[${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}][rel_notas]"   class="form-control-textarea text_area_a input-rounded-disabled"   readonly lestyle="min-height:90px" rows="3" >${$('#rel_notas_crear_formato_completo').val()}</textarea>
                                    </div>

                        <div>
                    </div>
                  `;
          
                    lugar_de_insercion_html.insertAdjacentHTML("afterend", input_row_insertar);

                    Swal.fire({title:'Agregado',text:'Se ha agregado una referencia ...',type:"success"})
                      .then((value) => {
                        $('#agregar-referencialaboral-alta-estudio-modal').modal('hide');          
                        $forms.find("button").prop("disabled", false);
                        $(`#row_ref_laborales_no_${contador_de_insersion_de_campos_dinamicos_de_ref_laborales}`).show('slow');
                                  
                      });

            });


  
		
	});
    var contador_de_insersion_de_campos_dinamicos_de_ref_laborales=0;

    function fnCrearReferenciasLaboral_alta_estudio(){
    let form= document.getElementById('frm_ref_lab_alta_ese_comp');
    form.reset();
    }

	///SCRIPTS PARA REF LALBORAL FIN





  </script>
  