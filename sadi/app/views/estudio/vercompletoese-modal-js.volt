
<script type="text/javascript">



    //esta funcion nos sirve para cargar datos  basicos para todos los formularios
     function cargarDatosSeccion_A_ESES(ese_id)
      {
        //limpiamos todos los fomularios
        let form_seccionA=document.getElementById('form_estudio_seccionDatosPersonales');
        form_seccionA.reset();
        fnestudioespecifico(ese_id);
      } 
      function cargarDatosSeccion_B_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',1);

        let form_seccionB=document.getElementById('form_estudio_seccionDatosEscolares');
        form_seccionB.reset();
        $('#dae_primariacertificado').val('-1');
        $('#dae_primariacertificado').trigger('change');

        $('#dae_secundariacertificado').val('-1');
        $('#dae_secundariacertificado').trigger('change');

        $('#dae_comercialcertificado').val('-1');
        $('#dae_comercialcertificado').trigger('change');

        $('#dae_preparatoriacertificado').val('-1');
        $('#dae_preparatoriacertificado').trigger('change');

        $('#dae_licenciaturacertificado').val('-1');
        $('#dae_licenciaturacertificado').trigger('change');

        $('#dae_cedulacertificado').val('-1');
        $('#dae_cedulacertificado').trigger('change');

        $('#dae_otrocertificado').val('-1');
        $('#dae_otrocertificado').trigger('change');

        $('#dae_actualcertificado').val('-1');
        $('#dae_actualcertificado').trigger('change');

        fnDatosEscolaresDetalle(ese_id);
      }

      function cargarDatosSeccion_C_ESES(ese_id)
      {
        
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',2);

        let form_seccionC=document.getElementById('form_estudio_seccionAntecedenteSocial');
        form_seccionC.reset();
        $('#ans_clubdeportivo').val('-1');
        $('#ans_clubdeportivo').trigger('change');

        $('#ans_puestosindical').val('-1');
        $('#ans_puestosindical').trigger('change');

        $('#ans_politico').val('-1');
        $('#ans_politico').trigger('change');

        $('#ans_bebida').val('-1');
        $('#ans_bebida').trigger('change');

        $('#ans_fumar').val('-1');
        $('#ans_fumar').trigger('change');

        $('#ans_calificacion').val('-1');
        $('#ans_calificacion').trigger('change');

        // $('#dae_actualcertificado').val('-1');
        // $('#dae_actualcertificado').trigger('change');

        fnAntecedenteSocialDetalle(ese_id);
      }

  
      function cargarDatosSeccion_D(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',3);
        let form_seccionD=document.getElementById('form_estudio_seccionEstadoGeneralDeSalud');
        form_seccionD.reset();

        $('#ess_calificacion').val('-1');
        $('#ess_calificacion').trigger('change');

        fnEstadoSaludDetalle(ese_id);
      }


      function cargarDatosSeccion_E_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',4);

        fnCargarDatosDelFormularioE(ese_id,$('#dgf_matrimoniopadres'),'dgf_calificacion','aqui_boton_detalles_grupo_familiar');
        $('#dgf_calificacion').val('-1');
        $('#dgf_calificacion').trigger('change');
        $('#aqui_boton_detalles_grupo_familiar').empty();
      }

      function cargarDatosSeccion_F_ESES(ese_id)
      {

        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',5);

         fnCargarDatosDelFormularioF(ese_id,'agf_padrescuentan','agf_padresservicio','agf_conyugecuentan','agf_conyugeservicio','agf_notas','agf_calificacion','agf_id' );
       
         $('#agf_padrescuentan').val('-1');
         $('#agf_padrescuentan').trigger('change');

         $('#agf_conyugecuentan').val('-1');
         $('#agf_conyugecuentan').trigger('change');


         $('#agf_calificacion').val('-1');
         $('#agf_calificacion').trigger('change');
       
      }
      function cargarDatosSeccion_G_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',6);

        fnCargarDatosDelFormularioG(ese_id,'sie_id');
        
        $('#sie_calificacion').val('-1');
        $('#sie_calificacion').trigger('change');

      }


      function cargarDatosSeccion_H_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',7);
        fnCargarDatosDelFormularioH(ese_id);
        $('#bie_calificacion').val('-1');
        $('#bie_calificacion').trigger('change');
      }
      
      function cargarDatosSeccion_I_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',8);
         fnCargarDatosDelFormularioI(ese_id);
        $('#sep_calificacion').val('-1');
        $('#sep_calificacion').trigger('change');
      }
      
      function cargarDatosSeccion_J_ESES(ese_id)
      {
        let headers =document.getElementsByClassName('class-for-header');
        limpiarActive(headers,'#16345e','.9s',9);

         fnCargarDatosDelFormularioJ(ese_id);
        
      }
      

      function cargar_primer_seccion_ESE(ese_id)
      {
        $('#ese_id_ese_actual').text(ese_id);
        $('#home-tab-md-1').trigger('click');

        // cargarDatosSeccion_A_ESES(ese_id);
        let headers =document.getElementsByClassName('class-for-header');
        headers[0].style.background='#16345e';
        headers[0].style.color='white';
        headers[0].style.fontWeight ='bold';
        headers[0].style.padding ='15px';
        limpiarActive(headers,'#16345e','.9s',0);
        

      }


      function cargarDatosSeccion_Finales_ESES(ese_id)
      {
        let form_seccionfinales=document.getElementById('form_estudio_seccionDatosFinales');
        form_seccionfinales.reset();

        fnDatosFinalesDetalle(ese_id);
      }
 
     



</script>