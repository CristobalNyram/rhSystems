<script>
    function fnElimnaEmpleoOculto(epl_id=0,callback=0){
       if(epl_id!=0)
       {
   
        //console.log(epl_id);
        //sweet alert start
        Swal.fire({
                   title: 'Eliminar',
                   html:"¿Está seguro de   <strong style='color:red;'> eliminar el registro con ID "+epl_id+"</strong> de la tabla de empleos ocultos?",
                   type:'question',
                   showCancelButton: true,
                   confirmButtonText: 'Si, eliminar',
                   cancelButtonText:'Cancelar acción',
                   }).then((result) => {
                   if (result.value) {
                           //ajax start       
                           let url_enviar="<?php echo $this->url->get('empleooculto/eliminar/') ?>";              
                                       $.ajax({
                                               type: "POST",
                                               url: url_enviar+epl_id,
                                             
                                               success: function(res)
                                               {   
                                              //  console.log(res);

                                                  
                                                       if(res[0]==2)
                                                       {


                                                               Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                                   .then((value) => {
                                                                                        if(callback!=0){
                                                                                                callback(res['sel_id']);
                                                                                        }else{
                                                                                                CargarTablaDatoEmpleosOcultos(res['sel_id']);

                                                                                        }

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