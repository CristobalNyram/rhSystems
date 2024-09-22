<script>
    function getSelectsVacLlenar(selects_value_array,callback){
       let data_to_send = {};
       if (selects_value_array.hasOwnProperty('vac_estatus') && selects_value_array.vac_estatus.hasOwnProperty('value')) {
            data_to_send.vac_estatus = selects_value_array.vac_estatus.value;
            
       }
        let url="<?php echo $this->url->get('helper/ajax_get_datos_selects_vac/') ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: data_to_send,
            success: function(res)
            {
              let data=res.data;
              let data_vac=res.data_vac;
                  if (selects_value_array.hasOwnProperty('emp')) {
                    pintarSelect(data.empresa,
                              selects_value_array.emp.select_id,
                              'emp_id',
                              'emp_nombre',
                              selects_value_array.emp.value,
                              );
                              
                  } 
                  if (selects_value_array.hasOwnProperty('est')) {
                    pintarSelect(data.estado,
                              selects_value_array.est.select_id,
                              'est_id',
                              'est_nombre',
                              selects_value_array.est.value,
                              );
                  } 
                  if (selects_value_array.hasOwnProperty('esc')) {
                    pintarSelect(data.estadocivil,
                              selects_value_array.esc.select_id,
                              'esc_id',
                              'esc_nombre',
                              selects_value_array.esc.value,
                              );
                  } 
                  if (selects_value_array.hasOwnProperty('gra')) {
                    pintarSelect(data.gradoescolar,
                              selects_value_array.gra.select_id,
                              'gra_id',
                              'gra_nombre',
                              selects_value_array.gra.value,
                              );
                  } 

                  if (selects_value_array.hasOwnProperty('sex')) {
                    pintarSelect(data.sexo,
                              selects_value_array.sex.select_id,
                              'sex_id',
                              'sex_nombre',
                              selects_value_array.sex.value,
                              );
                  } 

                  if (selects_value_array.hasOwnProperty('eje')) {
                    pintarSelect(data.ejecutivo,
                              selects_value_array.eje.select_id,
                              'usu_id',
                              'usu_nombre',
                              selects_value_array.eje.value,
                              );
                  } 

                  if (selects_value_array.hasOwnProperty('tip')) {
                    pintarSelect(data.tipovacante,
                              selects_value_array.tip.select_id,
                              'tip_id',
                              'tip_nombre',
                              selects_value_array.tip.value,
                              );
                  } 


                  if (selects_value_array.hasOwnProperty('tie')) {
                    pintarSelect(data.tipoempleo,
                              selects_value_array.tie.select_id,
                              'tie_id',
                              'tie_nombre',
                              selects_value_array.tie.value,
                              );
                     selects_value_array.tie.select_id.trigger("change");

                  } 

                  
                  if (selects_value_array.hasOwnProperty('gen')) {
                    pintarSelect(data.generacion,
                              selects_value_array.gen.select_id,
                              'gen_id',
                              'gen_nombre',
                              selects_value_array.gen.value,
                              );
                          

                  } 

                 /* if (selects_value_array.hasOwnProperty('cav')) {
                    pintarSelect(data.catvacante,
                              selects_value_array.cav.select_id,
                              'cav_id',
                              'cav_nombre',
                              selects_value_array.cav.value,
                              );
                  } */
                   if (selects_value_array.hasOwnProperty('pre')) {
                    pintarSelect(data.prestacion,
                              selects_value_array.pre.select_id,
                              'pre_id',
                              'pre_nombre',
                              selects_value_array.pre.value,
                              );
                  } 
                   if (selects_value_array.hasOwnProperty('vac_estatus')) {
                 
                              let select =selects_value_array.vac_estatus.select_id;
                              select.empty(); // Limpiar el select antes de llenarlo nuevamente
                                if(selects_value_array.vac_estatus.value=="-1"){
                                      select.append('<option value="-2" selected >Seleccionar opción</option>');

                                  }else{
                                      select.append('<option value="-2" selected >Seleccionar opción</option>');

                                  }

                              $.each(data_vac, function(index, item) {                               
                                  if(selects_value_array.vac_estatus.value==index){
                                    select.append('<option value="' + index + '" selected>' + item + '</option>');

                                  }else{
                                    select.append('<option value="' + index + '">' + item + '</option>');

                                  }
                                  
                              });

                  } 

                  

                  


                  

                  
            },

            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          }).done(function (res) {

            if (typeof callback === 'function') {
              callback();
            }
          });
    }
</script>