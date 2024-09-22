<script>

function llenarSelectValoracionContinuaSiNo(selectId, selectedValue=0) {
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
      var optionSi = document.createElement("option");
      optionSi.text = "SÍ";
      optionSi.value = "2";
      select.appendChild(optionSi);

      var optionNo = document.createElement("option");
      optionNo.text = "NO";
      optionNo.value = "1";
      select.appendChild(optionNo);

      // Opciones "1", "2", "3", "4", "5"
    /*  var opciones = ["1", "2", "3", "4", "5"];
      for (var i = 0; i < opciones.length; i++) {
        var option = document.createElement("option");
        option.text = opciones[i];
        option.value = opciones[i];
        select.appendChild(option);
      }*/

      // Establecer opción seleccionada
      select.value = "-1";
      // Simular evento onchange
      var event = new Event("change");
      select.dispatchEvent(event);
    }

</script>