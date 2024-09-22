<style>
  input,select{
    border: 1px solid black!important;
    border-radius: 1rem!important;
    /* padding: 1rem!important; */
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px!important;
}
  .campo-vacio {
      border: 2px solid red!important; /* Cambia el color del borde a rojo */
    }
    label{
      color: black;
    }
    .campo-vacio ~ label {
      color: red!important; 
      font-style: italic;
    }
    .campo-vacio-label {
      color: red;
      font-style: italic;
    }
    /* body{
      background-color: #2A3F54!important;
    } */
    button.btn {
    width: max-content;
    background: #00374B !important;
    color: white !important;
    border-radius: 6px!important;
    box-shadow: 0 1px 8px rgba(0,0,0,.1);
  }
  button.btn:hover , button.btn:active{
    width: max-content;
    background: white !important;
    color: #00374B !important;
    border-radius: 6px!important;
    font-weight: bold;
    border: 1px solid #00374B!important;
    box-shadow: 0 1px 8px rgba(0,0,0,.1);
  }

  .error {
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 320px;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  /* background: #2196F3; */
  background-color: transparent;
  border-radius: 8px;
  /* box-shadow: 0px 0px 5px -3px #111; */
}

.error__icon {
    width: 20px;
    height: 20px;
    transform: translateY(-1rem);
    margin-right: 8px;
    color: red;
    font-size: 3rem;
    font-weight: bolder;
}

.error__icon path {
  fill: #fff;
}

.error__title {
  font-weight: 500;
  font-size: 14px;
  color: black;
}

.error__close {
  width: 20px;
  height: 20px;
  cursor: pointer;
  margin-left: auto;
}

.error__close path {
  fill: #fff;
}

</style>

<script type="">
  $(function () {
    $("#form_cargardatosparticipante").submit(function (event) {
      event.preventDefault();  
      let formValido = true;

      $(this).find("input, select").not('.no-req').each(function() {
        let valor = $(this).val().trim();
        let placeholder = $(this).attr("placeholder");

        // Verificar si el campo está vacío
        if (!valor) {
          alertify.alert("Aviso","Por favor completa el campo: " + placeholder, function(){ 
                       
                      });
          formValido = false;
          return false; // Detener el bucle si hay un campo vacío
        }
      });
      if (!formValido) {
        return;
      }

      let $form = $(this);
      $form.find("button").prop("disabled", true);
      let loadingAlert = alertify.alert("Cargando", "Enviando datos, por favor espera...", function() {});
      let url_enviar = "<?php echo $this->url->get('trabajador/ajax_set_llenar_por_si_mismo_info/') ?>";
      $.ajax({
        type: "POST",
        url: url_enviar+"/"+{{ folio.fol_id }},
        data: $form.serialize(),
        success: function (res) {
          loadingAlert.close(); // Cerrar la alerta de "Cargando..."
          switch (res.estado) {
            case 2:
            case '2':
                     alertify.alert("Éxito",res.mensaje, function(){ 
                      let loadingAlert = alertify.alert("Redirigiendo", "por favor espera...", function() {});

                        location.reload();
                      });
              break;
            default:
              alertify.alert("Error", "Hubo un error al procesar el formulario.",function(){
                location.reload();

              });
              break;
          }


        },
        error: function (res) {
          loadingAlert.close(); // Cerrar la alerta de "Cargando..."

        },
      });
      return false;
    });
  });
</script>

<div class="card border-light margin_title" id="container-mensaje-bienvenida">
    <div class="card-body mt-2">
      {{ image("assets/images/config/"~logoactual, "height": "50") }}
      <!-- <a href="https://www.dof.gob.mx/nota_detalle.php?codigo=5541828&fecha=23/10/2018" style="float: right; margin-top: 8px;" class="btn btn-norma" target="_blank">Revisar Norma 035 y sus fundamentos</a> -->
    </div>
    <div
      style="display: block"
      class="card border-light margin_title"
      id="container-form-datos"
    >
      <p  style="text-align: justify; font-size: 16px; margin-top: 1rem; margin-bottom: 1rem; color: black;">
        {{ mensaje_reg }}
      </p>
      <hr>
      <form method="POST" class="row col-12" id="form_cargardatosparticipante">
        <div class="ln_solid"></div>
      
        <div class="form-group col-12 col-lg-4">
          <input type="hidden" value="{{ folio.fol_id }}">
          <label for="nombre"
          class="{{ folio.fol_nombre == '' ? ' campo-vacio-label' : '' }}" 
          >Nombre(s):

          <span style="color: red;font-size: 2rem;">*</span>
          </label>
          <input
            type="text"
            class="form-control{{ folio.fol_nombre == '' ? ' campo-vacio' : '' }}"
            id="nombre"
            autocomplete="off"
            maxlength="55"
            oninput="handleInput(event)"
            name="fol_nombre"
            value="{{ folio.fol_nombre }}"
            placeholder="Nombre(s)"
            required
          />
        </div>
        <div class="form-group col-12 col-lg-4">
          <label for="apellidopaterno" 
          class="{{ folio.fol_primerapellido == '' ? ' campo-vacio-label' : '' }}" 

            >Primer Apellido
            <span style="color: red;font-size: 2rem;">*</span>
            </label
          >
          <input
            type="text"
            id="apellidopaterno"
            autocomplete="off"

            class="form-control{{ folio.fol_primerapellido == '' ? ' campo-vacio' : '' }}"

            name="fol_primerapellido"
            maxlength="55"

            value="{{ folio.fol_primerapellido }}"
            oninput="handleInput(event)"
            placeholder="Primer Apellido"
            required
          />
        </div>
        <div class="form-group col-12 col-lg-4">
          <label for="apellidopaterno" 
          class="{{ folio.fol_segundoapellido == '' ? ' campo-vacio-label' : '' }}" 

            >Segundo apellido: 
            <span style="color: red;font-size: 2rem;">*</span>
            </label
          >
          <input
            type="text"
            oninput="handleInput(event)"
            class="form-control{{ folio.fol_segundoapellido == '' ? ' campo-vacio' : '' }}"
            id="apellidopaterno"
            autocomplete="off"
            name="fol_segundoapellido"
            value="{{ folio.fol_segundoapellido }}"
            maxlength="55"
            placeholder="Segundo Apellido"
            required
          />
        </div>
        <div class="form-group col-12 col-lg-4">
          <label for="correo" 
          class="{{ folio.fol_correo == '' ? ' ' : '' }}" 

          >Correo:
          <span style="color: white;font-size: 2rem;">*</span>
        </label>

        </label>
          <input
            type="email"
            maxlength="155"
            autocomplete="off"

            class="form-control no-req {{ folio.fol_correo == '' ? ' ' : '' }}"
            oninput="handleInput(event)"
            id="correo"
            name="fol_correo"
            value="{{ folio.fol_correo }}"

            placeholder="Correo"
            
          />
        </div>
        <div class="form-group col-12 col-lg-4">
          <label for="area
          "
          class="{{ folio.fol_area == '' ? ' campo-vacio-label' : '' }}" 

          >
            Área: 
            <span style="color: red;font-size: 2rem;">*</span></label>
          <input
            type="text"
            oninput="handleInput(event)"
            class="form-control {{ folio.fol_area == '' ? ' campo-vacio' : '' }}"
            id="area"
            name="fol_area"
            maxlength="55"
            autocomplete="off"
            value="{{ folio.fol_area }}"

            placeholder="Área"
            required
          />
        </div>
        <div class="form-group col-12 col-lg-4">
          <label for="puesto"
          class="{{ folio.fol_puesto == '' ? ' rm' : '' }}" 

          >Puesto 
          <span style="color: white;font-size: 2rem;">*</span>

        </label>
          <input
            type="text"
            class="form-control no-req {{ folio.fol_puesto == '' ? ' ' : '' }}"
            oninput="handleInput(event)"
            id="puesto"
            name="fol_puesto"
            value="{{ folio.fol_puesto }}"
            autocomplete="off"
            maxlength="55"
            placeholder="Puesto"
            
          />
        </div>
      

        <div class="form-group col-12 col-lg-4">
          <label for="correo" 
          class="{{ folio.emp_id == '' ? ' campo-vacio-label' : '' }}" 

          >Empresa: <span style="color: red;font-size: 2rem;">*</span></label>
          <select 
          
          class="form-control{{ folio.emp_id == '' ? ' campo-vacio' : '' }}" 
          id="empresa" name="emp_id" required>
            <option value="" disabled selected>Selecciona una empresa</option>
            {% for empresa in empresas %}
                {% set selected = (empresa.emp_id == folio.emp_id) ? 'selected' : '' %}
                <option value="{{ empresa.emp_id }}" {{ selected }}>{{ empresa.emp_nombre }}</option>
            {% endfor %}
          </select>
          
        </div>
        
        
        

        <div class="ln_solid"></div>
      </form>
      <div class="row col-12 d-flex justify-content-end mt-2 mb-2" style="display: flex; justify-content: end;">
        <!-- <div
        style="
            border: 1px solid red;
        border-radius: 20px;
        padding: 0.2rem 0.5rem;
        "
        >
          <span
          style="    
          font-size: 2rem;
          color: red;
          font-weight: bold;"
          >*</span> CAMPOS REQUERIDOS
        </div> -->
        <div class="error">
          <div class="error__icon">
            *
          </div>
          <div class="error__title">
          
            CAMPOS REQUERIDOS
          </div>
          <!-- <div class="error__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div> -->
        </div>
      </div>

      


      <div class="row col-12 d-flex justify-content-center mt-5" style="margin-top: 1rem; display: flex;justify-content: center;">
        <button form="form_cargardatosparticipante" type="submit" class="btn btn-cuestionario btn-lg btn-block" style="width: max-content;">
          GUARDAR DATOS
        </button>
      </div>
    </div>
</div>
<script>
const camposRequeridos = document.querySelectorAll('input:not(.no-req), select:not(.no-req)');

// Agregar event listener para cada campo requerido
camposRequeridos.forEach(campo => {
  campo.addEventListener('input', function() {
    let label = this.previousElementSibling;
    if (this.value.trim() !== '') {
      this.classList.remove('campo-vacio');
        if (label) {
            label.classList.remove('campo-vacio-label');
        }
    } else {
      this.classList.add('campo-vacio');
      if (label) {
            label.classList.add('campo-vacio-label');
        }
    }

   
  });
});
</script>