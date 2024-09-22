{% include "/datovivienda/script-ajax-selects-dinamicos.volt" %}

<script type="text/javascript">
 


    function fnGetDatosVivienda(ese_id)
    {
           let url_enviar="<?php echo $this->url->get('datovivienda/ajax_get_detalle/') ?>";
            // let $nivel_estudios =ese_id
  
            $.ajax({
                type: "POST",
                url: url_enviar+ese_id,
                  
                success: function(res)
                {
                       let data=res['data'];
                       let estatus=res['estatus'];
                       
             
                      // Agregar nuevos sub-departamentos
                        if (estatus=='-2') {

                        fnCrearAutomaticoDatoViviendaFormatoTruper(ese_id);
  
                        // alertify.alert('DATOS','No se pudieron cargar los datos, vuelve a intentar recargar la página');
  
                      }else{

                        
                        fngetDataSelectsDinamicosDatosVivienda(
                          antiguedad_value_id= (data.dav_antiguedad==-1 ||data.dav_antiguedad == null?-1:data.dav_antiguedad) ,
                          antiguedad_select_input=$('#dav_antiguedad'),
                          zona_value_id=(data.dav_zona==-1 ||data.dav_zona == null?-1:data.dav_zona),
                          zona_select_input=$('#dav_zona'),
                          clase_social_value_id=(data.dav_clasesocial==-1 ||data.dav_clasesocial == null?-1:data.dav_clasesocial) ,
                          clase_social_select_input=$('#dav_clasesocial'),
                          vivienda_value_id=(data.dav_vivienda==-1 ||data.dav_vivienda == null?-1:data.dav_vivienda),
                          vivienda_select_input=$('#dav_vivienda'),
                          formato_vivienda_value_id=(data.dav_formatovivienda==-1 ||data.dav_formatovivienda == null?-1:data.dav_formatovivienda),
                          formato_vivienda_select_input=$('#dav_formatovivienda'),
                          niveles_value_id=(data.dav_nivel==-1 ||data.dav_nivel == null?-1:data.dav_nivel),
                          niveles_select_input=$('#dav_nivel'),
                          apariencia_value_id=(data.dav_apariencia==-1 ||data.dav_apariencia == null?-1:data.dav_apariencia),
                          apariencia_select_input=$('#dav_apariencia'),
                          estadomobiliario_value_id=(data.dav_estadomobiliario==-1 ||data.dav_estadomobiliario == null?-1:data.dav_estadomobiliario),
                          estadomobiliario_select_input=$('#dav_estadomobiliario'),
                          inmueble_value_id=(data.dav_inmueble==-1 ||data.dav_inmueble == null?-1:data.dav_inmueble),
                          inmueble_select_input=$('#dav_inmueble'),
                        );
                        fnCargarDatogViviendaAnteriorDetallesFormatoTruper(data.dav_id);

                        $('#dav_salatruper').val((data.dav_sala==-1 ||data.dav_sala == null?-1:data.dav_sala));
                        $('#dav_salatruper').trigger('change');

                       // $('#dav_sala').val((data.dav_sala==-1 ||data.dav_sala == null?-1:data.dav_sala));
                        //$('#dav_sala').trigger('change');

                        $('#dav_comedor').val((data.dav_comedor==-1 ||data.dav_comedor == null?-1:data.dav_comedor));
                        $('#dav_comedor').trigger('change');

                        $('#dav_estudio').val((data.dav_estudio==-1 ||data.dav_estudio == null?-1:data.dav_estudio));
                        $('#dav_estudio').trigger('change');


                        $('#dav_salajuego').val((data.dav_salajuego==-1 ||data.dav_salajuego == null?-1:data.dav_salajuego));
                        $('#dav_salajuego').trigger('change');

                        $('#dav_terraza').val((data.dav_terraza==-1 ||data.dav_terraza == null?-1:data.dav_terraza));
                        $('#dav_terraza').trigger('change');


                        $('#dav_cualavado').val((data.dav_cualavado==-1 ||data.dav_cualavado == null?-1:data.dav_cualavado));
                        $('#dav_cualavado').trigger('change');

                        
                        $('#dav_cuaservicio').val((data.dav_cuaservicio==-1 ||data.dav_cuaservicio == null?-1:data.dav_cuaservicio));
                        $('#dav_cuaservicio').trigger('change');

                        $('#dav_garage').val((data.dav_garage==-1 ||data.dav_garage == null?-1:data.dav_garage));
                        $('#dav_garage').trigger('change');
                        

                        
                        $('#dav_jardin').val((data.dav_jardin==-1 ||data.dav_jardin == null?-1:data.dav_jardin));
                        $('#dav_jardin').trigger('change');

                        $('#dav_piscina').val((data.dav_piscina==-1 ||data.dav_piscina == null?-1:data.dav_piscina));
                        $('#dav_piscina').trigger('change');


                        $('#dav_piscina').val((data.dav_piscina==-1 ||data.dav_piscina == null?-1:data.dav_piscina));
                        $('#dav_piscina').trigger('change');
                        
                        $("#dav_nombrepropietario").val(data.dav_nombrepropietario);

                        $("#dav_recamara").val(data.dav_recamara);
                        $("#dav_banio").val(data.dav_banio);
                        $("#dav_sala").val(data.dav_sala);

                        
                        $('#dav_cocina').val((data.dav_cocina==-1 ||data.dav_cocina == null?-1:data.dav_cocina));
                        $('#dav_cocina').trigger('change');

                        $('#dav_comedor').val((data.dav_cocina==-1 ||data.dav_comedor == null?-1:data.dav_comedor));
                        $('#dav_comedor').trigger('change');

                        $('#dav_estudio').val((data.dav_estudio==-1 ||data.dav_estudio == null?-1:data.dav_estudio));
                        $('#dav_estudio').trigger('change');
                        
                        $('#dav_salajuego').val((data.dav_salajuego==-1 ||data.dav_salajuego == null?-1:data.dav_salajuego));
                        $('#dav_salajuego').trigger('change');
                        
                        $('#dav_terraza').val((data.dav_terraza==-1 ||data.dav_terraza == null?-1:data.dav_terraza));
                        $('#dav_terraza').trigger('change');

                        $('#dav_cualavado').val((data.dav_cualavado==-1 ||data.dav_cualavado == null?-1:data.dav_cualavado));
                        $('#dav_cualavado').trigger('change');

                        $('#dav_cuaservicio').val((data.dav_cuaservicio==-1 ||data.dav_cuaservicio == null?-1:data.dav_cuaservicio));
                        $('#dav_cuaservicio').trigger('change');

                        $('#dav_jardin').val((data.dav_jardin==-1 ||data.dav_jardin == null?-1:data.dav_jardin));
                        $('#dav_jardin').trigger('change');

                        $('#dav_piscina').val((data.dav_piscina==-1 ||data.dav_piscina == null?-1:data.dav_piscina));
                        $('#dav_piscina').trigger('change');
                        

                        $('#dav_drenaje').val((data.dav_drenaje==-1 ||data.dav_drenaje == null?-1:data.dav_drenaje));
                        $('#dav_drenaje').trigger('change');
                        

                        $('#dav_id').val(data.dav_id);

                        $('#dav_luz').val((data.dav_luz==-1 ||data.dav_luz == null?-1:data.dav_luz));
                        $('#dav_luz').trigger('change');
                        
                        $('#dav_agua').val((data.dav_agua==-1 ||data.dav_agua == null?-1:data.dav_agua));
                        $('#dav_agua').trigger('change');


                        $('#dav_telefono').val((data.dav_telefono==-1 ||data.dav_telefono == null?-1:data.dav_telefono));
                        $('#dav_telefono').trigger('change');

                        $('#dav_alumbrado').val((data.dav_alumbrado==-1 ||data.dav_alumbrado == null?-1:data.dav_alumbrado));
                        $('#dav_alumbrado').trigger('change');

                        $('#dav_pavimento').val((data.dav_pavimento==-1 ||data.dav_pavimento == null?-1:data.dav_pavimento));
                        $('#dav_pavimento').trigger('change');

                        $('#dav_tvcable').val((data.dav_tvcable==-1 ||data.dav_tvcable == null?-1:data.dav_tvcable));
                        $('#dav_tvcable').trigger('change');

                        $('#dav_internet').val((data.dav_internet==-1 ||data.dav_internet == null?-1:data.dav_internet));
                        $('#dav_internet').trigger('change');


                        $('#dav_hospital').val((data.dav_hospital==-1 ||data.dav_hospital == null?-1:data.dav_hospital));
                        $('#dav_hospital').trigger('change');

                        $('#dav_parque').val((data.dav_parque==-1 ||data.dav_parque == null?-1:data.dav_parque));
                        $('#dav_parque').trigger('change');


                        $('#dav_parque').val((data.dav_parque==-1 ||data.dav_parque == null?-1:data.dav_parque));
                        $('#dav_parque').trigger('change');


                        $('#dav_deportivo').val((data.dav_deportivo==-1 ||data.dav_deportivo == null?-1:data.dav_deportivo));
                        $('#dav_deportivo').trigger('change');


                        $('#dav_club').val((data.dav_club==-1 ||data.dav_club == null?-1:data.dav_club));
                        $('#dav_club').trigger('change');

                        $('#dav_transportepub').val((data.dav_transportepub==-1 ||data.dav_transportepub == null?-1:data.dav_transportepub));
                        $('#dav_transportepub').trigger('change');

                        $('#dav_servgas').val((data.dav_servgas==-1 ||data.dav_servgas == null?-1:data.dav_servgas));
                        $('#dav_servgas').trigger('change');

                        $('#dav_centrocomercial').val((data.dav_centrocomercial==-1 ||data.dav_centrocomercial == null?-1:data.dav_centrocomercial));
                        $('#dav_centrocomercial').trigger('change');


                        $('#dav_fibraoptica').val((data.dav_fibraoptica==-1 ||data.dav_fibraoptica == null?-1:data.dav_fibraoptica));
                        $('#dav_fibraoptica').trigger('change');

                        
                        $('#dav_television').val((data.dav_television==-1 ||data.dav_television == null?-1:data.dav_television));
                        $('#dav_television').trigger('change');


                        $('#dav_pantalla').val((data.dav_pantalla==-1 ||data.dav_pantalla == null?-1:data.dav_pantalla));
                        $('#dav_pantalla').trigger('change');


                        $('#dav_teatrocasa').val((data.dav_teatrocasa==-1 ||data.dav_teatrocasa == null?-1:data.dav_teatrocasa));
                        $('#dav_teatrocasa').trigger('change');

                        
                        $('#dav_dvd').val((data.dav_dvd==-1 ||data.dav_dvd == null?-1:data.dav_dvd));
                        $('#dav_dvd').trigger('change');


                        $('#dav_blueray').val((data.dav_blueray==-1 ||data.dav_blueray == null?-1:data.dav_blueray));
                        $('#dav_blueray').trigger('change');

                        $('#dav_estereo').val((data.dav_estereo==-1 ||data.dav_estereo == null?-1:data.dav_estereo));
                        $('#dav_estereo').trigger('change');

                        $('#dav_pc').val((data.dav_pc==-1 ||data.dav_pc == null?-1:data.dav_pc));
                        $('#dav_pc').trigger('change');


                        $('#dav_laptop').val((data.dav_laptop==-1 ||data.dav_laptop == null?-1:data.dav_laptop));
                        $('#dav_laptop').trigger('change');


                        
                        $('#dav_tablet').val((data.dav_tablet==-1 ||data.dav_tablet == null?-1:data.dav_tablet));
                        $('#dav_tablet').trigger('change');


                        $('#dav_smartphone').val((data.dav_smartphone==-1 ||data.dav_smartphone == null?-1:data.dav_smartphone));
                        $('#dav_smartphone').trigger('change');


                        $('#dav_videocamara').val((data.dav_videocamara==-1 ||data.dav_videocamara == null?-1:data.dav_videocamara));
                        $('#dav_videocamara').trigger('change');


                        $('#dav_camara').val((data.dav_camara==-1 ||data.dav_camara == null?-1:data.dav_camara));
                        $('#dav_camara').trigger('change');


                        $('#dav_cocinaintegral').val((data.dav_cocinaintegral==-1 ||data.dav_cocinaintegral == null?-1:data.dav_cocinaintegral));
                        $('#dav_cocinaintegral').trigger('change');

                        $('#dav_estufa').val((data.dav_estufa==-1 ||data.dav_estufa == null?-1:data.dav_estufa));
                        $('#dav_estufa').trigger('change');

                        $('#dav_horno').val((data.dav_horno==-1 ||data.dav_horno == null?-1:data.dav_horno));
                        $('#dav_horno').trigger('change');

                        $('#dav_microondas').val((data.dav_microondas==-1 ||data.dav_microondas == null?-1:data.dav_microondas));
                        $('#dav_microondas').trigger('change');

                        $('#dav_licuadora').val((data.dav_licuadora==-1 ||data.dav_licuadora == null?-1:data.dav_licuadora));
                        $('#dav_licuadora').trigger('change');

                        $('#dav_casacultura').val((data.dav_casacultura==-1 ||data.dav_casacultura == null?-1:data.dav_casacultura));
                        $('#dav_casacultura').trigger('change');

                        

                        $('#dav_plancha').val((data.dav_plancha==-1 ||data.dav_plancha == null?-1:data.dav_plancha));
                        $('#dav_plancha').trigger('change');
                        
                        
                        $('#dav_lavadora').val((data.dav_lavadora==-1 ||data.dav_lavadora == null?-1:data.dav_lavadora));
                        $('#dav_lavadora').trigger('change');

                        $('#dav_refrigerador').val((data.dav_refrigerador==-1 ||data.dav_refrigerador == null?-1:data.dav_refrigerador));
                        $('#dav_refrigerador').trigger('change');
                        

                        $('#dav_lavatraste').val((data.dav_lavatraste==-1 ||data.dav_lavatraste == null?-1:data.dav_lavatraste));
                        $('#dav_lavatraste').trigger('change');


                        $('#dav_hidrolavadora').val((data.dav_hidrolavadora==-1 ||data.dav_hidrolavadora == null?-1:data.dav_hidrolavadora));
                        $('#dav_hidrolavadora').trigger('change');
                        

                        $('#dav_lampara').val((data.dav_lampara==-1 ||data.dav_lampara == null?-1:data.dav_lampara));
                        $('#dav_lampara').trigger('change');
                        

                        $('#dav_cuadro').val((data.dav_cuadro==-1 ||data.dav_cuadro == null?-1:data.dav_cuadro));
                        $('#dav_cuadro').trigger('change');
                        
                                            
                        
                        
                       $('#dav_comentario').val(data.dav_comentario);
                        
                       $('#dav_telpropietario').val(data.dav_telpropietario);

            
                      }
                    
  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });
    }


    function fnCrearAutomaticoDatoViviendaFormatoTruper(ese_id)
    {
      let url_enviar="<?php echo $this->url->get('datovivienda/ajax_crear_automatico/') ?>";

            $.ajax({
                    type: "POST",
                    url: url_enviar+ese_id,
                      
                    success: function(res)
                    {

                          if(res[0]==2)
                          {
                            cargarDatosSeccion_B_ESES_formato_truper(ese_id);
                          }
                          else
                          {
                            alertify.alert('ERROR','ERROR AL PROCESAR LOS DATOS'); 

                          }


                    },
                    error: function(res)
                    {
                        alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                      
                    }
            });
          
        
      }
  
  </script>