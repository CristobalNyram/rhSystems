<script>
      function fnGetAliasEmpresa(emp_id=0,input=0)
    {
           let url_enviar="<?php echo $this->url->get('empresa/ajax_empresa_detalle/') ?>";
            // let $nivel_estudios =ese_id
  
            $.ajax({
                type: "POST",
                url: url_enviar+emp_id,
                  
                success: function(res)
                {
    
                  // console.log(res);
                    
                    if(res.estatus=='2'){

                       // return res.data;
                       // console.log();
                       input.text(' - '+ res.data.emp_alias);


                    }else{
                        input.text('');


                    }
  
                },
                error: function(res)
                {
                    alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'); 
                  
                }
            });
    }
</script>