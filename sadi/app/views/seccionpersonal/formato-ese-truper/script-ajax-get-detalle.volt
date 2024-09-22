<script>
    function fnCargarDatosDelFormularioJformatoTruper(ese_id=0){
            
            let form_seccionI=document.getElementById('form_estudio_seccionDatosReferencias_formato_ese_truper');
            form_seccionI.reset();
           
            
            let url_enviar="<?php echo $this->url->get('seccionpersonal/ajax_get_create_detalle/') ?>";
  
              $.ajax({
                      type: "POST",
                      url: url_enviar+ese_id,
                        
                      success: function(data)
                      {
                            $('#sep_id-formato_truper').val(data.data.sep_id);
                   
                           fnCargarTablaDatoReferenciaPersonalFormatoTruper(data.data.sep_id);
                           fnCargarTablaDatoReferenciaVecinalFormatoTruper(data.data.sep_id);
                           fnCargarTablaDatoReferenciaFamiliarFormatoTruper(data.data.sep_id);


                      },
                      error: function(data)
                      {
                          Swal.fire({title:'Error',text:'No se puedieron cargar los datos vuelve a intentar de nuevo.',type:"error"})
                                                                 .then((value) => {
                                                                     });
                        
                      }
             });
  
      }
  
    
  
  </script>