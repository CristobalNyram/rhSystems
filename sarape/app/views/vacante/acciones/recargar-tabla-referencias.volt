<script>

        function load_table_referencias(){

            divListado = document.getElementById('listado');
            url="<?php echo $this->url->get('vacante/referencias_tabla/') ?>";
            $.post(url, $(this).serialize() , function(data)
            {
            divListado.innerHTML=data;
            pintartabla("#td_referencias");
            }).done(function(){
            }).fail(function(){
            })
        }
 
</script>