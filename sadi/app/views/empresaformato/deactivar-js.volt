<script>
    function fnDesactivarEmpresaFormato(emf_id=0,callbackReloadTable){
       if(emf_id!=0)
       {
     //sweet alert start
        let url_enviar="<?php echo $this->url->get('empresaformato/ajax_detalle/') ?>";
            // let $nivel_estudios =ese_id
            $.ajax({
                type: "POST",
                url: url_enviar+emf_id,   
                success: function(res)
                {
                    if(res.estatus=='2'){

                            Swal.fire({
                            title: res.estatus_name,
                            html:"¿Está seguro de   <strong style='color:red;'> "+res.estatus_name+" el registro con ID "+emf_id+"</strong> de la tabla de formatos de empresa?",
                            type:'question',
                            showCancelButton: true,
                            confirmButtonText: 'Si, '+res.estatus_name.toLowerCase(),
                            cancelButtonText:'Cancelar acción',
                            }).then((result) => {
                            // console.log(result);
                            if (result.value) {
                                    //ajax start       
                                    let url_enviar_cambio="<?php echo $this->url->get('empresaformato/desactivar_activar/') ?>";              
                                                $.ajax({
                                                        type: "POST",
                                                        url: url_enviar_cambio+emf_id,
                                                        
                                                        success: function(res)
                                                        {   
                                                            
                                                            
                                                                if(res[0]==2)
                                                                {
                                                                    Swal.fire({title:res['titular'],text:res['mensaje'],
                                                                    type:"success"
                                                                    })
                                                                            .then((value) => {
                                                                                callbackReloadTable(res['emp_id']);                                              
                                                                                });

                                                                        
                                                                }
                                                                else
                                                                {

                                                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                            .then((value) => {
                                                                            location.reload();  
                                                                                });


                                                                
                                                                }
                                                                
                                                                
                                                        },
                                                        error: function(res)
                                                        { 
                                                        alert('ERROR DE SERVIDOR');
                                                        }
                                            });
                                        //ajax end      

                            }
                            });



                    }
                
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+res.responseText); 
                
                }
            });
       
       //sweet alert end
       }
   }
</script>