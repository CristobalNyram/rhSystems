<script>
        function fngetDataSelectsEstatusContactoDatoGrupoFamiliar(
                    value_id=0,select_input=0,
      
    
                    ){
    
                 if(select_input!=0){
                    
                    select_input.empty();
    
                 }
    
                 
                 let url_enviar="<?php echo $this->url->get('datogrupofamiliardetalles/ajax_get_data_selects_estatucscontacto/') ?>";
    
                $.ajax({
                type: "POST",
                url: url_enviar,
                success: function(res)
                {

            
                    let data=Object.entries(res['estatuscontacto_data']);
   

                    
                    //inicio de insersion de select
                    if(select_input!=0){
    
    
                                if (data.length > 0) {
                                        
                                    select_input.append(function () {
                                        let options = '';
                                        if(value_id<=0)
                                        {
                                            options += '<option selected value="-1">Seleccionar</option>';
    
                                        }
                                        else
                                        {
                                            options += '<option  value="-1">Seleccionar</option>';
    
                                        }
                                                $.each( data, function (key, dat) {
                                                 if (value_id==dat[0]) {
                                                        options += '<option  selected value="' +dat[0] + '">' +dat[1]+'</option>';
                                                    }	
                                                    else
                                                    {
                                                         options += '<option   value="' +dat[0] + '">' +dat[1]+'</option>';
    
                                                    }
                                                    // console.log(dat[1]);
                                                //  console.log(dat[0]);
                                                //  antigu
    
                                                });
    
                                        return options;
                                    });
                                    
                                }else{
                                    select_input.append(function () {
                                        let options = '';
                                        options += '<option selected value="-1">No aplica</option>';
                                        return options;
                                    });
                                }
                    }
                    // fin de insersion de select
    

    
    
                },
                error: function(res)
                {
                    alert('Error al cargar los selects...');
                    // $("#btn_aprobar").prop("disabled", false);
                }
            });
    
        }
    
</script>

</script>