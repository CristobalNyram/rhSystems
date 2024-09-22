$(document).ready(function() {
  $("#registro").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
          emp_rfc : {required: true, pattern: /^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          ins_rfc : {required: true, pattern: /^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          adm_rfc : {required: true, pattern: /^(([A-Z]|[a-z]){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          cuo_clave : {required: true, pattern: /^C(C|A|I|L)(L{0,1})-([0-9]{2,3})-((([0-9]){2}))$/},
          // pai_nombre: { required: true, minlength: 3, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,150})$/}
      },
      messages: {
        emp_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
        ins_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
        adm_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
         cuo_clave:{
            pattern: "La clave de curso no cumple con la estructura (Ej. CC-01-20)"
          }
        
      },
      //submitHandler: function(form){
        //return true;
        //}

      //,'onbeforesubmit': 'return false'
  });
  $("#pais_editar").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
        pai_nombre: { required: true, minlength: 3, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,150})$/}
      },
      messages: {
        pai_nombre: {
            required:"Debe introducir un nombre.",
            minlength:"No puede ingresar un nombre de menos de 3 caracteres.",
            maxlength:"No puede ingresar un nombre mayor de 100 caracteres.",
            pattern: "Debe ingresar unicamente letras."
          },
      },
      //submitHandler: function(form){
        //return true;
        //}

      //,'onbeforesubmit': 'return false'
  });

  $("#cuestionariouno").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    errorElement: "div",
        wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            element = element.parent();
            if (element.parent().hasClass('group')){
                element = element.parent();
            }


            offset = element.offset();
            error.insertBefore(element)
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('left', offset.left + element.outerWidth());
            error.css('top', offset.top);
    }
     
      
      //submitHandler: function(form){
        //return true;
        //}

      //,'onbeforesubmit': 'return false'
  });

  $("#cuestionariodos").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    errorElement: "div",
        wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            element = element.parent();
            if (element.parent().hasClass('group')){
                element = element.parent();
            }


            offset = element.offset();
            error.insertBefore(element)
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('left', offset.left + element.outerWidth());
            error.css('top', offset.top);
    }
     
      
      //submitHandler: function(form){
        //return true;
        //}

      //,'onbeforesubmit': 'return false'
  });

  $("#cuestionariotres").validate({
    errorClass: "my-error-class",
    validClass: "my-valid-class",
    errorElement: "div",
        wrapper: "div",  // a wrapper around the error message
        errorPlacement: function(error, element) {
            element = element.parent();
            if (element.parent().hasClass('group')){
                element = element.parent();
            }


            offset = element.offset();
            error.insertBefore(element)
            error.addClass('message');  // add a class to the wrapper
            error.css('position', 'absolute');
            error.css('left', offset.left + element.outerWidth());
            error.css('top', offset.top);
    }
     
      
      //submitHandler: function(form){
        //return true;
        //}

      //,'onbeforesubmit': 'return false'
  });
});
