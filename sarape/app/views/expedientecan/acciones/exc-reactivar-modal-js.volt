
<style>
#content-msg-reactivar  .badge{
    font-size: 1.5rem;
    padding: 1rem;
}

</style>
<script>
// Llamada a la función con el límite de opciones, el ID del select y el valor seleccionado  
    let _EXC_ID_REACT_EXC=0;
    let _CALLBACK_REOLAD_TABLE_REACT_EXC=0;
    let _EXC_ESTATUS_ANTERIOR=0;
    let _CALLBACK_CON_VAC_ID_REAC_EXC=0;
    function fnGetInfoExpReactivar(exc_id=0,callbak_table=0,call_back_with_vac_id=0)
	  {
        $("#exc_comentario-reactivar_exc_gen").val("");
        _EXC_ID_REACT_EXC=exc_id;
        _CALLBACK_CON_VAC_ID_REAC_EXC=call_back_with_vac_id;
        _CALLBACK_REOLAD_TABLE_REACT_EXC=callbak_table;
        let url="<?php echo $this->url->get('expedientecan/ajax_get_detalle/') ?>";
        $.ajax({
            type: "POST",
            url: url+_EXC_ID_REACT_EXC,
            success: function(res)
            {
              let data=res.data;
                     let _EXC_ESTATUS_ANTERIOR=data.exc_estatusprevio;

                     let mensaje=` el expediente folio ${data.exc_id} - ${data.can_nombre} - ${data.cav_nombre} - ${data.emp_nombre} -`+generateBadgeExcEstatusHTML(data.exc_estatus);	         
                      $("#exc_id-reactivar_exc_gen").val(exc_id);
                      $("#vac_id-reactivar_exc_gen").val(data.vac_id);
                      $("#reactivar_exc_gen-titulo").html(mensaje);
                      $("#data_info_detalle-reactivar_exc_gen").html(`<h4 class="text-center h4">Se va hacer el cambio de estatus a  <div id="badge-estatus-a-mover"> ${generateBadgeExcEstatusHTML(data.exc_estatusprevio)} <div></h4>`);

            },
            error: function(data)
            {
              alertify.alert('ERROR','No se pudieron cargar los datos vuelve a intentar de nuevo.'+data.responseText); 
              
            }
          });

	  }

   $(document).ready(()=>{
   
		$("#form_reactivar_exc_gen").submit(function(event) 
        {
        event.preventDefault();
        let $form = $(this);
        let comentario=$("#exc_comentario-reactivar_exc_gen").val();
        if(comentario==""){
          swalalert('Aviso',"Debe ingresar un comentario", "warning", 0);
          return false;
        }
        let badge_estatus_anterior=$("#badge-estatus-a-mover").html();
       
        let template=`
      
          <div id="content-msg-reactivar">
            <p style="
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff0000ad;
            ">
              El expediente se va reactivar al estatus siguiente
            </p>
            ${badge_estatus_anterior}
       
          </div>
        `;

          Swal.fire(
            {
            html: template,
            showCancelButton: true, // Muestra el botón "Cancelar"
            confirmButtonText: 'Si, realizar acción', // Texto del botón "Aceptar"
            cancelButtonText: 'No, cancelar acción' // Texto del botón "Cancelar"
          }
          )
          .then((value) => {
            if(value.value==true){

              // peticion ajax inicio
                let urled="<?php echo $this->url->get('expedientecan/reactivar/') ?>";
                $form.find("button").prop("disabled", true);
                $.ajax({
                  type: "POST",
                  url: urled+_EXC_ID_REACT_EXC,
                  data: $form.serialize(),
                  success: function(res)
                  {   
     
                    switch (res['estado']) {
                        case 2:
                        swalalert('Éxito',res['mensaje'], "success", 0);
                      
                          if(_CALLBACK_REOLAD_TABLE_REACT_EXC!=0){
                            _CALLBACK_REOLAD_TABLE_REACT_EXC();

                            if(_CALLBACK_CON_VAC_ID_REAC_EXC!=0){
                              _CALLBACK_CON_VAC_ID_REAC_EXC(res["vac_id"]);
                            }
                            
                          }else{
                            window.location.reload();
                          }

                          $('#reactivar_exc_gen-modal').modal('hide');
                          $form.find("button").prop("disabled", false);
                          break;
                      case -1:
                          swalalert('Aviso',res['mensaje'], "warning", 0);
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
              //peticion ajax fin 


            }else{
                 swalalert('Aviso','Acción cancelada', "info", 0);
            }
            
          });
            

   
          
    
          
        });
  });
  
</script>



{{  modal.crear("Reactivar <span id='reactivar_exc_gen-titulo'><span>", "form_reactivar_exc_gen","reactivar_exc_gen-modal",
[

  {"value":"<div class='col-12 mt-1 mb-1' id='data_info_detalle-reactivar_exc_gen'></div>","tipo":"html"},
  {"tamanio":"0","leyenda":"","id":"exc_id-reactivar_exc_gen","name":"exc_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"0","leyenda":"","id":"vac_id-reactivar_exc_gen","name":"vac_id","tipo":"hidden","required":"","funcion":'onchange=""',"clase":"","value":"0"},
  {"tamanio":"12","leyenda":"COMENTARIO ","required":"required","id":"exc_comentario-reactivar_exc_gen","name":"exc_comentario","tipo":"textarea","required":"","complemento":'style="min-height:250px"'}


]
)
}}

