<script>

    function fnGetTextoPreguntasServicioCalidad(
        obj_labels=0
        ){
    

        let url_enviar="<?php echo $this->url->get('pregunta/ajax_get_textos_preguntas_servicio/') ?>";
                
                $.ajax({
                        type: "POST",
                        url: url_enviar,
                            
                        success: function(res)
                        {

                            if(obj_labels!=0){
                                let data = res.data.data;
                                // console.log(data);
                                

                                    for (let index = 0; index < data.length; index++) {
                                        // console.log(data[index]);
                                        if (typeof obj_labels[index] !== 'undefined') {
                                            // console.log(obj_labels[index]);

                                                document.getElementById(obj_labels[index].label_id).innerText=data[index].pre_texto;
                                        }
                                        
                                    }


                                




                            }
                            // console.log(res.data);
                            // let data= res.data;

                            // console.log(data);

                        },
                        error: function(data)
                        {
                            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
                            
                        }
                });

    }


</script>