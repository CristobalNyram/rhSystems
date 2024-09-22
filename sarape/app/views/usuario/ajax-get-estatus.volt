<script>
    function getEstatusShowOrSet(id,select){
        $subsnegocio=select;
        $subsnegocio.empty();
            $subsnegocio.append(function () {
              var options = '';
              if(id==1){
                options += '<option selected value="1">Baja</option>';
                options += '<option value="2">Alta</option>';
              }else{
                options += '<option value="1">Baja</option>';
                options += '<option selected value="2">Alta</option>';
              }
              
              // $.each(data, function (key, dat) {
              
              // });

              return options;
            });
    }

</script>