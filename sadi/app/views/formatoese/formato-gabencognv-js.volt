<script>
    function cargar_primer_seccion_ESE_formato_gabencognv(ese_id)
    {
          //limpiamos todos los fomularios
          
          $('#ese_id_ese_actual_formato_gabencognv').text(ese_id);          
           $('#link-gabencognv').trigger('click');
          let header_link= document.getElementById('link-gabencognv');
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',1);
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';
          // fnestudioespecifico_formato_gabencognv(ese_id);
          // cargarDatosSeccion_A_ESES_formato_gabencognv(ese_id);
   
    }
    function cargarDatosSeccion_A_ESES_formato_gabencognv(ese_id)
    {
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabencognv');
            titulo_cabezera.scrollIntoView();
        let form_seccionA=document.getElementById('form_estudio_seccionDatosPersonales_formato_gabencognv');
        form_seccionA.reset();
        fnestudioespecifico_formato_gabencognv(ese_id);
    
    }
    function cargarDatosSeccion_B_ESES_formato_gabencognv(ese_id)
    {
           let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabencognv');
          titulo_cabezera.scrollIntoView();
          
          let header_link= document.getElementById('link_seccion_ref_laborales_gabencognv');
          let headers =document.getElementsByClassName('class-for-header');
          limpiarActive(headers,'#16345e','.9s',1);
          header_link.style.background='#16345e';
          header_link.style.color='white';
          header_link.style.fontWeight ='bold';
          header_link.style.padding ='9.5px';

        fnestudioespecifico_formato_gabencognv(ese_id);
     
         /*
          *lA FUNCCION SE ENCUENTRA EN CARPETA SECCIONAL LABORAL/
          */
        fnCargarDatosDelFormularioB_formato_gabencognv(ese_id);

    }
    function cargarDatosSeccion_C_ESES_formato_gabencognv(ese_id)
    {
      let titulo_cabezera=document.getElementById('ese_nombrecompleto_actual_formato_gabencognv');
      titulo_cabezera.scrollIntoView();
      
      let form_seccionfinales=document.getElementById('form_estudio_seccionDatosFinales_formato_gabencognv');
      form_seccionfinales.reset();
      let header_link= document.getElementById('link_seccion_datos_finales_gabencognv');
      let headers =document.getElementsByClassName('class-for-header');
      limpiarActive(headers,'#16345e','.9s',1);
      header_link.style.background='#16345e';
      header_link.style.color='white';
      header_link.style.fontWeight ='bold';
      header_link.style.padding ='9.5px';
      fnDatosFinalesDetalle_formato_gabencognv(ese_id);
    }

   
</script>
    