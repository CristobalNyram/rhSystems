<script>
    function reloadarchivo(id_ese){
        document.getElementById("archivoslistado").innerHTML="";
        reciboListado = document.getElementById('archivoslistado');
        urlreload="<?php echo $this->url->get('archivo/tabla/') ?>";
        urlreload+=id_ese;
        $("#ese_idarchivo").val(id_ese);
       
        $.post(urlreload, $(this).serialize() , function(data)
        {
            $('#archivoslistado').html(data);
            // divListado.innerHTML=data;
            $('#archivotable').DataTable(
            {
              "pageLength": 10
            });
        }).done(function() { 
        }).fail(function() {
        })
    }

   

</script>