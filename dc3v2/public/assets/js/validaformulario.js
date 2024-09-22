function isEmail(email) {
          var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
          return regex.test(email);
        }

        $( "#formcontactsubmit" ).click(function() {
            var response = grecaptcha.getResponse();

            if(response.length == 0){
                alert('No ha habilitado el reCAPTCHA');
                return false;
            }
            // console.log(document.getElementById('formcontactname').value):
            if(document.getElementById('formcontactname').value == ""){
                alert('El campo de nombre es requerido');
                return false;
            }
            if(document.getElementById('formcontactemail').value == ""){
                alert('El campo de email es requerido');
                return false;
            }
            if(!isEmail(document.getElementById('formcontactemail').value)){
                alert('Colocar un email válido');
                return false;
            }
        });

        $( "#form-subscribesubmit" ).click(function() {
                        
            if(document.getElementById('email-subscribe').value == ""){
                alert('El campo de email es requerido');
                return false;
            }
            if(!isEmail(document.getElementById('email-subscribe').value)){
                alert('Colocar un email válido');
                return false;
            }
        });
