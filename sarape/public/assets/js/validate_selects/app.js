"use strict";

/*
 * Valida que los selects tengan uno de los valores posibles seleccionados.
 *
 * @param {Array} selects - Un array de objetos select con propiedades `id` y `name`.
 * @param {Array} valoresPosibles - Un array de valores posibles que se pueden seleccionar en los selects.
 * @return {boolean} True si todos los selects tienen uno de los valores posibles seleccionados, false en caso contrario.
 */
function validarSelects(selects, valoresPosibles) {
    for (var i = 0; i < selects.length; i++) {
        var select = $(selects[i].id);
        var selectedValue = select.val();
        var selectName = selects[i].name;


       // console.log(valoresPosibles.includes(selectedValue));
        if (valoresPosibles.includes(selectedValue)) {
            var errorMessage = "Debe seleccionar " + selectName.replace("_", " ") + "  ";
            Swal.fire({
                title: "Aviso",
                text: errorMessage,
                type: "warning"
            }).then((value) => {
                // Mover el enfoque al select incorrecto
                select.focus();
                // Desplazar hasta el select incorrecto
                // Obtener la posición del select incorrecto
                var selectPosition = select.offset().top;

                // Desplazar suavemente hasta el select incorrecto
                $('html, body').animate({
                    scrollTop: selectPosition
                }, 500); // Puedes ajustar la duración del desplazamiento según sea necesario

                // Animación para marcar el select incorrecto
                select.animate({ backgroundColor: "#ffcccc" }, 500, function() {
                    select.animate({ backgroundColor: "initial" }, 500);
                });
            });
            return false;

        
        }
    }

    return true;
}
// Ejemplo de uso
/*var selects = [
    { id: "#emp_id", name: "Emp ID" },
    { id: "#cne_id", name: "CNE ID" },
    { id: "#cen_id", name: "CEN ID" },
    { id: "#tif_id", name: "TIF ID" }
];*/

/*var valoresPosibles = [
    "-1",
    "0",
    "-2"
];*/

// Llamar a la función validarSelects y recibir el resultado
//var isValid = validarSelects(selects, valoresPosibles);
