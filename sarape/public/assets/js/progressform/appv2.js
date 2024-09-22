"use strict";

 
var ProgressBarManager = {
    progressBar: null,
    form: null,
    formInputs: null,
    
    init: function(progressBarElement, formElement, inputElements) {
      this.progressBar = progressBarElement;
      this.form = formElement;
      this.formInputs = inputElements;
      
      this.addEventListeners();
    },
    
    addEventListeners: function() {
      var self = this;
      
      this.form.addEventListener('change', function() {
        self.actualizarBarraProgreso();
      });
      
      this.formInputs.forEach(function(input) {
        input.addEventListener('change', function() {
          self.actualizarBarraProgreso();
        });
      });
    },
    
    actualizarBarraProgreso: function() {
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
  };