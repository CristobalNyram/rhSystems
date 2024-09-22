<script>
function fnEliminarRVE_general(rve_id,vac_id=0, callbak_table=0,otra_call_back=0) {
        var urleliminarare = "<?php echo $this->url->get('relvacanteejecutivo/eliminar/') ?>";
        mensaje = "¿Está segur@ de que desea dejar de compartir la vacante?";
        
        Swal.fire({
            title: "Dejar de compartir",
            text: mensaje,
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, estoy segur@",
            cancelButtonText: "Cancelar"
        }).then((result) => {

            if (result.value) {
                 $.ajax({
                    type: "POST",
                    url: urleliminarare + rve_id,
                    success: function (res) {
                    switch (res['estado']) {
                            case 2:
                            swalalert('Éxito',res['mensaje'], "success", 0);
                            break;
                            case -1:
                            swalalert('Aviso',res['mensaje'], "warning", 0);
                            break;        
                            case -2:
                            swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                            break;
                            default:
                                  alert("NO FOUND STATE");      
                            break;
                    }
                        

                    if(callbak_table!="0"){
                        if(vac_id!="0"){
                        callbak_table(vac_id,otra_call_back);
                        }else{
                        callbak_table();
                        }

                    }
                    else{
                        window.location.reload();
                    }

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error en la solicitud Ajax:", textStatus, errorThrown);
                    }
                });
            }
        });
}


</script>