<script>
    $(document).ready(function() {

        setTimeout(function() {
            $(window).scrollTop(0);

        }, 1000);
    });
    let contadorScroll=0;
    function scrollUp() {
    let currentPosition = window.pageYOffset || document.documentElement.scrollTop;
    let scrollAmount = 0.39; // Moverse un 39% del tamaño de la ventana hacia arriba
    let newPosition = currentPosition - (window.innerHeight * scrollAmount); // Restar para mover hacia arriba

    const options = {
        top: newPosition,
        behavior: 'smooth',
        easing: 'easeInOutQuart', // Ajusta el tipo de animación
    };

    $("html, body").animate({
        scrollTop: newPosition
    }, 700); 

    contadorScroll++;
}


    function scrollDown(element) {
    let currentPosition = window.pageYOffset || document.documentElement.scrollTop;
    //let newPosition = currentPosition + (4 * window.innerHeight * 0.01);//scroll de 2cm
    let moveToSize=.39;
    if(contadorScroll=="0"){
        moveToSize=.89;

    }else{
        moveToSize=.37;
    }
    let scrollAmount = element.dataset.scrollTo ? parseFloat(element.dataset.scrollTo) :moveToSize ;

    let newPosition = currentPosition + (window.innerHeight * scrollAmount);


        const options = {
        top: newPosition,
        behavior: 'smooth',
        easing: 'easeInOutQuart', // Ajusta el tipo de animación

         };

    // window.scrollTo(options);

    $("html, body").animate({
        scrollTop: newPosition
        }, 700); 
        contadorScroll++;
    }

    function setHeight(height) {
        document.getElementById('encuesta').style.height = height + 'px';
    }
    
     iframe = document.getElementById('encuesta');
    let ese_id = $("#ese_id-encuestacalidadservicio").val();
    let enc_id = $("#enc_id-encuestacalidadservicio").val();
    iframe.onload = function() {

        // iframe.contentDocument.getElementById("answer288595X2X17P2IA1").click();
        // Encuentra todos los contenedores de pregunta
        let questionContainers =  iframe.contentDocument.querySelectorAll('.question-container');
        let questionPresencialTel=questionContainers[2];
        let inputRadioTelefono = questionPresencialTel.querySelector('.answer-item:nth-child(2) input[type="radio"]');
        let inputRadioPresencial = questionPresencialTel.querySelector('.answer-item input[type="radio"]');

        if(__TIP_ID__=="5"){
        inputRadioTelefono.click();
        questionPresencialTel.style.display = 'none';
        inputRadioPresencial.readOnly  = true;
        inputRadioTelefono.readOnly  = true;
        inputRadioPresencial.dispatchEvent(new Event('change'));

        }
        else if(__TIP_ID__=="1"){
        inputRadioPresencial.click();
        inputRadioPresencial.dispatchEvent(new Event('change'));
        questionPresencialTel.style.display = 'none';
        inputRadioPresencial.readOnly  = true;
        inputRadioTelefono.readOnly  = true;

        }
   


        $(window).scrollTop(0);
        const radioInputs = iframe.contentDocument.querySelectorAll('input[type="radio"]');
        radioInputs.forEach(function(input) {
            input.addEventListener('click', function(event) {
                if (event.target.checked) {
                    scrollDown(event.target);
                }
            });
        });

        const liElements = iframe.contentDocument.querySelectorAll('li.button-item');
        liElements.forEach(function(element) {
            element.addEventListener('click', function(event) {
                let clickedElement = event.target;
                let parentLi = null; // Cambiado de 0 a null para asignación de objeto
                // console.log(clickedElement);
                // Verificar si el elemento clicado es un <li>, <span> o <label>
                if (clickedElement.tagName === 'LI') {
                    parentLi = clickedElement;
                } else if (clickedElement.tagName === 'SPAN') {
                    parentLi = clickedElement.parentElement.parentElement;
                } else if (clickedElement.tagName === 'LABEL') {
                    parentLi = clickedElement.parentElement;
                }
                if (parentLi) {
                    if (typeof scrollDown === 'function') {
                        scrollDown(clickedElement);
                    } else {
                    }
                }
            });
        });



        // Obtener todos los elementos textarea
        const textAreas = iframe.contentDocument.querySelectorAll('textarea');
        // Para cada textarea
        textAreas.forEach(function(textArea) {
            textArea.oninput = handleInput;
        });
       const iframeEle = document.getElementById('encuesta');
       const observer = new ResizeObserver(() => {
             setHeight(iframeEle.contentDocument.body.scrollHeight);
       });
          
          observer.observe(iframeEle.contentDocument.body);
       
    
    
      let iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
      let submitButton = iframeDocument.getElementById('ls-button-submit');
      submitButton.innerText = 'Guardar Encuesta';
      submitButton.style.display = 'none'; // Oculta el botón
    
      submitButton.classList.add('ls-move-btn', 'ls-move-submit-btn', 'action--ls-button-submit', 'btn', 'btn-lg', 'btn-primary');
      submitButton.addEventListener('click', function() {
      });
      let NoContestoEncBtn = document.createElement('button');
      NoContestoEncBtn.innerText = 'No Contestó';
      NoContestoEncBtn.classList.add('ls-move-btn', 'ls-move-submit-btn', 'action--ls-button-submit', 'btn', 'btn-lg', 'btn-danger');
      NoContestoEncBtn.id = 'nocontesto-encuestacalidadservicio'; 
      NoContestoEncBtn.setAttribute('onclick', 'javascript:void(0);');  // Evitar comportamiento por defecto
      NoContestoEncBtn.type = 'button';  
    
      
      let SigEncuestaBtn = document.createElement('button');
      SigEncuestaBtn.innerText = 'Otra encuesta';
      SigEncuestaBtn.classList.add('ls-move-btn', 'ls-move-submit-btn', 'action--ls-button-submit', 'btn', 'btn-lg', 'btn-primary');
      SigEncuestaBtn.id = 'sigEncuestaBtn';  
      SigEncuestaBtn.setAttribute('onclick', 'javascript:void(0);');  
      SigEncuestaBtn.type = 'button'; 
    
    
      let btnEnviarEncuestaFachada = document.createElement('button');
      btnEnviarEncuestaFachada.innerText = 'Enviar encuesta .';
      btnEnviarEncuestaFachada.classList.add('ls-move-btn', 'ls-move-submit-btn', 'action--ls-button-submit', 'btn', 'btn-lg');
      btnEnviarEncuestaFachada.id = 'btnEnviarEncuestaFachada';  
      btnEnviarEncuestaFachada.setAttribute('onclick', 'javascript:void(0);');  
      btnEnviarEncuestaFachada.type = 'button'; 
    
      let buttonContainer = document.createElement('div');
      buttonContainer.style.display = 'inline-block'; 
      buttonContainer.appendChild(btnEnviarEncuestaFachada);
      buttonContainer.appendChild(NoContestoEncBtn);
      buttonContainer.appendChild(SigEncuestaBtn);
      submitButton.parentNode.insertBefore(buttonContainer, submitButton.nextSibling);
    
      NoContestoEncBtn.addEventListener('click', function() {
       noContestoEncuestaCalidadServicio();
      });
    
      btnEnviarEncuestaFachada.addEventListener('click', function() {
          event.preventDefault();
          btnEnviarEncuestaFachada.disabled = true;

          fnGuardarPreguntasVerificarEncuestaContestada(ese_id, enc_id)
             .then((res) => {
                //  console.log("Guardado exitosamente:", res);
                switch (res.estatus) {
                   case 2:
                   case "2":
                         submitButton.click(); 
                   break;
                   default:
                   Swal.fire({
                      title: "AVISO",
                      text: res.mensaje,
                      inputAttributes: {
                         required: true,
                      },
                      }).then((comentario) => {
                         window.location.reload();
    
                      });
                   break;
                }
             })
             .catch((error) => {
                console.error("Error al guardar preguntas:", error);
             });
       });
       
      
    
      SigEncuestaBtn.addEventListener('click', function() {
                Swal.fire({
                title: '¿Desea cargar otra encuesta?',
                text: 'Esto descartará cualquier progreso no guardado.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    // Si el usuario confirma, recargar la página
                    $(window).scrollTop(0);
                    window.location.reload();
                }
            });
      });
    };
    
    window.addEventListener('message', function(event) {
        if (event.source === iframe.contentWindow) {
            if (event.data === 'EncuestaCompletada') {
            //  console.log(event);
                   fnCambiarEstatusEncuestaContestada(ese_id, enc_id)
                   .then((res) => {
                    //   console.log(res);
                      switch (res.estatus) {
                         case 2:
                         case "2":
                         Swal.fire({
                            title: "Éxito",
                            text: "Se guardaron las respuestas correctamente",
                            type:"success"
                            }).then((comentario) => {
                               window.location.reload();
    
                            });
                         break;
                         default:
                         break;
                      }
                   })
                   .catch((error) => {
                   
                   });
            } 
        }
    });
    
</script>
