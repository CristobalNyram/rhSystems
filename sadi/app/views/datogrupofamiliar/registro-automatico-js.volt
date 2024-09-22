<script>
  function  fnRegistroAutomaticoGrupoFamiliarDemasTablas(data,ese_id)
    {
        if(data.lenght==0 || ese_id==0)
        {
            alert('ERROR EN PARAMETROS DE REGISTRO AUTOMATICO');
           
        }
        else
        {
            let url_enviar="<?php echo $this->url->get('datogrupofamiliar/crear_registro_automatico_otras_tablas/') ?>";
            $.ajax({
                    url: url_enviar+ese_id,
                    method:'post',
                    data:data,
                    success:function(res){
                  
                        if(res[0]==2)
                        {
                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success", timer: 3000, 
                                                                      showCancelButton: false, 
                                                                      showConfirmButton: false })
                                                                 .then((value) => {
                                                                  
                                                  });

                        }
                        else
                        {
                            alert('ERROR EN EL PROCESO');
                        }
                      
                    },
                    error: function(res)
                                      { 
                                      alert('ERROR EN EL SERVIDOR');
                    }
                    
                });
        }
    
    }
</script>