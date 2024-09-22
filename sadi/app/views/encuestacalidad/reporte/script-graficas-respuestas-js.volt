<script>

    function fnImprimirReporteConHtml(){

        Swal.fire({
        title: 'Creando reporte de respuestas PDF',
        onBeforeOpen: () => {
            Swal.showLoading()
        }
        })

        html2canvas(document.querySelector('#listado-graficas-respuestas')).then((canvas) => {
                let base64image = canvas.toDataURL('image/png');
                let pdf = new jsPDF('p', 'px', [2000, 2500]);
                pdf.addImage(base64image, 'PNG', 0, 0, 2000, 2500);
                pdf.setFontSize(22);
                pdf.text(20, 20, 'Hello world!');
                pdf.setProperties({
                    title: 'Reporte respuestas',
                    subject: 'Encuesta servicio calidad',
                    author: 'SIPS RH',
                    keywords: 'SIPSRH',
                    creator: 'SIPSRH'
                });


                let nombre_extra=$('#enc_fecha-reporte').val();
               
                pdf.save('reporte-estadisticas-respuestas-'+nombre_extra+'.pdf');
                
        })
        .then(() => {
         
        }).finally(()=>{
            Swal.close();

            Swal.fire({
            icon: 'success',
            title: '¡PDF generado!',
            text: 'El archivo ha sido generado exitosamente.'
            }).then(()=>{

            });

        });
    }
    function fnLimipiarGraficasReporteRespuestasCalidad(){
     let graficasLimpiar = document.querySelectorAll('.pie-chart-reporte-respuestas');
      // Recorrer todos los elementos y limpiar su contenido HTML
     graficasLimpiar.forEach(function(elemento) {
        elemento.innerHTML = '';
      });

      let textosLimpiar = document.querySelectorAll('.texto-graficas');
      // Recorrer todos los elementos y limpiar su contenido HTML
      textosLimpiar.forEach(function(elemento) {
        elemento.innerHTML = '';
      });
        
    }
    function consultar_estadisticas_respuestas(form_id,tipo_grafica=0){
        let url_enviar="<?php echo $this->url->get('encuestacalidad/ajax_get_data_respuestas_porcentaje_estadisiticas/') ?>";
        let inv_id=$('#inv_id-reporte').val();        
                $.ajax({
                        type: "POST",
                        url: url_enviar+inv_id,
                        data:$(`#${form_id}`).serialize(),
                        success: function(res)
                        {
                          
                            let data_cebezera=res['detalles-encuesta'];
                           // moment.locale('es');
                            

                            if(res['contador-respuestas']!=0){
                                                            //cabcezara reporte
                            if(res['todas-preguntas-estadisticas']['estatus_data']=='-2'){
                                $('#listado-graficas-respuestas').hide();

                                return false;
                            }
                            $('#listado-graficas-respuestas').show('slow');

                            $('#texto-cabezera-reporte-respuesta').html(
                                `
                                <div class=" row d-flex justify-content-end">
                                    <button onclick="CargarTipoGrafico('${form_id}',0)" class="btn btn-info bg-del-sistema" style="margin:5px;">
                                    <i class="mdi mdi-chart-arc mdi-18px btn-icon text-white"></i>

                                    </button>
                                    <button onclick="CargarTipoGrafico('${form_id}',1)"  class="btn btn-info bg-del-sistema" style="margin:5px 20px 5px 5px ; ">
                                    <i class="mdi mdi-chart-bar mdi-18px btn-icon text-white"></i>

                                    </button>
                                </div>
                                <h5>Detalle de evaluaciones</h5>
                                    <p>
                                    Se realizaron ${data_cebezera['total_encuestas_contestadas']} encuestas de un total de  <span clas="text-uppercase" >  ${data_cebezera['total_eses']}</span>  estudios, evaluando a los investigadores en el mes de ${ data_cebezera['mes_consulta'] } ${data_cebezera['anio_consulta']} con la finalidad de medir el desempeño, la satisfacción de los candidatos, el tiempo de respuesta e identificar las áreas de oportunidad en el servicio prestado.
                                    </p>
                                `
                            );
                            

                          
                                if(tipo_grafica=='0'){
                                    generarGraficasPastel(res);
                                }
                                if(tipo_grafica=='1'){
                                    generarGraficasBarras(res);

                                }
                     
                             //pregunta 17 fin
                              
                            }else{
                                $('#listado-graficas-respuestas').hide();

                                alertify.alert('SIN DATOS','No hay datos para consultar'); 

                            }

                        


                             
                             
                        },
                        error: function(data)
                        {
                            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
                            
                        }
                });
    }


    function generarGraficasPastel(res){


               //variables globales
               let array_preguntas=res['todas-preguntas-texto']['data'];
                            let array_opciones=res['detalles-textos-opciones'];

                            ///pregunta 1 inicio 
                            let data_pre_1=res['todas-preguntas-estadisticas']['preg_1'];
                            let porc_pre_1_opc_1= Number(data_pre_1.pre_1_porcentaje_opc_id_1).toFixed(2);
                            let porc_pre_1_opc_2= Number(data_pre_1.pre_1_porcentaje_opc_id_2).toFixed(2);
                            let porc_pre_1_opc_3= Number(data_pre_1.pre_1_porcentaje_opc_id_3).toFixed(2);
                            let porc_pre_1_opc_4= Number(data_pre_1.pre_1_porcentaje_opc_id_4).toFixed(2);
                            
                            //console.log(array_opciones);

                            let pregunta_1= array_preguntas.find(item => item.pre_id === '1');
                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-1',
                                data: [
                                    { label: array_opciones['preg_1_opciones'][0].texto , value: porc_pre_1_opc_1 },
                                    { label: array_opciones['preg_1_opciones'][1].texto, value: porc_pre_1_opc_2 },
                                    { label: array_opciones['preg_1_opciones'][2].texto, value: porc_pre_1_opc_3 },
                                    { label: array_opciones['preg_1_opciones'][3].texto, value: porc_pre_1_opc_4 },

                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });

                            $('#textos-reporte-respuestas-pregunta-1').html(`
                            
                            <span class="text-center">${pregunta_1.pre_texto} </span>

                            `);
                            //pregunta 1 fin

                            ///pregunta 2 inicio 
                            let data_pre_2=res['todas-preguntas-estadisticas']['preg_2'];
                            let pregunta_2= array_preguntas.find(item => item.pre_id === '2');
                            let porc_pre_2_opc_1= Number(data_pre_2.pre_2_porcentaje_opc_id_1).toFixed(2);
                            let porc_pre_2_opc_2= Number(data_pre_2.pre_2_porcentaje_opc_id_2).toFixed(2);
                           

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-2',
                                data: [
                                    { label: array_opciones['preg_2_opciones'][0].texto, value: porc_pre_2_opc_1 },
                                    { label:array_opciones['preg_2_opciones'][1].texto, value: porc_pre_2_opc_2 },

                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                            $('#textos-reporte-respuestas-pregunta-2').html(`
                           
                            <br>
                            <span class="text-center">${pregunta_2.pre_texto} </span>

                            `);
                            //pregunta 2 fin

                            ///pregunta 3 inicio 
                            let data_pre_3=res['todas-preguntas-estadisticas']['preg_3'];
                            
                            let pregunta_3= array_preguntas.find(item => item.pre_id === '3');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-3',
                                data: [
                                    { label: array_opciones['preg_3_opciones'][0].texto, value: Number(data_pre_3.pre_3_porcentaje_opc_id_1).toFixed(2) },
                                    { label: array_opciones['preg_3_opciones'][1].texto, value:  Number(data_pre_3.pre_3_porcentaje_opc_id_2).toFixed(2)  },
                                    { label: array_opciones['preg_3_opciones'][2].texto, value:  Number(data_pre_3.pre_3_porcentaje_opc_id_3).toFixed(2)  },
                                    { label: array_opciones['preg_3_opciones'][3].texto, value:  Number(data_pre_3.pre_3_porcentaje_opc_id_4).toFixed(2)  },


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#16345E', '#00739D', '#00B7C2', '#71FACA']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-3').html(`
                              
                                <span class="text-center">${pregunta_3.pre_texto} </span>

                                `);

                                //console.log(data_pre_3);
                            //pregunta 3 fin



                             ///pregunta 4 inicio 
                                 let data_pre_4=res['todas-preguntas-estadisticas']['preg_4'];
                                 let pregunta_4= array_preguntas.find(item => item.pre_id === '4');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-4',
                                data: [
                                    { label: array_opciones['preg_4_opciones'][0].texto, value: Number(data_pre_4.pre_4_porcentaje_opc_id_1).toFixed(2) },
                                    { label:array_opciones['preg_4_opciones'][1].texto, value: Number(data_pre_4.pre_4_porcentaje_opc_id_2).toFixed(2) },


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });

                                $('#textos-reporte-respuestas-pregunta-4').html(`
                               
                                <span class="text-center">${pregunta_4.pre_texto} </span>
                                `);

                                //console.log(data_pre_3);
                            //pregunta 4 fin


                            ///pregunta 5 inicio 
                            let data_pre_5=res['todas-preguntas-estadisticas']['preg_5'];
                            let pregunta_5= array_preguntas.find(item => item.pre_id === '5');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-5',
                                data: [
                                    { label: array_opciones['preg_5_opciones'][0].texto, value: Number(data_pre_5.pre_5_porcentaje_opc_id_1).toFixed(2) },
                                    { label: array_opciones['preg_5_opciones'][1].texto, value: Number(data_pre_5.pre_5_porcentaje_opc_id_2).toFixed(2) },
                                    { label: array_opciones['preg_5_opciones'][2].texto, value: Number(data_pre_5.pre_5_porcentaje_opc_id_3).toFixed(2)  },
                           


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-5').html(`
                          
                                <span class="text-center">${pregunta_5.pre_texto} </span>
                                `);
                                //console.log(data_pre_5);
                            //pregunta 5 fin

                             ///pregunta 6 inicio 
                            let data_pre_6=res['todas-preguntas-estadisticas']['preg_6'];
                            let pregunta_6= array_preguntas.find(item => item.pre_id === '6');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-6',
                                data: [
                                    { label: array_opciones['preg_6_opciones'][0].texto, value: Number(data_pre_6.pre_6_porcentaje_opc_id_1).toFixed(2) },
                                    { label: array_opciones['preg_6_opciones'][1].texto, value: Number(data_pre_6.pre_6_porcentaje_opc_id_2).toFixed(2) },
                                

                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-6').html(`
                               
                                <span class="text-center">${pregunta_6.pre_texto} </span>
                                `);

                                //console.log(data_pre_3);
                            //pregunta 6 fin


                            ///pregunta 7 inicio 
                                let data_pre_7=res['todas-preguntas-estadisticas']['preg_7'];
                                let pregunta_7= array_preguntas.find(item => item.pre_id === '7');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-7',
                                data: [
                                    { label: array_opciones['preg_7_opciones'][0].texto,value: Number(data_pre_7.pre_7_porcentaje_opc_id_1).toFixed(2) },
                                    { label: array_opciones['preg_7_opciones'][1].texto, value: Number(data_pre_7.pre_7_porcentaje_opc_id_2).toFixed(2) },
                                    { label: array_opciones['preg_7_opciones'][2].texto, value: Number(data_pre_7.pre_7_porcentaje_opc_id_3).toFixed(2) },
                                    { label: array_opciones['preg_7_opciones'][3].texto, value: Number(data_pre_7.pre_7_porcentaje_opc_id_4).toFixed(2) },


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-7').html(`
                               
                                <span class="text-center">${pregunta_7.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 7 fin

                            ///pregunta 8 inicio 
                                let data_pre_8=res['todas-preguntas-estadisticas']['preg_8'];
                                let pregunta_8= array_preguntas.find(item => item.pre_id === '9');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-8',
                                data: [
                                    { label:array_opciones['preg_8_opciones'][0].texto, value:Number(data_pre_8.pre_8_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_8_opciones'][1].texto, value:Number(data_pre_8.pre_8_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_8_opciones'][2].texto, value:Number( data_pre_8.pre_8_porcentaje_opc_id_3).toFixed(2) },
                                

                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-8').html(`

                                <span class="text-center">${pregunta_8.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 8 fin

                            //pregunta 9 inicio 
                                let data_pre_9=res['todas-preguntas-estadisticas']['preg_9'];
                                let pregunta_9= array_preguntas.find(item => item.pre_id === '11');
                               // console.log(data_pre_9);
                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-9',
                                data: [
                                    { label:array_opciones['preg_9_opciones'][0].texto, value:Number(data_pre_9.pre_9_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_9_opciones'][1].texto, value:Number(data_pre_9.pre_9_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_9_opciones'][2].texto, value:Number(data_pre_9.pre_9_porcentaje_opc_id_3).toFixed(2)  },
                                    { label:array_opciones['preg_9_opciones'][3].texto, value:Number(data_pre_9.pre_9_porcentaje_opc_id_4).toFixed(2)  },


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-9').html(`
                             
                                <span class="text-center">${pregunta_9.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 9 fin

                            //pregunta 10 inicio 
                            let data_pre_10=res['todas-preguntas-estadisticas']['preg_10'];
                                let pregunta_10= array_preguntas.find(item => item.pre_id === '12');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-10',
                                data: [
                                    { label:array_opciones['preg_10_opciones'][0].texto, value:Number(data_pre_10.pre_10_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_10_opciones'][1].texto, value:Number(data_pre_10.pre_10_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_10_opciones'][2].texto, value:Number(data_pre_10.pre_10_porcentaje_opc_id_3).toFixed(2)  },


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-10').html(`
                               
                                <span class="text-center">${pregunta_10.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 10 fin

                            //pregunta 11 inicio 
                            let data_pre_11=res['todas-preguntas-estadisticas']['preg_11'];
                                let pregunta_11= array_preguntas.find(item => item.pre_id === '13');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-11',
                                data: [
                                    { label:array_opciones['preg_11_opciones'][0].texto, value:Number(data_pre_11.pre_11_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_11_opciones'][1].texto, value:Number(data_pre_11.pre_11_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_11_opciones'][2].texto, value:Number(data_pre_11.pre_11_porcentaje_opc_id_3).toFixed(2)  },



                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-11').html(`

                                <span class="text-center">${pregunta_11.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 11 fin



                            //pregunta 12 inicio 
                            let data_pre_12=res['todas-preguntas-estadisticas']['preg_12'];
                                let pregunta_12= array_preguntas.find(item => item.pre_id === '14');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-12',
                                data: [
                                    { label:array_opciones['preg_12_opciones'][0].texto, value:Number(data_pre_12.pre_12_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_12_opciones'][1].texto, value:Number(data_pre_12.pre_12_porcentaje_opc_id_2).toFixed(2)  },
                                   


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-12').html(`
                                
                                <span class="text-center">${pregunta_12.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 12 fin

                            //pregunta 13 inicio 
                            let data_pre_13=res['todas-preguntas-estadisticas']['preg_13'];
                            let pregunta_13= array_preguntas.find(item => item.pre_id === '16');
                            let data_pre_13_opc_1= Number(data_pre_13.pre_13_porcentaje_opc_id_1).toFixed(2);
                            let data_pre_13_opc_2= Number(data_pre_13.pre_13_porcentaje_opc_id_2).toFixed(2);

                           // console.log(data_pre_13_opc_1);
                            //let data_pre_13_opc_2=data_pre_13.pre_13_porcentaje_opc_id_2.toFixed(2);

                            Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-13',
                                data: [
                                    { label:array_opciones['preg_13_opciones'][0].texto, value:data_pre_13_opc_1 },
                                    { label:array_opciones['preg_13_opciones'][1].texto, value:data_pre_13_opc_2 },
                                   


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-13').html(`
                               
                                <span class="text-center">${pregunta_13.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 13 fin


                            //pregunta 14 inicio 
                                let data_pre_14=res['todas-preguntas-estadisticas']['preg_14'];
                                let pregunta_14= array_preguntas.find(item => item.pre_id === '17');
                               Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-14',
                                data: [
                                    { label:array_opciones['preg_14_opciones'][0].texto,value:Number(data_pre_14.pre_14_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_14_opciones'][1].texto, value:Number(data_pre_14.pre_14_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_14_opciones'][2].texto, value:Number(data_pre_14.pre_14_porcentaje_opc_id_3).toFixed(2)  },
                                    { label:array_opciones['preg_14_opciones'][3].texto, value:Number(data_pre_14.pre_14_porcentaje_opc_id_4).toFixed(2)  },
                                    { label:array_opciones['preg_14_opciones'][4].texto, value:Number(data_pre_14.pre_14_porcentaje_opc_id_5).toFixed(2)  },



                                 ]
                                 ,formatter: function (value, data) {
                                    return value + '%';
                                 }
                                 ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871','#9A3E2A']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-14').html(`
                               
                                <span class="text-center">${pregunta_14.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 14 fin


                             //pregunta 15 inico

                             let data_pre_15=res['todas-preguntas-estadisticas']['preg_15'];
                                let pregunta_15= array_preguntas.find(item => item.pre_id === '18');


                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-15',
                                data: [
                                    { label: array_opciones['preg_15_opciones'][0].texto, value:Number(data_pre_15.pre_15_porcentaje_opc_id_1).toFixed(2)  },
                                    { label: array_opciones['preg_15_opciones'][1].texto, value:Number(data_pre_15.pre_15_porcentaje_opc_id_2).toFixed(2)  },
                                    { label:array_opciones['preg_15_opciones'][2].texto, value:Number(data_pre_15.pre_15_porcentaje_opc_id_3).toFixed(2)  },
                                    { label:array_opciones['preg_15_opciones'][3].texto, value:Number(data_pre_15.pre_15_porcentaje_opc_id_4).toFixed(2)  },
                                    { label:array_opciones['preg_15_opciones'][4].texto, value:Number(data_pre_15.pre_15_porcentaje_opc_id_5).toFixed(2)  },



                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871','#9A3E2A']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-15').html(`
                             
                                <span class="text-center">${pregunta_15.pre_texto} </span>
                                `);

                             //pregunta 15 fin

                             //pregunta 16 incio 
                            if (typeof res['todas-preguntas-estadisticas']['preg_16'] !== 'undefined') {
                                let data_pre_16=res['todas-preguntas-estadisticas']['preg_16'];
                                let pregunta_16= array_preguntas.find(item => item.pre_id === '20');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-16',
                                data: [
                                    { label:array_opciones['preg_16_opciones'][0].texto, value:Number(data_pre_16.pre_16_porcentaje_opc_id_1).toFixed(2)  },
                                    { label:array_opciones['preg_16_opciones'][1].texto, value:Number(data_pre_16.pre_16_porcentaje_opc_id_2).toFixed(2)  },
                         


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }    
                                , colors: ['#00C6BD', '#16345E']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-16').html(`

                                <span class="text-center">${pregunta_16.pre_texto} </span>
                                `);
                                        
                            }else{
                                let pregunta_16= array_preguntas.find(item => item.pre_id === '20');
                                let plantilla_no_info_pregunta_16=
                                `  <span class="text-center">${pregunta_16.pre_texto}  <span class="text-danger" style="font-weight:bold;">NO HAY INFO EN ESTA PREGUNTA</span> </span>
                                 -`;

                                $('#textos-reporte-respuestas-pregunta-16').html(plantilla_no_info_pregunta_16);
                                ;                           
                            }
                             
                             //pregunta 16 fin

                             //pregunta 17 inicio
                             if (
                                typeof res['todas-preguntas-estadisticas']['preg_17'] !== 'undefined' &&
                                    res['todas-preguntas-estadisticas']['preg_17'] !== null

                                )  {

                                let data_pre_17=res['todas-preguntas-estadisticas']['preg_17'];
                                let pregunta_17= array_preguntas.find(item => item.pre_id === '21');

                                Morris.Donut({
                                element: 'pie-chart-reporte-respuestas-pregunta-17',
                                data: [
                                    { label: array_opciones['preg_17_opciones'][0].texto, value:Number(data_pre_17.pre_17_porcentaje_opc_id_1).toFixed(2)  },
                                    { label: array_opciones['preg_17_opciones'][1].texto, value:Number(data_pre_17.pre_17_porcentaje_opc_id_2).toFixed(2)  },
                                    { label: array_opciones['preg_17_opciones'][2].texto, value:Number(data_pre_17.pre_17_porcentaje_opc_id_3).toFixed(2)  },
                                    { label: array_opciones['preg_17_opciones'][3].texto, value:Number(data_pre_17.pre_17_porcentaje_opc_id_4).toFixed(2)  },
                                   


                                ]
                                ,formatter: function (value, data) {
                                    return value + '%';
                                }
                                ,colors: ['#005F8A', '#008C9E', '#85DC7F', '#F9F871','#9A3E2A']
                                }).on('click', function (i, row) {
                                    //$('#id_modal').modal({ show: true });

                                });
                                $('#textos-reporte-respuestas-pregunta-17').html(`
                               
                                <span class="text-center">${pregunta_17.pre_texto} </span>
                                `);
                            }else{
                                let pregunta_17= array_preguntas.find(item => item.pre_id === '21');
                                let plantilla_no_info_pregunta_17=
                                `  <span class="text-center">${pregunta_17.pre_texto}  <span class="text-danger" style="font-weight:bold;">NO HAY INFO EN ESTA PREGUNTA</span> </span>
                                 -`;

                                $('#textos-reporte-respuestas-pregunta-17').html(plantilla_no_info_pregunta_17);
                                ;                           
                            }
                             
    }

    function generarGraficasBarras(res){


           //variables globales
               let array_preguntas=res['todas-preguntas-texto']['data'];
                            let array_opciones=res['detalles-textos-opciones'];

                            ///pregunta 1 inicio 
                            let data_pre_1=res['todas-preguntas-estadisticas']['preg_1'];
                            let porc_pre_1_opc_1= Number(data_pre_1.pre_1_porcentaje_opc_id_1).toFixed(2);
                            let porc_pre_1_opc_2= Number(data_pre_1.pre_1_porcentaje_opc_id_2).toFixed(2);
                            let porc_pre_1_opc_3= Number(data_pre_1.pre_1_porcentaje_opc_id_3).toFixed(2);
                            let porc_pre_1_opc_4= Number(data_pre_1.pre_1_porcentaje_opc_id_4).toFixed(2);
                            
                            //console.log(array_opciones);
                            let array_colors=['#005F8A', '#008C9E', '#85DC7F', '#16345E','#00C6BD'];
                            let colorIndex=0;
                            let pregunta_1= array_preguntas.find(item => item.pre_id === '1');
                              
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-1',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // set colors for each bar

                                data: [
                                    {
                                         y: array_opciones['preg_1_opciones'][0].texto ,
                                         a: porc_pre_1_opc_1, 
                                    },
                                    {
                                         y: array_opciones['preg_1_opciones'][1].texto ,
                                         a: porc_pre_1_opc_2, 
                                     },
                                    {
                                         y: array_opciones['preg_1_opciones'][2].texto ,
                                         a: porc_pre_1_opc_3, 
                                    },
                                    { 
                                         y: array_opciones['preg_1_opciones'][3].texto ,
                                         a: porc_pre_1_opc_4, 
                                     },
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },



                                });
                                

                            $('#textos-reporte-respuestas-pregunta-1').html(`
                            
                            <span class="text-center">${pregunta_1.pre_texto} </span>

                            `);
                            //pregunta 1 fin

                            ///pregunta 2 inicio 
                            let data_pre_2=res['todas-preguntas-estadisticas']['preg_2'];
                            let pregunta_2= array_preguntas.find(item => item.pre_id === '2');
                            let porc_pre_2_opc_1= Number(data_pre_2.pre_2_porcentaje_opc_id_1).toFixed(2);
                            let porc_pre_2_opc_2= Number(data_pre_2.pre_2_porcentaje_opc_id_2).toFixed(2);
                           

                              
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-2',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    {
                                         y:array_opciones['preg_2_opciones'][0].texto,
                                         a: porc_pre_2_opc_1, 
                                    },
                                    {
                                         y: array_opciones['preg_2_opciones'][1].texto,
                                         a: porc_pre_2_opc_2, 
                                     }
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },

                                });  

                            $('#textos-reporte-respuestas-pregunta-2').html(`
                           
                            <br>
                            <span class="text-center">${pregunta_2.pre_texto} </span>

                            `);
                            //pregunta 2 fin

                            ///pregunta 3 inicio 
                            let data_pre_3=res['todas-preguntas-estadisticas']['preg_3'];
                            
                            let pregunta_3= array_preguntas.find(item => item.pre_id === '3');

                         
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-3',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 
                                data: [
                                
                                    { y: array_opciones['preg_3_opciones'][0].texto, a: Number(data_pre_3.pre_3_porcentaje_opc_id_1).toFixed(2) },
                                    { y: array_opciones['preg_3_opciones'][1].texto, a:  Number(data_pre_3.pre_3_porcentaje_opc_id_2).toFixed(2)  },
                                    { y: array_opciones['preg_3_opciones'][2].texto, a:  Number(data_pre_3.pre_3_porcentaje_opc_id_3).toFixed(2)  },
                                    { y: array_opciones['preg_3_opciones'][3].texto, a:  Number(data_pre_3.pre_3_porcentaje_opc_id_4).toFixed(2)  },
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },



                                });


                                $('#textos-reporte-respuestas-pregunta-3').html(`
                              
                                <span class="text-center">${pregunta_3.pre_texto} </span>

                                `);


                                //console.log(data_pre_3);
                            //pregunta 3 fin



                             ///pregunta 4 inicio 
                                 let data_pre_4=res['todas-preguntas-estadisticas']['preg_4'];
                                 let pregunta_4= array_preguntas.find(item => item.pre_id === '4');

                    


                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-4',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y: array_opciones['preg_4_opciones'][0].texto, a: Number(data_pre_4.pre_4_porcentaje_opc_id_1).toFixed(2) },
                                    { y:array_opciones['preg_4_opciones'][1].texto, a: Number(data_pre_4.pre_4_porcentaje_opc_id_2).toFixed(2) },
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },



                                });

                                $('#textos-reporte-respuestas-pregunta-4').html(`
                               
                                <span class="text-center">${pregunta_4.pre_texto} </span>
                                `);

                                //console.log(data_pre_3);
                            //pregunta 4 fin


                            ///pregunta 5 inicio 
                            let data_pre_5=res['todas-preguntas-estadisticas']['preg_5'];
                            let pregunta_5= array_preguntas.find(item => item.pre_id === '5');

                             

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-5',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                    { y: array_opciones['preg_5_opciones'][0].texto, a: Number(data_pre_5.pre_5_porcentaje_opc_id_1).toFixed(2) },
                                    { y: array_opciones['preg_5_opciones'][1].texto, a: Number(data_pre_5.pre_5_porcentaje_opc_id_2).toFixed(2) },
                                    { y: array_opciones['preg_5_opciones'][2].texto, a: Number(data_pre_5.pre_5_porcentaje_opc_id_3).toFixed(2)  },
                           
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });
                                $('#textos-reporte-respuestas-pregunta-5').html(`
                          
                                <span class="text-center">${pregunta_5.pre_texto} </span>
                                `);
                                //console.log(data_pre_5);
                            //pregunta 5 fin

                             ///pregunta 6 inicio 
                            let data_pre_6=res['todas-preguntas-estadisticas']['preg_6'];
                            let pregunta_6= array_preguntas.find(item => item.pre_id === '6');

                         

                                Morris.Bar({
                                    element: 'pie-chart-reporte-respuestas-pregunta-6',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                     { y: array_opciones['preg_6_opciones'][0].texto, a: Number(data_pre_6.pre_6_porcentaje_opc_id_1).toFixed(2) },
                                    { y: array_opciones['preg_6_opciones'][1].texto, a: Number(data_pre_6.pre_6_porcentaje_opc_id_2).toFixed(2) },
                           
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-6').html(`
                               
                                <span class="text-center">${pregunta_6.pre_texto} </span>
                                `);

                                //console.log(data_pre_3);
                            //pregunta 6 fin


                            ///pregunta 7 inicio 
                                let data_pre_7=res['todas-preguntas-estadisticas']['preg_7'];
                                let pregunta_7= array_preguntas.find(item => item.pre_id === '7');

                          

                                
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-7',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                    { y: array_opciones['preg_7_opciones'][0].texto,a: Number(data_pre_7.pre_7_porcentaje_opc_id_1).toFixed(2) },
                                    { y: array_opciones['preg_7_opciones'][1].texto, a: Number(data_pre_7.pre_7_porcentaje_opc_id_2).toFixed(2) },
                                    { y: array_opciones['preg_7_opciones'][2].texto, a: Number(data_pre_7.pre_7_porcentaje_opc_id_3).toFixed(2) },
                                    { y: array_opciones['preg_7_opciones'][3].texto, a: Number(data_pre_7.pre_7_porcentaje_opc_id_4).toFixed(2) },
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-7').html(`
                               
                                <span class="text-center">${pregunta_7.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 7 fin

                            ///pregunta 8 inicio 
                                let data_pre_8=res['todas-preguntas-estadisticas']['preg_8'];
                                let pregunta_8= array_preguntas.find(item => item.pre_id === '9');

                       
                               

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-8',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                    { y:array_opciones['preg_8_opciones'][0].texto, a:Number(data_pre_8.pre_8_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_8_opciones'][1].texto, a:Number(data_pre_8.pre_8_porcentaje_opc_id_2).toFixed(2)  },
                                    { y:array_opciones['preg_8_opciones'][2].texto, a:Number( data_pre_8.pre_8_porcentaje_opc_id_3).toFixed(2) },
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-8').html(`

                                <span class="text-center">${pregunta_8.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 8 fin

                            //pregunta 9 inicio 
                                let data_pre_9=res['todas-preguntas-estadisticas']['preg_9'];
                                let pregunta_9= array_preguntas.find(item => item.pre_id === '11');
                               // console.log(data_pre_9);
                            
                                
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-9',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 
                                data: [
                                
                                    { y:array_opciones['preg_9_opciones'][0].texto, a:Number(data_pre_9.pre_9_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_9_opciones'][1].texto, a:Number(data_pre_9.pre_9_porcentaje_opc_id_2).toFixed(2)  },
                                    { y:array_opciones['preg_9_opciones'][2].texto, a:Number(data_pre_9.pre_9_porcentaje_opc_id_3).toFixed(2)  },
                                    { y:array_opciones['preg_9_opciones'][3].texto, a:Number(data_pre_9.pre_9_porcentaje_opc_id_4).toFixed(2)  },

                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },



                                });

                                $('#textos-reporte-respuestas-pregunta-9').html(`
                             
                                <span class="text-center">${pregunta_9.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 9 fin

                            //pregunta 10 inicio 
                            let data_pre_10=res['todas-preguntas-estadisticas']['preg_10'];
                                let pregunta_10= array_preguntas.find(item => item.pre_id === '12');

                            

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-10',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                    { y:array_opciones['preg_10_opciones'][0].texto, a:Number(data_pre_10.pre_10_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_10_opciones'][1].texto, a:Number(data_pre_10.pre_10_porcentaje_opc_id_2).toFixed(2)  },
                                    { y:array_opciones['preg_10_opciones'][2].texto, a:Number(data_pre_10.pre_10_porcentaje_opc_id_3).toFixed(2)  },


                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },



                                });

                                $('#textos-reporte-respuestas-pregunta-10').html(`
                               
                                <span class="text-center">${pregunta_10.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 10 fin

                            //pregunta 11 inicio 
                            let data_pre_11=res['todas-preguntas-estadisticas']['preg_11'];
                                let pregunta_11= array_preguntas.find(item => item.pre_id === '13');

                             
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-11',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                
                                    { y:array_opciones['preg_11_opciones'][0].texto, a:Number(data_pre_11.pre_11_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_11_opciones'][1].texto, a:Number(data_pre_11.pre_11_porcentaje_opc_id_2).toFixed(2)  },
                                    { y:array_opciones['preg_11_opciones'][2].texto, a:Number(data_pre_11.pre_11_porcentaje_opc_id_3).toFixed(2)  },

                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },

                                });



                                $('#textos-reporte-respuestas-pregunta-11').html(`

                                <span class="text-center">${pregunta_11.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 11 fin



                            //pregunta 12 inicio 
                            let data_pre_12=res['todas-preguntas-estadisticas']['preg_12'];
                                let pregunta_12= array_preguntas.find(item => item.pre_id === '14');

                               

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-12',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y:array_opciones['preg_12_opciones'][0].texto, a:Number(data_pre_12.pre_12_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_12_opciones'][1].texto, a:Number(data_pre_12.pre_12_porcentaje_opc_id_2).toFixed(2)  },
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });
                                $('#textos-reporte-respuestas-pregunta-12').html(`
                                
                                <span class="text-center">${pregunta_12.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 12 fin

                            //pregunta 13 inicio 
                            let data_pre_13=res['todas-preguntas-estadisticas']['preg_13'];
                            let pregunta_13= array_preguntas.find(item => item.pre_id === '16');
                            let data_pre_13_opc_1= Number(data_pre_13.pre_13_porcentaje_opc_id_1).toFixed(2);
                            let data_pre_13_opc_2= Number(data_pre_13.pre_13_porcentaje_opc_id_2).toFixed(2);

                           // console.log(data_pre_13_opc_1);
                            //let data_pre_13_opc_2=data_pre_13.pre_13_porcentaje_opc_id_2.toFixed(2);

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-13',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y:array_opciones['preg_13_opciones'][0].texto, a:data_pre_13_opc_1 },
                                    { y:array_opciones['preg_13_opciones'][1].texto, a:data_pre_13_opc_2 },
                                   
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });


                                $('#textos-reporte-respuestas-pregunta-13').html(`
                               
                                <span class="text-center">${pregunta_13.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 13 fin


                            //pregunta 14 inicio 
                                let data_pre_14=res['todas-preguntas-estadisticas']['preg_14'];
                                let pregunta_14= array_preguntas.find(item => item.pre_id === '17');
                       

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-14',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y:array_opciones['preg_14_opciones'][0].texto, a:Number(data_pre_14.pre_14_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_14_opciones'][1].texto, a:Number(data_pre_14.pre_14_porcentaje_opc_id_2).toFixed(2)  },
                                    { y:array_opciones['preg_14_opciones'][2].texto, a:Number(data_pre_14.pre_14_porcentaje_opc_id_3).toFixed(2)  },
                                    { y:array_opciones['preg_14_opciones'][3].texto, a:Number(data_pre_14.pre_14_porcentaje_opc_id_4).toFixed(2)  },
                                    { y:array_opciones['preg_14_opciones'][4].texto, a:Number(data_pre_14.pre_14_porcentaje_opc_id_5).toFixed(2)  },

                                   
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-14').html(`
                               
                                <span class="text-center">${pregunta_14.pre_texto} </span>
                                `);
                                //console.log(data_pre_3);
                             //pregunta 14 fin


                             //pregunta 15 inico
                             if (typeof res['todas-preguntas-estadisticas']['preg_15'] !== 'undefined') {
                                    let data_pre_15=res['todas-preguntas-estadisticas']['preg_15'];
                                    let pregunta_15= array_preguntas.find(item => item.pre_id === '18');

                                    Morris.Bar({
                                    element: 'pie-chart-reporte-respuestas-pregunta-15',
                                    barColors: function(){
                                        if(colorIndex < 4)
                                        return array_colors[++colorIndex];
                                        else{
                                            colorIndex = 0;
                                            return array_colors[++colorIndex];
                                        }
                                    }, // 

                                    data: [
                                        { y: array_opciones['preg_15_opciones'][0].texto, a:Number(data_pre_15.pre_15_porcentaje_opc_id_1).toFixed(2)  },
                                        { y: array_opciones['preg_15_opciones'][1].texto, a:Number(data_pre_15.pre_15_porcentaje_opc_id_2).toFixed(2)  },
                                        { y:array_opciones['preg_15_opciones'][2].texto, a:Number(data_pre_15.pre_15_porcentaje_opc_id_3).toFixed(2)  },
                                        { y:array_opciones['preg_15_opciones'][3].texto, a:Number(data_pre_15.pre_15_porcentaje_opc_id_4).toFixed(2)  },
                                        { y:array_opciones['preg_15_opciones'][4].texto, a:Number(data_pre_15.pre_15_porcentaje_opc_id_5).toFixed(2)  },

                                    
                                    
                                    ],
                                    xkey: 'y',
                                    ykeys: ['a'],
                                    labels: ['Porcentaje'],
                                    ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                    formatter: function (a) { return a + "%" },
                                    });

                                    $('#textos-reporte-respuestas-pregunta-15').html(`
                                
                                    <span class="text-center">${pregunta_15.pre_texto} </span>
                                    `);
                                }else{
                                    let pregunta_15= array_preguntas.find(item => item.pre_id === '18');
                                    let plantilla_no_info_pregunta_15=
                                    `  <span class="text-center">${pregunta_15.pre_texto}  <span class="text-danger" style="font-weight:bold;">NO HAY INFO EN ESTA PREGUNTA</span> </span>
                                    -`;

                                    $('#textos-reporte-respuestas-pregunta-15').html(plantilla_no_info_pregunta_15);
                                    ;                           
                                }
                              

                             //pregunta 15 fin

                             //pregunta 16 incio 
                             if (typeof res['todas-preguntas-estadisticas']['preg_16'] !== 'undefined') {
                                let data_pre_16=res['todas-preguntas-estadisticas']['preg_16'];
                                let pregunta_16= array_preguntas.find(item => item.pre_id === '20');

                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-16',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y:array_opciones['preg_16_opciones'][0].texto, a:Number(data_pre_16.pre_16_porcentaje_opc_id_1).toFixed(2)  },
                                    { y:array_opciones['preg_16_opciones'][1].texto, a:Number(data_pre_16.pre_16_porcentaje_opc_id_2).toFixed(2)  },
                                   
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-16').html(`

                                <span class="text-center">${pregunta_16.pre_texto} </span>
                                `);
                                }else{
                                    let pregunta_16= array_preguntas.find(item => item.pre_id === '20');
                                    let plantilla_no_info_pregunta_16=
                                    `  <span class="text-center">${pregunta_16.pre_texto}  <span class="text-danger" style="font-weight:bold;">NO HAY INFO EN ESTA PREGUNTA</span> </span>
                                    -`;

                                    $('#textos-reporte-respuestas-pregunta-16').html(plantilla_no_info_pregunta_16);
                                    ;                           
                                }
                            
                             //pregunta 16 fin

                             //pregunta 17 inicio
                               if (
                                typeof res['todas-preguntas-estadisticas']['preg_17'] !== 'undefined' &&
                                    res['todas-preguntas-estadisticas']['preg_17'] !== null

                                ) {
                                let data_pre_17=res['todas-preguntas-estadisticas']['preg_17'];
                                let pregunta_17= array_preguntas.find(item => item.pre_id === '21');
                                Morris.Bar({
                                element: 'pie-chart-reporte-respuestas-pregunta-17',
                                barColors: function(){
                                    if(colorIndex < 4)
                                    return array_colors[++colorIndex];
                                    else{
                                        colorIndex = 0;
                                        return array_colors[++colorIndex];
                                    }
                                }, // 

                                data: [
                                    { y: array_opciones['preg_17_opciones'][0].texto, a:Number(data_pre_17.pre_17_porcentaje_opc_id_1).toFixed(2)  },
                                    { y: array_opciones['preg_17_opciones'][1].texto, a:Number(data_pre_17.pre_17_porcentaje_opc_id_2).toFixed(2)  },
                                    { y: array_opciones['preg_17_opciones'][2].texto, a:Number(data_pre_17.pre_17_porcentaje_opc_id_3).toFixed(2)  },
                                    { y: array_opciones['preg_17_opciones'][3].texto, a:Number(data_pre_17.pre_17_porcentaje_opc_id_4).toFixed(2)  },
                                   
                                   
                                 
                                ],
                                xkey: 'y',
                                ykeys: ['a'],
                                labels: ['Porcentaje'],
                                ymax: 100, // Agregar esta línea para indicar que el valor máximo en el eje Y es 100
                                formatter: function (a) { return a + "%" },
                                });

                                $('#textos-reporte-respuestas-pregunta-17').html(`
                               
                                <span class="text-center">${pregunta_17.pre_texto} </span>
                                `);

                                }else{
                                    let pregunta_17= array_preguntas.find(item => item.pre_id === '21');
                                    let plantilla_no_info_pregunta_17=
                                    `  <span class="text-center">${pregunta_17.pre_texto}  <span class="text-danger" style="font-weight:bold;">NO HAY INFO EN ESTA PREGUNTA</span> </span>
                                    -`;

                                    $('#textos-reporte-respuestas-pregunta-17').html(plantilla_no_info_pregunta_17);
                                    ;                           
                                }

    
    }

    function CargarTipoGrafico(form_id,tipo_grafica=0){
        fnLimipiarGraficasReporteRespuestasCalidad();
        consultar_estadisticas_respuestas(form_id,tipo_grafica);

    }
</script>