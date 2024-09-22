<script type="text/javascript">
 


    function fnestudioespecifico_formato_gabencognv(ese_id)
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
                        
                      //  console.log(data.);
                           let ese_familiar_empresa_value=(data.ese_familiarempresa==null || data.ese_familiarempresa==-1) ?-1 :data.ese_familiarempresa;
                          $('#ese_formato_gabencognv_familiarempresa').val(ese_familiar_empresa_value);
                           $('#ese_formato_gabencognv_familiarempresa').trigger('change');

                            $('#ese_nombrecompleto_actual_formato_gabencognv').text(data.ese_nombre+' '+data.ese_primerapellido+' '+data.ese_segundoapellido);
                            fnGetAliasEmpresa(data.emp_id, $('#ese_aliasempresa_actual_formato_gabencognv'))

                          
                            $('#ese_formato_gabencognv_ese_nombre_input').val(data.ese_nombre);

    
                            $('#ese_formato_gabencognv_ese_primerapellido_input').val(data.ese_primerapellido);
                            $('#ese_formato_gabencognv_ese_segundoapellido_input').val(data.ese_segundoapellido);
                       

                            $('input[name="ese[ese_fechanacimiento]"]').val(data.ese_fechanacimiento);
                            if(data.ese_fechanacimiento!=null)
                            {                           

                               $('input[id="ese_formato_gabencognv[ese_edad]"]').val(calcularEdad(data.ese_fechanacimiento));

                            }
                            $('#ese_formato_gabencognv_ese_id').val(data.ese_id);
                            $('#ese_formato_gabencognv_ese_lugarnacimiento').val(data.ese_lugarnacimiento);
                        
                            $('select[id="ese_formato_gabencognv[ese_sexo]"]').val((data.ese_sexo==-1 ||data.ese_sexo == null?-1:data.ese_sexo));
                            $('select[id="ese_formato_gabencognv[ese_sexo]"]').trigger('change');
                            $('#cop_ese_id_formato_gabencognv').val(data.ese_id);

  
  
                            $('input[id="ese_formato_gabencognv[ese_calle]"]').val(data.ese_calle);
                            $('input[id="ese_formato_gabencognv[ese_numint]"]').val(data.ese_numint);
                            $('input[id="ese_formato_gabencognv[ese_numext]"]').val(data.ese_numext);
                            $('input[id="ese_formato_gabencognv[ese_colonia]"]').val(data.ese_colonia);
                            $('input[id="ese_formato_gabencognv[ese_codpostal]"]').val(data.ese_codpostal);
                            $('input[id="ese_formato_gabencognv[ese_celular]"]').val(data.ese_celular);
                            $('input[id="ese_formato_gabencognv[ese_telefono]"]').val(data.ese_telefono);
                            $('input[id="ese_formato_gabencognv[ese_entrecalles]"]').val(data.ese_entrecalles);
                            $('input[id="ese_formato_gabencognv[ese_puesto]"]').val(data.ese_puesto);
                            $('input[id="ese_formato_gabencognv_ese_nss"]').val(data.ese_nss);
                            $('input[id="ese_formato_gabencognv_ese_curp"]').val(data.ese_curp);

                            // fnCargarDatosComprobatorios_especifico_adapatable_formato_gabencognv(ese_id);
                           let id_cargado_nivel_estudio =(data.niv_id==null) ?-1 :data.niv_id;
  
                            fnnivelestudios_adapatable( $('select[id="ese_formato_gabencognv[niv_id_eses]"]'),id_cargado_nivel_estudio);
  
                            let id_cargado_estado_civil =(data.esc_id==null) ?-1 :data.esc_id;
                            fnestadocivils_adaptable($('select[id="ese_formato_gabencognv[esc_id_eses]"]'),id_cargado_estado_civil);
  
                            let id_cargado_estado =(data.est_id==null) ?-1 :data.est_id;
                            let id_cargado_mun =(data.mun_id==null) ?-1 :data.mun_id;
  
                            // fnestado_especifico(id_cargado_estado,$('#est_id_nombre_formato_gabencognv'));
                            // fnmunicipio_especifico(id_cargado_mun,$('#mun_id_nombre_formato_gabencognv'),id_cargado_estado);


                            fnestados_estados_adaptable(id_cargado_estado,$('#est_id_nombre_formato_gabencognv'));
                            fnmunicipios_adaptable($('#mun_id_nombre_formato_gabencognv'),id_cargado_estado,id_cargado_mun);
                                    
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