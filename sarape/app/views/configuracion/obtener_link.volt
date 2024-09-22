
  <div class="row">
        <div class="col-6" id="">
                <h4 class="header-title header-title-crm" style="color:#16345E ;">Consultar ID encriptado <i class="mdi mdi-shield-search" style="color:#16345E ;"></i> </h4>
        </div>
        <div class="col-6">
            <div class="text-right">
           
            </div>
        </div>
    </div>  
<div class="container  card card-crm">

    
    <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="miFormulario" class="form-vertical col-md-12 mt-2 mb-2">
                    <div class="form-group">
                        <label for="nombre">ID:</label>
                        <input type="number" required class="form-control" id="id" placeholder="Ingrese el ID">
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>
                <div id="respuesta"></div>

            </div>
        </div>
    </div>

    
 
   
</div>
<script>
    $(document).ready(function () {
        $("#miFormulario").submit(function (e) {
            e.preventDefault(); // Evita la recarga de la página al enviar el formulario
            let id = $("#id").val();
            let url = "<?php echo $this->url->get('helper/get_encript_id/') ?>";

            // Realiza la solicitud AJAX
            $.ajax({
                type: "POST",
                url: url + id, // Asegúrate de que la URL sea correcta
                success: function (res) {
                    let encript = res.data;
                    let readarchivo_reporte_ref = "<?php echo $this->url->get('reporte/reporte_referencias_candidato/') ?>";
                    readarchivo_reporte_ref += encript;
                    let readarchivo_reporte_exc = "<?php echo $this->url->get('reporte/reporte_evaluacion_candidato/') ?>";
                    readarchivo_reporte_exc += encript;
                    let readarchivo_reporte_rq_personal = "<?php echo $this->url->get('reporte/reporte_requision_personal/') ?>";
                    readarchivo_reporte_rq_personal += encript;
                    // Muestra las respuestas como enlaces
                    let respuestaHtml = `<p>Parametro: ${encript} </p>
                    <p>Reporte de Referencias: <a  target="_blank" href="${readarchivo_reporte_ref}">Ver Reporte</a></p>
                    <p>Reporte de Evaluación: <a  target="_blank" href="${readarchivo_reporte_exc}">Ver Reporte</a></p>
                     <p>Reporte de requisión de personal: <a  target="_blank" href="${readarchivo_reporte_rq_personal}">Ver Reporte</a></p>
                    `;
                    $("#respuesta").html(respuestaHtml);
                },
                error: function (res) {
                    console.log(res.responseText);
                }
            });
        });
    });
</script>






