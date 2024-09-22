<form id="form_estudio_seccionEstadoGeneralDeSalud_formato_truper" class="form-vertical mt-1">
                    

    <section class="m-3">
      <div class="form-group row">

        <div class="col-lg-4">
            <label  for="ess_intervencionquirurgicapreg" class="col-form-label title-busq"> ¿Ha tenido intervenciones quirúrgicas? </label>
            <select name="ess_intervencionquirurgicapreg"  id="ess_intervencionquirurgicapreg-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo(event.currentTarget.value,'ess_intervencionquirurgicapreg-coontentquestion','ess_intervencionquirurgica-formato-truper');">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>

        </div>

        <div style="display:none;" class="col-lg-8" id="ess_intervencionquirurgicapreg-coontentquestion">
            <label  for="ess_intervencionquirurgica-formato-truper" class="col-form-label title-busq"> Especifique cual</label>
            <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Especifique cual"  name="ess_intervencionquirurgica" id="ess_intervencionquirurgica-formato-truper" maxlength="255" />
        </div>



      </div>
      <div class="form-group row">
        <div class="col-lg-4">
            <label  for="ess_incapacidadultimoaniopreg-formato-truper" class="col-form-label title-busq">¿Tuvo alguna incapacidad de trabajo el último año? </label>
            <select name="ess_incapacidadultimoaniopreg"  id="ess_incapacidadultimoaniopreg-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo(event.currentTarget.value,'ess_incapacidadultimoanio-coontentquestion','ess_incapacidadultimoanio-formato-truper');">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>
        </div>
        
        <div class="col-lg-8" style="display: none;" id="ess_incapacidadultimoanio-coontentquestion">
          <label  for="ess_incapacidadultimoanio-formato-truper" class="col-form-label title-busq">Especifica </label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Especifique" name="ess_incapacidadultimoanio" id="ess_incapacidadultimoanio-formato-truper" maxlength="85"/>
        </div>  
      </div>
      
      <div class="form-group row">
        <div class="col-lg-4">
            <label  for="ess_enfermedadcronicapreg-formato-truper" class="col-form-label title-busq">¿Tiene alguna enfermedad crónica familiar?   </label>

            <select name="ess_enfermedadcronicapreg"  id="ess_enfermedadcronicapreg-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONo(event.currentTarget.value,'ess_enfermedadcronica-coontentquestion','ess_enfermedadcronica-formato-truper');">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>

                </optgroup>
            </select>
        </div>
        
        <div class="col-lg-8" style="display: none;" id="ess_enfermedadcronica-coontentquestion">
          <label  for="ess_enfermedadcronica-formato-truper" class="col-form-label title-busq">Especifique cual</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Especifique cual" name="ess_enfermedadcronica" id="ess_enfermedadcronica-formato-truper" maxlength="85"/>
        </div>
     




      </div>
    
      <div class="form-group row">
        <div class="col-lg-4">
            <label  for="ess_famconenfermedadcronicapreg-formato-truper" class="col-form-label title-busq"> ¿Tiene algun familiar con alguna enfermedad crónica? </label>
            <select name="ess_famconenfermedadcronicapreg"  id="ess_famconenfermedadcronicapreg-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  onchange="SelectMostrarOcultarDivDeAcuerdoASiONo(event.currentTarget.value,'ess_famconenfermedadcronica-coontentquestion','ess_famconenfermedadcronica-formato-truper');">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>
        </div>
        
        <div class="col-lg-8" style="display: none;" id="ess_famconenfermedadcronica-coontentquestion">
          <label  for="ess_famconenfermedadcronica-formato-truper" class="col-form-label title-busq">Especifique parentesco y que enfermedad</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Especifique parentesco y que enfermedad" name="ess_famconenfermedadcronica" id="ess_famconenfermedadcronica-formato-truper" maxlength="85"/>
        </div>
      </div>
     					



                    
      <div class="row d-flex justify-content-center  bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
                          
                                      
        <div class="container row d-flex justify-content-center">
          
              <p class=" text-white text-center text-uppercase font-weight-bold h6 sin-margen" >
                D | Datos físicos		<i class="far fa-smile-beam white mdi-18px"></i>
              </p>

        </div>



    </div>
      <div class="form-group row  border-top pt-2">

        <div class="col-lg-6">
          <label for="ess_estatura" class="col-form-label title-busq">Estatura</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Estatura en metros..."  name="ess_estatura" id="ess_estatura-formato-truper" maxlength="15" />
        </div>
        <div class="col-lg-6">
          <label for="ess_peso" class="col-form-label title-busq">Peso</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Peso en kilogramos..." name="ess_peso" id="ess_peso-formato-truper" maxlength="15" />
        </div>
      </div>
      <div class="form-group row border-top pt-2">
        <div class="col-lg-6">
          <label for="ess_avisar" class="col-form-label title-busq">En caso de accidente avisar a:</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded data-not-lt-active" placeholder="Nombre de la persona..."  id="ess_avisar-formato-truper" name="ess_avisar" maxlength="155" />
        </div>
        <div class="col-lg-6">
          <label for="ess_telefono" class="col-form-label title-busq">Número de teléfono</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="000 000 00 00" name="ess_telefono" id="ess_telefono-formato-truper" maxlength="25" />
        </div>
        <div class="col-lg-3 d-none">
          <label  for="ess_direccion" class="col-form-label title-busq d-none">Dirección</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="N°, calle, colonia y entidad" id="ess_direccion-formato-truper" name="ess_direccion" maxlength="255" />
        </div>
        <div class="col-lg-3" style="display: none;">
          <label for="ess_parentesco" class="col-form-label title-busq">Parentesco</label>
          <input type="text" oninput="handleInput(event)" class="form-control input-rounded" placeholder="Parentesco..." name="ess_parentesco" id="ess_parentesco-formato-truper" maxlength="85" />
        </div>
      </div>

      <div class="form-group row border-top pt-2">

        <div class="col-lg-4">
            <label  for="ans_bebida-formato-truper" class="col-form-label title-busq"> ¿Ingiere bebidas alcohólicas?</label>
            <select  name="ans[ans_bebida]" id="ans_bebida-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>
           
        </div>

        <div class="col-lg-4">
            <label  for="ans_droga-formato-truper" class="col-form-label title-busq">¿Ingiere algún tipo de droga?		            </label>
            
            <select name="ans[ans_droga]" id="ans_droga-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>
           
        </div>

        <div class="col-lg-4">
            <label  for="ess_enfermedadcronica-formato-truper" class="col-form-label title-busq">¿Fuma?</label>
            
            
            <select name="ans[ans_fumar]" id="ans_fumar-formato-truper" class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ...">
                <optgroup class="text-uppercase">
                    <option value="-1">Seleccionar...</option>
                    <option value="0">NO</option>
                    <option value="1">SÍ</option>
                </optgroup>
            </select>
          
        </div>


      </div>


    </section>
    <div class="row col-lg-12">
      <div class="col-sm-3 col-md-3 text-center mt-5">
        </div>                          
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),15)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
            </div>
          {% endif %}
        </div>
      <div class="col-sm-3 col-md-3 text-center mt-5">
          <div class="form-group">
            <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
          </div>
      </div>
      <div class="col-sm-3 col-md-3  text-center mt-5 ">
          <div class="form-group">
            <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar <i class="mdi mdi-content-save white"></i> </button>
          </div>
      </div>
    </div>
  </form>