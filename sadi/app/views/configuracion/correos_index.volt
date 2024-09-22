{{ javascript_include("assets/libs/morris-js/morris.min.js") }}
{{ javascript_include("assets/libs/raphael/raphael.min.js") }}
<!-- vue js -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function() {
           
       

    $('#form_configuracion_correo').submit(function(event){
            let $forms = $(this);
            a=$forms.valid();
            if(a==false){
            return false;
            }
            event.preventDefault();
            let $form = $(this);
            // $form.find("button").prop("disabled", true);
            let url_enviar="<?php echo $this->url->get('configuracion/actualizar_envio_correo/') ?>";
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
    <form id="form_configuracion_correo" class="bg-white border-radius-9px col-12 col-md-12 p-2 m-2" action="" method="POST">

        <div class="row col-12 d-flex justify-content-center">

            <h6>Envio de correo del sistema</h6>
        
            
        </div>

        <div class="row col-12 d-flex justify-content-center">

                <div class="input-group col-sm-12 mr-1 ml-1 col-12" id="">
                    <div class="col-md-2 col-12">
                        <label class="col-form-label  title-busq">Envio de correos activo en el sistema</label>

                    </div>
                    <div class="col-md-10 col-12">
                        <select class="form-control" name="envio_correo"  class="form-control select2-single col-1 " data-toggle="select2" data-placeholder="Seleccionar ...">
                            <option value="1" <?php echo ($estatus_envio_correos == 1) ? 'selected' : ''; ?>>Sí</option>
                            <option value="0" <?php echo ($estatus_envio_correos == 0) ? 'selected' : ''; ?>>No</option>
                          </select>

                    </div>
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









