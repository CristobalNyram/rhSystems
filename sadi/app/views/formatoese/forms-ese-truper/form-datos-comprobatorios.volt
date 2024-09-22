<form id="form_estudio_seccionDatosComprobatorios_formato_ese_truper" class="form-vertical   mb-3 mr-1 ml-2" method="post">
                      
    <input type="hidden" name="ese_id" id="cop_ese_id-formato_truper">      
    <input type="hidden" name="cop_id" id="cop_id-formato_truper">      

    <section class="m-3 "> 


    


    <div class="form-group row mt-5 ">
      <div class="col-lg-3">
        <p class="col-form-label title-busq text-uppercase">CONCEPTO</p>
      </div>
      <div class="col-lg-1">
        <p class="col-form-label title-busq text-uppercase">Cantidad</p>
      </div>

      <div class="col-lg-2">
        <p class="col-form-label title-busq text-uppercase">Tipo de documento </p>
      </div>
      <div class="col-lg-3">
        <p class="col-form-label title-busq text-uppercase">Folio </p>
      </div>
      <div class="col-lg-3">
        <p class="col-form-label title-busq text-uppercase">Comentario </p>
      </div>
    </div>

    <div class="form-group row">
          <div class="col-lg-3">
            <p class="col-form-label title-busq ">Acta de nacimiento(Candidato)</p>
          </div>
          <div class="col-lg-1">
            <select name="cop_nacimientocantidad" id="cop_nacimientocantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
              <option value="-1" selected>Seleccionar...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
            </select>
          
          </div>

          <div class="col-lg-2">
            <select  name="cop_nacimientotipodoc" id="cop_nacimientotipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup>
                <option value="-1">Seleccionar ...</option>
                <option value="1">ORIGINAL</option>
                <option value="0">COPIA</option>
              </optgroup>
            </select>     
          </div>

          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded" maxlength="25" placeholder="Folio(s)..."  name="cop_nacimientofolio" id="cop_nacimientofolio-formato_truper"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_nacimientocomentario" id="cop_nacimientocomentario-formato_truper"  maxlength="45"  oninput="handleInput(event)"/>
          </div>
  
    </div>
    <div class="form-group row">
          <div class="col-lg-3">
            <p class="col-form-label title-busq ">Acta de nacimiento de cónyuge</p>
          </div>
    
          <div class="col-lg-1">

            <select name="cop_conyugecantidad" id="cop_conyugecantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
              <option value="-1" selected>Seleccionar...</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
            </select>

          </div>

          <div class="col-lg-2">
            <select  name="cop_conyugetipodoc" id="cop_conyugetipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup>
                <option value="-1">Seleccionar ...</option>
                <option value="1">ORIGINAL</option>
                <option value="0">COPIA</option>
              </optgroup>
            </select>     
          </div>

          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_conyugefolio" id="cop_conyugefolio-formato_truper"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_conyugecomentario" id="cop_conyugecomentario-formato_truper"  maxlength="45"  oninput="handleInput(event)"/>
          </div>

    </div>
    <div class="form-group row">
      <div class="col-lg-3">
        <p class="col-form-label title-busq ">Acta de nacimiento de hijos</p>
      </div>
   
      <div class="col-lg-1">
      
        <select name="cop_nacimientohijoscantidad" id="cop_nacimientohijoscantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
          <option value="-1" selected>Seleccionar...</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>

      </div>
  
      <div class="col-lg-2">
        <select  name="cop_nacimientohijostipodoc" id="cop_nacimientohijostipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
          <optgroup>
            <option value="-1">Seleccionar ...</option>
            <option value="1">ORIGINAL</option>
            <option value="0">COPIA</option>
          </optgroup>
        </select>     
      </div>
  
      <div class="col-lg-3">
        <input type="text" class="form-control input-rounded" maxlength="155"  placeholder="Folio(s)..."  name="cop_nacimientohijosfolio" id="cop_nacimientohijosfolio-formato_truper"  oninput="handleInput(event)"/>
      </div>
      <div class="col-lg-3">
        <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_nacimientohijoscomentario" id="cop_nacimientohijoscomentario-formato_truper" maxlength="45"   oninput="handleInput(event)"/>
      </div>
  
  
  </div>
  
    <div class="form-group row">
          <div class="col-lg-3">
            <p class="col-form-label title-busq ">Acta de matrimonio</p>
          </div>
          <div class="col-lg-1">
               
          <select name="cop_matrimoniocantidad" id="cop_matrimoniocantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
            <option value="-1" selected>Seleccionar...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
          </select>

          </div>

          <div class="col-lg-2">
            <select  name="cop_matrimoniotipodoc" id="cop_matrimoniotipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
              <optgroup>
                <option value="-1">Seleccionar ...</option>
                <option value="1">ORIGINAL</option>
                <option value="0">COPIA</option>
              </optgroup>
            </select>     
          </div>

          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_matrimoniofolio" id="cop_matrimoniofolio-formato_truper"  oninput="handleInput(event)"/>
          </div>
          <div class="col-lg-3">
            <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_matrimoniocomentario" id="cop_matrimoniocomentario-formato_truper" maxlength="45"  oninput="handleInput(event)"/>
          </div>


    </div>

   






<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">IFE - INE</p>
  </div>
  <div class="col-lg-1">
    <select name="cop_credencialelectorcantidad" id="cop_credencialelectorcantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>

  
  </div>

  <div class="col-lg-2">
    <select  name="cop_credencialelectortipodoc" id="cop_credencialelectortipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_credencialelectorfolio" id="cop_credencialelectorfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_credencialelectorcomentario" id="cop_credencialelectorcomentario-formato_truper" maxlength="45"   oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
    <div class="col-lg-3">
      <p class="col-form-label title-busq ">C.U.R.P</p>
    </div>

    <div class="col-lg-1">
      <select name="cop_curpcantidad" id="cop_curpcantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
        <option value="-1" selected>Seleccionar...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
      </select>
    
    </div>

    <div class="col-lg-2">
      <select  name="cop_curptipodoc" id="cop_curptipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
        <optgroup>
          <option value="-1">Seleccionar ...</option>
          <option value="1">ORIGINAL</option>
          <option value="0">COPIA</option>
        </optgroup>
      </select>     
    </div>

    <div class="col-lg-3">
      <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_curpfolio" id="cop_curpfolio-formato_truper"  oninput="handleInput(event)"/>
    </div>
    <div class="col-lg-3">
      <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_curpcomentario" id="cop_curpcomentario-formato_truper" maxlength="45"   oninput="handleInput(event)"/>
    </div>


</div>
<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">AFORE</p>
  </div>

  <div class="col-lg-1">
    <select name="cop_aforecantidad" id="cop_aforecantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_aforetipodoc" id="cop_aforetipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_aforefolio" id="cop_aforefolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_aforecomentario" id="cop_aforecomentario-formato_truper" maxlength="45"   oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">R. F. C.</p>
  </div>


  <div class="col-lg-1">
    <select name="cop_rfccantidad" id="cop_rfccantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_rfctipodoc" id="cop_rfctipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_rfcfolio" id="cop_rfcfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_rfccomentario" id="cop_rfccomentario-formato_truper"  maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Cartilla de servicio militar nacional</p>
  </div>
  <div class="col-lg-1">
    <select name="cop_cartillacantidad" id="cop_cartillacantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_cartillatipodoc" id="cop_cartillatipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_cartillafolio" id="cop_cartillafolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_cartillacomentario" id="cop_cartillacomentario-formato_truper" maxlength="45"  oninput="handleInput(event)"/>
  </div>

</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Pasaporte</p>
  </div>


  <div class="col-lg-1">
    <select name="cop_pasaportecantidad" id="cop_pasaportecantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_pasaportetipodoc" id="cop_pasaportetipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_pasaportefolio" id="cop_pasaportefolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_pasaportecomentario" id="cop_pasaportecomentario-formato_truper"  maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Visa</p>
  </div>


  <div class="col-lg-1">
    <select name="cop_visacantidad" id="cop_visacantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_visatipodoc" id="cop_visatipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_visafolio" id="cop_visafolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_visacomentario" id="cop_visacomentario-formato_truper"   maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Licencia de Manejo 		
    </p>
  </div>


  <div class="col-lg-1">
    <select name="cop_licenciacantidad" id="cop_licenciacantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_licenciatipodoc" id="cop_licenciatipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_licenciafolio" id="cop_licenciafolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  maxlength="45"  name="cop_licenciacomentario" id="cop_licenciacomentario-formato_truper"  oninput="handleInput(event)"/>
  </div>


</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Comprobante de domicilio</p>
  </div>
  <div class="col-lg-1">
    <select name="cop_comprobantedomiciliocantidad" id="cop_comprobantedomiciliocantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_comprobantedomiciliotipodoc" id="cop_comprobantedomiciliotipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_comprobantedomiciliofolio" id="cop_comprobantedomiciliofolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."   maxlength="45" name="cop_comprobantedomiciliocomentario" id="cop_comprobantedomiciliocomentario-formato_truper"  oninput="handleInput(event)"/>
  </div>

  
</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Comprobante de IMSS		    </p>
  </div>
  <div class="col-lg-1">
    <select name="cop_imsscantidad" id="cop_imsscantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_imsstipodoc" id="cop_imsstipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_imssfolio" id="cop_imssfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"   maxlength="45" placeholder="Comentario..."  name="cop_imsscomentario" id="cop_imsscomentario-formato_truper"   oninput="handleInput(event)"  maxlength="45" />
  </div>


</div>










	
<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Último comprobante de Estudios 	</p>
  </div>


  <div class="col-lg-1">

    <select name="cop_ultimosestudioscantidad" id="cop_ultimosestudioscantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_ultimosestudiostipodoc" id="cop_ultimosestudiostipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_ultimosestudiosfolio" id="cop_ultimosestudiosfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"   maxlength="45" placeholder="Comentario..."  name="cop_ultimosestudioscomentario" id="cop_ultimosestudioscomentario-formato_truper" maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Cédula Profesional		
    </p>
  </div>


  <div class="col-lg-1">

    
    <select name="cop_cedulaprofesionalcantidad" id="cop_cedulaprofesionalcantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_cedulaprofesionaltipodoc" id="cop_cedulaprofesionaltipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_cedulaprofesionalfolio" id="cop_cedulaprofesionalfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="45" placeholder="Comentario..."  name="cop_cedulaprofesionalcomentario" id="cop_cedulaprofesionalcomentario-formato_truper" maxlength="45"   oninput="handleInput(event)"/>
  </div>


</div>

		
<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">
      Recibos de nómina 	
    </p>
  </div>


  <div class="col-lg-1">

        
    <select name="cop_recibosnominacantidad" id="cop_recibosnominacantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_recibosnominatipodoc" id="cop_recibosnominatipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_recibosnominafolio" id="cop_recibosnominafolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  maxlength="45" placeholder="Comentario..."  name="cop_recibosnominacomentario" id="cop_recibosnominacomentario-formato_truper"  oninput="handleInput(event)"/>
  </div>


</div>


<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Seguro de Gastos M. M.		
    </p>
  </div>


  <div class="col-lg-1">

    <select name="cop_segurosgastommcantidad" id="cop_segurosgastommcantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_segurosgastommtipodoc" id="cop_segurosgastommtipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_segurosgastommfolio" id="cop_segurosgastommfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_segurosgastommcomentario" id="cop_segurosgastommcomentario-formato_truper" maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>



<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Cartas de Recomendación		
    </p>
  </div>


  <div class="col-lg-1">
    <select name="cop_recomendacionescantidad" id="cop_recomendacionescantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_recomendacionestipodoc" id="cop_recomendacionestipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_recomendacionesfolio" id="cop_recomendacionesfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_recomendacionescomentario" id="cop_recomendacionescomentario-formato_truper"  maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>

<div class="form-group row">
  <div class="col-lg-3">
    <p class="col-form-label title-busq ">Ingresos adicionales 		
	
    </p>
  </div>


  <div class="col-lg-1">

    <select name="cop_ingresosadicionalescantidad" id="cop_ingresosadicionalescantidad-formato_truper"   class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
      <option value="-1" selected>Seleccionar...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
    </select>
  </div>

  <div class="col-lg-2">
    <select  name="cop_ingresosadicionalestipodoc" id="cop_ingresosadicionalestipodoc-formato_truper" class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
      <optgroup>
        <option value="-1">Seleccionar ...</option>
        <option value="1">ORIGINAL</option>
        <option value="0">COPIA</option>
      </optgroup>
    </select>     
  </div>

  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded" maxlength="25"  placeholder="Folio(s)..."  name="cop_ingresosadicionalesfolio" id="cop_ingresosadicionalesfolio-formato_truper"  oninput="handleInput(event)"/>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input-rounded"  placeholder="Comentario..."  name="cop_ingresosadicionalescomentario" id="cop_ingresosadicionalescomentario-formato_truper" maxlength="45"  oninput="handleInput(event)"/>
  </div>


</div>









    
      <div class="row col-lg-12">
        <div class="col-sm-3 col-md-3 text-center mt-5">
        </div>                          
        <div class="col-sm-3 col-md-3 text-center mt-5">
          {% if cuarentayseis==1%}
            <div class="form-group">
              <button type="button" class="btn-green btn-rounded btn btn-limpiar" href="" data-toggle="modal" onclick="incidenciaformulario($('#ese_id_ese_actual_formato_ese_truper').text(),17)" data-target="#incidencias-modal" style="background-color: green;">Incidencia<i class="mdi mdi-shield-alert"></i></button>
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

  </section>

  </form>      