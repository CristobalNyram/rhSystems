<script type="text/javascript">
    function fnEliminarCategoriaVacanteEmpresa(cav_id=0,CallbackReloadTable,emp_id){
        if(cav_id!=0)
        {
 
        //sweet alert start
         Swal.fire({
                    title: 'Eliminar',
                    html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+cav_id+"</strong> de la tabla de categoria vacantes empresa?",
                    type:'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText:'Cancelar acción',
                    }).then((result) => {
                    // console.log(result);
                    if (result.value) {
                            //ajax start       
                            let url_enviar="<?php echo $this->url->get('catvacante/eliminar/') ?>";              
                                        $.ajax({
                                                type: "POST",
                                                url: url_enviar+cav_id,
                                              
                                                success: function(res)
                                                {   
                                                   
                                                       
                                                        if(res[0]=='1')
                                                        {
                                                             

                                                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                    .then((value) => {
                                                                                        CallbackReloadTable(res['emp_id'],0);

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
                                                alert('ERROR DE SERVIDOR'+res.responseText);
                                                
                                                }
                                    });

                              //ajax start      

                    }
                    });
        //sweet alert end

        }
    }
</script>