<style>
  .img-svg-btn-arc-vac-resumen{
    width: 6rem;
    height: 5rem;
  } 
</style>
<script>
    function scrollTopResModalExc(){
        const element = document.getElementById("ancla_exc_id-resumen_exc");
        element.scrollIntoView();

    }
  function limpiarTodasLastablasArc(){
    $(`#contenedorcom-cit-resumen_exc`).empty();
    $(`#contenedorcom-psi-resumen_exc`).empty();
    $(`#contenedorcom-ent-resumen_exc`).empty();
    $(`#contenedorcom-sel-resumen_exc`).empty();
    $(`#ref_div_contenedor-resumen_exc`).empty();
    $(`#epl_div_contenedor-resumen_exc`).empty();
    $(`#per_div_contenedor-resumen_exc`).empty();
    $(`#dato_periodoinactivo_table`).empty();
    $(`#dato_referencialaboral_table`).empty();
    $("#reporte_referencias").attr('src','');
    $("#reporte_exc").attr('src', '');
    $(`#dato_empleo_oculto_general_table`).empty();
  }

  function limpiarTodasLastablasCom(){
    $(`#contenedorcomentario-cit-resumen_exc`).empty();
    $(`#contenedorcomentario-ref-resumen_exc`).empty();
    $(`#contenedorcomentario-psi-resumen_exc`).empty();
    $(`#contenedorcomentario-ent-resumen_exc`).empty();
  }

  function iniciarModalResumen(exc_id=0,mover=1){
    $('#form-cit-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-psi-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-ent-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-sel-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-vac-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-data-resumen_exc')[0].reset(); // Reinicia el formulario
    limpiarTodasLastablasArc();
    limpiarTodasLastablasCom();
    let headers =document.getElementsByClassName('class-for-header');
    limpiarActive(headers,'#16345e','.9s',0);

    fnGetDetalleExc(exc_id)
    .then(function(res) {
      let data=res.data;
      let vac_id=data.vac_id;
      fnGetResumenVac(vac_id);
    })
    .catch(function(error) {
        alert(error.responseText);
    });

  }
  function fnGetResumeExcIncio_old(exc_id=0,mover=1) {
    scrollTopResModalExc();
    $('#form-cit-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-psi-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-ent-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-sel-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-vac-resumen_exc')[0].reset(); // Reinicia el formulario
    $('#form-data-resumen_exc')[0].reset(); // Reinicia el formulario
    limpiarTodasLastablasArc();
    let headers =document.getElementsByClassName('class-for-header');
    limpiarActive(headers,'#16345e','.9s',1);

    fnGetDetalleExc(exc_id)
      .then(function(res) {
        let data=res.data;
        let vac_id=data.vac_id;

        let mensaje=` ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} - &nbsp;&nbsp; &nbsp;`+generateBadgeExcEstatusHTML(data.exc_estatus);
        $("#titular-resumen_exc").html(mensaje);
        $("#exc_id-resumen_exc").text(exc_id);
        $("#can_nombre-resumen_exc").val(data.can_nombre);
        $("#can_curp-resumen_exc").val(data.can_curp);
        $("#can_correo-resumen_exc").val(data.can_correo);
        $("#can_celular-resumen_exc").val(data.can_celular);
        $("#usu_nombrealta-resumen_exc").val(data.usu_nombrealta);
        let onclickResumenCit = `fnGetResumeCit( ${exc_id})`;
        $("#link-cit-resumen_exc").attr("onclick", onclickResumenCit);

        let onclickResumenPsi = `fnGetResumenPsi( ${exc_id})`;
        $("#link-psi-resumen_exc").attr("onclick", onclickResumenPsi);

        let onclickResumenEnt = `fnGetResumeEnt( ${exc_id})`;
        $("#link-ent-resumen_exc").attr("onclick", onclickResumenEnt);

        let onclickResumenRef = `fnGetResumenRef( ${exc_id})`;
        $("#link-referencias-resumen_exc").attr("onclick", onclickResumenRef);

          let onclickResumenRep = `fnGetResumeReporte( ${exc_id})`;
        $("#link-reporte-resumen_exc").attr("onclick", onclickResumenRep);

        let onclickResumenVac = `fnGetResumenVac( ${vac_id})`;
        $("#link-vac-resumen_exc").attr("onclick", onclickResumenVac);

        let onclickResumenReportes = `fnGetResumenReportes( ${exc_id})`;
        $("#link-reporte-resumen_exc").attr("onclick", onclickResumenReportes);

        let onclickResumenMetricas = `fnGetResumenMetricas( ${vac_id})`;
        $("#link-metricas-resumen_exc").attr("onclick", onclickResumenMetricas);

        // siguiente btn
        $("#btnSIguienteSeccionDatosPersonales").attr("onclick", `siguienteSeccionResumen("datospersonales-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionCita").attr("onclick", `siguienteSeccionResumen("cita-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionLaboral").attr("onclick", `siguienteSeccionResumen("referencialaboral-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionPsicometria").attr("onclick", `siguienteSeccionResumen("psicometria-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionEntrevista").attr("onclick", `siguienteSeccionResumen("entrevista-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionVacante").attr("onclick", `siguienteSeccionResumen("vacante-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionReporte").attr("onclick", `siguienteSeccionResumen("reportes-sig" ,${exc_id}, ${vac_id})`);
        $("#btnSIguienteSeccionMetricas").attr("onclick", `siguienteSeccionResumen("metricas-sig" ,${exc_id}, ${vac_id})`);
        // siguiente btn

        // atras btn
        $("#btnAnteriorSeccionCita").attr("onclick", `siguienteSeccionResumen("cita-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionLaboral").attr("onclick", `siguienteSeccionResumen("referencialaboral-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionPsicometria").attr("onclick", `siguienteSeccionResumen("psicometria-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionEntrevista").attr("onclick", `siguienteSeccionResumen("entrevista-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionVacante").attr("onclick", `siguienteSeccionResumen("vacante-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionReporte").attr("onclick", `siguienteSeccionResumen("reportess-atras" ,${exc_id}, ${vac_id})`);
        $("#btnAnteriorSeccionMetricas").attr("onclick", `siguienteSeccionResumen("metricas-atras" ,${exc_id}, ${vac_id})`);
        // atras btn
      })
      .catch(function(error) {
          alert(error.responseText);
      }); 
  }
  
  function fnGetResumeExcIncio(exc_id=0,mover=1) {
  $('#form-cit-resumen_exc')[0].reset(); // Reinicia el formulario
  $('#form-psi-resumen_exc')[0].reset(); // Reinicia el formulario
  $('#form-ent-resumen_exc')[0].reset(); // Reinicia el formulario
  $('#form-sel-resumen_exc')[0].reset(); // Reinicia el formulario
  $('#form-vac-resumen_exc')[0].reset(); // Reinicia el formulario
  $('#form-data-resumen_exc')[0].reset(); // Reinicia el formulario
  limpiarTodasLastablasArc();
  let headers =document.getElementsByClassName('class-for-header');

  limpiarActive(headers,'#16345e','.9s',1);

  fnGetDetalleExc(exc_id)
    .then(function(res) {
      let data=res.data;
      let vac_id=data.vac_id;
      let mensaje=` ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);
      $("#titular-resumen_exc").html(mensaje);

      $("#exc_id-resumen_exc").text(exc_id);
      $("#can_nombre-resumen_exc").val(data.can_nombre);
      $("#can_curp-resumen_exc").val(data.can_curp);
      $("#can_correo-resumen_exc").val(data.can_correo);
      $("#eje_exc_nombre-resumen_exc").val(data.eje_exc_nombre);
      $("#can_nss-resumen_exc").val(data.can_nosegsocial);



      $("#can_celular-resumen_exc").val(data.can_celular);
      $("#usu_nombrealta-resumen_exc").val(data.usu_nombrealta);

      let onclickResumenCit = `fnGetResumeCit( ${exc_id})`;
      $("#link-cit-resumen_exc").attr("onclick", onclickResumenCit);

      let onclickResumenPsi = `fnGetResumenPsi( ${exc_id})`;
      $("#link-psi-resumen_exc").attr("onclick", onclickResumenPsi);

      let onclickResumenEnt = `fnGetResumeEnt( ${exc_id})`;
      $("#link-ent-resumen_exc").attr("onclick", onclickResumenEnt);

      let onclickResumenRef = `fnGetResumenRef( ${exc_id})`;
      $("#link-referencias-resumen_exc").attr("onclick", onclickResumenRef);

        let onclickResumenRep = `fnGetResumeReporte( ${exc_id})`;
      $("#link-reporte-resumen_exc").attr("onclick", onclickResumenRep);

      let onclickResumenVac = `fnGetResumenVac( ${vac_id})`;
      $("#link-vac-resumen_exc").attr("onclick", onclickResumenVac);

      let onclickResumenMetricas = `fnGetResumenMetricas( ${vac_id})`;
      $("#link-metricas-resumen_exc").attr("onclick", onclickResumenMetricas);

      let onclickResumenReportes = `fnGetResumenReportes( ${exc_id})`;
      $("#link-reporte-resumen_exc").attr("onclick", onclickResumenReportes);

      let onclickResumenArcExc = `fnGetResumenArc( ${exc_id})`;
      $("#link-archivos_exc-resumen_exc").attr("onclick", onclickResumenArcExc);

      // $('#link-data-resumen_exc').trigger('click');

      if(mover=="1"){
        $("#link-vac-resumen_exc").click();
        $('#link-vac-resumen_exc').trigger('click');

      }else{
        $('#link-data-resumen_exc').trigger('click');
      }
      // siguiente btn
      $("#btnSIguienteSeccionDatosPersonales").attr("onclick", `siguienteSeccionResumen("datospersonales-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionCita").attr("onclick", `siguienteSeccionResumen("cita-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionLaboral").attr("onclick", `siguienteSeccionResumen("referencialaboral-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionPsicometria").attr("onclick", `siguienteSeccionResumen("psicometria-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionEntrevista").attr("onclick", `siguienteSeccionResumen("entrevista-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionVacante").attr("onclick", `siguienteSeccionResumen("vacante-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSIguienteSeccionReporte").attr("onclick", `siguienteSeccionResumen("reportes-sig" ,${exc_id}, ${vac_id})`);
      $("#btnSiguienteSeccion_Archivos").attr("onclick", `siguienteSeccionResumen("metricas-sig" ,${exc_id}, ${vac_id})`);
      // siguiente btn

      // atras btn
      $("#btnAnteriorSeccionCita").attr("onclick", `siguienteSeccionResumen("cita-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccionLaboral").attr("onclick", `siguienteSeccionResumen("referencialaboral-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccionPsicometria").attr("onclick", `siguienteSeccionResumen("psicometria-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccionEntrevista").attr("onclick", `siguienteSeccionResumen("entrevista-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccionVacante").attr("onclick", `siguienteSeccionResumen("vacante-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccionReporte").attr("onclick", `siguienteSeccionResumen("reportess-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorDatosPersonales").attr("onclick", `siguienteSeccionResumen("datospersonales-atras" ,${exc_id}, ${vac_id})`);
      $("#btnAnteriorSeccion_Archivos").attr("onclick", `siguienteSeccionResumen("metricas-atras" ,${exc_id}, ${vac_id})`);
      // atras btn
    })
    .catch(function(error) {
      alert(error.responseText);
    });
  }

  function fnGetResumeCit(exc_id){
    limpiarTodasLastablasArc();
    scrollTopResModalExc();

    let config_com ={};
    config_com.id_div_contenedor="contenedorcom-cit-resumen_exc";
    fnCargarTablaArchivoSolo(exc_id,"cita",config_com);

    limpiarTodasLastablasCom();
    let config_comen ={};
    config_comen.id_div_contenedor="contenedorcomentario-cit-resumen_exc";
    fnCargarTablaComentarioSolo(exc_id,"1",config_comen);

    fnGetDetalleCit(exc_id)
      .then(function(res) {
        let data=res.data;
        if(res[0]=="2"){              
        var cit_fecha = moment(data.cit_fecha).format('DD/MM/YYYY');
        $("#cit_fecha-resumen_exc").val(cit_fecha);
        $("#cit_hora-resumen_exc").val(data.cit_hora);
        $("#cit_puntualidad-resumen_exc").val(data.cit_puntualidad == "-1" ? "" : data.cit_puntualidad);
        $("#cit_estabilidalaboral-resumen_exc").val(data.cit_estabilidalaboral == "-1" ? "" : data.cit_estabilidalaboral);
        $("#tic_nombre-resumen_exc").val(data.tic_nombre);
        $("#med_nombre-resumen_exc").val(data.med_nombre);
        $("#cit_observaciones-resumen_exc").val(data.cit_observaciones == "-1" ? "" : data.cit_observaciones);
        $("#cit_puestosimilar-resumen_exc").val(data.cit_puestosimilar == "-1" ? "" : data.cit_puestosimilar);
        $("#cit_responsabilidad-resumen_exc").val(data.cit_responsabilidad == "-1" ? "" : data.cit_responsabilidad);
        $("#cit_concimientostec-resumen_exc").val(data.cit_concimientostec == "-1" ? "" : data.cit_concimientostec);
        $("#cit_acordeasueldoofrecido-resumen_exc").val(data.cit_acordeasueldoofrecido == "-1" ? "" : data.cit_acordeasueldoofrecido);
        $("#cit_presentacionapariencia-resumen_exc").val(data.cit_presentacionapariencia == "-1"? "" : data.cit_presentacionapariencia);
        $("#cit_disponibilidad-resumen_exc").val(data.cit_disponibilidad == "-1" ? "" : data.cit_disponibilidad);
        $("#cit_proactivo-resumen_exc").val(data.cit_proactivo == "-1" ? "" : data.cit_proactivo);
        }
      })
      .catch(function(error) {
          alert(error.responseText);
      });
  }

  function fnGetResumenPsi(exc_id){
    limpiarTodasLastablasArc();
    scrollTopResModalExc();

    let config_com ={};
    config_com.id_div_contenedor="contenedorcom-psi-resumen_exc";
    fnCargarTablaArchivoSolo(exc_id,"psicometria",config_com);

    limpiarTodasLastablasCom();
    let config_comen ={};
    config_comen.id_div_contenedor="contenedorcomentario-psi-resumen_exc";
    fnCargarTablaComentarioSolo(exc_id,"3",config_comen);

    fnGetDetallePsi(exc_id)
      .then(function(res) {
        let data=res.data;
        if(res[0]=="1"){
          $("#psi_observacion-resumen_exc").val(data.psi_observacion);
          if(data.psi_calificacion!="-1"){
            $("#psi_calificacion-resumen_exc").val(data.psi_calificacion);
          }else{
            $("#psi_calificacion-resumen_exc").val("SIN INFORMACIÓN");
          }
        }else{
        }
      })
      .catch(function(error) {
          alert(error.responseText);
      });
  }

  function fnGetResumeEnt(exc_id){
    limpiarTodasLastablasArc();
    scrollTopResModalExc();

    let config_com ={};
    config_com.id_div_contenedor="contenedorcom-ent-resumen_exc";
    fnCargarTablaArchivoSolo(exc_id,"entrevista",config_com);

    limpiarTodasLastablasCom();
    let config_comen ={};
    config_comen.id_div_contenedor="contenedorcomentario-ent-resumen_exc";
    fnCargarTablaComentarioSolo(exc_id,"5",config_comen);

    fnGetDetalleEnt(exc_id)
      .then(function(res) {
        let data=res.data;
        if(res[0]=="1"){
          $("#ent_fecha-resumen_exc").val(data.ent_fecha);
          $("#ent_hora-resumen_exc").val(data.ent_hora);
        
          $("#ent_seleccionado-resumen_exc").val(data.ent_seleccionado === "2" ? "SI" : data.ent_seleccionado === "1" ? "NO" : "");
        }else{
        }
      })
      .catch(function(error) {
          alert(error.responseText);
    });
    
    fnGetDetalleFac(exc_id)
      .then(function(res){
        $("#vac_estatus-resumen_ex").empty();
        let data_fat=res.data.facturacion;
          if(res["estado"]=="2"){
            $("#fat_sueldo-resumen_exc").val(data_fat.fat_sueldo);
            $("#fat_montofacturar-resumen_exc").val(data_fat.fat_montofacturar);
            $("#fat_reqfactura-resumen_exc").val(data_fat.fat_reqfactura == "1" ? "SI" : data_fat.fat_reqfactura == "0" ? "NO" : "");
            $("#vac_estatus-resumen_ex").html(generateBadgeVacEstatusHTML(data_fat.vac_estatus));
            // Formatear la fecha y hora con Moment.js
            let fechaIngreso = moment(data_fat.fat_fechaingreso);
            if (fechaIngreso.isValid()) {
                let fechaFormateada = fechaIngreso.format('DD/MM/YYYY');
                $("#fat_fechaingreso-resumen_exc").val(fechaFormateada);
            } else {
                $("#fat_fechaingreso-resumen_exc").val('');
            }
            $("#fat_factor-resumen_exc").val(data_fat.fat_factor);
            $("#fat_sueldo-resumen_exc").val(data_fat.fat_sueldo);
        }else{
        }
      })
      .catch(function(error) {
        alert(error.responseText);
        console.log(error);
      });
  }

  function fnGetResumenRef(exc_id){
    scrollTopResModalExc();
    limpiarTodasLastablasArc();
    if ($.fn.DataTable.isDataTable('#dato_empleo_oculto_general_table')) {
        $('#dato_empleo_oculto_general_table').DataTable().clear().destroy();
    }
    if ($.fn.DataTable.isDataTable('#dato_referencialaboral_table')) {
        $('#dato_referencialaboral_table').DataTable().clear().destroy();
    }
    if ($.fn.DataTable.isDataTable('#dato_periodoinactivo_table')) {
        $('#dato_periodoinactivo_table').DataTable().clear().destroy();
    }
    let config_com ={};
    config_com.id_div_contenedor="contenedorcom-sel-resumen_exc";
    fnCargarTablaArchivoSolo(exc_id,"referencias",config_com);

    limpiarTodasLastablasCom();
    let config_comen ={};
    config_comen.id_div_contenedor="contenedorcomentario-ref-resumen_exc";
    fnCargarTablaComentarioSolo(exc_id,"2",config_comen);

    fnGetDetalleSel_onlyget(exc_id)
      .then(function(res) {
        let data=res.data;
        if(res[0]=="1"){
        let config_ref={};
        config_ref.id_div_contenedor="ref_div_contenedor-resumen_exc"
        fnCargarTablaDatoReferenciaLaboral(data.sel_id,config_ref);
        
        let config_epl={};
        config_epl.id_div_contenedor="epl_div_contenedor-resumen_exc"
        fnCargarTablaDatoEmpleosOcultos(data.sel_id,config_epl);

        let config_per={};
        config_per.id_div_contenedor="per_div_contenedor-resumen_exc"
        fnCargarTablaDatoPeriodoInactivo(data.sel_id,config_per);

              $("#sel_empleosocultos-resumen_exc").val(data.sel_empleosocultos == "1" ? "SI" : data.sel_empleosocultos === "0" ? "NO" : "");
              $("#sel_notas-resumen_exc").val(data.sel_notas);                                            
              let calificacionTexto;

              switch (data.sel_calificacion) {
                  case "":
                  case null:
                  case "-1":
                    calificacionTexto = "";

                      //calificacionTexto = "APROPIADO";
                      break;
                  /* case "2":
                      calificacionTexto = "REGULAR";
                      break;
                  case "1":
                      calificacionTexto = "INAPROPIADO";
                      break;*/
                  default:
                      calificacionTexto=data.sel_calificacion
              }
                  $("#sel_calificacion-resumen_exc").val(calificacionTexto);
        }else{
        }
      })
      .catch(function(error) {
          alert(error.responseText);
      });
  }
  function fnGetResumenVac(vac_id){
    let headers =document.getElementsByClassName('class-for-header');

    limpiarActive(headers,'#16345e','.9s',0);
    scrollTopResModalExc();

    fnGetDetalleVac(vac_id)
      .then(function(res) {
        let data=res.data;
        let exc_id=data.exc_id;
        $("#vac_sueldomin-resument_exc").val(data.vac_sueldomin); 
        $("#tpg_nombre-resument_exc").val(data.tpg_nombre); 
        $("#vac_privacidad-resument_exc").val(getTextoPrivacidad(data.vac_privacidad)); 
        $("#vac_garantia-resument_exc").val(limpiarValorBD(data.vac_garantia)); 
        $("#vac_numero-resument_exc").val(data.vac_numero);                                            
        $("#vac_observaciones-resument_exc").val(data.vac_observaciones);   
        $("#vac_id-resument_exc").val(data.vac_id);  
               
        $('#click_emp_id-resument_exc').attr('data-emp-id', data.emp_id);
        ///datos extras de contacto de empresa  inico 
                                                    
        $("#cne_telefono-resument_exc").val(data.cne_tel);  
        $("#cne_correo-resument_exc").val(data.cne_correo); 
        $("#cne_celular-resument_exc").val(data.cne_celular); 
        $("#cne_puesto-resument_exc").val(data.cne_puesto); 
      
        //datos extras de coctacto de empresa fin
        $("#vac_edadmax-resument_exc").val(data.vac_edadmax);                                            
        $("#gra_nombre-resument_exc").val(data.gra_nombre);  
        $("#vac_edadmin-resument_exc").val(data.vac_edadmin);                                            
        $("#vac_nivelidioma-resument_exc").val(data.vac_nivelidioma);                                            
        $("#eje_nombre-resument_exc").val(data.eje_nombre);      
        $("#vac_escolaridadespecificar-resument_exc").val(data.vac_escolaridadespecificar);                                            
      

        $("#vac_sueldomax-resument_exc").val(data.vac_sueldomax);
        $("#vac_otroidioma-resument_exc").val(data.vac_otroidioma);
        $("#vac_observaciones-resument_exc").val(data.vac_observaciones);
        $("#vac_idioma-resument_exc").val(data.vac_idioma);
        $("#vac_horario-resument_exc").val(data.vac_horario);
        $("#vac_habilidad-resument_exc").val(data.vac_habilidad);
        $("#vac_funcionprincipal-resument_exc").val(data.vac_funcionprincipal);
        $("#vac_experiencia-resument_exc").val(data.vac_experiencia);
        $("#vac_conceptotecnico-resument_exc").val(data.vac_conceptotecnico);
        
        $("#vac_conceptotecnico-resument_exc").val(data.vac_conceptotecnico);
        $("#emp_nombre-resument_exc").val(data.emp_nombre);
        $("#esc_nombre-resument_exc").val(data.esc_nombre);
        $("#est_nombre-resument_exc").val(data.est_nombre);
        $("#gen_nombre-resument_exc").val(data.gen_nombre);
        $("#mun_nombre-resument_exc").val(data.mun_nombre);
        $("#tie_nombre-resument_exc").val(data.tie_nombre);
        $("#sex_nombre-resument_exc").val(data.sex_nombre);
        $("#cav_nombre-resument_exc").val(data.cav_nombre);
        $("#tip_nombre-resument_exc").val(data.tip_nombre);
        $("#pre_nombre-resument_exc").val(data.pre_nombre);

        $("#cne_nombre-resument_exc").val(data.cne_nombre_completo);
        $("#cen_nombre-resument_exc").val(data.cen_nombre);
        let inputBoton=` 
          <div class="">
            <a href="#" data-toggle="modal" title="Archivo vacante..." data-target="#archivos_vac-modal" onclick="fnCargarTablaArchivoVac('${data.vac_id}','general')" >
            {{ image("assets/images/small/iconos/icono-arv.png", "alt": "Agregar ", "height": "50", 'class':'boton-plus img-svg-btn-arc-vac-resumen') }}   
            </a>   
          </div>
          `;
        $("#btn_arv-resument_exc").html(inputBoton);
      })
      .catch(function(error) {
          alert(error.responseText);
      });
  }
  function fnGetResumenReportes(exc_id){
    let url = "<?php echo $this->url->get('helper/get_encript_id/') ?>";
    scrollTopResModalExc();

    $.ajax({
      type: "POST",
      url: url+exc_id ,
      success: function(res) {
      let encript=res.data;
      let readarchivo_reporte_ref = "<?php echo $this->url->get('reporte/reporte_referencias_candidato/') ?>";
      readarchivo_reporte_ref+=encript;
      $("#reporte_referencias").attr('src', readarchivo_reporte_ref);

      let readarchivo_reporte_exc = "<?php echo $this->url->get('reporte/reporte_evaluacion_candidato/') ?>";
      readarchivo_reporte_exc+=encript;
      $("#reporte_exc").attr('src', readarchivo_reporte_exc);

      },
      error: function(res) {
        console.log(res.responseText);
      }
    });
  }
  
  function fnGetResumenArc(exc_id){   
        scrollTopResModalExc();

        $(`#visualizador_archivos_resumen_div`).empty();
        let url="<?php echo $this->url->get('archivo/tabla_visualizador_resumen_exc/') ?>";
        url+=exc_id;
        let dataToSend={};
        $.post(url,dataToSend, function(data)
            {
            $(`#visualizador_archivos_resumen_div`).html(data); 

            }).done(function(){
            }).fail(function(res){
        })

        
   
  }

  function fnGetResumenMetricas(exc_id){
    generarMetricas();
  }

</script>
<script>

  function limpiarActive(array_header,backgroundHeaderActive,timeAnimation,index_set)
  {
    let index_select= parseInt(index_set);
    for (let index = 0; index < array_header.length; index++) {
      if(index==index_select)
      {
        array_header[index].style.background=backgroundHeaderActive;
        array_header[index].style.color='white';
        array_header[index].style.fontWeight ='bold';
        array_header[index].style.padding ='8px';
        array_header[index].style.transitionDuration=timeAnimation;
      }
      else{
        array_header[index].style.background='';
        array_header[index].style.color='gray';
        array_header[index].style.fontWeight ='normal';
        array_header[index].style.padding ='8px';
      }
    }  
  }

  function pintarYDespintarHeader(array_header,backgroundHeaderActive,timeAnimation)
  {
    for (let index = 0; index < array_header.length; index++) {
      array_header[index].addEventListener('click',()=>{
        array_header[index].style.background=backgroundHeaderActive;
        array_header[index].style.color='white';
        array_header[index].style.fontWeight ='bold';
        array_header[index].style.padding ='8px';
        array_header[index].style.transitionDuration=timeAnimation;
        for (let index2 = 0; index2 < array_header.length; index2++) {
          if(index!=index2)
          {
            array_header[index2].style.background='';
            array_header[index2].style.color='gray';
            array_header[index2].style.fontWeight ='normal';
            array_header[index2].style.padding ='8px';
          }
        }
      });
    }  
  }
  function siguienteSeccionResumen(identificador,exc_id=0,vac_id=0){
    let headers =document.getElementsByClassName('class-for-header');
    scrollTopResModalExc();
    switch (identificador) {
      case "cita-atras":
      case "vacante-sig":
        $("#link-data-resumen_exc").click();
        $("#link-data-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',0);

        fnGetResumeExcIncio(exc_id,0);
      break;
      case "datospersonales-sig":
      case "referencialaboral-atras":

        $("#link-cit-resumen_exc").click();
        $("#link-cit-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',2);
        fnGetResumeCit(exc_id);
        fnGetResumenArc(exc_id);
      break;
      case "cita-sig":
      case "psicometria-atras":

        $("#link-referencias-resumen_exc").click();
        $("#link-referencias-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',3);
        fnGetResumenRef(exc_id);
      break;
      case "referencialaboral-sig":
      case "entrevista-atras":
        $("#link-psi-resumen_exc").click();
        $("#link-psi-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',4);
        fnGetResumenPsi(exc_id);
      break;

      case "psicometria-sig":

        limpiarActive(headers,'#16345e','.9s',6);

        $("#link-ent-resumen_exc").click();
        $("#link-ent-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',5);

        fnGetResumeEnt(exc_id);
      break;
      case "vacante-atras":
      case "reportess-atras":

        $("#link-ent-resumen_exc").click();
        $("#link-ent-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',5);

        fnGetResumeEnt(exc_id);
      break;

      case "entrevista-atras":
      case "entrevista-sig":
      case "metricas-atras":

        $("#link-reporte-resumen_exc").click();
        $("#link-reporte-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',6);

        fnGetResumenReportes(exc_id);
        
      break;
      case "datospersonales-atras":
      case "metricas-sig": //Logica inicial Te salta a la primer ventana
      //case "entrevista-atras":
        fnGetResumenVac(vac_id);
        $("#link-vac-resumen_exc").click();
        $("#link-vametricas-sigc-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',0);
      break;

      case "reportes-sig":
        $("#link-archivos_exc-resumen_exc").click();
        $("#link-archivos_exc-resumen_exc").trigger("click");
        limpiarActive(headers,'#16345e','.9s',7);
      break;
    }
  }
 
  $( document ).ready(function() {
    let contents =document.getElementsByClassName('content-for-js');
    let headers =document.getElementsByClassName('class-for-header');
    headers[0].style.background='#16345e';
    headers[0].style.color='white';
    headers[0].style.fontWeight ='bold';
    headers[0].style.padding ='15px';
    pintarYDespintarHeader(headers,'#16345e','.9s');
    const element = document.getElementById("ancla_exc_id-resumen_exc");
    element.scrollIntoView();


  }); 
</script>

<script>
  function generarMetricas() { 
     // Datos para la gráfica
    let contadorDeEstatus = {
      "1": 0,
      "2": 0,
      "3": 0,
      "4": 0,
      "5": 0
    };//{"valor_ext_estatus":"cantidad_de_registros"}

    const dataPastel = [
      {
          value: 0,
          color: "#F7464A",
          highlight: "#FF5A5E",
          label: "CITA"
      },
      {
          value: 0,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "REFERENCIAS"
      },
      {
          value: 0,
          color: "#FDB45C",
          highlight: "#FFC870",
          label: "PSICOMETRÍA"
      },
      {
          value: 0,
          color: "#949FB1",
          highlight: "#A8B3C5",
          label: "ENTREVISTA"
      },
      {
          value: 0,
          color: "#4D5360",
          highlight: "#616774",
          label: "AUTORIZACIÓN"
      }
    ];


    //DATA DE CONTROLADOR
    url="<?php echo $this->url->get('expedientecan/metricas/') ?>";
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      async: true, // Configura la solicitud como asíncrona
      success: function(data) {
        try {
          $.each(data, function(index, element) {
            let status = element.exc_estatus;
            if (status in contadorDeEstatus) {
              contadorDeEstatus[status]++;
            }
          });

          dataPastel[0].value = contadorDeEstatus["1"];
          dataPastel[1].value = contadorDeEstatus["2"];
          dataPastel[2].value = contadorDeEstatus["3"];
          dataPastel[3].value = contadorDeEstatus["4"];
          dataPastel[4].value = contadorDeEstatus["5"];
          // Obtener el contexto del lienzo (canvas)
          let ctx = document.getElementById("chart-metricas").getContext("2d");
    
          // Crear la gráfica de pastel
          let myPie = new Chart(ctx).Pie(dataPastel);
        } catch (error) {
        }

        // Aquí puedes realizar cualquier otra operación que necesites con los datos procesados.
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: " + textStatus, errorThrown);
      }
    });
  }
  $(document).ready(function() {
    //generarMetricas();
  });
</script>