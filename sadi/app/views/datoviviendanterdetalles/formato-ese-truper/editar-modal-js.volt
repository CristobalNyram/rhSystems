<script>
 function fnEditarrDatoViviendaanteriorDetalles(dva_id=0)
 {
    let form_ocupado=document.getElementById('frm_editar_datoviviendaanteriordetalles');
    form_ocupado.reset();
   


    let url_enviar="<?php echo $this->url->get('datoviviendanterdetalles/ajax_get_detalle/') ?>";
                                       
                 $.ajax({
                    type: "POST",
                    url: url_enviar+dva_id,
                     success: function(res)
                       {   

                       ;
                        let data=res[0];

                        $('#dva_id-editar-truper').val(data.dva_id);
                                         
                        $('#dva_nombrepropietario-editar').val(data.dva_nombrepropietario);
                        $('#dva_calle-editar').val(data.dva_calle);
                        $('#dva_numint-editar').val(data.dva_numint);
                        $('#dva_numlext-editar').val(data.dva_numlext);
                        $('#dva_colonia-editar').val(data.dva_colonia);
                        $('#dva_codpostal-editar').val(data.dva_codpostal);
                        $('#dva_colonia-editar').val(data.dva_colonia);

                        $('#dva_montorentaovalor-editar').val(data.dva_montorentaovalor);

                        $('#dva_salajuego-editar').val(data.dva_salajuego);
                        $('#dva_salajuego-editar').trigger('change');


                        $('#dva_terraza-editar').val(data.dva_terraza);
                        $('#dva_terraza-editar').trigger('change');

                        $('#dva_cualavado-editar').val(data.dva_cualavado);
                        $('#dva_cualavado-editar').trigger('change');

                        $('#dva_servicio-editar').val(data.dva_servicio);
                        $('#dva_servicio-editar').trigger('change');

                        $('#dva_garage-editar').val(data.dva_garage);
                        $('#dva_garage-editar').trigger('change');

                        $('#dva_jardin-editar').val(data.dva_jardin);
                        $('#dva_jardin-editar').trigger('change');

                        $('#dva_piscina-editar').val(data.dva_piscina);
                        $('#dva_piscina-editar').trigger('change');


                        $('#dva_cuaservicio-editar').val(data.dva_cuaservicio);
                        $('#dva_cuaservicio-editar').trigger('change');

                        $('#dva_estudio-editar').val(data.dva_estudio);
                        $('#dva_estudio-editar').trigger('change');

                        $('#dva_sala-editar').val(data.dva_sala);
                        $('#dva_sala-editar').trigger('change');

                        $('#dva_cocina-editar').val(data.dva_cocina);
                        $('#dva_cocina-editar').trigger('change');

                        $('#dva_comedor-editar').val(data.dva_comedor);
                        $('#dva_comedor-editar').trigger('change');

                        $('#dva_banio-editar').val(data.dva_banio);
                        $('#dva_banio-editar').trigger('change');

                        $('#dva_recamara-editar').val(data.dva_recamara);
                        $('#dva_recamara-editar').trigger('change');

                        $('#dva_motivocamb-editar').val(data.dva_motivocamb);

                                fngetDataSelectsDinamicosDatosVivienda(
                                                      antiguedad_value_id=data.dva_antiguedad ,
                                                      antiguedad_select_input=$('#dva_antiguedad-editar'),
                                                      zona_value_id=data.dva_zona,
                                                      zona_select_input=$('#dva_zona-editar'),
                                                      clase_social_value_id=data.dva_clasesocial ,
                                                      clase_social_select_input=$('#dva_clasesocial-editar'),
                                                      vivienda_value_id=data.dva_vivienda,
                                                      vivienda_select_input=$('#dva_vivienda-editar'),
                                                      formato_vivienda_value_id=data.dva_formatovivienda,
                                                      formato_vivienda_select_input=$('#dva_formatovivienda-editar'),
                                                      niveles_value_id=data.dva_nivel,
                                                      niveles_select_input=$('#dva_nivel-editar'),
                                                      apariencia_value_id=0,
                                                      apariencia_select_input=0,
                                                      estadomobiliario_value_id=0,
                                                      estadomobiliario_select_input=0,
                                                      inmueble_value_id=data.dva_inmueble,
                                                      inmueble_select_input=$('#dva_inmueble-editar'),
                                                    );
                                
                            
                                let  est_id=(data.est_id==null||data.est_id=='') ? null : data.est_id;
                                let  mun_id=(data.mun_id==null||data.mun_id=='') ? null : data.mun_id;

                                fnestados_estados_adaptable(est_id,$('#dva_est_id-editar'));
                                fnmunicipios_adaptable($('#dva_mun_id-editar'),est_id,mun_id);

                                let dav_id=$('#dav_id').val();
                                $('#dva_dav_id-editar').val(dav_id);
                                $('#dva_ese_id-editar').text($('#ese_id_ese_actual_formato_ese_truper').text());
                                $('#dva_ese_nombre-editar').text($('#ese_nombrecompleto_actual_formato_ese_truper').text()); 
                    
                          //  console.log();                                                                                  
                       },
                      error: function(res)
                       { 
                                                alert('error en el servidor...');
                       }
                   });
 }

  $(function(){
    $('#frm_editar_datoviviendaanteriordetalles').submit(function(event){
      let $forms = $(this);
      a=$forms.valid();
      if(a==false){
        return false;
      }
                          
      event.preventDefault();
     
      let formulario=$("#frm_editar_datoviviendaanteriordetalles");
      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let url_enviar="<?php echo $this->url->get('datoviviendanterdetalles/actualizar_formato_truper/') ?>";
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
            let form_ocupado=document.getElementById('frm_editar_datoviviendaanteriordetalles');
            form_ocupado.reset();
            $('#editar-datoviviendaanteriordetalles-modal').modal('hide');
            fnRecargarCargarDatogrupofamiliardetalles(res['dav_id']);               
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
        
        }
      });
      return false;
    });
  });
</script>

<div class="modal fade" id="editar-datoviviendaanteriordetalles-modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog detalle modal-dialog-scrollable">
      <div class="modal-content">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
   -->        <div class="modal-header">
              <h5><div id="msae_editar_familiar_candidato">
                <i class="mdi mdi-plus"></i>Editar dato de la vivienda anterior del estudio No. <span id="dva_ese_id-editar"></span> "<span id="dva_ese_nombre-editar"></span>"
              </div></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- //contenido -->
              <form id="frm_editar_datoviviendaanteriordetalles" enctype="multipart/form-data" class="form-vertical mt-1" novalidate method="post">
              
                <div class="form-group row">
                  <input type="hidden" id="dva_id-editar-truper" name="dva_id" />

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Nombre propietarario</label>
                    <input name="dva_nombrepropietario" id="dva_nombrepropietario-editar" type="text" class="form-control input-rounded data-not-lt-active" required oninput="handleInput(event)"  placeholder="Nombre del propieatario..." maxlength="150" />

                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Calle</label>
                    <input name="dva_calle" id="dva_calle-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Calle..." maxlength="55" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Num. interior</label>
                    <input name="dva_numint" id="dva_numint-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Num. interior..." maxlength="25" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Num. exterior</label>
                    <input name="dva_numlext" id="dva_numlext-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Num. exterior..." maxlength="25" />

                  </div>

                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Colonia</label>
                    <input name="dva_colonia" id="dva_colonia-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Colonia..." maxlength="55" />

                  </div>


                  <div class="col-lg-2">
                    <label class="col-form-label title-busq">Código postal</label>
                    <input name="dva_codpostal" id="dva_codpostal-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Código postal..." maxlength="25" />

                  </div>
                  
                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Estado</label>
                    <select name="est_id" id="dva_est_id-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." onchange="fnmunicipios_adaptable($('#dva_mun_id-editar'),$('#dva_est_id-editar').val(),-1)">
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="col-form-label title-busq">Municipio</label>
                    <select name="mun_id" id="dva_mun_id-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..."  >
                    </select>
                  </div>


                    <div class="col-lg-12">
                      <label for="ans_nota" class="col-form-label title-busq">
                      Motivo de cambio
                      </label>
              
                      <textarea id="dva_motivocamb-editar"  placeholder="Motivo..." name="dva_motivocamb" oninput="handleInput(event)"  onkeyup="actualizaInfo(400,'dva_motivocamb-editar', 'dva_motivocamb_label_editar')"class="form-control-textarea text_area_a" style="min-height:5rem" maxlength="400"></textarea>
                      <label  id="dva_motivocamb_label_editar" for="dva_motivocamb" class="col-form-label title-busq ml-2"></label>
            
                    </div>



               
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Antigüedad
                      </label>
                      <select name="dva_antiguedad" id="dva_antiguedad-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Zona
                      </label>
                      <select name="dva_zona" id="dva_zona-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Clase social
                      </label>
                      <select name="dva_clasesocial" id="dva_clasesocial-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="col-form-label title-busq">Vivienda
                      </label>
                      <select name="dva_vivienda" id="dva_vivienda-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>

                    <div class="col-lg-4">
                      <label class="col-form-label title-busq">Formato de la vivienda
                      </label>
                      <select name="dva_formatovivienda" id="dva_formatovivienda-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      </select>
                    </div>


                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Inmueble</label>
                    <select name="dva_inmueble" id="dva_inmueble-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>



                  <div class="col-lg-4">
                    <label class="col-form-label title-busq">Nivel</label>
                    <select name="dva_nivel" id="dva_nivel-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                    </select>
                  </div>

       
                  <div class="col-lg-12">
                    <label class="col-form-label title-busq">Monto de la Renta o Valor del Inmueble			
                    </label>
                    <input name="dva_montorentaovalor" id="dva_montorentaovalor-editar" type="text" class="form-control input-rounded" required oninput="handleInput(event)"  placeholder="Monto($)..." maxlength="150" />

                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Recámara</label>
              

                    <select name="dva_recamara" id="dva_recamara-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
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

                    <select name="dva_banio" id="dva_banio-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
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
                    <select name="dva_sala" id="dva_sala-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cocina</label>
                    <select name="dva_cocina" id="dva_cocina-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Comedor</label>
                    <select name="dva_comedor" id="dva_comedor-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>
                  
                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Estudio</label>
                    <select name="dva_estudio" id="dva_estudio-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Sala de juegos</label>
                    <select name="dva_salajuego" id="dva_salajuego-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Terraza</label>
                    <select name="dva_terraza" id="dva_terraza-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>



                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cuarto de lavado</label>
                    <select name="dva_cualavado" id="dva_cualavado-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>


                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Cuarto de servicio</label>
                    <select name="dva_cuaservicio" id="dva_cuaservicio-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                 
                  

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Garage</label>
                    <select name="dva_garage" id="dva_garage-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Jardin</label>
                    <select name="dva_jardin" id="dva_jardin-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
                      <option value="-1" selected>Seleccionar...</option>
  
                    <option value="1">SI</option>
                    <option value="0">NO</option>

                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label class="col-form-label title-busq">Piscina</label>
                    <select name="dva_piscina" id="dva_piscina-editar"  required class="form-control select2-single " data-toggle="select2" data-placeholder="Seleccionar ..." >
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
                          <button type="submit" class="btn-dark btn-rounded btn btn-buscar">Actualizar  <i class="mdi mdi-pencil-box-outline white"></i></button>
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
  