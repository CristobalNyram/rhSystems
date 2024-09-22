<style>
#prubea{
}
</style>
<script>
    function fnAgregarONoAReporteArchivo(arc_id,event){
            let checkbox= event.target;
        
            let url ="<?php echo $this->url->get('archivo/ajax_get_detalles_archivo/') ?>";
    
 
 
                $.ajax({
                    type: "POST",
                    url: url+arc_id,
                    success: function(data)
                    {

                        let mensaje='';
                        
                        if(data[0]['arc_reporte']=='0'){
                            mensaje='¿Está seguro que quiere agregar/adjuntar este archivo al reporte?';
                            mensaje_boton='Si, deseo adjuntarlo.';


                        }
                        if(data[0]['arc_reporte']=='1'){
                            mensaje='¿Está seguro que quiere quitar este archivo del reporte?';
                            mensaje_boton='Si, deseo quitar el archivo.';

                        }
                        
                        Swal.fire(
                        {
                            title:'Aviso'
                            ,text:mensaje
                            // ,imageUrl:'https://cdn-icons-mp4.flaticon.com/512/8717/8717966.mp4'
                            ,imageUrl:'https://cdn-icons-png.flaticon.com/128/1979/1979226.png'
                            ,showCancelButton: true
                            ,confirmButtonText:mensaje_boton
                            ,cancelButtonText: 'No, cancelar.'
                            ,imageWidth: 200
                            ,imageHeight: 200
                            ,imageAlt: mensaje
                            

                        })
                        .then((value) => {
                          
                                 if(value.value)
                                {
                               
                                let url_enviar="<?php echo $this->url->get('archivo/ajax_adjuntar_archivo_reporte/') ?>";
                                $.ajax({
                                    type: "POST",
                                    url: url_enviar+arc_id,
                                    success: function(res)
                                    {   
                                   
                                        if(res[0]==='2'){
                                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                                                    .then((value) => {
                                                                      reloadarchivo(res['ese_id']);

                                                                        });
                                        }
                                        if(res[0]==='-2'){
                                            Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                                                    .then((value) => {
                                                                        location.reload();  
                                                                        });
                                        }
                                  
                            
                                    },
                                    error: function(res)
                                    { 
                                    alert('ERROR EN EL SERVIDOR');
                                    }
                                });
                            

                                }else
                                {
                                    Swal.fire({ 
                                    title: 'La acción se canceló', 
                                    // text: "Your file has been deleted.", 
                                    timer: 2000, 
                                    showCancelButton: false, 
                                    showConfirmButton: false 
                                    }).then(res=>{
                                    

                                    if(checkbox.checked){
                                       checkbox.checked=false;
                                    }else{
                                        checkbox.checked=true;
                                    }
                                    
                                    });

                                 

                                }

                               
                                                                   
                        });
                        
                        

                    },
                    error: function(res)
                    {
                        // $("#btn_aprobar").prop("disabled", false);
                    }
                });
    }

</script>