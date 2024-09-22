<script>
  

    let _PSI_ID_EDITAR=0;
    let _CALLBACK_REOLAD_TABLE_PSI=0;
 
    function fnEditarPsi(psi_id=0,callbak_table=0)
	  {
      _PSI_ID_EDITAR=psi_id;
      _CALLBACK_REOLAD_TABLE_PSI=callbak_table;
     
      $('#form_editar_psi_general')[0].reset(); // Reinicia el formulario
      //resetSelectValues('#form_editar_vac_general');
        let url="<?php echo $this->url->get('vacante/ajax_get_detalle/') ?>";
        $.ajax({
            type: "POST",
            url: url+_PSI_ID_EDITAR,
            success: function(res)
            {
              let data=res.data;
              let mensaje=` ${data.vac_id} - ${data.emp_nombre} `+generateBadgeVacEstatusHTML(data.vac_estatus);
              $('#editar_vac_general-titulo').html(mensaje);               
            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }
  $(document).ready(()=>{
   
		$("#form_editar_psi_general").submit(function(event) 
        {
          event.preventDefault();
          var $form = $(this);
          var urled="<?php echo $this->url->get('psicometria/actualizar/') ?>";
          $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+_VAC_ID_EDITAR,
              data: $form.serialize(),
              success: function(res)
              {   

                switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                      if(_CALLBACK_REOLAD_TABLE!=0){
                        _CALLBACK_REOLAD_TABLE();
                      }
                      $('#form_editar_psi_general-modal').modal('hide');
                      $form.find("button").prop("disabled", false);
                      break;
                  
                    case -2:
                    swalalertHTML('Error',`${res['mensaje']} <br> <span class=></span> `, "error");
                    $form.find("button").prop("disabled", false);
                    break;
                    default:
                    
                      break;
                  }
              },
              error: function(res)
              { 
                alert(res.responseText);
              }
            });
          
        });
  });
</script>


{{  modal.crear("Editar psicometria No. <span id='form_editar_psi_general-titulo'><span>", "form_editar_psi_general","form_editar_psi_general-modal",
[ 
  {"tamanio":"12","leyenda":"OBSERVACIONES ","id":"vac_observaciones-editar_vac_general","name":"vac_observaciones","tipo":"textarea","required":"","complemento":'style="min-height:150px"'},
  {"tamanio":"5","leyenda":"EJECUTIVO","id":"eje_id-editar_vac_general","name":"eje_id","tipo":"select","required":""}
]
)
}}
