<script type="text/javascript">
    function fnElimnarDatoGrupoFamiliarDetalles_formato_truper(dgd_id=0,callbackReloadTable,mesasaje_abvertencia=0){
        if(dgd_id!=0)
        {
    //sweet alert start
     let mensaje_tabla=` datos de grupo familiar`;

        if(mesasaje_abvertencia!=0){
             mensaje_tabla =mesasaje_abvertencia;

        }
        Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+dgd_id+"</strong> de la tabla de    <strong > "+mensaje_tabla+" </strong > ?",
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
                                                                                        // fnRecargarCargarDatogrupofamiliardetallesformato_gabtubos(res['dgf_id']);
                                                                                        callbackReloadTable(res['dgf_id']);
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