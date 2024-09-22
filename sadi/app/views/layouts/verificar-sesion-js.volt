<script>

let repeticion =  window.setInterval("verificasesion()", 60000);
  
  function verificasesion(){
    $('#hide-me').fadeOut("slow");
    let verificasesion="<?php echo $this->url->get('soporte/verificasesion/') ?>";
    let urliniciosesion="<?php echo $this->url->get() ?>";
    let urliniciosesion_aes="<?php echo $this->url->get('autoestudio/index') ?>";
    let url_actual ="<?php echo $this->request->getURI() ?>";
    $.ajax(
    {
        type: "POST",
        url: verificasesion,
        success: function(res)
        {
          if(res['estado']!=1){
            // alert("Su sesión ha terminado");
            clearInterval(repeticion);

            Swal.fire({title:'Sesión',text:'Su sesión ha terminado...',type:"error"})
                                        .then((value) => {
                                   
                                            if(url_actual=='/sadi/autoestudio/eses_principal'){
                                                window.location=urliniciosesion_aes;
                                                    // console.log(urliniciosesion_aes);
                                                    // console.log(url_actual);

                                                }else{
                                                window.location=urliniciosesion;
                                                    // console.log(urliniciosesion);
                                                    // console.log(url_actual);

                                                }

            });  

            
          

          }else{
            console.log("S");
          }
         
        }
    });
  }
</script>