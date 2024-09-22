   /**
     * Actualiza la barra de progreso según la cantidad de campos completados en el formulario.
     * @param {HTMLElement} progressBar - El elemento de la barra de progreso.
     * @param {NodeList} formInputs - Lista de elementos de entrada del formulario.
     * @return {void}
     */
   function actualizarBarraProgreso(progressBar, formInputs) {
    var totalCampos = formInputs.length;
    var camposCompletados = 0;

    formInputs.forEach(function(input) {
        if (input.tagName === 'SELECT') {
          // Validar el valor del select
          if (input.value > 0) {
            camposCompletados++;
          }
          console.log();
        } else {
          // Validar el valor de los input y textarea
          if (input.value !== '') {
            camposCompletados++;
          }
        }
      });

    var progreso = (camposCompletados / totalCampos) * 100;
    progressBar.style.width = progreso + '%';
    progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');
    if (progreso < 30) {
      progressBar.classList.add('bg-danger');
    } else if (progreso >= 30 && progreso < 60) {
      progressBar.classList.add('bg-warning');
    } else if (progreso >= 60 && progreso < 90) {
      progressBar.classList.add('bg-info');
    } else {
      progressBar.classList.add('bg-success');
    }
}