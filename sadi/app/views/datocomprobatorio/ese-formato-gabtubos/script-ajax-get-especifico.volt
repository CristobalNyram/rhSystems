<script type="text/javascript">
 


    function fnestudioespecifico_formato_gabtubos(ese_id)
    {
           let url_enviar="<?php echo $this->url->get('estudio/get_ajax_datos_estudio_especifico/') ?>";
            // let $nivel_estudios =ese_id
  
            $.ajax({
                type: "POST",
                url: url_enviar+ese_id,
                  
                success: function(data)
                {
    
                   
                      // Agregar nuevos sub-departamentos
                      if (data.length==0) {
  
                       // alertify.alert('DATOS','No se pudieron cargar los datos, vuelve a intentar recargar la página');
  
  
  
                      }else{
                        
                      //  console.log(data);
                       $('#ese_formato_gabetubos_ese_lugarnacimiento').val(data.ese_lugarnacimiento);

                       $('#ese_nombrecompleto_actual_formato_gabtubos').text(data.ese_nombre+' '+data.ese_primerapellido+' '+data.ese_segundoapellido);


                       fnGetAliasEmpresa(data.emp_id, $('#ese_aliasempresa_actual_formato_gabtubos'))

                       $('#ese_nombrecompleto_actual').text(data.ese_nombre+' '+data.ese_primerapellido+' '+data.ese_segundoapellido);
                       
                       $('#ese_formato_gabetubos_ese_nombre_input').val(data.ese_nombre);
                       $('#ese_formato_gabetubos_ese_primerapellido_input').val(data.ese_primerapellido);
                       $('#ese_formato_gabetubos_ese_segundoapellido_input').val(data.ese_segundoapellido);


                       $('#ese_nombrecompleto_actual_formato_gabtubos_titulo').text($('#ese_nombrecompleto_actual_formato_gabtubos').text());
                            $('input[name="ese[ese_fechanacimiento]"]').val(data.ese_fechanacimiento);
                            
                            if(data.ese_fechanacimiento!=null)
                            {                           

                               $('input[id="ese_formato_gabtubos[ese_edad]"]').val(calcularEdad(data.ese_fechanacimiento));

                            }
                        
                            $('select[id="ese_formato_gabtubos[ese_sexo]"]').val((data.ese_sexo==-1 ||data.ese_sexo == null?-1:data.ese_sexo));
                            $('select[id="ese_formato_gabtubos[ese_sexo]"]').trigger('change');
                            $('#cop_ese_id_formato_gabtubos').val(data.ese_id);

  
  
                            $('input[id="ese_formato_gabtubos[ese_calle]"]').val(data.ese_calle);
                            $('input[id="ese_formato_gabtubos[ese_numint]"]').val(data.ese_numint);
                            $('input[id="ese_formato_gabtubos[ese_numext]"]').val(data.ese_numext);
                            $('input[id="ese_formato_gabtubos[ese_colonia]"]').val(data.ese_colonia);
                            $('input[id="ese_formato_gabtubos[ese_codpostal]"]').val(data.ese_codpostal);
                            $('input[id="ese_formato_gabtubos[ese_celular]"]').val(data.ese_celular);
                            $('input[id="ese_formato_gabtubos[ese_telefono]"]').val(data.ese_telefono);
                            $('input[id="ese_formato_gabtubos[ese_entrecalles]"]').val(data.ese_entrecalles);
                            $('input[id="ese_formato_gabtubos[ese_puesto]"]').val(data.ese_puesto);
                            $('input[name="cop_imssfolio"]').val(data.ese_nss);
                            fnCargarDatosComprobatorios_especifico_adapatable_formato_gabtubos(ese_id);
                           let id_cargado_nivel_estudio =(data.niv_id==null) ?-1 :data.niv_id;
  
                            fnnivelestudios_adapatable( $('select[id="ese_formato_gabtubos[niv_id_eses]"]'),id_cargado_nivel_estudio);
  
                            let id_cargado_estado_civil =(data.esc_id==null) ?-1 :data.esc_id;
                            fnestadocivils_adaptable($('select[id="ese_formato_gabtubos[esc_id_eses]"]'),id_cargado_estado_civil);
  
                            let id_cargado_estado =(data.est_id==null) ?-1 :data.est_id;
                            let id_cargado_mun =(data.mun_id==null) ?-1 :data.mun_id;
  
                    
                            
                            fnestados_estados_adaptable(id_cargado_estado,$('#est_id_nombre_formato_gabtubos'));
                            fnmunicipios_adaptable($('#mun_id_nombre_formato_gabtubos'),id_cargado_estado,id_cargado_mun);       
                      }
                    
  
                },
                error: function(res)
                {
                  alert();
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });
    }
  
  </script>