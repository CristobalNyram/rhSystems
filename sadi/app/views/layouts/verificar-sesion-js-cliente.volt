<script>

let repeticion =  window.setInterval("verificasesionCliente()", 60000);
  
  function verificasesionCliente(){
    $('#hide-me').fadeOut("slow");
    let urliniciosesion="<?php echo $this->url->get('cliente/index/') ?>";
    let verificasesion="<?php echo $this->url->get('soporte/verificasesion/') ?>";

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
                                                window.location=urliniciosesion;
                                            

            });  

            
          

          }else{
            console.log("S");
          }
         
        }
    });
  }
</script>