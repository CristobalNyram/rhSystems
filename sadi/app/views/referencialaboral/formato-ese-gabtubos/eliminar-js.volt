<script>
     function fnElimnaReferenciaLaboral_formato_gabtubos(rel_id=0){
        if(rel_id!=0)
        {
                    //sweet alert start
                    Swal.fire({
                            title: 'Eliminar',
                            html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+rel_id+"</strong> de la tabla de datos de referencias laborales?",
                            type:'question',
                            showCancelButton: true,
                            confirmButtonText: 'Si, eliminar',
                            cancelButtonText:'Cancelar acción',
                            }).then((result) => {
                            // console.log(result);
                            if (result.value) {
                                    //ajax start       
                                    let url_enviar="<?php echo $this->url->get('referencialaboral/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+rel_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                   
                                                        if(res[0]==2)
                                                        {


                                                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        fnCargarTablaDatoReferenciaLaboral_formato_gabtubos(res['sel_id']);
 
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