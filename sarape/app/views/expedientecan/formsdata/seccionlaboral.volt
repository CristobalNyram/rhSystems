<div class="form-group row m-3" id="ref_div_contenedor-resumen_exc"></div>
<div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1 pb-1 posicion-cabezera-7 m-0">
  <div class="container">
    <center>
      <p class=" text-white text-center font-weight-bold h6 text-uppercase">
        Periodos de inactividad <i class="mdi mdi-bed-double white"></i>
      </p>
    </center>
  </div>
</div>
<div class="form-group row m-3" id="per_div_contenedor-resumen_exc"></div>
<div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
  <div class="container">
    <center>
      <p class=" text-white text-center font-weight-bold h6 text-uppercase">
        Empleos ocultos <i class="mdi mdi-bed-double white"></i>
      </p>
    </center>
  </div>
</div>
<form id="form-sel-resumen_exc" class="form-vertical mb-3 mr-1 ml-2" method="post">
  <div class="form-group row">
    <div class="col-lg-6">
      <label class="col-form-label title-busq text-uppercase" for="ent_fecha-resumen_exc">EMPLEOS OCULTOS</label>
      <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="sel_empleosocultos-resumen_exc"  readonly name="sel_empleosocultos-resumen_exc" maxlength="150"/>
    </div>
  </div>
</form>
<div class="form-group row m-3"  id="epl_div_contenedor-resumen_exc"></div>
<form id="form-sel-resumen_exc" class="form-vertical mb-3 mr-1 ml-2" method="post">
  <section class="m-3">
    <div class="form-group row">
      <div class="col-lg-6">
        <label class="col-form-label title-busq text-uppercase" for="ent_fecha-resumen_exc">EMPLEOS OCULTOS</label>
        <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="sel_empleosocultos-resumen_exc" readonly name="sel_empleosocultos-resumen_exc" maxlength="150"/>
      </div>
      <div class="col-lg-6">
        <label class="col-form-label title-busq text-uppercase" for="ent_sueldo-resumen_exc">CALIFICACIóN</label>
        <input type="text" class="form-control input-rounded data-not-lt-active" placeholder="..." id="sel_calificacion-resumen_exc"  readonly name="sel_calificacion-resumen_exc" maxlength="150"/>
      </div>
      <div class="col-lg-12">
        <label class="col-form-label title-busq text-uppercase" for="ent_hora-resumen_exc">NOTAS</label>
        <textarea  readonly class="form-control input-rounded" placeholder="..." name="sel_notas-resumen_exc" id="sel_notas-resumen_exc" style="min-height: 100px;"></textarea>
      </div>
    </div>
  </section>
</form>
<div class="tab-pane fade show active borde-inferior-del-sistema content-for-js" id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
  <div class="form-group row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1 pb-1 posicion-cabezera-7 m-0">           
    <div class="container">
      <center>
        <p class=" text-white text-center font-weight-bold h6 sin-margen">
          ARCHIVOS<i class="mdi mdi-folder-open white"></i>
        </p>
      </center>
    </div>
  </div>
</div>
<div class="form-group row m-3" id="contenedorcom-sel-resumen_exc"></div>
<div class="tab-pane fade show active borde-inferior-del-sistema content-for-js " id="seccion_datos_personal_resumen_vac-md" role="tabpanel" aria-labelledby="home-tab-md">
  <div class="form-group  row d-flex justify-content-center bg-del-sistema border-del-sistema pt-1  pb-1 posicion-cabezera-7 m-0">
    <div class="container">
      <center>
        <p class=" text-white text-center font-weight-bold h6 sin-margen">
          SEGUIMIENTO<i class="mdi mdi-comment-processing white "></i>
        </p>
      </center>
    </div>
  </div>
</div>
<div class="form-group row m-3"  id="contenedorcomentario-ref-resumen_exc"></div>
  <div class="row col-lg-12" style="display:flex; justify-content:space-between;">
    <div class="col-sm-3 col-md-3 text-center mt-5">
        <div class="form-group">
            <button type="button" id="btnAnteriorSeccionLaboral"  class="btn-dark btn-rounded btn btn-buscar"> <i class="mdi mdi-arrow-collapse-left white"></i>  Anterior sección</button>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 text-center mt-5">
      <div class="form-group">
        <button type="button" id="btnSIguienteSeccionLaboral" class="btn-dark btn-rounded btn btn-buscar">Siguiente sección <i class="mdi mdi-arrow-collapse-right white"></i> </button>
      </div>
    </div>
</div>