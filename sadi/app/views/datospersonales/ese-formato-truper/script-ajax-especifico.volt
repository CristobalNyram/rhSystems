<script type="text/javascript">
 


    function fnGetDatosPersonalesTrupper(ese_id)
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


                        $("#formato_truper_ese_nombre").val(data.ese_nombre);
                        $("#formato_truper_ese_primerapellido").val(data.ese_primerapellido);
                        $("#formato_truper_ese_segundoapellido").val(data.ese_segundoapellido);
                        $("#formato_truper_ese_puesto").val(data.ese_puesto);

                        let nombrecompleto=`${data.ese_nombre}  ${data.ese_primerapellido} ${data.ese_segundoapellido}`;
                        $('#ese_nombrecompleto_actual_formato_ese_truper').text(nombrecompleto);


                        fnGetAliasEmpresa(data.emp_id, $('#ese_aliasempresa_actual_formato_ese_truper'))
                     

                        $("#formato_truper_ese_area").val(data.ese_area);
                        $('#formato_truper_ese_lugarnacimiento').val(data.ese_lugarnacimiento);

                        $('#formato_truper_ese_lugarnacimiento').val(data.ese_lugarnacimiento);
                        $('#formato_truper_ese_edad').val( calcularEdad(data.ese_fechanacimiento));

                // calcularEdadformato_truper_ese_edad');


                        $('#formato_truper_ese_fechanacimiento').val(data.ese_fechanacimiento);
                        // $('#formato_truper_ese_sexo').val(data.ese_sexo);
                        // $('#formato_truper_ese_segundoapellido').val(data.ese_nombre);
                        $('#formato_truper_ese_calle').val(data.ese_calle);
                        $('#formato_truper_ese_numint').val(data.ese_numint);
                        $('#formato_truper_ese_numext').val(data.ese_numext);
                        $('#formato_truper_ese_colonia').val(data.ese_colonia);
                        $('#formato_truper_ese_callenorte').val(data.ese_callenorte);
                        $('#formato_truper_ese_callesur').val(data.ese_callesur);
                       

                       /* $('#formato_truper_ese_curp').val(data.ese_curp);
                        $('#formato_truper_ese_nss').val(data.ese_nss);
*/
                     

                        $('#formato_truper_ese_calleeste').val(data.ese_calleeste);
                        $('#formato_truper_ese_calleoeste').val(data.ese_calleoeste);
                        escribir_nombre_calle_norte(data.ese_callenorte);
                        escribir_nombre_calle_sur(data.ese_callesur);
                        escribir_nombre_calle_este(data.ese_calleeste);
                        escribir_nombre_calle_oeste(data.ese_calleoeste);
                        

                    /*    let id_calificacion_ese =(data.ese_calificacion==null) ?-1 :data.ese_calificacion;
                        $('#formato_truper_ese_calificacion').val(id_calificacion_ese);
                        $('#formato_truper_ese_calificacion').trigger('change');*/


                        
                        if(data.ese_fechavisita!=null ||  data.ese_fechavisita!=""){
                          $('#formato_truper_ese_fechavisita').val(data.ese_fechavisita);

                        }
                       // console.log(data.ese_fechavisita);
                        // $('#formato_truper_ese_calleoeste').val();
                        if(data.ese_ubicacioncasa!=''||data.ese_ubicacioncasa!=null ){

                          $('#formato_truper_ese_ubicacioncasa_'+data.ese_ubicacioncasa).prop("checked", true);

                        }
                        
                        // $('#formato_truper_est_id').val(data.est_id);
                        // $('#formato_truper_mun_id').val(data.mun_id);

                        let id_cargado_estado =(data.est_id==null) ?-1 :data.est_id;
                        let id_cargado_mun =(data.mun_id==null) ?-1 :data.mun_id;
                        let id_cargado_estado_civil =(data.esc_id==null) ?-1 :data.esc_id;
                        

                        $('#formato_truper_ese_sexo').val((data.ese_sexo==-1 ||data.ese_sexo == null?-1:data.ese_sexo));
                        $('#formato_truper_ese_sexo').trigger('change');
  
                            fnestadocivils_adaptable($('select[id="formato_truper_esc_id_eses"]'),id_cargado_estado_civil,1);
                            fnestados_estados_adaptable(id_cargado_estado,$('#formato_truper_est_id'));
                            fnmunicipios_adaptable($('#formato_truper_mun_id'),id_cargado_estado,id_cargado_mun);

                        $('#formato_truper_ese_codpostal').val(data.ese_codpostal);
                        $('#formato_truper_ese_entrecalles').val(data.ese_entrecalles);
                        $('#formato_truper_ese_referenciaubicacion').val(data.ese_referenciaubicacion);
                        $('#formato_truper_ese_celular').val(data.ese_celular);
                        $('#formato_truper_ese_telefono').val(data.ese_telefono);
                        $('#formato_truper_ese_telefonorecado').val(data.ese_telefonorecado);
            
                      }
                    
  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });
    }
  
  </script>