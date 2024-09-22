<script>
     function fnElimnarSituacionEconomicaIngresos(sei_id=0){
        if(sei_id!=0)
        {
        
                              
        //sweet alert start
         Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+sei_id+"</strong> de la tabla de referencias de ingresos?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                            let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+sei_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                   
                                                        if(res[0]==2)
                                                        {
                                                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        fnRe_CargarTablaDatoSituacioneEconomicaIngresos(res['sie_id']);
                                                                                         $('#sie_totalingresos').val(res['sie_totalingresos']);
                                                                                         
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
        //sweet alert end
        }
    }
</script>