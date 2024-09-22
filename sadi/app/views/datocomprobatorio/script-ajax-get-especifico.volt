<script type="text/javascript">
 


    function fnestudioespecifico(ese_id)
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
  
                        alertify.alert('DATOS','No se pudieron cargar los datos, vuelve a intentar recargar la página');
  
  
  
                      }else{
                            $('#ese_nombrecompleto_actual').text(data.ese_nombre+' '+data.ese_primerapellido+' '+data.ese_segundoapellido);
                            fnGetAliasEmpresa(data.emp_id, $('#ese_aliasempresa_actual'))


                            $('#ese_nombrecompleto_ese_nombre').val(data.ese_nombre);
                            $('#ese_nombrecompleto_ese_primerapellido').val(data.ese_primerapellido);
                            $('#ese_nombrecompleto_ese_segundoapellido').val(data.ese_segundoapellido);


                            $('input[name="ese[ese_fechanacimiento]"]').val(data.ese_fechanacimiento);
                            if(data.ese_fechanacimiento!=null)
                            {                           

                               $('input[name="ese[ese_edad]"]').val(calcularEdad(data.ese_fechanacimiento));

                            }
                        
                            $('select[name="ese[ese_sexo]"]').val((data.ese_sexo==-1 ||data.ese_sexo == null?-1:data.ese_sexo));
                            $('select[name="ese[ese_sexo]"]').trigger('change');
                            $('#cop_ese_id').val(data.ese_id);

  
  
                            $('input[name="ese[ese_calle]"]').val(data.ese_calle);
                            $('input[name="ese[ese_numint]"]').val(data.ese_numint);
                            $('input[name="ese[ese_numext]"]').val(data.ese_numext);
                            $('input[name="ese[ese_colonia]"]').val(data.ese_colonia);
                            $('input[name="ese[ese_codpostal]"]').val(data.ese_codpostal);
                            $('input[name="ese[ese_celular]"]').val(data.ese_celular);
                            $('input[name="ese[ese_telefono]"]').val(data.ese_telefono);
                            $('input[name="ese[ese_entrecalles]"]').val(data.ese_entrecalles);
                            $('input[name="ese[ese_puesto]"]').val(data.ese_puesto);
                            $('input[name="ese[ese_lugarnacimiento]"]').val(data.ese_lugarnacimiento);
                            $('#cop_curpfolio').val(data.ese_curp);
  
                            let id_cargado_nivel_estudio =(data.niv_id==null) ?-1 :data.niv_id;
  
                            fnnivelestudios_adapatable( $('select[name="ese[niv_id_eses]"]'),id_cargado_nivel_estudio);
  
                            let id_cargado_estado_civil =(data.esc_id==null) ?-1 :data.esc_id;
                            fnestadocivils_adaptable($('select[name="ese[esc_id_eses]"]'),id_cargado_estado_civil);
  
                            let id_cargado_estado =(data.est_id==null) ?-1 :data.est_id;
                            let id_cargado_mun =(data.mun_id==null) ?-1 :data.mun_id;
  
                            fnestados_estados_adaptable(id_cargado_estado,$('#est_id_nombre_ver_completo'));
                            fnmunicipios_adaptable($('#mun_id_nombre_ver_completo'),id_cargado_estado,id_cargado_mun);


                            $('input[name="cop_imssfolio"]').val(data.ese_nss);
  
                            fnCargarDatosComprobatorios_especifico_adapatable(ese_id,$('input[name="cop_nacimientofecha"]'),$('input[name="cop_nacimientolugar"]'),$('input[name="cop_nacimientofolio"]'),
                            $('input[name="cop_matrimoniofecha"]'),$('input[name="cop_matrimoniolugar"]'),$('input[name="cop_matrimoniofolio"]'),
                            $('input[name="cop_conyugefecha"]'),$('input[name="cop_conyugelugar"]'),$('input[name="cop_conyugefolio"]'),
                            $('input[name="cop_nacimientohijosfecha"]'),$('input[name="cop_nacimientohijoslugar"]'),$('input[name="cop_nacimientohijosfolio"]'),
                            $('input[name="cop_comprobantedomiciliofecha"]'),$('input[name="cop_comprobantedomiciliolugar"]'),$('input[name="cop_comprobantedomiciliofolio"]'),
                            $('input[name="cop_credencialelectorfecha"]'),$('input[name="cop_credencialelectorlugar"]'),$('input[name="cop_credencialelectorfolio"]'),
                            $('input[name="cop_curpfecha"]'),$('input[name="cop_curplugar"]'),$('input[name="cop_curpfolio"]'),
                            $('input[name="cop_imssfecha"]'),$('input[name="cop_imsslugar"]'),$('input[name="cop_imssfolio"]'),
                            $('input[name="cop_retencionfecha"]'),$('input[name="cop_retencionlugar"]'),$('input[name="cop_retencionfolio"]'),
                            $('input[name="cop_rfcfecha"]'),$('input[name="cop_rfclugar"]'),$('input[name="cop_rfcfolio"]'),
                            $('input[name="cop_cartillafecha"]'),$('input[name="cop_cartillalugar"]'),$('input[name="cop_cartillafolio"]'),
                            $('input[name="cop_licenciafecha"]'),$('input[name="cop_licencialugar"]'),$('input[name="cop_licenciafolio"]'),
                            $('input[name="cop_migratoriafecha"]'),$('input[name="cop_migratorialugar"]'),$('input[name="cop_migratoriafolio"]'),
                            $('input[name="cop_calificacion"]')
  
                            );
                      }
                    
  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });
    }
  
  </script>