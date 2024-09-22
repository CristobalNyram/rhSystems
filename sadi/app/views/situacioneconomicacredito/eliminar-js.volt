<script>
     function fnElimnarSituacionEconomicaCreditoss(sei_id=0){
        if(sei_id!=0)
        {  
      //sweet alert start
        Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+sei_id+"</strong> de la tabla de créditos vigentes?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                            let url_enviar="<?php echo $this->url->get('situacioneconomicacredito/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+sei_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                   
                                                        if(res[0]==2)
                                                        {
                                                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        $('#sie_creditos').val(res['sie_creditos_total']);

                                                                                        fnRe_CargarTablaDatoSituacionEconomicaCreditos(res['sie_id']);
                                                                                       });
                                                                                       $('#sie_creditos').val(res['sie_creditos_total']);
                                                                                       sumarTodosLosMontosEgresos();
                                                        
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