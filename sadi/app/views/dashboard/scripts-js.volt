    <!-- scripts start  -->
    <script>
      

        $(document).ready(function(){
           
            const resumens = () => {alert();}


            let url ="<?php echo $this->url->get('dashboard/ajax_estudios_cancelados/') ?>";
            let urlAlta ="<?php echo $this->url->get('dashboard/ajax_estudios_alta/') ?>";
            let urlTraficoInvestigador="<?php echo $this->url->get('dashboard/ajax_estudios_trafico_investigador/') ?>";
            let urlTraficoAnalista="<?php echo $this->url->get('dashboard/ajax_estudios_trafico_analista/') ?>";
            let urlTransporte="<?php echo $this->url->get('dashboard/ajax_estudios_transporte_aprobados/') ?>";
            let urlAprobados ="<?php echo $this->url->get('dashboard/ajax_estudios_aprobados/') ?>";

            let urlTransporteTotal="<?php echo $this->url->get('dashboard/ajax_get_total_transporte_aprobados/') ?>";
            let configAjaxFetch = {
                                method: 'POST', // or 'PUT'
                                headers: new Headers({
                                'Content-Type': 'text/plain',
                                'X-Requested-With': 'XMLHttpRequest'
                            })
                         };
            
             $('#table_ese_aprobados').DataTable({
                      "ajax":{
                        "url": urlAprobados,
                        //  "type": "POST",
                        "dataSrc":"",
                        "scrollX": true
                    },
                    "pageLength": 4,
                    "columns":[
                        {data:'ese_id'},
                        {data:'ese_nombre'},
                        { "class" : "all",
                            'defaultContent':`	
                        <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" onclick="resumens()" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                        </a>
                        <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                        <a data-toggle="modal" title="Ver bitácora de actividad de este modal." onclick="mostrarAccionesRealizadasSobreEsteEstudio()" type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                        `},
        
        
        
                    ],
                    drawCallback: function () {
                       /* let table = $('#table_ese_cancelados').DataTable();
                        let count = table.rows().count();
                       // console.log(count);
                        $('#eses_cancelados_titulo').text(count);
                            */    

                    }
                      
        
               
                     
                   
                    });             


            $('#table_ese_cancelados').DataTable({
                      "ajax":{
                        "url": url,
                        // "type": "POST",
                        "dataSrc":""
                    },
                    "pageLength": 4,
                    "columns":[
                        {data:'ese_id'},
                        {data:'ese_nombre'},
        
                     
                        { "class" : "all",
                            'defaultContent':`	
                        <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                        </a>
                        <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                        `},
        
        
        
                    ],
                    drawCallback: function () {
                        let table = $('#table_ese_cancelados').DataTable();
                        let count = table.rows().count();
                       // console.log(count);
                        $('#eses_cancelados_titulo').text(count);
                                

                    }
                      
        
               
                     
                   
                    });
        
       

                    $('#table_ese_alta').DataTable({
                                "ajax":{
                                    "url": urlAlta,
                                    // "type": "POST",
                                    "dataSrc":""
                                },
                                "pageLength":4,
                                "searching": false,
                                "initComplete": function( settings, json ) {
                            
                                },
                                "columns":[
                                    {data:'ese_id'},
                                    {data:'ese_nombre'},
                                
                                    {"class" : "all",
                                    'defaultContent':`	
                                    <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                                        <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                                    </a>
                                    <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                                    <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                                </a>
                                    `},
                
                                ], drawCallback: function () {
                                let table = $('#table_ese_alta').DataTable();
                                let count = table.rows().count();
                            // console.log(count);
                                $('#eses_alta_titulo').text(count);
                                        

                            }
                            
                        
        
                
                        
                    
                        });

                        
        
                        
                    $('#table_ese_trafico_investigador').DataTable({
                        "ajax":{
                            "url": urlTraficoInvestigador,
                            // "type": "POST",
                            "dataSrc":""
                        },
                        "pageLength":4,
                        "searching": false,
                        "columns":[
                            {data:'ese_id'},
                            {data:'ese_nombre'},
                         
                            {"class" : "all",
                            'defaultContent':`	
                            <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                                <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                            </a>
                            <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                            `},
        
        
        
                        ], drawCallback: function () {
                        let table = $('#table_ese_trafico_investigador').DataTable();
                        let count = table.rows().count();
                       // console.log(count);
                        $('#ese_trafico_investigador_titulo').text(count);
                        
                        }
                        
        
                
                        
                    
                        });


                       

                        $('#table_ese_trafico_analista').DataTable({
                        "ajax":{
                            "url": urlTraficoAnalista,
                            // "type": "POST",
                            "dataSrc":""
                        },
                        "pageLength":4,
                        "searching": false,
                        "columns":[
                            {data:'ese_id'},
                            {data:'ese_nombre'},
                         
                            {"class" : "all",
                                'defaultContent':`	
                            <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                                <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                            </a>
                            <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                            `},
        
        
        
                        ], drawCallback: function () {
                        let table = $('#table_ese_trafico_analista').DataTable();
                        let count = table.rows().count();
                       // console.log(count);
                        $('#titulo_ese_trafico_analista').text(count);
                        }
                        
        
                
                        
                    
                        });
                        

                        $('#table_tra_aprobados').DataTable({
                        "ajax":{
                            "url": urlTransporte,
                            // "type": "POST",
                            "dataSrc":""
                        },
                        "pageLength":4,
                       
                        "columns":[
                        {data:'tra_id'},
                        {data:'ese_id'},
                        {data:'ese_id'},
                        {data:'tra_fechaaprobado'},
                        {data:'tra_origen'},
                        {data:'tra_destino'},
                        { "class" : "all",
                            'defaultContent':`	
                        <a data-toggle="modal" title="Visualizar." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-eye-circle  mdi-18px btn-icon"></i>								
                        </a>
                        <a data-toggle="modal" title="Analisis de días trabajados." type="button" class="" data-container="body" data-toggle="popover" role="button" data-target="#ver_resumen_estudio-modal" >
                            <i class="mdi mdi-google-analytics  mdi-18px btn-icon"></i>								
                        </a>
                        `},
        
        
        
                        ]
                        ,"createdRow":function(row,data,index){
                             
                 

                        }
                        , drawCallback: function () {
                        let table = $('#table_tra_aprobados').DataTable();
                        let count = table.rows().count();
                       // console.log(count);
                        $('#titulo_tra_aprobados').text(count);


                
     
                        }
                     
        
                
                        
                    
                        });



                        let get_total_transporte_aprobado = fetch(urlTransporteTotal,configAjaxFetch);
                        get_total_transporte_aprobado
                        .then(
                            (response)=>{
                                return response.json()
                            }
                            )
                        .then((data)=>{
                          
                            document.getElementById('total_transporte_aprobado').innerText=data;
                        });
                        
         });
        
                 
          
        </script>
            <!-- scripts end -->