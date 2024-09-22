<script>
    function cargar_primer_seccion_ESE_formato_gabtubos(ese_id)
    {
          //limpiamos todos los fomularios
          $('#ese_id_ese_actual_formato_gabtubos').text(ese_id);
          $('#link_gabtubos').trigger('click');
          let header_link= document.getElementById('link_gabtubos');
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','3.9s',1);

          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          // cargarDatosSeccion_A_ESES_formato_gabtubos(ese_id);

         // fnestudioespecifico_formato_gabtubos(ese_id);
    }
    function cargarDatosSeccion_A_ESES_formato_gabtubos(ese_id)
    {
            let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();

            let form_seccionA=document.getElementById('form_estudio_seccionDatosPersonales_formato_gabtubos');
            form_seccionA.reset();
            fnestudioespecifico_formato_gabtubos(ese_id);
    }
    function cargarDatosSeccion_B_ESES_formato_gabtubos(ese_id)
    {

            let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();

          let header_link= document.getElementById('link_seccion_datos_escolares_gabtubos');
          let headers =document.getElementsByClassName('class-for-header');
          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
  
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          let form_seccionB=document.getElementById('form_estudio_seccionDatosEscolares_formato_gabtubos');
          form_seccionB.reset();
          $('#dae_primariacertificado_formato_gabtubos').val('-1');
          $('#dae_primariacertificado_formato_gabtubos').trigger('change');

          $('#dae_secundariacertificado_formato_gabtubos').val('-1');
          $('#dae_secundariacertificado_formato_gabtubos').trigger('change');

          $('#dae_comercialcertificado_formato_gabtubos').val('-1');
          $('#dae_comercialcertificado_formato_gabtubos').trigger('change');

          $('#dae_preparatoriacertificado_formato_gabtubos').val('-1');
          $('#dae_preparatoriacertificado_formato_gabtubos').trigger('change');

          $('#dae_licenciaturacertificado_formato_gabtubos').val('-1');
          $('#dae_licenciaturacertificado_formato_gabtubos').trigger('change');

          $('#dae_cedulacertificado_formato_gabtubos').val('-1');
          $('#dae_cedulacertificado_formato_gabtubos').trigger('change');

          $('#dae_otrocertificado_formato_gabtubos').val('-1');
          $('#dae_otrocertificado').trigger('change');

          $('#dae_actualcertificado_formato_gabtubos').val('-1');
          $('#dae_actualcertificado_formato_gabtubos').trigger('change');

          fnDatosEscolaresDetalle_formato_gabtubos(ese_id);
    }
    function cargarDatosSeccion_C_ESES_formato_gabtubos(ese_id)
    {
            let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();

          let header_link= document.getElementById('link_seccion_dato_grupo_familiar_formato_gabtubos');
          let headers =document.getElementsByClassName('class-for-header');

          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';

          /*
          *lA FUNCCION SE ENCUENTRA EN CARPETA SECCIONAL LABORAL/
          */
          fnCargarDatosDelFormularioC_formato_gabtubos(ese_id);
          $('#dgf_calificacion').val('-1');
          $('#dgf_calificacion').trigger('change');
          $('#aqui_boton_detalles_grupo_familiar').empty();
          

    }
    function cargarDatosSeccion_D_ESES_formato_gabtubos(ese_id)
    {     
            let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();

         let header_link= document.getElementById('link_seccion_ref_personales_formato_gabtubos');
         let headers =document.getElementsByClassName('class-for-header');

          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
  
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';

          fnCargarDatosDelFormularioD_formato_gabtubos(ese_id);
          $('#sep_calificacion_formato_gabtubos').val('-1');
          $('#sep_calificacion_formato_gabtubos').trigger('change');

    }
    function cargarDatosSeccion_E_ESES_formato_gabtubos(ese_id)
    {
            let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();

          let header_link= document.getElementById('link_seccion_ref_laborales_formato_gabtubos');
          let headers =document.getElementsByClassName('class-for-header');

          // pintarYDespintarHeader(headers,'#16345e','.9s');    
          limpiarActive(headers,'#16345e','3.9s',1);
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';

       //la funcion se encuntra en el archivo  ./seccionlaboral/formato-ese-gabtubos
      fnCargarDatosDelFormularioE_formato_gabtubos(ese_id);

    }
    function cargarDatosSeccion_F_ESES_formato_gabtubos(ese_id)
    {
              let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabtubos_titulo');
            titulo_cabezera.scrollIntoView();
      
      let form_seccionfinales=document.getElementById('form_estudio_seccionDatosFinales_formato_gabtubos');
      form_seccionfinales.reset();
      let header_link= document.getElementById('link_seccion_datos_finales_formato_gabtubos');
      let headers =document.getElementsByClassName('class-for-header');
      limpiarActive(headers,'#16345e','.9s',1);
      header_link.style.background='#16345e';
      header_link.style.color='white';
      header_link.style.fontWeight ='bold';
      header_link.style.padding ='9.5px';

      fnDatosFinalesDetalle_formato_gabtubos(ese_id);
    }
</script>
    