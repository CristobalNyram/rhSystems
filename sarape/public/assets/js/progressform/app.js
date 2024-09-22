    "use strict";
    const ProgressBar = {
      progressBar: null,
      form: null,
      formInputs: null,
    
      /**
       * Inicializa el objeto ProgressBar.
       * @param {string} progressBarId - El ID del elemento de la barra de progreso.
       * @param {string} formId - El ID del formulario.
       * @param {string} inputSelectors - Selectores para los elementos de entrada (input, textarea, select).
       */
      init: function(progressBarId, formId, inputSelectors) {
        this.progressBar = document.getElementById(progressBarId);
        this.form = document.getElementById(formId);
        this.formInputs = this.form.querySelectorAll(inputSelectors);
    
        // Asignar evento de cambio al formulario
        this.form.addEventListener('change', () => this.actualizarBarraProgreso());
        // Asignar eventos de cambio a los select
        this.addChangeEvents();
      },
    
      /**
       * Asigna eventos de cambio (change) a los elementos select.
       */
      /*addChangeEvents: function() {
        const selects = this.form.querySelectorAll('select');
        selects.forEach(select => {
          select.onchange = () => this.actualizarBarraProgreso();
        });
      },*/
      /*addChangeEvents: function() {
        const selects = this.form.querySelectorAll('select');
        selects.forEach(select => {
          const targetId = select.dataset.target; // Obtener el ID del elemento de destino desde el atributo data-target
          if (targetId) {
            const targetElement = document.getElementById(targetId); // Obtener el elemento de destino usando el ID
            select.addEventListener('change', () => this.actualizarBarraProgreso(targetElement));
          }
        });
      },*/
      addChangeEvents: function() {
        const selects = this.form.querySelectorAll('select');
        selects.forEach(select => {
          const originalOnChange = select.onchange; // Guardar el evento onchange existente
          select.onchange = () => {
            if (originalOnChange) {
              originalOnChange(); // Llamar al evento onchange original
            }
            this.actualizarBarraProgreso(); // Llamar a la función actualizarBarraProgreso
          };
        });
      },
      /**
       * Actualiza la barra de progreso en función de los valores de los elementos de entrada.
       * @return {void}
       */
      actualizarBarraProgreso: function() {
        const totalCampos = this.formInputs.length;
        let camposCompletados = 0;
    
        this.formInputs.forEach(input => {
          if (input.tagName === 'SELECT') {
            if (input.value > 0) {
              camposCompletados++;
            }
          } else {
            if (input.value !== '') {
              camposCompletados++;
            }
          }
        });
    
        const progreso = (camposCompletados / totalCampos) * 100;
        this.progressBar.style.width = progreso + '%';
        this.progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');
    
        if (progreso < 30) {
          this.progressBar.classList.add('bg-danger');
        } else if (progreso >= 30 && progreso < 60) {
          this.progressBar.classList.add('bg-warning');
        } else if (progreso >= 60 && progreso < 90) {
          this.progressBar.classList.add('bg-info');
        } else {
          this.progressBar.classList.add('bg-success');
        }
      }
    };
    
    // Ejemplo de uso:
    //ProgressBar.init('progress-bar', 'frm_crear_vac', 'input, textarea, select');
    
      
      
