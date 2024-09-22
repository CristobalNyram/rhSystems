
<form id="form_encuestas_respuestas"  class="form-vertical col-md-12 row">
  <div class="col-lg-12 text-center mt-2 mb-2" id="">
    <!-- <span class="font-16 btn-link-crm">Elija el filtro de las fechas</span> -->
  </div>

    <!-- <div class="col-12 d-flex justify-content-center align-content-end align-items-lg-center">
      <button 
      class="btn btn-primary m-3 filtros-fechas"
      type="button"
      onclick="fnSeleccionarFiltroCantidad('mes_exacto','filtros-fechas','div-input-exacto','div-input-grupo-filtro-fecha')"
      >
        Mes exacto
      </button>
      <button 
      type="button"
      class="btn btn-primary m-3 filtros-fechas"
      onclick="fnSeleccionarFiltroCantidad('rango_fecha','filtros-fechas','div-input-rango','div-input-grupo-filtro-fecha')"

      >
        Rango de fecha
      </button>

    </div> -->
    <!-- <div class="col-lg-4  fecha_consulta div-input-grupo-filtro-fecha div-input-exacto" >
            
                     <label class="col-form-label  title-busq" for="enc_fecha-reporte">Mes exacto</label>
                      
                      <input style="    
                                border-radius: 44px;
                      " 
                       onchange="fecha_no_mayor_a_la_actual_MES_ANIO(event.currentTarget.value,'enc_fecha-reporte','btn_buscar_enc')"
                      type="month"
                       id="enc_fecha_exacto-reporte" 
                       name="enc_fecha" 
                       class="form-control bar-left"  />

      

    </div> -->
    <div class="col-lg-4  div-input-grupo-filtro-fecha div-input-rango"  >
      <label class="col-form-label  title-busq" for="enc_fecha-reporte">Fecha entrega cliente</label>   

                <div class="input-group" id="">
                  <label class="col-form-label  title-busq">Desde</label>
                    <input type="date" id="enc_fecha_inical-reporte" name="enc_fecha_inical" class="form-control bar-left" placeholder="Desde" />
                    <label class="col-form-label  title-busq">Hasta</label>
                    <input type="date" id="enc_fecha_fin-reporte" name="enc_fecha_fin" class="form-control bar-right" placeholder="Hasta" />
                </div>
          
    </div>

    <div class="col-lg-4  usu_id-reporte" >
      
            
                    <label class="col-form-label  title-busq" for="enc_fecha-reporte">Investigador</label>
                      
                    <select name="inv_id" id="inv_id-reporte" onchange="" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
                   
                    </select>             

      

    </div>

    <div class="col-lg-4  usu_id-reporte" >
      
            
      <label class="col-form-label  title-busq" for="enc_fecha-reporte">Empresa</label>
        
      <select name="emp_id" id="emp_id-reporte" onchange="" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
     
      </select>             



    </div>

  
   

    <div class="col-lg-3  usu_id-reporte" >
         
      <label class="col-form-label  title-busq" for="enc_fecha-reporte">Analista </label> 
      <select name="ana_id" id="ana_id-reporte" onchange="" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
      </select>             

    </div>

    <div class="col-lg-3">
    
          <label class="col-form-label  title-busq">Estatus de encuestas</label>
  
          <select name="enc_estatus" id="enc_estatus-reporte" onchange="verificar_que_tipo_busqueda_mostrar(event,'enc_tipo-reporte')" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
            <optgroup>
              <option value="0">Todas las encuestas</option>
              <option value="3" selected >Encuestas contestadas</option>
              <option value="2">Encuestas pendientes</option>

              <option value="1">Encuestas no contestadas</option>
            </optgroup>
          </select>             
      
    </div>


  <div class="col-lg-3">
      <label class="col-form-label title-busq">Formato de reporte</label>
      <select name="enc_formato" id="enc_formato-reporte" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." required>
          <optgroup>
              <!-- <option value="">Seleccionar</option> -->
              <option selected value="presencial">Presencial</option>
              <option value="telefonica">Telefónica</option>
          </optgroup>
      </select>
  </div>
    <div class="col-lg-3">
    
          <label class="col-form-label  title-busq">Tipo de busqueda</label>
  
          <select name="enc_tipo" id="enc_tipo-reporte" class="form-control select2-single col-1" data-toggle="select2" data-placeholder="Seleccionar ..." onchange="SelectMostrarOcultarDivDeAcuerdoASiONo_NoAplicaConClasesCSS(event.currentTarget.value,'agf_padrescuentan-preg-container','agf_padresservicio');">
            <optgroup>
              <option value="1" selected>Ver Respuestas</option>
              <option value="2">Ver listado de encuestas</option>
  
            </optgroup>
          </select>             
  
       </div>

    </div>
    

  
  
    <div class="col-12 d-flex justify-content-end mt-4 busqueda">
        <div class="col-lg-3 col-9  text-right busqueda">
            <div class="form-group busqueda">
           <!-- <button type="submit" id="buscar" name="buscar" onclick="principal(); window.location.href = '#listadoprincipal'; return false;" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-magnify white"></i>  Buscar</button>  -->

           <button type="submit" id="btn_buscar_enc" name="btn_buscar_enc" onclick="consultar_tabla_reporte_encuesta_calidad(); window.location.href = '#listadoprincipal';  return false;" class="btn-dark btn-rounded btn btn-buscar" ><i class=" mdi mdi-magnify white"></i>  Buscar</button> 
          </div>
       </div>
       <div class="col-lg-1 col-3  text-right busqueda">
           <div class="form-group">
           {{ link_to('encuestacalidadreporte/reporte_vdos', '<i class="mdi mdi-eraser white" title="Limpiar búsqueda"></i>',"class": "btn-dark btn-rounded btn btn-limpiar") }}
           </div>
       </div>

    </div>




</form>