<script type="text/javascript">
    function fnElimnarDatoGrupoFamiliarDetalles(dgd_id=0){
        if(dgd_id!=0)
        {
 
        //sweet alert start
         Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+dgd_id+"</strong> de la tabla de detalle de grupo familiar?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                            let url_enviar="<?php echo $this->url->get('datogrupofamiliar/eliminar_dgd/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+dgd_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                       
                                                        if(res[0]==2)
                                                        {
                                                             

                                                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        fnRecargarCargarDatogrupofamiliardetalles(res['dgf_id']);

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