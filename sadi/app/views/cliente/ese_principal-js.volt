  
<script>
	/*	let btn = document.getElementById('btn');
      btn.addEventListener("click", function() {
        btn.setAttribute('class', 'submit process');
        btn.innerHTML = 'Procesando...';
        setTimeout(()=>{
          btn.setAttribute('class', 'submit submitted');
          btn.innerHTML = `
          <span class="tick">&#10004;</span>
          Enviado
          `;
        },5000);
      });*/
      function inciarTutorialAES(){
        introJs().setOptions({
            nextLabel: 'Siguiente',
            prevLabel : 'Atras',
            doneLabel : 'Hecho',

          steps: [{
            title: 'Bienvenido',
            intro: '👋'
          },
          {
            element: document.getElementById('seccion-ese'),

            title: 'Sección completa ',
            intro: 'Aquí encuentras las opciones necesarias para poder realizar el proceso de recolección de datos👋'
          },
          {
            title: 'Sección de formularios',
            element: document.getElementById('btn-formulario-ese'),
            intro: 'Aquí encontrarás el cuestionario donde capturarás la información.'
          },
          {
            title: 'Sección de archivos',
            element: document.getElementById('btn-archivos-ese'),
            intro: 'Da clic aquí para abrir y subir tus documentos.'
          },
          {
            title: 'Al finalizar',
            element: document.getElementById('btn-enviar-ese'),
            intro: 'Da clic aquí para enviar tu información, recuerda que una vez enviado el estudio, ya no podrás editar ni borrar los datos proporcionados.'
          }
        ]
        }).start();
      }

    $(document).ready((event)=>{

      inciarTutorialAES();
        
       
    });

    function fnCargarESE_AES(ese_id){
                $('#ver_completo_estudio-modal').modal('show');
                cargar_primer_seccion_ESE(ese_id);


            }

            function fnCargarArchivos(ese_id){
                $('#archivos-modal').modal('show');

                archivo(ese_id,0,'ese',0,0);
                //archivo('29',0,'ese','0','0')
            }

            function fnEnviarAES(aes_id,ese_id){

                    Swal.fire({
                    title: 'Aviso',
                    text: "¿Estás seguro de enviar tu estudio? ",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, enviar estudio.',
                    cancelButtonText: 'No, cancelar acción.'

                }).then((result) => {

                    if(result.value){
                        
                        let url_enviar="<?php echo $this->url->get('autoestudio/enviar_a_trafico_analista_aes/') ?>";

                        $.ajax({
                                type: "POST",
                                url: url_enviar,
                                data:{
                                    ese_id:ese_id,
                                    aes_id:aes_id,

                                },
                                success: function(res)
                                {   
                                        
                                    if(res[0]=='2')
                                    {


                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                                        .then((value) => {
                                        window.location=res['url_redireccionar'];
                                        });  

                                    
                                    }
                                    if(res[0]=='-1')
                                    {


                                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"warning"})
                                        .then((value) => {
                                        window.location=res['url_redireccionar'];
                                        });  

                                    
                                    }
                                    else
                                    {

                                        Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                                        .then((value) => {
                                        
                                        });  

                                    
                                    }
                                },
                                error: function(res)
                                { 
                                                            alert('error en el servidor...'+res.responseText);
                                }
                            });
            


                    }else{

                    }


                    
                })

            }




</script>

