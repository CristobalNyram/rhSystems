<script type="text/javascript">
    function fnEliminarDatoViviendaanteriorDetalles(dva_id=0,CallbackReloadTable){
        if(dva_id!=0)
        {
 
        //sweet alert start
         Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+dva_id+"</strong> de la tabla de detalle de datos vivienda anterior?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                            let url_enviar="<?php echo $this->url->get('datoviviendanterdetalles/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+dva_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                       
                                                        if(res[0]==2)
                                                        {
                                                             

                                                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        CallbackReloadTable(res['dav_id']);

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

                              //ajax start      

                    }
                    });
        //sweet alert end

        }
    }
</script>