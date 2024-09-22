<script>
function fnDesAsignarAnalistaEnTrafico(){
    let ese_id=$('#ese_id_re_asignar_analista_en_trafico').val();


    Swal.fire({
    title: '¿Esta seguro de designar el analista del estudio '+ese_id+'?',
    imageUrl:'https://aux2.iconspalace.com/uploads/remove-user-icon-256.png',
    imageWidth: 200,
    imageHeight: 200,
    imageAlt: '¿Deseas designar el analista del estudio '+ese_id+'?', 
    showCancelButton: true,
    confirmButtonText: "Sí",
    cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
        let url ="<?php echo $this->url->get('estudio/ajax_set_sin_analista/') ?>";
        $.ajax({
              type: "POST",
              url: url+ese_id,
              success: function(res)
              {

                if(res[0]=='2')
                {
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                        .then((value) => {
                                                                  location.reload();  

                                        }); 

                }
                if(res[0]=='-1')
                {
                   Swal.fire({title:res['titular'],html:`<strong class='text-danger'>${res['mensaje']}</strong> `,type:"warning"})
                                        .then((value) => {
                                          location.reload();  

                                        });
                }
                if(res[0]=='-2')
                {
                   Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                          .then((value) => {
                                                                  location.reload();  

                                            });
                  
                }
             
                 

              },
              error: function(res)
              {
                  alert('Error en el servidor '+res.responseText);
              }
          });


        } else {
        // Acción si el usuario hace clic en "No" o cierra el cuadro de diálogo
        Swal.fire("Acción cancelada.");
        }
  });


}


</script>