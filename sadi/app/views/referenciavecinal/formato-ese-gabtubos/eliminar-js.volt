<script>
     function fnElimnaReferenciaVecinal(rev_id=0){
        if(rev_id!=0)
        {
            alertify.confirm('ELIMINAR','¿Está seguro de eliminar el registro con ID '+rev_id+' de la tabla de referencias vecinales?', function(){
                let url_enviar="<?php echo $this->url->get('referenciavecinal/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+rev_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                   
                                                        if(res[0]==2)
                                                        {
                                                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                 .then((value) => {
                                                                       fnRe_CargarTablaDatoReferenciaVecinal(res['sep_id']);                                              
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

                              },function()
                              {
                                alertify.alert('CANCELADO','Acción cancelada.');
                              }).set('labels', {ok:'Eliminar', cancel:'Cancelar'}); ;
        }
    }
</script>