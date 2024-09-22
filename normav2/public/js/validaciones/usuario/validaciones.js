$(document).ready(function() {
  $("#usuario_nuevo").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
        usu_id : {required: true, min: 1, max: 10000},
        usu_password: {required: true, minlength: 8, maxlength:255},
        usu_nombre: {required: true, minlength: 3, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,150})$/},
        usu_apellidop : {required: true, minlength: 3, maxlength:100, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,100})$/},
        usu_apellidom : {required: true, maxlength:100, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){0,100})$/},
        usu_rfc : {required: true, pattern: /^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
        usu_curp : {required: true, pattern: /^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/},
        usu_nss : {required: true, pattern: /^([0-9]){11,20}$/},
        usu_correo_personal : {maxlength: 255, pattern:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/},
        usu_fechanacimiento : {required: true},
        usu_celular : {required: true, pattern: /^(\d{10})$/},
        usu_hijos : {required: true, min: 0},
        usu_calle : {required: true, minlength: 3, maxlength:100},
        usu_exterior: {required: true, minlength: 1, maxlength:15},
        usu_interior: {required: false, minlength: 1, maxlength:15},
        usu_colonia: {required: true, minlength: 3, maxlength:100},
        usu_municipio: {required: true, minlength: 3, maxlength:100},
        usu_proxevaluacion : {required: true},
        usu_licenciatura: {required:true,minlength: 3, maxlength: 255},
        usu_experiencia: {required:true,minlength: 1, maxlength: 50},
        usu_cuotahora: {pattern: /^(\d+|\d+.\d{2})$/},
        usu_fechaingreso : {required: true},
        usu_vigenciavacaciones : {required: true},
        usu_correo : {required: true, maxlength: 255, pattern:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/},
        usu_telefono : {required: false, pattern: /^(\d{7,10})$/},
        usu_extension : {required: false, pattern: /^(\d{1,10})$/},
        usu_nocuenta : {required: false, pattern: /^(\d{10,50})$/},
      },
      messages: {
          usu_id:{
              required: "Debe introducir el ID.",
              min: "No debe ingresar números menores a 1.",
              max: "No debe ingresar números mayores a 10,000."
            },
          usu_password:{
              required: "Debe introducir una contraseña.",
              minlength: "La contraseña no debe ser menor a 8 caracteres.",
              maxlength: "La contraseña no debe ser mayor a 255 caracteres."
            },
          usu_nombre:{
              required: "Debe introducir un Nombre.",
              minlength:"No debe ingresar un nombre con menos de 3 letras.",
            	maxlength:"No debe ingresar un nombre mayor a 150 letras.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_apellidop:{
              required: "Debe introducir el Apellido Paterno.",
              minlength:"El apellido paterno deber tener por lo menos 3 caracteres.",
              maxlength:"El apellido paterno no debe superar los 100 caracteres.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_apellidom:{
              required:"Debe introducir el Apellido Materno.",
              maxlength: "El apellido materno no debe superar los 100 caracteres.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_rfc:{
              required: "Debe introducir el RFC.",
              pattern: "El RFC no cumple con la estructura necesaria."
            },
          usu_curp:{
              required: "Debe introducir la CURP.",
              pattern: "La CURP no cumple con la estructura necesaria."
            },
          usu_nss:{
              required: "Debe introducir el NSS.",
              pattern: "El nss únicamente puede tener 11 ó 20 dígitos."
            },
          usu_correo_personal:{
              required: "Debe introducir algún correo electrónico.",
              pattern: "Correo electónico inválido.",
              maxlength: "El correo electrónico no debe superar los 255 caracteres."
            },
          usu_fechanacimiento:{
              required: "Debe introducir una fecha de nacimiento."
            },
          usu_celular:{
              required: "Debe introducir un número celular.",
              pattern: "Ingrese sólo números a 10 dígitos."
            },
          usu_hijos:{
              required: "Debe introducir la cantidad de hijos.",
              min: "Mínimo 0."
            },
          usu_calle:{
              required: "Debe introducir el nombre de la calle.",
              minlength: "El nombre de la calle debe tener por lo menos 3 letras.",
            	maxlength: "El nombre de la calle no debe superar los 100 caracteres."
            },
          usu_exterior:{
            	required: "Debe introducir el número exterior.",
            	minlength: "El número debe contener al menos un caracter.",
            	maxlength: "El número no debe superar los 15 caracteres."
            },
          usu_interior:{
            	minlength: "El número debe contener al menos un caracter.",
            	maxlength: "El número no debe superar los 15 caracteres."
            },
          usu_colonia:{
              required: "Debe introducir una colonia.",
              minlength: "El nombre de la colonia debe tener por lo menos 3 letras.",
            	maxlength: "El nombre de la colonia no debe superar los 100 caracteres."
            },
          usu_municipio:{
              required: "Debe introducir un municipio.",
              minlength: "El nombre del municipio debe tener por lo menos 3 letras.",
            	maxlength: "El nombre del municipio no debe superar los 100 caracteres."
            },
          usu_proxevaluacion:{
              required: "Debe introducir la fecha de próxima evaluación."
            },
          usu_licenciatura:{
              required: "Debe introducir el nombre de la Licenciatura.",
              minlength: "La licenciatura debe tener por lo menos 3 letras.",
            	maxlength: "La licenciatura no debe superar los 255 caracteres."
            },
          usu_experiencia:{
              required:"Debe ingresar la experiencia.",
              minlength: "La experiencia debe tener por lo menos 1 letra.",
            	maxlength: "La experiencia no debe superar los 50 caracteres."
            },
          usu_cuotahora : {
                pattern: 'Verifique la cuota.'
            },
          usu_fechaingreso:{
              required: "Debe introducir una fecha de ingreso."
            },
          usu_vigenciavacaciones:{
              required: "Debe introducir la vigencia de vacaciones."
            },
          usu_correo:{
              required: "Debe introducir algún correo electrónico.",
              pattern: "Correo electrónico inválido.",
              maxlength: "El correo electrónico no debe superar los 255 caracteres."
            },
          usu_telefono:{
              pattern: "Ingrese sólo números a 7 o 10 dígitos."
            },
          usu_extension:{
              pattern: "Ingrese sólo números de 1 a 10 dígitos."
            },
          usu_nocuenta:{
              pattern: "Solo puede ingresar 10 ó 50 dígitos."
            },
      },
      invalidHandler: function(event, validator) {
        alertify.alert("Error","Todos los campos requeridos no han sido completados, verifica las dos ventanas.");
      },
      submitHandler: function(form){
        return true;
      }

      //,'onbeforesubmit': 'return false'
  });
  $("#usuario_editar").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
        usu_id : {required: true, min: 1, max: 10000},
        // usu_password: {required: true, minlength: 8, maxlength:255},
        usu_nombre: {required: true, minlength: 3, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,150})$/},
        usu_apellidop : {required: true, minlength: 3, maxlength:100, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,100})$/},
        usu_apellidom : {required: true, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){0,100})$/},
        usu_rfc : {required: true, pattern: /^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
        usu_curp : {required: true, pattern: /^(([A-Z]|[a-z]){4})([0-9]{6})((([A-Z]|[a-z]){6}))((([A-Z]|[a-z]|[0-9]){2}))$/},
        usu_nss : {required: true, pattern: /^([0-9]){11,20}$/},
        usu_correo_personal : {maxlength: 255, pattern:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/},
        usu_fechanacimiento : {required: true},
        usu_celular : {required: true, pattern: /^(\d{10})$/},
        usu_hijos : {required: true, min: 0},
        usu_calle : {required: true, minlength: 3, maxlength:100},
        usu_exterior: {required: true, minlength: 1, maxlength:15},
        usu_interior: {required: false, minlength: 1, maxlength:15},
        usu_colonia: {required: true, minlength: 3, maxlength:100},
        usu_municipio: {required: true, minlength: 3, maxlength:100},
        usu_proxevaluacion : {required: true},
        usu_licenciatura: {required:true,minlength: 3, maxlength: 255},
        usu_experiencia: {required:true,minlength: 1, maxlength: 50},
        usu_cuotahora: {pattern: /^(\d+|\d+.\d{2})$/},
        usu_fechaingreso : {required: true},
        usu_vigenciavacaciones : {required: true},
        usu_correo : {required: true, maxlength: 255, pattern:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/},
        usu_telefono : {required: false, pattern: /^(\d{7,10})$/},
        usu_extension : {required: false, pattern: /^(\d{1,10})$/},
        usu_nocuenta : {required: false, pattern: /^(\d{10,50})$/},
      },
      messages: {
        usu_id:{
              required: "Debe introducir el ID.",
              min: "No debe ingresar números menores a 1.",
              max: "No debe ingresar números mayores a 10,000."
            },
          usu_password:{
              required: "Debe introducir una contraseña.",
              minlength: "La contraseña no debe ser menor a 8 caracteres.",
              maxlength: "La contraseña no debe ser mayor a 255 caracteres."
            },
          usu_nombre:{
              required: "Debe introducir un Nombre.",
              minlength:"No debe ingresar un nombre con menos de 3 letras.",
              maxlength:"No debe ingresar un nombre mayor a 150 letras.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_apellidop:{
              required: "Debe introducir el Apellido Paterno.",
              minlength:"El apellido paterno deber tener por lo menos 3 caracteres.",
              maxlength:"El apellido paterno no debe superar los 100 caracteres.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_apellidom:{
              required:"Debe introducir el Apellido Materno.",
              maxlength: "El apellido materno no debe superar los 100 caracteres.",
              pattern: "Debe ingresar únicamente letras."
            },
          usu_rfc:{
              required: "Debe introducir el RFC.",
              pattern: "El RFC no cumple con la estructura necesaria."
            },
          usu_curp:{
              required: "Debe introducir la CURP.",
              pattern: "La CURP no cumple con la estructura necesaria."
            },
          usu_nss:{
              required: "Debe introducir el NSS.",
              pattern: "El nss únicamente puede tener 11 ó 20 dígitos."
            },
          usu_correo_personal:{
              required: "Debe introducir algún correo electrónico.",
              pattern: "Correo electónico inválido.",
              maxlength: "El correo electrónico no debe superar los 255 caracteres."
            },
          usu_fechanacimiento:{
              required: "Debe introducir una fecha de nacimiento."
            },
          usu_celular:{
              required: "Debe introducir un número celular.",
              pattern: "Ingrese sólo números a 10 dígitos."
            },
          usu_hijos:{
              required: "Debe introducir la cantidad de hijos.",
              min: "Mínimo 0."
            },
          usu_calle:{
              required: "Debe introducir el nombre de la calle.",
              minlength: "El nombre de la calle debe tener por lo menos 3 letras.",
              maxlength: "El nombre de la calle no debe superar los 100 caracteres."
            },
          usu_exterior:{
              required: "Debe introducir el número exterior.",
              minlength: "El número debe contener al menos un caracter.",
              maxlength: "El número no debe superar los 15 caracteres."
            },
          usu_interior:{
              minlength: "El número debe contener al menos un caracter.",
              maxlength: "El número no debe superar los 15 caracteres."
            },
          usu_colonia:{
              required: "Debe introducir una colonia.",
              minlength: "El nombre de la colonia debe tener por lo menos 3 letras.",
              maxlength: "El nombre de la colonia no debe superar los 100 caracteres."
            },
          usu_municipio:{
              required: "Debe introducir un municipio.",
              minlength: "El nombre del municipio debe tener por lo menos 3 letras.",
              maxlength: "El nombre del municipio no debe superar los 100 caracteres."
            },
          usu_proxevaluacion:{
              required: "Debe introducir la fecha de próxima evaluación."
            },
          usu_licenciatura:{
              required: "Debe introducir el nombre de la Licenciatura.",
              minlength: "La licenciatura debe tener por lo menos 3 letras.",
              maxlength: "La licenciatura no debe superar los 255 caracteres."
            },
          usu_experiencia:{
              required:"Debe ingresar la experiencia.",
              minlength: "La experiencia debe tener por lo menos 1 letra.",
              maxlength: "La experiencia no debe superar los 50 caracteres."
            },
          usu_cuotahora : {
                pattern: 'Verifique la cuota.'
            },
          usu_fechaingreso:{
              required: "Debe introducir una fecha de ingreso."
            },
          usu_vigenciavacaciones:{
              required: "Debe introducir la vigencia de vacaciones."
            },
          usu_correo:{
              required: "Debe introducir algún correo electrónico.",
              pattern: "Correo electrónico inválido.",
              maxlength: "El correo electrónico no debe superar los 255 caracteres."
            },
          usu_telefono:{
              pattern: "Ingrese sólo números a 7 o 10 dígitos."
            },
          usu_extension:{
              pattern: "Ingrese sólo números de 1 a 10 dígitos."
            },
          usu_nocuenta:{
              pattern: "Solo puede ingresar 10 ó 50 dígitos."
            },
      },
      invalidHandler: function(event, validator) {
        alertify.alert("Error","Todos los campos requeridos no han sido completados, verifica las dos ventanas.");
      },
      submitHandler: function(form){
        return true;
      }

      //,'onbeforesubmit': 'return false'
  });
});
