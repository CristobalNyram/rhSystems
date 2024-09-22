<script>

    function fnGetOpcionesRespuestaServicioCalidad(
        div_opc_preg_1=0,
        div_opc_preg_2=0,
        div_opc_preg_3=0,
        div_opc_preg_4=0,
        div_opc_preg_5=0,
        div_opc_preg_6=0,
        div_opc_preg_7=0,
        div_opc_preg_8=0,
        div_opc_preg_9=0,
        div_opc_preg_10=0,
        div_opc_preg_11=0,
        div_opc_preg_12=0,
        div_opc_preg_13=0,
        div_opc_preg_14=0,
        div_opc_preg_15=0,
        div_opc_preg_16=0,
        div_opc_preg_17=0,
        div_opc_preg_18=0,

        ){
    

        let url_enviar="<?php echo $this->url->get('encuestacalidad/ajax_get_textos_opciones_servicio/') ?>";
                
                $.ajax({
                        type: "POST",
                        url: url_enviar,
                            
                        success: function(res)
                        {
                            // console.log(res.data);
                            let data= res.data;

                            if(div_opc_preg_1!=0){

                                    let data_preg_1=data.preg_1_opciones;
                                    let inputs_preg_1='';
                                        data_preg_1.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input"  > 
                                            <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_1+=template;


                                        });
                                
                                    div_opc_preg_1.html(inputs_preg_1);

                            }

                            if(div_opc_preg_2!=0){

                                    let data_preg_2=data.preg_2_opciones;
                                    let inputs_preg_2='';
                                        data_preg_2.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_2+=template;


                                        });
                                
                                    div_opc_preg_2.html(inputs_preg_2);

                            }


                            if(div_opc_preg_3!=0){

                                    let data_preg_3=data.preg_3_opciones;
                                    let inputs_preg_3='';
                                        data_preg_3.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_3+=template;


                                        });
                                
                                    div_opc_preg_3.html(inputs_preg_3);

                            }


                            if(div_opc_preg_4!=0){

                                    let data_preg_4=data.preg_4_opciones;
                                    let inputs_preg_4='';
                                        data_preg_4.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_4+=template;


                                        });
                                
                                    div_opc_preg_4.html(inputs_preg_4);

                            }

                            if(div_opc_preg_5!=0){

                                    let data_preg_5=data.preg_5_opciones;
                                    let inputs_preg_5='';
                                        data_preg_5.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_5+=template;


                                        });
                                
                                        div_opc_preg_5.html(inputs_preg_5);

                            }


                            if(div_opc_preg_6!=0){

                                    let data_preg_6=data.preg_6_opciones;
                                    let inputs_preg_6='';
                                        data_preg_6.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_6+=template;


                                        });
                                
                                        div_opc_preg_6.html(inputs_preg_6);

                            }


                            if(div_opc_preg_7!=0){

                                    let data_preg_7=data.preg_7_opciones;
                                    let inputs_preg_7='';
                                        data_preg_7.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" data-scroll-to=".30" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_7+=template;


                                        });
                                
                                        div_opc_preg_7.html(inputs_preg_7);

                            }

                            

                            if(div_opc_preg_8!=0){

                                
                                    let data_preg_8=data.preg_8_opciones;
                                    let inputs_preg_8='';
                                        data_preg_8.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input"  onchange="show_input_if(event.currentTarget.value,3,'container_8_1-encuestacalidadservicio'); " data-scroll-to=".30"> 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_8+=template;


                                        });
                                
                                        div_opc_preg_8.html(inputs_preg_8);

                            }


                            if(div_opc_preg_9!=0){

                                    let data_preg_9=data.preg_9_opciones;
                                    let inputs_preg_9='';
                                        data_preg_9.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_9+=template;


                                        });
                                
                                        div_opc_preg_9.html(inputs_preg_9);

                            }


                            if(div_opc_preg_10!=0){

                                    let data_preg_10=data.preg_10_opciones;
                                    let inputs_preg_10='';
                                        data_preg_10.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_10+=template;


                                        });
                                
                                        div_opc_preg_10.html(inputs_preg_10);

                            }


                            if(div_opc_preg_11!=0){

                                    let data_preg_11=data.preg_11_opciones;
                                    let inputs_preg_11='';
                                        data_preg_11.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_11+=template;


                                        });
                                
                                        div_opc_preg_11.html(inputs_preg_11);

                            }


                            if(div_opc_preg_12!=0){

                                    let data_preg_12=data.preg_12_opciones;
                                    let inputs_preg_12='';
                                        data_preg_12.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" onchange="show_input_if(event.currentTarget.value,1,'container_12-encuestacalidadservicio'); "> 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_12+=template;


                                        });
                                
                                        div_opc_preg_12.html(inputs_preg_12);

                            }
              


                            if(div_opc_preg_13!=0){

                                    let data_preg_13=data.preg_13_opciones;
                                    let inputs_preg_13='';
                                        data_preg_13.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_13+=template;


                                        });
                                
                                        div_opc_preg_13.html(inputs_preg_13);

                            }
              


                            if(div_opc_preg_14!=0){

                                    let data_preg_14=data.preg_14_opciones;
                                    let inputs_preg_14='';
                                        data_preg_14.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_14+=template;


                                        });
                                
                                        div_opc_preg_14.html(inputs_preg_14);

                            }
              
                        
                            if(div_opc_preg_15!=0){

                                    let data_preg_15=data.preg_15_opciones;
                                    let inputs_preg_15='';
                                        data_preg_15.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input"  onchange="show_input_if(event.currentTarget.value,5,'container_15-encuestacalidadservicio');" data-scroll-to=".20" "> 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_15+=template;


                                        });
                                
                                        div_opc_preg_15.html(inputs_preg_15);

                            }
              
                            if(div_opc_preg_16!=0){

                                    let data_preg_16=data.preg_16_opciones;
                                    let inputs_preg_16='';
                                        data_preg_16.forEach(element => {
                                            let template=`    
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" onchange="show_input_if(event.currentTarget.value,1,'container_16-encuestacalidadservicio'); " > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_16+=template;


                                        });
                                
                                        div_opc_preg_16.html(inputs_preg_16);

                            }

                            if(div_opc_preg_17!=0){

                                    let data_preg_17=data.preg_17_opciones;
                                    let inputs_preg_17='';
                                        data_preg_17.forEach(element => {
                                            let template=` 
                                            <div class="form-check form-check-flex-center">
                                                <input  type="radio"/ name="${element.name}" value="${element.valor}"  id="${element.name}-${element.valor}"  class="input-radio-custom scroll-input" onchange="show_input_if(event.currentTarget.value,4,'container_17-encuestacalidadservicio'); " > 
                                                <label class="col-form-label title-busq  h6" for="${element.name}-${element.valor}" style="margin-top: 0;  margin-bottom: 0;" >${element.texto}</label>
                                        </div>`;
                                        inputs_preg_17+=template;


                                        });
                                
                                        div_opc_preg_17.html(inputs_preg_17);

                            }
              

                        },
                        error: function(data)
                        {
                            alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
                            
                        }
                });

    }



    //funcion para hacer scroll solito 
    function scrollDown(element) {
    let currentPosition = window.pageYOffset || document.documentElement.scrollTop;
    //let newPosition = currentPosition + (4 * window.innerHeight * 0.01);//scroll de 2cm
    let scrollAmount = element.dataset.scrollTo ? parseFloat(element.dataset.scrollTo) : .11;

    let newPosition = currentPosition + (window.innerHeight * scrollAmount);


        const options = {
        top: newPosition,
        behavior: 'smooth',
        easing: 'easeInOutQuart', // Ajusta el tipo de animación

         };

    // window.scrollTo(options);

    $("html, body").animate({
        scrollTop: newPosition
        }, 700); // Ajusta la duración de la animación (en milisegundos)
    }

    document.addEventListener("click", function(event) {
    if (event.target.classList.contains("scroll-input")) {
        scrollDown(event.target);
    }
    });

    //funcion para hacer scroll solito fin

</script>