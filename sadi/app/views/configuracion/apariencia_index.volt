{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
<!-- vue js -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function() {
           
            var Div_barra_superior_color = document.querySelector('.navbar-custom-crm');
            var Div_btn_confirmar_fondo = document.querySelector('.btn-buscar');

            var colorInput_barra_superior_color = document.getElementById('barra_superior_color');
            var colorInput_border_barra_superior_color = document.getElementById('border_barra_superior_color');
            var colorInput_btn_confirmar_fondo = document.getElementById('btn_confirmar_fondo');

            // Agregar un evento de cambio al input
            colorInput_barra_superior_color.addEventListener('change', function() {
            // Obtener el valor del color seleccionado
            var color_back = colorInput_barra_superior_color.value;
            var color_border = colorInput_border_barra_superior_color.value;

            // Actualizar el estilo del div con el color seleccionado
            Div_barra_superior_color.style.cssText = 'background-color: ' + color_back + ' !important; border-bottom: solid '+color_border+' .3rem !important;';
            });



            // Agregar un evento de cambio al input
            colorInput_border_barra_superior_color.addEventListener('change', function() {
            // Obtener el valor del color seleccionado
            var color_back = colorInput_barra_superior_color.value;
            var color_border = colorInput_border_barra_superior_color.value;
            // Actualizar el estilo del div con el color seleccionado
            Div_barra_superior_color.style.cssText = 'background-color: ' + color_back + ' !important; border-bottom: solid '+color_border+' .3rem !important;';
            });


            colorInput_btn_confirmar_fondo.addEventListener('change', function() {
              
                var color = colorInput_btn_confirmar_fondo.value;
                // Actualizar el estilo del div con el color seleccionado
                Div_btn_confirmar_fondo.style.backgroundColor = color;
            });

    $('#form_apariencia_sistema').submit(function(event){
            let $forms = $(this);
            a=$forms.valid();
            if(a==false){
            return false;
            }
            event.preventDefault();
            let $form = $(this);
            // $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('configuracion/actualizar_apariencia/') ?>";
            $.ajax({
                type: "POST",
                url: url_enviar,
                data: $form.serialize(),
                success: function(res)
                {

                if(res[0]==2)
                {
                    $('#btnAgregarCita').hide();

                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"success"})
                    .then((value) => {
                        $form.find("button").prop("disabled", false);               
                        window.location.reload(); 

                    });


                }
                else
                {
                    Swal.fire({title:res['titular'],text:res['mensaje'],type:"error"})
                    .then((value) => {
                        location.reload();  
                    });
                }
                },
                error: function(res)
                { 
                alert('ERROR EN EL SERVIDOR');
                console.error(res.responseText);
                }
            });
            return false;
    });






  });
</script>

<div class="container-fluid  pt-1 pb-1 mb-2 mt-2 container-d-flex-and-block">
    <form id="form_apariencia_sistema" class="bg-white border-radius-9px col-12 col-md-12 p-2 m-2" action="" method="POST">

        <div class="row col-12 d-flex justify-content-center">

            <h6>Colores del sistema</h6>
        
            
        </div>

        <div class="row col-12 d-flex justify-content-center">

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Color de barra superior</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="barra_superior_color" value="{{ fondo_barra_superior }}"  name="barra_superior_color" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>
                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Border inferior de la barra</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="border_barra_superior_color" value="{{ border_barra_superior }}" name="border_barra_superior_color" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Color de cabecera de tablas</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="cabezera_datatable_color"  value="{{ cabezera_datatable_color }}" name="cabezera_datatable_color" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Color de boton de confirmar</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="btn_confirmar_fondo"  value="{{ btn_confirmar_fondo }}" name="btn_confirmar_fondo" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq"
                        title='El color del botón cuando pasas el cursor sobre él se llama "color del hover". Es el color que aparece cuando mueves el mouse sobre el botón de confirmación'
                        >El color del botón cuando pasas el cursor sobre el botón confirmar</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input 
                        title='El color del botón cuando pasas el cursor sobre él se llama "color del hover". Es el color que aparece cuando mueves el mouse sobre el botón de confirmación'

                        type="color" id="btn_confirmar_fondo_hover" value="{{ btn_confirmar_fondo_hover }}" name="btn_confirmar_fondo_hover" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>


                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Color de boton de cancelar</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="btn_cancelar_fondo" name="btn_cancelar_fondo" value="{{ btn_cancelar_fondo }}"  class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq"
                        title='El color del botón cuando pasas el cursor sobre él se llama "color del hover". Es el color que aparece cuando mueves el mouse sobre el botón de confirmación'

                        
                        >El color del botón cuando pasas el cursor sobre el botón cancelar</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input
                        title='El color del botón cuando pasas el cursor sobre él se llama "color del hover". Es el color que aparece cuando mueves el mouse sobre el botón de confirmación'

                        type="color" id="btn_cancelar_fondo_hover" name="btn_cancelar_fondo_hover"  value="{{ btn_cancelar_fondo_hover }}" class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>



                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Color de opciones en las tablas</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <input type="color" id="iconos_opciones" name="iconos_opciones" value="{{ iconos_opciones }}"  class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />

                    </div>
                </div>
        
            
                
        </div>

        <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
            <div class="col-md-2 col-12">
                <label class="col-form-label  title-busq">Fondo general de todo el sistema</label>
            </div>
            <div class="col-md-10 col-12">
                <input type="color" id="fondo_sistema_general" name="fondo_sistema_general" value="{{ fondo_sistema_general }}"  class="form-control input-rounded data-not-lt-active" placeholder="Color"  required placeholder="Color" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required />
            </div>
        </div>
        
        <div class="row mt-1 col-12 d-flex justify-content-end align-items-center">
          
            <div class="col-lg-4  col-sm-4 col-12  text-right mt-4">
                <div class="form-group ">
                    <button type="submit" style="margin-top: 0px" id="buscar" name="buscar" onclick="" class="btn-dark btn-rounded btn btn-buscar"><i class=" mdi mdi-pencil white"></i>  Actualizar</button>
                </div>
            </div>

           
        </div>
        


    </form>


    
 
    

   
</div>









