$(document).ready(function() {
  $.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg !== element.value;
   }, "Value must not equal arg.");

  $("#registro").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
          pol_id : {valueNotEquals:"-1"},
          end_tipo : {valueNotEquals:"-1"},
          end_vigenciainicio : {valueNotEquals:""},
          ase_id : {valueNotEquals:"-1"},
          cli_id : {valueNotEquals:"-1"},
          age_id : {valueNotEquals:"-1"},
          ram_id : {valueNotEquals:"-1"},
          ase_rfc : {required: true, pattern: /^(([A-Z]|[a-z]|&){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          cli_rfc : {required: true, pattern: /^(([A-Z]|[a-z]|&){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          adm_rfc : {required: true, pattern: /^(([A-Z]|[a-z]|&){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
          ase_pagweb: {required: true, pattern: /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/},
          usu_contrasena : {required: true, pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,}$/}
          // pai_nombre: { required: true, minlength: 3, maxlength:150, pattern: /^(([A-ZÑÁÉÍÓÚ ]|[a-zñáéíóú ]){3,150})$/}
      },
      messages: {
        pol_id:{
            valueNotEquals: "Seleccione un tipo."
          },
        end_tipo:{
            valueNotEquals: "Seleccione un tipo."
          },
        end_vigenciainicio:{
            valueNotEquals: "Seleccione una fecha."
          },
        ase_id:{
            valueNotEquals: "Seleccione una aseguradora."
          },
        cli_id:{
            valueNotEquals: "Seleccione un cliente."
          },
        age_id:{
            valueNotEquals: "Seleccione un conducto."
          },
        ram_id:{
            valueNotEquals: "Seleccione un ramo."
          },
        ase_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
        cli_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
        adm_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },
        ase_pagweb: {
            pattern: "No cumple con la estructura ej. https://www.google.com https://google.com"
        },
        usu_contrasena:{
            pattern:"La contraseña debe tener al menos 8 dígitos, 1 mayúscula, 1 minúscula, 1 número y 1 caracter no alfanumérico (@*_# por ejemplo)"
        }
        
      },
      submitHandler: function(form){
        document.getElementById("enviar_id").disabled = true;
        document.getElementById("enviar_id").style.cursor = "not-allowed";
        return true;
        }

      //,'onbeforesubmit': 'return false'
  });

  $("#frm_crearcliente").validate({
      errorClass: "my-error-class",
      validClass: "my-valid-class",
      rules: {
          cli_rfc : {required: true, pattern: /^(([A-Z]|[a-z]|&){3,4})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))$/},
      },
      messages: {
        cli_rfc:{
            pattern: "El RFC no cumple con la estructura necesaria."
          },        
      },
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

});
