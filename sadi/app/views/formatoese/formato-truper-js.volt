<script>
    function cargar_primer_seccion_ESE_formato_ese_truper(ese_id)
    {
          //limpiamos todos los fomularios
          
          $('#ese_id_ese_actual_formato_ese_truper').text(ese_id);          
           $('#link-ese-truper').trigger('click');
          let header_link= document.getElementById('link-ese-truper');
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',1);
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          // fnestudioespecifico_formato_gabencognv(ese_id);
          // cargarDatosSeccion_A_ESES_formato_gabencognv(ese_id);
   
    }
    function cargarDatosSeccion_A_ESES_formato_ese_truper(ese_id){
        let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
        titulo_cabezera.scrollIntoView();
        let form_seccionA=document.getElementById('form_estudio_seccionDatosPersonales_formato_ese_truper');
        form_seccionA.reset();

        fnGetDatosPersonalesTrupper(ese_id);
         $('#ese_formato_ese_truper_ese_id').val(ese_id);
    
    }

    function cargarDatosSeccion_B_ESES_formato_truper(ese_id){
        let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
        titulo_cabezera.scrollIntoView();
        let form_seccionB=document.getElementById('form_estudio_seccionDatosvivienda_formato_ese_truper');

        let header_link= document.getElementById('link_domicilio_formato_truper');
        let headers =document.getElementsByClassName('class-for-header');
          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
  
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          
        form_seccionB.reset();

        $('#ese_dav_id').val(ese_id);
        fnGetDatosVivienda(ese_id);
    }

    function cargarDatosSeccion_C_ESES_formato_truper(ese_id){

        let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
        titulo_cabezera.scrollIntoView();
        let form_seccionC=document.getElementById('form_estudio_seccionDatosEscolares_formato_ese_truper');

        let header_link= document.getElementById('link_seccion_datos_escolares_truper');
        let headers =document.getElementsByClassName('class-for-header');
          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
  
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          
          form_seccionC.reset();

        $('#ese_dav_id').val(ese_id);
        fnDatosEscolaresDetalle_formato_truper(ese_id);

    }
    function cargarDatosSeccion_D_ESES_formato_truper(ese_id){

        let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
        titulo_cabezera.scrollIntoView();
        let form_seccion=document.getElementById('form_estudio_seccionEstadoGeneralDeSalud_formato_truper');

        let header_link= document.getElementById('link_seccion_datos_medicos_truper');
        let headers =document.getElementsByClassName('class-for-header');
          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
  
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          
          form_seccion.reset();

        $('#ese_dav_id').val(ese_id);
        fnEstadoSaludDetalleFormatoTruper(ese_id);

    }

    function cargarDatosSeccion_E_ESES_formato_truper(ese_id){

      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionDatosFamiliares_formato_ese_truper');

      let header_link= document.getElementById('link_seccion_datos_familiares');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

      $('#dgf_ese_id-formato-truper').val(ese_id);
      fnCargarDatosDelFormularioE_formato_truper(ese_id);

  }

  function cargarDatosSeccion_F_ESES_formato_truper(ese_id){

      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionDatosComprobatorios_formato_ese_truper');

      let header_link= document.getElementById('link_seccion_datos_comprobatorios_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

      fnCargarDatosComprobatorios_especifico_adapatable_formato_truper(ese_id);

  }


  function cargarDatosSeccion_G_ESES_formato_truper(ese_id){

      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionSituacionEconomica_truper');

      let header_link= document.getElementById('link_seccion_datos_financieros_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

        fnCargarDatosDelFormularioGFormatoTruper(ese_id);

  }


  function cargarDatosSeccion_H_ESES_formato_truper(ese_id){
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionBienesInmuebles_truper');

      let header_link= document.getElementById('link_seccion_datos_bienes_inmuebles_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

    fnAntecedenteSocialDetalleFormatoTruper(ese_id);

}

function cargarDatosSeccion_I_ESES_formato_truper(ese_id){
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionReferenciasLaborales_formato_truper');

      let header_link= document.getElementById('link_seccion_ref_laborales_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

    fnCargarDatosDelFormularioI_formato_truper(ese_id);

}
  function cargarDatosSeccion_J_ESES_formato_truper(ese_id){

      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionEvaluacionFinal_formato_ese_truper');

      let header_link= document.getElementById('link_seccion_datos_referencia_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

    fnCargarDatosDelFormularioJformatoTruper(ese_id);

  }

function cargarDatosSeccion_FINAL_ESES_formato_truper(ese_id){
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionEvaluacionFinal_formato_ese_truper');

      let header_link= document.getElementById('link_seccion_datos_evaluacion_final_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

    fnCargarDatosDelFormularioEvalucionFinal_formato_truper(ese_id);

}

function cargarDatosSeccion_FINAL_ESE_ESES_formato_truper(ese_id){
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_ese_truper');
      titulo_cabezera.scrollIntoView();
      let form_seccion=document.getElementById('form_estudio_seccionDatosFinalesFormatoTruper');

      let header_link= document.getElementById('link_seccion_datos_finales_truper');
      let headers =document.getElementsByClassName('class-for-header');
        // pintarYDespintarHeader(headers,'#16345e','.9s');    
        limpiarActive(headers,'#16345e','3.9s',1);

        header_link.style.background='#16345e';
        header_link.style.color='white';
        header_link.style.fontWeight ='bold';
        header_link.style.padding ='9.5px';
        
        form_seccion.reset();

        fnDatosFinalesDetalleFormatoTruper(ese_id);

}
   

  
</script>
    