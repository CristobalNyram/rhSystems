<script>
  

    let _EXC_ID_ID_EDITAR_PSI=0;
    let _CALLBACK_REOLAD_TABLE_PSI=0;
 
    function fnEditarPsi(exp_id=0,callbak_table=0)
	  {
      _EXC_ID_ID_EDITAR_PSI=exp_id;
      _CALLBACK_REOLAD_TABLE_PSI=callbak_table;
     
      $('#form_editar_psi_general')[0].reset(); // Reinicia el formulario
     
     
      //resetSelectValues('#form_editar_vac_general');
        let url="<?php echo $this->url->get('psicometria/ajax_get_detalle/') ?>";
        $.ajax({
            type: "POST",
            url: url+_EXC_ID_ID_EDITAR_PSI,
            success: function(res)
            {
              let data=res.data;
              let mensaje=` del expediende folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);
              $('#editar_psi_general-titulo').html(mensaje);
              $("#psi_observacion-editar_psi_general").val(data.psi_observacion);
              $("#psi_id-editar_psi_general").val(data.psi_id);
              llenarSelectValoracionPsicometria("psi_calificacion-editar_psi_general",data.psi_calificacion);

            let inputBoton="";
            inputBoton=` <a data-toggle="modal" title="Ver archivos"  data-container="body" data-toggle="popover" role="button" class="bg-custom" data-target="#archivos-modal" onclick="fnCargarTablaArchivo(${data.exc_id},'psicometria');">
            <i class=" mdi mdi-folder-open-outline mdi-36px " ></i>

            </a>`;
            $('#containerArchivosEditarPsi').empty();
            $('#containerArchivosEditarPsi').append(inputBoton);
               
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
          
            var urled="<?php echo $this->url->get('psicometria/actualizar_general/') ?>";
            $form.find("button").prop("disabled", true);
            $.ajax({
              type: "POST",
              url: urled+_EXC_ID_ID_EDITAR_PSI,
              data: $form.serialize(),
              success: function(res)
              {   

                switch (res['estado']) {
                    case 2:
                    swalalert('Éxito',res['mensaje'], "success", 0);
                  
                      if(_CALLBACK_REOLAD_TABLE_PSI!=0){
                        _CALLBACK_REOLAD_TABLE_PSI();
                      }else{
                              window.location.reload();

                      }
                      $('#editar_psi_general-modal').modal('hide');

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




{{  modal.crear("Psicometria <span id='editar_psi_general-titulo'><span>", "form_editar_psi_general","editar_psi_general-modal",
[
  {"tamanio":"0","leyenda":"","id":"psi_id-editar_psi_general","name":"psi_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},

   {"tamanio":"12","leyenda":"CALIFICACIONES","id":"psi_calificacion-editar_psi_general","name":"psi_calificacion","tipo":"select","required":""},
   {"tamanio":"12","leyenda":"OBSERVACIONES ","id":"psi_observacion-editar_psi_general","name":"psi_observacion","tipo":"textarea","required":"","complemento":'style="min-height:150px"'},
   {"tipo":"html","value":"<div id='containerArchivosEditarPsi' class='container d-flex justify-content-end mt-2'></div>"}


]
)
}}

<!-- //{"tamanio":"4","leyenda":"GARANTÍA","id":"vac_garantia-editar_vac_general","name":"vac_garantia","tipo":"text","required":""}, -->
