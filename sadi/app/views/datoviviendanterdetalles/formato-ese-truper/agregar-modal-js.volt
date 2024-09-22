
<script>
  function fnCrearDatoViviendaanteriorDetalles()
  {
    let form_ocupado=document.getElementById('frm_crear_datoviviendaanteriordetalles');
    form_ocupado.reset();

    $('#dva_salajuego-agregar').val('-1');
    $('#dva_salajuego-agregar').trigger('change');


    $('#dva_terraza-agregar').val('-1');
    $('#dva_terraza-agregar').trigger('change');

    $('#dva_cualavado-agregar').val('-1');
    $('#dva_cualavado-agregar').trigger('change');

    $('#dva_servicio-agregar').val('-1');
    $('#dva_servicio-agregar').trigger('change');

    $('#dva_garage-agregar').val('-1');
    $('#dva_garage-agregar').trigger('change');

    $('#dva_jardin-agregar').val('-1');
    $('#dva_jardin-agregar').trigger('change');

    $('#dva_piscina-agregar').val('-1');
    $('#dva_piscina-agregar').trigger('change');


    $('#dva_cuaservicio-agregar').val('-1');
    $('#dva_cuaservicio-agregar').trigger('change');

 


    $('#dva_estudio-agregar').val('-1');
    $('#dva_estudio-agregar').trigger('change');

    $('#dva_sala-agregar').val('-1');
    $('#dva_sala-agregar').trigger('change');

    $('#dva_cocina-agregar').val('-1');
    $('#dva_cocina-agregar').trigger('change');

    $('#dva_comedor-agregar').val('-1');
    $('#dva_comedor-agregar').trigger('change');

    $('#dva_banio-agregar').val('-1');
    $('#dva_banio-agregar').trigger('change');

    $('#dva_recamara-agregar').val('-1');
    $('#dva_recamara-agregar').trigger('change');
    


    fngetDataSelectsDinamicosDatosVivienda(
                          antiguedad_value_id=0 ,
                          antiguedad_select_input=$('#dva_antiguedad-agregar'),
                          zona_value_id=0,
                          zona_select_input=$('#dva_zona-agregar'),
                          clase_social_value_id=0 ,
                          clase_social_select_input=$('#dva_clasesocial-agregar'),
                          vivienda_value_id=0,
                          vivienda_select_input=$('#dva_vivienda-agregar'),
                          formato_vivienda_value_id=0,
                          formato_vivienda_select_input=$('#dva_formatovivienda-agregar'),
                          niveles_value_id=0,
                          niveles_select_input=$('#dva_nivel-agregar'),
                          apariencia_value_id=0,
                          apariencia_select_input=0,
                          estadomobiliario_value_id=0,
                          estadomobiliario_select_input=0,
                          inmueble_value_id=0,
                          inmueble_select_input=$('#dva_inmueble-agregar'),
                        );
    
 

    fnestados_estados_adaptable(0,$('#dva_est_id-agregar'));
    fnmunicipios_adaptable($('#dva_mun_id-agregar'),$('#dva_est_id-agregar').val(),-1);
    let dav_id=$('#dav_id').val();
     $('#dva_dav_id-agregar').val(dav_id);
     $('#dva_ese_id-agregar').text($('#ese_id_ese_actual_formato_ese_truper').text());
     $('#dva_ese_nombre-agregar').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 

  } 

  $(function(){
    $('#frm_crear_datoviviendaanteriordetalles').submit(function(event){
      let $forms = $(this);
      /*a=$forms.valid();
      if(a==false){
        return false;
      }*/
      event.preventDefault();
 
      let formulario=$("#frm_crear_datoviviendaanteriordetalles");
      let $form = $(this);
      // $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datoviviendanterdetalles/crear_formato_truper/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar,
        data: formulario.serialize(),
        success: function(res)
        {

          if(res[0]==2)
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
             .then((value) => {
                  $form.find("button").prop("disabled", false);
               
                  $('#agregar-datoviviendaanterioranterior-modal').modal('hide');
                  // fnGetDatosVivienda(($('#ese_id_ese_actual_formato_ese_truper').text()));


                        fnCargarDatogViviendaAnteriorDetallesFormatoTruper(res['dav_id']);
              });


          }
          else
          {
            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
              .then((value) => {
                location.reload();  
              });
          }
        },
        error: function(res)
        { 
        alert('ERROR EN EL SERVIDOR');
        }
      });
      return false;
    });
  });
      
 </script>
 

<div class="modal fade" id="agregar-datoviviendaanterioranterior-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-semi-grande modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_agregar_familiar_candidato">
                <i class="mdi mdi-plus"></i>Agregar dato de la vivienda anterior del estudio No. <span id="dva_ese_id-agregar"></span> "<span id="dva_ese_nombre-agregar"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_crear_datoviviendaanteriordetalles" class="form-vertical mt-1" novalidate method="post">
                <div class="form-group row">
                  <input type="hidden" id="dva_dav_id-agregar" name="dav_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre propietarario</label>
                    <input name="dva_nombrepropietario" id="dva_nombrepropietario-agregar" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del propieatario..." maxlength="150" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Calle</label>
                    <input name="dva_calle" id="dva_calle-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Calle..." maxlength="55" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Num. interior</label>
                    <input name="dva_numint" id="dva_numint-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Num. interior..." maxlength="25" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Num. exterior</label>
                    <input name="dva_numlext" id="dva_numlext-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Num. exterior..." maxlength="25" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Colonia</label>
                    <input name="dva_colonia" id="dva_colonia-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Colonia..." maxlength="55" />

                  </div>


                  <div class="col-lg-2">
                    <label class="col-form-label title-busq">Código postal</label>
                    <input name="dva_codpostal" id="dva_codpostal-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Código postal..." maxlength="25" />

                  </div>
                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Estado</label>
                    <select name="est_id" id="dva_est_id-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios_adaptable($('#dva_mun_id-agregar'),$('#dva_est_id-agregar').val(),-1)">
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Municipio</label>
                    <select name="mun_id" id="dva_mun_id-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    </select>
                  </div>


                    <div class="col-lg-12">
                      <label for="ans_nota" class="col-form-label title-busq">
                      Motivo de cambio
                      </label>
              
                      <textarea id="dva_motivocamb-agregar"  placeholder="Motivo..." name="dva_motivocamb" oninput="handleInput(event)"  onkeyup="actualizaInfo(400,'dva_motivocamb-agregar', 'dva_motivocamb_label_agregar')"class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400"></textarea>
                      <label  id="dva_motivocamb_label_agregar" for="dva_motivocamb" class="col-form-label title-busq ml-2"></label>
            
                    </div>



               
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Antigüedad
                      </label>
                      <select name="dva_antiguedad" id="dva_antiguedad-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Zona
                      </label>
                      <select name="dva_zona" id="dva_zona-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Clase social
                      </label>
                      <select name="dva_clasesocial" id="dva_clasesocial-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Vivienda
                      </label>
                      <select name="dva_vivienda" id="dva_vivienda-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>

                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Formato de la vivienda
                      </label>
                      <select name="dva_formatovivienda" id="dva_formatovivienda-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Inmueble</label>
                    <select name="dva_inmueble" id="dva_inmueble-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>



                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Nivel</label>
                    <select name="dva_nivel" id="dva_nivel-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>

       
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Monto de la Renta o Valor del Inmueble			
                    </label>
                    <input name="dva_montorentaovalor" id="dva_montorentaovalor-agregar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Monto($)..." maxlength="150" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Recámara</label>
              

                    <select name="dva_recamara" id="dva_recamara-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
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

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Baño</label>

                    <select name="dva_banio" id="dva_banio-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
                      <option value="1">1</option>
                      <option value="1.5">1.5</option>
                      <option value="2">2</option>
                      <option value="2.5">2.5</option>
                      <option value="3.5">3.5</option>
                      <option value="4">4</option>
                      <option value="4.5">4.5</option>


                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Sala</label>
                    <select name="dva_sala" id="dva_sala-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cocina</label>
                    <select name="dva_cocina" id="dva_cocina-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Comedor</label>
                    <select name="dva_comedor" id="dva_comedor-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>
                  
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Estudio</label>
                    <select name="dva_estudio" id="dva_estudio-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Sala de juegos</label>
                    <select name="dva_salajuego" id="dva_salajuego-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Terraza</label>
                    <select name="dva_terraza" id="dva_terraza-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>



                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cuarto de lavado</label>
                    <select name="dva_cualavado" id="dva_cualavado-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cuarto de servicio</label>
                    <select name="dva_cuaservicio" id="dva_cuaservicio-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                 
                  

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Garage</label>
                    <select name="dva_garage" id="dva_garage-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Jardin</label>
                    <select name="dva_jardin" id="dva_jardin-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Piscina</label>
                    <select name="dva_piscina" id="dva_piscina-agregar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>
                  


                  <div class="row col-lg-12">
                    <div class="col-sm-6 col-md-6 text-center mt-5">
                    </div>
                    <div class="col-sm-3 col-md-3 text-center mt-5">
                        <div class="form-group">
                          <button type="button" class="btn-dark btn-rounded btn btn-limpiar" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3  text-center mt-5 ">
                        <div class="form-group">
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Guardar  <i class="mdi mdi-content-save white"></i></button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          <!-- </div>
        </div> -->
      </div>
    </div>
  </div>