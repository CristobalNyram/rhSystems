<script>
    function llenarSelectValoracionCita(selectId, selectedValue) {
      var select = document.getElementById(selectId);

      // Limpiar opciones anteriores
      while (select.firstChild) {
        select.removeChild(select.firstChild);
      }

      // Opción por defecto: -1 Seleccionar
      var optionDefault = document.createElement("option");
      optionDefault.text = "Seleccionar";
      optionDefault.value = "-1";
      select.appendChild(optionDefault);

      // Opción "N/A"
      var optionNA = document.createElement("option");
      optionNA.text = "N/A";
      optionNA.value = "N/A";
      select.appendChild(optionNA);

      // Opciones "1", "2", "3", "4", "5"
      var opciones = ["1", "2", "3", "4", "5"];
      for (var i = 0; i < opciones.length; i++) {
        var option = document.createElement("option");
        option.text = opciones[i];
        option.value = opciones[i];
        select.appendChild(option);
      }

      // Establecer opción seleccionada
      select.value = selectedValue !== null && selectedValue !== undefined ? selectedValue : "-1";

      // Simular evento onchange
      var event = new Event("change");
      select.dispatchEvent(event);
    }

</script>