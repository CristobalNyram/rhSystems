<script>
     function fnElimnarSituacionEconomicaIngresosFamiliares(sei_id=0,callbackReloadTable){
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
                            let url_enviar="<?php echo $this->url->get('situacioneconomicaingresos/eliminarIngresoFamiliar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+sei_id,
                                              
                                                success: function(res)
                                                {   
                                                
                                                        if(res[0]==2)
                                                        {

                                                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        callbackReloadTable(res['sef_id']);
                                                                                        //  $('#sef_totalingresos-formato_truper').val(res['sef_totalingresos']);
                                                                                        getTotalSituacionFinacieraFamiliar('ingreso_familiar-formato_truper','sef_totalingresosfamiliares-formato_truper',$('#ese_id_ese_actual_formato_ese_truper').text())
                                                                                         
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