<script type="text/javascript">
    function fnElimnarDatoAntecedentesLaboralesGrupoFamiliarDetalles(agd_id=0){
    
        if(agd_id!=0)
        {
    
             Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+agd_id+"</strong> de la tabla de antecedentes laborales familiares?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                              let url_enviar="<?php echo $this->url->get('antecedentegrupofamiliardetalles/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+agd_id,
                                                success: function(res)
                                                {            
                                                        if(res[0]==2)
                                                        {

                                                          
                                                                Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                 .then((value) => {
                                                                    fnRe_cargarTablaDatoAntecedentesgrupofamiliardetalles(res['agf_id']);
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





                    
        }
        




        
    }
</script>