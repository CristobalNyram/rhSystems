<script>
if (typeof fnGetCalificacionesFinalesByGrupo !== "function") {
	
    function fnGetCalificacionesFinalesByGrupo(select_id = 0,gru_id=0,valor_default=0,text_select = 'Todos') {

        select_id = (select_id.trim() === '') ? "sin_valor_select_id" : select_id;
        gru_id = (!gru_id || /^\s*$/.test(gru_id) || isNaN(gru_id) || gru_id <= 0) ? -1 : gru_id;
        valor_default = (!valor_default || /^\s*$/.test(valor_default) || valor_default <= 0) ? -1 : valor_default;


        let url = "<?php echo $this->url->get('calificacionfinalgrupo/ajax_get_valores_por_grupo/') ?>";
        let $subsnegocio = $('#' + select_id);
        $subsnegocio.empty();
        $.ajax({
            type: "POST",
            url: url+"/"+gru_id,
            success: function(res) {
                // console.log(data);
                let data=res.data;
                // Agregar nuevos sub-departamentos
                if (data.length > 0) {
                    $subsnegocio.append(function() {
                        var options = '';
                        if (valor_default === 0) {
                            options += '<option selected value="-1">' + text_select + '</option>';
                        }else{
                            options += '<option  data-cal_id="-1" value="-1">' + text_select + '</option>';

                         }
                        $.each(data, function(key, dat) {


                                // Crear las otras opciones basadas en los datos de 'dat'
                                var selectedAttribute = '';
                                if (valor_default == dat.cal_valor) {
                                    selectedAttribute = 'selected';
                                }

                                options += '<option data-cal_id="' + dat.cal_id + '" value="' + dat.cal_valor + '" ' + selectedAttribute + '>' + dat.cal_valor + '.-' + dat.cal_texto + '</option>';
                        });


                        return options;
                    });
                } else {
                    $subsnegocio.append(function() {
                        var options = '';
                        options += '<option selected value="-1">Sin registros</option>';
                        return options;
                    });
                }
            },
            error: function(res) {
                // Manejo de errores
            }
        });
    }
} else {
    console.log("La función fnGetCalificacionesFinalesByGrupo ya está declarada.");
}

</script>